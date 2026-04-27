<?php
defined('ABSPATH') || exit;

/**
 * Gmail SMTP setup
 */
function zarvel_configure_smtp_mailer($phpmailer) {
    $phpmailer->isSMTP();

    $phpmailer->Host       = 'smtp.gmail.com';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 587;
    $phpmailer->SMTPSecure = 'tls';

    $phpmailer->Username   = 'bryanceazartabanas@gmail.com';
    $phpmailer->Password   = 'ofsx tflh vbbg fllf';

    $phpmailer->From       = 'bryanceazartabanas@gmail.com';
    $phpmailer->FromName   = 'Zarvel Creatives';
}
add_action('phpmailer_init', 'zarvel_configure_smtp_mailer');


/**
 * Log mail errors
 */
function zarvel_log_mail_errors($wp_error) {
    error_log('Zarvel mail error: ' . print_r($wp_error, true));
}
add_action('wp_mail_failed', 'zarvel_log_mail_errors');