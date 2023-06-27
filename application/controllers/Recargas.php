<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Recargas extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_logged_in')) {
            $this->load->model('Model_login');
            $this->load->model('Model_comercio');
            $this->load->model('Model_recargas');
            $this->load->model('model_errorpage');
            $this->load->model('Model_solicitudes');
        } else {
            redirect(base_url() . "Inicio_page");
        }
    }

    public function Crucedecuentas($id)
    {
        $datos_comercio = $this->Model_login->cargar_datos_comercio();

        if ($datos_comercio->cuenta_COP >= $datos_comercio->cuenta_COP_deuda) {
            $valor = $datos_comercio->cuenta_COP - $datos_comercio->cuenta_COP_deuda;
            $valor_wallet = $datos_comercio->cuenta_COP - $valor;
            $valor_pago = $datos_comercio->cuenta_COP - $valor;

            $erre = array(
                "cuenta_COP" => $valor,
                "cuenta_COP_deuda" => 0,
            );
            $arre = array(
                "id_comercio" => $id,
                "valor" => $valor_pago,
            );
            $this->Model_comercio->actualizarwallet_comercio($id, $erre);
            $this->Model_recargas->historialcrucecuentas($arre);
            $datos_deuda = $this->Model_recargas->datoregistro();

            $datos = array(
                "estado" => "Pagado",
            );
            $this->Model_recargas->updatepago($datos_deuda->fecha, $datos);
            $this->session->set_flashdata('realizado', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Cruce de cuenta exitoso</div></center>');
            redirect(base_url() . "comercio/?Id=" . $datos_comercio->id, "refresh");
        } else {

            $datos_deuda = $this->Model_recargas->datosdeuda();
            for ($i = 0; $i < count($datos_deuda); $i++) {
                $datos_deuda2 = $this->Model_recargas->datosdeuda2($datos_deuda[$i]->id);
                $datos_comercio1 = $this->Model_login->cargar_datos_comercio();

                if ($datos_deuda2->valor < $datos_comercio1->cuenta_COP) {
                    $valor = $datos_comercio1->cuenta_COP - $datos_deuda2->valor;
                    $valor2 = $datos_comercio1->cuenta_COP_deuda - $datos_deuda2->valor;
                    $arre = array("cuenta_COP" => $valor, "cuenta_COP_deuda" => $valor2, );
                    $this->Model_comercio->actualizarwallet_comercio($id, $arre);
                    $datos = array("estado" => "Pagado", );
                    $this->Model_recargas->updatepago2($datos_deuda[$i]->id, $datos);
                    $arre = array(
                        "id_comercio" => $datos_comercio1->id,
                        "valor" => $datos_deuda2->valor,
                    );
                    $this->Model_recargas->historialcrucecuentas($arre);
                } else {
                    # code...
                }
            }
            $this->session->set_flashdata('realizado', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Cruce de cuenta exitoso</div></center>');
            redirect(base_url() . "comercio/?Id=" . $datos_comercio->id, "refresh");
        }
    }
    public function peticion_recargas($id)
    {
        $num = 1;
        $arre = array(
            "auto_recar" => $num,
        );
        $this->Model_login->actualizarPerfil($arre, $id);
        $this->session->set_flashdata('realizado', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> peticion exitosa </div></center>');
        redirect(base_url() . "comercio/viewRecargas/" . $id, "refresh");
    }
    public function insert_cupo_nuevo($id_cupo)
    {
        $datos_comercio = $this->Model_login->cargar_datos_comercio();
        $mi_archivo = 'img';
        $config['upload_path'] = './assets/img/certificadosBanco/';
        $config['allowed_types'] = "jpg|png|jpeg|pdf";
        $config['maintain_ratio'] = TRUE;
        $config['create_thumb'] = FALSE;
        $config['width'] = 800;
        $config['height'] = 800;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error al subir Certificado </div></center>');
            redirect(base_url() . "comercio/?Id=" . $datos_comercio->id, "refresh");
        } else {

            $data = array("upload_data" => $this->upload->data());
            $imagen = $data['upload_data']['file_name'];
            $datos_paquete = $this->Model_recargas->buscar_paquete($id_cupo);
            $arre = array(
                "img" => $imagen,
                "id_cupo" => $id_cupo,
                "id_negocio" => $datos_comercio->id,
                "cupo" => $datos_paquete->valor,
                "estado" => 0,
            );
            $this->Model_recargas->insert_tb_cuposoli($arre);
            $this->session->set_flashdata('realizado', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Proceso exitoso </div></center>');
            redirect(base_url() . "comercio/?Id=" . $datos_comercio->id, "refresh");
        }
    }
    public function Aceptar_pago($id_cupo)
    {
        $arre = array(
            "estado" => 1,
        );
        $this->Model_recargas->updatecupo($id_cupo, $arre);
        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Autorización exitosa </div></center>');
        redirect(base_url() . "comercio/historial_recargas", "refresh");
    }
    public function proceso_recarga($id_cupo, $cedula, $valor, $tipo)
    {
        $datos_paquete = $this->Model_recargas->inf_cupo_todo($id_cupo);
        $datos_cliente = $this->Model_login->traerdatosCedula($cedula);
        $datos_ecomm = $this->Model_login->cargar_datos_cliente(7);
        $datos_negocio = $this->Model_login->datos_comercio($datos_paquete->id_negocio);
        if ($datos_paquete->cupo >= $valor) {
            //parametros
            $taer_cashback = $this->Model_comercio->traer_parametros(3); // id:3 ==1
            $taer_porcentaje = $this->Model_comercio->traer_parametros(5); // id:5 =50
            //calculos
            $ganancias_general = ($valor * $taer_cashback->cashback) / 100;
            $ganancias_ecomm = ($ganancias_general * $taer_porcentaje->cashback) / 100;
            $ganancias_comercio = ($ganancias_general - $ganancias_ecomm);
            $recarga = $valor - $ganancias_general;
            $arre = array(
                "id_negocio" => $datos_negocio->id,
                "id_metodo" => $id_cupo,
                "cc_usuario" => $cedula,
                "valor_recarga" => $valor,
                "estado" => "Pagado",
                "tipo" => $tipo,
            );
            //se guarda la informacion
            $this->Model_comercio->guardarRegistroRecarga($arre);
            //paso plata cliente
            $wallet1 = $datos_cliente->cuenta_COP + $recarga;
            $are1 = array("cuenta_COP" => $wallet1);
            $this->Model_comercio->actualizarwallet($datos_cliente->id, $are1);
            //paso plata ecomm
            $wallet2 = $datos_ecomm->cuenta_COP + $ganancias_ecomm;
            $are2 = array("cuenta_COP" => $wallet2);
            $this->Model_comercio->actualizarwallet(7, $are2);
            //paso plata comercio
            $wallet3 = $datos_negocio->cuenta_COP + $ganancias_comercio;
            $are3 = array('cuenta_comision' => $wallet3);
            $this->Model_comercio->actualizarwallet_comercio($datos_negocio->id, $are3);
            //descuento al cupo del paquete
            $wallet4 = $datos_paquete->cupo - $valor;
            $are4 = array('cupo' => $wallet4);
            $this->Model_recargas->updatecupo($id_cupo, $are4);
            $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Recarga exitosa</div></center>');
            redirect(base_url() . "comercio/viewRecargas/" . $datos_negocio->id, "refresh");
        } else {
            $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Cupo Insuficiente</div></center>');
            redirect(base_url() . "comercio/viewRecargas/" . $datos_paquete->id_negocio, "refresh");
        }
    }
    //proceso pagar cuenta deudora
    public function pago_todo($id)
    {
        $valor = $this->input->post("valor");
        $mi_archivo = 'img';
        $config['upload_path'] = './assets/img/certificadosBanco/transferencia';
        $config['allowed_types'] = "jpg|png|jpeg|pdf";
        $config['maintain_ratio'] = TRUE;
        $config['create_thumb'] = FALSE;
        $config['width'] = 800;
        $config['height'] = 800;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error al subir Certificado </div></center>');
            redirect(base_url() . "comercio/?Id=" . $id, "refresh");
        } else {

            $data = array("upload_data" => $this->upload->data());
            $imagen = $data['upload_data']['file_name'];
            $arre = array(
                "id_comercio" => $id,
                "valor" => $valor,
                "estado" => 1,
                "certificado" => $imagen,
            );
            $this->Model_recargas->insert_tb_pagos($arre);
            $this->session->set_flashdata('realizado', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Proceso exitoso </div></center>');
            redirect(base_url() . "comercio/?Id=" . $id, "refresh");
        }
    }
    public function validarPago($id)
    {
        $datosPago = $this->Model_recargas->dataPago($id);
        $datosComercio = $this->Model_login->datos_comercio($datosPago->id_comercio);
        $ari = array(
            "estado" => 2,
        );
        $this->Model_recargas->updatestatus($id, $ari);

        $paz = array(
            "estado" => "Pagado",
        );
        //actualizar billetera comercio

        $this->Model_recargas->pazSalvo($datosPago->id_comercio, $paz);
        $walletDeuda = $datosComercio->cuenta_COP_deuda - $datosPago->valor;
        $nuevo = array(
            "cuenta_COP_deuda" => $walletDeuda,
        );
        $this->Model_comercio->actualizarwallet_comercio($datosComercio->id, $nuevo);
        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Proceso exitoso </div></center>');
        redirect(base_url() . "comercio/historial_recargas", "refresh");
    }
    ///funciones para modificar el cupo de las recargas
    public function updatecupo($id)
    {
        $cupo = $this->input->post("cupo");
        $data = array(
            "id_cupo" => $cupo,
        );
        $this->Model_comercio->updaterecarga($data, $id);
        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Proceso exitoso </div></center>');
        redirect(base_url() . "comercio/historial_recargas", "refresh");
    }
}