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
 * Get current URL path.
 */
function zarvel_get_current_path() {
    $request_uri = isset($_SERVER['REQUEST_URI'])
        ? wp_unslash($_SERVER['REQUEST_URI'])
        : '';

    $request_path = trim((string) wp_parse_url($request_uri, PHP_URL_PATH), '/');
    $home_path = trim((string) wp_parse_url(home_url('/'), PHP_URL_PATH), '/');

    if ($home_path && strpos($request_path, $home_path) === 0) {
        $request_path = trim(substr($request_path, strlen($home_path)), '/');
    }

    return $request_path;
}


/**
 * Handle Customize Design Request Form
 */
function zarvel_handle_customize_form() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    if (empty($_POST['zarvel_customize_form_submit'])) {
        return;
    }

    if (
        empty($_POST['zarvel_customize_nonce']) ||
        !wp_verify_nonce(
            sanitize_text_field(wp_unslash($_POST['zarvel_customize_nonce'])),
            'zarvel_customize_form_action'
        )
    ) {
        wp_safe_redirect(add_query_arg('request_status', 'security_error', home_url('/customize/')));
        exit;
    }

    /**
     * Honeypot spam protection.
     * Real users should never fill this field.
     */
    if (!empty($_POST['website_url'])) {
        wp_safe_redirect(add_query_arg('request_status', 'spam', home_url('/customize/')));
        exit;
    }

    $full_name       = isset($_POST['full_name']) ? sanitize_text_field(wp_unslash($_POST['full_name'])) : '';
    $email           = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $phone           = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
    $product_type    = isset($_POST['product_type']) ? sanitize_text_field(wp_unslash($_POST['product_type'])) : '';
    $preferred_color = isset($_POST['preferred_color']) ? sanitize_text_field(wp_unslash($_POST['preferred_color'])) : '';
    $preferred_size  = isset($_POST['preferred_size']) ? sanitize_text_field(wp_unslash($_POST['preferred_size'])) : '';
    $deadline        = isset($_POST['deadline']) ? sanitize_text_field(wp_unslash($_POST['deadline'])) : '';
    $design_notes    = isset($_POST['design_notes']) ? sanitize_textarea_field(wp_unslash($_POST['design_notes'])) : '';

    if (
        empty($full_name) ||
        empty($email) ||
        empty($product_type) ||
        empty($design_notes)
    ) {
        wp_safe_redirect(add_query_arg('request_status', 'missing_fields', home_url('/customize/')));
        exit;
    }

    if (!is_email($email)) {
        wp_safe_redirect(add_query_arg('request_status', 'invalid_email', home_url('/customize/')));
        exit;
    }

    /**
     * CHANGE THIS TO YOUR REAL GMAIL.
     */
    $recipient = 'bryanceazartabanas@gmail.com';

    $subject = 'New Custom Design Request - ' . $full_name;

    $message  = "New custom design request\n";
    $message .= "=========================\n\n";
    $message .= "Full Name: {$full_name}\n";
    $message .= "Email: {$email}\n";
    $message .= "Phone: {$phone}\n";
    $message .= "Product Type: {$product_type}\n";
    $message .= "Preferred Color: {$preferred_color}\n";
    $message .= "Preferred Size: {$preferred_size}\n";
    $message .= "Deadline: {$deadline}\n\n";
    $message .= "Design Instructions:\n";
    $message .= "{$design_notes}\n\n";
    $message .= "Sent from: " . home_url('/customize/') . "\n";

    /**
     * Use your domain email as From.
     * Do not use the customer's Gmail as From or Gmail may reject it.
     */
    $from_email = 'no-reply@zarvelcreatives.com';

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: Zarvel Creatives <' . $from_email . '>',
        'Reply-To: ' . $full_name . ' <' . $email . '>',
    ];

    $attachments = [];

    /**
     * File upload.
     * Safe version for now: JPG, JPEG, PNG, PDF only.
     * SVG/AI can be risky unless handled carefully.
     */
    if (!empty($_FILES['upload_file']['name'])) {
        $file = $_FILES['upload_file'];

        $max_file_size = 20 * 1024 * 1024; // 20MB

        if (!empty($file['size']) && $file['size'] > $max_file_size) {
            wp_safe_redirect(add_query_arg('request_status', 'file_too_large', home_url('/customize/')));
            exit;
        }

        $allowed_mimes = [
            'jpg|jpeg|jpe' => 'image/jpeg',
            'png'          => 'image/png',
            'pdf'          => 'application/pdf',
        ];

        require_once ABSPATH . 'wp-admin/includes/file.php';

        $upload = wp_handle_upload($file, [
            'test_form' => false,
            'mimes'     => $allowed_mimes,
        ]);

        if (!empty($upload['error'])) {
            wp_safe_redirect(add_query_arg('request_status', 'upload_error', home_url('/customize/')));
            exit;
        }

        if (!empty($upload['file']) && file_exists($upload['file'])) {
            $attachments[] = $upload['file'];
        }
    }

    $sent = wp_mail($recipient, $subject, $message, $headers, $attachments);

    if ($sent) {
        wp_safe_redirect(add_query_arg('request_status', 'success', home_url('/customize/')));
        exit;
    }

    wp_safe_redirect(add_query_arg('request_status', 'failed', home_url('/customize/')));
    exit;
}
add_action('template_redirect', 'zarvel_handle_customize_form');


/**
 * Custom template router
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