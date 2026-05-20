<?php
/**
 * Adds Apollo DJ Sync fields to the WordPress user edit screen.
 * Admins can grant/revoke per-user feature gates without touching the database directly.
 */

namespace Apollo\DJSync\Admin;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Apollo\DJSync\Core\DJMetaRegistry;

class DJUserAdmin {

    public function init(): void {
        add_action( 'show_user_profile', [ $this, 'render_meta_box' ] );
        add_action( 'edit_user_profile', [ $this, 'render_meta_box' ] );
        add_action( 'personal_options_update', [ $this, 'save_meta' ] );
        add_action( 'edit_user_profile_update', [ $this, 'save_meta' ] );
        add_action( 'admin_menu', [ $this, 'add_settings_page' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
    }

    // ------------------------------------------------------------------
    // User edit meta box
    // ------------------------------------------------------------------

    public function render_meta_box( \WP_User $user ): void {
        if ( ! current_user_can( 'edit_users' ) ) {
            return;
        }

        wp_nonce_field( 'apollo_dj_save_meta_' . $user->ID, 'apollo_dj_nonce' );

        $allowed_tabs   = get_user_meta( $user->ID, '_apollo_dj_allowed_tabs', true );
        $quantize_level = get_user_meta( $user->ID, '_apollo_dj_quantize_level', true ) ?: '1/16';
        $ultra_mode     = (bool) get_user_meta( $user->ID, '_apollo_dj_ultra_mode', true );
        $daily_limit    = (int) get_user_meta( $user->ID, '_apollo_dj_daily_limit', true ) ?: 10;
        $premium_until  = get_user_meta( $user->ID, '_apollo_dj_premium_until', true );
        $can_export     = (bool) get_user_meta( $user->ID, '_apollo_dj_can_export', true );
        $can_harmonic   = (bool) get_user_meta( $user->ID, '_apollo_dj_can_harmonic', true );
        $min_accuracy   = (int) get_user_meta( $user->ID, '_apollo_dj_min_accuracy', true ) ?: 85;

        if ( ! is_array( $allowed_tabs ) ) {
            $allowed_tabs = [ 'analysis', 'waveform' ];
        }

        $all_tabs    = [ 'analysis', 'waveform', 'harmonic', 'export', 'settings' ];
        $quantize_opts = [ '1/4', '1/8', '1/16', '1/32' ];
        ?>
        <h2><?php esc_html_e( 'Apollo DJ Sync — Feature Gates', 'apollo-dj-sync' ); ?></h2>
        <table class="form-table" role="presentation">
            <tr>
                <th><?php esc_html_e( 'Allowed Tabs', 'apollo-dj-sync' ); ?></th>
                <td>
                    <?php foreach ( $all_tabs as $tab ) : ?>
                        <label style="margin-right:12px;">
                            <input type="checkbox"
                                   name="apollo_dj_allowed_tabs[]"
                                   value="<?php echo esc_attr( $tab ); ?>"
                                   <?php checked( in_array( $tab, $allowed_tabs, true ) ); ?>>
                            <?php echo esc_html( ucfirst( $tab ) ); ?>
                        </label>
                    <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Quantize Level', 'apollo-dj-sync' ); ?></th>
                <td>
                    <select name="apollo_dj_quantize_level">
                        <?php foreach ( $quantize_opts as $opt ) : ?>
                            <option value="<?php echo esc_attr( $opt ); ?>" <?php selected( $quantize_level, $opt ); ?>>
                                <?php echo esc_html( $opt ); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Ultra Mode', 'apollo-dj-sync' ); ?></th>
                <td>
                    <input type="checkbox" name="apollo_dj_ultra_mode" value="1" <?php checked( $ultra_mode ); ?>>
                    <span class="description"><?php esc_html_e( 'Full-spectrum madmom processing', 'apollo-dj-sync' ); ?></span>
                </td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Daily Limit', 'apollo-dj-sync' ); ?></th>
                <td>
                    <input type="number" name="apollo_dj_daily_limit" value="<?php echo esc_attr( $daily_limit ); ?>" min="0" max="9999" style="width:80px;">
                    <span class="description"><?php esc_html_e( 'Tracks/day. 0 = unlimited.', 'apollo-dj-sync' ); ?></span>
                </td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Premium Until', 'apollo-dj-sync' ); ?></th>
                <td>
                    <input type="date" name="apollo_dj_premium_until" value="<?php echo esc_attr( (string) $premium_until ); ?>">
                </td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Can Export', 'apollo-dj-sync' ); ?></th>
                <td>
                    <input type="checkbox" name="apollo_dj_can_export" value="1" <?php checked( $can_export ); ?>>
                    <span class="description"><?php esc_html_e( 'Rekordbox XML / Serato CSV', 'apollo-dj-sync' ); ?></span>
                </td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Can Harmonic Mix', 'apollo-dj-sync' ); ?></th>
                <td>
                    <input type="checkbox" name="apollo_dj_can_harmonic" value="1" <?php checked( $can_harmonic ); ?>>
                </td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Min Accuracy (%)', 'apollo-dj-sync' ); ?></th>
                <td>
                    <input type="number" name="apollo_dj_min_accuracy" value="<?php echo esc_attr( $min_accuracy ); ?>" min="0" max="100" style="width:80px;">
                </td>
            </tr>
        </table>
        <?php
    }

    public function save_meta( int $user_id ): void {
        if (
            ! isset( $_POST['apollo_dj_nonce'] ) ||
            ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['apollo_dj_nonce'] ) ), 'apollo_dj_save_meta_' . $user_id ) ||
            ! current_user_can( 'edit_user', $user_id )
        ) {
            return;
        }

