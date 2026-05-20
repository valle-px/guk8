<?php

/**
 * Ultra-modular weekly digest — Apollo Design System V3.
 *
 * 9 named section types, each rendered only when data is present.
 * Sections keyed by slug in $digest_sections associative array.
 *
 * Variables: $user_name, $digest_title, $digest_intro, $week_range,
 *            $total_activity, $read_pct, $digest_sections (keyed array),
 *            $site_name, $site_url
 *
 * @package Apollo\Email
 * @since   3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$digest_title    = $digest_title ?? __( 'Seu Resumo Mastigado', 'apollo-email' );
$digest_intro    = $digest_intro ?? '';
$digest_sections = $digest_sections ?? array();
$week_range      = $week_range ?? '';
$total_activity  = (int) ( $total_activity ?? 0 );
$read_pct        = (int) ( $read_pct ?? 0 );

/*
 * Section registry — slug ⇒ display config.
 * Only sections with data in $digest_sections will render.
 */
$section_registry = array(
	'social' => array(
		'title'     => 'Rede Social Apollo',
		'tag'       => 'Social',
		'grad_from' => '#14b8a6',
		'grad_to'   => '#0d9488',
		'border'    => '#0f766e',
	),
	'documents' => array(
		'title'     => 'Documentos',
		'tag'       => 'Docs',
		'grad_from' => '#3b82f6',
		'grad_to'   => '#2563eb',
		'border'    => '#1d4ed8',
	),
	'events' => array(
		'title'     => 'Eventos por Afinidade Sonora',
		'tag'       => 'Eventos',
		'grad_from' => '#6366f1',
		'grad_to'   => '#4f46e5',
		'border'    => '#3730a3',
	),
	'chats' => array(
		'title'     => 'Chats N&#227;o Lidos',
		'tag'       => 'Chat',
		'grad_from' => '#f59e0b',
		'grad_to'   => '#f97316',
		'border'    => '#d97706',
	),
	'notifications' => array(
		'title'     => 'Notifica&#231;&#245;es Pendentes',
		'tag'       => 'Notif',
		'grad_from' => '#ef4444',
		'grad_to'   => '#dc2626',
		'border'    => '#991b1b',
	),
	'profile' => array(
		'title'     => 'Quem Visitou Seu Perfil',
		'tag'       => 'Perfil',
		'grad_from' => '#eab308',
		'grad_to'   => '#ca8a04',
		'border'    => '#b45309',
	),
	'tracks' => array(
		'title'     => 'Novas Tracks Lan&#231;adas',
		'tag'       => 'Tracks',
		'grad_from' => '#a855f7',
		'grad_to'   => '#7c3aed',
		'border'    => '#6d28d9',
	),
	'projects' => array(
		'title'     => 'Meus Projetos &amp; Tarefas',
		'tag'       => 'Gestor',
		'grad_from' => '#10b981',
		'grad_to'   => '#059669',
		'border'    => '#047857',
	),
	'mural' => array(
		'title'     => 'Mural de Notas da Equipe',
		'tag'       => 'Mural',
		'grad_from' => '#ec4899',
		'grad_to'   => '#db2777',
		'border'    => '#be185d',
	),
);
?>
<!-- MODULE: DIGEST HERO (Purple-Pink) -->
<tr>
	<td style="padding: 0 20px 48px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%); border-radius:28px; overflow:hidden;">
			<tr>
				<td align="center" style="padding: 88px 40px 88px;">
					<?php if ( ! empty( $week_range ) ) : ?>
					<div class="mono-text" style="font-size:12px;font-weight:700;color:#fce7f3;text-transform:uppercase;letter-spacing:.12em;margin-bottom:28px;">
						<?php echo esc_html( $week_range ); ?>
					</div>
					<?php endif; ?>
					<h1 class="syne-header" style="color:#fff;font-size:52px;line-height:1.05;margin-bottom:24px;letter-spacing:-0.03em;">
						<?php echo esc_html( $digest_title ); ?>
					</h1>
					<p style="color:rgba(var(--rgb-t),.95);font-size:16px;line-height:1.7;margin:0 auto 48px;max-width:440px;font-weight:400;">
						<?php if ( ! empty( $digest_intro ) ) : ?>
							<?php echo esc_html( $digest_intro ); ?>
						<?php else : ?>
							Ol&#225;, <?php echo esc_html( $user_name ?? 'usu&#225;rio(a)' ); ?>! Tudo que importa condensado em 3 minutos. Sem ru&#237;do, puro valor.
						<?php endif; ?>
					</p>
					<table border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td align="center" style="border-radius:100px;background-color:#fff;box-shadow:0 10px 28px rgba(var(--rgb-d),.15);">
								<a href="<?php echo esc_url( $site_url ?? '#' ); ?>"
								   style="text-transform:uppercase;display:inline-block;letter-spacing:1.4px;padding:18px 48px;font-family:'Space Grotesk',Arial,sans-serif;font-size:15px;color:#a855f7;font-weight:700;border-radius:100px;">
									Explorar Apollo Rio
								</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>

