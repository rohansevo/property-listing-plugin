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




/*
|--------------------------------------------------------------------------
| Register Featured Meta Field
|--------------------------------------------------------------------------
*/

function property_register_featured_meta() {

    register_post_meta('property', 'featured_property', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'boolean',
        'default' => false,
    ]);
}

add_action('init', 'property_register_featured_meta');



/*
|--------------------------------------------------------------------------
| Add Meta Box
|--------------------------------------------------------------------------
*/

function property_add_featured_meta_box() {

    add_meta_box(
        'property_featured_box',
        'Featured Property',
        'property_featured_meta_box_html',
        'property',
        'side'
    );
}

add_action('add_meta_boxes', 'property_add_featured_meta_box');



/*
|--------------------------------------------------------------------------
| Meta Box HTML
|--------------------------------------------------------------------------
*/

function property_featured_meta_box_html($post) {

    $value = get_post_meta($post->ID, 'featured_property', true);

    ?>

    <label>
        <input
            type="checkbox"
            name="featured_property"
            value="1"
            <?php checked($value, 1); ?>
        />

        Mark as Featured
    </label>

    <?php
}



/*
|--------------------------------------------------------------------------
| Save Meta Box
|--------------------------------------------------------------------------
*/

function property_save_featured_meta($post_id) {

    $featured = isset($_POST['featured_property']) ? 1 : 0;

    update_post_meta($post_id, 'featured_property', $featured);
}

add_action('save_post_property', 'property_save_featured_meta');



