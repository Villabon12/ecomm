<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarjetas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_logged_in')) {

            $this->load->model('Model_login');
            $this->load->model('Model_comercio');
            $this->load->model('model_errorpage');
            $this->load->model('Model_tarjetas');
            $this->load->model('Model_cupones');
        } else {
            redirect(base_url() . "");
        }
    }
    public function insertTarje($id)
    {
        $nombre = $this->input->post("nombre");
        $cupo = $this->input->post("cupo");
        $cantidad = $this->input->post("cantidad");
        $porcentaje = $this->input->post("porcentaje");
        $fecha = $this->input->post("fecha");
        $aare = array(
            "id_comercio" => $id,
            "nombre" => $nombre,
            "valor" => $cupo,
            "descuento" => $porcentaje,
            "cantidad" => $cantidad,
            "fecha_corte" => $fecha,
        );
        $this->Model_tarjetas->insertdata($aare);
        $this->session->set_flashdata('error', ' <center><div class="alert alert-success text-center d-flex" > Tarjeta creada exitosamente </div></center>');
        redirect(base_url() . 'Tarjetas/view_negocio', 'refresh');
    }
    public function compra_tarjeta($id)
    {
        $datos_cliente = $this->Model_login->cargar_datos();
        $datos_tarjeta = $this->Model_tarjetas->cargar_datos_tarjeta($id);
        $are = array(
            "id_usuario" => $datos_cliente->id,
            "id_tarjeta" => $id,
            "cupo" => $datos_tarjeta->valor,
        );
        $this->Model_tarjetas->insertventa($are);
        $cantidad = $datos_tarjeta->cantidad - 1;
        $arre = array(
            "cantidad" => $cantidad,
        );
        $this->Model_tarjetas->update_tarjeta($id, $arre);
        $this->session->set_flashdata('error', ' <center><div class="alert alert-success text-center d-flex" > Peticion exitosa </div></center>');
        redirect(base_url() . 'Tarjetas/view_tarjetas/', 'refresh');
    }
    public function Valida_tarjeta($id)
    {
        $mi_archivo = 'img';
        $config['upload_path'] = './assets/img/certificadosBanco/';
        $config['allowed_types'] = "jpg|png|jpeg";
        $config['maintain_ratio'] = TRUE;
        $config['create_thumb'] = FALSE;
        $config['width'] = 800;
        $config['height'] = 800;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error al subir certificado </div></center>');
            redirect(base_url() . "Tarjetas/view_negocio", "refresh");
        } else {



            //traer datos
            $datos_tarjeta = $this->Model_tarjetas->cargar_datos_tarjeta_vendi($id);
            $datos_cliente = $this->Model_login->cargar_datos_cliente($datos_tarjeta->id_usuario);
            $datos_ecomm = $this->Model_login->cargar_datos_cliente(7);
            $datos_comercio = $this->Model_login->datos_comercio($datos_tarjeta->id_comercio);
            //parametros
            $taer_cashback = $this->Model_comercio->traer_parametros(3); // id:3 ==1
            $taer_porcentaje = $this->Model_comercio->traer_parametros(5); // id:5 =50
            //operaciones
            $porcentaje_ecomm = ($datos_tarjeta->cupo * $taer_cashback->cashback / 100);
            $valor_recarga = $datos_tarjeta->cupo - $porcentaje_ecomm;
            $ganancia_ecomm = ($porcentaje_ecomm * $taer_porcentaje->cashback / 100);
            $ganancia_negocio = $porcentaje_ecomm - $ganancia_ecomm;

            $data = array("upload_data" => $this->upload->data());
            $imagen = $data['upload_data']['file_name'];
            $arre = array(
                "img" => $imagen,
                "estado" => 1,
                "valida" => 1,
                "cupo" => $valor_recarga,
            );
            $this->Model_tarjetas->update_tarjeta_vendi($id, $arre);
            //paso plata Comercio
            $wallet2 = $datos_comercio->cuenta_COP + $ganancia_negocio;
            $arre2 = array("cuenta_COP" => $wallet2);
            $this->Model_comercio->actualizarwallet_comercio($datos_comercio->id, $arre2);
            //paso plata ecomm
            $wallet3 = $datos_ecomm->cuenta_COP + $ganancia_ecomm;
            $arre3 = array("cuenta_COP" => $wallet3);
            $this->Model_comercio->actualizarwallet(7, $arre3);

            $this->session->set_flashdata('error', '<center><div class="alert alert-success text-center d-flex" style="width: 1000px;"> Proceso exitoso </div></center>');
            redirect(base_url() . "Tarjetas/view_negocio", "refresh");
        }
    }
    public function view_tarjetas()

    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'SocioAdmin') {
				$result['categorias'] = $this->Model_cupones->traerCategorias();
                $result['perfil'] = $this->Model_login->cargar_datos();
                $result['tb_tarjetas'] = $this->Model_tarjetas->traer_tarjetas();
				$result['ciudad'] = $this->Model_comercio->traerciudad1();
                $this->load->view('prueba_header', $result);

                $this->load->view('Tarjetas/principal', $result);

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
    public function view_negocio()

    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Comercio') {

                $result['perfil'] = $this->Model_login->cargar_datos_comercio();
                $result['tb_vendi'] = $this->Model_tarjetas->tb_tarjetasvendi();
                $result['tb'] = $this->Model_tarjetas->tb_tarjetas();
                $this->load->view('prueba_header', $result);

                $this->load->view('Tarjetas/view_negocios', $result);

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
    public function view_detalles($id)

    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Comercio') {

                $result['perfil'] = $this->Model_login->cargar_datos_comercio();
                $result['tb_vendi'] = $this->Model_tarjetas->tb_tarjetasvendi();

                $this->load->view('prueba_header', $result);

                $this->load->view('Tarjetas/detalles', $result);

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
    public function  proceso($id, $tarjeta, $cantidad)
    {
        //llamar datos
        $datos_cliente = $this->Model_login->cargar_datos();
        $datos_producto = $this->Model_comercio->datos_cupon($id);
        $datos_tarjeta = $this->Model_tarjetas->cargar_datos_tarjeta_vendi($tarjeta);
        $datos_papa = $this->Model_login->cargar_datos_papa($datos_cliente->id_papa_pago);
        $datos_comercio = $this->Model_login->datos_comercio($datos_producto->id_usuario);
        if ($datos_cliente->id == 10732) {
            $datos_abuelo = $this->Model_login->cargar_datos_papa($datos_cliente->id_papa_pago);
        } else {
            $datos_abuelo = $this->Model_login->cargar_datos_papa($datos_papa->id_papa_pago);
        }
        //traer parametros 
        $taer_ganancias_papacomer = $this->Model_comercio->traer_parametros(6);       // % cashback papa comercio
        $taer_cashback_cliente = $this->Model_comercio->traer_parametros(1); // % cashback cliente
        $taer_cashback_papa = $this->Model_comercio->traer_parametros(7);     // % cashback papa cliente
        $taer_cashback_abuelo = $this->Model_comercio->traer_parametros(8);  // % cashback abuelo cliente
        $taer_cashback_sociosdire = $this->Model_comercio->traer_parametros(10); // % cashback socios directos

        //sacar porcentaje final todo
        $valor_total_compra = $datos_producto->precio * $cantidad;
        $ganancias_total = ((($valor_total_compra * $datos_tarjeta->descuento) / 100) * 100 / 100);
        $ganancias_negocio = $valor_total_compra - $ganancias_total;
        $ganancias_cliente = ($ganancias_total * $taer_cashback_cliente->cashback) / 100;
        $ganancias_papa = ($ganancias_total * $taer_cashback_papa->cashback) / 100;
        $ganancias_abuelo = (($ganancias_total * $taer_cashback_abuelo->cashback) / 100);
        $ganancias_papa_comercio = (($ganancias_total * $taer_ganancias_papacomer->cashback) / 100);
        $ganancias_sociosdire = (($ganancias_total * $taer_cashback_sociosdire->cashback) / 100);
        $ganacias_ecom = $ganancias_total - $ganancias_cliente - $ganancias_papa - $ganancias_abuelo - $ganancias_papa_comercio - $ganancias_sociosdire;

        //confirmacion por parte de Cliente
        $estado = "confirmado Usuario";
        $confi_user = 1;
        $metodo_pago = 2;

        if ($datos_producto->id_usuario == $datos_tarjeta->id_comercio) {
            if ($datos_producto->stok >= $cantidad) {
                $insertar = array(
                    "id_comercio" => $datos_cliente->id,
                    "precio" => $valor_total_compra,
                    "cantidad" => $cantidad,
                    "id_usuario" => $datos_cliente->id,
                    "producto" => $datos_producto->nombre,
                    "gana_cash" => $ganancias_cliente,
                    "gana_cash_papa" => $ganancias_papa,
                    "gana_cash_abuelo" => $ganancias_abuelo,
                    "ganancias_comercio" => $ganancias_negocio,
                    "gana_papacomer" => $ganancias_papa_comercio,
                    "gana_socios" => $ganancias_sociosdire,
                    "gana_ecomm" => $ganacias_ecom,
                    "id_papa" => $datos_papa->id,
                    "id_abuelo" => $datos_abuelo->id,
                    "id_papa_comercio" => $datos_comercio->id_papa_pago,
                    "confi_user" => $confi_user,
                    "estado" => $estado,
                    "id_metodo_pago" => $metodo_pago,
                );
                //se envia el registro de la  compra 
                $this->Model_comercio->enviarVenta($insertar);
                //array para modificar stok
                $arri = array(
                    'stok' => $datos_producto->stok - $cantidad
                );
                $this->Model_comercio->actualizarCupones($id, $arri);
                //se descuenta de la tarjeta
                $quitar = array(
                    'cupo' => $datos_tarjeta->cupo - $valor_total_compra
                );
                $this->Model_tarjetas->update_tarjeta_vendi($tarjeta, $quitar);
                $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center" d-flex > Compra exitosa , Acercate a la caja </div></center>');
                redirect(base_url() . 'Comercio/Cupones', 'refresh');
            } else {
                $this->session->set_flashdata('error', '<center><div class="alert alert-danger text-center" d-flex >Cantidad insuficiente </div></center>');
                redirect(base_url() . 'Comercio/Cupones', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', '<center><div class="alert alert-danger text-center" d-flex > No puedes usar esta tarjeta,No valido para este Negocio </div></center>');
            redirect(base_url() . 'Comercio/Cupones', 'refresh');
        }
    }
}
