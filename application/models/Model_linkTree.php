<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Model_linkTree extends CI_Model
{
	//metodo contructor 
	function __construct()
	{
		parent::__construct();
	}

	function insertData($data)
	{
		$this->db->insert('linkTree', $data);
	}
	function traerData($id)
	{
		$traer = "SELECT c1.*,c2.icono, c2.nombre_boton FROM linkTree c1 ,botones c2 WHERE  c1.id_red=c2.id_boton AND c1.id_usuario=?";
		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	function getTemplate()
	{
		$traer = "SELECT *  from linkTree_plantillas Where id!=1";
		$query = $this->db->query($traer);
		return $query->result();
	}
	function infoTemplate($id)
	{
		$traer = "SELECT *  from linkTree_plantillas Where id=?";
		$query = $this->db->query($traer,$id);
		return $query->row();
	}
	function infoLink($id)
	{
		$traer = "SELECT *  from botones Where id_boton=?";
		$query = $this->db->query($traer,$id);
		return $query->row();
	}
	public function conteoRedes($id_usuario)
	{
		$conteo = "SELECT COUNT(*) AS contar FROM linkTree WHERE id_usuario = ?";
		$query = $this->db->query($conteo, $id_usuario);
		return $query->row();
	}
	function insertUser($data)
	{
		$this->db->insert('linkTreeUser', $data);
	}
	public function personalizacion($id)
	{
		$traer = "SELECT * FROM linkTreeUser WHERE id_usuario=?";
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function countUser($id)
	{
		$traer = "SELECT count(*) AS contar FROM linkTreeUser WHERE id_usuario=?";
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function UpdatePeronali($datos, $id)
	{
		$this->db->where('id_usuario', $id);
		$this->db->update('linkTreeUser', $datos);
	}
	public function DataBoton($id)
	{
		$traer = "SELECT *  FROM botones WHERE id_boton=?";
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function Getboton()
	{
		$traer = "SELECT *  FROM botones ";
		$query = $this->db->query($traer);
		return $query->result();
	}
	// contador de ingresos
	public function InfoAnalisis($url)
	{
		$conteo = "SELECT * FROM linkTreeUser WHERE url = ?";
		$query = $this->db->query($conteo, $url);
		return $query->row();
	}
	public function actualizar_visitas($url, $visitas) {
        $query = $this->db->get_where('linkTreeUser', array('url' => $url));
        if ($query->num_rows() == 0) {
            $this->db->insert('linkTreeUser', array('url' => $url, 'contador' => $visitas));
        } else {
            $this->db->update('linkTreeUser', array('contador' => $visitas), array('url' => $url));
        }
    }

}