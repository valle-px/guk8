<?php

/**
 * Password reset email template content block — Apollo Design System V3.
 *
 * Uses: Soft Orange module (#fcf0dd) + dark pill CTA + warning note.
 * Variables: $user_name, $reset_url, $site_name, $expires_in
 *
 * @package Apollo\Email
 * @since   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- SECURITY INDICATOR HEADER -->
<tr>
	<td align="center" style="padding: 0 40px 16px;">
		<p class="mono-text" style="color:#16a34a; font-size:10px; margin:0; line-height:1.6; text-align:center; font-weight:400; letter-spacing:.05em;">
			&#9632; Verifica&#231;&#227;o de Seguran&#231;a &#9632;
		</p>
	</td>
</tr>

<!-- MODULE: HERO (Navy Blue) -->
<tr>
	<td style="padding: 0 20px 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background: linear-gradient(135deg, #0f4c75 0%, #3282b8 100%); border-radius:28px; overflow:hidden;">
			<tr>
				<td align="center" style="padding: 60px 40px;">
					<!-- Badge icon -->
					<div style="font-size:64px;margin-bottom:20px;line-height:1;">&#128504;</div>
					<h1 class="syne-header" style="color:#fff;font-size:42px;line-height:1.1;margin-bottom:16px;">
						Redefinir sua<br>Senha
					</h1>
					<p style="color:rgba(var(--rgb-t),.92);font-size:16px;line-height:1.6;margin:0 auto 32px;max-width:420px;font-weight:400;">
						Ol&#225;, <?php echo esc_html( $user_name ?? 'usu&#225;rio(a)' ); ?>! Recebemos uma solicita&#231;&#227;o para redefinir sua senha no <?php echo esc_html( $site_name ?? 'Apollo Rio' ); ?>.
					</p>
					<!-- Info box -->
					<table border="0" cellpadding="0" cellspacing="0" role="presentation"
					       style="background:rgba(var(--rgb-t),.12);border-radius:16px;margin-bottom:28px;border:1px solid rgba(var(--rgb-t),.2);">
						<tr>
							<td align="center" style="padding:20px 32px;">
								<p class="mono-text" style="color:rgba(var(--rgb-t),.7);font-size:12px;margin:0 0 8px;text-transform:uppercase;letter-spacing:1px;">
									Link v&#225;lido por
								</p>
								<p class="mono-text" style="color:#ffd13b;font-size:22px;margin:0;font-weight:700;">
									<?php echo esc_html( $expires_in ?? '1 hora' ); ?>
								</p>
							</td>
						</tr>
					</table>
					<!-- CTA yellow -->
					<table border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td align="center" style="border-radius:100px;background-color:#ffd13b;">
								<a href="<?php echo esc_url( $reset_url ?? '#' ); ?>"
								   style="text-transform:uppercase;display:inline-block;letter-spacing:1px;padding:18px 48px;font-family:'Space Grotesk',Arial,sans-serif;font-size:14px;color:#050505;font-weight:700;border-radius:100px;">
									Redefinir minha Senha
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
	<td align="center" style="padding: 0 0 32px;">
		<div class="mono-text" style="color:#050505;font-size:14px;letter-spacing:8px;opacity:.18;">+ + + + + + + +</div>
	</td>
</tr>

<!-- MODULE: REQUEST DETAILS (#f8fafc) -->
<tr>
	<td style="padding: 0 20px 32px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background-color:#f8fafc;border-radius:28px;">
			<tr>
				<td style="padding:40px;">
					<h2 class="syne-header" style="color:#050505;font-size:24px;margin:0 0 24px;">
						Detalhes da Solicita&#231;&#227;o
					</h2>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid #e2e8f0;">
						<tr>
							<td width="56" valign="top" style="padding-right:16px;">
								<div style="width:48px;height:48px;border-radius:24px;background:#e0f2fe;text-align:center;line-height:48px;">
									<span style="font-size:22px;line-height:48px;display:block;">&#128205;</span>
								</div>
							</td>
							<td valign="top">
								<h3 class="syne-header" style="color:#050505;font-size:15px;margin:0 0 4px;">Solicita&#231;&#227;o recebida</h3>
								<p style="color:#666;font-size:13px;margin:0;">Se n&#227;o foi voc&#234;, ignore este email com seguran&#231;a.</p>
							</td>
						</tr>
					</table>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid #e2e8f0;">
						<tr>
							<td width="56" valign="top" style="padding-right:16px;">
								<div style="width:48px;height:48px;border-radius:24px;background:#dcfce7;text-align:center;line-height:48px;">
									<span style="font-size:22px;line-height:48px;display:block;">&#128274;</span>
								</div>
							</td>
							<td valign="top">
								<h3 class="syne-header" style="color:#050505;font-size:15px;margin:0 0 4px;">Sua senha atual est&#225; segura</h3>
								<p style="color:#666;font-size:13px;margin:0;">Nenhuma altera&#231;&#227;o foi feita ainda &#8212; s&#243; ap&#243;s clicar no link.</p>
							</td>
						</tr>
					</table>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td width="56" valign="top" style="padding-right:16px;">
								<div style="width:48px;height:48px;border-radius:24px;background:#fef08a;text-align:center;line-height:48px;">
									<span style="font-size:22px;line-height:48px;display:block;">&#8987;</span>
								</div>
							</td>
							<td valign="top">
								<h3 class="syne-header" style="color:#050505;font-size:15px;margin:0 0 4px;">Expira em <?php echo esc_html( $expires_in ?? '1 hora' ); ?></h3>
								<p style="color:#666;font-size:13px;margin:0;">Ap&#243;s expirar, solicite um novo link de redefini&#231;&#227;o.</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>

<!-- MODULE: SECURITY WARNING (#fee2e2, red left border) -->
<tr>
	<td style="padding: 0 20px 48px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background-color:#fee2e2;border-radius:28px;border-left:4px solid #dc2626;">
			<tr>
				<td style="padding:32px 40px;">
					<h3 class="syne-header" style="color:#991b1b;font-size:18px;margin:0 0 14px;">
						N&#227;o Reconhece Esta Solicita&#231;&#227;o?
					</h3>
					<p style="color:#7f1d1d;font-size:14px;line-height:1.6;margin:0 0 14px;">
						Se voc&#234; n&#227;o solicitou a redefini&#231;&#227;o, recomendamos:
					</p>
					<ul style="color:#7f1d1d;font-size:13px;line-height:1.7;margin:0;padding-left:20px;">
						<li style="margin-bottom:8px;">Verifique se sua conta foi comprometida</li>
						<li style="margin-bottom:8px;">Revise suas atividades recentes</li>
						<li>Ative a autentica&#231;&#227;o de dois fatores (2FA)</li>
					</ul>
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
					<div class="mono-text" style="font-size: 11px; color: FF9820; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 15px;">
						[ Segurança ]
					</div>
					<h2 class="syne-header" style="color:#050505; font-size:36px; line-height:1.2; margin-bottom:10px;">
						Nova chave de acesso
					</h2>
					<p style="color:#555555; font-size:15px; margin-bottom: 35px; line-height: 1.5;">
						Olá, <?php echo esc_html( $user_name ?? 'usuário(a)' ); ?>! Recebemos uma solicitação para redefinir sua senha no <?php echo esc_html( $site_name ?? 'Apollo Rio' ); ?>. Clique abaixo para criar uma nova senha.
					</p>

					<!-- Dark Pill Button -->
					<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom: 35px;">
						<tr>
							<td align="left" style="border-radius: 100px; background-color: #050505;">
								<a href="<?php echo esc_url( $reset_url ?? '#' ); ?>" style="display: inline-block; padding: 16px 36px; font-family: 'Space Grotesk', Arial, sans-serif; font-size: 15px; color: #ffffff; text-decoration: none; font-weight: 700; border-radius: 100px;">
									Redefinir minha Senha
								</a>
							</td>
						</tr>
					</table>

					<!-- Expiration Notice -->
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td width="20" valign="top">
								<div style="width:10px; height:10px; border-radius:5px; background-color:#ff3333; margin-top:5px;"></div>
							</td>
							<td style="font-size:14px; color:#555555;">
								Este link expira em <strong style="color:#050505;"><?php echo esc_html( $expires_in ?? '1 hora' ); ?></strong>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>

<!-- Info Note -->
<tr>
	<td align="center" style="padding-bottom: 40px;">
		<p class="mono-text" style="color:#888888; font-size:12px; line-height:1.6;">
			Se você não solicitou a redefinição, ignore este email — sua senha atual permanece segura.
		</p>
	</td>
</tr>
