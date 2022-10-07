<?php



use LDAP\Result;



defined('BASEPATH') or exit('No direct script access allowed');



class Comercio extends CI_Controller

{
	//metodo contructor 
	function __construct()
	{

		parent::__construct();

		if ($this->session->userdata('is_logged_in')) {
		} else {

			redirect(base_url() . "");
		}
		$this->load->model('Model_login');

		$this->load->model('Model_comercio');

		$this->load->model('model_errorpage');
	}



	public function index()

	{

		if ($this->session->userdata('is_logged_in')) {



			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Comercio') {

				$id = $this->input->get('Id');

				if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'SocioAdmin') {

					$result['perfil'] = $this->Model_login->cargar_datos();

					$result['historial_referidos'] = $this->Model_comercio->traerCompraPapa($id);

					$result['abuelo'] = $this->Model_comercio->traerCompraAbuelo($id);

					$result['todo'] = $this->Model_comercio->traerTodoComercio();

					$result['devolver'] = $this->Model_comercio->traerCashback($id);

					$result['ventas'] = $this->Model_comercio->traerVentasComercio($id);

					$result['suma'] = $this->Model_comercio->suma_cuentas_deudoras();

					$result['ganancias'] = $this->Model_comercio->suma_cuentas_negocios();

					$result['total'] = $this->Model_comercio->traerComprasTotal();

					$result['historial'] = $this->Model_comercio->traerCompra($id);

					$result['socio'] = $this->Model_comercio->socios();

					$this->load->view('prueba_header', $result);

					$this->load->view('wallet_inicio', $result);

					$this->load->view('prueba_footer', $result);
				} else if ($this->session->userdata('ROL') == 'Comercio') {

					$result['perfil'] = $this->Model_login->cargar_datos_comercio();

					$result['historial_referidos'] = $this->Model_comercio->traerCompraPapa($id);

					$result['abuelo'] = $this->Model_comercio->traerCompraAbuelo($id);

					$result['todo'] = $this->Model_comercio->traerTodoComercio();

					$result['devolver'] = $this->Model_comercio->traerCashback($id);

					$result['ventas'] = $this->Model_comercio->traerVentasComercio($id);

					$result['suma'] = $this->Model_comercio->suma_cuentas_deudoras();

					$result['ganancias'] = $this->Model_comercio->suma_cuentas_negocios();

					$result['total'] = $this->Model_comercio->traerComprasTotal();

					$result['historial'] = $this->Model_comercio->traerCompra($id);

					$this->load->view('prueba_header', $result);

					$this->load->view('wallet_inicio', $result);

					$this->load->view('prueba_footer', $result);
				}
			} else {



				$intruso = array(



					'id_usuario' => $this->session->userdata('ID'),



					'texto' => 'view_socios',



					'fecha_registro' => date("Y-m-d H:i:s"),



				);

				$this->model_errorpage->insertIntruso($intruso);
				redirect("" . base_url() . "errorpage/error");
			}
		} else {



			redirect("" . base_url() . "login/");
		}
	}



	public function binario($id)

	{

		if ($this->session->userdata('is_logged_in')) {



			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Comercio') {



				$result['perfil'] = $this->Model_login->cargar_datos();

				$result['binario'] = $this->Model_comercio->binario($id);

				$result['registro'] = $this->Model_comercio->estadoRegisto($id);



				$this->load->view('prueba_header', $result);

				$this->load->view('binario', $result);

				$this->load->view('prueba_footer', $result);
			} else {



				$intruso = array(



					'id_usuario' => $this->session->userdata('ID'),



					'texto' => 'view_socios',



					'fecha_registro' => date("Y-m-d H:i:s"),

				);

				$this->model_errorpage->insertIntruso($intruso);

				redirect("" . base_url() . "errorpage/error");
			}
		} else {



			redirect("" . base_url() . "login/");
		}
	}

	public function modificarUbica($id)
	{

		$ubica = $this->input->post('ubica');

		if ($ubica == "derecha") {

			$insertar = array("ubica" => "izquierda",);

			$this->Model_comercio->modificarRegistro($insertar, $id);

			redirect(base_url() . "comercio/binario/" . $id);
		} else {

			$insertar = array("ubica" => "derecha",);

			$this->Model_comercio->modificarRegistro($insertar, $id);

			redirect(base_url() . "comercio/binario/" . $id);
		}
	}

	public function productos($id)

	{

		if ($this->session->userdata('is_logged_in')) {



			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Comercio') {





				$result['perfil'] = $this->Model_login->cargar_datos_comercio();

				$result['productos'] = $this->Model_comercio->traer_producto($id);

				$this->load->view('prueba_header', $result);

				$this->load->view('productos', $result);

				$this->load->view('prueba_footer', $result);
			} else {



				$intruso = array(



					'id_usuario' => $this->session->userdata('ID'),



					'texto' => 'view_socios',



					'fecha_registro' => date("Y-m-d H:i:s"),



				);



				$this->model_errorpage->insertIntruso($intruso);



				redirect("" . base_url() . "errorpage/error");
			}
		} else {



			redirect("" . base_url() . "login/");
		}
	}



	public function guardarProducto()

	{

		$mi_archivo = 'img';

		$config['upload_path'] = './assets/img/';

		$config['allowed_types'] = "jpg|png|jpeg";



		$this->load->library('upload', $config);



		if (!$this->upload->do_upload($mi_archivo)) {

			$error = array('error' => $this->upload->display_errors());

			echo json_encode($error);
		} else {

			$data = array("upload_data" => $this->upload->data());

			$imagen = $data['upload_data']['file_name'];

			$arre = array(

				"id_usuario" => $this->input->post('id_usuario'),

				"nombre" => $this->input->post('nombre'),

				"precio" => $this->input->post('precio'),

				"valor_domicilio" => $this->input->post('valor_domicilio'),

				"hora" => $this->input->post('hora'),

				"minutos" => $this->input->post('minutos'),

				"img" => $imagen,

			);

			if ($this->Model_comercio->guardarProducto($arre)) {

				redirect(base_url() . "comercio/productos/" . $arre['id_usuario']);
			} else {

				$this->session->set_flashdata("error", "no se pudo guardar la informacion");
			}
		}
	}



	public function eliminarProducto($id)

	{



		$activo = 0;

		$id_usuario = $this->input->post('id_usuario');

		$insertar = array(

			"activo" => $activo,

		);

		$this->Model_comercio->eliminarProducto($insertar, $id);

		redirect(base_url() . "comercio/productos/" . $id_usuario);
	}

	public function modificarProducto($id)



	{

		$id_usuario = $this->input->post('id_usuario');

		$nombre = $this->input->post('nombre');

		$precio = $this->input->post('precio');

		$insertar = array(

			"id_usuario" => $id_usuario,

			"nombre" => $nombre,

			"precio" => $precio,

		);

		$this->Model_comercio->modificarProducto($insertar, $id);

		redirect(base_url() . "productos/" . $insertar['id_usuario']);
	}



	public function cupones()

	{

		if ($this->session->userdata('is_logged_in')) {



			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Comercio') {





				$result['perfil'] = $this->Model_login->cargar_datos();

				$result['cupones'] = $this->Model_comercio->cupones_index();



				$this->load->view('prueba_header', $result);

				$this->load->view('cupones', $result);

				$this->load->view('prueba_footer', $result);
			} else {



				$intruso = array(



					'id_usuario' => $this->session->userdata('ID'),



					'texto' => 'view_socios',



					'fecha_registro' => date("Y-m-d H:i:s"),



				);



				$this->model_errorpage->insertIntruso($intruso);



				redirect("" . base_url() . "errorpage/error");
			}
		} else {



			redirect("" . base_url() . "login/");
		}
	}

	public function create_cupones($id)

	{

		if ($this->session->userdata('is_logged_in')) {



			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Comercio') {





				$result['perfil'] = $this->Model_login->cargar_datos_comercio();

				$result['productos'] = $this->Model_comercio->traer_producto($id);

				$result['cupones'] = $this->Model_comercio->traerCupones($id);

				$this->load->view('prueba_header', $result);

				$this->load->view('create_cupones', $result);

				$this->load->view('prueba_footer', $result);
			} else {



				$intruso = array(



					'id_usuario' => $this->session->userdata('ID'),



					'texto' => 'view_socios',



					'fecha_registro' => date("Y-m-d H:i:s"),



				);



				$this->model_errorpage->insertIntruso($intruso);



				redirect("" . base_url() . "errorpage/error");
			}
		} else {



			redirect("" . base_url() . "login/");
		}
	}

	public function guardarCupones()

	{



		$id_usuario = $this->input->post('id_usuario');

		$id_producto = $this->input->post('id_producto');

		$descuento = $this->input->post('descuento');

		$fecha_corte = $this->input->post('fecha_corte');

		$stock = $this->input->post('stok');



		$insertar = array(

			"id_usuario" => $id_usuario,

			"id_producto" => $id_producto,

			"descuento" => $descuento,

			"fecha_corte" => $fecha_corte,

			"stok" => $stock,

		);

		//al agregar me devuelva

		$this->Model_comercio->guardarcupon($insertar);

		redirect(base_url() . "comercio/create_cupones/" . $insertar['id_usuario']);
	}



	public function update_cupones()
	{
		$id = $this->input->post('id');
		$cantidad = 1;
		$id_comercio = $this->input->post('id_comercio');
		$id_usuario = $this->input->post('id_usuario');
		$id_producto = $this->input->post('id_producto');
		$id_papa_pago = $this->input->post('id_papa_pago');


		$result = $this->Model_comercio->cargar_cupones($id);
		if ($result->stok < $cantidad) {
			$this->session->set_flashdata("Error", " cantidad insuficiente");
			redirect(base_url() . 'comercio/comercio/cupones', 'refresh');
		} else if ($cantidad != 0) {

			//consultas de datos 
			$resultado = $this->Model_login->cargar_datos_cliente($id_usuario);
			$resulta = $this->Model_login->cargar_datos1();
			$resul = $this->Model_login->datos_comercio($id_comercio);

			//traer abuelo

			$traer_abuelo = $this->Model_login->traerAbuelo($id_papa_pago);
			$pago_abuelo = $this->Model_login->cargar_datos_abuelo($traer_abuelo->id_papa_pago);
			//actualizar el stock
			$stock = $this->input->post('stock');

			if ($stock != "ilimitado") {
				$stok = $result->stok - $cantidad;
				$data = array('stok' => $stok);
				$this->Model_comercio->actualizarCupones($id, $data);
			}
			//traer papa comercio

			//traer parametros cashback
			$taer_porcentaje = $this->Model_comercio->traer_parametros(6);
			$taer_cashback_cliente = $this->Model_comercio->traer_parametros(1);
			$taer_cashback_papa = $this->Model_comercio->traer_parametros(7);
			$taer_cashback_abuelo = $this->Model_comercio->traer_parametros(8);



			$precio = $this->input->post('precio');
			$descuento = $this->input->post('descuento');

			$ganancias = ((($precio * $descuento) / 100) * $taer_cashback_cliente->cashback / 100);
			$ganancias_tiindo = ((($precio * $descuento) / 100) * 100 / 100);
			$ganancias_negocio = ($precio - (($precio * $descuento) / 100));
			$ganancias_papa = (($ganancias_tiindo) * $taer_cashback_papa->cashback) / 100;
			$ganancias_abuelo = (((($precio * $descuento) / 100) * $taer_cashback_abuelo->cashback) / 100);
			$ganancias_papa_comercio = ((($precio * $descuento) / 100) * $taer_porcentaje->cashback / 100);
			print_r($ganancias_negocio);


			// quite el id_wallet

			$insertar = array(
				"id_comercio" => $id_comercio,
				"precio" => $precio,
				"id_usuario" => $id_usuario,
				"id_producto" => $id_producto,
				"descuento" => $descuento,
				"gana_cash" => $ganancias,
				"gana_cash_papa" => $ganancias_papa,
				"gana_cash_abuelo" => $ganancias_abuelo,
				"ganancias_comercio" => $ganancias_negocio
			);
			//paso plata a Usuario

		}
	}

	public function peticion()

	{

		$id_comercio = $this->input->post('id_comercio');

		$valor = $this->input->post('valor');

		$cuenta_COP = $this->input->post('cuenta_COP');

		$nota = $this->input->post('nota');

		$minimo = $this->Model_comercio->traer_parametros(9);

		$resultado = $this->Model_login->cargar_datos_comercio($id_comercio);



		if ($resultado->cuenta_COP < $valor || 0 == $valor || $minimo->cashback > $valor) {

			$this->session->set_flashdata('error_maximo', ' <center><div class="alert alert-danger text-center" style="width: 1000px;">Error, Valor supera al disponible </div><center>');

			redirect(base_url() . 'index', 'refresh');
		} else if ($resultado->cuenta_COP > $valor) {

			$Wallet_COP = $cuenta_COP - $valor;

			$dato = array(

				'cuenta_COP' => $Wallet_COP

			);

			$insertar = array(

				"id_comercio" => $id_comercio,

				"valor" => $valor,

				"nota" => $nota,

			);

			$this->Model_comercio->actualizarwallet_comercio($id_comercio, $dato);

			$this->Model_comercio->enviarPeticion($insertar);



			$this->session->set_flashdata('realizado', '<center><div class="alert alert-danger text-center" style="width: 1000px;">Peticion Exitosa</div><center>');

			redirect(base_url() . 'comercio/index', 'refresh');
		}
	}



	public function view_peticion()

	{

		$result['perfil'] = $this->Model_login->cargar_datos();

		$result['peticiones'] = $this->Model_comercio->traerPeticion();



		$this->load->view('prueba_header', $result);

		$this->load->view('peticiones/view_peticiones', $result);

		$this->load->view('prueba_footer', $result);
	}

	public function peticionComercio($id)

	{

		$result['perfil'] = $this->Model_login->cargar_datos_comercio();

		$result['peticion_comercio'] = $this->Model_comercio->traer_peticion_comercio($id);

		$this->load->view('prueba_header', $result);

		$this->load->view('peticiones/peticiones_comercio', $result);

		$this->load->view('prueba_footer', $result);
	}


	public function rechazarPeticion()
	{
		$id_comercio = $this->input->post('id_comercio');
		$valor = $this->input->post('valor');
		$resultado = $this->Model_login->datos_comercio($id_comercio);
		$id = $this->input->post('id');
		$Wallet_COP = $resultado->cuenta_COP + $valor;
		$icono = "bi bi-x-octagon-fill";
		$msm = "peticion rechazada, ";
		$estado = $this->input->post('estado');
		$activo = $this->input->post('activo');
		$msm_final = "$msm  $estado";
		$dato = array(
			'cuenta_COP' => $Wallet_COP,
		);
		$data = array(
			'icono' => $icono,
			'estado' => $msm_final,
			'activo' => $activo
		);
		$this->Model_comercio->actualizarwallet_comercio($id_comercio, $dato);
		$this->Model_comercio->actualizar_peticion($id, $data);

		$this->session->set_flashdata('realizado', '<div class="alert alert-danger text-center" style="width: 100px;">Peticion Exitosa</div>');
		redirect(base_url() . 'comercio/view_peticion', 'refresh');
	}
	public function aprobarPeticion($id)

	{

		$mi_archivo = 'img';

		$config['upload_path'] = './assets/img/';

		$config['allowed_types'] = "jpg|png|jpeg";



		$this->load->library('upload', $config);



		if (!$this->upload->do_upload($mi_archivo)) {

			$error = array('error' => $this->upload->display_errors());

			echo json_encode($error);
		} else {

			$data = array("upload_data" => $this->upload->data());

			$imagen = $data['upload_data']['file_name'];

			$activo = $this->input->post('activo');

			$icono = "bi bi-check-square-fill";

			$estado = "peticion exitosa , revis tu cuenta bancaria";



			$arre = array(

				"activo" => $activo,

				"estado" => $estado,

				"icono" => $icono,

				"img" => $imagen,

			);

			if ($this->Model_comercio->actualizar_peticion($id, $arre)) {

				$this->session->set_flashdata('realizado', '<div class="alert alert-danger text-center" style="width: 100px;">Peticion Exitosa</div>');

				redirect(base_url() . 'comercio/view_peticion', 'refresh');
			} else {

				$this->session->set_flashdata("error", "no se pudo guardar la informacion");
			}
		}
	}

	public function puntoRecarga()
	{
		//todos los input
		$cedula = $this->input->post('cedula');
		$valor = $this->input->post('valor');
		$id_comercio = $this->input->post('id_comercio');

		//traer datos , negocio,tiindo, clientes
		$resultado = $this->Model_login->traerdatosCedula($cedula);
		$resulta = $this->Model_login->cargar_datos1();
		$res = $this->Model_login->cargar_datos_comercio($id_comercio);
		$taer_cashback = $this->Model_comercio->traer_parametros(3); // id:3 ==1
		$taer_porcentaje = $this->Model_comercio->traer_parametros(5); // id:5 =50
		$taer_minimo = $this->Model_comercio->traer_parametros(4); // id:4 ==5.000

		$id_usuario = $resultado->id;
		//operaciones
		$ganancias_general = ($valor * $taer_cashback->cashback) / 100;
		$recarga = $valor - $ganancias_general;

		$ganancias_tiindo = ($ganancias_general * $taer_porcentaje->cashback) / 100;
		$ganancias_comercio = ($ganancias_general - $ganancias_tiindo);
		$debe_negocio = $recarga + $ganancias_tiindo;
		$arre = array(
			"id_negocio" => $id_comercio,
			"cc_usuario" => $cedula,
			"valor" => $debe_negocio,
		);
		//usuario
		if ($valor < $taer_minimo->cashback) {
			$this->session->set_flashdata('error', '<center><div class="alert alert-danger text-center" style="width: 1000px;">Error, recarga anulada</div></center>');
			redirect(base_url() . 'comercio/viewRecargas/' . $arre['id_negocio'], 'refresh');
		} else {

			//cliente

			if ($resultado->cuenta_COP < 0) {
				$this->session->set_flashdata('error_maximo', '<div class="alert alert-danger text-center" style="width: 1000px;">Error al solicitar retiro</div>');
			} else if ($resultado->cuenta_COP >= 0) {

				$Wallet_COP = ($resultado->cuenta_COP + $recarga);

				$dato = array('cuenta_COP' => $Wallet_COP);
				$this->Model_comercio->actualizarwallet($id_usuario, $dato);
				$this->session->set_flashdata("Realizado", " compra exitosa");

				//tiindo
				if ($resulta->cuenta_COP < 0) {
					$this->session->set_flashdata('error_maximo', '<div class="alert alert-danger text-center" style="width: 1000px;">Error al solicitar retiro</div>');
				} else if ($resulta->cuenta_COP >= 0) {

					$Wallet_COP = ($resulta->cuenta_COP + $ganancias_tiindo);

					$dato = array('cuenta_COP' => $Wallet_COP);
					$this->Model_comercio->actualizarwallet(7, $dato);
					$this->session->set_flashdata("Realizado", " compra exitosa");
				}
				//comercio
				if ($res->cuenta_COP_deuda < 0) {
					$this->session->set_flashdata('error_maximo', '<div class="alert alert-danger text-center" style="width: 1000px;">Error al solicitar retiro</div>');
				} else if ($res->cuenta_COP_deuda >= 0) {
					$Wallet_COP = $res->cuenta_COP_deuda + $debe_negocio;
					$dato = array(
						'cuenta_COP_deuda' => $Wallet_COP
					);
					$this->Model_comercio->guardarRegistroRecarga($arre);
					$this->Model_comercio->actualizarwallet_comercio($id_comercio, $dato);
					$this->session->set_flashdata('realizado', '<center><div class="alert alert-danger text-center" style="width: 1000px;">Recarga Exitosa</div></center>');
					redirect(base_url() . 'comercio/viewRecargas/' . $arre['id_negocio'], 'refresh');
				}
			}
		}
	}

	public function viewRecargas($id)

	{

		$result['perfil'] = $this->Model_login->cargar_datos_comercio();
		$result['historial_reca'] = $this->Model_comercio->traerHistorial_debe($id);

		$this->load->view('prueba_header', $result);
		$this->load->view('recargas/recargas_negocio', $result);
		$this->load->view('prueba_footer', $result);
	}

	public function historial_recargas()

	{

		$result['perfil'] = $this->Model_login->cargar_datos();

		$result['comercio'] = $this->Model_login->cargar_datos_comercio();

		$result['historial_reca'] = $this->Model_comercio->traerHistorial();

		$result['total_cuentas'] = $this->Model_comercio->traer_cuentas_deudoras();

		$result['suma'] = $this->Model_comercio->suma_cuentas_deudoras();

		$this->load->view('prueba_header', $result);

		$this->load->view('recargas/view_recargas', $result);

		$this->load->view('prueba_footer', $result);
	}

	public function cruce_cuentas($id)

	{

		$mi_archivo = 'img';

		$config['upload_path'] = './assets/img/';

		$config['allowed_types'] = "jpg|png|jpeg";


		$this->load->library('upload', $config);



		if (!$this->upload->do_upload($mi_archivo)) {

			$error = array('error' => $this->upload->display_errors());

			echo json_encode($error);
		} else {

			$data = array("upload_data" => $this->upload->data());

			$imagen = $data['upload_data']['file_name'];

			$estado = "pendiente_confirmacion";

			$id_negocio = $this->input->post('negocio');

			$valor = $this->input->post('valor');

			$res = $this->Model_login->cargar_datos_comercio($id_negocio);



			$Wallet_COP = $res->cuenta_COP_deuda - $valor;

			$dato = array(
				'cuenta_COP_deuda' => $Wallet_COP
			);

			$this->Model_comercio->actualizarwallet_comercio($id_negocio, $dato);

			$arre = array(
				"estado" => $estado,
				"img" => $imagen,
			);

			if ($this->Model_comercio->actualizar_historial($id, $arre)) {

				redirect(base_url() . 'comercio/viewRecargas/' . $id_negocio, 'refresh');
			} else {

				$this->session->set_flashdata("error", "no se pudo guardar la informacion");
			}
		}
	}

	public function aceptarPago($id)

	{
		$resulta = $this->Model_login->cargar_datos1();

		$id_negocio = $this->input->post('id_negocio');

		$res = $this->Model_login->datos_comercio($id_negocio);

		$estado = "Aprobado";

		$valor = $this->input->post('valor');

		$data = array(

			"estado" => $estado,

		);



		$this->Model_comercio->actualizar_historial($id, $data);



		if ($resulta->cuenta_COP < 0) {

			$this->session->set_flashdata('error_maximo', '<div class="alert alert-danger text-center" style="width: 1000px;">Error al solicitar retiro</div>');
		} else if ($resulta->cuenta_COP >= 0) {



			$Wallet_COP = ($resulta->cuenta_COP + $valor);



			$dato = array('cuenta_COP' => $Wallet_COP);

			$this->Model_comercio->actualizarwallet(7, $dato);


			if ($res->cuenta_COP_deuda < 0) {

				$this->session->set_flashdata('error_maximo', '<div class="alert alert-danger text-center" style="width: 1000px;">Error al solicitar retiro</div>');
			} else if ($res->cuenta_COP >= 0) {

				$Wallet_COP = ($res->cuenta_COP_deuda - $valor);
				$date = array('cuenta_COP_deuda' => $Wallet_COP);
				$this->Model_comercio->actualizarwallet_comercio($id_negocio, $date);

				redirect(base_url() . 'comercio/historial_recargas/', 'refresh');
			}
		}
	}



	// public function NegarPago($id)

	// {

	// 	$estado = "Negado";

	// 	$data = array(

	// 		"estado" => $estado,

	// 	);

	// 	$this->Model_comercio->actualizar_historial($id, $data);

	// 	redirect(base_url() . 'comerciohistorial_recargas/' , 'refresh');



	// }

	// prueba escritorio

	public function traer_usuario()

	{

		$cedula = $this->input->post('cedula');



		$resultado = $this->Model_comercio->traerCedula($cedula);

		echo $resultado->nombre . " " . $resultado->apellido1;
	}

	public function config_parametros()
	{

		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['parametros'] = $this->Model_comercio->parametros();
		$this->load->view('prueba_header', $result);
		$this->load->view('parametros', $result);
		$this->load->view('prueba_footer', $result);
	}
	public function Modificar_parametros($id)
	{

		$cashback = $this->input->post('cashback');
		$insertar = array(
			"cashback" => $cashback,
		);
		$this->Model_comercio->Modificar_parametros($insertar, $id);
		redirect(base_url() . 'comercio/config_parametros', 'refresh');
	}
	
	public function verificar_user()
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['validacion'] = $this->Model_comercio->validacion();
		$this->load->view('prueba_header', $result);
		$this->load->view('validacion/validar', $result);
		$this->load->view('prueba_footer', $result);
	}
	public function habilitarUser($id)
	{
		$verificar_user = "habilitado";
		$data = array(
			'verificar_user' => $verificar_user,
		);
		$this->Model_comercio->aceptarvalidacion($data, $id);
		redirect(base_url() . 'comercio/verificar_user', 'refresh');
	}

	public function escritorio()

	{

		$result['perfil'] = $this->Model_login->cargar_datos_cliente();

		$result['perfil1'] = $this->Model_login->cargar_datos1();

		$result['perfil2'] = $this->Model_login->cargar_datos2();

		$result['perfil3'] = $this->Model_login->cargar_datos3();

		$result['perfil4'] = $this->Model_login->cargar_datos4();

		$result['peticiones'] = $this->Model_comercio->traerPeticion();

		$result['peticion_comercio'] = $this->Model_comercio->traer_peticion_comercio(10707);

		$result['historial_reca'] = $this->Model_comercio->traerHistorial();

		$result['historial_reca'] = $this->Model_comercio->traerHistorial_debe(10707);

		$this->load->view('prueba_header', $result);

		$this->load->view('ventas/modal_ventas', $result);

		$this->load->view('prueba_footer', $result);
	}
}
