<?php

class Model_email extends CI_Model
{



	function __construct()
	{

		parent::__construct();

	}



	#  leonardojimenez@juventudeterna.com.co

	var $config = array(

		'protocol' => 'smtp',

		'smtp_host' => 'mail.ecomm.com.co',

		'smtp_port' => '25',

		'smtp_user' => 'noresponder@ecomm.com.co',
		//'no-responder@tiindo.com',

		'smtp_pass' => 'Mn},^8{#T]WN',
		//'jBM4,stW%8Bs', ##'LIpo12@$',//'@7EC-6AeB4?X',

		'mailtype' => 'html',

		'charset' => 'iso-8859-1',

		'codigo' => 'noresponder@ecomm.com.co',

	);









	public function codigo_seguridad($correo, $codigo, $user)
	{
		#### Generamos un string randomico para la nueva contraseña
		$data_email = array();
		$data_email["email_tipo"] = "codigo";
		$data_email["email_remitente"] = $this->config["smtp_user"];
		$data_email["email_destinatario"] = $correo;
		$data_email["email_asunto"] = "[Ecomm] Codigo de seguridad";

		$message = "
		<html>
		<head>
		<title></title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge' />
		<style type='text/css'>
			/* FONTS */
			@media screen {
				@font-face {
				  font-family: 'Lato';
				  font-style: normal;
				  font-weight: 400;
				  src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
				}
				
				@font-face {
				  font-family: 'Lato';
				  font-style: normal;
				  font-weight: 700;
				  src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
				}
				
				@font-face {
				  font-family: 'Lato';
				  font-style: italic;
				  font-weight: 400;
				  src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
				}
				
				@font-face {
				  font-family: 'Lato';
				  font-style: italic;
				  font-weight: 700;
				  src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
				}
			}
			
			/* CLIENT-SPECIFIC STYLES */
			body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
			table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
			img { -ms-interpolation-mode: bicubic; }
		
			/* RESET STYLES */
			img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
			table { border-collapse: collapse !important; }
			body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
		
			/* iOS BLUE LINKS */
			a[x-apple-data-detectors] {
				color: inherit !important;
				text-decoration: none !important;
				font-size: inherit !important;
				font-family: inherit !important;
				font-weight: inherit !important;
				line-height: inherit !important;
			}
			
			/* MOBILE STYLES */
			@media screen and (max-width:600px){
				h1 {
					font-size: 32px !important;
					line-height: 32px !important;
				}
			}
		
			/* ANDROID CENTER FIX */
			div[style*='margin: 16px 0;'] { margin: 0 !important; }
		</style>
		</head>
		<body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
	
		
		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
			<!-- LOGO -->
			<tr>
				<td bgcolor='gray' align='center'>
					<!--[if (gte mso 9)|(IE)]>
					<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
					<tr>
					<td align='center' valign='top' width='600'>
					<![endif]-->
					<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
						<tr>
							<td align='center' valign='top' style='padding: 40px 10px 40px 10px;'>
									<img alt='Logo' src='https://www.ecomm.com.co/dist/favicon.png' width='180' height='180' style='display: block; width: 180px; max-width: 180px; min-width: 180px; font-family: 'Lato', Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;' border='0'>
							</td>
						</tr>
					</table>
					<!--[if (gte mso 9)|(IE)]>
					</td>
					</tr>
					</table>
					<![endif]-->
				</td>
			</tr>
			<!-- HERO -->
			<tr>
				<td bgcolor='gray' align='center' style='padding: 0px 10px 0px 10px;'>
					<!--[if (gte mso 9)|(IE)]>
					<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
					<tr>
					<td align='center' valign='top' width='600'>
					<![endif]-->
					<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
						<tr>
							<td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
							  <h1 style='font-size: 48px; font-weight: 400; margin: 0;'>¿Olvidaste la clave?</h1>
							</td>
						</tr>
					</table>
					<!--[if (gte mso 9)|(IE)]>
					</td>
					</tr>
					</table>
					<![endif]-->
				</td>
			</tr>
			<!-- COPY BLOCK -->
			<tr>
				<td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
					<!--[if (gte mso 9)|(IE)]>
					<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
					<tr>
					<td align='center' valign='top' width='600'>
					<![endif]-->
					<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
					  <!-- COPY -->
					  
					  <tr>
						<td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
						  <p style='margin: 0;'>Estás apunto de recuperar tu contraseña</p>
						</td>
					  </tr>
					  
					  <!-- COPY -->
					  <tr>
						<td bgcolor='#ffffff' align='left' style='padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
						  <p style='margin: 0;'>Si en realidad se te olvidó la contraseña, ingresa el siguiente código en el enlace que aparecerá abajo</p>
						</td>
					  </tr>
					  <!-- COPY -->
						<tr>
						  <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
							<CENTER><h2 style='margin: 0; color: #FFA73B;'>$codigo</h2></CENTER>
						  </td>
						</tr>
						<tr>
							<td bgcolor='#ffffff' align='left' style='padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
								<a href='https://www.ecomm.com.co/Inicio_page/Proceso/$user'>https://www.ecomm.com.co/Inicio_page/Cambio</a>
							</td>
						</tr>
					 
					</table>
					<!--[if (gte mso 9)|(IE)]>
					</td>
					</tr>
					</table>
					<![endif]-->
				</td>
			</tr>
			<!-- SUPPORT CALLOUT -->
			<tr>
				<td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 0px 10px;'>
					<!--[if (gte mso 9)|(IE)]>
					<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
					<tr>
					<td align='center' valign='top' width='600'>
					<![endif]-->
					<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
						<!-- HEADLINE -->
						<tr>
						  <td bgcolor='#FFF0D1' align='center' style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
							<h2 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'>¿No solicitaste el código?</h2>
							<p style='margin: 0; color: #9B4503;'>Haz caso omiso</p>
						  </td>
						</tr>
					</table>
					<!--[if (gte mso 9)|(IE)]>
					</td>
					</tr>
					</table>
					<![endif]-->
				</td>
			</tr>
			
		</table>
			
		</body>
		</html>
		";
		$data_email["email_mensaje"] = $message;
		$data_email["preparado"] = 1;
		$this->db->insert("dge_envio_email", $data_email);
		$responce = array(0 => false, 1 => "Envio programado exitosamente");
		return $responce;

	}

