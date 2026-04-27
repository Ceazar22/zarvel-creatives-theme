<?php
defined('ABSPATH') || exit;

/**
 * Theme setup
 */
function zarvel_creative_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('woocommerce');

    register_nav_menus([
        'primary' => 'Primary Menu',
        'footer'  => 'Footer Menu',
    ]);
}
add_action('after_setup_theme', 'zarvel_creative_setup');


/**
 * Load main stylesheet
 */
function zarvel_creative_scripts() {
    wp_enqueue_style(
        'zarvel-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'zarvel_creative_scripts');