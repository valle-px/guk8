<?php

/**
 * Generic notification email template content block — Apollo Design System V3.
 *
 * Uses: Soft Orange module (#fcf0dd) + icon row + dark pill CTA.
 * Variables: $user_name, $title, $message, $action_url, $action_text, $site_name
 *
 * @package Apollo\Email
 * @since   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$items = $items ?? array();
?>
<!-- MODULE: ALERT BANNER (Rotated stripe) -->
<tr>
	<td style="padding: 0 20px 32px; overflow:hidden;">
		<div style="background: linear-gradient(135deg, #eeeeee 0%, #bbbbbb 100%); padding: 16px 40px; transform: rotate(-1deg); margin: 0 -10px; text-align:center;">
			<span class="mono-text" style="font-size:12px;font-weight:700;color:#050505;text-transform:uppercase;letter-spacing:.12em;">
				Comunicado Important
			</span>
		</div>
	</td>
</tr>

<!-- MODULE: HERO (Dark gradient) -->
<tr>
	<td style="padding: 0 20px 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background: linear-gradient(135deg, #1f2937 0%, #374151 100%); border-radius:28px; overflow:hidden;">
			<tr>
				<td align="center" style="padding: 72px 40px;">
					<h1 class="syne-header" style="color:#fff;font-size:44px;line-height:1.05;margin-bottom:24px;letter-spacing:-0.03em;">
						<?php echo esc_html( $title ?? 'Notifica&#231;&#227;o Apollo' ); ?>
					</h1>
					<p style="color:rgba(var(--rgb-t),.9);font-size:16px;line-height:1.7;margin:0 auto 48px;max-width:440px;font-weight:400;">
						Ol&#225;, <?php echo esc_html( $user_name ?? 'usu&#225;rio(a)' ); ?>!
						<?php if ( ! empty( $message ) ) : ?>
							<?php echo wp_kses_post( $message ); ?>
						<?php endif; ?>
					</p>
					<?php if ( ! empty( $action_url ) ) : ?>
					<table border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td align="center" style="border-radius:100px;background-color:#fbbf24;box-shadow:0 10px 28px rgba(var(--rgb-d),.15);">
								<a href="<?php echo esc_url( $action_url ); ?>"
								   style="text-transform:uppercase;display:inline-block;letter-spacing:1.4px;padding:18px 48px;font-family:'Space Grotesk',Arial,sans-serif;font-size:15px;color:#050505;font-weight:700;border-radius:100px;">
									<?php echo esc_html( $action_text ?? 'Saiba Mais' ); ?>
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

<!-- DIVIDER -->
<tr>
	<td align="center" style="padding: 0 0 36px;">
		<div class="mono-text" style="color:#050505;font-size:14px;letter-spacing:8px;opacity:.18;">+ + + + + + + +</div>
	</td>
</tr>

<?php if ( ! empty( $items ) ) : ?>
	<?php
	$card_styles = array(
		array( 'bg' => '#e0f2fe', 'border' => '#0284c7' ),
		array( 'bg' => '#fef08a', 'border' => '#eab308' ),
		array( 'bg' => '#fee2e2', 'border' => '#dc2626' ),
		array( 'bg' => '#dcfce7', 'border' => '#16a34a' ),
	);
	foreach ( $items as $idx => $item ) :
		$style = $card_styles[ $idx % count( $card_styles ) ];
	?>
	<tr>
		<td style="padding: 0 20px 20px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
			       style="background-color:<?php echo esc_attr( $style['bg'] ); ?>;border-radius:28px 28px 28px 28px;border:none; ?>;">
				<tr>
					<td style="padding:28px 32px;">
						<?php if ( ! empty( $item['heading'] ) ) : ?>
							<h3 class="syne-header" style="color:#050505;font-size:18px;margin:0 0 10px;">
								<?php echo esc_html( $item['heading'] ); ?>
							</h3>
						<?php endif; ?>
						<p style="color:#333;font-size:14px;line-height:1.6;margin:0;">
							<?php echo wp_kses_post( $item['message'] ?? '' ); ?>
						</p>
						<?php if ( ! empty( $item['url'] ) ) : ?>
							<a href="<?php echo esc_url( $item['url'] ); ?>"
							   style="display:inline-block;margin-top:12px;font-family:'Space Grotesk',Arial,sans-serif;font-size:13px;font-weight:700;color:<?php echo esc_attr( $style['border'] ); ?>;text-decoration:none;">
								Ver mais &rarr;
							</a>
						<?php endif; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td style="padding: 0 0 24px;"></td>
	</tr>
<?php endif; ?>

<!-- MODULE: CONTACT/SUPPORT (#f9f5f0) -->
<tr>
	<td style="padding: 0 20px 48px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background-color:#f9f5f0;border-radius:28px;">
			<tr>
				<td style="padding:36px 40px;">
					<h3 class="syne-header" style="color:#050505;font-size:18px;margin:0 0 12px;">
						D&#250;vidas? Fale com a gente
					</h3>
					<p style="color:#555;font-size:14px;margin:0;line-height:1.6;">
						Entre em contato pelo site oficial ou pelo email
						<a href="mailto:oi@apollo.rio.br" style="color:#050505;font-weight:700;text-decoration:none;">oi@apollo.rio.br</a>
					</p>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td align="center" style="padding-bottom: 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#fcf0dd; border-radius: 30px;">
			<tr>
				<td style="padding: 50px 40px;">
					<h2 class="syne-header" style="color:#050505; font-size:36px; line-height:1.2; margin-bottom:10px;">
						<?php echo esc_html( $title ?? 'Notificação' ); ?>
					</h2>
					<p style="color:#555555; font-size:15px; margin-bottom: 35px; line-height: 1.5;">
						Olá, <?php echo esc_html( $user_name ?? 'usuário(a)' ); ?>!
					</p>

					<!-- Notification Content -->
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom: 35px;">
						<tr>
							<td width="46" valign="top" style="padding-right: 15px;">
								<div style="width:46px; height:46px; border-radius:23px; background-color:FF9820; text-align:center; line-height:46px; font-size: 18px; color: #ffffff; font-weight: 700;">
									!
								</div>
							</td>
							<td valign="middle">
								<div style="color:#333333; font-size:15px; line-height:1.5;">
									<?php echo wp_kses_post( $message ?? '' ); ?>
								</div>
							</td>
						</tr>
					</table>

					<?php if ( ! empty( $action_url ) ) : ?>
						<!-- Dark Pill Button -->
						<table border="0" cellpadding="0" cellspacing="0" role="presentation">
							<tr>
								<td align="left" style="border-radius: 100px; background-color: #050505;">
									<a href="<?php echo esc_url( $action_url ); ?>" style="display: inline-block; padding: 14px 32px; font-family: 'Space Grotesk', Arial, sans-serif; font-size: 14px; color: #ffffff; text-decoration: none; font-weight: 700; border-radius: 100px;">
										<?php echo esc_html( $action_text ?? 'Ver mais' ); ?>
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
