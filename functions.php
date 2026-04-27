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


/**
 * Custom template router
 * This allows page templates to live inside /pages/
 */
function zarvel_custom_template_router($template) {
    if (is_admin()) {
        return $template;
    }

    $front_page_template     = get_template_directory() . '/pages/front-page.php';
    $single_product_template = get_template_directory() . '/pages/single-product.php';

    if (is_front_page() && file_exists($front_page_template)) {
        return $front_page_template;
    }

    if (
        (function_exists('is_product') && is_product()) ||
        is_singular('product')
    ) {
        if (file_exists($single_product_template)) {
            return $single_product_template;
        }
    }

    return $template;
}
add_filter('template_include', 'zarvel_custom_template_router', 99);