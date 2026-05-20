<?php

/**
 * Helper Functions
 *
 * @package Apollo\Login
 */

declare(strict_types=1);

namespace Apollo\Login;

// Prevent direct access.
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Get plugin instance
 *
 * @return Core\Plugin
 */
function apollo_login(): Core\Plugin
{
    return Core\Plugin::get_instance();
}

/**
 * Canonical front-end login URL (uses APOLLO_LOGIN_CUSTOM_LOGIN_SLUG, default /acesso/).
 */
function apollo_login_canonical_login_url(): string
{
    return trailingslashit(home_url('/' . trim(APOLLO_LOGIN_CUSTOM_LOGIN_SLUG, '/')));
}

/**
 * Canonical register URL (APOLLO_LOGIN_CUSTOM_REGISTER_SLUG, default /registre/).
 */
function apollo_login_register_url(): string
{
    return trailingslashit(home_url('/' . trim(APOLLO_LOGIN_CUSTOM_REGISTER_SLUG, '/')));
}

/**
 * Login URL with query flag that opens the password-recovery overlay (matches login template + overlay JS).
 */
function apollo_login_password_recovery_url(): string
{
    return add_query_arg('quero', 'recuperar-chave', apollo_login_canonical_login_url());
}

/**
 * Path segment after the site (home) path — matches virtual slugs for subdirectory installs.
 *
 * Example: home in /client/ and request /client/registre/ → "registre".
 */
function apollo_login_normalized_request_path(): string
{
    $request_uri = isset($_SERVER['REQUEST_URI']) ? (string) $_SERVER['REQUEST_URI'] : '';
    $raw_path    = parse_url($request_uri, PHP_URL_PATH);
    if (! is_string($raw_path) || $raw_path === '') {
        $raw_path = '';
    }
    $path = trim($raw_path, '/');

    $home_path = parse_url(home_url('/'), PHP_URL_PATH);
    if (! is_string($home_path) || $home_path === '') {
        $home_path = '';
    }
    $home_path = trim($home_path, '/');

    if ($home_path !== '' && $path !== '') {
        if ($path === $home_path) {
            $path = '';
        } else {
            $prefix = $home_path . '/';
            if (str_starts_with($path, $prefix)) {
                $path = trim(substr($path, strlen($prefix)), '/');
            }
        }
    }

    return $path;
}

/**
 * Check if user has completed quiz
 *
 * @param int $user_id User ID.
 * @return bool
 */
function apollo_quiz_completed(int $user_id): bool
{
    $score = get_user_meta($user_id, '_apollo_quiz_score', true);
    return ! empty($score) && $score > 0;
}

/**
 * Check if user is locked out
 *
 * @param int $user_id User ID.
 * @return bool
 */
function apollo_is_locked_out(int $user_id): bool
{
    $lockout_until = get_user_meta($user_id, '_apollo_lockout_until', true);

    if (empty($lockout_until)) {
        return false;
    }

    return time() < (int) $lockout_until;
}

/**
 * Get lockout remaining time in seconds
 *
 * @param int $user_id User ID.
 * @return int
 */
function apollo_lockout_remaining(int $user_id): int
{
    $lockout_until = get_user_meta($user_id, '_apollo_lockout_until', true);

    if (empty($lockout_until)) {
        return 0;
    }

    $remaining = (int) $lockout_until - time();
    return max(0, $remaining);
}

/**
 * Log login attempt
 *
 * @param string $username Username or email.
 * @param bool   $success  Success status.
 * @return void
 */
function apollo_log_login_attempt(string $username, bool $success): void
{
    global $wpdb;

    $table = $wpdb->prefix . APOLLO_LOGIN_TABLE_LOGIN_ATTEMPTS;

    $wpdb->insert(
        $table,
        array(
            'username'     => sanitize_text_field($username),
            'ip_address'   => $_SERVER['REMOTE_ADDR'] ?? '',
            'success'      => $success ? 1 : 0,
            'user_agent'   => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'attempted_at' => current_time('mysql'),
        ),
        array('%s', '%s', '%d', '%s', '%s')
    );
}

/**
 * Get failed login attempts count
 *
 * @param string $identifier Username, email, or IP.
 * @return int
 */
function apollo_get_failed_attempts(string $identifier): int
{
    global $wpdb;

    $table = $wpdb->prefix . APOLLO_LOGIN_TABLE_LOGIN_ATTEMPTS;

    $count = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*) FROM {$table}
			WHERE (username = %s OR ip_address = %s)
			AND success = 0
			AND attempted_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)",
            $identifier,
            $identifier
        )
    );

    return (int) $count;
}

