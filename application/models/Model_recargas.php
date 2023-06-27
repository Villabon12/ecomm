<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_recargas extends CI_Model
{

    //metodo contructor 

    function __construct()
    {
        parent::__construct();
    }

    public function historialcrucecuentas($data)
    {

        return $this->db->insert("registro_cruce", $data);
    }
    public function traer_historial()
    {
        $id_comercio = $this->session->userdata('ID');
        $traer = "SELECT fecha, SUM(valor) AS valor  FROM registro_cruce WHERE id_comercio=? GROUP BY 1";
        $query = $this->db->query($traer, $id_comercio);
        return $query->result();
    }
    public function datoregistro()
    {
        $id_comercio = $this->session->userdata('ID');
        $traer = "SELECT * FROM registro_cruce WHERE id_comercio=?  ORDER BY fecha DESC";
        $query = $this->db->query($traer, $id_comercio);
        return $query->row();
    }
    public function datosdeuda()
    {
        $id_comercio = $this->session->userdata('ID');
        $traer = "SELECT * FROM comercio_recargas_historial WHERE id_negocio=? AND estado='debe' ORDER BY fecha_pago ASC ";
        $query = $this->db->query($traer, $id_comercio);
        return $query->result();
    }
    public function datosdeuda2($id)
    {
        $traer = "SELECT * FROM comercio_recargas_historial WHERE id=?  AND estado='debe'";
        $query = $this->db->query($traer, $id);
        return $query->row();
    }
   /////
   public function traer_paquetes()
   {
       $traer = "SELECT * from tb_cupo";
       $query = $this->db->query($traer);
       return $query->result();
   }
   public function tb_cupo_soli_propio()
   {
       $id = $this->session->userdata('ID');
       $traer = "SELECT c1.*,c2.nombre_negocio, c3.nombre AS nombre_paquete FROM tb_cupo_solicitado c1,master_usuarios c2 ,tb_cupo c3 WHERE c1.id_negocio=? AND c1.id_negocio=c2.id AND c1.id_cupo=c3.id";
       $query = $this->db->query($traer, $id);
       return $query->result();
   }
   public function tb_cupo_soli_admin()
   {
       $traer = "SELECT c1.*,c2.nombre_negocio, c3.nombre AS nombre_paquete FROM tb_cupo_solicitado c1,master_usuarios c2 ,tb_cupo c3 WHERE c1.id_negocio=c2.id AND c1.id_cupo=c3.id";
       $query = $this->db->query($traer);
       return $query->result();
   }
   public function buscar_paquete($id)
   {
       $traer = "SELECT * from tb_cupo WHERE id=?";
       $query = $this->db->query($traer, $id);
       return $query->row();
   }
   public function insert_tb_cuposoli($data)
   {
       return $this->db->insert("tb_cupo_solicitado", $data);
   }
   function updatecupo($id, $data)
   {
       $this->db->where('id', $id);
       $this->db->update('tb_cupo_solicitado', $data);
   }
   public function inf_cupo_todo($id)
   {
       $traer = "SELECT c1.*,c2.nombre_negocio, c3.nombre AS nombre_paquete FROM tb_cupo_solicitado c1,master_usuarios c2 ,tb_cupo c3 WHERE c1.id_negocio=c2.id AND c1.id_cupo=c3.id AND c1.id=?";
       $query = $this->db->query($traer,$id);
       return $query->row();
   }
   public function contar_cupos()
   {
       $id = $this->session->userdata('ID');
       $traer = "SELECT count(*) from tb_cupo_solicitado WHERE id_negocio=? AND estado=1";
       $query = $this->db->query($traer, $id);
       return $query->result();
   }
   public function tb_cupo_soli_apro()
   {
       $id = $this->session->userdata('ID');
       $traer = "SELECT c1.*,c2.nombre_negocio, c3.nombre AS nombre_paquete FROM tb_cupo_solicitado c1,master_usuarios c2 ,tb_cupo c3 WHERE c1.id_negocio=? AND c1.id_negocio=c2.id AND c1.id_cupo=c3.id AND c1.estado=1";
       $query = $this->db->query($traer, $id);
       return $query->result();
   }
   public function inser_tbcupo($data)
   {
       return $this->db->insert("tb_recargas_cupo", $data);
   }
   //////
    public function tb_historial_recargaspro($id)
    {
        $traer = "SELECT c1.*, c2.nombre_negocio FROM comercio_recargas_historial c1, master_usuarios c2 WHERE c1.id_negocio=c2.id  AND c1.cc_usuario=?";
        $query = $this->db->query($traer, $id);
        return $query->result();
    }

    // Update Query For Selected Student
    function updatepago($fecha, $data)
    {
        $this->db->where('fecha_pago<', $fecha);
        $this->db->update('comercio_recargas_historial', $data);
    }
    function updatepago2($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('comercio_recargas_historial', $data);
    }
    public function consulta_cupo()
    {
        $id_comercio = $this->session->userdata('ID');
        $traer = "SELECT c1.*,c2.valor FROM master_usuarios c1, tb_cupo c2 WHERE c1.id=? AND c1.id_cupo=c2.id";
        $query = $this->db->query($traer, $id_comercio);
        return $query->row();
    }
    public function sum_saldo()
    {
        $id_comercio = $this->session->userdata('ID');
        $traer = "SELECT SUM(valor) AS valor FROM comercio_recargas_historial WHERE id_negocio=? AND estado='debe'";
        $query = $this->db->query($traer, $id_comercio);
        return $query->row();
    }
      //apartado pago directos
      public function insert_tb_pagos($data)
      {
  
          return $this->db->insert("tb_pagosdirectos", $data);
      }
      function updatestatus($id, $data)
      {
          $this->db->where('id', $id);
          $this->db->update('tb_pagosdirectos', $data);
      }
      function pazSalvo($id, $data)
      {
          $this->db->where('id_negocio', $id);
          $this->db->update('comercio_recargas_historial', $data);
      }
      public function tb_pagos()
      {
          $traer = "SELECT c1.*, c2.nombre_negocio FROM tb_pagosdirectos c1, master_usuarios c2 WHERE c1.id_comercio=c2.id  ";
          $query = $this->db->query($traer);
          return $query->result();
      }
      public function dataPago($id)
      {
          $traer = "SELECT * FROM tb_pagosdirectos  WHERE id=? ";
          $query = $this->db->query($traer,$id);
          return $query->row();
      }
      public function dataNegocio()
      {
          $id = $this->session->userdata('ID');
          $traer = "SELECT * FROM tb_pagosdirectos  WHERE id_comercio=? ";
          $query = $this->db->query($traer,$id);
          return $query->result();
      }
      ////modelos para admin actualizar cupos
      public function knowCupon()
      {
          $traer = "SELECT c1.nombre_negocio,c1.celular,c2.valor  FROM master_usuarios c1,tb_cupo c2 WHERE c1.tipo='Comercio' AND c1.auto_recar=2 AND c1.id_cupo=c2.id";
          $query = $this->db->query($traer);
          return $query->result();
      }
}
