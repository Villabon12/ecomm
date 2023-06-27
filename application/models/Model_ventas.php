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

    $query = $this->db->query($sql, [$idUsuario]);

    return $query->row();
  }
  public function cargar_datos_cliente()
  {
    $idUsuario = $this->session->userdata('ID');
    $sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP FROM master_usuarios u, master_wallet w WHERE u.id= ? AND w.id = u.wallet_id";

    $query = $this->db->query($sql, [$idUsuario]);

    return $query->row();
  }
  public function traerCategorias()
  {
    $sql = "SELECT c1.id, c1.nombre,c1.img, COUNT(c2.nombre) cupon
    FROM comercio_categoria c1,comercio_cupones c2
    WHERE c2.id_categoria=c1.id
    GROUP BY 1 ";
    $query = $this->db->query($sql);
    return $query->result();
  }
  public function traerCategoriastoda()
  {
    $sql = "SELECT * from comercio_categoria";
    $query = $this->db->query($sql);
    return $query->result();
  }
  public function traerCategorias2($ciudad)
  {
    $sql = "SELECT c1.id, c1.nombre,c1.img
    FROM comercio_categoria c1,comercio_cupones c2,master_usuarios c3
    WHERE c2.id_categoria=c1.id
    AND c2.id_usuario=c3.id
    AND c3.ciudad=?
    GROUP BY 1
    UNION 
    SELECT   c1.id,  c1.nombre,c1.img
    FROM comercio_categoria c1,comercio_cupones c2,master_usuarios c3
    WHERE c2.id_categoria=c1.id
    AND c2.id_usuario=c3.id
    AND c3.ciudad!=?
    AND c2.envio_nacio=1
    GROUP BY 1
    ";
    $query = $this->db->query($sql, array($ciudad, $ciudad));
    return $query->result();
  }
  public function registroCompraPresen()
  {
    $sql = "SELECT 
    FROM comercio_categoria
    ";
    $query = $this->db->query($sql);
    return $query->result();
  }
  public function Aceptarcomprafisica($id, $data)
  {
    $this->db->where("id", $id);
    return $this->db->update("comercio_wallet", $data);
  }
  public function Aceptarcompracarrito($id, $data)
  {
    $this->db->where("comercio_venta_id", $id);
    return $this->db->update("comercio_wallet", $data);
  }
  public function validarVenta($id)
  {
    $sql = "SELECT COUNT(*) AS contar
	FROM comercio_wallet WHERE id=?  AND
	confi_user=1 And confi_comer=1;";
    $query = $this->db->query($sql, $id);

    return $query->row();
  }
  //consultas para carrito
  public function deleteListado($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('comercio_wallet');
  }
  public function insert_compra($data)
  {
    return $this->db->insert("comercio_ventas", $data);
  }
  public function updateid($id, $data)
  {
    $this->db->where("id_usuario", $id);
    $this->db->where("comercio_venta_id", 0);
    return $this->db->update("comercio_wallet", $data);
  }
  public function traerVenta($id)
  {
    $sql = "SELECT * FROM comercio_ventas WHERE id=?";
    $query = $this->db->query($sql, $id);
    return $query->row();
  }
  public function aggQR($id,$data)
  {
    $this->db->where('id', $id);
    return $this->db->update('comercio_ventas',$data);
  }
    //consultas para compras por codigo 
    public function consultaCodigo($id ,$codigo)
    {
      $sql = "SELECT COUNT(*) AS contar FROM comercio_ventas WHERE comercio_id=? AND codigo=?";
      $query = $this->db->query($sql, [$id,$codigo]);
      return $query->row();
    }
    public function traerporCodigo($id ,$codigo)
    {
      $sql = "SELECT * FROM comercio_ventas WHERE comercio_id=? AND codigo=?";
      $query = $this->db->query($sql, [$id,$codigo]);
      return $query->row();
    }
    public function traerPedido($id)
    {
      $sql = "SELECT * FROM comercio_ventas WHERE id=?";
      $query = $this->db->query($sql, [$id]);
      return $query->row();
    }
}