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

    $redirect_url = home_url('/customize/');

    /**
     * Nonce security check.
     */
    if (
        empty($_POST['zarvel_customize_nonce']) ||
        !wp_verify_nonce(
            sanitize_text_field(wp_unslash($_POST['zarvel_customize_nonce'])),
            'zarvel_customize_form_action'
        )
    ) {
        wp_safe_redirect(add_query_arg('request_status', 'security_error', $redirect_url));
        exit;
    }

    /**
     * Honeypot spam protection.
     * Real users should never fill this field.
     */
    if (!empty($_POST['website_url'])) {
        wp_safe_redirect(add_query_arg('request_status', 'spam', $redirect_url));
        exit;
    }

    /**
     * Basic rate limit by IP.
     * Helps stop repeated spam submissions.
     */
    $user_ip = isset($_SERVER['REMOTE_ADDR'])
        ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR']))
        : 'unknown';

    $rate_limit_key = 'zarvel_customize_form_' . md5($user_ip);

    if (get_transient($rate_limit_key)) {
        wp_safe_redirect(add_query_arg('request_status', 'too_many_requests', $redirect_url));
        exit;
    }

    set_transient($rate_limit_key, true, 60); // 1 submit per 60 seconds per IP

    /**
     * Sanitize fields.
     */
    $full_name    = isset($_POST['full_name']) ? sanitize_text_field(wp_unslash($_POST['full_name'])) : '';
    $email        = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $phone        = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
    $product_type = isset($_POST['product_type']) ? sanitize_text_field(wp_unslash($_POST['product_type'])) : '';
    $logo_status  = isset($_POST['logo_status']) ? sanitize_text_field(wp_unslash($_POST['logo_status'])) : '';
    $design_notes = isset($_POST['design_notes']) ? sanitize_textarea_field(wp_unslash($_POST['design_notes'])) : '';

    /**
     * Required fields.
     */
    if (
        empty($full_name) ||
        empty($email) ||
        empty($product_type) ||
        empty($logo_status) ||
        empty($design_notes)
    ) {
        wp_safe_redirect(add_query_arg('request_status', 'missing_fields', $redirect_url));
        exit;
    }

    /**
     * Validate email.
     */
    if (!is_email($email)) {
        wp_safe_redirect(add_query_arg('request_status', 'invalid_email', $redirect_url));
        exit;
    }

    /**
     * Allow only your real product options.
     * Make sure these values match your form <option value=""> values.
     */
    $allowed_product_types = array(
        't-shirt',
        'hoodie',
        'mug',
        'tote-bag',
        'phone-case',
    );

    if (!in_array($product_type, $allowed_product_types, true)) {
        wp_safe_redirect(add_query_arg('request_status', 'invalid_product', $redirect_url));
        exit;
    }

    /**
     * Allow only your real logo/design options.
     * Make sure these values match your form radio/select values.
     */
    $allowed_logo_statuses = array(
        'has-logo',
        'needs-design',
        'has-idea-only',
    );

    if (!in_array($logo_status, $allowed_logo_statuses, true)) {
        wp_safe_redirect(add_query_arg('request_status', 'invalid_logo_status', $redirect_url));
        exit;
    }

    /**
     * Human-readable labels for email.
     */
    $product_type_labels = array(
        't-shirt'    => 'T-Shirt',
        'hoodie'     => 'Hoodie',
        'mug'        => 'Mug',
        'tote-bag'   => 'Tote Bag',
        'phone-case' => 'Phone Case',
    );

    $logo_status_labels = array(
        'has-logo'      => 'Customer already has a logo/design and may upload it.',
        'needs-design'  => 'Customer wants Zarvel Creatives to create the design/logo.',
        'has-idea-only' => 'Customer has an idea only and needs help turning it into a design.',
    );

    $product_type_label = isset($product_type_labels[$product_type])
        ? $product_type_labels[$product_type]
        : $product_type;

    $logo_status_label = isset($logo_status_labels[$logo_status])
        ? $logo_status_labels[$logo_status]
        : $logo_status;

    /**
     * Email setup.
     */
    $recipient = 'bryanceazartabanas@gmail.com';
    $subject   = 'New Custom Design Request - ' . $full_name;

    $message  = "New custom design request\n";
    $message .= "=========================\n\n";
    $message .= "Customer Details\n";
    $message .= "----------------\n";
    $message .= "Full Name: {$full_name}\n";
    $message .= "Email: {$email}\n";
    $message .= "Phone: {$phone}\n\n";

    $message .= "Product Request\n";
    $message .= "---------------\n";
    $message .= "Product Type: {$product_type_label}\n";
    $message .= "Logo / Design Status: {$logo_status_label}\n\n";

    $message .= "Design Instructions\n";
    $message .= "-------------------\n";
    $message .= "{$design_notes}\n\n";

    $message .= "Admin Note\n";
    $message .= "----------\n";

    if ($logo_status === 'needs-design') {
        $message .= "This customer wants Zarvel Creatives to design the logo/artwork.\n";
    } elseif ($logo_status === 'has-logo') {
        $message .= "This customer says they already have a logo/design. Check if a file is attached.\n";
    } elseif ($logo_status === 'has-idea-only') {
        $message .= "This customer has an idea but may need design help.\n";
    }

    $message .= "\nSent from: " . home_url('/customize/') . "\n";

    /**
     * Safe email headers.
     */
    $safe_reply_name = str_replace(array("\r", "\n"), '', $full_name);
    $safe_reply_mail = str_replace(array("\r", "\n"), '', $email);

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: Zarvel Creatives <bryanceazartabanas@gmail.com>',
        'Reply-To: ' . $safe_reply_name . ' <' . $safe_reply_mail . '>',
    );

    $attachments = array();

    /**
     * File upload.
     * Safe version: JPG, JPEG, PNG, PDF only.
     */
    if (!empty($_FILES['upload_file']['name'])) {
        $file = $_FILES['upload_file'];

        if (!isset($file['error']) || is_array($file['error'])) {
            wp_safe_redirect(add_query_arg('request_status', 'upload_error', $redirect_url));
            exit;
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            wp_safe_redirect(add_query_arg('request_status', 'upload_error', $redirect_url));
            exit;
        }

        $max_file_size = 20 * 1024 * 1024; // 20MB

        if (empty($file['size']) || $file['size'] > $max_file_size) {
            wp_safe_redirect(add_query_arg('request_status', 'file_too_large', $redirect_url));
            exit;
        }

        $allowed_mimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'png'          => 'image/png',
            'pdf'          => 'application/pdf',
        );

        require_once ABSPATH . 'wp-admin/includes/file.php';

        $upload = wp_handle_upload($file, array(
            'test_form' => false,
            'mimes'     => $allowed_mimes,
        ));

        if (!empty($upload['error'])) {
            wp_safe_redirect(add_query_arg('request_status', 'upload_error', $redirect_url));
            exit;
        }

        if (!empty($upload['file']) && file_exists($upload['file'])) {
            $attachments[] = $upload['file'];
        }
    }

    /**
     * Send email.
     */
    $sent = wp_mail($recipient, $subject, $message, $headers, $attachments);

    /**
     * Delete uploaded file after sending email.
     * This prevents customer uploads from sitting publicly in /uploads/.
     */
    if (!empty($attachments)) {
        foreach ($attachments as $attachment) {
            if (file_exists($attachment)) {
                wp_delete_file($attachment);
            }
        }
    }

    if ($sent) {
        wp_safe_redirect(add_query_arg('request_status', 'success', $redirect_url));
        exit;
    }

    wp_safe_redirect(add_query_arg('request_status', 'failed', $redirect_url));
    exit;
}
add_action('template_redirect', 'zarvel_handle_customize_form');