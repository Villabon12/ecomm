<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Model_login extends CI_Model

{

	//metodo contructor 
	function __construct()
	{
		parent::__construct();
	}

	public function registrar($data)

	{
		return $this->db->insert("master_usuarios", $data);
	}

	public function lastID()

	{
		return $this->db->insert_id();
	}

	public function addImg2($dato, $id)

	{
		$this->db->where('id', $id);

		$this->db->update('master_usuarios', $dato);
	}

	function ingresar_registro($insertar)
	{

		$this->db->insert('master_usuarios', $insertar);

		return $this->db->insert_id();
	}

	public function consultaUser($user, $contra)
	{
  
	  $sql = "SELECT COUNT(*) AS contar
	FROM master_usuarios WHERE (user= ? || correo = ?) AND
	contrasena = ? ;";
  
	  //$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
  
	  //$this->db->query($sql, array(3, 'live', 'Rick'));
	  $query = $this->db->query($sql, array($user, $user, $contra));
  
	  return $query->row();
	}


	public function trae_user($user = null, $pass = null)
  {

    $sql = "SELECT * FROM master_usuarios
  WHERE (user=? || correo = ?) AND contrasena= ?;";

    $query = $this->db->query($sql, array($user, $user, $pass));

    return $query->row();
  }

	//este cargar no se toca ... es con el que se hace el  login 
	public function cargar_datos()
	{

		$idUsuario = $this->session->userdata('ID');
		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP FROM master_usuarios u, master_wallet w WHERE u.id= ? AND w.id_usuario = u.id";

		$query = $this->db->query($sql, [$idUsuario]);

		return $query->row();
	}
	public function cargar_datosRegistro($id)
	{

		$sql = "SELECT id , verificar_user FROM  master_usuarios  WHERE id= ?";

		$query = $this->db->query($sql,[$id]);

		return $query->row();
	}
	public function cargar_datos_comercio()
	{
		$id_comercio = $this->session->userdata('ID');
		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP,w.cuenta_COP_deuda FROM master_usuarios u, master_wallet_comercio w WHERE u.id= ? AND w.id_usuario = u.id";

		$query = $this->db->query($sql, $id_comercio);

		return $query->row();
	}
	public function datos_comercio($id_comercio)
	{

		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP,w.cuenta_COP_deuda FROM master_usuarios u, master_wallet_comercio w WHERE u.id= ? AND w.id_usuario = u.id";

		$query = $this->db->query($sql, $id_comercio);

		return $query->row();
	}
	public function cargar_datos_cliente()
	{
		$idUsuario = $this->session->userdata('ID');
		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP FROM master_usuarios u, master_wallet w WHERE u.id= ? AND w.id = u.wallet_id";

		$query = $this->db->query($sql, [$idUsuario]);

		return $query->row();
	}
	public function cargar_datos_papa($id_papa_pago)
	{

		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP FROM master_usuarios u, master_wallet w WHERE u.id= ? AND w.id = u.wallet_id";
		$query = $this->db->query($sql, $id_papa_pago);

		return $query->row();
	}
	public function traerAbuelo($id_papa_Abuello)
	{
		$sql = "SELECT id_papa_pago
	FROM master_usuarios  
	WHERE id=?";
		$query = $this->db->query($sql, $id_papa_Abuello);
		return $query->row();
	}
	public function traerPapaComercio($id_papa_comercio)
	{
		$sql = "SELECT id_papa_pago
	FROM master_usuarios  
	WHERE id=?";
		$query = $this->db->query($sql, $id_papa_comercio);
		return $query->row();
	}

	public function cargar_datos_abuelo($traer_abuelo)
	{
		$sql = "SELECT 	 w.id as idwallet, w.cuenta_usdt, w.cuenta_COP FROM master_usuarios u, master_wallet w WHERE u.id= ? AND w.id = u.wallet_id";
		$query = $this->db->query($sql, [$traer_abuelo]);
		return $query->row();
	}

	public function traerdatosCedula($cedula)
	{
		$sql = "SELECT u.*, w.id AS idwallet, w.cuenta_usdt, w.cuenta_COP FROM master_usuarios u, master_wallet w WHERE u.cedula=? AND w.id = u.wallet_id";

		$query = $this->db->query($sql, [$cedula]);

		return $query->row();
	}
	public function traerPrueba($id)
	{
		$sql = "SELECT id,id_papa_pago, id_izquierda ,nombre,apellido1
		FROM master_usuarios
		WHERE id= ?";
		$query = $this->db->query($sql,[$id]);

		return $query->row();
	}
	public function traerPruebaDerecha($id)
	{
		$sql = "SELECT id, id_papa_pago, id_derecha ,nombre,apellido1
		FROM master_usuarios
		WHERE id= ?";
		$query = $this->db->query($sql,[$id]);

		return $query->row();
	}
	function ModificarDerecha($datos,$id){
        $this->db->where('id',$id);
        $this->db->update('master_usuarios',$datos);
    }
	public function traerDepar()
	{
		$sql = "SELECT * from municipios";
		$query = $this->db->query($sql);
		return $query->result();
	}

	//preuba escritorio}
	public function cargar_datos1()
	{
		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP FROM master_usuarios u, master_wallet w WHERE u.id= 7 AND w.id = u.wallet_id";

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function cargar_datos2()
	{
		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP,w.cuenta_COP_deuda FROM master_usuarios u, master_wallet_comercio w WHERE u.id= 10707 AND w.id_usuario = u.id";

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function cargar_datos3()
	{
		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP FROM master_usuarios u, master_wallet w WHERE u.id= 10708 AND w.id = u.wallet_id";

		$query = $this->db->query($sql);

		return $query->row();
	}
	public function cargar_datos4()
	{
		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP FROM master_usuarios u, master_wallet w WHERE u.id= 10702 AND w.id = u.wallet_id";

		$query = $this->db->query($sql);

		return $query->row();
	}
}
