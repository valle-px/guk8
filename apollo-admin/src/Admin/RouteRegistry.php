<?php
/**
 * Route Registry
 *
 * Maps every CPanel field key (as used in name="apollo[key]" attributes
 * in the section partials) to a real WordPress option and its sanitisation type.
 *
 * cpanel_key names match the actual name="apollo[KEY]" attributes in the
 * section partials. Other plugins extend this via
 * add_filter('apollo_admin_route_map', …).
 *
 * @package Apollo\Admin\Admin
 */

declare(strict_types=1);

namespace Apollo\Admin\Admin;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class RouteRegistry {

    /**
     * Build the full map.
     *
     * Format: 'cpanel_key' => ['option' => 'wp_option_name', 'type' => 'text|bool|…', 'default' => …]
     *
     * @return array<string,array{option:string,type:string,default:mixed}>
     */
    public static function build(): array {
        return [
            /* ── SYSTEM / GLOBAL (overview.php) ───────────────────── */
            'site_name'        => [ 'option' => 'blogname',            'type' => 'text',   'default' => '' ],
            'site_description' => [ 'option' => 'blogdescription',     'type' => 'text',   'default' => '' ],
            'language'         => [ 'option' => 'WPLANG',              'type' => 'select', 'default' => 'pt_BR' ],
            'timezone'         => [ 'option' => 'timezone_string',     'type' => 'text',   'default' => 'America/Sao_Paulo' ],
            'cdn_url'          => [ 'option' => 'apollo_cdn_url',      'type' => 'url',    'default' => '' ],
            'debug_mode'       => [ 'option' => 'apollo_debug_mode',   'type' => 'bool',   'default' => false ],
            'gmaps_key'        => [ 'option' => 'apollo_gmaps_key',    'type' => 'text',   'default' => '' ],
            'recaptcha_key'    => [ 'option' => 'apollo_recaptcha_site_key',   'type' => 'text', 'default' => '' ],
            'recaptcha_secret' => [ 'option' => 'apollo_recaptcha_secret_key', 'type' => 'text', 'default' => '' ],
            'recaptcha_on_login' => [ 'option' => 'apollo_recaptcha_on_login', 'type' => 'bool', 'default' => true ],

            /* ── SYSTEM CORE (system/core.php actual keys) ─────────── */
            'core_cdn_url'     => [ 'option' => 'apollo_cdn_url',      'type' => 'url',    'default' => '' ],
            'core_debug'       => [ 'option' => 'apollo_debug_mode',   'type' => 'bool',   'default' => false ],

            /* ── SYSTEM SECURITY (system/security.php actual keys) ─── */
            'sec_lockout_attempts' => [ 'option' => 'apollo_max_login_attempts', 'type' => 'int',  'default' => 5 ],
            'sec_lockout_duration' => [ 'option' => 'apollo_lockout_duration',   'type' => 'int',  'default' => 15 ],

            /* ── IDENTITY / LOGIN — plugin-side keys (future) ──────── */
            'login_slug'              => [ 'option' => 'apollo_login_slug',          'type' => 'text',  'default' => 'acesso' ],
            'login_logo_url'          => [ 'option' => 'apollo_login_logo_url',      'type' => 'url',   'default' => '' ],
            'login_background_color'  => [ 'option' => 'apollo_login_bg_color',      'type' => 'color', 'default' => '#0f0f0f' ],
            'login_primary_color'     => [ 'option' => 'apollo_login_primary_color', 'type' => 'color', 'default' => '#ff6b35' ],
            'firewall_enabled'        => [ 'option' => 'apollo_firewall_enabled',    'type' => 'bool',  'default' => true ],
            'ghost_mode'              => [ 'option' => 'apollo_ghost_mode_enabled',  'type' => 'bool',  'default' => true ],
            'max_login_attempts'      => [ 'option' => 'apollo_max_login_attempts',  'type' => 'int',   'default' => 5 ],
            'lockout_duration'        => [ 'option' => 'apollo_lockout_duration',    'type' => 'int',   'default' => 30 ],

            /* ── LOGIN (login.php actual keys) ─────────────────────── */
            'login_max_attempts'    => [ 'option' => 'apollo_max_login_attempts', 'type' => 'int', 'default' => 5 ],
            'login_lockout_duration'=> [ 'option' => 'apollo_lockout_duration',   'type' => 'int', 'default' => 15 ],

            /* ── EMAIL / SMTP (email/settings.php actual keys) ──────── */
            'email_from_name'    => [ 'option' => 'apollo_email_from_name',      'type' => 'text',  'default' => 'Apollo Rio' ],
            'email_from_email'   => [ 'option' => 'apollo_email_from_address',   'type' => 'email', 'default' => '' ],
            'email_smtp_host'    => [ 'option' => 'apollo_email_smtp_host',      'type' => 'text',  'default' => '' ],
            'email_smtp_port'    => [ 'option' => 'apollo_email_smtp_port',      'type' => 'int',   'default' => 587 ],
            'email_smtp_user'    => [ 'option' => 'apollo_email_smtp_user',      'type' => 'email', 'default' => '' ],

            /* ── EMAIL — plugin-side alias keys (future) ────────────── */
            'smtp_host'       => [ 'option' => 'apollo_email_smtp_host',      'type' => 'text',  'default' => '' ],
            'smtp_port'       => [ 'option' => 'apollo_email_smtp_port',      'type' => 'int',   'default' => 587 ],
            'smtp_user'       => [ 'option' => 'apollo_email_smtp_user',      'type' => 'email', 'default' => '' ],
            'smtp_from'       => [ 'option' => 'apollo_email_from_address',   'type' => 'email', 'default' => '' ],
            'smtp_from_name'  => [ 'option' => 'apollo_email_from_name',      'type' => 'text',  'default' => '' ],
            'smtp_encryption' => [ 'option' => 'apollo_email_smtp_encryption','type' => 'select','default' => 'tls' ],

            /* ── MEMBERSHIP ──────────────────────────────────────────── */
            'membership_default'        => [ 'option' => 'apollo_membership_default',             'type' => 'select', 'default' => 'nao-verificado' ],
            'membership_trial_days'     => [ 'option' => 'apollo_membership_trial_days',          'type' => 'int',    'default' => 7 ],
            'membership_require_verify' => [ 'option' => 'apollo_membership_require_email_verify', 'type' => 'bool',  'default' => true ],
            'membership_agent_enabled'  => [ 'option' => 'apollo_membership_agent_enabled',       'type' => 'bool',   'default' => false ],

            /* ── EVENTS ──────────────────────────────────────────────── */
            'events_per_page'      => [ 'option' => 'apollo_events_per_page',       'type' => 'int',   'default' => 12 ],
            'events_archive_slug'  => [ 'option' => 'apollo_events_archive_slug',   'type' => 'text',  'default' => 'eventos' ],
            'events_date_format'   => [ 'option' => 'apollo_events_date_format',    'type' => 'text',  'default' => 'd/m/Y' ],
            'events_show_past'     => [ 'option' => 'apollo_events_show_past',      'type' => 'bool',  'default' => false ],
            'events_map_enabled'   => [ 'option' => 'apollo_events_map_enabled',    'type' => 'bool',  'default' => true ],
            'events_primary_color' => [ 'option' => 'apollo_events_primary_color',  'type' => 'color', 'default' => '#ff6b35' ],
            'events_card_radius'   => [ 'option' => 'apollo_events_card_radius',    'type' => 'int',   'default' => 12 ],

            /* ── RADIO ───────────────────────────────────────────────── */
            'radio_stream_url'     => [ 'option' => 'apollo_radio_stream_url',     'type' => 'url',  'default' => '' ],
            'radio_default_volume' => [ 'option' => 'apollo_radio_default_volume', 'type' => 'int',  'default' => 80 ],
            'radio_show_metadata'  => [ 'option' => 'apollo_radio_show_metadata',  'type' => 'bool', 'default' => true ],
            'radio_autoplay'       => [ 'option' => 'apollo_radio_autoplay',       'type' => 'bool', 'default' => false ],

            /* ── SEO ─────────────────────────────────────────────────── */
            'seo_title_separator'  => [ 'option' => 'apollo_seo_title_separator',  'type' => 'text', 'default' => '·' ],
            'seo_og_image'         => [ 'option' => 'apollo_seo_og_image',          'type' => 'url',  'default' => '' ],
            'seo_twitter_handle'   => [ 'option' => 'apollo_seo_twitter_handle',   'type' => 'text', 'default' => '' ],
            'seo_noindex_archives' => [ 'option' => 'apollo_seo_noindex_archives', 'type' => 'bool', 'default' => false ],

            /* ── NOTIFICATIONS (social/notif.php actual keys) ────────── */
            'notif_push'          => [ 'option' => 'apollo_notif_push_enabled',  'type' => 'bool', 'default' => false ],
            'notif_digest'        => [ 'option' => 'apollo_notif_email_enabled', 'type' => 'bool', 'default' => true ],
            'notif_vapid_public'  => [ 'option' => 'apollo_notif_vapid_public',  'type' => 'text', 'default' => '' ],
            'notif_vapid_private' => [ 'option' => 'apollo_notif_vapid_private', 'type' => 'text', 'default' => '' ],

            /* ── NOTIFICATIONS — plugin-side alias keys (future) ─────── */
            'notif_push_enabled'  => [ 'option' => 'apollo_notif_push_enabled',  'type' => 'bool', 'default' => false ],
            'notif_email_enabled' => [ 'option' => 'apollo_notif_email_enabled', 'type' => 'bool', 'default' => true ],
        ];
    }
}
