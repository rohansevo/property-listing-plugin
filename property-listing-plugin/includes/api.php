<?php


//Create API URL - /wp-json/plp/v1/properties?price=100000&bedrooms=3&location=New+York
add_action('rest_api_init', function () {

    register_rest_route('plp/v1', '/properties', [
        'methods'  => 'GET',
        'callback' => 'plp_get_properties',
    ]);

});

//API Callback
function plp_get_properties($request) {

    // Get filter values
    $price     = $request->get_param('price');
    $bedrooms  = $request->get_param('bedrooms');
    $location  = $request->get_param('location');
    $tab = $request->get_param('tab');

    $meta_query = [];
    $tax_query  = [];

    // Property Category Filter
    if (!empty($tab)) {

    $tax_query[] = [
        'taxonomy' => 'property_category',
        'field'    => 'name',
        'terms'    => $tab,
    ];
    }

    // Price Filter
    if (!empty($price)) {

        if ($price === '50000-plus') {

            $meta_query[] = [
                'key'     => 'price',
                'value'   => 50000,
                'compare' => '>=',
                'type'    => 'NUMERIC'
            ];

        } else {

            $price_range = explode('-', $price);

            if (count($price_range) === 2) {

                $meta_query[] = [
                    'key'     => 'price',
                    'value'   => [(int)$price_range[0], (int)$price_range[1]],
                    'compare' => 'BETWEEN',
                    'type'    => 'NUMERIC'
                ];
            }
        }
    }

    // Bedrooms Filter (FIXED)
    if (!empty($bedrooms)) {

        $tax_query[] = [
            'taxonomy' => 'property_bedroom',
            'field'    => 'name',
            'terms'    => $bedrooms,
        ];
    }

    // Location Filter
    if (!empty($location)) {

        $meta_query[] = [
            'key'     => 'location',
            'value'   => $location,
            'compare' => 'LIKE'
        ];
    }

    // Query Args
    $args = [
        'post_type'      => 'property',
        'posts_per_page' => -1,
        'meta_query'     => $meta_query,
        'tax_query'      => $tax_query,
    ];

    $query = new WP_Query($args);

    $data = [];

    if ($query->have_posts()) {

        while ($query->have_posts()) {

            $query->the_post();

            $data[] = [
                'id'        => get_the_ID(),
                'title'     => get_the_title(),
                'price'     => get_post_meta(get_the_ID(), 'price', true),
                'image'     => get_the_post_thumbnail_url(get_the_ID(), 'full'),

                // FIXED
                'bedrooms'  => wp_get_post_terms(
                    get_the_ID(),
                    'property_bedroom',
                    ['fields' => 'names']
                ),

                'location'  => get_post_meta(get_the_ID(), 'location', true),
            ];
        }

        wp_reset_postdata();
    }

    return $data;
}





function property_featured_api() {

    register_rest_route('properties', '/featured-properties', [

        'methods' => 'GET',

        'callback' => function () {

            $query = new WP_Query([
                'post_type' => 'property',
                'posts_per_page' => 6,
                'meta_query' => [
                    [
                        'key' => 'featured_property',
                        'value'   => 'on',
                        'compare' => '='
                    ]
                ]
            ]);

            $properties = [];

            while ($query->have_posts()) {

                $query->the_post();

                $properties[] = [
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'image' => get_the_post_thumbnail_url(get_the_ID(), 'large'),
                    'link' => get_permalink(),
                    'price'     => get_post_meta(get_the_ID(), 'price', true),
                    'bedrooms' => wp_get_post_terms(get_the_ID(),'property_bedroom',['fields' => 'names']),
                    'location'  => get_post_meta(get_the_ID(), 'location', true),   
                ];
            }

            wp_reset_postdata();

            return $properties;
        }
    ]);
}

add_action('rest_api_init', 'property_featured_api');









function property_new_launch_api() {

    register_rest_route('properties', '/new-launch-projects', [

        'methods' => 'GET',

        'callback' => function () {

            $query = new WP_Query([

                'post_type' => 'property',

                'posts_per_page' => 6,

                'post_status' => 'publish',

                'orderby' => 'date',

                'order' => 'DESC',

                'date_query' => [
                [
                'after' => '5 days ago'
                ]
    ]
            ]);

            $projects = [];

            while ($query->have_posts()) {

                $query->the_post();

                $projects[] = [

                    'id' => get_the_ID(),

                    'title' => get_the_title(),

                    'image' => get_the_post_thumbnail_url(
                        get_the_ID(),
                        'large'
                    ),

                    'date' => get_the_date('d M Y'),

                    'link' => get_permalink(),
                ];
            }

            wp_reset_postdata();

            return $projects;
        }
    ]);
}

add_action('rest_api_init', 'property_new_launch_api');