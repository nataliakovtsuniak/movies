<?php

function custom_admin_scripts(){
    wp_enqueue_style('admin_css', get_template_directory_uri().'-child/assets/css/admin-styles.css');
}
add_action('admin_enqueue_scripts', 'custom_admin_scripts');