<?php

defined('BASEPATH') or exit('No direct script access allowed');



class inicio_page extends CI_Controller

{

	function __construct()

	{
		parent::__construct();

		$this->load->model('Model_login');

		$this->load->model('Model_comercio');

		$this->load->model('Model_landing');

		$this->load->model('Model_wallet');

		$this->load->model('Model_errorpage');
	}

	public function consultar($id)
	{

		$izquierda = $this->Model_login->traerPrueba($id);
		$estado = $this->Model_comercio->estadoRegisto($id);
		$derecha = $this->Model_login->traerPruebaDerecha($id);
		if ($estado->ubica == "izquierda") {
			do {
				print_r($izquierda);
				$izquierda = $this->Model_login->traerPrueba($izquierda->id_izquierda);
				if ($izquierda->id_izquierda == null) {
					$data = array(
						"id_izquierda" => 1,
					);
					$this->Model_login->ModificarDerecha($data, $izquierda->id);
				}
			} while ($izquierda != null);
		} else {
			do {
				$derecha = $this->Model_login->traerPruebaDerecha($derecha->id_derecha);
				if ($derecha->id_derecha == null) {
					$data = array(
						"id_derecha" => $id,
					);
					$this->Model_login->ModificarDerecha($data, $derecha->id);
				}
			} while ($derecha != null);
		}
	}


	public function index()

	{

		$result['convenio'] = $this->Model_comercio->cupones_index();

		$this->load->view('landing_page/inicio', $result);
	}

	public function login()

	{

		$this->load->view('landing_page/inicio_sesion');
	}

	public function registro($id)

	{
		$result['departamentos'] = $this->Model_login->traerDepar();
		$result['perfil'] = $this->Model_login->cargar_datosRegistro($id);
		$this->load->view('landing_page/view_registro', $result);
	}

	public function insertar_registrar($id_refe)

