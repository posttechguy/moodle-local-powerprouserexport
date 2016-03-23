<?php
/**
  * Export user and completion data to CSV files
  *
  * Local library definitions
  *
  * @package    local_powerprouserexport
  * @author     Bevan Holman <bevan@pukunui.com>, Pukunui
  * @author     Bevan Holman <bevan@pukunui.com>, Pukunui
  * @copyright  2016 onwards, Pukunui
  * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

require_once($CFG->dirroot.'/user/profile/lib.php');

function local_powerprouserexport_cron($runhow = 'auto', $data = null) {

    set_config('local_powerprouserexport', 'lastrun', 0);
    $config = get_config('local_powerprouserexport');

    if (($runhow == 'auto' and $config->ismanual) or ($runhow == 'manual' and empty($config->ismanual))) {
      return false;
    }
    local_powerprouserexport_write_user_data($config, $runhow, $data);

    set_config('local_powerprouserexport', 'lastrun', time());
    return true;
}

/**
  * Write the user CSV output to file
  *
  * @param string $csv  the csv data
  * @return boolean  success?
*/
function local_powerprouserexport_write_user_data($config, $runhow = 'auto', $data = null) {
  global $CFG, $DB;

  if (empty($config->csvlocation)) {
      $config->usercsvlocation = $CFG->dataroot.'/powerprouserexport';
  }
  if (!isset($config->csvprefix)) {
      $config->usercsvprefix = '';
  }
  if (!isset($config->lastrun)) {
      $config->lastrun = 0;
  }

  // Open the file for writing.
  $filename = '';

  if ($data) {
    $filename = $config->usercsvlocation.'/'.$config->usercsvprefix.date("Ymd").'-'.date("His").'.csv';
  } else {
    $filename = $config->usercsvlocation.'/'.$config->usercsvprefix.date("Ymd").'.csv';
  }
echo $filename;
  if ($fh = fopen($filename, 'w')) {

      // Write the headers first.
      fwrite($fh, implode(',', local_powerprouserexport_get_user_csv_headers())."\r\n");

      $users = local_powerprouserexport_get_user_data($config->lastrun, $data);

      if ($users->valid()) {

          // Cycle through data and add to file.
          foreach ($users as $user) {

            //  profile_load_custom_fields($user);

              $user->profile  = (array)profile_user_record($user->id);
              $employer       = ($user->profile['employer'] == 'Other'
                                  and !empty($user->profile['employerother'])
                                  and strtolower($user->profile['employerother']) != 'n/a')
                              ? $user->profile['employerother']
                              : $user->profile['employer'];

              // Write the line to CSV file.
              fwrite($fh,
                  implode(',', array(
                      $user->username,
                      $user->email,
                      $user->firstname,
                      $user->lastname,
                      $user->country,
                      $user->profile['dob'],
                      $user->profile['streetnumber'],
                      $user->profile['streetname'],
                      $user->profile['town'],
                      $user->profile['postcode'],
                      $user->profile['state'],
                      $user->profile['gender'],
                      $user->profile['postaladdress'],
                      $employer,
                      $user->profile['usi'],
                      $user->profile['phone'])
               )."\r\n");
          }

          // Close the recordset to free up RDBMS memory.
          $users->close();
      }
      // Close the file.
      fclose($fh);

      return true;
  } else {
      return false;
  }
}

/**
 * Return a record set with the grade, group, enrolment data.
 * We use a record set to minimise memory usage as this report may get quite large.
 *
 * @param integer   $from   time stamp
 * @return object   $DB     record set
 */
function local_powerprouserexport_get_user_data($lastrun = 0, $data = null) {
    global $DB;

    $params       = array();
    $whereclause  = '';

    if ($data) {
      $params['timestart'] = $data->timestart;
      $params['timeend'] = $data->timeend;
      $whereclause = "u.timemodified BETWEEN :timestart and :timeend";
    } else {
      $params['lastrun'] = $lastrun;
      $whereclause = "u.timemodified > :lastrun";
    }

    $sql = "
        SELECT  *
        FROM    {user} AS u
        WHERE   $whereclause
    ";

/*
      print_object($params);
         echo "<pre>$sql</pre>";
*/
    return $DB->get_recordset_sql($sql, $params);
}


/**
 * Return the CSV headers
 *
 * @return array
 */
function local_powerprouserexport_get_user_csv_headers() {
    return array(
        get_string('username',   'local_powerprouserexport'),
        get_string('email',   'local_powerprouserexport'),
        get_string('firstname',      'local_powerprouserexport'),
        get_string('lastname',    'local_powerprouserexport'),
        get_string('country',      'local_powerprouserexport'),
        get_string('dob', 'local_powerprouserexport'),
        get_string('streetnumber', 'local_powerprouserexport'),
        get_string('streetname', 'local_powerprouserexport'),
        get_string('town', 'local_powerprouserexport'),
        get_string('postcode', 'local_powerprouserexport'),
        get_string('state', 'local_powerprouserexport'),
        get_string('gender', 'local_powerprouserexport'),
        get_string('postaladdress', 'local_powerprouserexport'),
        get_string('employer', 'local_powerprouserexport'),
        get_string('idnumber', 'local_powerprouserexport'),
        get_string('phone', 'local_powerprouserexport'),
    );
}
