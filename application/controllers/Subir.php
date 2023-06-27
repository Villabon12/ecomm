<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subir extends CI_Controller
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
		} else {

			redirect(base_url() . "");
		}
	}
	public function index()
	{
		$this->load->view('prueba');
	}
	public function Aceptarcomprafisica($id)

	{
		$estado = "confirmado Usuario";
		$confi_user = 1;
		$data = array(
			"confi_user" => $confi_user,
			"estado" => $estado,
		);
		$this->Model_ventas->Aceptarcomprafisica($id, $data);

		$result = $this->Model_ventas->validarVenta($id);

		if ($result->contar == 1) {

			$datos = $this->Model_comercio->traerCompra_valoresmasivo($id);
			//consulta traer datos 
			$datos_usuario = $this->Model_login->cargar_datos_cliente($datos->id_usuario);
			$datos_papa = $this->Model_login->cargar_datos_papa($datos_usuario->id_papa_pago);
			$datos_comercio = $this->Model_login->datos_comercio($datos->id_comercio);
			$datos_socios = $this->Model_login->cargar_datos_socio();


			//envio de cashback al cliente
			if ($datos_usuario->cuenta_COP < 0) {
				$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;">Saldo insuficiente</div></center>');
				redirect(base_url() . "comercio/cupones" . $datos_usuario->id, "refresh");
			} else if ($datos_usuario->cuenta_EPUNTOS >= 0) {
				$Wallet_COP = ($datos_usuario->cuenta_EPUNTOS + $datos->gana_cash);
				$dato = array('cuenta_EPUNTOS' => $Wallet_COP);
				$this->Model_comercio->actualizarwallet($datos->id_usuario, $dato);

				//envio de ganancias al papa cliente
				if ($datos_papa->cuenta_EPUNTOS < 0) {
				} else if ($datos_papa->cuenta_EPUNTOS >= 0) {
					$Wallet_COP = ($datos_papa->cuenta_EPUNTOS + $datos->gana_cash_papa);
					$dato = array('cuenta_EPUNTOS' => $Wallet_COP);
					$this->Model_comercio->actualizarwallet($datos_papa->id, $dato);

					//envio de ganancias al abuelo cliente
					if ($datos->id_usuario == 10732) {
						$datos_abuelo = $this->Model_login->cargar_datos_papa($datos_usuario->id_papa_pago);
						if ($datos_abuelo->cuenta_EPUNTOS < 0) {
						} else if ($datos_abuelo->cuenta_EPUNTOS >= 0) {
							$Wallet_COP = ($datos_abuelo->cuenta_EPUNTOS + $datos->gana_cash_abuelo);
							$dato = array('cuenta_EPUNTOS' => $Wallet_COP);
							$this->Model_comercio->actualizarwallet(7, $dato);
						}
					} else {
						$traer_abuelo = $this->Model_login->traerAbuelo($datos_usuario->id_papa_pago);
						$datos_abuelo = $this->Model_login->cargar_datos_abuelo($traer_abuelo->id_papa_pago);

						if ($datos_abuelo->cuenta_EPUNTOS < 0) {
						} else if ($datos_abuelo->cuenta_EPUNTOS >= 0) {
							$Wallet_COP = ($datos_abuelo->cuenta_EPUNTOS + $datos->gana_cash_abuelo);
							$dato = array('cuenta_EPUNTOS' => $Wallet_COP);
							$this->Model_comercio->actualizarwallet($traer_abuelo->id_papa_pago, $dato);
						}
					}

					//envio ganancias Comercio
					if ($datos_comercio->cuenta_COP < 0) {
					} else if ($datos_comercio->cuenta_COP >= 0) {

						if ($datos->direccion != NULL) {
							$Wallet_COP = ($datos_comercio->cuenta_COP + $datos->ganancias_comercio + $datos->valor_domicilio);
							$dato = array('cuenta_COP' => $Wallet_COP);
							$this->Model_comercio->actualizarwallet_comercio($datos->id_comercio, $dato);
						} else {
							$Wallet_COP = ($datos_comercio->cuenta_COP + $datos->ganancias_comercio);
							$dato = array('cuenta_COP' => $Wallet_COP);
							$this->Model_comercio->actualizarwallet_comercio($datos->id_comercio, $dato);
						}

						//envio Ganancias papa comercio
						$traer_papa_comercio = $this->Model_login->traerPapaComercio($datos->id_comercio);
						$datos_papa_comercio = $this->Model_login->cargar_datos_papa($traer_papa_comercio->id_papa_pago);

						if ($datos_papa_comercio->cuenta_EPUNTOS < 0) {
						} else if ($datos_papa_comercio->cuenta_EPUNTOS >= 0) {
							$Wallet_COP = ($datos_papa_comercio->cuenta_EPUNTOS + $datos->gana_papacomer);
							$dato = array('cuenta_EPUNTOS' => $Wallet_COP);
							$this->Model_comercio->actualizarwallet($traer_papa_comercio->id_papa_pago, $dato);

							//envio Ganancias Socios Master
							if ($datos_socios->cuenta_COP < 0) {
							} else if ($datos_socios->cuenta_COP >= 0) {
								$Wallet_COP = ($datos_socios->cuenta_COP + $datos->gana_socios);
								$dato = array('cuenta_COP' => $Wallet_COP);
								$this->Model_comercio->actualizarwallet($datos_socios->id, $dato);

								$datos_ecomm = $this->Model_login->cargar_datos1();
								if ($datos_ecomm->cuenta_COP < 0) {
								} else if ($datos_ecomm->cuenta_COP >= 0) {
									$Wallet_COP = ($datos_ecomm->cuenta_COP + $datos->gana_ecomm);
									$dato = array('cuenta_COP' => $Wallet_COP);
									$this->Model_comercio->actualizarwallet($datos_ecomm->id, $dato);

									$estado = "Compra existosa";
									$data = array(
										"estado" => $estado,
									);
									$this->Model_ventas->Aceptarcomprafisica($id, $data);
									if ($datos->direccion != NULL) {
										$this->session->set_flashdata('error2', '  <center><div class="alert alert-success text-center d-flex" style="width: 1000px;"> Compra exitosa </div><center>');
									} else {
										$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex" style="width: 1000px;"> Compra exitosa </div><center>');
									}
									echo"ya";
								}
							}
						}
					}
				}
			}
		} else {
			$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex" > Esperando validacion del Comercio </div><center>');
			redirect(base_url() . 'Proceso/compras', 'refresh');
		}
	}
}
