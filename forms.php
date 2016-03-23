<?php
/**
 * Manual Export for Wentworth Institute of Higher Education project
 *
 * Form definitions
 *
 * @package    local_powerprouserexport
 * @author     Bevan Holman <bevan@pukunui.com>, Pukunui
 * @copyright  2016 onwards, Pukunui
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');

class local_powerprouserexport_manual_export_form extends moodleform {

    /**
     * Define the form
     */
    public function definition() {
        global $DB;

        $mform =& $this->_form;
        $id = $this->_customdata;

        $strrequired = get_string('required');

        $mform->addElement('date_time_selector', 'timestart', get_string('timestart', 'local_powerprouserexport'));
        $mform->addElement('date_time_selector', 'timeend', get_string('timeend', 'local_powerprouserexport'));

        $strsubmit = get_string('exportnow', 'local_powerprouserexport');
        $this->add_action_buttons(true, $strsubmit);
    }

    /**
     * Validate the form submission
     *
     * @param array $data  submitted form data
     * @param array $files submitted form files
     * @return array
     */
    public function validation($data, $files) {
        return array();
    }
}