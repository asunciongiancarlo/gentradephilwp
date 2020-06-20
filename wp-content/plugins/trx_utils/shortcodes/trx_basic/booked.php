<?php


if (function_exists('bugspatrol_exists_visual_composer') && bugspatrol_exists_visual_composer())
    add_action('bugspatrol_action_shortcodes_list',				'bugspatrol_booked_reg_shortcodes');
    add_action('bugspatrol_action_shortcodes_list_vc',		'bugspatrol_booked_reg_shortcodes_vc');




// Register plugin's shortcodes
//------------------------------------------------------------------------

// Register shortcode in the shortcodes list
if (!function_exists('bugspatrol_booked_reg_shortcodes')) {
    function bugspatrol_booked_reg_shortcodes() {
        if (bugspatrol_storage_isset('shortcodes')) {

            $booked_cals = bugspatrol_get_list_booked_calendars();

            bugspatrol_sc_map('booked-appointments', array(
                    "title" => esc_html__("Booked Appointments", "bugspatrol"),
                    "desc" => esc_html__("Display the currently logged in user's upcoming appointments", "bugspatrol"),
                    "decorate" => true,
                    "container" => false,
                    "params" => array()
                )
            );

            bugspatrol_sc_map('booked-calendar', array(
                "title" => esc_html__("Booked Calendar", "bugspatrol"),
                "desc" => esc_html__("Insert booked calendar", "bugspatrol"),
                "decorate" => true,
                "container" => false,
                "params" => array(
                    "calendar" => array(
                        "title" => esc_html__("Calendar", "bugspatrol"),
                        "desc" => esc_html__("Select booked calendar to display", "bugspatrol"),
                        "value" => "0",
                        "type" => "select",
                        "options" => bugspatrol_array_merge(array(0 => esc_html__('- Select calendar -', 'bugspatrol')), $booked_cals)
                    ),
                    "year" => array(
                        "title" => esc_html__("Year", "bugspatrol"),
                        "desc" => esc_html__("Year to display on calendar by default", "bugspatrol"),
                        "value" => date("Y"),
                        "min" => date("Y"),
                        "max" => date("Y")+10,
                        "type" => "spinner"
                    ),
                    "month" => array(
                        "title" => esc_html__("Month", "bugspatrol"),
                        "desc" => esc_html__("Month to display on calendar by default", "bugspatrol"),
                        "value" => date("m"),
                        "min" => 1,
                        "max" => 12,
                        "type" => "spinner"
                    )
                )
            ));
        }
    }
}


// Register shortcode in the VC shortcodes list
if (!function_exists('bugspatrol_booked_reg_shortcodes_vc')) {
    function bugspatrol_booked_reg_shortcodes_vc() {

        $booked_cals = bugspatrol_get_list_booked_calendars();

        // Booked Appointments
        vc_map( array(
            "base" => "booked-appointments",
            "name" => esc_html__("Booked Appointments", "bugspatrol"),
            "description" => esc_html__("Display the currently logged in user's upcoming appointments", "bugspatrol"),
            "category" => esc_html__('Content', 'bugspatrol'),
            'icon' => 'icon_trx_booked',
            "class" => "trx_sc_single trx_sc_booked_appointments",
            "content_element" => true,
            "is_container" => false,
            "show_settings_on_create" => false,
            "params" => array()
        ) );

        class WPBakeryShortCode_Booked_Appointments extends Bugspatrol_VC_ShortCodeSingle {}

        // Booked Calendar
        vc_map( array(
            "base" => "booked-calendar",
            "name" => esc_html__("Booked Calendar", "bugspatrol"),
            "description" => esc_html__("Insert booked calendar", "bugspatrol"),
            "category" => esc_html__('Content', 'bugspatrol'),
            'icon' => 'icon_trx_booked',
            "class" => "trx_sc_single trx_sc_booked_calendar",
            "content_element" => true,
            "is_container" => false,
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    "param_name" => "calendar",
                    "heading" => esc_html__("Calendar", "bugspatrol"),
                    "description" => esc_html__("Select booked calendar to display", "bugspatrol"),
                    "admin_label" => true,
                    "class" => "",
                    "std" => "0",
                    "value" => array_flip(bugspatrol_array_merge(array(0 => esc_html__('- Select calendar -', 'bugspatrol')), $booked_cals)),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "year",
                    "heading" => esc_html__("Year", "bugspatrol"),
                    "description" => esc_html__("Year to display on calendar by default", "bugspatrol"),
                    "admin_label" => true,
                    "class" => "",
                    "std" => date("Y"),
                    "value" => date("Y"),
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "month",
                    "heading" => esc_html__("Month", "bugspatrol"),
                    "description" => esc_html__("Month to display on calendar by default", "bugspatrol"),
                    "admin_label" => true,
                    "class" => "",
                    "std" => date("m"),
                    "value" => date("m"),
                    "type" => "textfield"
                )
            )
        ) );

        class WPBakeryShortCode_Booked_Calendar extends Bugspatrol_VC_ShortCodeSingle {}

    }
}
