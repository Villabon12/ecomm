<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_landing extends CI_Model
{

	//metodo contructor 

	function __construct()
	{
		parent::__construct();
		// $this->load->model('model_registro');

	}
    public function traer_producto()
    {
        $traer = " SELECT nombre,valor,descripcion
        FROM paquetes";
		$query = $this->db->query($traer);

		//cuando la consulta devuelve un registro
		//return $query ->row();
		// cuando la consulta devuelve un registro
		return $query->result();
    }
}