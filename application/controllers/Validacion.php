<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Validacion extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_logged_in')) {
			$this->load->model('Model_login');
			$this->load->model('Model_comercio');
			$this->load->model('model_errorpage');
			$this->load->model('Model_solicitudes');
			$this->load->model('Model_cupones');
		} else {
			redirect(base_url() . "Inicio_page");
		}
	}

	public function verificar_user()
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['validacion'] = $this->Model_comercio->validacion();
		$result['banco'] = $this->Model_comercio->validarBanco();
		$result['tb'] = $this->Model_comercio->tb_seguimiento();
		$result['categorias'] = $this->Model_cupones->traerCategorias();

		$this->load->view('prueba_header', $result);
		$this->load->view('validacion/validar', $result);
		$this->load->view('prueba_footer', $result);
	}
	public function habilitarBanco($id)
	{
		$verificar = "Verificado Exitosamente";
		$data = array(
			'estado' => $verificar,
		);
		$this->Model_comercio->respuestaBanco($data, $id);
		redirect(base_url() . 'Validacion/verificar_user', 'refresh');
	}
	public function RechazarrBanco($id)
	{
		$verificar = "Verificación anulada";
		$data = array(
			'estado' => $verificar,
		);
		$this->Model_comercio->respuestaBanco($data, $id);
		redirect(base_url() . 'Validacion/verificar_user', 'refresh');
	}
	public function verificar_comer()
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['validacion'] = $this->Model_comercio->validacion_comer();
		$result['tb'] = $this->Model_comercio->traer_info();
		$result['cantidad'] = $this->Model_comercio->tb_cantidad();
		$result['banco'] = $this->Model_comercio->validarBancocomer();
		$result['categorias'] = $this->Model_cupones->traerCategorias();

		$this->load->view('prueba_header', $result);
		$this->load->view('validacion/validar_comer', $result);
		$this->load->view('prueba_footer', $result);
	}

	public function habilitarUser($id)
	{
		$verificar_user = "habilitado";
		$data = array(
			'verificar_user' => $verificar_user,
		);
		$this->Model_comercio->aceptarvalidacion($data, $id);
		redirect(base_url() . 'Validacion/verificar_user', 'refresh');
	}
	public function habilitarComer($id)
	{
		$verificar_user = 1;
		$data = array(
			'estado' => $verificar_user,
		);
		$this->Model_comercio->aceptarvalidacion($data, $id);
		redirect(base_url() . 'Validacion/verificar_comer', 'refresh');
	}
	public function inhabilitar($id)
	{
		$verificar_user = "inac";
		$data = array(
			'verificar_user' => $verificar_user,
		);

		$this->Model_comercio->aceptarvalidacion($data, $id);
		$this->session->set_flashdata('error', '<center><div class="alert alert-success text-center" d-flex >Proceso exitoso </div></center>');
		redirect(base_url() . 'Validacion/verificar_user', 'refresh');
	}
	public function inhabilitar2($id)
	{
		$estado = $this->input->post("estado");
		$fecha = $this->input->post("fecha");
		$msm = $this->input->post("msm");
		if ($estado == 1) {
			$verificar_user = "inac";
			$data = array(
				'verificar_user' => $verificar_user,
				'msm' => $msm,
			);
		} else if ($estado == 2) {
			$verificar_user = "pendiente";
			$data = array(
				'verificar_user' => $verificar_user,
				'msm' => $msm,
				'fecha_msm' => $fecha,
			);
		} else {
			$verificar_user = "habilitado";
			$data = array(
				'verificar_user' => $verificar_user,
				'msm' => $msm,
			);
		}
		$this->Model_comercio->aceptarvalidacion($data, $id);
		$this->session->set_flashdata('error', '<center><div class="alert alert-success text-center" d-flex >Proceso exitoso </div></center>');
		redirect(base_url() . 'Validacion/verificar_user', 'refresh');
	}
	public function todo_binario()
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['binario'] = $this->Model_comercio->validacion_comer();
		$this->load->view('prueba_header', $result);
		$this->load->view('binario/binario_all', $result);
		$this->load->view('prueba_footer', $result);
	}
	public function habilitar_recar($id)
	{
		$arre = array(
			"auto_recar" => 2
		);
		$this->Model_comercio->updaterecarga($arre, $id);
		redirect(base_url() . 'Validacion/verificar_comer', 'refresh');
	}
	public function inhabilitar_recar($id)
	{
		$arre = array(
			"auto_recar" => 0
		);
		$this->Model_comercio->updaterecarga($arre, $id);
		redirect(base_url() . 'Validacion/verificar_comer', 'refresh');
	}
}