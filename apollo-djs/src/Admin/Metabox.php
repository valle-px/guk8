<?php

/**
 * Metabox — Admin metaboxes para o CPT "dj"
 *
 * Cobre TODOS os 11 meta keys do apollo-registry.json
 *
 * @package Apollo\DJs\Admin
 */

namespace Apollo\DJs\Admin;

if ( ! \defined( 'ABSPATH' ) ) {
	exit;
}

final class Metabox {

	private const POST_TYPE = 'dj';
	private const NONCE     = 'apollo_dj_metabox_nonce';
	private const ACTION    = 'apollo_dj_save_meta';

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'register' ) );
		add_action( 'save_post_' . self::POST_TYPE, array( $this, 'save' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	public function register(): void {
		add_meta_box(
			'apollo-dj-info',
			__( '🎧 Informações do DJ', 'apollo-djs' ),
			array( $this, 'render_info' ),
			self::POST_TYPE,
			'normal',
			'high'
		);
		add_meta_box(
			'apollo-dj-links',
			__( '🔗 Links & Redes Sociais', 'apollo-djs' ),
			array( $this, 'render_links' ),
			self::POST_TYPE,
			'normal',
			'default'
		);
		add_meta_box(
			'apollo-dj-config',
			__( '⚙ Configurações', 'apollo-djs' ),
			array( $this, 'render_config' ),
			self::POST_TYPE,
			'side',
			'default'
		);
	}

	public function enqueue_assets( string $hook ): void {
		$screen = get_current_screen();
		if ( ! $screen || $screen->post_type !== self::POST_TYPE ) {
			return;
		}
		wp_enqueue_media();
	}

	public function render_info( \WP_Post $post ): void {
		wp_nonce_field( self::ACTION, self::NONCE );
		$bio_short = get_post_meta( $post->ID, '_dj_bio_short', true );
		$image_id  = (int) get_post_meta( $post->ID, '_dj_image', true );
		$banner_id = (int) get_post_meta( $post->ID, '_dj_banner', true );
		?>
		<p>
			<label><?php esc_html_e( 'Biografia Curta (máx. 280 caracteres)', 'apollo-djs' ); ?></label>
			<textarea name="_dj_bio_short" rows="3" maxlength="280" class="widefat"><?php echo esc_textarea( $bio_short ); ?></textarea>
		</p>
		<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
			<p>
				<label><?php esc_html_e( 'Foto de Perfil (ID)', 'apollo-djs' ); ?></label><br>
				<?php if ( $image_id ) : ?>
					<img src="<?php echo esc_url( wp_get_attachment_image_url( $image_id, 'thumbnail' ) ); ?>" style="max-width:80px;margin-bottom:4px;display:block;">
				<?php endif; ?>
				<input type="number" name="_dj_image" id="apl-dj-image-id" value="<?php echo esc_attr( (string) $image_id ); ?>" class="widefat" min="0">
				<button type="button" class="button button-small apl-dj-media-pick" data-target="apl-dj-image-id"><?php esc_html_e( 'Escolher', 'apollo-djs' ); ?></button>
			</p>
			<p>
				<label><?php esc_html_e( 'Banner (ID)', 'apollo-djs' ); ?></label><br>
				<?php if ( $banner_id ) : ?>
					<img src="<?php echo esc_url( wp_get_attachment_image_url( $banner_id, 'thumbnail' ) ); ?>" style="max-width:80px;margin-bottom:4px;display:block;">
				<?php endif; ?>
				<input type="number" name="_dj_banner" id="apl-dj-banner-id" value="<?php echo esc_attr( (string) $banner_id ); ?>" class="widefat" min="0">
				<button type="button" class="button button-small apl-dj-media-pick" data-target="apl-dj-banner-id"><?php esc_html_e( 'Escolher', 'apollo-djs' ); ?></button>
			</p>
		</div>
		<script>
		(function($){
			$(document).on('click', '.apl-dj-media-pick', function(e){
				e.preventDefault();
				var targetId = $(this).data('target');
				var frame = wp.media({ title: 'Selecionar imagem', multiple: false, library: { type: 'image' } });
				frame.on('select', function(){
					$('#' + targetId).val(frame.state().get('selection').first().toJSON().id);
				});
				frame.open();
			});
		})(jQuery);
		</script>
		<?php
	}

	public function render_links( \WP_Post $post ): void {
		$website    = get_post_meta( $post->ID, '_dj_website', true );
		$instagram  = get_post_meta( $post->ID, '_dj_instagram', true );
		$soundcloud = get_post_meta( $post->ID, '_dj_soundcloud', true );
		$spotify    = get_post_meta( $post->ID, '_dj_spotify', true );
		$youtube    = get_post_meta( $post->ID, '_dj_youtube', true );
		$mixcloud   = get_post_meta( $post->ID, '_dj_mixcloud', true );
		?>
		<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
			<p>
				<label>🌐 <?php esc_html_e( 'Website', 'apollo-djs' ); ?></label>
				<input type="url" name="_dj_website" value="<?php echo esc_attr( $website ); ?>" class="widefat" placeholder="https://...">
			</p>
			<p>
				<label>📷 <?php esc_html_e( 'Instagram (@handle)', 'apollo-djs' ); ?></label>
				<input type="text" name="_dj_instagram" value="<?php echo esc_attr( $instagram ); ?>" class="widefat" placeholder="@djname">
			</p>
			<p>
				<label>☁ <?php esc_html_e( 'SoundCloud (URL)', 'apollo-djs' ); ?></label>
				<input type="url" name="_dj_soundcloud" value="<?php echo esc_attr( $soundcloud ); ?>" class="widefat" placeholder="https://soundcloud.com/...">
			</p>
			<p>
				<label>🎧 <?php esc_html_e( 'Spotify (URL)', 'apollo-djs' ); ?></label>
				<input type="url" name="_dj_spotify" value="<?php echo esc_attr( $spotify ); ?>" class="widefat" placeholder="https://open.spotify.com/...">
			</p>
			<p>
				<label>▶ <?php esc_html_e( 'YouTube (URL)', 'apollo-djs' ); ?></label>
				<input type="url" name="_dj_youtube" value="<?php echo esc_attr( $youtube ); ?>" class="widefat" placeholder="https://youtube.com/...">
			</p>
			<p>
				<label>🔀 <?php esc_html_e( 'Mixcloud (URL)', 'apollo-djs' ); ?></label>
				<input type="url" name="_dj_mixcloud" value="<?php echo esc_attr( $mixcloud ); ?>" class="widefat" placeholder="https://mixcloud.com/...">
			</p>
		</div>
		<?php
	}

	public function render_config( \WP_Post $post ): void {
		$user_id  = (int) get_post_meta( $post->ID, '_dj_user_id', true );
		$verified = get_post_meta( $post->ID, '_dj_verified', true );
		?>
		<p>
			<label><?php esc_html_e( 'User ID vinculado', 'apollo-djs' ); ?></label>
			<input type="number" name="_dj_user_id" value="<?php echo esc_attr( (string) $user_id ); ?>" class="widefat" min="0">
			<span class="description"><?php esc_html_e( 'ID da conta WordPress do DJ', 'apollo-djs' ); ?></span>
		</p>
		<p>
			<label>
				<input type="checkbox" name="_dj_verified" value="1" <?php checked( $verified, '1' ); ?>>
				<?php esc_html_e( 'DJ Verificado', 'apollo-djs' ); ?>
			</label>
		</p>
		<?php
	}

	public function save( int $post_id, \WP_Post $post ): void {
		if ( ! isset( $_POST[ self::NONCE ] ) || ! wp_verify_nonce( sanitize_key( $_POST[ self::NONCE ] ), self::ACTION ) ) {
			return;
		}
		if ( \defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		if ( $post->post_type !== self::POST_TYPE ) {
			return;
		}

		// Strings
		if ( isset( $_POST['_dj_bio_short'] ) ) {
			update_post_meta( $post_id, '_dj_bio_short', sanitize_textarea_field( wp_unslash( $_POST['_dj_bio_short'] ) ) );
		}
		if ( isset( $_POST['_dj_instagram'] ) ) {
			update_post_meta( $post_id, '_dj_instagram', sanitize_text_field( wp_unslash( $_POST['_dj_instagram'] ) ) );
		}

		// URLs
		$url_keys = array( '_dj_website', '_dj_soundcloud', '_dj_spotify', '_dj_youtube', '_dj_mixcloud' );
		foreach ( $url_keys as $key ) {
			if ( isset( $_POST[ $key ] ) ) {
				update_post_meta( $post_id, $key, esc_url_raw( wp_unslash( (string) $_POST[ $key ] ) ) );
			}
		}

		// Ints
		$int_keys = array( '_dj_image', '_dj_banner', '_dj_user_id' );
		foreach ( $int_keys as $key ) {
			if ( isset( $_POST[ $key ] ) ) {
				update_post_meta( $post_id, $key, absint( $_POST[ $key ] ) );
			}
		}

		// Bool
		$verified = isset( $_POST['_dj_verified'] ) ? '1' : '';
		update_post_meta( $post_id, '_dj_verified', $verified );
	}
}