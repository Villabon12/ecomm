<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Perfil extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_logged_in')) {
			$this->load->model('Model_login');
			$this->load->model('Model_comercio');
			$this->load->model('Model_landing');
			$this->load->model('Model_wallet');
			$this->load->model('Model_errorpage');
			$this->load->model('Model_cupones');
			$this->load->model('Model_linkTree');
		} else {
			redirect(base_url());
		}
	}
	public function perfil()
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['ciudad'] = $this->Model_login->traerDepar();
		$result['categorias'] = $this->Model_cupones->traerCategorias();
		$result['ciudad'] = $this->Model_comercio->traerciudad1();
		$this->load->view('prueba_header', $result);
		$this->load->view('perfil/perfil', $result);
		$this->load->view('prueba_footer', $result);
	}
	public function perfil2()
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['tipo'] = $this->Model_login->traerTipoPago();
		$result['bancos'] = $this->Model_login->traerBancos();
		$result['cuentas'] = $this->Model_login->traerCuentas($result['perfil']->id);
		$result['categorias'] = $this->Model_cupones->traerCategorias();
		$result['ciudad'] = $this->Model_comercio->traerciudad1();
		$this->load->view('prueba_header', $result);
		$this->load->view('perfil/perfil_banco', $result);
		$this->load->view('prueba_footer', $result);
	}
	
	public function actualizarPerfil($id)
	{
		$nombre = $this->input->post('nombre');
		$apellido = $this->input->post('apellido1');
		$celular = $this->input->post('celular');
		$ciudad = $this->input->post('ciudad');
		$fecha_nacimiento = $this->input->post('fecha_nacimiento');

		$arre = array(
			'nombre' => $nombre,
			'apellido1' => $apellido,
			'celular' => $celular,
			'ciudad' => $ciudad,
			'fecha_nacimiento' => $fecha_nacimiento,
		);
		$this->Model_login->actualizarPerfil($arre, $id);
		$this->session->set_flashdata('error', ' <center><div class="alert alert-success align-items-center d-flex" style="width: 1000px;"> Datos actualizados exitosamente </div></center> ');
		redirect(base_url() . "Perfil/perfil", "refresh");
	}
	public function Subircuenta($id)
	{
		$mi_archivo = 'img';
		$config['upload_path'] = './assets/img/certificadosBanco/';
		$config['allowed_types'] = "jpg|png|jpeg|pdf";
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = 800;
		$config['height'] = 800;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($mi_archivo)) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', ' <center><div class="alert alert-danger align-items-center d-flex" style="width: 1000px;"> Error al subir cuenta bancaria </div></center> ');
			redirect(base_url() . "Perfil/perfil2", "refresh");
		} else {

			$data = array("upload_data" => $this->upload->data());
			$imagen = $data['upload_data']['file_name'];
			$arre = array(
				"id_socio" => $id,
				"img" => $imagen,
				"tipo" => $this->input->post('tipo'),
				"banco" => $this->input->post('banco'),
				"titular" => $this->input->post('titular'),
				"numero" => $this->input->post('numero'),
			);
			$this->Model_login->subirCuenta($arre);
			$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Datos bancarios subidos exitosamente </div></center>');
			redirect(base_url() . "Perfil/perfil2", "refresh");
		}
	}

	public function actualizarFoto($id)
	{
		$mi_archivo = 'img';
		$config['upload_path'] = './assets/img/fotosPerfil/';
		$config['allowed_types'] = "jpg|png|jpeg|webp";
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = 800;
		$config['height'] = 800;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($mi_archivo)) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Error  no se pudo actualizar la foto</label></div>');
			redirect(base_url() . "Perfil/perfil");
		} else {
			$data = array("upload_data" => $this->upload->data());
			$imagen = $data['upload_data']['file_name'];
			$arre = array(
				"img_perfil" => $imagen,
			);
			if ($this->Model_login->actualizarfoto($arre, $id)) {
				$this->session->set_flashdata('error', '<div class="alert alert-success d-flex text-center"><label class="login__input name">Foto Actualizada</label></div>');
				redirect(base_url() . "Perfil/perfil");
			} else {
				$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Error  no se pudo actualizar la foto</label></div>');
				redirect(base_url() . "Perfil/perfil");
			}
		}
	}
	public function subir_redes($id)
	{
		$insta = $this->input->get('insta');
		$facebook = $this->input->get('facebook');
		$tiktok = $this->input->get('tiktok');
		$arre = array(
			"user_instagram" => $insta,
			"user_facebook" => $facebook,
			"user_tiktok" => $tiktok,
		);
		$this->Model_login->actualizarPerfil($arre, $id);
		$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex" style="width: 1000px;"> Redes actualizadas exitosamente  </div></center>');
		redirect(base_url() . 'Perfil/perfil2redes', 'refresh');
	}
	public function perfil2redes()
	{
		$result['perfil'] = $this->Model_login->cargar_datos_comercio();
		$result['categorias'] = $this->Model_cupones->traerCategorias();
		$this->load->view('prueba_header', $result);
		$this->load->view('perfil/perfil_redes', $result);
		$this->load->view('prueba_footer', $result);
	}
	public function actualizarcontra($id)
	{
		$contra_actual = $this->input->post('contra_actual');
		$contra_nueva = $this->input->post('contra_nueva');
		$confir_contra = $this->input->post('confir_contra');
		$contra_ori = md5($contra_actual);



		$result = $this->Model_login->validarcontra($id, $contra_ori);


		if ($result->contar == 1) {
			if ($contra_nueva == $confir_contra) {
				$arre = array(
					"contrasena" => md5($confir_contra),
				);
				$this->Model_login->actualizarPerfil($arre, $id);
				$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex" style="width: 1000px;"> Contraseña actualizada exitosamente </div></center>');
				redirect(base_url() . 'Perfil/perfil', 'refresh');
			} else {
				$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex" style="width: 1000px;"> Las contraseñas no coinciden </div></center>');
				redirect(base_url() . 'Perfil/perfil', 'refresh');
			}
		} else {
			$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex" style="width: 1000px;"> Contraseña actual Incorrecta </div></center>');
			redirect(base_url() . 'Perfil/perfil', 'refresh');
		}
	}
	public function perfilcomer()
	{
		$result['perfil'] = $this->Model_login->cargar_datos_comercio();
		$result['ciudad'] = $this->Model_login->traerDepar();
		$result['categorias'] = $this->Model_cupones->traerCategorias();
		$this->load->view('prueba_header', $result);
		$this->load->view('perfil/perfil', $result);
		$this->load->view('prueba_footer', $result);
	}
	public function perfil2comer()
	{
		$result['perfil'] = $this->Model_login->cargar_datos_comercio();
		$result['tipo'] = $this->Model_login->traerTipoPago();
		$result['bancos'] = $this->Model_login->traerBancos();
		$result['cuentas'] = $this->Model_login->traerCuentas($result['perfil']->id);
		$result['categorias'] = $this->Model_cupones->traerCategorias();

		$this->load->view('prueba_header', $result);
		$this->load->view('perfil/perfil_banco', $result);
		$this->load->view('prueba_footer', $result);
	}

	public function actualizarPerfilcomer($id)
	{
		$nombre = $this->input->post('nombre');
		$apellido = $this->input->post('apellido1');
		$celular = $this->input->post('celular');
		$ciudad = $this->input->post('ciudad');
		$fecha_nacimiento = $this->input->post('fecha_nacimiento');

		$arre = array(
			'nombre' => $nombre,
			'apellido1' => $apellido,
			'celular' => $celular,
			'fecha_nacimiento' => $fecha_nacimiento,
			'ciudad' => $ciudad,
		);
		$this->Model_login->actualizarPerfil($arre, $id);
		$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Datos actualizados </div></center>');
		redirect(base_url() . "Perfil/perfilcomer", "refresh");
	}
	public function Subircuentacomer($id)
	{
		$mi_archivo = 'img';
		$config['upload_path'] = './assets/img/certificadosBanco/';
		$config['allowed_types'] = "jpg|png|jpeg|pdf";
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = 800;
		$config['height'] = 800;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($mi_archivo)) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error al subir cuenta bancaria </div></center>');
			redirect(base_url() . "Perfil/perfil2comer", "refresh");
		} else {

			$data = array("upload_data" => $this->upload->data());
			$imagen = $data['upload_data']['file_name'];
			$arre = array(
				"id_socio" => $id,
				"img" => $imagen,
				"tipo" => $this->input->post('tipo'),
				"banco" => $this->input->post('banco'),
				"titular" => $this->input->post('titular'),
				"numero" => $this->input->post('numero'),
			);
			$this->Model_login->subirCuenta($arre);
			$this->session->set_flashdata('error', '<center><div class="alert alert-success text-center d-flex" style="width: 1000px;"> Cuenta subida existosamente </div></center>');
			redirect(base_url() . "Perfil/perfil2comer", "refresh");
		}
	}
	public function actualizarFotocomer($id)
	{
		$mi_archivo = 'img';
		$config['upload_path'] = './assets/img/fotosPerfil/';
		$config['allowed_types'] = "jpg|png|jpeg";
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = 800;
		$config['height'] = 800;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($mi_archivo)) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error a subir foto</div></center>');
			redirect(base_url() . "Perfil/perfilcomer", "refresh");
		} else {
			$data = array("upload_data" => $this->upload->data());
			$imagen = $data['upload_data']['file_name'];
			$arre = array(
				"img_perfil" => $imagen,
			);
			if ($this->Model_login->actualizarfoto($arre, $id)) {
				$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Foto actualiza exitosamente</div></center>');
				redirect(base_url() . "Perfil/perfilcomer");
			} else {
				$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error a actualizar foto </div></center>');
				redirect(base_url() . "Perfil/perfilcomer");
			}
		}
	}
	public function actualizarcontracomer($id)
	{
		$contra_actual = $this->input->post('contra_actual');
		$contra_nueva = $this->input->post('contra_nueva');
		$confir_contra = $this->input->post('confir_contra');
		$contra_ori = md5($contra_actual);



		$result = $this->Model_login->validarcontra($id, $contra_ori);


		if ($result->contar == 1) {
			if ($contra_nueva == $confir_contra) {
				$arre = array(
					"contrasena" => md5($confir_contra),
				);
				$this->Model_login->actualizarPerfil($arre, $id);
				$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex" style="width: 1000px;"> Contraseña actualizada exitosamente </div></center>');
				redirect(base_url() . 'Perfil/perfilcomer', 'refresh');
			} else {
				$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex" style="width: 1000px;"> Las contraseñas no coinciden </div></center>');
				redirect(base_url() . 'Perfil/perfilcomer', 'refresh');
			}
		} else {
			$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex" style="width: 1000px;"> Contraseña actual Incorrecta </div></center>');
			redirect(base_url() . 'Perfil/perfilcomer', 'refresh');
		}
	}


	//variable for storing error message
	private $error;
	//variable for storing success message
	private $success;

	//appends all error messages
	private function handle_error($err)
	{
		$this->error .= nl2br($err . "\n");
	}

	//appends all success messages
	private function handle_success($succ)
	{
		$this->success .= nl2br($succ . "\n");
	}

	public function updateCuenta($id)
	{
		if ($this->input->post('image_resize')) {
			//set preferences
			//file upload destination
			$upload_path = './asset/images/confirmacion/';
			$config['upload_path'] = $upload_path;
			//allowed file types. * means all types
			$config['allowed_types'] = 'jpg|png|gif|jpeg|web';
			//allowed max file size. 0 means unlimited file size
			$config['max_size'] = '0';
			//max file name size
			$config['max_filename'] = '255';

			//store image info once uploaded
			$image_data = array();
			//check for errors
			$is_file_error = FALSE;
			//check if file was selected for upload
			if (!$_FILES) {
				$is_file_error = TRUE;
				$this->handle_error('Selecciona una imagen');
			}

			//if file was selected then proceed to upload
			if (!$is_file_error) {
				//load the preferences
				$this->load->library('upload', $config);
				//check file successfully uploaded. 'image_name' is the name of the input
				if (!$this->upload->do_upload('image_name')) {
					//if file upload failed then catch the errors
					$this->handle_error($this->upload->display_errors());
					$is_file_error = TRUE;
				} else {
					//store the file info
					$image_data = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image'] = $image_data['full_path']; //get original image
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 900;
					$config['height'] = 850;
					$this->load->library('image_lib', $config);
					$file = $image_data['file_name'];
					$data2 = array(
						"img_cedula_front" => $file
					);
					$this->Model_login->updPerfil($data2, $id);
					$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Foto actualiza exitosamente</div></center>');
					if (!$this->image_lib->resize()) {
						$this->handle_error($this->image_lib->display_errors());
					}
				}
			}
			// There were errors, we have to delete the uploaded image
			if ($is_file_error) {
				if ($image_data) {
					$file = $upload_path . $image_data['file_name'];
					if (file_exists($file)) {
						unlink($file);
					}
				}
			} else {
				$data['resize_img'] = $upload_path . $image_data['file_name'];
				$this->handle_success('Image was successfully uploaded to direcoty <strong>' . $upload_path . '</strong> and resized.');
			}
		}

		//load the error and success messages
		if ($this->session->userdata('is_logged_in')) {
			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'SocioAdmin') {
				$data['perfil'] = $this->Model_login->cargar_datos();
				$data['errors'] = $this->error;
				$data['success'] = $this->success;
				//load the view along with data
				$this->load->view('perfil/up_imageC', $data);
			} else {

				$data['perfil'] = $this->Model_login->cargar_datos_comercio();
				$data['errors'] = $this->error;
				$data['success'] = $this->success;
				//load the view along with data
				$this->load->view('perfil/up_imageC', $data);
			}
		}
	}
	public function updateCuenta2($id)
	{
		if ($this->input->post('image_resize')) {
			//set preferences
			//file upload destination
			$upload_path = './asset/images/confirmacion/';
			$config['upload_path'] = $upload_path;
			//allowed file types. * means all types
			$config['allowed_types'] = 'jpg|png|gif|jpeg|web';
			//allowed max file size. 0 means unlimited file size
			$config['max_size'] = '0';
			//max file name size
			$config['max_filename'] = '255';

			//store image info once uploaded
			$image_data = array();
			//check for errors
			$is_file_error = FALSE;
			//check if file was selected for upload
			if (!$_FILES) {
				$is_file_error = TRUE;
				$this->handle_error('Selecciona una imagen');
			}

			//if file was selected then proceed to upload
			if (!$is_file_error) {
				//load the preferences
				$this->load->library('upload', $config);
				//check file successfully uploaded. 'image_name' is the name of the input
				if (!$this->upload->do_upload('image_name')) {
					//if file upload failed then catch the errors
					$this->handle_error($this->upload->display_errors());
					$is_file_error = TRUE;
				} else {
					//store the file info
					$image_data = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image'] = $image_data['full_path']; //get original image
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 900;
					$config['height'] = 850;
					$this->load->library('image_lib', $config);
					$file = $image_data['file_name'];
					$data2 = array(
						"img_cedula_back" => $file
					);
					$this->Model_login->updPerfil($data2, $id);
					$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Foto actualiza exitosamente</div></center>');
					if (!$this->image_lib->resize()) {
						$this->handle_error($this->image_lib->display_errors());
					}
				}
			}
			// There were errors, we have to delete the uploaded image
			if ($is_file_error) {
				if ($image_data) {
					$file = $upload_path . $image_data['file_name'];
					if (file_exists($file)) {
						unlink($file);
					}
				}
			} else {
				$data['resize_img'] = $upload_path . $image_data['file_name'];
				$this->handle_success('Image was successfully uploaded to direcoty <strong>' . $upload_path . '</strong> and resized.');
			}
		}

		//load the error and success messages
		if ($this->session->userdata('is_logged_in')) {
			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'SocioAdmin') {
				$data['perfil'] = $this->Model_login->cargar_datos();
				$data['errors'] = $this->error;
				$data['success'] = $this->success;
				//load the view along with data
				$this->load->view('perfil/up_imageB', $data);
			} else {

				$data['perfil'] = $this->Model_login->cargar_datos_comercio();
				$data['errors'] = $this->error;
				$data['success'] = $this->success;
				//load the view along with data
				$this->load->view('perfil/up_imageB', $data);
			}
		}
	}
	public function updateCuenta3($id)
	{
		if ($this->input->post('image_resize')) {
			//set preferences
			//file upload destination
			$upload_path = './asset/images/confirmacion/';
			$config['upload_path'] = $upload_path;
			//allowed file types. * means all types
			$config['allowed_types'] = 'jpg|png|gif|jpeg|web';
			//allowed max file size. 0 means unlimited file size
			$config['max_size'] = '0';
			//max file name size
			$config['max_filename'] = '255';

			//store image info once uploaded
			$image_data = array();
			//check for errors
			$is_file_error = FALSE;
			//check if file was selected for upload
			if (!$_FILES) {
				$is_file_error = TRUE;
				$this->handle_error('Selecciona una imagen');
			}

			//if file was selected then proceed to upload
			if (!$is_file_error) {
				//load the preferences
				$this->load->library('upload', $config);
				//check file successfully uploaded. 'image_name' is the name of the input
				if (!$this->upload->do_upload('image_name')) {
					//if file upload failed then catch the errors
					$this->handle_error($this->upload->display_errors());
					$is_file_error = TRUE;
				} else {
					//store the file info
					$image_data = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image'] = $image_data['full_path']; //get original image
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 900;
					$config['height'] = 850;
					$this->load->library('image_lib', $config);
					$file = $image_data['file_name'];
					$data2 = array(
						"img_selfie" => $file
					);
					$this->Model_login->updPerfil($data2, $id);
					$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Foto actualiza exitosamente</div></center>');
					if (!$this->image_lib->resize()) {
						$this->handle_error($this->image_lib->display_errors());
					}
				}
			}
			// There were errors, we have to delete the uploaded image
			if ($is_file_error) {
				if ($image_data) {
					$file = $upload_path . $image_data['file_name'];
					if (file_exists($file)) {
						unlink($file);
					}
				}
			} else {
				$data['resize_img'] = $upload_path . $image_data['file_name'];
				$this->handle_success('Image was successfully uploaded to direcoty <strong>' . $upload_path . '</strong> and resized.');
			}
		}

		//load the error and success messages

		$data['perfil'] = $this->Model_login->cargar_datos();
		$data['errors'] = $this->error;
		$data['success'] = $this->success;
		//load the view along with data
		$this->load->view('perfil/up_imageS', $data);
	}
	public function updateCuenta4($id)
	{
		if ($this->input->post('image_resize')) {
			//set preferences
			//file upload destination
			$upload_path = './asset/images/confirmacion/';
			$config['upload_path'] = $upload_path;
			//allowed file types. * means all types
			$config['allowed_types'] = 'jpg|png|gif|jpeg|web|pdf';
			//allowed max file size. 0 means unlimited file size
			$config['max_size'] = '0';
			//max file name size
			$config['max_filename'] = '255';

			//store image info once uploaded
			$image_data = array();
			//check for errors
			$is_file_error = FALSE;
			//check if file was selected for upload
			if (!$_FILES) {
				$is_file_error = TRUE;
				$this->handle_error('Selecciona una imagen');
			}

			//if file was selected then proceed to upload
			if (!$is_file_error) {
				//load the preferences
				$this->load->library('upload', $config);
				//check file successfully uploaded. 'image_name' is the name of the input
				if (!$this->upload->do_upload('image_name')) {
					//if file upload failed then catch the errors
					$this->handle_error($this->upload->display_errors());
					$is_file_error = TRUE;
				} else {
					//store the file info
					$image_data = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image'] = $image_data['full_path']; //get original image
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 900;
					$config['height'] = 850;
					$this->load->library('image_lib', $config);
					$file = $image_data['file_name'];
					$data2 = array(
						"RUT" => $file
					);
					$this->Model_login->updPerfil($data2, $id);
					$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Foto actualiza exitosamente</div></center>');
					if (!$this->image_lib->resize()) {
						$this->handle_error($this->image_lib->display_errors());
					}
				}
			}
			// There were errors, we have to delete the uploaded image
			if ($is_file_error) {
				if ($image_data) {
					$file = $upload_path . $image_data['file_name'];
					if (file_exists($file)) {
						unlink($file);
					}
				}
			} else {
				$data['resize_img'] = $upload_path . $image_data['file_name'];
				$this->handle_success('Image was successfully uploaded to direcoty <strong>' . $upload_path . '</strong> and resized.');
			}
		}

		//load the error and success messages
		if ($this->session->userdata('is_logged_in')) {
			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'SocioAdmin') {
				$data['perfil'] = $this->Model_login->cargar_datos();
				$data['errors'] = $this->error;
				$data['success'] = $this->success;
				//load the view along with data
				$this->load->view('resize', $data);
			} else {

				$data['perfil'] = $this->Model_login->cargar_datos_comercio();
				$data['errors'] = $this->error;
				$data['success'] = $this->success;
				//load the view along with data
				$this->load->view('perfil/up_imageS', $data);
			}
		}
	}
	public function otroperfil($id)
	{
		$datos['botones'] = $this->Model_linkTree->traerData($id);
		$user = $this->Model_login->Perfil_2($id);
		if ($user != false) {
			$datos['master_usuarios'] = $user;
			$this->load->view('perfil2/perfil2', $datos);
		} else {
			$datos['master_usuarios'] = false;
			$this->load->view('perfil2/perfil2', $datos);
		}
	}

	public function perfilPresentacion()
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['categorias'] = $this->Model_cupones->traerCategorias();
		$this->load->view('prueba_header', $result);
		$this->load->view('perfil/perfil_presentacion', $result);
		$this->load->view('prueba_footer', $result);

	}
}