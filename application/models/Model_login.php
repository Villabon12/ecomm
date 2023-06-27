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

	public function updPerfil($dato, $id)
	{
  
	  $this->db->where('id', $id);
  
	  $this->db->update('master_usuarios', $dato);
	  return 1;
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



	public function consultaregistro($user,$cedula,$correo)

	{

  

	  $sql = "SELECT COUNT(*) AS contar

	FROM master_usuarios WHERE (user=? ||cedula= ? ||correo=?) ;";

	  //$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";

	  //$this->db->query($sql, array(3, 'live', 'Rick'));

	  $query = $this->db->query($sql, array($user, $cedula,$correo));

  

	  return $query->row();

	}

	public function validarcontra($id,$contra_ori)
	{
  
	  $sql = "SELECT COUNT(*) AS contar
	FROM master_usuarios WHERE id=? AND contrasena=? ;";
	  //$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
	  //$this->db->query($sql, array(3, 'live', 'Rick'));
	  $query = $this->db->query($sql, array($id, $contra_ori));

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

		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP,w.cuenta_EPUNTOS FROM master_usuarios u, master_wallet w WHERE u.id= ? AND w.id_usuario = u.id";



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

		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP,w.cuenta_COP_deuda, w.cuenta_comision FROM master_usuarios u, master_wallet_comercio w WHERE u.id= ? AND w.id_usuario = u.id";



		$query = $this->db->query($sql, $id_comercio);



		return $query->row();

	}



	//utilizado para proceso de paso de plata (compra)


	public function datos_comercionombre($id)

	{
		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP,w.cuenta_COP_deuda ,w.cuenta_comision FROM master_usuarios u, master_wallet_comercio w WHERE u.id= ? AND w.id_usuario = u.id";
		$query = $this->db->query($sql, $id);
		return $query->row();
	}


	public function datos_comercio($id_comercio)

	{
		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP,w.cuenta_COP_deuda FROM master_usuarios u, master_wallet_comercio w WHERE u.id= ? AND w.id_usuario = u.id";
		$query = $this->db->query($sql, $id_comercio);
		return $query->row();
	}

	public function cargar_datos_cliente($id_usuario)

	{

		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP,w.cuenta_EPUNTOS FROM master_usuarios u, master_wallet w WHERE u.id= ? AND w.id = u.wallet_id";

		$query = $this->db->query($sql,$id_usuario);

		return $query->row();

	}

	public function cargarperfil($id)

	{

		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP FROM master_usuarios u, master_wallet w WHERE u.id= ? AND w.id = u.wallet_id";



		$query = $this->db->query($sql, [$id]);



		return $query->row();

	}

	//datos para el paso de plata



	public function cargar_datos_papa($id_papa_pago)

	{



		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP,w.cuenta_EPUNTOS FROM master_usuarios u, master_wallet w WHERE u.id= ? AND w.id = u.wallet_id";

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

		$sql = "SELECT  w.id as idwallet, w.cuenta_usdt, w.cuenta_COP,w.cuenta_EPUNTOS FROM master_usuarios u, master_wallet w WHERE u.id= ? AND w.id = u.wallet_id";

		$query = $this->db->query($sql, [$traer_abuelo]);

		return $query->row();

	}

	public function cargar_datos_socio()

	{

		$sql = "SELECT u.*, w.id as idwallet, w.cuenta_usdt, w.cuenta_COP FROM master_usuarios u, master_wallet w WHERE u.id= 10934 AND w.id = u.wallet_id";

		$query = $this->db->query($sql);

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

	public function actualizarPerfil($datos,$id)

	{

		$this->db->where('id',$id);

        $this->db->update('master_usuarios',$datos);

		

	}

	public function actualizarfoto($datos,$id)

	{

		$this->db->where('id',$id);

        $this->db->update('master_usuarios',$datos);



		return 1;

	}

	public function traerTipoPago()

	{

		$sql = "SELECT *

	FROM tipo_pago ";

		$query = $this->db->query($sql );

		return $query->result();

	}

	public function traerBancos()

	{

		$sql = "SELECT *

	FROM comercio_bancos ";

		$query = $this->db->query($sql );

		return $query->result();

	}

	function subirCuenta($insertar)

	{

		$this->db->insert('comercio_cuentas', $insertar);

		return $this->db->insert_id();

	}

	public function traerCuentas($id)



	{

		$traer = " SELECT * 

		FROM comercio_cuentas

		where id_socio= ?";

		$query = $this->db->query($traer, [$id]);

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
	///codigo arbol binario
	public function binarioArbolDerecha($id)

	{
  
	  $sql = "SELECT r1.id AS id_p, r1.nombre AS nombre_p, r1.apellido1 AS apellido_p, r1.img_perfil AS img_p, 
  
	  r2.id AS r_d, r2.nombre AS nombre_d, r2.apellido1 AS apellido_d, r2.img_perfil AS img_d 
  
	  FROM master_usuarios r1, master_usuarios r2 WHERE r1.id = ? AND r1.id_derecha = r2.id ";
  
  
  
	  $query = $this->db->query($sql, [$id]);
  
  
  
	  return $query->row();
  
	}
  
  
  
	public function binarioArbolIzquierda($id)
  
	{
  
	  $sql = "SELECT r1.id AS id_p, r1.nombre AS nombre_p, r1.apellido1 AS apellido_p, r1.img_perfil AS img_p, 
  
	  r2.id AS r_d, r2.nombre AS nombre_d, r2.apellido1 AS apellido_d, r2.img_perfil AS img_d 
  
	  FROM master_usuarios r1, master_usuarios r2 WHERE r1.id = ? AND r1.id_izquierda = r2.id ";
  
  
  
	  $query = $this->db->query($sql, [$id]);
  
  
  
	  return $query->row();
  
	}

	public function encuenta($data)
	{
		return $this->db->insert("result_comentarios", $data);
	}

	public function Perfil_2($id){

		$this->db->where('id',$id);
		$resultado = $this->db->get('master_usuarios');

		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		}else {
			return FALSE;
		}
		
	}
}