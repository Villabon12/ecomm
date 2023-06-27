<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_tarjetas extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    public function insertdata($data)
	{
		return $this->db->insert("tb_tarjetas", $data);
	}
    public function insertventa($data)
	{
		return $this->db->insert("tb_tarjetas_ven", $data);
	}
    public function tb_tarjetas()
    {
        $id = $this->session->userdata('ID');
        $traer = "SELECT c1.*, c2.nombre_negocio FROM tb_tarjetas c1, master_usuarios c2 WHERE c1.id_comercio=c2.id AND c1.id_comercio=?";
        $query = $this->db->query($traer, $id);
        return $query->result();
    }
    public function tb_tarjetasvendi()
    {
        $id = $this->session->userdata('ID');
        $traer = "SELECT c1.*, c2.nombre,c2.apellido1,c2.cedula ,c3.nombre AS nombre_tarje FROM tb_tarjetas_ven c1, master_usuarios c2 ,tb_tarjetas c3 WHERE c1.id_usuario=c2.id AND c3.id_comercio=?";
        $query = $this->db->query($traer, $id);
        return $query->result();
    }
    public function tb_tarjetascompra()
    {
        $id = $this->session->userdata('ID');
        $traer = "SELECT c1.*, c2.nombre,c2.apellido1,c2.cedula ,c3.nombre AS nombre_tarje FROM tb_tarjetas_ven c1, master_usuarios c2 ,tb_tarjetas c3 WHERE c1.id_usuario=c2.id AND c1.id_usuario=? AND c1.estado=1 AND c1.valida=1";
        $query = $this->db->query($traer, $id);
        return $query->result();
    }
    public function traer_tarjetas()
    {
        $traer = "SELECT c1.*, c2.nombre_negocio,c2.img_perfil FROM tb_tarjetas c1, master_usuarios c2 WHERE c1.id_comercio=c2.id AND c1.cantidad>0 And c1.estado=1";
        $query = $this->db->query($traer);
        return $query->result();
    }
    public function cargar_datos_tarjeta($id)
    {
        $traer = "SELECT c1.*, c2.nombre_negocio,c2.img_perfil FROM tb_tarjetas c1, master_usuarios c2 WHERE c1.id_comercio=c2.id AND c1.id=? ";
        $query = $this->db->query($traer,$id);
        return $query->row();
    }
    public function cargar_datos_tarjeta_vendi($id)
    {
        $traer = "SELECT c1.*, c2.nombre,c2.apellido1,c2.cedula ,c3.nombre AS nombre_tarje,c3.id_comercio,c3.descuento FROM tb_tarjetas_ven c1, master_usuarios c2 ,tb_tarjetas c3 WHERE c1.id_usuario=c2.id AND c1.id=?";
        $query = $this->db->query($traer,$id);
        return $query->row();
    }
    public function update_tarjeta($id, $dato)
	{
		$this->db->where("id", $id);
		return $this->db->update("tb_tarjetas", $dato);
	}
    public function update_tarjeta_vendi($id, $dato)
	{
		$this->db->where("id", $id);
		return $this->db->update("tb_tarjetas_ven", $dato);
	}
    public function buscartarjetas()
    {
        $id = $this->session->userdata('ID');
        $traer = "SELECT COUNT(*) AS contar  FROM tb_tarjetas_ven WHERE id_usuario=? AND estado =1 And valida=1";
        $query = $this->db->query($traer,$id);
        return $query->row();
    }
}