<!-- DIVIDER -->
<tr>
	<td align="center" style="padding: 0 0 36px;">
		<div class="mono-text" style="color:#050505;font-size:14px;letter-spacing:8px;opacity:.18;">+ + + + + + + +</div>
	</td>
</tr>

<?php if ( $total_activity > 0 || $read_pct > 0 ) : ?>
<!-- MODULE: STATS OVERVIEW (Cyan + Green) -->
<tr>
	<td style="padding: 0 20px 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
			<tr>
				<td class="stack-column stack-pad-bottom" width="48%" valign="top">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
					       style="background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%); border-radius: 20px 20px 20px 20px; border: none;">
						<tr>
							<td style="padding:28px;">
								<p class="mono-text" style="color:#fff;font-size:11px;margin:0 0 10px;text-transform:uppercase;font-weight:700;letter-spacing:0.5px;">
									Atividade Total
								</p>
								<h3 class="syne-header" style="color:#fff;font-size:36px;margin:0 0 8px;line-height:1;">
									<?php echo esc_html( (string) $total_activity ); ?>
								</h3>
								<p style="color:rgba(var(--rgb-t),.9);font-size:12px;margin:0;font-weight:600;">
									intera&#231;&#245;es na semana
								</p>
							</td>
						</tr>
					</table>
				</td>
				<td width="4%"></td>
				<td class="stack-column" width="48%" valign="top">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
					       style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 20px 20px 20px 20px; border: none;">
						<tr>
							<td style="padding:28px;">
								<p class="mono-text" style="color:#fff;font-size:11px;margin:0 0 10px;text-transform:uppercase;font-weight:700;letter-spacing:0.5px;">
									Lido / N&#227;o Lido
								</p>
								<h3 class="syne-header" style="color:#fff;font-size:36px;margin:0 0 8px;line-height:1;">
									<?php echo esc_html( (string) $read_pct ); ?>%
								</h3>
								<p style="color:rgba(var(--rgb-t),.9);font-size:12px;margin:0;font-weight:600;">
									Voc&#234; est&#225; atualizado
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
<?php endif; ?>

<?php
// Render each section only if data is present
$has_any_section = false;
foreach ( $section_registry as $sec_slug => $sec_config ) :
	$sec_data = $digest_sections[ $sec_slug ] ?? null;
	if ( ! is_array( $sec_data ) ) {
		continue;
	}
	$items = is_array( $sec_data['items'] ?? null ) ? $sec_data['items'] : array();
	if ( empty( $items ) ) {
		continue;
	}
	$has_any_section = true;
	$sec_title  = $sec_data['title'] ?? $sec_config['title'];
	$sec_count  = isset( $sec_data['count'] ) ? (int) $sec_data['count'] : count( $items );
	$sec_action = $sec_data['action_url'] ?? '';