	{
		$contrasena = $this->input->post('Contra');
		$contrasena1 = $this->input->post('contra1');
		$tipo = $this->input->post('tipo');

		$miarchivo1 = 'CC_front';
		$config['upload_path'] = './asset/images/confirmacion/';
		$config['allowed_types'] = "jpg|png|jpeg|pdf";

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload($miarchivo1)) {

			$error = array('error' => $this->upload->display_errors());

			$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Revisa la primera imagen</label></div>');
			redirect(base_url() . "Inicio_page/registro/" . $id_refe);
		} else {
			/// poner if de tippo
			if ($tipo == "Comercio") {
				if ($contrasena != $contrasena1) {
					$this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Contraseña no coinciden</label></div>');
					redirect(base_url() . "Inicio_page/registro/" . $id_refe);
				} else {

					$data = array("upload_data" => $this->upload->data());
					$imagen1 = $data['upload_data']['file_name'];

					$ciudad = $this->input->post('ciudad');
					$insertar = array(

						"nombre_negocio" => $this->input->post('Nombre_nego'),

						"nombre" => $this->input->post('Nombre_enca'),

						"apellido1" => $this->input->post('Apellido1'),

						"correo" => $this->input->post('Correo'),

						"celular" => $this->input->post('Telefono'),

						"id_papa_pago" => $id_refe,

						"user" => $this->input->post('User'),

						"ciudad" => $ciudad,

						"tipo" => $tipo,

						"contrasena" => md5($contrasena),

						"img_cedula_front" => $imagen1

					);
					if ($this->Model_login->ingresar_registro($insertar)) {

						$id = $this->Model_login->lastID();

						$miarchivo2 = 'CC_back';
						$config['upload_path'] = './asset/images/confirmacion/';

						$config['allowed_types'] = "jpg|png|jpeg|pdf";
						$this->load->library('upload', $config);



						if (!$this->upload->do_upload($miarchivo2)) {

							$error = array('error' => $this->upload->display_errors());
							$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Revisa la segunda imagen</label></div>');
							redirect(base_url() . "Inicio_page/registro/" . $id_refe);
						} else {

							$data = array("upload_data" => $this->upload->data());

							$imagen2 = $data['upload_data']['file_name'];



							$arre = array(

								"img_cedula_back" => $imagen2,

							);

							if ($this->Model_login->addImg2($arre, $id)) {
							} else {

								$id2 = $id;

								$miarchivo3 = 'RUT';

								$config['upload_path'] = './asset/images/confirmacion/';

								$config['allowed_types'] = "jpg|png|jpeg|pdf";

								$this->load->library('upload', $config);

								if (!$this->upload->do_upload($miarchivo3)) {

									$error = array('error' => $this->upload->display_errors());
									$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Revisa la tercera imagen</label></div>');
									redirect(base_url() . "Inicio_page/registro/" . $id_refe);
								} else {

									$data = array("upload_data" => $this->upload->data());

									$imagen3 = $data['upload_data']['file_name'];
									$arre2 = array(

										"RUT" => $imagen3,

									);
									if ($this->Model_login->addImg2($arre2, $id2)) {

										echo "vas por buen camino :)";
									} else {

										$wallet = $this->generateRandomString(10);

										$data = array(

											"wallet" => $wallet,

											"id_usuario" => $id2

										);
										$idUser = $this->Model_wallet->insertwallet1($data);

										$data2 = array(
											"wallet_id" => $idUser
										);
										$this->Model_login->addImg2($data2, $id2);

										$izquierda = $this->Model_login->traerPrueba($id_refe);
										$estado = $this->Model_comercio->estadoRegisto($id_refe);
										$derecha = $this->Model_login->traerPruebaDerecha($id_refe);
										if ($estado->ubica == "izquierda") {
											if ($izquierda->id_izquierda == 0) {
												$data = array(
													"id_izquierda" => $id,
												);
												$this->Model_login->ModificarDerecha($data, $izquierda->id);
												$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
												redirect(base_url() . "Inicio_page/login", "refresh");
											} else if (count($izquierda) > 1) {
												do {
													if ($izquierda->id_izquierda == 0) {
														$data = array(
															"id_izquierda" => $id,
														);
														$this->Model_login->ModificarDerecha($data, $izquierda->id);
														$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
														redirect(base_url() . "Inicio_page/login", "refresh");
													}
													$izquierda = $this->Model_login->traerPrueba($izquierda->id_izquierda);
												} while ($izquierda->id_izquierda != null);
											}
										} else {
											if ($derecha->id_derecha == 0) {

												$data = array(
													"id_derecha" => $id,
												);
												$this->Model_login->ModificarDerecha($data, $derecha->id);
												$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
												redirect(base_url() . "Inicio_page/login", "refresh");
											} else {
												do {
													if ($derecha->id_derecha == 0) {
														$data = array(
															"id_derecha" => $id,
														);
														$this->Model_login->ModificarDerecha($data, $derecha->id);
														$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
														redirect(base_url() . "Inicio_page/login", "refresh");
													}
													$derecha = $this->Model_login->traerPruebaDerecha($derecha->id_derecha);
												} while ($derecha->id_derecha != null);
											}
										}
										$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
										redirect(base_url() . "Inicio_page/login", "refresh");
									}
								}
							}
						}
					} else {

						$this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Contraseña no coinciden</div>');

						redirect(base_url() . "Inicio_page/login");
					}
				}
			} else {
				if ($contrasena != $contrasena1) {
					$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Contraseña no coinciden</label></div>');
					redirect(base_url() . "Inicio_page/registro/" . $id_refe);
				} else {

					$data = array("upload_data" => $this->upload->data());
					$imagen1 = $data['upload_data']['file_name'];
					$ciudad = $this->input->post('ciudad');

					$insertar = array(

						"nombre" => $this->input->post('Nombre_enca'),

						"apellido1" => $this->input->post('Apellido1'),

						"correo" => $this->input->post('Correo'),

						"cedula" => $this->input->post('cedula'),

						"celular" => $this->input->post('Telefono'),

						"id_papa_pago" => $id_refe,

						"user" => $this->input->post('User'),

						"ciudad" => $ciudad,

						"tipo" => $tipo,

						"contrasena" => md5($contrasena),

						"img_cedula_front" => $imagen1

					);

					if ($this->Model_login->ingresar_registro($insertar)) {



						$id = $this->Model_login->lastID();

						$miarchivo2 = 'CC_back';
						$config['upload_path'] = './asset/images/confirmacion/';

						$config['allowed_types'] = "jpg|png|jpeg|pdf";
						$this->load->library('upload', $config);



						if (!$this->upload->do_upload($miarchivo2)) {

							$error = array('error' => $this->upload->display_errors());

							echo json_encode($error);
						} else {

							$data = array("upload_data" => $this->upload->data());

							$imagen2 = $data['upload_data']['file_name'];



							$arre = array(

								"img_cedula_back" => $imagen2,

							);

							if ($this->Model_login->addImg2($arre, $id)) {

								echo "no vas por buen camino :)";
							} else {

								$id2 = $id;
								$miarchivo3 = 'img_selfie';
								$config['upload_path'] = './asset/images/confirmacion/';

								$config['allowed_types'] = "jpg|png|jpeg|pdf";

								$this->load->library('upload', $config);

								if (!$this->upload->do_upload($miarchivo3)) {

									$error = array('error' => $this->upload->display_errors());

									echo json_encode($error);
								} else {

									$data = array("upload_data" => $this->upload->data());

									$imagen3 = $data['upload_data']['file_name'];
									$arre2 = array(

										"img_selfie" => $imagen3,

									);
									if ($this->Model_login->addImg2($arre2, $id2)) {
									} else {

										$wallet = $this->generateRandomString(10);

										$data = array(

											"wallet" => $wallet,

											"id_usuario" => $id2

										);
										$idUser = $this->Model_wallet->insertwallet($data);

										$data2 = array(
											"wallet_id" => $idUser
										);
										$this->Model_login->addImg2($data2, $id2);

										$izquierda = $this->Model_login->traerPrueba($id_refe);
										$estado = $this->Model_comercio->estadoRegisto($id_refe);
										$derecha = $this->Model_login->traerPruebaDerecha($id_refe);
										if ($estado->ubica == "izquierda") {
											if ($izquierda->id_izquierda == 0) {
												$data = array(
													"id_izquierda" => $id,
												);
												$this->Model_login->ModificarDerecha($data, $izquierda->id);
												$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
												redirect(base_url() . "Inicio_page/login", "refresh");
											} else if (count($izquierda) > 1) {
												do {
													if ($izquierda->id_izquierda == 0) {
														$data = array(
															"id_izquierda" => $id,
														);
														$this->Model_login->ModificarDerecha($data, $izquierda->id);
														$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
														redirect(base_url() . "Inicio_page/login", "refresh");
													}
													$izquierda = $this->Model_login->traerPrueba($izquierda->id_izquierda);
												} while ($izquierda->id_izquierda != null);
											}
										} else {
											if ($derecha->id_derecha == 0) {

												$data = array(
													"id_derecha" => $id,
												);
												$this->Model_login->ModificarDerecha($data, $derecha->id);
												$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
												redirect(base_url() . "Inicio_page/login", "refresh");
											} else {
												do {
													if ($derecha->id_derecha == 0) {
														$data = array(
															"id_derecha" => $id,
														);
														$this->Model_login->ModificarDerecha($data, $derecha->id);
														$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
														redirect(base_url() . "Inicio_page/login", "refresh");
													}
													$derecha = $this->Model_login->traerPruebaDerecha($derecha->id_derecha);
												} while ($derecha->id_derecha != null);
											}
										}
										$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
										redirect(base_url() . "Inicio_page/login", "refresh");
									}
								}
							}
						}
					} else {

						$this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Contraseña no coinciden</div>');

						redirect(base_url() . "Inicio_page/login");
					}
				}
			}
		}
	}

	function generateRandomString($length)

	{
		return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
	}


	/* codigo para validar perfil y entrar*/

	public function validaAcceso()
	{
		$user = $this->input->post('user');
		$pass = md5($this->input->post('pass'));

		$result = $this->Model_login->consultaUser($user, $pass);

		if ($result->contar == 1) {
			$datos_user = $this->Model_login->trae_user($user, $pass);
			$session = array(
				'ID' => $datos_user->id,
				'USUARIO' => $datos_user->correo,
				'NOMBRE' => $datos_user->nombre,
				'APELLIDO' => $datos_user->apellido1,
				'CORREO' => $datos_user->correo,
				'USER' => $datos_user->user,
				'CONTRASENA' => $datos_user->contrasena,
				'ROL' => $datos_user->tipo,
				'SECURITY' => $datos_user->security,
				'url_img' => $datos_user->img_perfil,
				'is_logged_in' => TRUE,
			);
			$this->session->set_userdata($session);

			if ($datos_user->tipo == 'Comercio') {
				if ($this->session->userdata('is_logged_in')) {
					redirect("" . base_url() . "comercio?Id=$datos_user->id");
				}
			}
			if ($datos_user->tipo == 'Socio') {
				if ($this->session->userdata('is_logged_in')) {
					redirect("" . base_url() . "comercio?Id=$datos_user->id");
				}
			}
			if ($datos_user->tipo == 'SocioAdmin') {
				if ($this->session->userdata('is_logged_in')) {
					redirect("" . base_url() . "comercio?Id=$datos_user->id");
				}
			}
			//

		} else {
			//en caso contrario mostramos el error de usuario o contraseña invalido
			$this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Usuario/Contraseña Invalido</div>');
			redirect(base_url() . "login");
		}
	}
	public function session_dest()
	{
		$session = array(
			'logueado' => FALSE
		);
		$this->session->set_userdata($session);
		$this->session->sess_destroy();
		redirect('Inicio_page');
	}

	public function validarCorreo()
	{
		$email = $this->input->post();

		$consulta = $this->Model_errorpage->verificarEmail($email);

		if ($consulta->contar == 1) {
			echo "Correo ya usado, elige otro";
		}
	}
	public function validarUser()
	{
		$usuario = $this->input->post('usuario');

		$consulta = $this->Model_errorpage->verificarUsuario($usuario);

		if ($consulta->contar == 1) {
			echo "Usuario ya usado, elige otro";
		}
	}
}
