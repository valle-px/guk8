<?php
/**
 * Single DJ — Full-page template (New Design v3)
 *
 * Standalone HTML document (Canvas mode — no get_header/get_footer).
 * Loads all partials from parts/dj-v3/ directory.
 *
 * @package Apollo\DJs
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! have_posts() || get_post_type() !== APOLLO_DJ_CPT ) {
	status_header( 404 );
	nocache_headers();
	include get_404_template();
	exit;
}

the_post();
global $post;

$dj_id   = $post->ID;
$dj_name = get_post_meta( $dj_id, '_dj_name', true ) ?: get_the_title( $dj_id );
$dj_slug = $post->post_name;

// ── Images ──────────────────────────────────────────────────────────────────
$dj_photo_url  = apollo_dj_get_image( $dj_id );
$dj_banner_url = apollo_dj_get_banner( $dj_id );

// ── Bio ─────────────────────────────────────────────────────────────────────
$dj_bio_short = get_post_meta( $dj_id, '_dj_bio_short', true );
$dj_bio_raw   = get_post_meta( $dj_id, '_dj_bio', true ) ?: '';
$dj_bio_full  = ! empty( $dj_bio_raw )
	? apply_filters( 'the_content', $dj_bio_raw )
	: apply_filters( 'the_content', get_the_content() );

// ── Identity ────────────────────────────────────────────────────────────────
$dj_verified = apollo_dj_is_verified( $dj_id );
$dj_user_id  = (int) get_post_meta( $dj_id, '_dj_user_id', true );

// ── Name formatting ─────────────────────────────────────────────────────────
$words             = explode( ' ', trim( $dj_name ) );
$dj_name_formatted = count( $words ) >= 2
	? esc_html( $words[0] ) . '<br>' . esc_html( implode( ' ', array_slice( $words, 1 ) ) )
	: esc_html( $dj_name );

// ── Projects ────────────────────────────────────────────────────────────────
$dj_projects = array_filter(
	array(
		get_post_meta( $dj_id, '_dj_original_project_1', true ),
		get_post_meta( $dj_id, '_dj_original_project_2', true ),
		get_post_meta( $dj_id, '_dj_original_project_3', true ),
	)
);

// ── Sounds (taxonomy) ───────────────────────────────────────────────────────
$dj_sounds = apollo_dj_get_sounds( $dj_id );

// ── Links (grouped) ────────────────────────────────────────────────────────
$link_defs = array(
	'music'    => array(
		'soundcloud' => array( '_dj_soundcloud', 'ri-soundcloud-line', 'SoundCloud' ),
		'spotify'    => array( '_dj_spotify', 'ri-spotify-line', 'Spotify' ),
		'youtube'    => array( '_dj_youtube', 'ri-youtube-line', 'YouTube' ),
		'mixcloud'   => array( '_dj_mixcloud', 'ri-disc-line', 'Mixcloud' ),
		'bandcamp'   => array( '_dj_bandcamp', 'ri-album-line', 'Bandcamp' ),
		'beatport'   => array( '_dj_beatport', 'ri-vip-crown-line', 'Beatport' ),
	),
	'social'   => array(
		'instagram' => array( '_dj_instagram', 'ri-instagram-line', 'Instagram' ),
		'facebook'  => array( '_dj_facebook', 'ri-facebook-circle-line', 'Facebook' ),
		'twitter'   => array( '_dj_twitter', 'ri-twitter-x-line', 'Twitter / X' ),
		'tiktok'    => array( '_dj_tiktok', 'ri-tiktok-line', 'TikTok' ),
	),
	'pro'      => array(
		'website' => array( '_dj_website', 'ri-global-line', 'Website' ),
		'ra'      => array( '_dj_resident_advisor', 'ri-radio-line', 'Resident Advisor' ),
	),
	'assets'   => array(
		'mediakit' => array( '_dj_media_kit_url', 'ri-clipboard-line', 'Media Kit' ),
		'rider'    => array( '_dj_rider_url', 'ri-clipboard-fill', 'Tech Rider' ),
		'mix'      => array( '_dj_mix_url', 'ri-play-list-2-line', 'Mix / Playlist' ),
		'set'      => array( '_dj_set_url', 'ri-headphone-line', 'Feature Set' ),
	),
);

$all_links = array();
foreach ( $link_defs as $group => $defs ) {
	$all_links[ $group ] = array();
	foreach ( $defs as $key => $def ) {
		$url = get_post_meta( $dj_id, $def[0], true );
		if ( $url ) {
			$all_links[ $group ][ $key ] = array(
				'url'   => $url,
				'icon'  => $def[1],
				'label' => $def[2],
			);
		}
	}
}

// ── Events ──────────────────────────────────────────────────────────────────
$dj_events       = apollo_dj_get_upcoming_events( $dj_id, 10 );
$dj_events_count = count( $dj_events );

// ── Asset URLs ──────────────────────────────────────────────────────────────
$media_kit_url = $all_links['assets']['mediakit']['url'] ?? '';
$rider_url     = $all_links['assets']['rider']['url'] ?? '';

// ── Plugin URL ──────────────────────────────────────────────────────────────
$plugin_url = APOLLO_DJ_URL;

// ── Schema.org structured data ──────────────────────────────────────────────
$schema = array(
	'@context'    => 'https://schema.org',
	'@type'       => 'MusicGroup',
	'name'        => $dj_name,
	'genre'       => $dj_sounds,
	'url'         => get_permalink( $dj_id ),
	'image'       => $dj_banner_url,
	'description' => $dj_bio_short ?: wp_strip_all_tags( wp_trim_words( $dj_bio_full, 30 ) ),
);

// ── Parts directory ─────────────────────────────────────────────────────────
$parts_dir = APOLLO_DJ_DIR . 'templates/parts/dj-v3/';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo esc_html( $dj_name ); ?> — DJ · apollo.rio.br</title>
	<meta name="description" content="<?php echo esc_attr( $dj_bio_short ?: wp_trim_words( wp_strip_all_tags( $dj_bio_full ), 25 ) ); ?>">

	<!-- Schema.org -->
	<script type="application/ld+json"><?php echo wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>

	<?php do_action( 'apollo_dj_single_head_before', $dj_id ); ?>

	<!-- Apollo CDN — Canvas Mode -->
	<script src="<?php echo esc_url( apollo_cdn_core_js_url() ); ?>" fetchpriority="high"></script>

	<!-- DJ v3 Stylesheets -->
	<link rel="stylesheet" href="<?php echo esc_url( $plugin_url . 'assets/css/dj-single-v3.css' ); ?>">

	<?php do_action( 'apollo_dj_single_head_after', $dj_id ); ?>
</head>

<body class="antialiased dj-single-v3" data-dj-id="<?php echo esc_attr( $dj_id ); ?>" data-dj-slug="<?php echo esc_attr( $dj_slug ); ?>">

	<?php do_action( 'apollo_dj_single_body_start', $dj_id ); ?>

	<!-- Noise Overlay -->
	<div class="noise" aria-hidden="true"></div>

	<!-- Scroll Progress -->
	<div class="dj-progress" id="dj-progress"></div>

	<?php
	// ── HERO ────────────────────────────────────────────────────────────────
	if ( file_exists( $parts_dir . 'hero.php' ) ) {
		include $parts_dir . 'hero.php';
	}

	// ── METRICS BAR ─────────────────────────────────────────────────────────
	if ( file_exists( $parts_dir . 'metrics.php' ) ) {
		include $parts_dir . 'metrics.php';
	}

	// ── AGENDA (Events) ─────────────────────────────────────────────────────
	if ( $dj_events_count > 0 && file_exists( $parts_dir . 'agenda.php' ) ) {
		include $parts_dir . 'agenda.php';
	}

	// ── MARQUEE ─────────────────────────────────────────────────────────────
	if ( file_exists( $parts_dir . 'marquee.php' ) ) {
		include $parts_dir . 'marquee.php';
	}

	// ── SOUNDS ──────────────────────────────────────────────────────────────
	if ( file_exists( $parts_dir . 'sounds.php' ) ) {
		include $parts_dir . 'sounds.php';
	}

	// ── BIO + TIMELINE ──────────────────────────────────────────────────────
	if ( file_exists( $parts_dir . 'bio.php' ) ) {
		include $parts_dir . 'bio.php';
	}

	// ── EPK (Media Kit) ─────────────────────────────────────────────────────
	if ( ( $media_kit_url || $rider_url ) && file_exists( $parts_dir . 'epk.php' ) ) {
		include $parts_dir . 'epk.php';
	}

	// ── GALLERY ─────────────────────────────────────────────────────────────
	if ( file_exists( $parts_dir . 'gallery.php' ) ) {
		include $parts_dir . 'gallery.php';
	}

	// ── DEPOIMENTOS ─────────────────────────────────────────────────────────
	if ( file_exists( $parts_dir . 'depoimentos.php' ) ) {
		include $parts_dir . 'depoimentos.php';
	}

	// ── BOOKING ─────────────────────────────────────────────────────────────
	if ( file_exists( $parts_dir . 'booking.php' ) ) {
		include $parts_dir . 'booking.php';
	}

	// ── FOOTER ──────────────────────────────────────────────────────────────
	if ( file_exists( $parts_dir . 'footer.php' ) ) {
		include $parts_dir . 'footer.php';
	}

	// ── FAB MENU ────────────────────────────────────────────────────────────
	if ( file_exists( $parts_dir . 'fab-menu.php' ) ) {
		include $parts_dir . 'fab-menu.php';
	}
	?>

	<?php do_action( 'apollo_dj_single_before_scripts', $dj_id ); ?>

	<!-- GSAP (from CDN) -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/ScrollTrigger.min.js" defer></script>

	<!-- DJ v3 Scripts -->
	<script src="<?php echo esc_url( $plugin_url . 'assets/js/dj-single-v3.js' ); ?>" defer></script>

	<?php do_action( 'apollo_dj_single_body_end', $dj_id ); ?>

	<?php wp_footer(); ?>
</body>

</html>
<?php wp_reset_postdata(); ?>
