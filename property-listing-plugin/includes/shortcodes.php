<?php

// React App Shortcode
function plp_react_app_shortcode() {
    return '<div id="root" style="max-width:1200px;"></div>';
}
add_shortcode('plp_app', 'plp_react_app_shortcode');





/*
add_shortcode('plp_filter', 'plp_filter_ui');

function plp_filter_ui() {

    ob_start();
    ?>

    <form id="plp-filter-form">
        <input type="text" id="price" placeholder="Price">
        <input type="text" id="bedrooms" placeholder="Bedrooms">
        <input type="text" id="location" placeholder="Location">
        <button type="submit">Search</button>
    </form>
 
    <div id="plp-results"></div>

    <?php
    return ob_get_clean();
}
*/



