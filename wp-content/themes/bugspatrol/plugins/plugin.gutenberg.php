<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('bugspatrol_gutenberg_theme_setup')) {
    add_action( 'bugspatrol_action_before_init_theme', 'bugspatrol_gutenberg_theme_setup', 1 );
    function bugspatrol_gutenberg_theme_setup() {
        if (is_admin()) {
            add_filter( 'bugspatrol_filter_required_plugins', 'bugspatrol_gutenberg_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'bugspatrol_exists_gutenberg' ) ) {
    function bugspatrol_exists_gutenberg() {
        return function_exists( 'the_gutenberg_project' ) && function_exists( 'register_block_type' );
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'bugspatrol_gutenberg_required_plugins' ) ) {
        function bugspatrol_gutenberg_required_plugins($list=array()) {
        if (in_array('gutenberg', (array)bugspatrol_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('Gutenberg', 'bugspatrol'),
                'slug'         => 'gutenberg',
                'required'     => false
            );
        return $list;
    }
}