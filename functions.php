<?php

function zarvel_creative_assets() {
    wp_enqueue_style(
        'zarvel-creative-style',
        get_stylesheet_uri(),
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'zarvel_creative_assets');

function zarvel_creative_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');

    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer'  => 'Footer Menu',
    ));
}
add_action('after_setup_theme', 'zarvel_creative_setup');