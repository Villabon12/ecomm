<?php
use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class LinkTree extends CI_Controller
{

	//metodo contructor 

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_login');
		$this->load->model('Model_ecommpay');
		$this->load->model('Model_email');
		$this->load->model('Model_cupones');
		$this->load->model('Model_linkTree');
	}
	public function choose()
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['categorias'] = $this->Model_cupones->traerCategorias();
		$result['plantillas'] = $this->Model_linkTree->getTemplate();
		$this->load->view('prueba_header', $result);
		$this->load->view('linkTree/home', $result);
		$this->load->view('prueba_footer', $result);

	}

	function generateRandomString($length)
	{
		return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
	}



	///cargar vistas

	public function viewPlantilla($id)
	{
		if ($id == 1) {
			$this->load->view('plantillas/Cap1');
		} else if ($id == 2) {
			$this->load->view('plantillas/Cap2');
		} else if ($id == 3) {
			$this->load->view('plantillas/Cap3');
		} else if ($id == 4) {
			$this->load->view('plantillas/Cap4');
		} else {
			$this->load->view('plantillas/Cap5');
		}
	}

	public function making($id_pant)
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$id = $result['perfil']->id;
		$result['contar'] = $this->Model_linkTree->conteoRedes($id);
		$result['links'] = $this->Model_linkTree->traerData($id);
		$result['id_plan'] = $id_pant;
		$result['sett'] = $this->Model_linkTree->personalizacion($id);
		$result['plantillas'] = $this->Model_linkTree->getTemplate();
		$result['get'] = $this->Model_linkTree->Getboton();

		if ($id_pant == 1) {
			$result['contenido'] = 'plantillasUser/Cap1';
		} else if ($id_pant == 2) {
			$result['contenido'] = 'plantillasUser/Cap2';
		} else if ($id_pant == 3) {
			$result['contenido'] = 'plantillasUser/Cap3';
		} else if ($id_pant == 4) {
			$result['contenido'] = 'plantillasUser/Cap4';
		} else if ($id_pant == 5) {
			$result['contenido'] = 'plantillasUser/Cap5';
		} else {
			$result['contenido'] = 'perfil2/perfil2';
		}

		$count = $this->Model_linkTree->countUser($id);
		if ($count->contar == 0) {
			$arre = array(
				"id_usuario" => $id,
			);
			$this->Model_linkTree->insertUser($arre);
			$result['sett'] = $this->Model_linkTree->personalizacion($id);
			$this->load->view('linkTree/make', $result);
		} else {
			$result['sett'] = $this->Model_linkTree->personalizacion($id);
			$this->load->view('linkTree/make', $result);
		}

	}
	public function apariencia($id_pant)
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$id = $result['perfil']->id;
		$result['links'] = $this->Model_linkTree->traerData($id);
		$result['id_plan'] = $id_pant;
		$result['sett'] = $this->Model_linkTree->personalizacion($id);
		$result['plantillas'] = $this->Model_linkTree->getTemplate();
		$result['get'] = $this->Model_linkTree->Getboton();

		if ($id_pant == 1) {
			$result['contenido'] = 'plantillasUser/Cap1';
		} else if ($id_pant == 2) {
			$result['contenido'] = 'plantillasUser/Cap2';
		} else if ($id_pant == 3) {
			$result['contenido'] = 'plantillasUser/Cap3';
		} else if ($id_pant == 4) {
			$result['contenido'] = 'plantillasUser/Cap4';
		} else if ($id_pant == 5) {
			$result['contenido'] = 'plantillasUser/Cap5';
		} else {
			$result['contenido'] = 'perfil2/perfil2';
		}

		$count = $this->Model_linkTree->countUser($id);
		if ($count->contar == 0) {
			$arre = array(
				"id_usuario" => $id,
			);
			$this->Model_linkTree->insertUser($arre);
			$result['sett'] = $this->Model_linkTree->personalizacion($id);
			$this->load->view('linkTree/apariencia', $result);
		} else {
			$result['sett'] = $this->Model_linkTree->personalizacion($id);
			$this->load->view('linkTree/apariencia', $result);
		}

	}
	public function analisis()
	{
		$url = 'http://ejemplo.com/miurl';
		$info = $this->Model_linkTree->InfoAnalisis($url);
		$visitas = $info + 1;
		$this->url_model->actualizar_visitas($url, $visitas);
		$data['visitas'] = $visitas;
		$this->load->view('visitas_view', $data);
	}
	public function saveData($id)
	{
		$red = $this->input->post('red');
		$perfil = $this->Model_login->cargar_datos();
		$link = $this->input->post('enlace');
		$infoBoton = $this->Model_linkTree->DataBoton($red);
		$nombreLink = $this->input->post('nombreLink');

		if ($link == !null) {
			if ($nombreLink == null) {
				$ar = array(
					"id_red" => $red,
					"enlace" => $link,
					"id_usuario" => $perfil->id,
					"id_plantilla" => null,
					"nombreRed" => $infoBoton->nombre_boton,
					"tipo" => 2,
				);
			} else {
				$ar = array(
					"id_red" => $red,
					"enlace" => $link,
					"id_usuario" => $perfil->id,
					"id_plantilla" => null,
					"nombreRed" => $nombreLink,
					"tipo" => 2,
				);
			}
			$this->Model_linkTree->insertData($ar);
			redirect(base_url() . 'LinkTree/making/' . $id, 'refresh');
		} else {
			$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex" style="width: 1000px;"> Complete todos los espacios </div></center>');
			redirect(base_url() . 'LinkTree/making/' . $id, 'refresh');
		}
	}
	public function savePhoto($id_plan)
	{
		$perfil = $this->Model_login->cargar_datos();
		$id = $perfil->id;
		$mi_archivo = 'img';
		$config['upload_path'] = './reTemplate/imagenes/';
		$config['allowed_types'] = "jpg|png|jpeg";
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = 800;
		$config['height'] = 800;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($mi_archivo)) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error a subir foto</div></center>');
			redirect(base_url() . 'LinkTree/making/' . $id_plan, 'refresh');
		} else {
			$data = array("upload_data" => $this->upload->data());
			$imagen = $data['upload_data']['file_name'];
			$aru = array(
				"img_perfil" => $imagen,
			);
			$this->Model_linkTree->UpdatePeronali($aru, $id);
			redirect(base_url() . 'LinkTree/making/' . $id_plan, 'refresh');
		}
	}
	public function Updatedata($id_plan)
	{
		$descripcion = $this->input->post('descripcion');
		$profesion = $this->input->post('profesion');
		$datos = $this->Model_login->cargar_datos();
		$id = $datos->id;
		if ($descripcion != null) {
			$data = array(
				"descripcion" => $descripcion,
			);
		} else {
			$data = array(
				"profesion" => $profesion,
			);
		}
		$this->Model_linkTree->UpdatePeronali($data, $id);
		redirect(base_url() . 'LinkTree/making/' . $id_plan, 'refresh');

	}
	public function UpdateColor($id_plan)
	{
		$color = $this->input->post('color');
		$data = array(
			"colorBoton" => $color,
		);
		$datos = $this->Model_login->cargar_datos();
		$id = $datos->id;
		$this->Model_linkTree->UpdatePeronali($data, $id);
		redirect(base_url() . 'LinkTree/apariencia/' . $id_plan, 'refresh');
	}
	public function infoPlantilla()
	{
		$id=$this->input->post('id');
		$infoTemplate = $this->Model_linkTree->infoTemplate($id);
		echo json_encode($infoTemplate);
	}
	public function infoLink()
	{
		$id=$this->input->post('id');
		$infoTemplate = $this->Model_linkTree->infoLink($id);
		echo json_encode($infoTemplate);
	}
}