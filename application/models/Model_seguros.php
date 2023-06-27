<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_seguros extends CI_Model
{

    //metodo contructor 

    function __construct()
    {
        parent::__construct();
    }

    public function insert_seguro($data)
    {
        return $this->db->insert("tb_seguros", $data);
    }
    public function insert_cotizacion($data)
    {
        return $this->db->insert("tb_seguros_cotizacion", $data);
    }

    public function traer_categorias()
    {
        $traer = "SELECT * FROM categorias_seguros ";
        $query = $this->db->query($traer);
        return $query->result();
    }
    public function traer_seguros()
    {
        $traer = "SELECT c1.* ,c2.nombre_negocio FROM tb_seguros c1, master_usuarios c2 WHERE c1.id_comercio=c2.id AND c1.estado=1 ";
        $query = $this->db->query($traer);
        return $query->result();
    }
    public function traer_seguros_comer()
    {
        $id = $this->session->userdata('ID');
        $traer = "SELECT c1.* ,c2.nombre_negocio FROM tb_seguros c1, master_usuarios c2 WHERE id_comercio=? AND c1.id_comercio=c2.id";
        $query = $this->db->query($traer,$id);
        return $query->result();
    }
    public function traer_cotizaciones()
    {
        $id = $this->session->userdata('ID');
        $traer = "SELECT c1.*,c2.nombre,c2.apellido1,c2.cedula,c2.correo,c2.fecha_nacimiento,c2.celular ,c4.nombre AS categoria FROM tb_seguros_cotizacion c1,master_usuarios c2,tb_seguros c3,categorias_seguros c4 WHERE c1.id_cliente=c2.id AND c3.id_comercio=? AND c3.id_categoria=c4.id";
        $query = $this->db->query($traer,$id);
        return $query->result();
    }
    public function contar_cotizaciones()
    {
        $id = $this->session->userdata('ID');
        $traer = "SELECT COUNT(*) AS contar FROM tb_seguros_cotizacion WHERE id_cliente=? ";
        $query = $this->db->query($traer,$id);
        return $query->row();
    }
    public function traer_cotizaciones_propia()
    {
        $id = $this->session->userdata('ID');
        $traer = "SELECT c1.*,c2.nombre AS nombre_seguro ,c2.duracion ,c2.descripcion FROM tb_seguros_cotizacion c1, tb_seguros c2 WHERE id_cliente=? AND c1.id_seguro=c2.id";
        $query = $this->db->query($traer,$id);
        return $query->result();
    }
    public function update_seguros_cotizacion($id, $dato)
	{
		$this->db->where("id", $id);
		return $this->db->update("tb_seguros_cotizacion", $dato);
	}
    public function update_seguros($id, $dato)
	{
		$this->db->where("id", $id);
		return $this->db->update("tb_seguros", $dato);
	}
}
