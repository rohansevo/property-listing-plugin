<?php

function property_listing_register_post_types() {

    register_post_type('property', [
        'labels' => [
            'name' => 'Properties',
            'singular_name' => 'Property',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-building',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ]);
}

add_action('init', 'property_listing_register_post_types');