?>
<!-- SECTION: <?php echo esc_attr( $sec_slug ); ?> -->
<tr>
	<td style="padding: 0 20px 32px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background: linear-gradient(135deg, <?php echo esc_attr( $sec_config['grad_from'] ); ?> 0%, <?php echo esc_attr( $sec_config['grad_to'] ); ?> 100%); border-radius: 28px 28px 28px 28px; border: none;">
			<tr>
				<td style="padding:40px 44px;">
					<!-- Section header -->
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:28px;">
						<tr>
							<td>
								<span class="mono-text" style="font-size:10px;font-weight:700;color:rgba(var(--rgb-t),.6);text-transform:uppercase;letter-spacing:.12em;">
									<?php echo esc_html( $sec_config['tag'] ); ?>
								</span>
							</td>
							<?php if ( $sec_count > 0 ) : ?>
							<td align="right">
								<span style="display:inline-block;background:rgba(var(--rgb-t),.2);border-radius:100px;padding:4px 14px;font-family:'Space Mono',monospace;font-size:11px;font-weight:700;color:#fff;">
									<?php echo esc_html( (string) $sec_count ); ?>
								</span>
							</td>
							<?php endif; ?>
						</tr>
					</table>
					<h2 class="syne-header" style="color:#fff;font-size:24px;line-height:1.2;margin:0 0 28px;">
						<?php echo wp_kses_post( $sec_title ); ?>
					</h2>

					<?php foreach ( array_slice( $items, 0, 6 ) as $ridx => $row ) :
						$is_last = ( $ridx >= min( count( $items ), 6 ) - 1 );
					?>
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
					       style="<?php echo $is_last ? '' : 'margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid rgba(var(--rgb-t),0.2);'; ?>">
						<tr>
							<td>
								<?php if ( ! empty( $row['heading'] ) ) : ?>
								<h4 class="syne-header" style="color:#fff;font-size:15px;margin:0 0 6px;">
									<?php echo esc_html( $row['heading'] ); ?>
								</h4>
								<?php endif; ?>
								<?php if ( ! empty( $row['message'] ) ) : ?>
								<p style="color:rgba(var(--rgb-t),.92);font-size:13px;margin:0;line-height:1.55;">
									<?php echo wp_kses_post( $row['message'] ); ?>
								</p>
								<?php endif; ?>
								<?php if ( ! empty( $row['time'] ) ) : ?>
								<p class="mono-text" style="color:rgba(var(--rgb-t),.5);font-size:10px;margin:5px 0 0;">
									<?php echo esc_html( $row['time'] ); ?>
								</p>
								<?php endif; ?>
								<?php if ( ! empty( $row['url'] ) ) : ?>
								<a href="<?php echo esc_url( $row['url'] ); ?>"
								   style="display:inline-block;margin-top:8px;font-family:'Space Grotesk',Arial,sans-serif;font-size:12px;font-weight:700;color:#fff;text-decoration:underline;">
									Abrir &rarr;
								</a>
								<?php endif; ?>
							</td>
						</tr>
					</table>
					<?php endforeach; ?>

					<?php if ( ! empty( $sec_action ) ) : ?>
					<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-top:24px;">
						<tr>
							<td style="border-radius:100px;background-color:rgba(var(--rgb-t),.2);">
								<a href="<?php echo esc_url( $sec_action ); ?>"
								   style="display:inline-block;padding:12px 28px;font-family:'Space Grotesk',Arial,sans-serif;font-size:13px;font-weight:700;color:#fff;border-radius:100px;">
									Ver tudo &rarr;
								</a>
							</td>
						</tr>
					</table>
					<?php endif; ?>
				</td>
			</tr>
		</table>
	</td>
</tr>
<?php endforeach; ?>

<?php if ( ! $has_any_section ) : ?>
<!-- EMPTY STATE -->
<tr>
	<td style="padding: 0 20px 48px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%); border-radius: 28px 28px 28px 28px; border: none;">
			<tr>
				<td style="padding:44px;">
					<h2 class="syne-header" style="color:#fff;font-size:26px;margin:0 0 16px;">
						Sem novidades ainda
					</h2>
					<p style="color:rgba(var(--rgb-t),.95);font-size:14px;margin:0;line-height:1.6;">
						Explore novos eventos, DJs e grupos na plataforma para come&#231;ar a receber seu resumo semanal personalizado.
					</p>
				</td>
			</tr>
		</table>
	</td>
</tr>
<?php endif; ?>

<!-- CTA FINAL -->
<tr>
	<td align="center" style="padding: 12px 20px 20px;">
		<table border="0" cellpadding="0" cellspacing="0" role="presentation">
			<tr>
				<td align="center" style="border-radius:100px;background-color:#050505;">
					<a href="<?php echo esc_url( $site_url ?? '#' ); ?>"
					   style="display:inline-block;padding:16px 44px;font-family:'Space Grotesk',Arial,sans-serif;font-size:14px;color:#fff;font-weight:700;border-radius:100px;letter-spacing:.5px;">
						Acessar Apollo Rio
					</a>
				</td>
			</tr>
		</table>
	</td>
</tr>

