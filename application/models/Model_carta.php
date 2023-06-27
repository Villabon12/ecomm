<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_carta extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function Llamar_datos($id)
	{
		$this->db->where('id', $id);
		$resultado = $this->db->get('master_usuarios');
		return $resultado->row();
	}

	public function Llamar_botones()
	{
		$this->db->select('id_boton, nombre_boton');
		$this->db->from('botones');
		$query = $this->db->get();
		return $query->result_array();
	}

}