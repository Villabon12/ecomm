<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_solicitudes extends CI_Model
{

    //metodo contructor 

    function __construct()
    {
        parent::__construct();
    }
    public function consultcuenta()
    {
        $id_usuario = $this->session->userdata('ID');
        $traer = "SELECT * FROM comercio_cuentas WHERE estado='Verificado Exitosamente' AND id_socio=?";
        $query = $this->db->query($traer, $id_usuario);
        return $query->result();
    }
    public function info_cuenta($id)
    {
        $traer = "SELECT * FROM comercio_cuentas WHERE estado='Verificado Exitosamente' AND id=?";
        $query = $this->db->query($traer,$id);
        return $query->row();
    }
    public function insert_solicitud($data)
    {
		return $this->db->insert("tb_solicitudes", $data);
    }
    public function tb_histo_pro()
    {
        $id = $this->session->userdata('ID');
        $traer = "SELECT * FROM tb_solicitudes   WHERE id_usuario=?";
        $query = $this->db->query($traer,$id);
        return $query->result();
    }
    public function tb_histo_comer()
    {
        $id = $this->session->userdata('ID');
        $traer = "SELECT * FROM comercio_solicitudes   WHERE id_comercio=?";
        $query = $this->db->query($traer,$id);
        return $query->result();
    }
    public function tb_histo_admin()
    {
        $traer = "SELECT c1.*, c2.nombre, c2.apellido1, c2.cedula, c2.celular  FROM tb_solicitudes c1, master_usuarios c2 WHERE c1.id_usuario=c2.id";
        $query = $this->db->query($traer);
        return $query->result();
    }
    public function tb_histo_admincomer()
    {
        $traer = "SELECT c1.*, c2. nombre_negocio , c2.celular  FROM comercio_solicitudes c1, master_usuarios c2 WHERE c1.id_comercio=c2.id";
        $query = $this->db->query($traer);
        return $query->result();
    }
    public function update_solicitudesuser($datos, $id)
    {
        $this->db->where('id', $id);
		$this->db->update('tb_solicitudes', $datos);
    }
    public function update_solicitudescomer($datos, $id)
    {
        $this->db->where('id', $id);
		$this->db->update('comercio_solicitudes', $datos);
    }
    public function insert_enviowallet($data)
    {
		return $this->db->insert("tb_registro_movimiento", $data);
    }
    public function tb_histo_pasowallet()
    {
        $id = $this->session->userdata('ID');
        $traer = "SELECT * FROM tb_registro_movimiento  WHERE id_usuario=?";
        $query = $this->db->query($traer,$id);
        return $query->result();
    }
    public function tb_histo_pasowalletadmi()
    {
        $traer = "SELECT c1.*, c2.nombre, c2.apellido1, c2.cedula, c2.celular  FROM tb_registro_movimiento c1, master_usuarios c2 WHERE c1.id_usuario=c2.id";
        $query = $this->db->query($traer);
        return $query->result();
    }

}
