<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_errorpage extends CI_Model {

  function __construct(){
    parent::__construct();
  }

  public function insertIntruso($dato){
    $this->db->insert('master_security',$dato);
  }

  public function verificarEmail($email)
  {
    $this->db->select('COUNT(*) as contar');
    $this->db->where('correo',$email);

    $resultado = $this->db->get('master_usuarios');
    return $resultado->row();
  }
  public function verificarUsuario($email)
  {
    $this->db->select('COUNT(*) as contar');
    $this->db->where('correo',$email);

    $resultado = $this->db->get('master_usuarios');
    return $resultado->row();
  }
}
