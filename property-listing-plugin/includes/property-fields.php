<?php

add_action('cmb2_admin_init', 'plp_add_property_fields');

function plp_add_property_fields() {

    $cmb = new_cmb2_box([
        'id'           => 'property_details',
        'title'        => 'Property Details',
        'object_types' => ['property'], // this links to your post type
    ]);

    // Price
    $cmb->add_field([
        'name' => 'Price',
        'id'   => 'price',
        'type' => 'text',
    ]);

    // Bedrooms
    $cmb->add_field([
        'name' => 'Bedrooms',
        'id'   => 'bedrooms',
        'type' => 'text',
    ]);

    // Location
    $cmb->add_field([
        'name' => 'Location',
        'id'   => 'location',
        'type' => 'text',
    ]);

    $cmb->add_field([
    'name' => 'Latitude',
    'id'   => 'latitude',
    'type' => 'text',
    ]);

    $cmb->add_field([
    'name' => 'Longitude',
    'id'   => 'longitude',
    'type' => 'text',
    ]);
}