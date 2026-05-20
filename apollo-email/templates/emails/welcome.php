<?php

/**
 * Welcome email template content block — Apollo Design System V3.
 *
 * Uses: Abstract Arch Hero (Amber #ffd13b) + checklist + orange pill CTA.
 * Variables: $user_name, $username, $profile_url, $site_name, $site_url
 *
 * @package Apollo\Email
 * @since   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- MODULE: WELCOME HERO (Green Arch) -->
<tr>
	<td style="padding: 0 20px 48px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       class="abstract-arch"
		       style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 240px 240px 28px 28px; overflow:hidden;">
			<tr>
				<td align="center" style="padding: 80px 40px 72px;">
					<div class="mono-text" style="font-size:12px;font-weight:700;color:#d1fae5;text-transform:uppercase;letter-spacing:.12em;margin-bottom:28px;">
						Cadastro Confirmado
					</div>
					<h1 class="syne-header" style="color:#fff;font-size:52px;line-height:1.05;margin-bottom:24px;letter-spacing:-0.03em;">
						Bem-vindx ao Apollo
					</h1>
					<p style="color:rgba(var(--rgb-t),.95);font-size:16px;line-height:1.7;margin:0 auto 48px;max-width:420px;font-weight:400;">
						Olá, <?php echo esc_html( $user_name ?? 'Novo(a) Membro' ); ?>! Você acaba de entrar para a melhor plataforma da cena noturna do Rio de Janeiro.
					</p>
					<table border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td align="center" style="border-radius:100px;background-color:#fff;box-shadow:0 10px 28px rgba(var(--rgb-d),.15);">
								<a href="<?php echo esc_url( $profile_url ?? ( $site_url ?? '#' ) ); ?>"
								   style="text-transform:uppercase;display:inline-block;letter-spacing:1.4px;padding:18px 48px;font-family:'Space Grotesk',Arial,sans-serif;font-size:15px;color:#059669;font-weight:700;border-radius:100px;">
									Acessar meu Perfil
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

<!-- MODULE: STEPS (Green #f0fdf4) -->
<tr>
	<td style="padding: 0 20px 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background-color:#f0fdf4; border-radius:28px;">
			<tr>
				<td style="padding: 44px 40px;">
					<h2 class="syne-header" style="color:#050505;font-size:26px;margin:0 0 32px;">
						O que fazer agora?
					</h2>

					<!-- Step 1 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:28px;">
						<tr>
							<td width="52" valign="top" style="padding-right:18px;">
								<div style="width:44px;height:44px;border-radius:22px;background:linear-gradient(135deg,#10b981,#059669);text-align:center;line-height:44px;">
									<span class="mono-text" style="color:#fff;font-size:18px;font-weight:700;line-height:44px;display:block;">1</span>
								</div>
							</td>
							<td valign="middle">
								<p style="color:#050505;font-size:15px;font-weight:600;margin:0 0 4px;">Complete seu perfil</p>
								<p style="color:#555;font-size:13px;margin:0;line-height:1.5;">Adicione foto, bio e suas músicas favoritas para se conectar melhor à cena.</p>
							</td>
						</tr>
					</table>

					<!-- Step 2 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:28px;">
						<tr>
							<td width="52" valign="top" style="padding-right:18px;">
								<div style="width:44px;height:44px;border-radius:22px;background:linear-gradient(135deg,#0ea5e9,#0284c7);text-align:center;line-height:44px;">
									<span class="mono-text" style="color:#fff;font-size:18px;font-weight:700;line-height:44px;display:block;">2</span>
								</div>
							</td>
							<td valign="middle">
								<p style="color:#050505;font-size:15px;font-weight:600;margin:0 0 4px;">Explore os eventos</p>
								<p style="color:#555;font-size:13px;margin:0;line-height:1.5;">Descubra festas, shows e experiências da cena noturna carioca.</p>
							</td>
						</tr>
					</table>

					<!-- Step 3 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:28px;">
						<tr>
							<td width="52" valign="top" style="padding-right:18px;">
								<div style="width:44px;height:44px;border-radius:22px;background:linear-gradient(135deg,#f59e0b,#d97706);text-align:center;line-height:44px;">
									<span class="mono-text" style="color:#fff;font-size:18px;font-weight:700;line-height:44px;display:block;">3</span>
								</div>
							</td>
							<td valign="middle">
								<p style="color:#050505;font-size:15px;font-weight:600;margin:0 0 4px;">Descubra DJs e artistas</p>
								<p style="color:#555;font-size:13px;margin:0;line-height:1.5;">Siga seus favoritos e fique por dentro de toda a programação.</p>
							</td>
						</tr>
					</table>

					<!-- Step 4 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td width="52" valign="top" style="padding-right:18px;">
								<div style="width:44px;height:44px;border-radius:22px;background:linear-gradient(135deg,#a855f7,#7c3aed);text-align:center;line-height:44px;">
									<span class="mono-text" style="color:#fff;font-size:18px;font-weight:700;line-height:44px;display:block;">4</span>
								</div>
							</td>
							<td valign="middle">
								<p style="color:#050505;font-size:15px;font-weight:600;margin:0 0 4px;">Conecte-se à comunidade</p>
								<p style="color:#555;font-size:13px;margin:0;line-height:1.5;">Entre em grupos, participe de debates e faça parte da cena.</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>

<!-- MODULE: ACCOUNT DETAILS (#f8fafc, blue left border) -->
<tr>
	<td style="padding: 0 20px 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background-color:#f8fafc;border-radius: 28px 28px 28px 28px; border: none;">
			<tr>
				<td style="padding:40px;">
					<h2 class="syne-header" style="color:#050505;font-size:22px;margin:0 0 28px;">
						Sua Conta
					</h2>

					<?php if ( ! empty( $username ) ) : ?>
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid #e2e8f0;">
						<tr>
							<td>
										<p class="mono-text" style="color:#0369a1;font-size:10px;margin:0 0 6px;text-transform:uppercase;letter-spacing:0.6px;font-weight:700;">Nome de User<font style="font-family:system-ui; font-size:110%">::</font>rio</p>
								<p style="color:#050505;font-size:15px;margin:0;font-weight:600;">@<?php echo esc_html( $username ); ?></p>
							</td>
						</tr>
					</table>
					<?php endif; ?>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid #e2e8f0;">
						<tr>
							<td>
								<p class="mono-text" style="color:#0369a1;font-size:10px;margin:0 0 6px;text-transform:uppercase;letter-spacing:0.6px;font-weight:700;">Plano</p>
								<p style="color:#050505;font-size:15px;margin:0;font-weight:600;"><?php echo esc_html( $plan_name ?? 'Apollo Gratuito' ); ?></p>
							</td>
						</tr>
					</table>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td>
								<p class="mono-text" style="color:#0369a1;font-size:10px;margin:0 0 6px;text-transform:uppercase;letter-spacing:0.6px;font-weight:700;">Membro desde</p>
								<p style="color:#050505;font-size:15px;margin:0;font-weight:600;"><?php echo esc_html( $member_since ?? wp_date( 'd/m/Y' ) ); ?></p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>

<!-- MODULE: BENEFITS GRID (2-col) -->
<tr>
	<td style="padding: 0 20px 48px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
			<tr>
				<td class="stack-column stack-pad-bottom" width="48%" valign="top" style="padding-right:8px;">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#e0f2fe;border-radius:20px;">
						<tr>
							<td style="padding:24px;">
								<p style="font-size:22px;margin:0 0 10px;">&#127926;</p>
								<p style="color:#050505;font-size:14px;font-weight:700;margin:0 0 6px;">Eventos exclusivos</p>
								<p style="color:#555;font-size:13px;margin:0;line-height:1.4;">Acesso preferencial à programação carioca</p>
							</td>
						</tr>
					</table>
				</td>
				<td class="stack-column" width="48%" valign="top" style="padding-left:8px;">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#fef08a;border-radius:20px;">
						<tr>
							<td style="padding:24px;">
								<p style="font-size:22px;margin:0 0 10px;">&#127927;</p>
								<p style="color:#050505;font-size:14px;font-weight:700;margin:0 0 6px;">DJs e artistas</p>
								<p style="color:#555;font-size:13px;margin:0;line-height:1.4;">Conecte-se com os melhores da cena</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="stack-column stack-pad-bottom" width="48%" valign="top" style="padding-right:8px;padding-top:16px;">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#dcfce7;border-radius:20px;">
						<tr>
							<td style="padding:24px;">
								<p style="font-size:22px;margin:0 0 10px;">&#9733;</p>
								<p style="color:#050505;font-size:14px;font-weight:700;margin:0 0 6px;">Comunidade ativa</p>
								<p style="color:#555;font-size:13px;margin:0;line-height:1.4;">Grupos, debates e conexões reais</p>
							</td>
						</tr>
					</table>
				</td>
				<td class="stack-column" width="48%" valign="top" style="padding-left:8px;padding-top:16px;">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f3e8ff;border-radius:20px;">
						<tr>
							<td style="padding:24px;">
								<p style="font-size:22px;margin:0 0 10px;">&#127917;</p>
								<p style="color:#050505;font-size:14px;font-weight:700;margin:0 0 6px;">Classificados</p>
								<p style="color:#555;font-size:13px;margin:0;line-height:1.4;">Equipamentos, cursos e parcerias</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td align="center" style="padding-bottom: 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" class="abstract-arch" style="background-color:#ffd13b; border-radius: 250px 250px 30px 30px; overflow:hidden;">
			<tr>
				<td align="center" style="padding: 80px 30px 50px 30px;">
					<div class="mono-text" style="font-size: 11px; color: FF9820; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 15px;">
						[ Bem-vindo(a) ]
					</div>
					<h1 class="syne-header" style="color:#050505; font-size:52px; line-height:1.05; margin-bottom:20px;">
						Olá,<br><?php echo esc_html( $user_name ?? 'Novo(a) Membro' ); ?>!
					</h1>
					<p style="color:#333333; font-size:16px; line-height:1.5; margin-bottom:35px; font-weight:500;">
						Você acaba de entrar para a melhor plataforma da cena noturna do Rio de Janeiro. Agora faz parte de uma comunidade vibrante de produtores, DJs, artistas e entusiastas.
					</p>
					<!-- Orange Pill Button -->
					<table border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td align="center" style="border-radius: 100px; background-color: FF9820;">
								<a href="<?php echo esc_url( $profile_url ?? ( $site_url ?? '#' ) ); ?>" style="display: inline-block; padding: 16px 36px; font-family: 'Space Grotesk', Arial, sans-serif; font-size: 15px; color: #ffffff; text-decoration: none; font-weight: 700; border-radius: 100px;">
									Acessar meu Perfil
								</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>

<!-- Abstract Divider -->
<tr>
	<td align="center" style="padding-bottom: 40px;">
		<div class="mono-text" style="color: #050505; font-size: 14px; letter-spacing: 8px; opacity: 0.2;">+ + + +</div>
	</td>
</tr>

<!-- MODULE: QUICK START CHECKLIST (Soft Orange) -->
<tr>
	<td align="center" style="padding-bottom: 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#fcf0dd; border-radius: 30px;">
			<tr>
				<td style="padding: 50px 40px;">
					<h2 class="syne-header" style="color:#050505; font-size:32px; line-height:1.2; margin-bottom:10px;">
						O que fazer agora?
					</h2>
					<p style="color:#555555; font-size:15px; margin-bottom: 35px;">
						Comece a explorar a plataforma com estes primeiros passos.
					</p>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td width="20" valign="top" style="padding-bottom: 18px;">
								<div style="width:10px; height:10px; border-radius:5px; background-color:FF9820; margin-top:5px;"></div>
							</td>
							<td style="font-size:15px; color:#333333; padding-bottom: 18px;">
								Explore os próximos <strong style="color:#050505;">eventos</strong>
							</td>
						</tr>
						<tr>
							<td width="20" valign="top" style="padding-bottom: 18px;">
								<div style="width:10px; height:10px; border-radius:5px; background-color:FF9820; margin-top:5px;"></div>
							</td>
							<td style="font-size:15px; color:#333333; padding-bottom: 18px;">
								Descubra <strong style="color:#050505;">DJs e artistas</strong>
							</td>
						</tr>
						<tr>
							<td width="20" valign="top" style="padding-bottom: 18px;">
								<div style="width:10px; height:10px; border-radius:5px; background-color:FF9820; margin-top:5px;"></div>
							</td>
							<td style="font-size:15px; color:#333333; padding-bottom: 18px;">
								Complete seu <strong style="color:#050505;">perfil</strong>
							</td>
						</tr>
						<tr>
							<td width="20" valign="top">
								<div style="width:10px; height:10px; border-radius:5px; background-color:FF9820; margin-top:5px;"></div>
							</td>
							<td style="font-size:15px; color:#333333;">
								Conecte-se com a <strong style="color:#050505;">comunidade</strong>
							</td>
						</tr>
					</table>

					<?php if ( ! empty( $username ) ) : ?>
						<p class="mono-text" style="color:#888888; font-size:12px; margin-top:30px;">
							Seu username: <strong style="color:#050505;">@<?php echo esc_html( $username ); ?></strong>
						</p>
					<?php endif; ?>
				</td>
			</tr>
		</table>
	</td>
</tr>
