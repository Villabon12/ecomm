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
			$this->load->model('Model_login');

			$this->load->model('Model_comercio');

			$this->load->model('model_errorpage');

			$this->load->model('Model_ventas');

			$this->load->model('Model_recargas');

			$this->load->model('Model_solicitudes');

			$this->load->model('Model_cupones');

			$this->load->model('Model_seguros');

			$this->load->model('Model_tarjetas');
		} else {

			redirect(base_url() . "Inicio_page");
		}
	}



	public function index()
	{

		if ($this->session->userdata('is_logged_in')) {



			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Comercio') {

				


				if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'SocioAdmin') {

					$result['perfil'] = $this->Model_login->cargar_datos();

					$id = $result['perfil']->id;

					$result['cuentas'] = $this->Model_solicitudes->consultcuenta();

					$result['todo'] = $this->Model_comercio->traerTodoComercio();

					$result['c1'] = $this->Model_comercio->traerCashbackpropio($id);

					$result['c2'] = $this->Model_comercio->traerCashbackporpapa($id);

					$result['c3'] = $this->Model_comercio->traerCashbackporabuelo($id);

					$result['c4'] = $this->Model_comercio->traerCashbackpapacomer($id);

					$result['gana'] = $this->Model_comercio->traergananciaspapacomer($id);

					$result['suma'] = $this->Model_comercio->suma_cuentas_deudoras();

					$result['ganancias'] = $this->Model_comercio->suma_cuentas_negocios();

					$result['total'] = $this->Model_comercio->traerComprasTotal();

					$result['historial'] = $this->Model_comercio->traerCompra();

					$result['historial1'] = $this->Model_comercio->traercomprasreferidohijo($id);

					$result['historial2'] = $this->Model_comercio->traercomprasreferidonieto($id);

					$result['socio'] = $this->Model_comercio->socios();

					$result['ciudad'] = $this->Model_comercio->traerciudad1();

					$result['parametro'] = $this->Model_comercio->traer_parametros(14);

					$result['d1'] = $this->Model_comercio->traer_parametros(13);

					$result['d2'] = $this->Model_comercio->traer_parametros(12);

					$result['count'] = $this->Model_tarjetas->buscartarjetas();

					$result['tb_tarje'] = $this->Model_tarjetas->tb_tarjetascompra();

					$result['carritoTotal'] = $this->Model_comercio->carritoTotal();

					$result['dt'] = $this->Model_comercio->Traercarritouser();

					$result['categorias'] = $this->Model_cupones->traerCategorias();


					$this->load->view('prueba_header', $result);

					$this->load->view('wallet_inicio', $result);

					$this->load->view('prueba_footer', $result);

				} else if ($this->session->userdata('ROL') == 'Comercio') {

					$result['perfil'] = $this->Model_login->cargar_datos_comercio();
					$result['todo'] = $this->Model_comercio->traerTodoComercio();
					$result['ventas'] = $this->Model_comercio->traerVentasComercio();
					$result['cuentas'] = $this->Model_solicitudes->consultcuenta();
					$result['carrito'] = $this->Model_comercio->Traercarritonegopendiente();
					$result['categorias'] = $this->Model_cupones->traerCategorias();
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

	public function graficoBin()
	{
		$perfil = $this->Model_login->cargar_datos();

		$principald = $this->Model_login->binarioArbolDerecha($perfil->id);

		$principali = $this->Model_login->binarioArbolIzquierda($perfil->id);

		if ($perfil->id_derecha != 0) {

			$derecha = $this->Model_login->binarioArbolDerecha($principald->r_d);

			$derechai = $this->Model_login->binarioArbolIzquierda($principald->r_d);

		} else {

			$derecha = null;

			$derechai = null;

		}

		if ($perfil->id_izquierda != 0) {

			$izquierda = $this->Model_login->binarioArbolDerecha($principali->r_d);

			$izquierdad = $this->Model_login->binarioArbolIzquierda($principali->r_d);

		} else {

			$izquierda = null;

			$izquierdad = null;
		}

		$result['principal'] = $principald;

		$result['izquierdap'] = $principali;

		$result['derecha'] = $derecha;

		$result['derechai'] = $derechai;

		$result['izquierda'] = $izquierda;

		$result['izquierdad'] = $izquierdad;

		$result['perfil'] = $perfil;

		$result['carritoTotal'] = $this->Model_comercio->carritoTotal();
		$result['dt'] = $this->Model_comercio->Traercarritouser();
		$result['categorias'] = $this->Model_cupones->traerCategorias();

		$this->load->view('prueba_header', $result);
		$this->load->view('binario/binario_all', $result);
		$this->load->view('prueba_footer', $result);
	}

	public function binario()
	{

		if ($this->session->userdata('is_logged_in')) {

			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Comercio') {


				$result['categorias'] = $this->Model_cupones->traerCategorias();

				$result['perfil'] = $this->Model_login->cargar_datos();
				$id = $result['perfil']->id;

				$result['binario'] = $this->Model_comercio->binario($id);

				$result['registro'] = $this->Model_comercio->estadoRegisto($id);

				$result['carritoTotal'] = $this->Model_comercio->carritoTotal();

				$result['dt'] = $this->Model_comercio->Traercarritouser();
				$result['ciudad'] = $this->Model_comercio->traerciudad1();

				$this->load->view('prueba_header', $result);

				$this->load->view('binario/binario', $result);

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

			$insertar = array("ubica" => "izquierda", );

			$this->Model_comercio->modificarRegistro($insertar, $id);

			redirect(base_url() . "comercio/binario/" . $id);
		} else {

			$insertar = array("ubica" => "derecha", );

			$this->Model_comercio->modificarRegistro($insertar, $id);

			redirect(base_url() . "comercio/binario/" . $id);
		}
	}



	public function selectciudad()
	{
		$result['perfil'] = $this->Model_login->cargar_datos();


		$result['ciudad'] = $this->Model_login->traerDepar();


		$this->load->view('prueba_header', $result);

		$this->load->view('ciudad', $result);

		$this->load->view('prueba_footer', $result);
	}



	public function cupones()
	{

		if ($this->session->userdata('is_logged_in')) {



			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Comercio') {
				// $result['slider'] = $this->Model_cupones->slider_todo();
				// $result['tipo'] = $this->Model_comercio->tipo1();
				///

				// $cashback = $this->Model_comercio->traer_parametros(1); // % cashback papa comercio
				// $result['cashback'] = $cashback;

				// $result['e'] = $this->Model_comercio->pruebaphp($result['perfil']->ciu_co);
				// $result['carritoTotal'] = $this->Model_comercio->carritoTotal();
				// $result['dt'] = $this->Model_comercio->Traercarritouser();
				// $result['categorias'] = $this->Model_ventas->traerCategorias2($result['perfil']->ciu_co);
				// $result['comer'] = $this->Model_comercio->traernego($result['perfil']->ciu_co);
				// $result['tb_tarje'] = $this->Model_tarjetas->tb_tarjetascompra();
				// $result['count'] = $this->Model_tarjetas->buscartarjetas();

				// $result['mas_ven'] = $this->Model_cupones->mas_vendido($result['perfil']->ciu_co);
				// $result['ciudad'] = $this->Model_comercio->traerciudad1();
				///interfaz
				$result['perfil'] = $this->Model_login->cargar_datos();
				$result['e'] = $this->Model_comercio->pruebaphp($result['perfil']->ciu_co);
				$result['carritoTotal'] = $this->Model_comercio->carritoTotal();
				$result['dt'] = $this->Model_comercio->Traercarritouser();
				$result['comida'] = $this->Model_cupones->comidaint($result['perfil']->ciu_co);
				$result['moda'] = $this->Model_cupones->modaint($result['perfil']->ciu_co);
				$result['vaca'] = $this->Model_cupones->vacationint();
				$result['salud'] = $this->Model_cupones->saludint($result['perfil']->ciu_co);
				$result['electro'] = $this->Model_cupones->electroint($result['perfil']->ciu_co);
				$result['e'] = $this->Model_cupones->todito();
				$result['categorias'] = $this->Model_cupones->traerCategorias();
				$result['ciudad'] = $this->Model_comercio->traerciudad1();
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
	public function cuponescate($id)
	{
		if ($this->session->userdata('is_logged_in')) {

			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Comercio') {

				$result['perfil'] = $this->Model_login->cargar_datos();

				$result['e'] = $this->Model_comercio->cuponcategoria($id, $result['perfil']->ciu_co);

				$result['tipo'] = $this->Model_comercio->tipo1();

				$result['catego'] = $this->Model_comercio->catego($id);

				$result['categorias'] = $this->Model_cupones->traerCategorias();

				$result['ciudad'] = $this->Model_comercio->traerciudad1();

				$result['count'] = $this->Model_tarjetas->buscartarjetas();

				$result['tb_tarje'] = $this->Model_tarjetas->tb_tarjetascompra();

				$result['carritoTotal'] = $this->Model_comercio->carritoTotal();

				$result['dt'] = $this->Model_comercio->Traercarritouser();

				$this->load->view('prueba_header', $result);

				$this->load->view('cupones_nego', $result);

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
	public function cuponesciudad($id)
	{

		if ($this->session->userdata('is_logged_in')) {



			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Comercio') {


				$result['perfil'] = $this->Model_login->cargar_datos();

				$result['product'] = $this->Model_comercio->negocioexacto($id);

				$result['comer'] = $this->Model_login->datos_comercionombre($id);

				$result['tipo'] = $this->Model_comercio->tipo1();

				$result['comercio'] = $this->Model_login->datos_comercionombre($id);

				$result['categorias'] = $this->Model_ventas->traerCategorias2($result['perfil']->ciudad);

				$result['count'] = $this->Model_tarjetas->buscartarjetas();

				$result['tb_tarje'] = $this->Model_tarjetas->tb_tarjetascompra();

				$result['carritoTotal'] = $this->Model_comercio->carritoTotal();

				$result['dt'] = $this->Model_comercio->Traercarritouser();
				$result['ciudad'] = $this->Model_comercio->traerciudad1();


				$this->load->view('prueba_header', $result);

				$this->load->view('cupones_ciudad', $result);

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

				$result['cupones'] = $this->Model_comercio->traerCupones();

				$result['categorias'] = $this->Model_ventas->traerCategoriastoda();

				$result['tipo'] = $this->Model_comercio->tipo();

				$result['tb_tarjetas'] = $this->Model_tarjetas->tb_tarjetas();


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
	public function guardarCupones($id)
	{
		$atos_comercio = $this->Model_login->cargar_datos_comercio();

		if ($atos_comercio->estado == 0) {
			$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error al subir Ecommvale,te encuentras inhabilitado</div></center>');
			redirect(base_url() . "comercio/create_cupones/" . $id, "refresh");
		} else {
			$valor_nacio = $this->input->post('valor_nacio');

			if ($valor_nacio != NULL) {
				$envio_nacio = 1;
			} else {
				$envio_nacio = 0;
			}
			$mi_archivo = 'img';
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = "jpg|png|jpeg|pdf";
			$config['maintain_ratio'] = TRUE;
			$config['create_thumb'] = FALSE;
			$config['width'] = 800;
			$config['height'] = 800;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload($mi_archivo)) {
				redirect(base_url() . "comercio/create_cupones/" . $id, "refresh");
				$this->session->set_flashdata('error', ' <center><div class="alert alert-danger align-items-center d-flex" style="width: 1000px;"> Error al subir cuenta bancaria </div></center> ');
			} else {
				$data = array("upload_data" => $this->upload->data());
				$imagen = $data['upload_data']['file_name'];
				$id_categoria = $this->input->post('id_categoria');


				if ($id_categoria == 0) {
					$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error al subir Ecommvale,escoja una categoria</div></center>');
					redirect(base_url() . "comercio/create_cupones/" . $id, "refresh");
				} else {

					$arre = array(

						"id_usuario" => $id,

						"img" => $imagen,

						"nombre" => $this->input->post('nombre'),

						"stok" => $this->input->post('stok'),

						"descripcion" => $this->input->post('descripcion'),

						"precio" => $this->input->post('precio'),

						"fecha_corte" => $this->input->post('fecha_corte'),

						"descuento" => $this->input->post('descuento'),

						"valor_domicilio" => $this->input->post('valor_domicilio'),

						"hora" => $this->input->post('hora'),

						"id_tipo" => $this->input->post('id_tipo'),

						"minutos" => $this->input->post('minutos'),

						"valor_nacio" => $valor_nacio,

						"envio_nacio" => $envio_nacio,

						"id_categoria" => $id_categoria,

					);

					if ($this->Model_comercio->guardarcupon($arre)) {
						$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Ecommvale subido exitosamente</div></center>');
						redirect(base_url() . "comercio/create_cupones/" . $arre['id_usuario'], "refresh");
					} else {
						$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error al subir Ecommvale,intente de nuevo</div></center>');
						redirect(base_url() . "comercio/create_cupones/" . $arre['id_usuario'], "refresh");
					}
				}
			}
		}
	}



	public function eliminarCupon($id)
	{
		$activo = 0;

		$id_comercio = $this->input->post('id_comercio');

		$insertar = array(

			"activo" => $activo,

		);

		$this->Model_comercio->eliminarCupon($insertar, $id);
		$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Ecommvale Inhabilitado exitosamente</div></center>');
		redirect(base_url() . "comercio/create_cupones/" . $id_comercio);
	}
	public function habilitarCupon($id)
	{
		$activo = 1;

		$id_comercio = $this->input->post('id_comercio');

		$insertar = array(

			"activo" => $activo,

		);

		$this->Model_comercio->eliminarCupon($insertar, $id);
		$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Ecommvale Habilitado exitosamente</div></center>');
		redirect(base_url() . "comercio/create_cupones/" . $id_comercio);
	}


	public function modificarcupon($id)
	{
		$nombre = $this->input->post('nombre');
		$id_comercio = $this->input->post('id_comercio');
		$precio = $this->input->post('precio');
		$fecha_corte = $this->input->post('fecha_corte');
		$descuento = $this->input->post('descuento');

		$id_tipo = $this->input->post('id_tipo');
		$datos_cupon = $this->Model_comercio->traerdatoscupon($id);


		if ($descuento >= $datos_cupon->descuento) {

			$insertar = array(

				"nombre" => $nombre,

				"precio" => $precio,

				"fecha_corte" => $fecha_corte,

				"descuento" => $descuento,

				"id_tipo" => $id_tipo,
			);

			$this->Model_comercio->actualizarCupones($id, $insertar);
			$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Ecommvale Modificado exitosamente</div></center>');
			redirect(base_url() . "comercio/create_cupones/" . $id_comercio);
		} else {
			$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Porcentaje debe ser mayor o igual al acordado</div></center>');
			redirect(base_url() . "comercio/create_cupones/" . $id_comercio);
		}
	}
	public function modificarcuponfoto($id)
	{
		$id_comercio = $this->input->post('id_comercio');

		$mi_archivo = 'img';
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = "jpg|png|jpeg|pdf";
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = 800;
		$config['height'] = 800;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($mi_archivo)) {
			redirect(base_url() . "comercio/create_cupones/" . $id_comercio, "refresh");
			$this->session->set_flashdata('error', ' <center><div class="alert alert-danger align-items-center d-flex" style="width: 1000px;"> Error al subir La imagen </div></center> ');
		} else {
			$data = array("upload_data" => $this->upload->data());
			$imagen = $data['upload_data']['file_name'];


			$arre = array(
				"img" => $imagen,
			);
			if ($this->Model_comercio->actualizarCupones($id, $arre)) {
				$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Ecommvale Actualizado  exitosamente</div></center>');
				redirect(base_url() . "comercio/create_cupones/" . $id_comercio, "refresh");
			} else {
				$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error al subir Imagen,intente de nuevo</div></center>');
				redirect(base_url() . "comercio/create_cupones/" . $id_comercio, "refresh");
			}
		}
	}




	public function getProductosByCategoria()
	{
		$id = $this->input->post("id");
		$resultado = $this->Model_login->cargar_datos();
		$ciudad = $resultado->ciudad;
		$productos = $this->Model_comercio->getProductosByCategoria($id, $ciudad);
		echo json_encode($productos);
	}
	public function traernego()
	{
		$id = $this->input->post("id");
		$productos = $this->Model_comercio->buscarnego($id);
		echo json_encode($productos);
	}
	public function traerproducto()
	{
		$buscar = $this->input->post("buscar");
		$resultado = $this->Model_login->cargar_datos();
		$ciudad = $resultado->ciu_co;
		$productos = $this->Model_comercio->buscarproducto($buscar, $ciudad);
		echo json_encode($productos);
	}
	public function traerlanding()
	{
		$buscar = $this->input->post("buscar");
		$productos = $this->Model_comercio->traerproducto($buscar);
		echo json_encode($productos);
	}
	//ajax para filtros
	public function maspuntos()
	{
		$productos = $this->Model_comercio->maspuntos();
		echo json_encode($productos);
	}

	public function Menose_puntos()
	{
		$productos = $this->Model_comercio->menospuntos();
		echo json_encode($productos);
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

			$this->session->set_flashdata('error_maximo', ' <center><div class="alert alert-danger text-center d-flex"  style="width: 1000px;">Error, Valor supera al disponible </div><center>');
			redirect(base_url() . 'Comercio', 'refresh');
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



			$this->session->set_flashdata('realizado', '<center><div class="alert alert-success d-flex text-center" style="width: 1000px;">Peticion Exitosa</div><center>');

			redirect(base_url() . 'Comercio', 'refresh');
		}
	}



	public function view_peticion()
	{

		$result['perfil'] = $this->Model_login->cargar_datos();

		$result['peticiones'] = $this->Model_comercio->traerPeticion();

		$result['ciudad'] = $this->Model_comercio->traerciudad1();

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

		$metodo = $this->input->post('metodo');
		$cedula = $this->input->post('cedula');
		$valor = $this->input->post('valor');
		$tipo = $this->input->post('tipo');

		if ($metodo == 99) {
			$cedula = $this->input->post('cedula');
			$valor = $this->input->post('valor');
			$id_comercio = $this->input->post('id_comercio');

			$cupo = $this->Model_recargas->consulta_cupo();
			$res = $this->Model_login->cargar_datos_comercio($id_comercio);

			if ($res->cuenta_COP_deuda + $valor <= $cupo->valor) {
				//traer datos , negocio,tiindo, clientes
				$resultado = $this->Model_login->traerdatosCedula($cedula);
				$resulta = $this->Model_login->cargar_datos1();

				$taer_cashback = $this->Model_comercio->traer_parametros(3); // id:3 ==1
				$taer_porcentaje = $this->Model_comercio->traer_parametros(5); // id:5 =50
				$taer_minimo = $this->Model_comercio->traer_parametros(4); // id:4 ==5.000

				$id_usuario = $resultado->id;
				//operaciones
				$ganancias_general = ($valor * $taer_cashback->cashback) / 100;
				$recarga = $valor - $ganancias_general;

				$ganancias_tiindo = ($ganancias_general * $taer_porcentaje->cashback) / 100;
				$ganancias_comercio = ($ganancias_general - $ganancias_tiindo);
				$arre = array(
					"id_negocio" => $id_comercio,
					"cc_usuario" => $cedula,
					"valor" => $valor,
					"valor_recarga" => $valor,
					"tipo" => $tipo,
				);
				//se guarda la informacion
				$this->Model_comercio->guardarRegistroRecarga($arre);
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
							$Wallet_COP = $res->cuenta_COP_deuda + $valor;
							$Wallet_comision = $res->cuenta_COP + $ganancias_comercio;
							$dato = array(
								'cuenta_COP_deuda' => $Wallet_COP,
								'cuenta_COP' => $Wallet_comision,
							);
							$this->Model_comercio->actualizarwallet_comercio($id_comercio, $dato);
							$this->session->set_flashdata('realizado', '<center><div class="alert alert-success text-center" style="width: 1000px;">Recarga Exitosa</div></center>');
							redirect(base_url() . 'comercio/viewRecargas/' . $arre['id_negocio'], 'refresh');
						}
					}
				}
			} else {
				$this->session->set_flashdata('realizado', '<center><div class="alert alert-danger text-center" style="width: 1000px;">Superas el cupo disponible, Haz cruce de cuentas o Paga directamente</div></center>');
				redirect(base_url() . 'comercio/viewRecargas/' . $id_comercio, 'refresh');
			}
		} else {
			redirect(base_url() . "Recargas/proceso_recarga/$metodo/$cedula/$valor/$tipo");
		}
	}
	public function viewRecargas($id)
	{

		$result['perfil'] = $this->Model_login->cargar_datos_comercio();
		$result['historial_reca'] = $this->Model_comercio->traerHistorial_debe($id);
		$result['metodos'] = $this->Model_comercio->metodos_pagos();
		$result['efectivo'] = $this->Model_comercio->sum_efectivo($id);
		$result['transfe'] = $this->Model_comercio->sum_transfe($id);
		$result['cruce'] = $this->Model_recargas->traer_historial($id);
		$result['planes'] = $this->Model_recargas->traer_paquetes();
		$result['info'] = $this->Model_recargas->tb_cupo_soli_propio();
		$result['contar'] = $this->Model_recargas->contar_cupos();
		$result['tb_tarjetas'] = $this->Model_recargas->tb_cupo_soli_apro();

		$this->load->view('prueba_header', $result);
		$this->load->view('recargas/recargas_negocio', $result);
		$this->load->view('prueba_footer', $result);
	}

	public function historial_recargas()
	{

		$result['categorias'] = $this->Model_cupones->traerCategorias();

		$result['perfil'] = $this->Model_login->cargar_datos();

		$result['comercio'] = $this->Model_login->cargar_datos_comercio();

		$result['historial_reca'] = $this->Model_comercio->traerHistorial();

		$result['total_cuentas'] = $this->Model_comercio->traer_cuentas_deudoras();

		$result['suma'] = $this->Model_comercio->suma_cuentas_deudoras();

		$result['tb_cupos'] = $this->Model_recargas->tb_cupo_soli_admin();

		$result['recar'] = $this->Model_comercio->solicitudes_recarga();

		$result['tb_pagos'] = $this->Model_recargas->tb_pagos();

		$result['info_cupos'] = $this->Model_recargas->traer_paquetes();
		$result['ciudad'] = $this->Model_comercio->traerciudad1();

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
	public function updateciudad($id)
	{
		$ciudad = $this->input->get('ciudad');
		$arre = array(
			"ciu_co" => $ciudad,
		);
		$this->Model_login->ModificarDerecha($arre, $id);
		redirect(base_url() . 'comercio/cupones', 'refresh');
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
		$result['ciudad'] = $this->Model_comercio->traerciudad1();
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['parametros'] = $this->Model_comercio->parametros();
		$result['categorias'] = $this->Model_cupones->traerCategorias();

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
	public function compras()
	{
		$result['ciudad'] = $this->Model_comercio->traerciudad1();
		$result['perfil'] = $this->Model_login->cargar_datos();

		$this->load->view('prueba_header', $result);

		$this->load->view('ventas/compra', $result);

		$this->load->view('prueba_footer', $result);
	}

	/// cambio de imagen de producto de la 1 al 3

	public function img1($id)
	{
		$id_negocio = $this->input->post("negocio");
		$mi_archivo = 'img';
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = "jpg|png|jpeg|webp";
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = 800;
		$config['height'] = 800;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($mi_archivo)) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', '<div class="alert alert-success d-flex text-center"><label class="login__input name">Foto Actualizada</label></div>');
			redirect(base_url() . "comercio/create_cupones/" . $id_negocio);
		} else {
			$data = array("upload_data" => $this->upload->data());
			$imagen = $data['upload_data']['file_name'];
			$arre = array(
				"img" => $imagen,
			);
			if ($this->Model_comercio->updateimg($arre, $id)) {
				$this->session->set_flashdata('error', '<div class="alert alert-success d-flex text-center"><label class="login__input name">Foto Actualizada</label></div>');
				redirect(base_url() . "comercio/create_cupones/" . $id_negocio);
			} else {
				$this->session->set_flashdata('error', '<div class="alert alert-success d-flex text-center"><label class="login__input name">Foto Actualizada</label></div>');
				redirect(base_url() . "comercio/create_cupones/" . $id_negocio);
			}
		}
	}
	public function img2($id)
	{
		$id_negocio = $this->input->post("negocio");

		$mi_archivo = 'img';
		$config['upload_path'] = './assets/img';
		$config['allowed_types'] = "jpg|png|jpeg|webp";
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = 800;
		$config['height'] = 800;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($mi_archivo)) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', '<div class="alert alert-success d-flex text-center"><label class="login__input name">Foto Actualizada</label></div>');
			redirect(base_url() . "comercio/create_cupones/" . $id_negocio);
		} else {
			$data = array("upload_data" => $this->upload->data());
			$imagen = $data['upload_data']['file_name'];
			$arre = array(
				"img2" => $imagen,
			);
			if ($this->Model_comercio->updateimg($arre, $id)) {
				$this->session->set_flashdata('error', '<div class="alert alert-success d-flex text-center"><label class="login__input name">Foto Actualizada</label></div>');
				redirect(base_url() . "comercio/create_cupones/" . $id_negocio);
			} else {
				$this->session->set_flashdata('error', '<div class="alert alert-success d-flex text-center"><label class="login__input name">Foto Actualizada</label></div>');
				redirect(base_url() . "comercio/create_cupones/" . $id_negocio);
			}
		}
	}
	public function img3($id)
	{
		$id_negocio = $this->input->post("negocio");

		$mi_archivo = 'img';
		$config['upload_path'] = './assets/img';
		$config['allowed_types'] = "jpg|png|jpeg|webp";
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = 800;
		$config['height'] = 800;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($mi_archivo)) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', '<div class="alert alert-success d-flex text-center"><label class="login__input name">Foto Actualizada</label></div>');
			redirect(base_url() . "comercio/create_cupones/" . $id_negocio);
		} else {
			$data = array("upload_data" => $this->upload->data());
			$imagen = $data['upload_data']['file_name'];
			$arre = array(
				"img3" => $imagen,
			);
			if ($this->Model_comercio->updateimg($arre, $id)) {
				$this->session->set_flashdata('error', '<div class="alert alert-success d-flex text-center"><label class="login__input name">Foto Actualizada</label></div>');
				redirect(base_url() . "comercio/create_cupones/" . $id_negocio);
			} else {
				$this->session->set_flashdata('error', '<div class="alert alert-success d-flex text-center"><label class="login__input name">Foto Actualizada</label></div>');
				redirect(base_url() . "comercio/create_cupones/" . $id_negocio);
			}
		}
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