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

     // Get filter values from URL
    $price     = $request->get_param('price');
    $bedrooms  = $request->get_param('bedrooms');
    $location  = $request->get_param('location');

    $meta_query = [];

    // Filter: Price
    if (!empty($price)) {

    // 50000 Above
    if ($price === '50000-plus') {

        $meta_query[] = [
            'key'     => 'price',
            'value'   => 50000,
            'compare' => '>=',
            'type'    => 'NUMERIC'
        ];

    } else {

        // Example: 40000-50000
        $price_range = explode('-', $price);

        if (count($price_range) === 2) {

            $min_price = (int) $price_range[0];
            $max_price = (int) $price_range[1];

            $meta_query[] = [
                'key'     => 'price',
                'value'   => [$min_price, $max_price],
                'compare' => 'BETWEEN',
                'type'    => 'NUMERIC'
            ];
        }
    }
}

     // Filter: Bedrooms
    if (!empty($bedrooms)) {
        $meta_query[] = [
            'key'     => 'bedrooms',
            'value'   => $bedrooms,
            'compare' => '='
        ];
    }

    // Filter: Location (partial match)
    if (!empty($location)) {
        $meta_query[] = [
            'key'     => 'location',
            'value'   => $location,
            'compare' => 'LIKE'
        ];
    }

    //Query Args
    $args = [
        'post_type'      => 'property',
        'posts_per_page' => -1,
        'meta_query'     => $meta_query,
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
                'image' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
                'bedrooms'  => get_post_meta(get_the_ID(), 'bedrooms', true),
                'location'  => get_post_meta(get_the_ID(), 'location', true),   
            ];
        }
        wp_reset_postdata();
    }

    return $data;
}