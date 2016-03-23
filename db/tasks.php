<?php
/**
 * Export user and completion data to CSV files
 *
 * Scheduled task definition
 *
 * @package    local_powerprouserexport
 * @author     Bevan Holman <bevan@pukunui.com>, Pukunui
 * @copyright  2016 onwards, Pukunui
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$tasks = array(
    array(
        'classname' => 'local_powerprouserexport\task\exporttocsv',
        'blocking'  => 0,
        'minute'    => '*',
        'hour'      => '*',
        'day'       => '*',
        'dayofweek' => '*',
        'month'     => '*'
    )
);
