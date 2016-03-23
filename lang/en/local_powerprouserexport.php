<?php
/**
 * Export user and completion data to CSV files
 *
 * String definitions
 *
 * @package    local_powerprouserexport
 * @author     Bevan Holman <bevan@pukunui.com>, Pukunui
 * @copyright  2016 onwards, Pukunui
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['country'] = 'Nationality';
$string['dob'] = 'DOB';
$string['email'] = 'Email';
$string['employer'] = 'Employer';
$string['firstname'] = 'Given names';
$string['gender'] = 'Gender';
$string['idnumber'] = 'USI';
$string['lastname'] = 'Surname';
$string['usercsvlocation'] = 'User CSV File Location';
$string['usercsvlocationdesc'] = 'Full server path where user CSV files should be created.
This directory must be writable by the web user';
$string['usercsvprefix'] = 'User CSV File Name Prefix';
$string['usercsvprefixdesc'] = 'The User CSV files will be created with a name of the current date in the format YYYYMMDD
and an extension of ".csv". The prefix will be prepended to the beginning of the name';
$string['exporterror'] = 'Error: An error has occurred while exporting the csv file, please return to the export page and try again';
$string['exportnow'] = 'Export now';
$string['exportsuccess'] = 'Success: your user file was successfully exported as a csv file';
$string['ismanual'] = 'Is Power Pro User Export manual?';
$string['ismanualdesc'] = 'The user export can be configured as a manual process or a automatic process,
Tick the box to make the process manual<br>
Turn off to make the process run automatically again';
$string['isnotmanual'] = 'The manual Power Pro User Export is unavailable, you will be redirected to change the settings';
$string['local/powerprouserexport:config'] = 'Configure Power Pro User Export';
$string['manualexport'] = 'Manual User Export';
$string['manualexportdesc']     = 'The Power Pro User Export create a file:
<ul>
    <li>
        User profile data:
        <ol style="list-style-type:decimal;">
            <li>Username</li>
            <li>Email address</li>
            <li>First name</li>
            <li>Surname</li>
            <li>Country</li>
            <li>Date of birth</li>
            <li>Address street number</li>
            <li>Address street name</li>
            <li>Address location – suburb, locality or town</li>
            <li>Postcode</li>
            <li>State or territory</li>
            <li>Gender</li>
            <li>Postal details (if different from address details)</li>
            <li>Employer</li>
            <li>Unique Student Identifier</li>
            <li>Contact phone number</li>
        </ol>
    </li>
</ul>
';
$string['manualexportheader'] = 'Manual User Export for Power Pro';
$string['phone'] = 'Mobile';
$string['pluginname'] = 'Power Pro User Export';
$string['postaladdress'] = 'Postal addr.';
$string['postcode'] = 'Postcode';
$string['state'] = 'State';
$string['streetname'] = 'Street Name';
$string['streetnumber'] = 'Street No';
$string['town'] = 'Town/Suburb';
$string['unitcode'] = 'USI';
$string['username'] = 'Moodle User';
$string['timestart'] = 'From date';
$string['timeend'] = 'To date';