        // Tabs — only allow known values.
        $all_tabs     = [ 'analysis', 'waveform', 'harmonic', 'export', 'settings' ];
        $raw_tabs     = isset( $_POST['apollo_dj_allowed_tabs'] ) ? (array) $_POST['apollo_dj_allowed_tabs'] : [];
        $allowed_tabs = array_values( array_intersect( $raw_tabs, $all_tabs ) );
        update_user_meta( $user_id, '_apollo_dj_allowed_tabs', $allowed_tabs );

        // Quantize level.
        $quantize_opts = [ '1/4', '1/8', '1/16', '1/32' ];
        $raw_q         = isset( $_POST['apollo_dj_quantize_level'] ) ? sanitize_text_field( wp_unslash( $_POST['apollo_dj_quantize_level'] ) ) : '1/16';
        update_user_meta( $user_id, '_apollo_dj_quantize_level', in_array( $raw_q, $quantize_opts, true ) ? $raw_q : '1/16' );

        // Booleans.
        update_user_meta( $user_id, '_apollo_dj_ultra_mode', ! empty( $_POST['apollo_dj_ultra_mode'] ) );
        update_user_meta( $user_id, '_apollo_dj_can_export', ! empty( $_POST['apollo_dj_can_export'] ) );
        update_user_meta( $user_id, '_apollo_dj_can_harmonic', ! empty( $_POST['apollo_dj_can_harmonic'] ) );

        // Integers.
        $daily_limit = absint( $_POST['apollo_dj_daily_limit'] ?? 10 );
        update_user_meta( $user_id, '_apollo_dj_daily_limit', $daily_limit );

        $min_accuracy = min( 100, absint( $_POST['apollo_dj_min_accuracy'] ?? 85 ) );
        update_user_meta( $user_id, '_apollo_dj_min_accuracy', $min_accuracy );

