<?php

// React App Shortcode
function plp_react_app_shortcode() {
    return '<div id="root" style="max-width:1200px;"></div>';
}
add_shortcode('plp_app', 'plp_react_app_shortcode');

