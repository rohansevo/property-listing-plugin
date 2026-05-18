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
    register_taxonomy(
        'property_category',
        ['property'],
        [

            'labels' => [
                'name'          => 'Property Categories',
                'singular_name' => 'Property Category',
            ],

            'public'       => true,
            'hierarchical' => true, // like categories

            'show_in_rest' => true,

            'rewrite' => [
                'slug' => 'property-category',
            ],
        ]
    );
}

add_action('init', 'property_listing_register_post_types');








/*
|--------------------------------------------------------------------------
| Register Taxonomies
|--------------------------------------------------------------------------
*/

function property_listing_register_taxonomies() {

    register_taxonomy(
        'property_tag',
        ['property'],
        [

            'labels' => [
                'name' => 'Property Tags',
                'singular_name' => 'Property Tag',
            ],

            'public' => true,
            'hierarchical' => false,
            'show_in_rest' => true,
        ]
    );



    // Property Bedroom Taxonomy
    register_taxonomy(
        'property_bedroom',
        ['property'],
        [

            'labels' => [
                'name'          => 'Bedrooms',
                'singular_name' => 'Bedroom',
            ],

            'public'            => true,
            'hierarchical'      => true,
            'show_in_rest'      => true,
            'show_admin_column' => true,
            'meta_box_cb'       => 'post_categories_meta_box',
        ]
    );


}

add_action('init', 'property_listing_register_taxonomies');


