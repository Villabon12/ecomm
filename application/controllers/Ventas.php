
<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Ventas extends CI_Controller

{

	function __construct()

	{
		parent::__construct();
		if ($this->session->userdata('is_logged_in')) {
		} else {
			redirect(base_url());
		}

		$this->load->model('comercio/Model_login');
		$this->load->model('comercio/Model_comercio');
		$this->load->model('model_errorpage');
	}

	public function Ventas()
	{
		$result['perfil'] = $this->Model_login->cargar_datos();

		$this->load->view('prueba_header', $result);

		$this->load->view('ventas/seguimiento', $result);

		$this->load->view('prueba_footer', $result);
	}

	public function Compra()
	{
		echo ("holiii");
	}

	public function proceso()
	{
		$id = $this->input->post('id');
		$cantidad = 1;
		$id_comercio = $this->input->post('id_comercio');
		$id_usuario = $this->input->post('id_usuario');
		$id_producto = $this->input->post('id_producto');
		$id_papa_pago = $this->input->post('id_papa_pago');
		$direccion = $this->input->post('direccion');

		$result = $this->Model_comercio->cargar_cupones($id);
		if ($result->stok < $cantidad) {
			$this->session->set_flashdata("Error", " cantidad insuficiente");
			redirect(base_url() . 'comercio/comercio/cupones', 'refresh');
		} else if ($cantidad != 0) {

			//consultas de datos 
			$resultado = $this->Model_login->cargar_datos_cliente($id_usuario);
			//traer abuelo
			$traer_abuelo = $this->Model_login->traerAbuelo($id_papa_pago);
			//actualizar el stock
			$stock = $this->input->post('stock');

			if ($stock != "ilimitado") {
				$stok = $result->stok - $cantidad;
				$data = array('stok' => $stok);
				$this->Model_comercio->actualizarCupones($id, $data);
			}
			//traer papa comercio
			$traer_papa_comercio = $this->Model_login->traerPapaComercio($id_comercio);

			//traer parametros cashback
			$taer_porcentaje = $this->Model_comercio->traer_parametros(6);
			$taer_cashback_cliente = $this->Model_comercio->traer_parametros(1);
			$taer_cashback_papa = $this->Model_comercio->traer_parametros(7);
			$taer_cashback_abuelo = $this->Model_comercio->traer_parametros(8);



			$precio = $this->input->post('precio');
			$descuento = $this->input->post('descuento');

			$ganancias = ((($precio * $descuento) / 100) * $taer_cashback_cliente->cashback / 100);
			$ganancias_negocio = ($precio - (($precio * $descuento) / 100));
			$ganancias_papa = (((($precio * $descuento) / 100) * $taer_cashback_papa->cashback) / 100);
			$ganancias_abuelo = (((($precio * $descuento) / 100) * $taer_cashback_abuelo->cashback) / 100);


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
				"ganancias_comercio" => $ganancias_negocio,
				"direccion" => $direccion
			);

			$this->Model_comercio->enviarVenta($insertar);
			
			if ($resultado->cuenta_COP < $precio) {
				$this->session->set_flashdata("Error", " cantidad insuficiente");
				echo "saldo insuficiente";
			} else if ($resultado->cuenta_COP > $precio) {
				$Wallet_COP = ($resultado->cuenta_COP - $precio) + $ganancias;
				$dato = array('cuenta_COP' => $Wallet_COP);
				$this->Model_comercio->actualizarwallet($id_usuario, $dato);
				$this->session->set_flashdata("Realizado", " compra exitosa");
			}

			//paso plata a Usuario

			// $this->Model_comercio->enviarVenta($insertar);
			// redirect(base_url() . 'comercio/comercio/cupones', 'refresh');
		}
	}
}
