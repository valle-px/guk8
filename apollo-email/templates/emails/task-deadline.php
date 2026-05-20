<?php

/**
 * Task deadline reminder email template — Apollo Design System V3.
 *
 * Sent when a task deadline is soon (e.g. tomorrow).
 * Uses: Warm red-orange hero + task details card + dark pill CTA.
 *
 * Variables: $user_name, $task_title, $task_url, $project_name, $project_url,
 *            $deadline_date, $deadline_label, $assigned_by, $priority,
 *            $site_name, $site_url
 *
 * @package Apollo\Email
 * @since   3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$deadline_label = $deadline_label ?? 'Em breve';
$priority       = $priority ?? '';
$priority_color = '#f59e0b';
if ( strtolower( $priority ) === 'alta' || strtolower( $priority ) === 'high' ) {
	$priority_color = '#ef4444';
} elseif ( strtolower( $priority ) === 'media' || strtolower( $priority ) === 'medium' ) {
	$priority_color = '#f59e0b';
}
?>
<!-- MODULE: URGENCY BANNER -->
<tr>
	<td style="padding: 0 20px 32px; overflow:hidden;">
		<div style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); padding: 16px 40px; transform: rotate(-1deg); margin: 0 -10px; text-align:center; border-radius:4px;">
			<span class="mono-text" style="font-size:12px;font-weight:700;color:#fff;text-transform:uppercase;letter-spacing:.12em;">
				&#9888; Prazo se aproximando
			</span>
		</div>
	</td>
</tr>

<!-- MODULE: HERO (Red-Orange gradient) -->
<tr>
	<td style="padding: 0 20px 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background: linear-gradient(135deg, #dc2626 0%, #ea580c 100%); border-radius:28px; overflow:hidden;">
			<tr>
				<td align="center" style="padding: 72px 40px;">
					<div class="mono-text" style="font-size:11px;font-weight:700;color:rgba(var(--rgb-t),.7);text-transform:uppercase;letter-spacing:.12em;margin-bottom:24px;">
						Lembrete de Tarefa
					</div>
					<h1 class="syne-header" style="color:#fff;font-size:40px;line-height:1.1;margin-bottom:24px;letter-spacing:-0.03em;">
						<?php echo esc_html( $task_title ?? 'Tarefa sem t&#237;tulo' ); ?>
					</h1>
					<p style="color:rgba(var(--rgb-t),.92);font-size:16px;line-height:1.7;margin:0 auto 48px;max-width:440px;font-weight:400;">
						Ol&#225;, <?php echo esc_html( $user_name ?? 'usu&#225;rio(a)' ); ?>! O prazo desta tarefa &#233; <strong style="color:#fff;"><?php echo esc_html( $deadline_label ); ?></strong>. N&#227;o deixe passar.
					</p>
					<?php if ( ! empty( $task_url ) ) : ?>
					<table border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td align="center" style="border-radius:100px;background-color:#fff;box-shadow:0 10px 28px rgba(var(--rgb-d),.15);">
								<a href="<?php echo esc_url( $task_url ); ?>"
								   style="text-transform:uppercase;display:inline-block;letter-spacing:1.4px;padding:18px 48px;font-family:'Space Grotesk',Arial,sans-serif;font-size:15px;color:#dc2626;font-weight:700;border-radius:100px;">
									Ver Tarefa
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

<!-- MODULE: TASK DETAILS CARD -->
<tr>
	<td style="padding: 0 20px 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="border:2px solid #e5e5e5;border-radius:20px;">
			<tr>
				<td style="padding:36px 40px;">
					<h3 class="syne-header" style="color:#050505;font-size:20px;margin:0 0 28px;">
						Detalhes da Tarefa
					</h3>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
						<!-- Deadline -->
						<?php if ( ! empty( $deadline_date ) ) : ?>
						<tr>
							<td width="40%" style="padding:10px 0;border-bottom:1px solid #f0f0f0;">
								<span class="mono-text" style="font-size:11px;font-weight:700;color:#888;text-transform:uppercase;letter-spacing:.05em;">
									Prazo
								</span>
							</td>
							<td style="padding:10px 0;border-bottom:1px solid #f0f0f0;">
								<strong style="color:#050505;font-size:14px;">
									<?php echo esc_html( $deadline_date ); ?>
								</strong>
								<span style="display:inline-block;margin-left:8px;background:<?php echo esc_attr( $priority_color ); ?>;color:#fff;font-size:10px;font-weight:700;padding:2px 10px;border-radius:100px;text-transform:uppercase;">
									<?php echo esc_html( $deadline_label ); ?>
								</span>
							</td>
						</tr>
						<?php endif; ?>

						<!-- Project -->
						<?php if ( ! empty( $project_name ) ) : ?>
						<tr>
							<td width="40%" style="padding:10px 0;border-bottom:1px solid #f0f0f0;">
								<span class="mono-text" style="font-size:11px;font-weight:700;color:#888;text-transform:uppercase;letter-spacing:.05em;">
									Projeto
								</span>
							</td>
							<td style="padding:10px 0;border-bottom:1px solid #f0f0f0;">
								<?php if ( ! empty( $project_url ) ) : ?>
								<a href="<?php echo esc_url( $project_url ); ?>" style="color:#050505;font-size:14px;font-weight:600;text-decoration:underline;">
									<?php echo esc_html( $project_name ); ?>
								</a>
								<?php else : ?>
								<span style="color:#050505;font-size:14px;font-weight:600;">
									<?php echo esc_html( $project_name ); ?>
								</span>
								<?php endif; ?>
							</td>
						</tr>
						<?php endif; ?>

						<!-- Priority -->
						<?php if ( ! empty( $priority ) ) : ?>
						<tr>
							<td width="40%" style="padding:10px 0;border-bottom:1px solid #f0f0f0;">
								<span class="mono-text" style="font-size:11px;font-weight:700;color:#888;text-transform:uppercase;letter-spacing:.05em;">
									Prioridade
								</span>
							</td>
							<td style="padding:10px 0;border-bottom:1px solid #f0f0f0;">
								<span style="display:inline-block;background:<?php echo esc_attr( $priority_color ); ?>;color:#fff;font-size:11px;font-weight:700;padding:3px 12px;border-radius:100px;">
									<?php echo esc_html( $priority ); ?>
								</span>
							</td>
						</tr>
						<?php endif; ?>

						<!-- Assigned by -->
						<?php if ( ! empty( $assigned_by ) ) : ?>
						<tr>
							<td width="40%" style="padding:10px 0;">
								<span class="mono-text" style="font-size:11px;font-weight:700;color:#888;text-transform:uppercase;letter-spacing:.05em;">
									Atribu&#237;da por
								</span>
							</td>
							<td style="padding:10px 0;">
								<span style="color:#050505;font-size:14px;font-weight:600;">
									<?php echo esc_html( $assigned_by ); ?>
								</span>
							</td>
						</tr>
						<?php endif; ?>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>

<!-- MODULE: ACTION REMINDER (Dark card) -->
<tr>
	<td style="padding: 0 20px 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background: linear-gradient(135deg, #1f2937 0%, #374151 100%); border-radius:20px;">
			<tr>
				<td style="padding:36px 40px;">
					<h3 class="syne-header" style="color:#fff;font-size:18px;margin:0 0 14px;">
						Precisa de mais tempo?
					</h3>
					<p style="color:rgba(var(--rgb-t),.8);font-size:14px;line-height:1.6;margin:0 0 24px;">
						Se n&#227;o for poss&#237;vel concluir no prazo, entre em contato com o respons&#225;vel do projeto para renegociar a data de entrega.
					</p>
					<?php if ( ! empty( $task_url ) ) : ?>
					<table border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td style="border-radius:100px;background-color:#fbbf24;">
								<a href="<?php echo esc_url( $task_url ); ?>"
								   style="display:inline-block;padding:14px 36px;font-family:'Space Grotesk',Arial,sans-serif;font-size:14px;color:#050505;font-weight:700;border-radius:100px;">
									Abrir Tarefa no Gestor
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