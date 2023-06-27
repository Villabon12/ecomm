<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Proceso extends CI_Controller
{

	function __construct()
	{

		parent::__construct();
		if ($this->session->userdata('is_logged_in')) {

			$this->load->model('Model_login');

			$this->load->model('Model_comercio');

			$this->load->model('model_errorpage');

			$this->load->model('Model_ventas');

			$this->load->model('Model_email');

			$this->load->model('Model_solicitudes');

			$this->load->model('Model_seguros');

			$this->load->model('Model_cupones');
		} else {

			redirect(base_url() . "");
		}
	}

	public function ventas()
	{
		$result['perfil'] = $this->Model_login->cargar_datos_comercio();
		$result['vp'] = $this->Model_comercio->traerVentasComerciofisica();
		$result['vd'] = $this->Model_comercio->traerVentasComerciodomicilio();
		$result['carrito'] = $this->Model_comercio->Traercarritonego();
		$result['categorias'] = $this->Model_cupones->traerCategorias();

		$this->load->view('prueba_header', $result);

		$this->load->view('ventas/ventas', $result);

		$this->load->view('prueba_footer', $result);
	}

	public function compras()
	{

		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['cp'] = $this->Model_comercio->traerComprapresencial();
		$result['cd'] = $this->Model_comercio->traerCompradomicilio();
		$result['contar'] = $this->Model_seguros->contar_cotizaciones();
		$result['tb'] = $this->Model_seguros->traer_cotizaciones_propia();
		$result['carrito'] = $this->Model_comercio->listCompras();
		$result['categorias'] = $this->Model_cupones->traerCategorias();
		$result['ciudad'] = $this->Model_comercio->traerciudad1();
		$this->load->view('prueba_header', $result);
		$this->load->view('ventas/compra', $result);
		$this->load->view('prueba_footer', $result);
	}




	public function Aceptarcomprafisicacomer($id)
	{
		$estado = "confirmado comercio";
		$confi_user = 1;
		$data = array(
			"confi_comer" => $confi_user,
			// "estado" => $estado,
		);
		$this->Model_ventas->Aceptarcomprafisica($id, $data);

		$result = $this->Model_ventas->validarVenta($id);

		if ($result->contar == 1) {

			$datos = $this->Model_comercio->traerVentasComercio_valores($id);
			//consulta traer datos 
			$datos_usuario = $this->Model_login->cargar_datos_cliente($datos->id_usuario);
			$datos_papa = $this->Model_login->cargar_datos_papa($datos_usuario->id_papa_pago);
			$datos_comercio = $this->Model_login->datos_comercio($datos->id_comercio);
			$datos_socios = $this->Model_login->cargar_datos_socio();


			if ($datos_usuario->cuenta_COP < 0) {
				$this->session->set_flashdata("Error", " cantidad insuficiente");
			} else if ($datos_usuario->cuenta_EPUNTOS >= 0) {
				//ganancias cliente
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
							//papa negocio
							$Wallet_COP = ($datos_papa_comercio->cuenta_EPUNTOS + $datos->gana_papacomer);
							$dato = array('cuenta_EPUNTOS' => $Wallet_COP);
							$this->Model_comercio->actualizarwallet($traer_papa_comercio->id_papa_pago, $dato);

							//envio Ganancias Socios Master
							if ($datos_socios->cuenta_COP < 0) {
							} else if ($datos_socios->cuenta_COP >= 0) {
								$Wallet_COP = ($datos_socios->cuenta_COP + $datos->gana_socios);
								$dato = array('cuenta_COP' => $Wallet_COP);
								$this->Model_comercio->actualizarwallet($datos_socios->id, $dato);

								// envio plata ecomm
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
										$this->session->set_flashdata('error2', '  <center><div class="alert alert-success text-center d-flex" style="width: 1000px;"> Venta exitosa </div><center>');
									} else {
										$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex" style="width: 1000px;"> Venta exitosa </div><center>');
									}
									redirect(base_url() . 'Proceso/ventas', 'refresh');
								}
							}
						}
					}
				}
			}
		} else {
			$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex" > Esperando validacion del cliente </div><center>');
			redirect(base_url() . 'Proceso/ventas', 'refresh');
		}
	}




	public function proceso($id)
	{
		$modalidad = $this->input->post('modalidad');
		$tarjeta = $this->input->post('tarjeta');
		$cantidad = $this->input->post('cantidad');


		$id_comercio = $this->input->post('id_comercio');
		$cantidad = $this->input->post('cantidad');
		$direccion = $this->input->post('direccion');
		$id_usuario = $this->input->post('id_usuario');
		$producto = $this->input->post('producto');
		$direccion = $this->input->post('direccion');
		$precio = $this->input->post('precio');
		$descuento = $this->input->post('descuento');
		$ciudad = $this->input->post('ciudad');

		$valor_total = $precio * $cantidad;

		$result = $this->Model_comercio->cargar_cupones($id);

		//cargar datos para ser mas rapido el proceso

		$datos_usuario = $this->Model_login->cargar_datos_cliente($id_usuario);
		$datos_papa = $this->Model_login->cargar_datos_papa($datos_usuario->id_papa_pago);

		if ($id_usuario == 10732) {
			$datos_abuelo = $this->Model_login->cargar_datos_papa($datos_usuario->id_papa_pago);
		} else {
			$datos_abuelo = $this->Model_login->cargar_datos_papa($datos_papa->id_papa_pago);
		}


		$datos_comercio = $this->Model_login->datos_comercio($id_comercio);

		if ($tarjeta == 1) {
			if ($result->stok < $cantidad) {
				$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex" > Cantidad insuficiente </div></center>');
				redirect(base_url() . 'comercio/cupones', 'refresh');
			} else if ($cantidad != 0) {
				//consultas de datos 
				$resultado = $this->Model_login->cargar_datos();

				//traer parametros cashback
				$taer_ganancias_papacomer = $this->Model_comercio->traer_parametros(6); // % cashback papa comercio
				$taer_cashback_cliente = $this->Model_comercio->traer_parametros(1); // % cashback cliente
				$taer_cashback_papa = $this->Model_comercio->traer_parametros(7); // % cashback papa cliente
				$taer_cashback_abuelo = $this->Model_comercio->traer_parametros(8); // % cashback abuelo cliente


				//sacar porcentaje final todo

				$ganancias_total = ((($valor_total * $descuento) / 100) * 100 / 100);
				$ganancias_negocio = $valor_total - $ganancias_total;
				$ganancias_cliente = ($ganancias_total * $taer_cashback_cliente->cashback) / 100;
				$ganancias_papa = ($ganancias_total * $taer_cashback_papa->cashback) / 100;
				$ganancias_abuelo = (($ganancias_total * $taer_cashback_abuelo->cashback) / 100);
				$ganancias_papa_comercio = (($ganancias_total * $taer_ganancias_papacomer->cashback) / 100);
				$ganacias_ecom = $ganancias_total - $ganancias_cliente - $ganancias_papa - $ganancias_abuelo - $ganancias_papa_comercio;
				$estado = "confirmado Usuario";
				$confi_user = 1;
				$metodo_pago = 1;

				$insertar = array(
					"id_comercio" => $id_comercio,
					"precio" => $valor_total,
					"cantidad" => $cantidad,
					"id_usuario" => $id_usuario,
					"producto" => $producto,
					"gana_cash" => $ganancias_cliente,
					"gana_cash_papa" => $ganancias_papa,
					"gana_cash_abuelo" => $ganancias_abuelo,
					"ganancias_comercio" => $ganancias_negocio,
					"gana_papacomer" => $ganancias_papa_comercio,
					"gana_ecomm" => $ganacias_ecom,
					"direccion" => $direccion,
					"id_papa" => $datos_papa->id,
					"id_abuelo" => $datos_abuelo->id,
					"id_papa_comercio" => $datos_comercio->id_papa_pago,
					"valor_domicilio" => $result->valor_domicilio,
					"confi_user" => $confi_user,
					"estado" => $estado,
					"id_metodo_pago" => $metodo_pago,
				);
				if (($direccion != NULL) & ($ciudad == NULL)) {
					if ($resultado->cuenta_COP < $valor_total) {
						$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex" > Saldo insuficiente </div></center>');
						redirect(base_url() . 'Comercio/cupones', 'refresh');
					} else {
						$stock = $this->input->post('stock');
						if ($stock != "ilimitado") {
							$stok = $result->stok - $cantidad;
							$data = array('stok' => $stok);
							$this->Model_comercio->actualizarCupones($id, $data);
						}
						//se envia el registro de la  compra 
						$this->Model_comercio->enviarVenta($insertar);
						//se le resta a la billetera
						$Wallet_COP = ($resultado->cuenta_COP - $valor_total - $result->valor_domicilio);
						$dato = array('cuenta_COP' => $Wallet_COP);
						$this->Model_comercio->actualizarwallet($id_usuario, $dato);
						$this->Model_email->notificacion_comercio($datos_comercio->correo, $datos_comercio->user);
						$this->Model_email->envio_correos_pendientes_bd();
						$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center" d-flex > Compra exitosa a domicilio, Su producto ya va en camino    </div></center>');
						redirect(base_url() . 'Comercio/cupones', 'refresh');
					}
				} else if ($direccion == NULL) {
					if ($resultado->cuenta_COP < $valor_total) {
						$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex" > Saldo insuficiente </div></center>');
						redirect(base_url() . 'Comercio/cupones', 'refresh');
					} else {
						$stock = $this->input->post('stock');
						if ($stock != "ilimitado") {
							$stok = $result->stok - $cantidad;
							$data = array('stok' => $stok);
							$this->Model_comercio->actualizarCupones($id, $data);
						}
						//se envia el registro de la  compra 
						$this->Model_comercio->enviarVenta($insertar);
						//se le resta a la billetera
						$Wallet_COP = ($resultado->cuenta_COP - $valor_total);
						$dato = array('cuenta_COP' => $Wallet_COP);
						$this->Model_comercio->actualizarwallet($id_usuario, $dato);
						$this->Model_email->notificacion_comercio($datos_comercio->correo, $datos_comercio->user);
						$this->Model_email->envio_correos_pendientes_bd();
						$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center" d-flex > Compra exitosa , Acercate a la caja y reclama tu pedido </div></center>');
						redirect(base_url() . 'Comercio/Cupones', 'refresh');
					}
				} else {
					if ($resultado->cuenta_COP < $valor_total) {
						$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex" > Saldo insuficiente </div></center>');
						redirect(base_url() . 'Comercio/cupones', 'refresh');
					} else {
						$stock = $this->input->post('stock');
						if ($stock != "ilimitado") {
							$stok = $result->stok - $cantidad;
							$data = array('stok' => $stok);
							$this->Model_comercio->actualizarCupones($id, $data);
						}
						//se envia el registro de la  compra 
						$this->Model_comercio->enviarVenta($insertar);
						//se le resta a la billetera
						$Wallet_COP = ($resultado->cuenta_COP - $valor_total - $result->valor_nacio);
						$dato = array('cuenta_COP' => $Wallet_COP);
						$this->Model_comercio->actualizarwallet($id_usuario, $dato);
						$this->Model_email->notificacion_comercio($datos_comercio->correo, $datos_comercio->user);
						$this->Model_email->envio_correos_pendientes_bd();
						$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center" d-flex > Compra exitosa envio nacional, Su producto ya va en camino  </div></center>');
						redirect(base_url() . 'Comercio/Cupones', 'refresh');
					}
				}
			}
		} else {
			redirect(base_url() . "Tarjetas/proceso/$id/$tarjeta/$cantidad");
		}

	}
	public function rechazar_pedido($id)
	{
		$estado = "Anulado ";

		$data = array(

			"estado" => $estado,
			"gana_cash" => 0,
			"gana_cash_papa" => 0,
			"gana_cash_abuelo" => 0,
			"ganancias_comercio" => 0,
			"gana_papacomer" => 0,
			"gana_socios" => 0,
			"gana_ecomm" => 0,
		);
		$this->Model_ventas->Aceptarcomprafisica($id, $data);

		$datos = $this->Model_comercio->traerVentasComercio_valores($id);
		$datos_usuario = $this->Model_login->cargar_datos_cliente($datos->id_usuario);
		if ($datos_usuario->cuenta_COP < 0) {
			$this->session->set_flashdata("Error", " Cuenta no existe");
		} else {
			//Devolver plata a cliente
			$Wallet_COP = ($datos_usuario->cuenta_COP + $datos->precio);
			$dato = array('cuenta_Cop' => $Wallet_COP);
			$this->Model_comercio->actualizarwallet($datos->id_usuario, $dato);
		}
		$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex" >Anulación del pedido realizada exitosamente  </div><center>');
		redirect(base_url() . 'Proceso/ventas', 'refresh');
	}

	public function recupera()
	{
		$id_comercio = $this->input->post('pass');

		$contra = md5($id_comercio);

		print_r($contra);
	}
	public function contra()
	{


		$this->load->view('prueba');
	}
	//proceso compra por carrito
	public function aceptaCompraNego($id)
	{
		$estado = 2;
		$data = array(
			"estado" => $estado,
		);
		$this->Model_comercio->updatepedido($data, $id);
		$confi_user = 1;
		$data = array(
			"confi_comer" => $confi_user,
			"estado" => "Compra existosa",
		);
		$this->Model_ventas->Aceptarcompracarrito($id, $data);
		$datos = $this->Model_comercio->dataPedido($id);

		//consulta traer datos
		$datos_usuario = $this->Model_login->cargar_datos_cliente($datos->usuario_id);
		$datos_papa = $this->Model_login->cargar_datos_papa($datos_usuario->id_papa_pago);
		$datos_comercio = $this->Model_login->datos_comercio($datos->comercio_id);

		if ($datos_usuario->cuenta_COP < 0) {
			$this->session->set_flashdata("Error", " cantidad insuficiente");
		} else if ($datos_usuario->cuenta_EPUNTOS >= 0) {
			//ganancias cliente
			$Wallet_COP = ($datos_usuario->cuenta_EPUNTOS + $datos->cashback_cliente);
			$dato = array('cuenta_EPUNTOS' => $Wallet_COP);
			$this->Model_comercio->actualizarwallet($datos->usuario_id, $dato);

			//envio de ganancias al papa cliente
			if ($datos_papa->cuenta_EPUNTOS < 0) {
			} else if ($datos_papa->cuenta_EPUNTOS >= 0) {
				$Wallet_COP = ($datos_papa->cuenta_EPUNTOS + $datos->cashback_papa);
				$dato = array('cuenta_EPUNTOS' => $Wallet_COP);
				$this->Model_comercio->actualizarwallet($datos_papa->id, $dato);

				//envio de ganancias al abuelo cliente
				//envio de ganancias al abuelo cliente
				if ($datos->usuario_id == 10732) {
					$datos_abuelo = $this->Model_login->cargar_datos_papa($datos_usuario->id_papa_pago);
					if ($datos_abuelo->cuenta_EPUNTOS < 0) {
					} else if ($datos_abuelo->cuenta_EPUNTOS >= 0) {
						$Wallet_COP = ($datos_abuelo->cuenta_EPUNTOS + $datos->cashback_abuelo);
						$dato = array('cuenta_EPUNTOS' => $Wallet_COP);
						$this->Model_comercio->actualizarwallet(7, $dato);
					}
				} else {
					$traer_abuelo = $this->Model_login->traerAbuelo($datos_usuario->id_papa_pago);
					$datos_abuelo = $this->Model_login->cargar_datos_abuelo($traer_abuelo->id_papa_pago);

					if ($datos_abuelo->cuenta_EPUNTOS < 0) {
					} else if ($datos_abuelo->cuenta_EPUNTOS >= 0) {
						$Wallet_COP = ($datos_abuelo->cuenta_EPUNTOS + $datos->cashback_abuelo);
						$dato = array('cuenta_EPUNTOS' => $Wallet_COP);
						$this->Model_comercio->actualizarwallet($traer_abuelo->id_papa_pago, $dato);
					}
				}

				//envio ganancias Comercio
				if ($datos_comercio->cuenta_COP < 0) {
					
				} else if ($datos_comercio->cuenta_COP >= 0) {
					$Wallet_COP = ($datos_comercio->cuenta_COP + $datos->ganancias_comercio);
					$dato = array('cuenta_COP' => $Wallet_COP);
					$this->Model_comercio->actualizarwallet_comercio($datos->comercio_id, $dato);

					//envio Ganancias papa comercio
					$traer_papa_comercio = $this->Model_login->traerPapaComercio($datos->comercio_id);
					$datos_papa_comercio = $this->Model_login->cargar_datos_papa($traer_papa_comercio->id_papa_pago);

					if ($datos_papa_comercio->cuenta_EPUNTOS < 0) {
					} else if ($datos_papa_comercio->cuenta_EPUNTOS >= 0) {
						//papa negocio
						$Wallet_COP = ($datos_papa_comercio->cuenta_EPUNTOS + $datos->cashback_papa_comercio);
						$dato = array('cuenta_EPUNTOS' => $Wallet_COP);
						$this->Model_comercio->actualizarwallet($traer_papa_comercio->id_papa_pago, $dato);

						// envio plata ecomm
						$datos_ecomm = $this->Model_login->cargar_datos1();
						if ($datos_ecomm->cuenta_COP < 0) {
						} else if ($datos_ecomm->cuenta_COP >= 0) {
							$Wallet_COP = ($datos_ecomm->cuenta_COP + $datos->ganancias_ecomm);
							$dato = array('cuenta_COP' => $Wallet_COP);
							$this->Model_comercio->actualizarwallet($datos_ecomm->id, $dato);
							$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex" style="width: 1000px;"> Venta exitosa </div><center>');
							redirect(base_url() . 'proceso/ventas', 'refresh');
						}
					}
				}
			}
		}
	}
	public function carrito_user()
	{
		$result['perfil'] = $this->Model_login->cargar_datos();

		$this->load->view('prueba_header', $result);

		$this->load->view('carrito/carrito_user', $result);

		$this->load->view('prueba_footer', $result);
	}

	public function carrito_negocio()
	{
		$result['perfil'] = $this->Model_login->cargar_datos_comercio();
		$result['carrito'] = $this->Model_comercio->Traercarritonego();

		$this->load->view('prueba_header', $result);

		$this->load->view('carrito/carrito_nego', $result);

		$this->load->view('prueba_footer', $result);
	}
	public function aggCarrito($id)
	{
		//llamar datos
		$cantidad = $this->input->post("cantidad");
		$datos_cliente = $this->Model_login->cargar_datos();
		$datos_producto = $this->Model_comercio->datos_cupon($id);
		$datos_papa = $this->Model_login->cargar_datos_papa($datos_cliente->id_papa_pago);
		$datos_comercio = $this->Model_login->datos_comercio($datos_producto->id_usuario);

		if ($datos_cliente->id == 10732) {
			$datos_abuelo = $this->Model_login->cargar_datos_papa($datos_cliente->id_papa_pago);
		} else {
			$datos_abuelo = $this->Model_login->cargar_datos_papa($datos_papa->id_papa_pago);
		}

		//traer parametros cashback
		$taer_ganancias_papacomer = $this->Model_comercio->traer_parametros(6); // % cashback papa comercio
		$taer_cashback_cliente = $this->Model_comercio->traer_parametros(1); // % cashback cliente
		$taer_cashback_papa = $this->Model_comercio->traer_parametros(7); // % cashback papa cliente
		$taer_cashback_abuelo = $this->Model_comercio->traer_parametros(8); // % cashback abuelo cliente
		$taer_cashback_sociosdire = $this->Model_comercio->traer_parametros(10); // % cashback socios directos

		//sacar porcentaje final todo
		$valor_total = $datos_producto->precio * $cantidad;
		$ganancias_total = ((($valor_total * $datos_producto->descuento) / 100) * 100 / 100);
		$ganancias_negocio = $valor_total - $ganancias_total;
		$ganancias_cliente = ($ganancias_total * $taer_cashback_cliente->cashback) / 100;
		$ganancias_papa = ($ganancias_total * $taer_cashback_papa->cashback) / 100;
		$ganancias_abuelo = (($ganancias_total * $taer_cashback_abuelo->cashback) / 100);
		$ganancias_papa_comercio = (($ganancias_total * $taer_ganancias_papacomer->cashback) / 100);
		$ganacias_ecom = $ganancias_total - $ganancias_cliente - $ganancias_papa - $ganancias_abuelo - $ganancias_papa_comercio;

		//confirmacion por parte de Cliente
		$estado = "confirmado Usuario";
		$confi_user = 1;


		// proceso interno

		if ($datos_producto->stok >= $cantidad) {
			$insertar = array(
				"comercio_venta_id" => 0,
				"id_comercio" => $datos_comercio->id,
				"precio" => $valor_total,
				"cantidad" => $cantidad,
				"id_usuario" => $datos_cliente->id,
				"producto" => $datos_producto->nombre,
				"gana_cash" => $ganancias_cliente,
				"gana_cash_papa" => $ganancias_papa,
				"gana_cash_abuelo" => $ganancias_abuelo,
				"ganancias_comercio" => $ganancias_negocio,
				"gana_papacomer" => $ganancias_papa_comercio,
				"gana_ecomm" => $ganacias_ecom,
				"id_papa" => $datos_papa->id,
				"id_abuelo" => $datos_abuelo->id,
				"id_papa_comercio" => $datos_comercio->id_papa_pago,
				"confi_user" => $confi_user,
				"estado" => $estado,
				"tipo" => 3,
			);
			//se envia el registro de la  compra 
			$this->Model_comercio->enviarVenta($insertar);
			//array para modificar stok
			$arri = array(
				'stok' => $datos_producto->stok - $cantidad
			);
			$this->Model_comercio->actualizarCupones($id, $arri);
			$this->session->set_flashdata('error', '  <center><div class="alert alert-warning  text-center" d-flex ><strong>Agregado a carrito exitosamente.</strong> </div></center>');
			redirect(base_url() . 'Comercio/Cupones', 'refresh');
		} else {
			$this->session->set_flashdata('error', '<center><div class="alert alert-danger text-center" d-flex >Cantidad insuficiente </div></center>');
			redirect(base_url() . 'Comercio/Cupones', 'refresh');
		}
	}
	public function detalles($id)
	{
		
		$result['perfil'] = $this->Model_login->cargar_datos_comercio();
		$result['dt_td'] = $this->Model_comercio->detallesVenta($id);
		$result['datos'] = $this->Model_ventas->traerPedido($id);
        $result['id'] = $id;
		$result['categorias'] = $this->Model_cupones->traerCategorias();
		$this->load->view('prueba_header', $result);

		$this->load->view('carrito/detalles', $result);

		$this->load->view('prueba_footer', $result);
	}
	public function detalles2($id)
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['dt_td'] = $this->Model_comercio->detallesVenta($id);
		$result['datos'] = $this->Model_ventas->traerPedido($id);
		$result['carritoTotal'] = $this->Model_comercio->carritoTotal();
		$result['categorias'] = $this->Model_cupones->traerCategorias();
		$result['dt'] = $this->Model_comercio->Traercarritouser();
		$result['id'] = $id;

		$this->load->view('prueba_header', $result);

		$this->load->view('carrito/detalles', $result);

		$this->load->view('prueba_footer', $result);

	}
	public function compra()
	{
		$datos_cliente = $this->Model_login->cargar_datos();
		$total_compra = $this->Model_comercio->carritoTotal();
		$comercio = $this->Model_comercio->dato_carrito();
        $codigoCompra = $this->generateRandomString(5);

		$wallet = $datos_cliente->cuenta_COP;
		if ($wallet >= $total_compra->total) {
			$arre = array(
				"usuario_id" => $datos_cliente->id,
				"comercio_id" => $comercio->id_comercio,
				"total" => $total_compra->total,
				"cashback_cliente" => $total_compra->usuario,
				"cashback_papa" => $total_compra->papa,
				"cashback_abuelo" => $total_compra->abuelo,
				"cashback_papa_comercio" => $total_compra->papa_comer,
				"ganancias_comercio" => $total_compra->comercio,
				"ganancias_ecomm" => $total_compra->ecomm,
				"estado" => 0,
				"tipo_venta" => 1,
				"codigo" => $codigoCompra,
			);
			$this->Model_ventas->insert_compra($arre);
			//designar id
			$id_venta = $this->Model_login->lastID();

			$nuevo = array(
				"comercio_venta_id" => $id_venta,
			);
			$this->Model_ventas->updateid($datos_cliente->id, $nuevo);
			
			$datosQR = $this->Model_ventas->traerVenta($id_venta);

            $datos = array(
              "id"=>$datosQR->id,
              "usuario_id"=>$datosQR->usuario_id,
              "comercio_id"=>$datosQR->comercio_id,
              "total"=>$datosQR->total,
              "cashback_cliente"=>$datosQR->cashback_cliente,
              "cashback_papa"=>$datosQR->cashback_papa,
              "cashback_abuelo"=>$datosQR->cashback_papa,
              "cashback_papa_comercio"=>$datosQR->cashback_papa_comercio,
              "ganancias_comercio"=>$datosQR->ganancias_comercio,
              "ganancias_ecomm"=>$datosQR->ganancias_ecomm,
              "estado"=>$datosQR->estado,
              "estado_domicilio"=>$datosQR->estado_domicilio,
              "tipo_venta"=>$datosQR->tipo_venta,
              "direccion"=>$datosQR->direccion,
              "recomendaciones"=>$datosQR->recomendaciones,
            );

            $json = json_encode($datos);

            //generacion codigo QR
            $qr = $this->generate_qrcode($json);
            $arro = array(
                "qr" => $qr['file'],
            );
            $this->Model_ventas->aggQR($id_venta, $arro);

			$wallet = $datos_cliente->cuenta_COP - $total_compra->total;
			$arri = array(
				"cuenta_COP" => $wallet,
			);
			$this->Model_comercio->actualizarwallet($datos_cliente->id, $arri);
			$this->session->set_flashdata('error', '<center><div class="alert alert-success text-center" d-flex >Compra exitosa </div></center>');
			redirect(base_url() . 'comercio/Cupones', 'refresh');
		} else {
			$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex" > Saldo insuficiente </div></center>');
			redirect(base_url() . 'Comercio/cupones', 'refresh');
		}

	}
	public function generaQR($id)
    {
        $datosQR = $this->Model_ventas->traerVenta($id);

        $datos = array(
            "id" => intval($datosQR->id),
            "usuario_id" => intval($datosQR->usuario_id),
            "comercio_id" => intval($datosQR->comercio_id),
            "total" => intval($datosQR->total),
            "cashback_cliente" => floatval($datosQR->cashback_cliente),
            "cashback_papa" => floatval($datosQR->cashback_papa),
            "cashback_abuelo" => floatval($datosQR->cashback_papa),
            "cashback_papa_comercio" => floatval($datosQR->cashback_papa_comercio),
            "ganancias_comercio" => floatval($datosQR->ganancias_comercio),
            "ganancias_ecomm" => floatval($datosQR->ganancias_ecomm),
            "estado" => intval($datosQR->estado),
            "estado_domicilio" => $datosQR->estado_domicilio,
            "tipo_venta" => $datosQR->tipo_venta,
            "direccion" => $datosQR->direccion,
            "recomendaciones" => $datosQR->recomendaciones,
        );

        $json = json_encode($datos);

        //generacion codigo QR
        $qr = $this->generate_qrcode($json);
        $arro = array(
            "qr" => $qr['file'],
        );
        $this->Model_ventas->aggQR($id, $arro);

        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex" > Proceso exitoso </div></center>');
        redirect(base_url() . 'Proceso/ventas', 'refresh');
    }
	public function generaQRin($id)
    {
        $datosQR = $this->Model_ventas->traerVenta($id);

        $datos = array(
            "id" => intval($datosQR->id),
            "usuario_id" => intval($datosQR->usuario_id),
            "comercio_id" => intval($datosQR->comercio_id),
            "total" => intval($datosQR->total),
            "cashback_cliente" => floatval($datosQR->cashback_cliente),
            "cashback_papa" => floatval($datosQR->cashback_papa),
            "cashback_abuelo" => floatval($datosQR->cashback_papa),
            "cashback_papa_comercio" => floatval($datosQR->cashback_papa_comercio),
            "ganancias_comercio" => floatval($datosQR->ganancias_comercio),
            "ganancias_ecomm" => floatval($datosQR->ganancias_ecomm),
            "estado" => intval($datosQR->estado),
            "estado_domicilio" => $datosQR->estado_domicilio,
            "tipo_venta" => $datosQR->tipo_venta,
            "direccion" => $datosQR->direccion,
            "recomendaciones" => $datosQR->recomendaciones,
        );

        $json = json_encode($datos);

        //generacion codigo QR
        $qr = $this->generate_qrcode($json);
        $arro = array(
            "qr" => $qr['file'],
        );
        $this->Model_ventas->aggQR($id, $arro);

        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex" > Proceso exitoso </div></center>');
        redirect(base_url() . 'Proceso/detalles/'.$id, 'refresh');
    }
    function generate_qrcode($data)
    {
        /* Load QR Code Library */
        $this->load->library('ciqrcode');

        /* Data */
        $hex_data = bin2hex($data);
        $name = $this->generateRandomString(10);
        $save_name = $name . '.png';

        /* QR Code File Directory Initialize */
        $dir = 'assets/img/QR/';
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

        /* QR Configuration  */
        $config['cacheable'] = true;
        $config['imagedir'] = $dir;
        $config['quality'] = true;
        $config['size'] = '1024';
        $config['black'] = array(255, 255, 255);
        $config['white'] = array(255, 255, 255);
        $this->ciqrcode->initialize($config);

        /* QR Data  */
        $params['data'] = $data;
        $params['level'] = 'L';
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $save_name;

        $this->ciqrcode->generate($params);

        /* Return Data */
        $return = array(
            'content' => $data,
            'file' => $dir . $save_name
        );
        return $return;
    }


    function generateRandomString($length)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
	public function deleteListado()
	{
		$id = $this->input->post("id");
		$this->Model_ventas->deleteListado($id);
		$carrito = $this->Model_comercio->Traercarritouser();
		$total= $this->Model_comercio->carritoTotal();
		$datos = array(
			"carrito" => $carrito,
			"total" => $total,
		);
		echo json_encode($datos);
	}

	    //// proceso para comprar por codigo y rechazar pedido
		public function buscarCodigo()
		{
			$codigo = $this->input->post("codigo");
			$datosComercio = $this->Model_login->cargar_datos_comercio();
			$consulta = $this->Model_ventas->consultaCodigo($datosComercio->id, $codigo);
			if ($consulta->contar == 1) {
				$datosPedido = $this->Model_ventas->traerporCodigo($datosComercio->id, $codigo);
				redirect(base_url() . 'proceso/detalles/' . $datosPedido->id, 'refresh');
			} else {
	
				$this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-danger text-center d-flex" > No se encontro coincidencias </div></center>');
				redirect(base_url() . 'comercio?Id=' . $datosComercio->id, 'refresh');
			}
		}
		public function rechazarPedido($id)
		{
			$datosPedido = $this->Model_ventas->traerPedido($id);
			$datoCliente = $this->Model_login->cargar_datos_cliente($datosPedido->usuario_id);
	
			$estado = 3;
			$data = array(
				"estado" => $estado,
			);
			$this->Model_comercio->updatepedido($data, $id);
			$data = array(
				"estado" => "Anulado",
			);
			$this->Model_ventas->Aceptarcompracarrito($id, $data);
			$Wallet = $datoCliente->cuenta_COP + $datosPedido->total;
			$dato = array('cuenta_Cop' => $Wallet);
			$this->Model_comercio->actualizarwallet($datoCliente->id, $dato);
			$this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-warning text-center d-flex" > Cancelacion de pedido exitoso </div></center>');
			redirect(base_url() . 'comercio?Id=' . $datosPedido->comercio_id, 'refresh');
		}
}