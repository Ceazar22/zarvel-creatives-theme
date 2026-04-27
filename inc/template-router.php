<?php
defined('ABSPATH') || exit;

/**
 * Get current URL path.
 */
function zarvel_get_current_path() {
    $request_uri = isset($_SERVER['REQUEST_URI'])
        ? sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI']))
        : '';

    $request_path = trim((string) wp_parse_url($request_uri, PHP_URL_PATH), '/');
    $home_path    = trim((string) wp_parse_url(home_url('/'), PHP_URL_PATH), '/');

    if ($home_path && strpos($request_path, $home_path) === 0) {
        $request_path = trim(substr($request_path, strlen($home_path)), '/');
    }

    return $request_path;
}

/**
 * Custom template router.
 */
function zarvel_custom_template_router($template) {
    if (is_admin()) {
        return $template;
    }

    $front_page_template       = get_template_directory() . '/pages/front-page.php';
    $single_product_template   = get_template_directory() . '/pages/single-product.php';
    $product_category_template = get_template_directory() . '/pages/product-category.php';
    $customize_template        = get_template_directory() . '/pages/customize.php';

    $current_path = zarvel_get_current_path();

    if ($current_path === 'customize' && file_exists($customize_template)) {
        global $wp_query;

        if ($wp_query) {
            $wp_query->is_404 = false;
        }

        status_header(200);

        return $customize_template;
    }

    if (is_front_page() && file_exists($front_page_template)) {
        return $front_page_template;
    }

    if (
        ((function_exists('is_product') && is_product()) || is_singular('product')) &&
        file_exists($single_product_template)
    ) {
        return $single_product_template;
    }

    if (
        function_exists('is_product_category') &&
        is_product_category() &&
        file_exists($product_category_template)
    ) {
        return $product_category_template;
    }

    return $template;
}
add_filter('template_include', 'zarvel_custom_template_router', 99);