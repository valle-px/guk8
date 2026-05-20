<?php

/**
 * Report / Contact Form email template content block — Apollo Design System V3.
 *
 * Uses: Dark Green "action needed" module (#0e4735) + message preview.
 * Variables: $name, $email, $subject, $message
 *
 * @package Apollo\Email
 * @since   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$name    = $name ?? 'Anônimo';
$email   = $email ?? 'não informado';
$subject = $subject ?? 'Contato';
$message = $message ?? '';
?>
<!-- MODULE: CONTACT FORM REPORT (Dark Green) -->
<tr>
	<td align="center" style="padding-bottom: 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#0e4735; border-radius: 30px;">
			<tr>
				<td style="padding: 50px 40px;">
					<div class="mono-text" style="font-size: 11px; color: #d7ff00; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 15px;">
						[ Nova Mensagem ]
					</div>
					<h2 class="syne-header" style="color:#d7ff00; font-size:32px; line-height:1.2; margin-bottom:30px;">
						<?php echo esc_html( $subject ); ?>
					</h2>

					<!-- Sender Info -->
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom: 30px;">
						<tr>
							<td width="20" valign="top" style="padding-bottom: 12px;">
								<div style="width:10px; height:10px; border-radius:5px; background-color:#d7ff00; margin-top:5px;"></div>
							</td>
							<td style="font-size:15px; color:#E0E0E0; padding-bottom: 12px;">
								<strong style="color:#ffffff; font-weight: 600;">Nome:</strong> <?php echo esc_html( $name ); ?>
							</td>
						</tr>
						<tr>
							<td width="20" valign="top">
								<div style="width:10px; height:10px; border-radius:5px; background-color:#ffffff; margin-top:5px;"></div>
							</td>
							<td style="font-size:15px; color:#E0E0E0;">
								<strong style="color:#ffffff; font-weight: 600;">Email:</strong> <?php echo esc_html( $email ); ?>
							</td>
						</tr>
					</table>

					<!-- Message Content -->
					<div style="color:#E0E0E0; font-size:15px; line-height:1.6; opacity:0.9; white-space: pre-wrap;">
						<?php echo wp_kses_post( nl2br( $message ) ); ?>
					</div>
				</td>
			</tr>
		</table>
	</td>
</tr>

<!-- Info Note -->
<tr>
	<td align="center" style="padding-bottom: 40px;">
		<p class="mono-text" style="color:#888888; font-size:11px;">
			Esta mensagem foi enviada via formulário de contato Apollo.
		</p>
	</td>
</tr>
