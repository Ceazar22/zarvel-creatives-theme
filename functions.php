<?php
function zarvel_custom_template_router($template) {
    if (is_admin()) {
        return $template;
    }

    $front_page_template = get_template_directory() . '/pages/front-page.php';
    $single_product_template = get_template_directory() . '/pages/single-product.php';

    if (is_front_page() && file_exists($front_page_template)) {
        return $front_page_template;
    }

    if (
        (
            function_exists('is_product') && is_product()
        ) ||
        is_singular('product')
    ) {
        if (file_exists($single_product_template)) {
            return $single_product_template;
        }
    }

    return $template;
}
add_filter('template_include', 'zarvel_custom_template_router', 99);
?>