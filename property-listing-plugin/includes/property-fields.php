<?php

add_action('cmb2_admin_init', 'plp_add_property_fields');

function plp_add_property_fields() {

    /*
    |--------------------------------------------------------------------------
    | Basic Information
    |--------------------------------------------------------------------------
    */

    $basic = new_cmb2_box([
        'id'           => 'basic_info_box',
        'title'        => 'Basic Information',
        'object_types' => ['property'],
    ]);

    $basic->add_field([
        'name' => 'Price',
        'id'   => 'price',
        'type' => 'text',
    ]);

    $basic->add_field([
        'name'     => 'Bedrooms',
        'id'       => 'property_bedroom',
        'taxonomy' => 'property_bedroom',
        'type'     => 'taxonomy_select',
    ]);



    /*
    |--------------------------------------------------------------------------
    | Location
    |--------------------------------------------------------------------------
    */

    $location = new_cmb2_box([
        'id'           => 'location_box',
        'title'        => 'Location',
        'object_types' => ['property'],
    ]);

    $location->add_field([
        'name' => 'Location',
        'id'   => 'location',
        'type' => 'text',
    ]);

    $location->add_field([
        'name' => 'Latitude',
        'id'   => 'latitude',
        'type' => 'text',
    ]);

    $location->add_field([
        'name' => 'Longitude',
        'id'   => 'longitude',
        'type' => 'text',
    ]);



    /*
    |--------------------------------------------------------------------------
    | Gallery Images
    |--------------------------------------------------------------------------
    */

    $gallery = new_cmb2_box([
        'id'           => 'gallery_box',
        'title'        => 'Gallery Images',
        'object_types' => ['property'],
    ]);

    $gallery->add_field([
        'name' => 'Gallery Images',
        'id'   => 'gallery_images',
        'type' => 'file_list',
    ]);



    /*
    |--------------------------------------------------------------------------
    | Featured
    |--------------------------------------------------------------------------
    */

    $featured = new_cmb2_box([
        'id'           => 'featured_box',
        'title'        => 'Featured Property',
        'object_types' => ['property'],
    ]);

    $featured->add_field([
        'name' => 'Featured Property',
        'id'   => 'featured_property',
        'type' => 'checkbox',
    ]);
}




add_action('admin_footer', 'plp_property_admin_tabs');

function plp_property_admin_tabs() {

    global $post;

    if (!$post || $post->post_type !== 'property') {
        return;
    }

?>

<style>

#postbox-container-2 {
    display: flex;
    gap: 0;
}

/* Sidebar */

.property-tabs-sidebar {
    width: 240px;
    background: #f6f7f7;
    border: 1px solid #dcdcde;
    border-right: 0;
}

.property-tab-btn {
    width: 100%;
    padding: 18px 20px;
    border: 0;
    border-bottom: 1px solid #dcdcde;
    background: transparent;
    text-align: left;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
}

.property-tab-btn.active {
    background: white;
    color: #2271b1;
}

/* Content */

.property-tab-content {
    flex: 1;
    border: 1px solid #dcdcde;
    background: white;
    padding: 20px;
}

/* Hide all initially */

#basic_info_box,
#location_box,
#gallery_box,
#featured_box {
    display: none;
}

.postbox-header,
.handle-actions {
    display: none !important;
}

.postbox {
    border: 0 !important;
    box-shadow: none !important;
    margin: 0 !important;
}

.inside {
    margin: 0 !important;
    padding: 0 !important;
}

</style>

<script>

jQuery(document).ready(function($){

    const boxes = [
        {
            id: 'basic_info_box',
            label: 'Basic Information'
        },
        {
            id: 'location_box',
            label: 'Location'
        },
        {
            id: 'gallery_box',
            label: 'Gallery Images'
        },
        {
            id: 'featured_box',
            label: 'Featured Property'
        }
    ];

    const sidebar = $('<div class="property-tabs-sidebar"></div>');
    const content = $('<div class="property-tab-content"></div>');

    $('#postbox-container-2').prepend(sidebar);
    $('#postbox-container-2').append(content);

    boxes.forEach((box, index) => {

        sidebar.append(
            `<button type="button" class="property-tab-btn ${index === 0 ? 'active' : ''}" data-target="${box.id}">
                ${box.label}
            </button>`
        );

        content.append($('#' + box.id));

    });

    $('#' + boxes[0].id).show();

    $('.property-tab-btn').on('click', function(){

        const target = $(this).data('target');

        $('.property-tab-btn').removeClass('active');
        $(this).addClass('active');

        boxes.forEach(box => {
            $('#' + box.id).hide();
        });

        $('#' + target).show();

    });

});

</script>

<?php
}