	public function notificacion_comercio($correo)
	{
		#### Generamos un string randomico para la nueva contraseña

		$data_email = array();

		$data_email["email_tipo"] = "codigo";

		$data_email["email_remitente"] = $this->config["smtp_user"];

		$data_email["email_destinatario"] = $correo;

		$data_email["email_asunto"] = "[Ecomm] Pedido por e´comm";

		$message = "

	<html>

	<head>

	<title></title>

	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

	<meta name='viewport' content='width=device-width, initial-scale=1'>

	<meta http-equiv='X-UA-Compatible' content='IE=edge' />

	<style type='text/css'>

		/* FONTS */

		@media screen {

			@font-face {

			  font-family: 'Lato';

			  font-style: normal;

			  font-weight: 400;

			  src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');

			}

			

			@font-face {

			  font-family: 'Lato';

			  font-style: normal;

			  font-weight: 700;

			  src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');

			}

			

			@font-face {

			  font-family: 'Lato';

			  font-style: italic;

			  font-weight: 400;

			  src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');

			}

			

			@font-face {

			  font-family: 'Lato';

			  font-style: italic;

			  font-weight: 700;

			  src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');

			}

		}

		

		/* CLIENT-SPECIFIC STYLES */

		body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }

		table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }

		img { -ms-interpolation-mode: bicubic; }

	

		/* RESET STYLES */

		img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }

		table { border-collapse: collapse !important; }

		body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

	

		/* iOS BLUE LINKS */

		a[x-apple-data-detectors] {

			color: inherit !important;

			text-decoration: none !important;

			font-size: inherit !important;

			font-family: inherit !important;

			font-weight: inherit !important;

			line-height: inherit !important;

		}

		

		/* MOBILE STYLES */

		@media screen and (max-width:600px){

			h1 {

				font-size: 32px !important;

				line-height: 32px !important;

			}

		}

	

		/* ANDROID CENTER FIX */

		div[style*='margin: 16px 0;'] { margin: 0 !important; }

	</style>

	</head>

	<body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>



	

	<table border='0' cellpadding='0' cellspacing='0' width='100%'>

		<!-- LOGO -->

		<tr>

			<td bgcolor='gray' align='center'>

				<!--[if (gte mso 9)|(IE)]>

				<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>

				<tr>

				<td align='center' valign='top' width='600'>

				<![endif]-->

				<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >

					<tr>

						<td align='center' valign='top' style='padding: 40px 10px 40px 10px;'>

								<img alt='Logo' src='https://www.ecomm.com.co/dist/favicon.png' width='180' height='180' style='display: block; width: 180px; max-width: 180px; min-width: 180px; font-family: 'Lato', Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;' border='0'>

						</td>

					</tr>

				</table>

				<!--[if (gte mso 9)|(IE)]>

				</td>

				</tr>

				</table>

				<![endif]-->

			</td>

		</tr>

		<!-- HERO -->

		<tr>

			<td bgcolor='gray' align='center' style='padding: 0px 10px 0px 10px;'>

				<!--[if (gte mso 9)|(IE)]>

				<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>

				<tr>

				<td align='center' valign='top' width='600'>

				<![endif]-->

				<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >

					<tr>

						<td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>

						  <h1 style='font-size: 48px; font-weight: 400; margin: 0;'>Tienes un pedido pendiente en e´comm</h1>

						</td>

					</tr>

				</table>

				<!--[if (gte mso 9)|(IE)]>

				</td>

				</tr>

				</table>

				<![endif]-->

			</td>

		</tr>

		<!-- COPY BLOCK -->

		<tr>

			<td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>

				<!--[if (gte mso 9)|(IE)]>

				<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>

				<tr>

				<td align='center' valign='top' width='600'>

				<![endif]-->

				<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >

				  <!-- COPY -->

				  

				  <tr>

					<td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >

					  <p style='margin: 0;'>ingresa a la plataforma de e´comm y consulta tu pedido</p>

					</td>

				  </tr>

				  

				  

					<tr>

						<td bgcolor='#ffffff' align='left' style='padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >

							<a href='https://www.ecomm.com.co/Inicio_page/login'>https://www.ecomm.com.co/Inicio_page/login</a>

						</td>

					</tr>

				 

				</table>

				<!--[if (gte mso 9)|(IE)]>

				</td>

				</tr>

				</table>

				<![endif]-->

			</td>

		</tr>

	

		

	</table>

		

	</body>

	</html>

	";

		$data_email["email_mensaje"] = $message;

		$data_email["preparado"] = 1;

		$this->db->insert("dge_envio_email", $data_email);

		$responce = array(0 => false, 1 => "Envio programado exitosamente");

		return $responce;



	}


	public function email_pedido($correo, $user)
	{

		#### Generamos un string randomico para la nueva contraseña

		$data_email = array();

		$data_email["email_tipo"] = "codigo";

		$data_email["email_remitente"] = $this->config["smtp_user"];

		$data_email["email_destinatario"] = $correo;

		$data_email["email_asunto"] = "[Ecomm] Pedido pendiente";



		$message = "

	<html>

	<head>

	<title></title>

	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

	<meta name='viewport' content='width=device-width, initial-scale=1'>

	<meta http-equiv='X-UA-Compatible' content='IE=edge' />

	<style type='text/css'>

		/* FONTS */

		@media screen {

			@font-face {

			  font-family: 'Lato';

			  font-style: normal;

			  font-weight: 400;

			  src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');

			}

			

			@font-face {

			  font-family: 'Lato';

			  font-style: normal;

			  font-weight: 700;

			  src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');

			}

			

			@font-face {

			  font-family: 'Lato';

			  font-style: italic;

			  font-weight: 400;

			  src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');

			}

			

			@font-face {

			  font-family: 'Lato';

			  font-style: italic;

			  font-weight: 700;

			  src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');

			}

		}

		

		/* CLIENT-SPECIFIC STYLES */

		body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }

		table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }

		img { -ms-interpolation-mode: bicubic; }

	

		/* RESET STYLES */

		img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }

		table { border-collapse: collapse !important; }

		body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

	

		/* iOS BLUE LINKS */

		a[x-apple-data-detectors] {

			color: inherit !important;

			text-decoration: none !important;

			font-size: inherit !important;

			font-family: inherit !important;

			font-weight: inherit !important;

			line-height: inherit !important;

		}

		

		/* MOBILE STYLES */

		@media screen and (max-width:600px){

			h1 {

				font-size: 32px !important;

				line-height: 32px !important;

			}

		}

	

		/* ANDROID CENTER FIX */

		div[style*='margin: 16px 0;'] { margin: 0 !important; }

	</style>

	</head>

	<body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>



	

	<table border='0' cellpadding='0' cellspacing='0' width='100%'>

		<!-- LOGO -->

		<tr>

			<td bgcolor='gray' align='center'>

				<!--[if (gte mso 9)|(IE)]>

				<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>

				<tr>

				<td align='center' valign='top' width='600'>

				<![endif]-->

				<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >

					<tr>

						<td align='center' valign='top' style='padding: 40px 10px 40px 10px;'>

								<img alt='Logo' src='https://www.ecomm.com.co/dist/favicon.png' width='180' height='180' style='display: block; width: 180px; max-width: 180px; min-width: 180px; font-family: 'Lato', Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;' border='0'>

						</td>

					</tr>

				</table>

				<!--[if (gte mso 9)|(IE)]>

				</td>

				</tr>

				</table>

				<![endif]-->

			</td>

		</tr>

		<!-- HERO -->

		<tr>

			<td bgcolor='gray' align='center' style='padding: 0px 10px 0px 10px;'>

				<!--[if (gte mso 9)|(IE)]>

				<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>

				<tr>

				<td align='center' valign='top' width='600'>

				<![endif]-->

				<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >

					<tr>

						<td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>

						  <h1 style='font-size: 48px; font-weight: 400; margin: 0;'>¿Olvidaste la clave?</h1>

						</td>

					</tr>

				</table>

				<!--[if (gte mso 9)|(IE)]>

				</td>

				</tr>

				</table>

				<![endif]-->

			</td>

		</tr>

		<!-- COPY BLOCK -->

		<tr>

			<td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>

				<!--[if (gte mso 9)|(IE)]>

				<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>

				<tr>

				<td align='center' valign='top' width='600'>

				<![endif]-->

				<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >

				  <!-- COPY -->

                  

				  <tr>

					<td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >

					  <p style='margin: 0;'>Estás apunto de recuperar tu contraseña</p>

					</td>

				  </tr>

				  

				  <!-- COPY -->

				  <tr>

					<td bgcolor='#ffffff' align='left' style='padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >

					  <p style='margin: 0;'>Si en realidad se te olvidó la contraseña, ingresa el siguiente código en el enlace que aparecerá abajo</p>

					</td>

				  </tr>

				  <!-- COPY -->

					<tr>

					  <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >

					

					  </td>

					</tr>

                    <tr>

                        <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >

                            <a href='https://www.ecomm.com.co/Inicio_page/Proceso/$user'>https://www.ecomm.com.co/Inicio_page/Cambio</a>

                        </td>

                    </tr>

				 

				</table>

				<!--[if (gte mso 9)|(IE)]>

				</td>

				</tr>

				</table>

				<![endif]-->

			</td>

		</tr>

		<!-- SUPPORT CALLOUT -->

		<tr>

			<td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 0px 10px;'>

				<!--[if (gte mso 9)|(IE)]>

				<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>

				<tr>

				<td align='center' valign='top' width='600'>

				<![endif]-->

				<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >

					<!-- HEADLINE -->

					<tr>

					  <td bgcolor='#FFF0D1' align='center' style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >

						<h2 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'>¿No solicitaste el código?</h2>

						<p style='margin: 0; color: #9B4503;'>Haz caso omiso</p>

					  </td>

					</tr>

				</table>

				<!--[if (gte mso 9)|(IE)]>

				</td>

				</tr>

				</table>

				<![endif]-->

			</td>

		</tr>

		

	</table>

		

	</body>

	</html>

	";

		$data_email["email_mensaje"] = $message;

		$data_email["preparado"] = 1;

		$this->db->insert("dge_envio_email", $data_email);

		$responce = array(0 => false, 1 => "Envio programado exitosamente");

		return $responce;



	}



	/*correo de envio_correos_bienvenida */

	public function correo_registro($correo, $usuario, $password)
	{





		#### Generamos un string randomico para la nueva contraseña

		$data_email = array();

		$data_email["email_remitente"] = $this->config["smtp_user"];

		$data_email["email_destinatario"] = $correo;

		$data_email["email_asunto"] = "[Tiindo] Te da la Bienvenida";



		$ruta_banner = base_url() . "images/bannercorreo.png";

		$noborrar = "

	<tr>

	<td style=' text-align: center; '>

		<img src='$ruta_banner' width='60%' alt=''>

	</td>

</tr>

	";



		$message = "

	<html>

	<head>

		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

	</head>

	<body>

		<table style='border: 1px solid #010101;border-radius: 5px;width: 600px;background-color:white;' align='center'>

			

			<tr style=' text-align: center; '>

				<td >



						<br>

						<font style='color:black'>Hola, ¿qué tal? <br><br>

						<font style='color:black'>gracias por registrarte en TIINDO  <br><br>

						<font style='color:black'>ahora podras ingresar <br>

						https://www.tiindo.com/ingreso/



						<strong><h3><font style='color:black'>Tu usuario es: </h3></strong> " . $usuario . " <hr>

						<strong><h3><font style='color:black'>Tu Contraseña es: </h3></strong> " . $password . "



						<br>



						<br><br><br>



						<strong>Equipo Tiindo</strong>

					</p>

				</td>

			</tr>

		</table>

	</body>

	</html>



	";

		$data_email["email_mensaje"] = $message;

		$data_email["preparado"] = 1;

		$this->db->insert("dge_envio_email", $data_email);

		$responce = array(0 => false, 1 => "Envio programado exitosamente");

		return $responce;



	}





	public function envio_correo_diario($dia, $asunto, $mensaje, $correo, $celu_papa, $msg_whatsapp)
	{





		#### Generamos un string randomico para la nueva contraseña

		$data_email = array();

		$data_email["email_remitente"] = $this->libertadvida["smtp_user"];

		$data_email["email_destinatario"] = $correo;

		$data_email["email_asunto"] = $asunto;



		$message = "

	<html>

	<head>

		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

	</head>

	<body style='background-color:#082B5B;'>

		<table style='border: 1px solid #010101;border-radius: 5px;width: 600px;background-color:white;' align='center'>

			<tr>



			</tr>

			<tr >

				<td >



						<br>



						<font style='color:black'>	" . $mensaje . "







				</td>

			</tr>

			<tr style=' text-align: center; '>



					<br>	<br>

					Te asesoráramos en algo?,<br> estamos siempre disponibles para ayudarte

					<br>	<br>

					Escríbenos

					<br>	<br>



					<a href='https://api.whatsapp.com/send?phone=" . $celu_papa . "&text=" . $msg_whatsapp . "' class='btn green-blue-bg btn-lg

					pix-white'>

							<span class='pix_edit_text'>

									<strong>Hablar con un asesor</strong>

							</span>

					</a>



											<br>	<br>

																	<br>	<br>

					<strong>Equipo Libertad Financiera</strong>



			</tr>

		</table>

	</body>

	</html>



	";

		$data_email["email_mensaje"] = $message;

		$data_email["preparado"] = 1;

		$data_email["email_tipo"] = "libertad_latinoamerica";

		$this->db->insert("dge_envio_email", $data_email);

		$responce = array(0 => false, 1 => "Envio programado exitosamente");

		return $responce;



	}
	public function prueba($correo, $codigo, $user)
	{


		#### Generamos un string randomico para la nueva contraseña
		$data_email = array();
		$data_email["email_tipo"] = "codigo";
		$data_email["email_remitente"] = $this->config["smtp_user"];
		$data_email["email_destinatario"] = $correo;
		$data_email["email_asunto"] = "[Ecomm] Codigo de seguridad";

		$message = "
		<html>
		<head>
		<title></title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge' />
		<style type='text/css'>
			/* FONTS */
			@media screen {
				@font-face {
				  font-family: 'Lato';
				  font-style: normal;
				  font-weight: 400;
				  src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
				}
				
				@font-face {
				  font-family: 'Lato';
				  font-style: normal;
				  font-weight: 700;
				  src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
				}
				
				@font-face {
				  font-family: 'Lato';
				  font-style: italic;
				  font-weight: 400;
				  src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
				}
				
				@font-face {
				  font-family: 'Lato';
				  font-style: italic;
				  font-weight: 700;
				  src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
				}
			}
			
			/* CLIENT-SPECIFIC STYLES */
			body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
			table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
			img { -ms-interpolation-mode: bicubic; }
		
			/* RESET STYLES */
			img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
			table { border-collapse: collapse !important; }
			body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
		
			/* iOS BLUE LINKS */
			a[x-apple-data-detectors] {
				color: inherit !important;
				text-decoration: none !important;
				font-size: inherit !important;
				font-family: inherit !important;
				font-weight: inherit !important;
				line-height: inherit !important;
			}
			
			/* MOBILE STYLES */
			@media screen and (max-width:600px){
				h1 {
					font-size: 32px !important;
					line-height: 32px !important;
				}
			}
		
			/* ANDROID CENTER FIX */
			div[style*='margin: 16px 0;'] { margin: 0 !important; }
		</style>
		</head>
		<body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
	
		
		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
			<!-- LOGO -->
			<tr>
				<td bgcolor='gray' align='center'>
					<!--[if (gte mso 9)|(IE)]>
					<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
					<tr>
					<td align='center' valign='top' width='600'>
					<![endif]-->
					<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
						<tr>
							<td align='center' valign='top' style='padding: 40px 10px 40px 10px;'>
									<img alt='Logo' src='https://www.ecomm.com.co/dist/favicon.png' width='180' height='180' style='display: block; width: 180px; max-width: 180px; min-width: 180px; font-family: 'Lato', Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;' border='0'>
							</td>
						</tr>
					</table>
					<!--[if (gte mso 9)|(IE)]>
					</td>
					</tr>
					</table>
					<![endif]-->
				</td>
			</tr>
			<!-- HERO -->
			<tr>
				<td bgcolor='gray' align='center' style='padding: 0px 10px 0px 10px;'>
					<!--[if (gte mso 9)|(IE)]>
					<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
					<tr>
					<td align='center' valign='top' width='600'>
					<![endif]-->
					<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
						<tr>
							<td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
							  <h1 style='font-size: 48px; font-weight: 400; margin: 0;'>¿Olvidaste la clave?</h1>
							</td>
						</tr>
					</table>
					<!--[if (gte mso 9)|(IE)]>
					</td>
					</tr>
					</table>
					<![endif]-->
				</td>
			</tr>
			<!-- COPY BLOCK -->
			<tr>
				<td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
					<!--[if (gte mso 9)|(IE)]>
					<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
					<tr>
					<td align='center' valign='top' width='600'>
					<![endif]-->
					<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
					  <!-- COPY -->
					  
					  <tr>
						<td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
						  <p style='margin: 0;'>Estás apunto de recuperar tu contraseña</p>
						</td>
					  </tr>
					  
					  <!-- COPY -->
					  <tr>
						<td bgcolor='#ffffff' align='left' style='padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
						  <p style='margin: 0;'>Si en realidad se te olvidó la contraseña, ingresa el siguiente código en el enlace que aparecerá abajo</p>
						</td>
					  </tr>
					  <!-- COPY -->
						<tr>
						  <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
							<CENTER><h2 style='margin: 0; color: #FFA73B;'>$codigo</h2></CENTER>
						  </td>
						</tr>
						<tr>
							<td bgcolor='#ffffff' align='left' style='padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
								<a href='https://www.ecomm.com.co/Inicio_page/Proceso/$user'>https://www.ecomm.com.co/Inicio_page/Cambio</a>
							</td>
						</tr>
					 
					</table>
					<!--[if (gte mso 9)|(IE)]>
					</td>
					</tr>
					</table>
					<![endif]-->
				</td>
			</tr>
			<!-- SUPPORT CALLOUT -->
			<tr>
				<td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 0px 10px;'>
					<!--[if (gte mso 9)|(IE)]>
					<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
					<tr>
					<td align='center' valign='top' width='600'>
					<![endif]-->
					<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
						<!-- HEADLINE -->
						<tr>
						  <td bgcolor='#FFF0D1' align='center' style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
							<h2 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'>¿No solicitaste el código?</h2>
							<p style='margin: 0; color: #9B4503;'>Haz caso omiso</p>
						  </td>
						</tr>
					</table>
					<!--[if (gte mso 9)|(IE)]>
					</td>
					</tr>
					</table>
					<![endif]-->
				</td>
			</tr>
			
		</table>
			
		</body>
		</html>
		";
		$data_email["email_mensaje"] = $message;
		$data_email["preparado"] = 1;
		$this->db->insert("dge_envio_email", $data_email);
		$responce = array(0 => false, 1 => "Envio programado exitosamente");
		return $responce;

	}
	public function Getapikey($correo, $codigo)
	{

		#### Generamos un string randomico para la nueva contraseña

		$data_email = array();

		$data_email["email_tipo"] = "Codigo Apikey Pago Ecommpay";

		$data_email["email_remitente"] = $this->config["smtp_user"];

		$data_email["email_destinatario"] = $correo;

		$data_email["email_asunto"] = "[Ecomm] Apikey Pago Ecommpay";



		$message = "

	<html>

	<head>

	<title></title>

	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

	<meta name='viewport' content='width=device-width, initial-scale=1'>

	<meta http-equiv='X-UA-Compatible' content='IE=edge' />

	<style type='text/css'>

		/* FONTS */

		@media screen {

			@font-face {

			  font-family: 'Lato';

			  font-style: normal;

			  font-weight: 400;

			  src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');

			}
			@font-face {

			  font-family: 'Lato';

			  font-style: normal;

			  font-weight: 700;

			  src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');

			}
			@font-face {

			  font-family: 'Lato';

			  font-style: italic;

			  font-weight: 400;

			  src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');

			}
			@font-face {

			  font-family: 'Lato';

			  font-style: italic;

			  font-weight: 700;

			  src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');

			}

		}
		/* CLIENT-SPECIFIC STYLES */

		body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }

		table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }

		img { -ms-interpolation-mode: bicubic; }
		/* RESET STYLES */

		img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }

		table { border-collapse: collapse !important; }

		body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
		/* iOS BLUE LINKS */

		a[x-apple-data-detectors] {

			color: inherit !important;

			text-decoration: none !important;

			font-size: inherit !important;

			font-family: inherit !important;

			font-weight: inherit !important;

			line-height: inherit !important;

		}
		/* MOBILE STYLES */

		@media screen and (max-width:600px){

			h1 {

				font-size: 32px !important;

				line-height: 32px !important;

			}

		}
		/* ANDROID CENTER FIX */

		div[style*='margin: 16px 0;'] { margin: 0 !important; }

	</style>

	</head>
	<body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
	<table border='0' cellpadding='0' cellspacing='0' width='100%'>
		<!-- LOGO -->
		<tr>
			<td bgcolor='gray' align='center'>
				<!--[if (gte mso 9)|(IE)]>
				<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
				<tr>
				<td align='center' valign='top' width='600'>
				<![endif]-->
				<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
					<tr>
						<td align='center' valign='top' style='padding: 40px 10px 40px 10px;'>
								<img alt='Logo' src='https://www.ecomm.com.co/dist/favicon.png' width='180' height='180' style='display: block; width: 180px; max-width: 180px; min-width: 180px; font-family: 'Lato', Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;' border='0'>
						</td>
					</tr>
				</table>
				<!--[if (gte mso 9)|(IE)]>
				</td>
				</tr>
				</table>
				<![endif]-->
			</td>
		</tr>
		<!-- HERO -->
		<tr>
			<td bgcolor='gray' align='center' style='padding: 0px 10px 0px 10px;'>
				<!--[if (gte mso 9)|(IE)]>
				<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
				<tr>
				<td align='center' valign='top' width='600'>
				<![endif]-->
				<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
					<tr>
						<td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
						  <h1 style='font-size: 48px; font-weight: 400; margin: 0;'>Acontinuación se te envia el Apikey para hacer pagos por Ecommpay <br>
						  Recuerda que esta es unica</h1>
						</td>
					</tr>
				</table>
				<!--[if (gte mso 9)|(IE)]>
				</td>
				</tr>
				</table>
				<![endif]-->
			</td>
		</tr>
		<!-- COPY BLOCK -->
		<tr>
			<td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
				<!--[if (gte mso 9)|(IE)]>
				<table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
				<tr>
				<td align='center' valign='top' width='600'>
				<![endif]-->
				<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
				  <!-- COPY -->
				  <tr>
				  <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
					<CENTER><h2 style='margin: 0; color: #FFA73B;'>$codigo</h2></CENTER>
				  </td>
				</tr>
					<tr>
						<td bgcolor='#ffffff' align='left' style='padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
							<a href='https://www.ecomm.com.co/Inicio_page/login'>https://www.ecomm.com.co/Inicio_page/login</a>
						</td>
					</tr>
				</table>
				<!--[if (gte mso 9)|(IE)]>
				</td>
				</tr>
				</table>
				<![endif]-->
			</td>
		</tr>
	</table>
	</body>
	</html>
	";
		$data_email["email_mensaje"] = $message;
		$data_email["preparado"] = 1;
		$this->db->insert("dge_envio_email", $data_email);
		$responce = array(0 => false, 1 => "Envio programado exitosamente");
		return $responce;
	}





	/* dejarrrrrrrrrrrrrrrrrrrrr */

	public function envio_correos_pendientes_bd()
	{

		$this->load->database();

		$this->load->library('email');

		$this->load->helper('email');

		#Creo la variable de control para el envio de email



		$config = array(
			'protocol' => 'smtp',

			'smtp_host' => $this->config["smtp_host"],

			'smtp_port' => '25',

			'smtp_user' => $this->config["smtp_user"],

			'smtp_pass' => $this->config["smtp_pass"],

			'validate' => false,

			'wordwrap' => true,

			'mailtype' => 'html',

			'charset' => 'utf-8',

			'newline' => '\r\n',

			'crlf' => '\r\n'

		);

		#Cargo la tabla de los correos pendientes

		$query_email_pendiente = $this->db->query("SELECT * FROM dge_envio_email WHERE preparado = 1");

		foreach ($query_email_pendiente->result() as $email) {

			$this->email->clear(TRUE);

			switch ($email->email_tipo) {

				case "codigo":

					$this->email->initialize($config);

					$this->email->from($this->config["codigo"]);

					$this->email->to($email->email_destinatario);

					$this->email->subject($email->email_asunto);

					$this->email->message("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html><body>" . $email->email_mensaje . "<br>

				 </body></html>");



					break;





			} /*switch*/

			// $this->email->to($email->email_destinatario);

			// $this->email->subject($email->email_asunto);

			#Busco el codigo del usuario a quitar de la base de datos

			// $cod_usuario_correo = 0;

			// $query_usuario = $this->db->get_where("master_evento", array("correo" => $email->email_destinatario) );

			// if($query_usuario->num_rows() != 0){

			// 	$cod_usuario_correo = $query_usuario->row()->id;

			// }/*if*/

			// $cod_usuario_correo = urlencode(base64_encode($cod_usuario_correo));

			// $this->email->message("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html><body>".$email->email_mensaje."<br>

			// </body></html>");

			#################################

			#################################

			if ($this->email->send()) {
			} else {
			} /*if*/

			#Eliminamos el registro del envio

			$this->db->where(array("int" => $email->int))->delete("dge_envio_email");

		} /*foreach*/

	} /*function envio_correos_pendientes_bd*/



}