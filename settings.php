<?php
/**
 * @author    test
 * @copyright test
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package   local_custom_registration
 */

defined('MOODLE_INTERNAL') || die;

require_once(__DIR__ . '/lib.php');

if ($hassiteconfig) {

    global $ADMIN;

    $settings = new admin_settingpage(
        'local_custom_registration_settings',
        get_string('custom_registration_form', 'local_custom_registration'),
        'moodle/site:config'
    );

    $additional_fields = local_custom_registration_get_additional_fields();

    foreach ($additional_fields as $field_name => $field) {
        $settings->add(new admin_setting_heading(
            'local_custom_registration_' . $field_name,
            get_string($field_name, 'local_custom_registration'),
            ''
        ));

        $settings->add(new admin_setting_configcheckbox(
            'local_custom_registration/enable_' . $field_name,
            get_string('enable_' . $field_name, 'local_custom_registration'),
            get_string('enable_' . $field_name . '_desc', 'local_custom_registration'),
            0
        ));

        $settings->add(new admin_setting_configcheckbox(
            'local_custom_registration/is_' . $field_name . '_required',
            get_string('is_' . $field_name . '_required', 'local_custom_registration'),
            get_string('is_' . $field_name . '_required_desc', 'local_custom_registration'),
            0
        ));
    }

    $ADMIN->add('localplugins', $settings);

}