<?php
/**
 * Export user and completion data to CSV files
 *
 * Administration settings
 *
 * @package    local_powerprouserexport
 * @author     Bevan Holman <bevan@pukunui.com>, Pukunui
 * @copyright  2016 onwards, Pukunui
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if (has_capability('local/powerprouserexport:config', context_system::instance())) {

    $settings = new admin_settingpage('local_powerprouserexport_settings',
                                      new lang_string('pluginname', 'local_powerprouserexport'),
                                      'local/powerprouserexport:config');

    $settings->add(new admin_setting_configdirectory(
                'local_powerprouserexport/usercsvlocation',
                new lang_string('usercsvlocation', 'local_powerprouserexport'),
                new lang_string('usercsvlocationdesc', 'local_powerprouserexport'),
                $CFG->dataroot.'/powerprouserexport',
                PARAM_RAW,
                80
                ));

    $settings->add(new admin_setting_configtext(
                'local_powerprouserexport/usercsvprefix',
                new lang_string('usercsvprefix', 'local_powerprouserexport'),
                new lang_string('usercsvprefixdesc', 'local_powerprouserexport'),
                'powerproexport_user',
                PARAM_RAW,
                80
                ));

    $settings->add(new admin_setting_configcheckbox(
                'local_powerprouserexport/ismanual',
                new lang_string('ismanual', 'local_powerprouserexport'),
                new lang_string('ismanualdesc', 'local_powerprouserexport'),
                'Automatic grade export (not checked)'
                ));

    $ADMIN->add('root', new admin_category('local_powerprouserexport', get_string('pluginname', 'local_powerprouserexport')));

    $ADMIN->add('local_powerprouserexport', new admin_externalpage('manualuserexport', get_string('manualexport', 'local_powerprouserexport'),
                new moodle_url('/local/powerprouserexport/manual.php'),
                'local/powerprouserexport:config'));

    $ADMIN->add('localplugins', $settings);
}
