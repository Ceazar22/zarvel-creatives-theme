<?php
defined('ABSPATH') || exit;

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

    if (!empty($_POST['website_url'])) {
        wp_safe_redirect(add_query_arg('request_status', 'spam', home_url('/customize/')));
        exit;
    }

    $full_name       = isset($_POST['full_name']) ? sanitize_text_field(wp_unslash($_POST['full_name'])) : '';
    $email           = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $phone           = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
    $product_type    = isset($_POST['product_type']) ? sanitize_text_field(wp_unslash($_POST['product_type'])) : '';
    $logo_status     = isset($_POST['logo_status']) ? sanitize_text_field(wp_unslash($_POST['logo_status'])) : '';
    $preferred_color = isset($_POST['preferred_color']) ? sanitize_text_field(wp_unslash($_POST['preferred_color'])) : '';
    $preferred_size  = isset($_POST['preferred_size']) ? sanitize_text_field(wp_unslash($_POST['preferred_size'])) : '';
    $deadline        = isset($_POST['deadline']) ? sanitize_text_field(wp_unslash($_POST['deadline'])) : '';
    $design_notes    = isset($_POST['design_notes']) ? sanitize_textarea_field(wp_unslash($_POST['design_notes'])) : '';

    if (
        empty($full_name) ||
        empty($email) ||
        empty($product_type) ||
        empty($logo_status) ||
        empty($design_notes)
    ) {
        wp_safe_redirect(add_query_arg('request_status', 'missing_fields', home_url('/customize/')));
        exit;
    }

    if (!is_email($email)) {
        wp_safe_redirect(add_query_arg('request_status', 'invalid_email', home_url('/customize/')));
        exit;
    }

    $recipient = 'bryanceazartabanas@gmail.com';

    $subject = 'New Custom Design Request - ' . $full_name;

    $message  = "New custom design request\n";
    $message .= "=========================\n\n";
    $message .= "Full Name: {$full_name}\n";
    $message .= "Email: {$email}\n";
    $message .= "Phone: {$phone}\n";
    $message .= "Product Type: {$product_type}\n";
    $message .= "Logo / Design Status: {$logo_status}\n";
    $message .= "Preferred Color: {$preferred_color}\n";
    $message .= "Preferred Size: {$preferred_size}\n";
    $message .= "Deadline: {$deadline}\n\n";
    $message .= "Design Instructions:\n";
    $message .= "{$design_notes}\n\n";
    $message .= "Sent from: " . home_url('/customize/') . "\n";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: Zarvel Creatives <bryanceazartabanas@gmail.com>',
        'Reply-To: ' . $full_name . ' <' . $email . '>',
    ];

    $attachments = [];

    if (!empty($_FILES['upload_file']['name'])) {
        $file = $_FILES['upload_file'];

        $max_file_size = 20 * 1024 * 1024;

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