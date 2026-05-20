<?php

/**
 * Event reminder email template content block — Apollo Design System V3.
 *
 * Uses: Red module (#ff3333) event card + dark pill CTA.
 * Variables: $user_name, $event_title, $event_url, $event_date, $event_time, $loc_name, $site_name
 *
 * @package Apollo\Email
 * @since   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- MODULE: EVENT REMINDER (Red Card) -->
<tr>
	<td align="center" style="padding-bottom: 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#ff3333; border-radius: 30px;">
			<tr>
				<td style="padding: 50px 40px;">
					<div class="mono-text" style="font-size: 11px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 15px; opacity:0.8;">
						[ Lembrete de Evento ]
					</div>
					<h2 class="syne-header" style="color:#ffffff; font-size:36px; line-height:1.2; margin-bottom:25px;">
						<?php echo esc_html( $event_title ?? 'Evento' ); ?>
					</h2>

					<!-- Event Details -->
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom: 35px;">
						<?php if ( ! empty( $event_date ) ) : ?>
							<tr>
								<td width="20" valign="top" style="padding-bottom: 12px;">
									<div style="width:10px; height:10px; border-radius:5px; background-color:#ffffff; margin-top:5px;"></div>
								</td>
								<td style="font-size:15px; color:#ffffff; padding-bottom: 12px; opacity: 0.9;">
									<strong style="color:#ffffff;">Data:</strong> <?php echo esc_html( $event_date ); ?>
									<?php if ( ! empty( $event_time ) ) : ?>
										&nbsp;&bull;&nbsp; <?php echo esc_html( $event_time ); ?>
									<?php endif; ?>
								</td>
							</tr>
						<?php endif; ?>
						<?php if ( ! empty( $loc_name ) ) : ?>
							<tr>
								<td width="20" valign="top">
									<div style="width:10px; height:10px; border-radius:5px; background-color:#ffffff; margin-top:5px;"></div>
								</td>
								<td style="font-size:15px; color:#ffffff; opacity: 0.9;">
									<strong style="color:#ffffff;">Local:</strong> <?php echo esc_html( $loc_name ); ?>
								</td>
							</tr>
						<?php endif; ?>
					</table>

					<p style="color:#ffffff; font-size:15px; margin-bottom:35px; line-height:1.5; opacity:0.9;">
						Olá, <?php echo esc_html( $user_name ?? 'usuário(a)' ); ?>! O evento que você marcou está chegando. Não perca!
					</p>

					<!-- Dark Pill Button -->
					<table border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td align="center" style="border-radius: 100px; background-color: #050505;">
								<a href="<?php echo esc_url( $event_url ?? '#' ); ?>" style="display: inline-block; padding: 14px 32px; font-family: 'Space Grotesk', Arial, sans-serif; font-size: 14px; color: #ffffff; text-decoration: none; font-weight: 700; border-radius: 100px;">
									Ver Evento
								</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
