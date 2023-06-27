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

		$query = $this->db->query($traer, [$id]);
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
		$traer = " SELECT id, nombre,apellido1,celular,posicion
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

	public function traerciudad()
	{
		$traer = 'SELECT * FROM municipios';
		$query = $this->db->query($traer);
		return $query->result();
	}
	public function traerciudad1()
	{
		$traer = 'SELECT c1.ciudad, COUNT(c2.nombre) AS cupon FROM master_usuarios c1,comercio_cupones c2
		WHERE c2.id_usuario=c1.id 
		GROUP BY 1
		ORDER BY ciudad';
		$query = $this->db->query($traer);
		return $query->result();
	}
	public function cupones_index()
	{
		$traer = ' SELECT c1.id,c2.id AS id_usuario , c2.nombre_negocio , c1.stok ,c1.fecha_corte,c1.descuento ,c4.cashback,c4.id AS id_cashback 
	 	FROM comercio_cupones c1, master_usuarios c2  ,comercio_parametros c4
	 	WHERE c1.id_usuario=c2.id
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

	function modificarRegistro($datos, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('master_usuarios', $datos);
	}
	public function validacion()
	{
		$traer = 'SELECT id,nombre,apellido1,celular,cedula,img_cedula_front,img_cedula_back,img_selfie,verificar_user
	FROM master_usuarios
	Where tipo="Socio"';

		$query = $this->db->query($traer);
		return $query->result();
	}
	public function validacion_comer()
	{
		$traer = 'SELECT *
	FROM master_usuarios
	WHERE tipo="Comercio"';

		$query = $this->db->query($traer);
		return $query->result();
	}
	function aceptarvalidacion($datos, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('master_usuarios', $datos);
	}


	// todo lo del proceso en Comercio

	public function traerCupones()
	{
		$id_comercio = $this->session->userdata('ID');
		$traer = ' SELECT c1.*,c2.nombre AS tipo
		FROM comercio_cupones c1,comercio_tipos c2
		WHERE c1.id_usuario=?
		AND c1.id_tipo=c2.id
		AND c1.stok >0
		ORDER BY c1.nombre';

		$query = $this->db->query($traer, $id_comercio);
		return $query->result();
	}

	public function traerdatoscupon($id)
	{
		$traer = ' SELECT *
		FROM comercio_cupones
		WHERE id=?
		ORDER BY nombre';

		$query = $this->db->query($traer, $id);
		return $query->row();
	}
	public function actualizarCupones($id, $data)
	{
		$this->db->where("id", $id);
		return $this->db->update("comercio_cupones", $data);
	}

	function eliminarCupon($datos, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('comercio_cupones', $datos);
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
	public function pruebaphp($ciudad)
	{
		$traer = 'SELECT c1.*, c2.nombre_negocio,c3.cashback,c4.id AS id_tipo, c4.nombre AS tipo,c2.id AS id_comercio
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3 ,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c3.id=1
		AND c1.id_tipo=c4.id
		AND c1.stok>0
		AND c2.ciudad=?
		UNION
		SELECT c1.*, c2.nombre_negocio,c3.cashback ,c4.id AS id_tipo, c4.nombre AS tipo,c2.id AS id_comercio
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c3.id=1
		AND c1.stok>0
		AND c1.id_tipo=c4.id
		AND c2.ciudad!=?
		AND c1.envio_nacio=1
		ORDER BY RAND();';

		$query = $this->db->query($traer, array($ciudad, $ciudad));
		return $query->result();
	}
	public function negocioexacto($id)
	{
		$traer = "SELECT c1.*, c2.nombre_negocio,c2.ciudad,c2.direccion AS id_negocio,c3.cashback ,c4.id AS id_tipo, c4.nombre AS tipo
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c1.id_tipo=c4.id
		AND c3.id=1
		AND c1.id_usuario=?
		ORDER BY descuento  DESC";

		$query = $this->db->query($traer, $id);
		return $query->result();
	}
	public function pruebaphpcomercio($id)
	{
		$traer = "SELECT c1.*, c2.nombre_negocio,c3.cashback ,c4.id AS id_tipo, c4.nombre AS tipo
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c1.id_tipo=c4.id
		AND c3.id=1
		AND c2.nombre_negocio=?
		ORDER BY descuento  DESC";

		$query = $this->db->query($traer, $id);
		return $query->result();
	}

	public function cuponcategoria($id, $ciudad)
	{
		$traer = "SELECT c1.*, c2.nombre_negocio,c2.id AS id_comercio,c3.cashback ,c4.id AS id_tipo, c4.nombre AS tipo,c5.nombre AS categoria
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3,comercio_tipos c4,comercio_categoria c5
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c1.id_tipo=c4.id
		AND c3.id=1
		AND c1.stok>0
		AND c1.id_categoria=c5.id
		AND c1.id_categoria=?
		AND c2.ciudad=?
		UNION
		SELECT c1.*, c2.nombre_negocio,c2.id AS id_comercio,c3.cashback ,c4.id AS id_tipo, c4.nombre AS tipo,c5.nombre AS categoria
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3,comercio_tipos c4,comercio_categoria c5
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c1.id_tipo=c4.id
		AND c3.id=1
		AND c1.stok>0
		AND c1.id_categoria=c5.id
		AND c1.id_categoria=?
		AND c2.ciudad!=?
		AND c1.envio_nacio=1";

		$query = $this->db->query($traer, array($id, $ciudad, $id, $ciudad));
		return $query->result();
	}
	public function catego($id)
	{
		$traer = "SELECT * from comercio_categoria Where id=?";

		$query = $this->db->query($traer, $id);
		return $query->row();
	}
	public function getProductosByCategoria($id, $ciudad)
	{

		$this->db->select("c1.*,c2.nombre_negocio,c3.cashback");
		$this->db->from("comercio_cupones c1");
		$this->db->join("master_usuarios c2", "c1.id_usuario = c2.id");
		$this->db->join("comercio_parametros c3", "c3.id=1");
		$this->db->where("c1.id_categoria", $id);
		$this->db->where("c1.activo", "1");
		$this->db->where("c1.stok > 0");
		$this->db->where("c2.ciudad", $ciudad);

		$resultados = $this->db->get();

		$this->db->select("c1.*,c2.nombre_negocio,c3.cashback");
		$this->db->from("comercio_cupones c1");
		$this->db->join("master_usuarios c2", "c1.id_usuario = c2.id");
		$this->db->join("comercio_parametros c3", "c3.id=1");
		$this->db->where("c1.id_categoria", $id);
		$this->db->where("c1.activo", "1");
		$this->db->where("c1.stok > 0");
		$this->db->where("c2.ciudad !=", $ciudad);

		$resultados2 = $this->db->get();
		return $this->db->query($resultados . " UNION " . $resultados2)->result();
	}
	public function buscarproducto($buscar, $ciudad)
	{

		$this->db->select("c1.*,c2.nombre_negocio,c3.cashback");
		$this->db->from("comercio_cupones c1");
		$this->db->join("master_usuarios c2", "c1.id_usuario = c2.id");
		$this->db->join("comercio_parametros c3", "c3.id=1");
		$this->db->like("c1.nombre", $buscar);
		$this->db->where("c1.activo", "1");
		$this->db->where("c2.ciudad", $ciudad);
		$this->db->where("c1.stok > 0");
		$this->db->order_by("descuento", "desc");
		$resultados = $this->db->get();

		return $resultados->result();
	}
	public function traerproducto($buscar)
	{

		$this->db->select("c1.*,c2.nombre_negocio,c3.cashback");
		$this->db->from("comercio_cupones c1");
		$this->db->join("master_usuarios c2", "c1.id_usuario = c2.id");
		$this->db->join("comercio_parametros c3", "c3.id=1");
		$this->db->like("c1.nombre", $buscar);
		$this->db->where("c1.activo", "1");
		$this->db->where("c1.stok > 0");
		$this->db->order_by("descuento", "desc");
		$resultados = $this->db->get();

		return $resultados->result();
	}
	public function buscarnego($id)
	{

		$this->db->select("c1.*,c2.nombre_negocio,c3.cashback");
		$this->db->from("comercio_cupones c1");
		$this->db->join("master_usuarios c2", "c1.id_usuario = c2.id");
		$this->db->join("comercio_parametros c3", "c3.id=1");
		$this->db->where("c1.activo", "1");
		$this->db->where("c2.id", $id);

		$resultados = $this->db->get();
		return $resultados->result();
	}
	//para el ajax
	public function menospuntos()
	{

		$this->db->select("c1.*,c2.nombre_negocio,c3.cashback");
		$this->db->from("comercio_cupones c1");
		$this->db->join("master_usuarios c2", "c1.id_usuario = c2.id");
		$this->db->join("comercio_parametros c3", "c3.id=1");
		$this->db->where("c1.activo", "1");
		$this->db->order_by("descuento", "desc");
		$this->db->order_by("precio", "desc");
		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function maspuntos()
	{

		$this->db->select("c1.*,c2.nombre_negocio,c3.cashback");
		$this->db->from("comercio_cupones c1");
		$this->db->join("master_usuarios c2", "c1.id_usuario = c2.id");
		$this->db->join("comercio_parametros c3", "c3.id=1");
		$this->db->where("c1.activo", "1");
		$this->db->order_by("descuento", "asc");
		$this->db->order_by("precio", "asc");
		$resultados = $this->db->get();
		return $resultados->result();
	}


	public function categoria($id)
	{
		$traer = " SELECT * 
		FROM comercio_productos
		WHERE id=?";

		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function tipo()
	{
		$traer = " SELECT * 
		FROM comercio_tipos";
		$query = $this->db->query($traer);
		return $query->result();
	}
	public function tipo1()
	{
		$traer = " SELECT * 
		FROM comercio_tipos
		Where id=1 OR id=2";
		$query = $this->db->query($traer);
		return $query->result();
	}
	public function traerCashbackpropio($id)
	{
		$traer = "SELECT id_usuario,SUM(gana_cash) AS plata
		FROM comercio_wallet 
		WHERE id_usuario=? 
		AND estado='Compra existosa'";

		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function traerCashbackporpapa($id)
	{
		$traer = "SELECT id_usuario,SUM(gana_cash_papa) AS plata
		FROM comercio_wallet 
		WHERE id_papa=? AND estado='Compra existosa'";

		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function traerCashbackporabuelo($id)
	{
		$traer = "SELECT id_usuario,SUM(gana_cash_abuelo) AS plata
		FROM comercio_wallet 
		WHERE id_abuelo=? AND estado='Compra existosa'";

		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function traerCashbackpapacomer($id)
	{
		$traer = "SELECT id_usuario,SUM(gana_papacomer) AS plata
		FROM comercio_wallet 
		WHERE id_papa_comercio=? AND estado='Compra existosa'";

		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function traercomprasreferidohijo($id)
	{
		$traer = "SELECT c2.nombre, c2.apellido1,c1.fecha_compra,c1.gana_cash_papa AS plata
		FROM comercio_wallet c1,master_usuarios c2
		WHERE c1.id_papa=? 
		AND c1.id_usuario=c2.id";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function traercomprasreferidonieto($id)
	{
		$traer = "SELECT c2.nombre, c2.apellido1,c1.fecha_compra,c1.gana_cash_abuelo AS plata
		FROM comercio_wallet c1,master_usuarios c2
		WHERE c1.id_abuelo=?
		AND c1.id_usuario=c2.id";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}

	public function traergananciaspapacomer($id)
	{
		$traer = "SELECT c2.nombre_negocio,SUM(c1.gana_papacomer) AS plata
		FROM comercio_wallet c1, master_usuarios c2
		WHERE c1.id_papa_comercio=?
		AND c1.id_comercio=c2.id";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}

	//utlizado para el paso de plata
	public function traerCompra()
	{

		$id = $this->session->userdata('ID');
		$traer = "SELECT c1.*, c2.nombre_negocio FROM comercio_ventas c1, master_usuarios c2 WHERE c1.comercio_id=c2.id AND c1.usuario_id=? AND c1.estado=0 ";
		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function traerComprapresencial()
	{

		$id = $this->session->userdata('ID');
		$traer = " SELECT c1.*,c2.nombre,c3.nombre_negocio
		FROM comercio_wallet c1,master_usuarios c2,master_usuarios c3
		WHERE c1.id_usuario=?
		AND c1.id_usuario=c2.id
		AND c1.id_comercio=c3.id
		AND c1.direccion IS NULL
		AND c1.tipo IS NULL";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function traerCompradomicilio()
	{

		$id = $this->session->userdata('ID');
		$traer = " SELECT c1.*,c2.nombre,c3.nombre_negocio
		FROM comercio_wallet c1,master_usuarios c2,master_usuarios c3
		WHERE c1.id_usuario=?
		AND c1.id_usuario=c2.id
		AND c1.id_comercio=c3.id
		AND c1.direccion IS NOT NULL";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function traerCompra_valores($id)
	{

		$id_usuario = $this->session->userdata('ID');
		$traer = " 	SELECT c1.id,c1.fecha_compra,c1.direccion,c1.valor_domicilio,c1.estado,c1.confi_user,c4.nombre,c3.nombre_negocio,c1.precio,c1.fecha_compra,c1.gana_cash,c1.gana_cash_papa, c1.gana_cash_abuelo ,c1.ganancias_comercio,c1.gana_papacomer,c1.gana_socios,c1.gana_ecomm,c1.id_usuario,c1.id_comercio
			FROM comercio_wallet c1, master_usuarios c3,master_usuarios c4
			WHERE c1.id=?
			AND c1.id_comercio=c3.id
			AND c4.id=?	
			AND c1.id_usuario=c4.id";

		$query = $this->db->query($traer, [$id, $id_usuario]);
		return $query->row();
	}
	public function traerCompra_valoresmasivo($id)
	{

		$traer = " 	SELECT c1.id,c1.fecha_compra,c1.direccion,c1.valor_domicilio,c1.estado,c1.confi_user,c4.nombre,c3.nombre_negocio,c1.precio,c1.fecha_compra,c1.gana_cash,c1.gana_cash_papa, c1.gana_cash_abuelo ,c1.ganancias_comercio,c1.gana_papacomer,c1.gana_socios,c1.gana_ecomm,c1.id_usuario,c1.id_comercio
			FROM comercio_wallet c1, master_usuarios c3,master_usuarios c4
			WHERE c1.id=?
			AND c1.id_comercio=c3.id
			AND c1.id_usuario=c4.id";

		$query = $this->db->query($traer, $id);
		return $query->row();
	}
	// todo el proceso de venta por parte del negocio
	public function detallesVenta($id)
	{
		$traer = "SELECT c1.producto ,c1.cantidad ,c1.precio FROM comercio_wallet c1, comercio_ventas c2  WHERE  c1.comercio_venta_id=c2.id AND c1.comercio_venta_id=?";
		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function traerVentasComercio()
	{
		$id = $this->session->userdata('ID');
		$traer = "SELECT c1.*,c2.nombre AS cliente,c3.nombre_negocio
		FROM comercio_wallet c1,master_usuarios c2,master_usuarios c3
		WHERE c1.id_comercio=?
		AND c1.id_usuario=c2.id
		AND c1.id_comercio=c3.id 
		AND c1.comercio_venta_id >0";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function traerVentasComerciofisica()
	{
		$id = $this->session->userdata('ID');
		$traer = "SELECT c1.*,c2.nombre AS cliente,c2.cedula,c3.nombre_negocio
		FROM comercio_wallet c1,master_usuarios c2,master_usuarios c3
		WHERE c1.id_comercio=?
		AND c1.id_usuario=c2.id
		AND c1.id_comercio=c3.id
		AND  c1.direccion IS  NULL
		AND c1.tipo IS  NULL";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function traerVentasComerciodomicilio()
	{
		$id = $this->session->userdata('ID');
		$traer = "SELECT c1.*,c2.nombre AS cliente,c3.nombre_negocio
		FROM comercio_wallet c1,master_usuarios c2,master_usuarios c3
		WHERE c1.id_comercio=?
		AND c1.id_usuario=c2.id
		AND c1.id_comercio=c3.id
		AND c1.direccion IS NOT NULL";

		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}


	public function traerVentasComercio_valores($id)
	{
		$id_comercio = $this->session->userdata('ID');
		$traer = " SELECT c1.*,c2.nombre AS cliente,c3.nombre_negocio
		FROM comercio_wallet c1,master_usuarios c2,master_usuarios c3
		WHERE c1.id=?
		AND c1.id_comercio=?
		AND c1.id_usuario=c2.id
		AND c1.id_comercio=c3.id";

		$query = $this->db->query($traer, [$id, $id_comercio]);
		return $query->row();
	}
	public function traervaloresProducto($id)
	{
		$traer = "SELECT * FROM comercio_productos
		WHERE id=?";

		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}

	public function enviarPeticion($data)
	{
		return $this->db->insert("comercio_solicitudes", $data);
	}

	/////////////////////apartado Todo de la vista principal ////////////////////////////////





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
		$traer = "SELECT c2.nombre_negocio ,c1.cuenta_COP_deuda,c2.celular
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
		$traer = "SELECT SUM(cuenta_COP) AS ganancias
	FROM master_wallet_comercio";

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
	function Modificar_parametros($datos, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('comercio_parametros', $datos);
	}

	public function socios()
	{
		$traer = "SELECT *
		FROM master_usuarios
		WHERE tipo='Socio'
		ORDER BY id";
		$query = $this->db->query($traer);
		return $query->result();
	}
	public function traerPaquetes()
	{
		$traer = 'SELECT *
	FROM comercio_marketing';

		$query = $this->db->query($traer);
		return $query->result();
	}
	public function validarBanco()
	{
		$traer = 'SELECT c1.id,c2.nombre, c2.apellido1,c1.tipo,c1.banco,c1.img,c1.estado,c1.numero
	FROM comercio_cuentas c1, master_usuarios c2
	WHERE c1.id_socio=c2.id
	AND c2.tipo="Socio"';
		$query = $this->db->query($traer);
		return $query->result();
	}
	public function validarBancocomer()
	{
		$traer = 'SELECT c1.*, c2.nombre_negocio FROM comercio_cuentas c1 ,master_usuarios c2 WHERE c1.id_socio=c2.id AND c2.tipo="Comercio"		';
		$query = $this->db->query($traer);
		return $query->result();
	}
	function respuestaBanco($datos, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('comercio_cuentas', $datos);
	}

	//// apartado para recargas
	public function metodos_pagos()
	{
		$traer = 'SELECT *
		FROM metodos_pago';
		$query = $this->db->query($traer);
		return $query->result();
	}
	public function traerHistorial_debe($id_comercio)
	{
		$traer = "SELECT c1.id, c1.id_negocio,c1.valor_recarga,c2.nombre_negocio, c3.nombre ,c1.cc_usuario,c1.fecha_pago, c1.valor,c1.img,c1.estado,c4.nombre AS tipo
		FROM comercio_recargas_historial c1, master_usuarios  c2,master_usuarios c3 ,metodos_pago c4
		WHERE c1.id_negocio=?
		AND c1.id_negocio=c2.id
		AND c1.cc_usuario=c3.cedula
		AND c1.tipo=c4.id
		ORDER BY fecha_pago ASC";
		$query = $this->db->query($traer, [$id_comercio]);
		return $query->result();
	}
	public function sum_efectivo($id)
	{
		$traer = 'SELECT SUM(valor) AS valor FROM comercio_recargas_historial WHERE tipo=1 and id_negocio=?';
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function sum_transfe($id)
	{
		$traer = 'SELECT SUM(valor)  AS valor FROM comercio_recargas_historial WHERE tipo=2 and id_negocio=?';
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	function updateimg($datos, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('comercio_cupones', $datos);
	}
	public function traer_info()
	{
		$traer = 'SELECT c1.nombre_negocio , COUNT(c2.nombre) AS cupon, c3.nombre AS nombretraer, c3.apellido1 AS apellidotraer, c3.celular AS celulartraer
		FROM comercio_cupones c2 
	   RIGHT JOIN master_usuarios c1 ON c2.id_usuario=c1.id JOIN master_usuarios c3 ON c3.id = c1.id_papa_pago GROUP BY 1 ORDER BY cupon ASC';

		$query = $this->db->query($traer);
		return $query->result();
	}
	public function tb_seguimiento()
	{
		$traer = '	SELECT c1.id_papa_pago,c2.nombre,c2.apellido1,c2.celular,c2.verificar_user,COUNT(c1.nombre_negocio) AS Cantidad ,c2.msm,c2.fecha_msm
		FROM master_usuarios c1 
		RIGHT JOIN master_usuarios c2 ON c1.id_papa_pago=c2.id WHERE c2.verificar_user="habilitado" OR c2.verificar_user="pendiente"  GROUP BY 1 ORDER BY cantidad DESC	
		';

		$query = $this->db->query($traer);
		return $query->result();
	}
	///consultas para el proceso del carrito
	public function Traercarritonego()
	{
		$id = $this->session->userdata('ID');
		$traer = "SELECT c1.*,c2.nombre,c2.apellido1 FROM comercio_ventas c1, master_usuarios c2 WHERE c1.comercio_id=? AND c1.usuario_id=c2.id";
		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function Traercarritonegopendiente()
	{
		$id = $this->session->userdata('ID');
		$traer = "SELECT c1.*,c2.nombre,c2.apellido1 FROM comercio_ventas c1, master_usuarios c2 WHERE c1.comercio_id=? AND c1.usuario_id=c2.id AND c1.estado=0 ";
		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function Traercarritouser()
	{
		$id = $this->session->userdata('ID');
		$traer = "SELECT c1.id,c1.producto, c1.cantidad,c1.precio,c2.nombre_negocio  FROM comercio_wallet c1, master_usuarios c2 
		WHERE c1.comercio_venta_id=0 AND c1.id_usuario=? AND c1.id_comercio=c2.id";
		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function listCompras()
	{
		$id = $this->session->userdata('ID');
		$traer = "SELECT * FROM comercio_ventas WHERE usuario_id=?	";
		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function dato_carrito()
	{
		$id = $this->session->userdata('ID');
		$traer = "SELECT c1.producto, c1.cantidad,c1.precio,c1.id_comercio,c2.nombre_negocio  FROM comercio_wallet c1, master_usuarios c2 WHERE c1.comercio_venta_id=0 AND c1.id_usuario=? AND c1.id_comercio=c2.id";
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function carritoTotal()
	{
		$id = $this->session->userdata('ID');
		$traer = "SELECT SUM(precio) AS total,SUM(gana_cash) AS usuario,SUM(gana_cash_papa) AS papa,SUM(gana_cash_abuelo) AS abuelo,
		SUM(ganancias_comercio) AS comercio,SUM(gana_papacomer) AS papa_comer ,SUM(gana_ecomm) AS ecomm 
		FROM comercio_wallet WHERE comercio_venta_id=0 AND id_usuario=?";
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function dataPedido($id)
	{
		$traer = "SELECT * FROM comercio_ventas WHERE id=?";
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	function updatepedido($datos, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('comercio_ventas', $datos);
	}
	function updatestatus( $id,$datos)
	{
		$this->db->where('comercio_venta_id', $id);
		$this->db->update('comercio_wallet', $datos);
	}
	////////////////
	public function traernego($ciudad)
	{
		$traer = " SELECT c1.id,c1.nombre_negocio , COUNT(c2.nombre) AS cupon FROM master_usuarios c1,comercio_cupones c2
		WHERE c2.id_usuario=c1.id 
		AND c1.ciudad=?
		GROUP BY 1";

		$query = $this->db->query($traer, $ciudad);
		return $query->result();
	}
	public function solicitudes_recarga()
	{
		$traer ="SELECT c1.id,c1.nombre_negocio,c1.celular,c2.valor,c1.auto_recar ,c1.id_cupo FROM master_usuarios c1,tb_cupo c2 
		WHERE c1.tipo='Comercio' AND c1.auto_recar=2  AND c1.id_cupo=c2.id UNION 
		SELECT c1.id,c1.nombre_negocio,c1.celular,c2.valor,c1.auto_recar,c1.id_cupo  FROM master_usuarios c1,tb_cupo c2 
		WHERE c1.tipo='Comercio' AND c1.auto_recar=1  AND c1.id_cupo=c2.id";

		$query = $this->db->query($traer);
		return $query->result();
	}
	function updaterecarga($datos, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('master_usuarios', $datos);
	}
	public function tb_cantidad()
	{
		$traer = "SELECT c3.nombre_negocio,COUNT(c2.producto) cantidad
		FROM comercio_wallet c2,master_usuarios c3
		WHERE c2.id_comercio=c3.id
		GROUP BY 1";

		$query = $this->db->query($traer);
		return $query->result();
	}
	public function datos_cupon($id)
	{
		$traer = "SELECT * FROM  comercio_cupones WHERE id=?";

		$query = $this->db->query($traer, $id);
		return $query->row();
	}
}