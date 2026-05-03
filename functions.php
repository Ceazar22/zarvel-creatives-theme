<?php
defined('ABSPATH') || exit;

/**
 * Zarvel Creative functions.php
 * Main theme loader + small hardening layer.
 */

/**
 * Safely load theme files.
 */
function zarvel_require_file($relative_path) {
    $file = get_theme_file_path($relative_path);

    if (file_exists($file) && is_readable($file)) {
        require_once $file;
    }
}

/**
 * Theme includes
 */
zarvel_require_file('/inc/theme-setup.php');
zarvel_require_file('/inc/smtp.php');
zarvel_require_file('/inc/customize-form-handler.php');
zarvel_require_file('/inc/template-router.php');

/**
 * Basic security headers.
 * Keep this light so WooCommerce / Printful / admin stuff does not break.
 */
add_action('send_headers', function () {
    if (headers_sent()) {
        return;
    }

    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
});

/**
 * Disable XML-RPC if you are not using Jetpack, WordPress mobile app,
 * or external apps that need XML-RPC.
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Block simple author ID scanning like:
 * yoursite.com/?author=1
 */
add_action('template_redirect', function () {
    if (is_admin() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
        return;
    }

    if (isset($_GET['author']) && preg_match('/^\d+$/', (string) $_GET['author'])) {
        wp_safe_redirect(home_url('/'), 301);
        exit;
    }
});

/**
 * Block anonymous REST API user listing.
 * Helps hide usernames from:
 * /wp-json/wp/v2/users
 */
add_filter('rest_authentication_errors', function ($result) {
    if (!empty($result)) {
        return $result;
    }

    $request_uri = isset($_SERVER['REQUEST_URI'])
        ? sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI']))
        : '';

    if (!is_user_logged_in() && preg_match('#/wp-json/wp/v2/users#i', $request_uri)) {
        return new WP_Error(
            'zarvel_rest_users_blocked',
            __('REST user access blocked.', 'zarvel-creative'),
            array('status' => 401)
        );
    }

    return $result;
});