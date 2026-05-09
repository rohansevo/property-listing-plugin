<?php
/*

add_filter('the_content', 'property_listing_show_property_data');

function property_listing_show_property_data($content) {

    // Only for property post type
    if (!is_singular('property')) {
        return $content;
    }

    // Get values
    $price     = get_post_meta(get_the_ID(), 'price', true);
    $bedrooms  = get_post_meta(get_the_ID(), 'bedrooms', true);
    $location  = get_post_meta(get_the_ID(), 'location', true);
    $lat       = get_post_meta(get_the_ID(), 'latitude', true);
    $lng       = get_post_meta(get_the_ID(), 'longitude', true);

    // Build HTML
    $custom_content = '<div class="property-details">';
    $custom_content .= '<p><strong>Price:</strong> ' . esc_html($price) . '</p>';
    $custom_content .= '<p><strong>Bedrooms:</strong> ' . esc_html($bedrooms) . '</p>';
    $custom_content .= '<p><strong>Location:</strong> ' . esc_html($location) . '</p>';

    // Add iframe map (only if lat/lng exist)
    if (!empty($lat) && !empty($lng)) {
        $custom_content .= '
            <iframe
                width="100%"
                height="300"
                frameborder="0"
                style="border:0; margin-top:10px;"
                src="https://maps.google.com/maps?q=' . esc_attr($lat) . ',' . esc_attr($lng) . '&z=15&output=embed"
                allowfullscreen>
            </iframe>
        ';
    }

    $custom_content .= '</div>';

    // Append after content
    return $content . $custom_content;
}

*/