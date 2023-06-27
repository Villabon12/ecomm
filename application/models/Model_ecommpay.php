<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ecommpay extends CI_Model
{

	//metodo contructor 

	function __construct()
	{
		parent::__construct();
		// $this->load->model('model_registro');

	}
    function insertData($data)
	{
		$this->db->insert('tb_transfereciaPago', $data);
	}
	public function estadoRegisto($id)
	{
		$traer = "SELECT count(*) AS contar FROM userEpagos WHERE id_comercio=?";
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function estadoApi($id)
	{
		$traer = "SELECT count(*) AS contar FROM userEpagos WHERE apikey=?";
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	function insertNewUser($data)
	{
		$this->db->insert('userEpagos', $data);
	}
	public function datos_comercio($Apykey)

	{
		$sql = "SELECT * FROM userEpagos c1 ,master_wallet_comercio c2 WHERE c1.id_comercio=c2.id_usuario AND c1.apikey=?";
		$query = $this->db->query($sql, $Apykey);
		return $query->row();
	}
	
}