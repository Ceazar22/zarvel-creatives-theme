<?php
defined('ABSPATH') || exit;

/**
 * Gmail SMTP setup
 *
 * SMTP credentials should come from wp-config.php constants,
 * which should read from your Docker .env file.
 */
function zarvel_configure_smtp_mailer($phpmailer) {
    if (
        !defined('ZARVEL_SMTP_HOST') ||
        !defined('ZARVEL_SMTP_PORT') ||
        !defined('ZARVEL_SMTP_SECURE') ||
        !defined('ZARVEL_SMTP_USER') ||
        !defined('ZARVEL_SMTP_PASS') ||
        !defined('ZARVEL_SMTP_FROM') ||
        !defined('ZARVEL_SMTP_FROM_NAME')
    ) {
        return;
    }

    if (empty(ZARVEL_SMTP_USER) || empty(ZARVEL_SMTP_PASS)) {
        return;
    }

    $phpmailer->isSMTP();

    $phpmailer->Host       = ZARVEL_SMTP_HOST;
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = ZARVEL_SMTP_PORT;
    $phpmailer->SMTPSecure = ZARVEL_SMTP_SECURE;

    $phpmailer->Username   = ZARVEL_SMTP_USER;
    $phpmailer->Password   = ZARVEL_SMTP_PASS;

    $phpmailer->From       = ZARVEL_SMTP_FROM;
    $phpmailer->FromName   = ZARVEL_SMTP_FROM_NAME;

    $phpmailer->Sender     = ZARVEL_SMTP_FROM;
}
add_action('phpmailer_init', 'zarvel_configure_smtp_mailer');

/**
 * Log mail errors safely.
 */
function zarvel_log_mail_errors($wp_error) {
    if (is_wp_error($wp_error)) {
        error_log('Zarvel mail error: ' . $wp_error->get_error_message());
    }
}
add_action('wp_mail_failed', 'zarvel_log_mail_errors');