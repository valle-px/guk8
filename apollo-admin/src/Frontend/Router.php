<?php
/**
 * Frontend Router — registers rewrite rules and dispatches templates.
 *
 * Routes:
 *   /admin/panel       → panel.php
 *   /admin/pending     → pending.php
 *   /admin/memberships → memberships.php
 *
 * @package Apollo\Admin
 * @since   2.0.0
 */

declare(strict_types=1);

namespace Apollo\Admin\Frontend;

if ( ! \defined( 'ABSPATH' ) ) {
    exit;
}

final class Router {

    private const PAGES = array(
        'panel'       => 'Admin Panel',
        'pending'     => 'Pending Drafts',
        'memberships' => 'Memberships',
    );

    /**
     * Register hooks.
     */
    public function init(): void {
        add_action( 'init', array( $this, 'register_rewrites' ) );
        add_filter( 'query_vars', array( $this, 'add_query_vars' ) );
        add_action( 'template_redirect', array( $this, 'handle_template' ) );

        if ( ! get_option( 'apollo_admin_frontend_rewrite_v1' ) ) {
            add_action(
                'init',
                function () {
                    flush_rewrite_rules();
                    update_option( 'apollo_admin_frontend_rewrite_v1', true );
                },
                999
            );
        }
    }

    public function register_rewrites(): void {
        add_rewrite_rule(
            '^admin/(panel|pending|memberships)/?$',
            'index.php?apollo_admin_page=$matches[1]',
            'top'
        );
    }

    public function add_query_vars( array $vars ): array {
        $vars[] = 'apollo_admin_page';
        return $vars;
    }

    public function handle_template(): void {
        $page = get_query_var( 'apollo_admin_page' );

        if ( empty( $page ) || ! isset( self::PAGES[ $page ] ) ) {
            return;
        }

        if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
            wp_safe_redirect( home_url( '/' ) );
            exit;
        }

        nocache_headers();
        status_header( 200 );

        $template = APOLLO_ADMIN_DIR . 'templates/frontend/' . $page . '.php';
        if ( \file_exists( $template ) ) {
            require $template;
        } else {
            wp_die( esc_html__( 'Template not found.', 'apollo-admin' ) );
        }
        exit;
    }
}