        // Date string — validate ISO format.
        $raw_date = sanitize_text_field( wp_unslash( $_POST['apollo_dj_premium_until'] ?? '' ) );
        if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/', $raw_date ) ) {
            update_user_meta( $user_id, '_apollo_dj_premium_until', $raw_date );
        } else {
            delete_user_meta( $user_id, '_apollo_dj_premium_until' );
        }
    }

    // ------------------------------------------------------------------
    // Global settings page (maintenance mode, min version, global message)
    // ------------------------------------------------------------------

    public function add_settings_page(): void {
        add_options_page(
            __( 'Apollo DJ Sync', 'apollo-dj-sync' ),
            __( 'Apollo DJ', 'apollo-dj-sync' ),
            'manage_options',
            'apollo-dj-sync',
            [ $this, 'render_settings_page' ]
        );
    }

    public function register_settings(): void {
        register_setting( 'apollo_dj_sync_settings', 'apollo_dj_maintenance_mode', [ 'type' => 'boolean', 'sanitize_callback' => 'rest_sanitize_boolean', 'default' => false ] );
        register_setting( 'apollo_dj_sync_settings', 'apollo_dj_min_version',      [ 'type' => 'string',  'sanitize_callback' => 'sanitize_text_field',    'default' => '2.0.0' ] );
        register_setting( 'apollo_dj_sync_settings', 'apollo_dj_global_message',   [ 'type' => 'string',  'sanitize_callback' => 'sanitize_text_field',    'default' => '' ] );
        register_setting( 'apollo_dj_sync_settings', 'apollo_dj_allowed_roles_login', [
            'type'              => 'array',
            'sanitize_callback' => [ $this, 'sanitize_roles_setting' ],
            'default'           => [],
        ] );
        register_setting( 'apollo_dj_sync_settings', 'apollo_dj_allowed_memberships_nicotine', [
            'type'              => 'array',
            'sanitize_callback' => [ $this, 'sanitize_memberships_setting' ],
            'default'           => [ 'amigz', 'greatdjs' ],
        ] );
    }

    public function render_settings_page(): void {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $allowed_roles = get_option( 'apollo_dj_allowed_roles_login', [] );
        if ( ! is_array( $allowed_roles ) ) {
            $allowed_roles = [];
        }

        $allowed_memberships = get_option( 'apollo_dj_allowed_memberships_nicotine', [ 'amigz', 'greatdjs' ] );
        if ( ! is_array( $allowed_memberships ) ) {
            $allowed_memberships = [ 'amigz', 'greatdjs' ];
        }

        global $wp_roles;
        $roles = is_object( $wp_roles ) && isset( $wp_roles->roles ) ? (array) $wp_roles->roles : [];

        $membership_options = [
            'amigz'    => 'amigz',
            'greatdjs' => 'greatdjs',
            // Backward compatibility with old token payload typo.
            'amigxs'   => 'amigxs',
        ];
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'Apollo DJ Sync Settings', 'apollo-dj-sync' ); ?></h1>
            <form method="post" action="options.php">
                <?php settings_fields( 'apollo_dj_sync_settings' ); ?>
                <table class="form-table" role="presentation">
                    <tr>
                        <th><?php esc_html_e( 'Maintenance Mode', 'apollo-dj-sync' ); ?></th>
                        <td>
                            <input type="checkbox" name="apollo_dj_maintenance_mode" value="1"
                                <?php checked( get_option( 'apollo_dj_maintenance_mode' ) ); ?>>
                            <span class="description"><?php esc_html_e( 'Block all apolloDJ.exe logins', 'apollo-dj-sync' ); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Min App Version', 'apollo-dj-sync' ); ?></th>
                        <td>
                            <input type="text" name="apollo_dj_min_version"
                                value="<?php echo esc_attr( (string) get_option( 'apollo_dj_min_version', '2.0.0' ) ); ?>"
                                style="width:120px;">
                        </td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Global Message', 'apollo-dj-sync' ); ?></th>
                        <td>
                            <input type="text" name="apollo_dj_global_message"
                                value="<?php echo esc_attr( (string) get_option( 'apollo_dj_global_message', '' ) ); ?>"
                                style="width:400px;">
                            <p class="description"><?php esc_html_e( 'Shown in apolloDJ.exe on boot. Leave blank to hide.', 'apollo-dj-sync' ); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Roles Allowed to Login', 'apollo-dj-sync' ); ?></th>
                        <td>
                            <?php foreach ( $roles as $role_key => $role_data ) : ?>
                                <label style="display:inline-block;margin-right:12px;margin-bottom:4px;">
                                    <input type="checkbox"
                                           name="apollo_dj_allowed_roles_login[]"
                                           value="<?php echo esc_attr( (string) $role_key ); ?>"
                                        <?php checked( in_array( (string) $role_key, $allowed_roles, true ) ); ?>>
                                    <?php echo esc_html( translate_user_role( $role_data['name'] ?? (string) $role_key ) ); ?>
                                </label>
                            <?php endforeach; ?>
                            <p class="description"><?php esc_html_e( 'Only selected WordPress roles can authenticate in apolloDJ.exe. If no role is selected, all roles are allowed.', 'apollo-dj-sync' ); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Memberships Allowed for Nicotine+ Tabs', 'apollo-dj-sync' ); ?></th>
                        <td>
                            <?php foreach ( $membership_options as $membership_key => $membership_label ) : ?>
                                <label style="display:inline-block;margin-right:12px;margin-bottom:4px;">
                                    <input type="checkbox"
                                           name="apollo_dj_allowed_memberships_nicotine[]"
                                           value="<?php echo esc_attr( $membership_key ); ?>"
                                        <?php checked( in_array( $membership_key, $allowed_memberships, true ) ); ?>>
                                    <?php echo esc_html( $membership_label ); ?>
                                </label>
                            <?php endforeach; ?>
                            <p class="description"><?php esc_html_e( 'Controls who can see nicotine+ Search Tracks and Downloads tabs in apolloDJ.exe.', 'apollo-dj-sync' ); ?></p>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    /**
     * @param mixed $value Raw option value.
     * @return array<int, string>
     */
    public function sanitize_roles_setting( $value ): array {
        $value = is_array( $value ) ? $value : [];
        $value = array_values( array_unique( array_map( 'sanitize_key', $value ) ) );

        global $wp_roles;
        $valid_roles = is_object( $wp_roles ) && isset( $wp_roles->roles ) ? array_keys( (array) $wp_roles->roles ) : [];

        return array_values( array_intersect( $value, $valid_roles ) );
    }

    /**
     * @param mixed $value Raw option value.
     * @return array<int, string>
     */
    public function sanitize_memberships_setting( $value ): array {
        $value = is_array( $value ) ? $value : [];
        $value = array_values( array_unique( array_map( 'sanitize_key', $value ) ) );

        $valid_memberships = [ 'amigz', 'greatdjs', 'amigxs' ];

        return array_values( array_intersect( $value, $valid_memberships ) );
    }
}
