<?php

/**
 * Email verification template content block — Apollo Design System V3.
 *
 * Uses: Abstract Arch Hero (Amber #ffd13b) + action pill CTA.
 * Variables: $user_name, $verify_url, $site_name
 *
 * @package Apollo\Email
 * @since   2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div role="article" aria-roledescription="email" lang="pt-BR"
     style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">

    <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center" style="padding: 0px;">

                <table class="container" width="600" align="center" border="0" cellpadding="0" cellspacing="0"
                       role="presentation"
                       style="width:100%;max-width:100%; background:#ffffff; border-radius:24px 24px 0 0; overflow:hidden;">

                    <!-- TOP META BAR (LESS PROMINENT) -->
                    <tr>
                        <td align="center" style="padding: 24px 40px 18px;">
                            <p class="mono-text"
                               style="color:#999; font-size:10px; margin:0 0 65px; line-height:1.6; text-align:center; font-weight:200;">
                                <a id="email-unsubscribe" href="#" style="color:#666;text-decoration:none;font-weight:200;">Cancelar inscrição</a>
                                &nbsp;|&nbsp;
                                <a id="open-onBrowser" href="#" style="color:#666;text-decoration:none;font-weight:200;">Visualização alternativa</a>
                                &nbsp;|&nbsp;
                                <a id="user-edit-email-preferences" href="#" style="color:#666;text-decoration:none;font-weight:200;">Ajustes de usuárix</a>
                            </p>
                        </td>
                    </tr>



                    <!-- HERO SECTION — CONFIRMATION FOCUS -->
                    <tr>
                        <td style="padding: 0 20px 48px;">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                   style="background: linear-gradient(135deg, #ffd13b 0%, #ffbd1f 100%); border-radius:240px 240px 28px 28px; overflow:hidden;">
                                <tr>
                                    <td align="center" style="position:relative; padding:88px 40px 78px;">

                                        <!-- Verification Icon (Pulsing) -->
                                        <div style="font-size:64px;margin-bottom:28px;display:block; width:100%;width:88px;height:88px;background:rgba(var(--rgb-d),.08);border-radius:44px;line-height:88px;text-align:center;animation:pulse 2s ease-in-out infinite;">
                                            <span style="color:#050505;font-size:48px;vertical-align:middle;">✦</span>
                                        </div>

                                        <h1 class="syne-header"
                                            style="color:#050505;font-size:54px;line-height:1.05;margin-bottom:24px;">
                                            Confirme sua<br>Conta
                                        </h1>

                                        <p style="color:#333;font-size:16px;line-height:1.6;margin:0 auto 44px;max-width:440px;font-weight:400;">
                                            Clique no botão abaixo para ativar sua conta Apollo e começar a explorar uma comunidade incrível.
                                        </p>

                                        <!-- MAIN CTA — POWERFUL & PROMINENT -->
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:32px;">
                                            <tr>
                                                <td align="center"
                                                    style="border-radius:100px;background-color:#050505;box-shadow:0 12px 36px rgba(var(--rgb-d),.2);padding:22px 60px;">
	<a href="<?php echo esc_url( $verify_url ?? '#' ); ?>"
                                                       style="text-transform:uppercase;display:block; width:100%;letter-spacing:1.4px;font-family:'Space Grotesk',Arial,sans-serif;font-size:15px;color:#ffd13b;font-weight:700;border-radius:100px;text-decoration:none;">
                                                        <span style="vertical-align:middle;margin-right:10px;font-size:20px;">✓</span>
                                                        Confirmar Conta Agora
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- ALTERNATIVE LINK (BACKUP) -->
                                        <p style="color:#333;font-size:12px;margin:0;line-height:1.5;">
                                            Ou copie e cole este link:<br>
                                            <span class="mono-text" style="color:#050505;font-size:11px;word-break:break-all;display:block;margin-top:10px;">
                                                <?php echo esc_html( $verify_url ?? '' ); ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- DIVIDER -->
                    <tr>
                        <td align="center" style="padding: 0 0 40px;">
                            <div class="mono-text"
                                 style="color:#050505;font-size:14px;letter-spacing:8px;opacity:.18;">
                                .
                            </div>
                        </td>
                    </tr>

                    <!-- ACCOUNT DETAILS SECTION -->
                    <tr>
                        <td style="padding: 0 20px 40px;">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                   style="background-color:#f0f9ff;border-radius: 28px 28px 28px 28px; border: none;">
                                <tr>
                                    <td style="padding:50px 100px;">
  <h2 class="syne-header"
                                            style="color:#050505;line-height:1;font-size:29px;margin:0 0 50px -50px;vertical-align:top;">
                                            <span style="color:#3b82f6;margin:0 10px 0 0;">🧿</span>
                                            Infos da sua Conta::rio
                                        </h2>

                                        <!-- Account Item 1 -->
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               role="presentation" style="margin-bottom:24px;padding-bottom:24px;border-bottom:1px solid #e0f2fe;">
                                            <tr>
                                                <td>
                                                    <p class="mono-text"
                                                       style="color:#0369a1;font-size:10px;margin:0 0 8px;text-transform:uppercase;letter-spacing:0.6px;font-weight:700;">
                                                        <span style="vertical-align:middle;margin-right:6px;">🔹</span>
                                                        Email
                                                    </p>
                                                    <p style="color:#050505;font-size:15px;margin:0;font-weight:600;">
                                                        <?php echo esc_html( $user_email ?? $user_name ?? '' ); ?>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Account Item 2 -->
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               role="presentation" style="margin-bottom:24px;padding-bottom:24px;border-bottom:1px solid #e0f2fe;">
                                            <tr>
                                                <td>
                                                    <p class="mono-text"
                                                       style="color:#0369a1;font-size:10px;margin:0 0 8px;text-transform:uppercase;letter-spacing:0.6px;font-weight:700;">
                                                        <span style="vertical-align:middle;margin-right:6px;">🔹</span>
                                                      User<font style="font-family:system-ui; font-size:110%">::</font>rio
                                                    </p>
                                                    <p style="color:#050505;font-size:15px;margin:0;font-weight:600;">
                                                        @<?php echo esc_html( $username ?? '' ); ?>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Account Item 3 -->
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               role="presentation" style="margin-bottom:24px;padding-bottom:24px;border-bottom:1px solid #e0f2fe;">
                                            <tr>
                                                <td>
                                                    <p class="mono-text"
                                                       style="color:#0369a1;font-size:10px;margin:0 0 8px;text-transform:uppercase;letter-spacing:0.6px;font-weight:700;">
                                                        <span style="vertical-align:middle;margin-right:6px;">🔹</span>
                                                        Cadastro
                                                    </p>
                                                    <p style="color:#050505;font-size:15px;margin:0;font-weight:600;">
                                                        <?php echo esc_html( $registration_date ?? '' ); ?>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Account Item 4 -->
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               role="presentation">
                                            <tr>
                                                <td>
                                                    <p class="mono-text"
                                                       style="color:#0369a1;font-size:10px;margin:0 0 8px;text-transform:uppercase;letter-spacing:0.6px;font-weight:700;">
                                                        <span style="vertical-align:middle;margin-right:6px;">🔹</span>
                                                        Link Expira em
                                                    </p>
                                                    <p style="color:#050505;font-size:15px;margin:0;font-weight:600;">
                                                        <?php echo esc_html( $expiration_time ?? '24 horas' ); ?>
                                                    </p>
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
                        <td align="center" style="padding: 0 0 40px;">
                            <div class="mono-text"
                                 style="color:#050505;font-size:14px;letter-spacing:8px;opacity:.18;">
                               .
                            </div>
                        </td>
                    </tr>

                    <!-- SECURITY & TRUST SECTION -->
                    <tr>
                        <td style="padding: 0 20px 40px;">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                   style="background-color:#f9f5f0;border-radius:28px;">
                                <tr>
                                    <td style="padding:50px 80px;">
  <h2 class="syne-header"
                                            style="color:#050505;line-height:1;font-size:29px;margin:0 0 50px -50px;vertical-align:top;">
                                            <span style="color:#10b981;margin:0 10px 0 0;">⛺</span>
                                            Sua Segurança é Prioridade
                                        </h3>

                                        <!-- Security Point 1 -->
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               role="presentation" style="margin-bottom:20px;">
                                            <tr>
                                                <td width="24" valign="top" style="padding-right:14px;">
                                                    <div style="width:20px;height:20px;background:#10b981;border-radius:10px;text-align:center;line-height:20px;">
                                                        <span style="color:#fff;font-size:14px;vertical-align:middle;">✓</span>
                                                    </div>
                                                </td>
                                                <td valign="top">
                                                    <p style="color:#050505;font-size:14px;margin:0;font-weight:600;">
                                                        Confirme seu email
                                                    </p>
                                                    <p style="color:#666;font-size:13px;margin:4px 0 0;">
                                                        Isso protege sua conta contra acesso não autorizado
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Security Point 2 -->
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               role="presentation" style="margin-bottom:20px;">
                                            <tr>
                                                <td width="24" valign="top" style="padding-right:14px;">
                                                    <div style="width:20px;height:20px;background:#10b981;border-radius:10px;text-align:center;line-height:20px;">
                                                        <span style="color:#fff;font-size:14px;vertical-align:middle;">✓</span>
                                                    </div>
                                                </td>
                                                <td valign="top">
                                                    <p style="color:#050505;font-size:14px;margin:0;font-weight:600;">
                                                        Ative a autenticação de dois fatores
                                                    </p>
                                                    <p style="color:#666;font-size:13px;margin:4px 0 0;">
                                                        Adicione camadas extras de segurança em Configurações
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Security Point 3 -->
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               role="presentation">
                                            <tr>
                                                <td width="24" valign="top" style="padding-right:14px;">
                                                    <div style="width:20px;height:20px;background:#10b981;border-radius:10px;text-align:center;line-height:20px;">
                                                        <span style="color:#fff;font-size:14px;vertical-align:middle;">✓</span>
                                                    </div>
                                                </td>
                                                <td valign="top">
                                                    <p style="color:#050505;font-size:14px;margin:0;font-weight:600;">
                                                        Nunca compartilhe seu link
                                                    </p>
                                                    <p style="color:#666;font-size:13px;margin:4px 0 0;">
                                                        Compartilhar o link pode permitir que outros acessem sua conta
                                                    </p>
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
                        <td align="center" style="padding: 0 0 40px;">
                            <div class="mono-text"
                                 style="color:#050505;font-size:14px;letter-spacing:8px;opacity:.18;">
                               .
                            </div>
                        </td>
                    </tr>
                    <!-- TROUBLESHOOTING SECTION -->
                    <tr>
                        <td style="padding: 0 20px 40px;">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                   style="background:#fee2e2;border-radius: 28px 28px 28px 28px; border: none;">
                                <tr>
 <td style="padding:50px 80px 25px;">
  <h2 class="syne-header"
                                            style="color:#050505;line-height:1;font-size:29px;margin:0 0 50px -50px;vertical-align:top;">
                                            <span style="color:#dc2626;margin:0 10px 0 0;">🧰️</span>
                                            Não Consegue Confirmar?
                                        </h3>

                                        <p style="color:#7f1d1d;font-size:14px;margin:0 0 16px;line-height:1.6;">
                                            <strong style="color:#991b1b;">Link expirou?</strong> Não se preocupe. Você pode solicitar um novo link de confirmação entrando em sua conta ou nos contactando.
                                        </p>

                                        <p style="color:#7f1d1d;font-size:14px;margin:0 0 18px;line-height:1.6;">
                                            <strong style="color:#991b1b;">Não recebeu este email?</strong> Verifique sua pasta de spam ou entre em contato com nosso suporte.
                                        </p><br>

                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="right">

            <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td style="border-radius:100px;background:#dc2626;padding:12px 30px;">
	<a href="#"
                           style="display:block; width:100%;font-family:'Space Grotesk',Arial,sans-serif;font-size:13px;color:#fff;font-weight:700;border-radius:100px;text-decoration:none;">
                            <span style="vertical-align:middle;margin-right:6px;font-size:15px;">🔈</span>
                            Contatar Suporte
                        </a>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- FOOTER TEXT -->

                    <!-- FOOTER SVG -->
  <!-- FOOTER TEXT -->
<tr>
  <td style="padding:100px 40px 10px;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
      <tr>

        <!-- LEFT -->
        <td align="left"
            style="color:#888;font-size:10.5px;line-height:1.8;font-family:system-ui;">
          © 2024-2026 <span style="font-weight:700;">apollo™</span>
        </td>

        <!-- RIGHT -->
        <td align="right"
            style="color:#888;font-size:10.5px;line-height:1.8;font-family:system-ui;">
          Rio de Janeiro, RJ — Brasil
        </td>

      </tr>
    </table>
  </td>
</tr>


<!-- FOOTER SVG WATERMARK -->
<tr>
  <td style="padding:0; line-height:0; margin-top:-170px; display:block; overflow:hidden; border-radius:0 0 24px 24px;">
    <div class="aprio-ft-wrap">

      <img src="https://cdn.apollo.rio.br/v1.0.0/assets/images/apollo-logo-watermark.png" alt="Apollo Rio" width="200" style="display:block; max-width:200px; border:0; opacity:0.1; width:100%; margin: 0 auto;">

    </div>
  </td>
</tr>

                </table>
                <!-- /inner container -->

            </td>
        </tr>
    </table>

</div>
<!-- MODULE: VERIFY EMAIL HERO (Yellow Arch) -->
<tr>
	<td style="padding: 0 20px 48px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       class="abstract-arch"
		       style="background: linear-gradient(135deg, #ffd13b 0%, #ffbd1f 100%); border-radius: 240px 240px 28px 28px; overflow:hidden;">
			<tr>
				<td align="center" style="padding: 80px 40px 72px;">
					<!-- Pulsing icon -->
					<div style="width:88px;height:88px;border-radius:44px;background:rgba(var(--rgb-d),.08);text-align:center;line-height:88px;margin:0 auto 32px;">
						<span style="font-size:44px;line-height:88px;display:block;">&#128386;</span>
					</div>
					<h1 class="syne-header" style="color:#050505;font-size:54px;line-height:1.05;margin-bottom:20px;letter-spacing:-0.03em;">
						Confirme<br>sua Conta
					</h1>
					<p style="color:#333;font-size:16px;line-height:1.7;margin:0 auto 40px;max-width:420px;font-weight:500;">
						Olá, <?php echo esc_html( $user_name ?? 'usuário(a)' ); ?>! Clique abaixo para verificar seu email e ativar sua conta no <?php echo esc_html( $site_name ?? 'Apollo Rio' ); ?>.
					</p>
					<!-- Inverted dark CTA -->
					<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:24px;">
						<tr>
							<td align="center" style="border-radius:100px;background-color:#050505;">
								<a href="<?php echo esc_url( $verify_url ?? '#' ); ?>"
								   style="text-transform:uppercase;display:inline-block;letter-spacing:1px;padding:22px 60px;font-family:'Space Grotesk',Arial,sans-serif;font-size:15px;color:#ffd13b;font-weight:700;border-radius:100px;">
									Verificar meu Email
								</a>
							</td>
						</tr>
					</table>
					<!-- Fallback link text -->
					<p style="color:#333;font-size:13px;margin:0;line-height:1.6;">
						Ou copie o link abaixo:<br>
						<span class="mono-text" style="color:#050505;font-size:11px;word-break:break-all;display:block;margin-top:8px;">
							<?php echo esc_html( $verify_url ?? '' ); ?>
						</span>
					</p>
				</td>
			</tr>
		</table>
	</td>
</tr>

<!-- DIVIDER -->
<tr>
	<td align="center" style="padding: 0 0 40px;">
		<div class="mono-text" style="color:#050505;font-size:14px;letter-spacing:8px;opacity:.18;">+ + + + + + + +</div>
	</td>
</tr>

<!-- MODULE: ACCOUNT DETAILS (#f0f9ff, blue left border) -->
<tr>
	<td style="padding: 0 20px 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background-color:#f0f9ff;border-radius: 28px 28px 28px 28px; border: none;">
			<tr>
				<td style="padding:44px 40px;">
					<h2 class="syne-header" style="color:#050505;font-size:22px;margin:0 0 32px;">
						Informações da Sua Conta
					</h2>

					<?php if ( ! empty( $username ) ) : ?>
					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:24px;padding-bottom:24px;border-bottom:1px solid #e0f2fe;">
						<tr>
							<td>
										<p class="mono-text" style="color:#0369a1;font-size:10px;margin:0 0 8px;text-transform:uppercase;letter-spacing:0.6px;font-weight:700;">Nome de User<font style="font-family:system-ui; font-size:110%">::</font>rio</p>
								<p style="color:#050505;font-size:15px;margin:0;font-weight:600;">@<?php echo esc_html( $username ); ?></p>
							</td>
						</tr>
					</table>
					<?php endif; ?>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:24px;padding-bottom:24px;border-bottom:1px solid #e0f2fe;">
						<tr>
							<td>
								<p class="mono-text" style="color:#0369a1;font-size:10px;margin:0 0 8px;text-transform:uppercase;letter-spacing:0.6px;font-weight:700;">Data de Cadastro</p>
								<p style="color:#050505;font-size:15px;margin:0;font-weight:600;"><?php echo esc_html( $registration_date ?? wp_date( 'd/m/Y' ) ); ?></p>
							</td>
						</tr>
					</table>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td>
								<p class="mono-text" style="color:#0369a1;font-size:10px;margin:0 0 8px;text-transform:uppercase;letter-spacing:0.6px;font-weight:700;">Link Expira em</p>
								<p style="color:#050505;font-size:15px;margin:0;font-weight:600;"><?php echo esc_html( $expires_in ?? '48 horas' ); ?></p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>

<!-- MODULE: SECURITY & TRUST (#f9f5f0) -->
<tr>
	<td style="padding: 0 20px 40px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background-color:#f9f5f0;border-radius:28px;">
			<tr>
				<td style="padding:40px;">
					<h3 class="syne-header" style="color:#050505;font-size:20px;margin:0 0 26px;">
						Sua Segurança é Prioridade
					</h3>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:20px;">
						<tr>
							<td width="28" valign="top" style="padding-right:14px;">
								<div style="width:20px;height:20px;background:#10b981;border-radius:10px;text-align:center;line-height:20px;">
									<span style="color:#fff;font-size:12px;font-weight:700;">&#10003;</span>
								</div>
							</td>
							<td valign="top">
								<p style="color:#050505;font-size:14px;margin:0;font-weight:600;">Confirme seu email</p>
								<p style="color:#666;font-size:13px;margin:4px 0 0;">Isso protege sua conta contra acesso não autorizado</p>
							</td>
						</tr>
					</table>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:20px;">
						<tr>
							<td width="28" valign="top" style="padding-right:14px;">
								<div style="width:20px;height:20px;background:#10b981;border-radius:10px;text-align:center;line-height:20px;">
									<span style="color:#fff;font-size:12px;font-weight:700;">&#10003;</span>
								</div>
							</td>
							<td valign="top">
								<p style="color:#050505;font-size:14px;margin:0;font-weight:600;">Ative a autenticação de dois fatores</p>
								<p style="color:#666;font-size:13px;margin:4px 0 0;">Adicione camadas extras de segurança em Configurações</p>
							</td>
						</tr>
					</table>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td width="28" valign="top" style="padding-right:14px;">
								<div style="width:20px;height:20px;background:#10b981;border-radius:10px;text-align:center;line-height:20px;">
									<span style="color:#fff;font-size:12px;font-weight:700;">&#10003;</span>
								</div>
							</td>
							<td valign="top">
								<p style="color:#050505;font-size:14px;margin:0;font-weight:600;">Nunca compartilhe seu link</p>
								<p style="color:#666;font-size:13px;margin:4px 0 0;">Compartilhar o link pode permitir que outros acessem sua conta</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>

<!-- MODULE: TROUBLESHOOTING (#fee2e2, red left border) -->
<tr>
	<td style="padding: 0 20px 48px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
		       style="background:#fee2e2;border-radius: 28px 28px 28px 28px; border: none;">
			<tr>
				<td style="padding:36px 40px;">
					<h3 class="syne-header" style="color:#991b1b;font-size:18px;margin:0 0 16px;">
						Não Consegue Confirmar?
					</h3>
					<p style="color:#7f1d1d;font-size:14px;margin:0 0 12px;line-height:1.6;">
						<strong style="color:#991b1b;">Link expirou?</strong> Solicite um novo link entrando em sua conta ou contactando o suporte.
					</p>
					<p style="color:#7f1d1d;font-size:13px;margin:0;line-height:1.6;">
						Se você não criou uma conta, ignore este email — nenhuma ação é necessária.
					</p>
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
						[ Ação Necessária ]
					</div>
					<h1 class="syne-header" style="color:#050505; font-size:52px; line-height:1.05; margin-bottom:20px;">
						Verifique<br>seu Email
					</h1>
					<p style="color:#333333; font-size:16px; line-height:1.5; margin-bottom:35px; font-weight:500;">
						Olá, <?php echo esc_html( $user_name ?? 'usuário(a)' ); ?>! Para completar seu cadastro no <?php echo esc_html( $site_name ?? 'Apollo Rio' ); ?>, precisamos confirmar seu endereço de email.
					</p>
					<!-- Orange Pill Button -->
					<table border="0" cellpadding="0" cellspacing="0" role="presentation">
						<tr>
							<td align="center" style="border-radius: 100px; background-color: FF9820;">
								<a href="<?php echo esc_url( $verify_url ?? '#' ); ?>" style="display: inline-block; padding: 16px 36px; font-family: 'Space Grotesk', Arial, sans-serif; font-size: 15px; color: #ffffff; text-decoration: none; font-weight: 700; border-radius: 100px;">
									Verificar meu Email
								</a>
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
			Se você não criou uma conta, ignore este email.
		</p>
	</td>
</tr>
