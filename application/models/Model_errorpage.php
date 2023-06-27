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

  public function verificarUsuario($usuario)
  {
    $this->db->select('COUNT(*) as contar');
    $this->db->where('user',$usuario);

    $resultado = $this->db->get('master_usuarios');
    return $resultado->row();
  }

  public function verificarCedula($cedula)
  {
    $this->db->select('COUNT(*) as contar');
    $this->db->where('cedula',$cedula);

    $resultado = $this->db->get('master_usuarios');
    return $resultado->row();
  }

  public function insertarProducto($data)
  {
    $this->db->insert('horario',$data);

  }

  public function traerDatos($cedula)
  {
    $this->db->select('*');
    $this->db->where('cedula',$cedula);

    $resultado = $this->db->get('master_usuarios');
    return $resultado->row();
  }

  public function traerDatosUser($cedula)
  {
    $this->db->select('*');
    $this->db->where('user',$cedula);

    $resultado = $this->db->get('master_usuarios');
    return $resultado->row();
  }

  public function update($data,$id)
  {
    $this->db->where("cedula",$id);
    $this->db->update("master_usuarios",$data);
    return 1;
  }
}
