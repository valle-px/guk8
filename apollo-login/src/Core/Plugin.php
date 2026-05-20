<?php

/**
 * Main Plugin Class
 *
 * @package Apollo\Login
 */

declare(strict_types=1);

namespace Apollo\Login\Core;

use Apollo\Login\Auth;
use Apollo\Login\Quiz;
use Apollo\Login\Security;
use Apollo\Login\API;

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Plugin class (Singleton)
 */
final class Plugin {


	/**
	 * Plugin instance
	 *
	 * @var Plugin|null
	 */
	private static ?Plugin $instance = null;

	/**
	 * Get plugin instance
	 *
	 * @return Plugin
	 */
	public static function get_instance(): Plugin {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Private constructor (Singleton pattern)
	 */
	private function __construct() {
		// Singleton - use get_instance()
	}

	/**
	 * Initialize plugin
	 *
	 * @return void
	 */
	public function init(): void {
		// Register hooks
		add_action( 'init', array( $this, 'register_virtual_pages' ), 1 );
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
		add_action( 'init', array( $this, 'register_shortcodes' ) );
		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'register_admin_pages' ) );
			add_action( 'admin_post_apollo_login_external_auth_test', array( $this, 'handle_external_auth_test' ) );
		}
		// NOTE: template_include is handled in apollo-login.php main file.
		// Do NOT register it here to avoid duplicate template loading.

		// Flush rewrite rules when plugin version changes (new login slug aliases, etc.).
		add_action( 'init', array( $this, 'maybe_flush_rewrites' ), 99 );

		// Initialize components
		$this->init_components();
	}

	/**
	 * Flush rewrite rules if needed
	 *
	 * @return void
	 */
	public function maybe_flush_rewrites(): void {
		$current_version = get_option( 'apollo_login_flush_rewrites' );
		if ( $current_version !== APOLLO_LOGIN_VERSION ) {
			flush_rewrite_rules( true );
			update_option( 'apollo_login_flush_rewrites', APOLLO_LOGIN_VERSION );
		}
	}

	/**
	 * Initialize plugin components
	 *
	 * @return void
	 */
	private function init_components(): void {
		// Auth handlers
		new Auth\LoginHandler();
		new Auth\RegisterHandler();
		new Auth\PasswordReset();
		new Auth\EmailVerification();

		// Quiz system
		new Quiz\QuizManager();
		new Quiz\SimonGame();

		// Security — Order matters: Firewall first (blocks before any WP code runs)
		new Security\Firewall();         // 7G SQL/Script injection + IP blacklist + bad agents
		new Security\SecurityHeaders();  // X-Frame-Options, CSP, HSTS, etc.
		new Security\WPHardening();      // Hide WP version, disable XML-RPC, embeds, meta
		new Security\URLRewriter();      // Block wp-login/wp-admin for non-admins → 404
		new Security\RateLimiter();      // IP rate limiting on login / comments
		new Security\Lockout();          // User + IP lockout management
		Security\JWTAuth::init();        // RS256 JWT stateless REST auth
	}

	/**
	 * Register virtual pages
	 *
	 * @return void
	 */
	public function register_virtual_pages(): void {
		// Login page — multiple slugs (canonical remains APOLLO_LOGIN_CUSTOM_LOGIN_SLUG).
		$slugs = \APOLLO_LOGIN_LOGIN_SLUG_ALIASES;
		$alt   = implode(
			'|',
			array_map(
				static function ( string $s ): string {
					return preg_quote( $s, '#' );
				},
				$slugs
			)
		);
		add_rewrite_rule(
			'^(' . $alt . ')/?$',
			'index.php?apollo_login_page=login',
			'top'
		);
		add_rewrite_rule(
			'^(' . $alt . ')/login/?$',
			'index.php?apollo_login_page=login',
			'top'
		);

		// /registre - Register page
		add_rewrite_rule(
			'^registre/?$',
			'index.php?apollo_login_page=register',
			'top'
		);

		// /reset - Password reset
		add_rewrite_rule(
			'^reset/?$',
			'index.php?apollo_login_page=reset',
			'top'
		);

		// /verificar-email - Email verification
		add_rewrite_rule(
			'^verificar-email/?$',
			'index.php?apollo_login_page=verify-email',
			'top'
		);

		// /sair - Logout redirect
		add_rewrite_rule(
			'^sair/?$',
			'index.php?apollo_login_page=logout',
			'top'
		);

		// Add query vars
		add_filter(
			'query_vars',
			function ( $vars ) {
				$vars[] = 'apollo_login_page';
				return $vars;
			}
		);
	}

	/**
	 * Register REST API routes
	 *
	 * @return void
	 */
	public function register_rest_routes(): void {
		$controllers = array(
			new API\AuthController(),
			new API\QuizController(),
			new API\SecurityController(),
			new API\AppAuthController(),
			new API\ActivityLogController(),
		);

		foreach ( $controllers as $controller ) {
			$controller->register_routes();
		}
	}

	/**
	 * Register shortcodes
	 *
	 * @return void
	 */
	public function register_shortcodes(): void {
		add_shortcode( 'apollo_login', array( $this, 'shortcode_login' ) );
		add_shortcode( 'apollo_register', array( $this, 'shortcode_register' ) );
		add_shortcode( 'apollo_quiz', array( $this, 'shortcode_quiz' ) );
		add_shortcode( 'apollo_simon', array( $this, 'shortcode_simon' ) );
		add_shortcode( 'apollo_password_reset', array( $this, 'shortcode_password_reset' ) );
		add_shortcode( 'apollo_verify_email', array( $this, 'shortcode_verify_email' ) );
	}

	/**
	 * Load templates for virtual pages (kept for shortcode compatibility).
	 * Primary template loading is in apollo-login.php main file.
	 *
	 * @param string $template Template path.
	 * @return string
	 */
	public function load_templates( string $template ): string {
		return $template;
	}

	/**
	 * Shortcode: Login form
	 *
	 * @return string
	 */
	public function shortcode_login(): string {
		ob_start();
		include APOLLO_LOGIN_DIR . 'templates/parts/login-form.php';
		return ob_get_clean();
	}

	/**
	 * Shortcode: Register form
	 *
	 * @return string
	 */
	public function shortcode_register(): string {
		ob_start();
		include APOLLO_LOGIN_DIR . 'templates/parts/register-form.php';
		return ob_get_clean();
	}

	/**
	 * Shortcode: Quiz component
	 *
	 * @return string
	 */
	public function shortcode_quiz(): string {
		ob_start();
		include APOLLO_LOGIN_DIR . 'templates/parts/quiz-overlay.php';
		return ob_get_clean();
	}

	/**
	 * Shortcode: Simon game
	 *
	 * @return string
	 */
	public function shortcode_simon(): string {
		return '<div id="apollo-simon-game" class="apollo-simon-standalone"></div>';
	}

	/**
	 * Shortcode: Password reset form
	 *
	 * @return string
	 */
	public function shortcode_password_reset(): string {
		ob_start();
		include APOLLO_LOGIN_DIR . 'templates/parts/password-reset-form.php';
		return ob_get_clean();
	}

	/**
	 * Shortcode: Email verification
	 *
	 * @return string
	 */
	public function shortcode_verify_email(): string {
		ob_start();
		include APOLLO_LOGIN_DIR . 'templates/parts/email-verification.php';
		return ob_get_clean();
	}

	/**
	 * Register wp-admin pages for Apollo Login tools.
	 *
	 * @return void
	 */
	public function register_admin_pages(): void {
		add_management_page(
			__( 'Apollo Login Tests', 'apollo-login' ),
			__( 'Apollo Login Tests', 'apollo-login' ),
			'manage_options',
			'apollo-login-tests',
			array( $this, 'render_admin_tests_page' )
		);
	}

	/**
	 * Render Apollo Login tests page with tabs.
	 *
	 * @return void
	 */
	public function render_admin_tests_page(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'Você não tem permissão para acessar esta página.', 'apollo-login' ) );
		}

		$tab = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : 'external-auth';
		if ( 'external-auth' !== $tab ) {
			$tab = 'external-auth';
		}

		$result_key = $this->get_admin_test_result_key( get_current_user_id() );
		$result     = get_transient( $result_key );
		if ( false !== $result ) {
			delete_transient( $result_key );
		}
		?>
		<div class="wrap">
			<h1><?php echo esc_html__( 'Apollo Login - Tests', 'apollo-login' ); ?></h1>

			<h2 class="nav-tab-wrapper">
				<a href="<?php echo esc_url( admin_url( 'tools.php?page=apollo-login-tests&tab=external-auth' ) ); ?>" class="nav-tab <?php echo esc_attr( 'external-auth' === $tab ? 'nav-tab-active' : '' ); ?>">
					<?php echo esc_html__( 'External Auth Test', 'apollo-login' ); ?>
				</a>
			</h2>

			<?php if ( false !== $result && is_array( $result ) ) : ?>
				<?php $is_success = ! empty( $result['success'] ); ?>
				<div class="notice <?php echo esc_attr( $is_success ? 'notice-success' : 'notice-error' ); ?>">
					<p><strong><?php echo esc_html( $is_success ? __( 'Teste executado com sucesso.', 'apollo-login' ) : __( 'Teste executado com falha.', 'apollo-login' ) ); ?></strong></p>
					<p><?php echo esc_html( sprintf( __( 'Endpoint: %s | HTTP: %d', 'apollo-login' ), (string) ( $result['endpoint'] ?? '' ), (int) ( $result['status'] ?? 0 ) ) ); ?></p>
				</div>
				<textarea readonly rows="14" style="width:100%;font-family:monospace;"><?php echo esc_textarea( (string) ( $result['body'] ?? '' ) ); ?></textarea>
			<?php endif; ?>

			<?php if ( 'external-auth' === $tab ) : ?>
				<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin-top:16px; max-width: 760px;">
					<input type="hidden" name="action" value="apollo_login_external_auth_test">
					<input type="hidden" name="tab" value="external-auth">
					<?php wp_nonce_field( 'apollo_login_external_auth_test', 'apollo_login_external_auth_nonce' ); ?>

					<table class="form-table" role="presentation">
						<tr>
							<th scope="row"><label for="apollo_test_username"><?php echo esc_html__( 'Login', 'apollo-login' ); ?></label></th>
							<td><input type="text" id="apollo_test_username" name="username" class="regular-text" required></td>
						</tr>
						<tr>
							<th scope="row"><label for="apollo_test_password"><?php echo esc_html__( 'Password', 'apollo-login' ); ?></label></th>
							<td><input type="password" id="apollo_test_password" name="password" class="regular-text" required></td>
						</tr>
						<tr>
							<th scope="row"><label for="apollo_test_app_id"><?php echo esc_html__( 'App ID (external unknown)', 'apollo-login' ); ?></label></th>
							<td><input type="text" id="apollo_test_app_id" name="app_id" class="regular-text" value="unknown" required></td>
						</tr>
					</table>

					<p class="description">
						<?php echo esc_html__( 'Este teste envia uma requisição externa para /wp-json/apollo/v1/app/auth com credenciais informadas e app_id como cliente desconhecido.', 'apollo-login' ); ?>
					</p>

					<?php submit_button( __( 'Run External Auth Test', 'apollo-login' ) ); ?>
				</form>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Handle external auth test POST from wp-admin.
	 *
	 * @return void
	 */
	public function handle_external_auth_test(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'Permissão negada.', 'apollo-login' ) );
		}

		check_admin_referer( 'apollo_login_external_auth_test', 'apollo_login_external_auth_nonce' );

		$username = isset( $_POST['username'] ) ? sanitize_text_field( wp_unslash( $_POST['username'] ) ) : '';
		$password = isset( $_POST['password'] ) ? (string) wp_unslash( $_POST['password'] ) : '';
		$app_id   = isset( $_POST['app_id'] ) ? sanitize_key( wp_unslash( $_POST['app_id'] ) ) : 'unknown';

		$endpoint = home_url( '/wp-json/apollo/v1/app/auth' );
		$payload  = wp_json_encode(
			array(
				'username' => $username,
				'password' => $password,
				'app_id'   => $app_id,
			)
		);

		$args = array(
			'timeout' => 12,
			'headers' => array(
				'Content-Type'      => 'application/json',
				'X-Apollo-Device-Id' => 'external-unknown-test',
				'User-Agent'        => 'ApolloExternalUnknownTest/1.0',
			),
			'body'    => false === $payload ? '{}' : $payload,
		);

		$response = wp_remote_post( $endpoint, $args );

		$result = array(
			'success'  => false,
			'endpoint' => $endpoint,
			'status'   => 0,
			'body'     => '',
		);

		if ( is_wp_error( $response ) ) {
			$result['body'] = $response->get_error_message();
		} else {
			$result['status']  = (int) wp_remote_retrieve_response_code( $response );
			$result['body']    = (string) wp_remote_retrieve_body( $response );
			$result['success'] = $result['status'] >= 200 && $result['status'] < 300;
		}

		set_transient( $this->get_admin_test_result_key( get_current_user_id() ), $result, 120 );
		wp_safe_redirect( admin_url( 'tools.php?page=apollo-login-tests&tab=external-auth' ) );
		exit;
	}

	/**
	 * Build per-user transient key for test results.
	 *
	 * @param int $user_id User ID.
	 * @return string
	 */
	private function get_admin_test_result_key( int $user_id ): string {
		return 'apollo_login_test_result_' . absint( $user_id );
	}
}
