<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_login extends CI_Model
{

	//metodo contructor 

	function __construct()
	{
		parent::__construct();
		// $this->load->model('model_registro');

	}

	public function registrar($data)
	{
	  return $this->db->insert("master_comercio", $data);
	}
  
  
}