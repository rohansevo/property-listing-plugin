<?php
/**
 * Plugin Name: Property Listing Plugin
 * Description: Custom property listing system
 * Version: 1.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) {
    exit; // prevent direct access
}
add_theme_support('post-thumbnails');

require_once plugin_dir_path(__FILE__) . 'includes/post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/cmb2/init.php';  
require_once plugin_dir_path(__FILE__) . 'includes/property-fields.php';
require_once plugin_dir_path(__FILE__) . 'includes/api.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';




add_action('wp_enqueue_scripts', function () {

    wp_enqueue_script(
        'plp-frontend',
        plugin_dir_url(__FILE__) . 'assets/js/frontend.js',
        [],
        null,
        true
    );

});


function plp_enqueue_react_app() {

    wp_enqueue_style(
        'plp-react-style',
        plugin_dir_url(__FILE__) . 'assets/css/main.css',
        array(),
        time()
    );

    wp_enqueue_script(
        'plp-react-script',
        plugin_dir_url(__FILE__) . 'assets/js/main.js',
        array('wp-element'),
        time(),
        true
    );
    wp_localize_script('plp-react-script', 'plpVars', array(
        'assetsUrl' => plugin_dir_url(__FILE__) . 'assets/',
    ));
}

add_action('wp_enqueue_scripts', 'plp_enqueue_react_app');