<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ventas extends CI_Model
{

	//metodo contructor 

	function __construct()
	{
		parent::__construct();

	}
    public function cargar_datos()
  {
	
    $idUsuario = $this->session->userdata('ID');
    $sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP FROM master_usuarios u, master_wallet_comercio w WHERE u.id= ? AND w.id_usuario = u.id";

    $query = $this->db->query($sql,[$idUsuario]);

    return $query->row();
  }
  public function cargar_datos_cliente()
  {
    $idUsuario = $this->session->userdata('ID');
    $sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP FROM master_usuarios u, master_wallet w WHERE u.id= ? AND w.id = u.wallet_id";

    $query = $this->db->query($sql, [$idUsuario]);

    return $query->row();
  }


}