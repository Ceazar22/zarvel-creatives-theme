<?php
/**
 * Handle Customize Design Request Form
 */
function zarvel_handle_design_request_form() {
    if (
        !isset($_POST['zarvel_design_request_submit']) ||
        !isset($_POST['zarvel_design_request_nonce'])
    ) {
        return;
    }

    if (!wp_verify_nonce($_POST['zarvel_design_request_nonce'], 'zarvel_design_request_action')) {
        wp_safe_redirect(add_query_arg('design_request', 'security_error', wp_get_referer()));
        exit;
    }

    /**
     * Honeypot spam protection
     * Real users will not fill this field.
     */
    if (!empty($_POST['website'])) {
        wp_safe_redirect(add_query_arg('design_request', 'spam', wp_get_referer()));
        exit;
    }

    $name         = isset($_POST['customer_name']) ? sanitize_text_field(wp_unslash($_POST['customer_name'])) : '';
    $email        = isset($_POST['customer_email']) ? sanitize_email(wp_unslash($_POST['customer_email'])) : '';
    $phone        = isset($_POST['customer_phone']) ? sanitize_text_field(wp_unslash($_POST['customer_phone'])) : '';
    $product_type = isset($_POST['product_type']) ? sanitize_text_field(wp_unslash($_POST['product_type'])) : '';
    $color        = isset($_POST['preferred_color']) ? sanitize_text_field(wp_unslash($_POST['preferred_color'])) : '';
    $size         = isset($_POST['preferred_size']) ? sanitize_text_field(wp_unslash($_POST['preferred_size'])) : '';
    $deadline     = isset($_POST['deadline']) ? sanitize_text_field(wp_unslash($_POST['deadline'])) : '';
    $message      = isset($_POST['design_notes']) ? sanitize_textarea_field(wp_unslash($_POST['design_notes'])) : '';

    if (empty($name) || empty($email) || empty($product_type) || empty($message)) {
        wp_safe_redirect(add_query_arg('design_request', 'missing_fields', wp_get_referer()));
        exit;
    }

    if (!is_email($email)) {
        wp_safe_redirect(add_query_arg('design_request', 'invalid_email', wp_get_referer()));
        exit;
    }

    /**
     * Replace this with your real Gmail.
     */
    $recipient = 'yourgmail@gmail.com';

    $subject = 'New Custom Design Request from ' . $name;

    $body  = "New custom design request:\n\n";
    $body .= "Name: {$name}\n";
    $body .= "Email: {$email}\n";
    $body .= "Phone: {$phone}\n";
    $body .= "Product Type: {$product_type}\n";
    $body .= "Preferred Color: {$color}\n";
    $body .= "Preferred Size: {$size}\n";
    $body .= "Deadline: {$deadline}\n\n";
    $body .= "Design Notes:\n{$message}\n\n";
    $body .= "Sent from: " . home_url('/customize/') . "\n";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>',
    ];

    $attachments = [];

    /**
     * File upload handling
     */
    if (!empty($_FILES['design_file']['name'])) {
        $file = $_FILES['design_file'];

        $allowed_types = [
            'jpg|jpeg|jpe' => 'image/jpeg',
            'png'          => 'image/png',
            'pdf'          => 'application/pdf',
        ];

        $max_size = 8 * 1024 * 1024; // 8MB

        if (!empty($file['size']) && $file['size'] > $max_size) {
            wp_safe_redirect(add_query_arg('design_request', 'file_too_large', wp_get_referer()));
            exit;
        }

        require_once ABSPATH . 'wp-admin/includes/file.php';

        $upload = wp_handle_upload($file, [
            'test_form' => false,
            'mimes'     => $allowed_types,
        ]);

        if (!empty($upload['error'])) {
            wp_safe_redirect(add_query_arg('design_request', 'upload_error', wp_get_referer()));
            exit;
        }

        if (!empty($upload['file']) && file_exists($upload['file'])) {
            $attachments[] = $upload['file'];
        }
    }

    $sent = wp_mail($recipient, $subject, $body, $headers, $attachments);

    if ($sent) {
        wp_safe_redirect(add_query_arg('design_request', 'success', wp_get_referer()));
        exit;
    }

    wp_safe_redirect(add_query_arg('design_request', 'failed', wp_get_referer()));
    exit;
}
add_action('template_redirect', 'zarvel_handle_design_request_form');