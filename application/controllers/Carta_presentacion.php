<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carta_presentacion extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_carta');
		$this->load->model('Model_login');
		$this->load->model('Model_cupones');
		$this->load->model('Model_comercio');
		$this->load->model('Model_linkTree');
	}

	public function carta($id)
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['tipo'] = $this->Model_login->traerTipoPago();
		$result['bancos'] = $this->Model_login->traerBancos();
		$result['cuentas'] = $this->Model_login->traerCuentas($result['perfil']->id);
		$result['categorias'] = $this->Model_cupones->traerCategorias();
		$result['ciudad'] = $this->Model_comercio->traerciudad1();
		$result['option'] = $this->Model_carta->Llamar_botones();
		$result['botones'] = $this->Model_linkTree->traerData($id);
		$user = $this->Model_carta->Llamar_datos($id);
		$this->load->view('prueba_header', $result);
		$user = $this->Model_carta->Llamar_datos($id);
		if ($user != false) {
			$result['usuarios'] = $user;
			$this->load->view('carta/carta_presentacion', $result);
		} else {
			$result['usuarios'] = false;
			$this->load->view('carta/carta_presentacion', $result);
		}
		$this->load->view('prueba_footer', $result);
	}

	public function obtener_botones()
	{
		$datos = $this->Model_carta->Llamar_botones();
		echo json_encode($datos);
	}
	public function recibirDatos()
	{
		$enlace = $this->input->post("enlace");
		$red = $this->input->post("red");
		$perfil = $this->Model_login->cargar_datos();
		$conteo = $this->Model_linkTree->conteoRedes($perfil->id);
		if ($conteo->contar >= 2) {

			$this->session->set_flashdata('error', '<center><div class="alert alert-danger d-flex align-items-center" style="width: 98%;" role="alert">
			<svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" style="width: 20px; heigth=" 20px;" viewBox="0 0 16 16" role="img" aria-label="Warning:">
			  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
			</svg>
			<div>
			 No puedes agregar mas Redes sociales tienes la version gratuita. Para agregar mas Redes sociales pague la version pro
			</div>
		  	</div></center>');
			redirect(base_url() . 'Carta_presentacion/carta/' . $perfil->id, 'refresh');

		} else {
			$arre = array(
				"id_usuario" => $perfil->id,
				"id_red" => $red,
				"enlace" => $enlace,
				"tipo" => 1,
				"id_plantilla" => 0,
			);
			$this->Model_linkTree->insertData($arre);
			$this->session->set_flashdata('error', '<center><div class="alert alert-success d-flex align-items-center" style="width: 98%;" role="alert">
			<div>
			 Se ha agregado exitosamente.
			</div>
			</div></center>');
			redirect(base_url() . 'Carta_presentacion/carta/' . $perfil->id, 'refresh');

		}
	}

	public function updateEnlace($id)
	{

		$enlace = $this->input->post('enlace');
		$perfil = $this->Model_login->cargar_datos();
		$arre = array(
			"enlace" => $enlace,
		);
		$this->Model_linkTree->UpdateBoton($arre, $id);
		$this->session->set_flashdata('error', '<center><div class="alert alert-success d-flex align-items-center" style="width: 98%;" role="alert">
			<div>
			 Se ha modificado exitosamente.
			</div>
			</div></center>');
		redirect(base_url() . 'Carta_presentacion/carta/' . $perfil->id, 'refresh');

	}

	public function deleteEnlace($id_red)
	{
		$perfil = $this->Model_login->cargar_datos();
		$this->Model_linkTree->EliminarRed($id_red);
		redirect(base_url() . 'Carta_presentacion/carta/' . $perfil->id, 'refresh');
	}
}