/**
 * Validate CPF (Brazilian document)
 *
 * @param string $cpf CPF number.
 * @return bool
 */
function apollo_validate_cpf(string $cpf): bool
{
    // Remove non-numeric characters
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Check if has 11 digits
    if (strlen($cpf) !== 11) {
        return false;
    }

    // Check for known invalid CPFs
    $invalid = array(
        '00000000000',
        '11111111111',
        '22222222222',
        '33333333333',
        '44444444444',
        '55555555555',
        '66666666666',
        '77777777777',
        '88888888888',
        '99999999999',
    );

    if (in_array($cpf, $invalid, true)) {
        return false;
    }

    // Validate check digits
    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }

    return true;
}

/**
 * Generate email verification token with 24-hour TTL
 *
 * Creates a cryptographically secure 32-char token, stores it in user meta
 * alongside an expiry timestamp (24h from now). Replaces any existing token.
 *
 * @param int $user_id User ID.
 * @return string The generated token.
 */
function apollo_generate_verification_token(int $user_id): string
{
    $token = wp_generate_password(32, false);
    update_user_meta($user_id, '_apollo_verification_token', $token);
    update_user_meta($user_id, '_apollo_verification_token_expiry', time() + DAY_IN_SECONDS);
    return $token;
}

/**
 * Verify email verification token
 *
 * Validates the token against stored value AND checks TTL expiry.
 * On success: marks user as verified, deletes token + expiry.
 * On failure: returns false (token invalid, expired, or missing).
 *
 * @param int    $user_id User ID.
 * @param string $token   Token to verify.
 * @return bool  True on successful verification.
 */
function apollo_verify_email_token(int $user_id, string $token): bool
{
    $saved_token = get_user_meta($user_id, '_apollo_verification_token', true);

    if (empty($saved_token) || ! hash_equals($saved_token, $token)) {
        return false;
    }

    // Check expiry (24h TTL)
    $expiry = (int) get_user_meta($user_id, '_apollo_verification_token_expiry', true);
    if ($expiry > 0 && time() > $expiry) {
        // Token expired — clean up
        delete_user_meta($user_id, '_apollo_verification_token');
        delete_user_meta($user_id, '_apollo_verification_token_expiry');
        return false;
    }

    // Mark as verified
    update_user_meta($user_id, '_apollo_email_verified', true);
    update_user_meta($user_id, '_apollo_membership', 'verificado');
    delete_user_meta($user_id, '_apollo_verification_token');
    delete_user_meta($user_id, '_apollo_verification_token_expiry');

    /**
     * Fires after a user successfully verifies their email.
     *
     * @since 1.0.0
     * @param int $user_id Verified user ID.
     */
    do_action('apollo/login/email_verified', $user_id);

    return true;
}

/**
 * Generate a random token
 *
 * @param int $length Token length.
 * @return string
 */
function apollo_login_generate_token(int $length = 64): string
{
    return bin2hex(random_bytes(max(1, intval($length / 2))));
}

/**
 * Send a login-related email via apollo-email or plain wp_mail() fallback.
 *
 * Fires `apollo/login/send_email` so apollo-email can intercept and template
 * the message. When apollo-email is not active the function falls back to a
 * plain-text wp_mail() call so the feature still works without the mailer.
 *
 * @param string $to      Recipient email address.
 * @param string $subject Email subject.
 * @param string $message Plain-text body (used as fallback).
 * @param string $type    Email type slug (e.g. 'password_reset', 'verification').
 * @param array  $data    Extra data passed to apollo-email for templating.
 * @return bool           Whether the email was accepted for delivery.
 */
function apollo_login_send_email(
    string $to,
    string $subject,
    string $message,
    string $type = 'transactional',
    array $data = array()
): bool {
    /**
     * Let apollo-email intercept and send a templated version.
     * Listeners should set the 'intercepted' key to true when they handle it.
     *
     * @param array{to: string, subject: string, message: string, type: string, data: array, intercepted: bool} $payload
     */
    $payload = apply_filters(
        'apollo/login/send_email', // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
        array(
            'to'          => $to,
            'subject'     => $subject,
            'message'     => $message,
            'type'        => $type,
            'data'        => $data,
            'intercepted' => false,
        )
    );

    if (! empty($payload['intercepted'])) {
        return true;
    }

    // Plain-text fallback when apollo-email is not active.
    return wp_mail(
        $to,
        $subject,
        $message,
        array('Content-Type: text/plain; charset=UTF-8')
    );
}
