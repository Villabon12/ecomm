<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Comercio extends CI_Model
{

	//metodo contructor 

	function __construct()
	{
		parent::__construct();
		// $this->load->model('model_registro');

	}
	public function traerReferidos()
	{

		$traer = "  SELECT u2.nombre,u2.apellido1 AS apellido,u2.fecha_registro , u3.nombre AS empresa ,SUM(u1.activo) AS activo
		FROM comercio_usuarios u1, master_usuarios u2 , comercio_cupones u3
		WHERE u2.id=u1.usuarios_id
		AND u3.id=u1.cupones_id 
		GROUP BY  u2.nombre,u2.apellido1,u3.nombre";
		$query = $this->db->query($traer);

		//cuando la consulta devuelve un registro
		//return $query ->row();
		// cuando la consulta devuelve un registro
		return $query->result();
	}
	public function estadoRegisto($id)
	{
	$traer = "SELECT ubica
	FROM master_usuarios
	WHERE id=?";

		$query = $this->db->query($traer,[$id]);
		return $query->row();
	}

	// $this->db->select("u2.nombre,u2.apellido1 AS apellido,u2.fecha_registro , u3.nombre AS empresa ,SUM(u1.activo) AS activo");
	// $this->db->from("comercio_usuarios u1");
	// $this->db->join("master_usuarios u2","u2.id=u1.usuarios_id");
	// $this->db->join("comercio_cupones u3","u3.id=u1.cupones_id");
	// $this->db->group_by("u2.nombre,u2.apellido1,u3.nombre");

	// $resultado = $this->db->get();
	// return $resultado->result();

	public function binario($id)
	{
		$traer = " SELECT id, nombre,apellido1,celular
			FROM master_usuarios
			WHERE id_papa_pago = ? ";
		$query = $this->db->query($traer, [$id]);

		//cuando la consulta devuelve un registro
		//return $query ->row();
		// cuando la consulta devuelve un registro
		return $query->result();
	}

	/* modelos de parte de cupones */

	public function guardarcupon($data)
	{
		return $this->db->insert("comercio_cupones", $data);
	}

	public function cupones_index()
	{
		$traer = ' SELECT c1.id,c2.id AS id_usuario , c2.nombre_negocio , c3.nombre, c3.img, c1.stok ,c1.fecha_corte,c3.precio,c1.descuento ,c3.id AS id_producto,c4.cashback,c4.id AS id_cashback ,c3.valor_domicilio,c3.hora,c3.minutos
		FROM comercio_cupones c1, master_usuarios c2 ,comercio_productos c3 ,comercio_parametros c4
		WHERE c1.id_usuario=c2.id
		AND c1.id_producto=c3.id
		AND c1.activo=1
		GROUP BY c1.id';

		$query = $this->db->query($traer);
		return $query->result();
	}


	public function cargar_cupones($id)
	{
		$this->db->where("id", $id);
		$resultados = $this->db->get("comercio_cupones");
		return $resultados->row();
	}


	public function actualizarCupones($id, $data)

	{
		$this->db->where("id", $id);
		return $this->db->update("comercio_cupones", $data);
	}
	public function traerCupones($id)

	{
		$traer = "SELECT c2.nombre_negocio , c3.nombre, c3.img, c1.stok ,c1.fecha_corte,c3.precio,c1.descuento ,c4.cashback
		FROM comercio_cupones c1, master_usuarios c2 ,comercio_productos c3 ,comercio_parametros c4
		WHERE c3.id_usuario=?
		AND c1.id_usuario=c2.id
		AND c1.id_producto=c3.id

		GROUP BY c1.id";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}

	/* modelos de parte de producto */

	public function traer_producto($id)

	{
		$traer = " SELECT * 
		FROM comercio_productos
		where id_usuario= ?
		AND activo=1
		ORDER BY nombre";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function guardarProducto($data)
	{
		return $this->db->insert("comercio_productos", $data);
	}
	function eliminarProducto($datos, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('comercio_productos', $datos);
	}
	function modificarProducto($productos, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('comercio_productos', $productos);
	}
	public function enviarVenta($data)
	{
		return $this->db->insert("comercio_wallet", $data);
	}
	public function actualizarwallet($id_usuario, $data)

	{
		$this->db->where("id_usuario", $id_usuario);
		return $this->db->update("master_wallet", $data);
	}
	public function actualizarwallet_comercio($id_usuario, $data)

	{
		$this->db->where("id_usuario", $id_usuario);
		return $this->db->update("master_wallet_comercio", $data);
	}
	//////////////////////////// historial compra ////////////////////////

	public function traerCompra($id)

	{

		$traer = " SELECT c1.id,c4.nombre,c3.nombre_negocio,c1.precio,c1.fecha_compra,c5.nombre AS producto,c1.gana_cash, c6.id AS id_papa,c1.gana_cash_papa, c1.gana_cash_abuelo
		FROM comercio_wallet c1, comercio_parametros c2, master_usuarios c3,master_usuarios c4,comercio_productos c5, master_usuarios c6
		WHERE c1.id_comercio=c3.id
		AND c4.id=?	
		AND c4.id = c6.id_papa_pago
		AND c2.id=1
		AND c1.id_usuario=c4.id
		AND c1.id_producto=c5.id";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}

	public function traerCompraPapa($id)

	{

		$traer = "SELECT c1.id,c4.nombre,c3.nombre_negocio,c1.precio,c1.fecha_compra,c5.nombre AS producto,c1.gana_cash, c6.id AS id_papa,c1.gana_cash_papa,c7.id AS id_abuelo,c1.gana_cash_abuelo
		FROM comercio_wallet c1, comercio_parametros c2, master_usuarios c3,master_usuarios c4,comercio_productos c5, master_usuarios c6, master_usuarios c7
		WHERE c1.id_comercio=c3.id 
		AND c4.id_papa_pago = c6.id
		AND c6.id=?
		AND c6.id_papa_pago = c7.id
		AND c2.id=1
		AND c1.id_usuario=c4.id
		AND c1.id_producto=c5.id  ";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function traerCompraAbuelo($id)

	{

		$traer = "SELECT c1.id,c4.nombre,c3.nombre_negocio,c1.precio,c1.fecha_compra,c5.nombre AS producto,c1.gana_cash, c6.id AS id_papa,c1.gana_cash_papa,c7.id AS id_abuelo,c1.gana_cash_abuelo
		FROM comercio_wallet c1, comercio_parametros c2, master_usuarios c3,master_usuarios c4,comercio_productos c5, master_usuarios c6, master_usuarios c7
		WHERE c1.id_comercio=c3.id 
		AND c4.id_papa_pago = c6.id
		AND c7.id=?
		AND c6.id_papa_pago = c7.id
		AND c2.id=1
		AND c1.id_usuario=c4.id
		AND c1.id_producto=c5.id  ";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}

	public function traerCashback($id)

	{
		$traer = "SELECT id_usuario,SUM(gana_cash) AS plata
		FROM comercio_wallet 
		WHERE id_usuario=?";

		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}

	public function traerVentasComercio($id)

	{
		$traer = "SELECT c3.nombre_negocio,c4.nombre,c4.apellido1,c1.precio,c1.fecha_compra,c5.nombre AS producto,c6.descuento
		FROM comercio_wallet c1, master_usuarios c3,master_usuarios c4,comercio_productos c5,comercio_cupones c6
		WHERE c3.id=?
		AND c1.id_comercio=c3.id
		AND c6.id_producto=c5.id
		AND c1.id_usuario=c4.id
		AND c1.id_producto=c5.id
		";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function enviarPeticion($data)
	{
		return $this->db->insert("comercio_solicitudes", $data);
	}
	public function traerPeticion()

	{
		$traer = "SELECT c1.id,c1.id_comercio, c2.nombre_negocio, c1.valor,c1.nota,c1.fecha_peticion, c3.cuenta_COP,c1.activo
		FROM comercio_solicitudes c1, master_usuarios c2 ,master_wallet_comercio c3
		WHERE c1.id_comercio=c2.id
		AND c3.id_usuario=c1.id_comercio
		AND c1.activo=1";

		$query = $this->db->query($traer);
		return $query->result();
	}

	public function traer_peticion_comercio($id)

	{
		$traer = "SELECT c1.id, c1.id_comercio, c2.nombre_negocio, c1.valor,c1.nota,c1.fecha_peticion, c3.cuenta_COP ,c1.estado,c1.icono,c1.activo,c1.img
		FROM comercio_solicitudes c1, master_usuarios c2 ,master_wallet_comercio c3
		WHERE c1.id_comercio=?
		AND c1.id_comercio=c2.id
		AND c3.id_usuario=c1.id_comercio";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function actualizar_peticion($id, $dato)

	{
		$this->db->where("id", $id);
		return $this->db->update("comercio_solicitudes", $dato);
	}
	public function traerTodoComercio()

	{
		$traer = "SELECT c2.nombre_negocio,c2.nombre AS nombre_encargado,c2.correo,c2.celular,c1.cuenta_COP,c2.fecha_registro
		FROM master_wallet_comercio c1,master_usuarios c2
		WHERE c1.id_usuario=c2.id";

		$query = $this->db->query($traer);
		return $query->result();
	}

	public function traerCedula($data)
	{
		$this->db->select('nombre, apellido1');
		$this->db->where('cedula', $data);
		$resultados = $this->db->get('master_usuarios');
		return $resultados->row();
	}
	public function traerPorcentaje($id_porcentaje)

	{
		$traer = "SELECT porcentaje
		FROM comercio_recarga
		WHERE id=?";

		$query = $this->db->query($traer, [$id_porcentaje]);
		return $query->row();
	}
	public function guardarRegistroRecarga($data)
	{
		return $this->db->insert("comercio_recargas_historial", $data);
	}
	public function traerHistorial_debe($id_comercio)

	{
		$traer = "SELECT c1.id, c1.id_negocio,c2.nombre_negocio, c3.nombre ,c1.cc_usuario,c1.fecha_pago, c1.valor,c1.img,c1.estado
		FROM comercio_recargas_historial c1, master_usuarios  c2,master_usuarios c3
		WHERE c1.id_negocio=?
		AND c1.id_negocio=c2.id
		AND c1.cc_usuario=c3.cedula";

		$query = $this->db->query($traer, [$id_comercio]);
		return $query->result();
	}
	public function traerHistorial()

	{
		$traer = "SELECT c1.id,c1.id_negocio, c2.nombre_negocio, c3.nombre ,c1.cc_usuario,c1.fecha_pago, c1.valor,c1.img,c1.estado
		FROM comercio_recargas_historial c1, master_usuarios  c2,master_usuarios c3
		WHERE c1.id_negocio=c2.id
		AND c1.cc_usuario=c3.cedula";

		$query = $this->db->query($traer);
		return $query->result();
	}
	public function actualizar_historial($id, $dato)

	{
		$this->db->where("id", $id);
		return $this->db->update("comercio_recargas_historial", $dato);
	}
	public function traer_parametros($id)
	{
		$traer = "SELECT cashback
		FROM comercio_parametros
		WHERE id=?";

		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function traer_cuentas_deudoras()
	{
		$traer = "SELECT c2.nombre_negocio ,c1.cuenta_COP_deuda
		FROM master_wallet_comercio c1 ,master_usuarios c2
		WHERE c1.id_usuario=c2.id";

		$query = $this->db->query($traer);
		return $query->result();
	}

	public function suma_cuentas_deudoras()
	{
	$traer = "SELECT SUM(cuenta_COP_deuda) AS suma
	FROM master_wallet_comercio";

		$query = $this->db->query($traer);
		return $query->row();
	}
	public function suma_cuentas_negocios()
	{
	$traer = "SELECT SUM(ganancias_comercio) AS ganancias
	FROM comercio_wallet";

		$query = $this->db->query($traer);
		return $query->row();
	}
	public function traerComprasTotal()
	{
	$traer = "SELECT c1.nombre, c2.precio, c3.nombre_negocio,c2.fecha_compra
	FROM master_usuarios c1, comercio_wallet c2 ,master_usuarios c3
	WHERE c2.id_usuario=c1.id
	AND c2.id_comercio=c3.id";

		$query = $this->db->query($traer);
		return $query->result();
	}
	public function parametros()

	{
		$traer = "SELECT *
		FROM comercio_parametros";
		$query = $this->db->query($traer);
		return $query->result();
	}
	function Modificar_parametros($datos,$id){
        $this->db->where('id',$id);
        $this->db->update('comercio_parametros',$datos);
    }
}
