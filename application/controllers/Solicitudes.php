<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Solicitudes extends CI_Controller
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
            $this->load->model('Model_cupones');
            
        } else {
            redirect(base_url() . "Inicio_page");
        }
    }

    public function enviarsoli($id)
    {
        $valor = $this->input->post("valor");
        $id_banco = $this->input->post("banco");

        if ($id_banco == 0) {
            $this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error , digite una cuenta bancaria</div></center>');
            redirect(base_url() . 'Comercio?Id=' . $id, 'refresh');
        } else {
            //parametro de valor minimo para retirar
            $parametro = $this->Model_comercio->traer_parametros(14);
            //porcentaje de por retiro
            $porcentaje = $this->Model_comercio->traer_parametros(13);
            if ($valor > $parametro->cashback) {

                $datos_usuario = $this->Model_login->cargar_datos();
                //datos para envio de plata e´comm
                $datos_ecomm = $this->Model_login->cargar_datos_cliente(7);

                if ($datos_usuario->cuenta_EPUNTOS >= $valor) {
                    $datos_cuenta = $this->Model_solicitudes->info_cuenta($id_banco);
                    $ganancias_ecomm = ($valor * $porcentaje->cashback / 100);
                    $valor_real = $valor - $ganancias_ecomm;
                    $arre = array(
                        "id_usuario" => $id,
                        "valor" => $valor_real,
                        "ganancia_ecomm" => $ganancias_ecomm,
                        "banco" => $datos_cuenta->banco,
                        "num_cuenta" => $datos_cuenta->numero,
                    );
                    
                    $this->Model_solicitudes->insert_solicitud($arre);
                    //resta de valor a cliente
                    $Wallet_COP = ($datos_usuario->cuenta_EPUNTOS - $valor);
                    $dato = array('cuenta_EPUNTOS' => $Wallet_COP);
                    $this->Model_comercio->actualizarwallet($datos_usuario->id, $dato);


                    //envio de plata a e´comm
                    $Wallet_COP2 = ($datos_ecomm->cuenta_COP + $ganancias_ecomm);
                    $dato = array('cuenta_COP' => $Wallet_COP2);
                    $this->Model_comercio->actualizarwallet(7, $dato);


                    $this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Solicitud exitosa</div></center>');
                    redirect(base_url() . 'Comercio?Id=' . $id, 'refresh');
                } else {
                    $this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error , no dispones de esa cantidad</div></center>');
                    redirect(base_url() . 'Comercio?Id=' . $id, 'refresh');
                }
            } else {
                $this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error , no supera el monto minimo</div></center>');
                redirect(base_url() . 'Comercio?Id=' . $id, 'refresh');
            }
        }

    }
    public function enviarsolicomer($id)
    {
        $valor = $this->input->post("valor");
        $id_banco = $this->input->post("banco");
        $nota = $this->input->post("nota");
        if ($id_banco == 0) {
            $this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error , digite una cuenta bancaria</div></center>');
            redirect(base_url() . 'Comercio?Id=' . $id, 'refresh');
        } else {
            //parametro de valor minimo para retirar
            $parametro = $this->Model_comercio->traer_parametros(9);
            //porcentaje de por retiro

            if ($valor >= $parametro->cashback) {

                $datos_usuario = $this->Model_login->cargar_datos_comercio();
                //datos para envio de plata e´comm

                if ($datos_usuario->cuenta_COP <= $valor) {
                    $datos_cuenta = $this->Model_solicitudes->info_cuenta($id_banco);

                    $arre = array(
                        "id_comercio" => $id,
                        "nota" => $nota,
                        "valor" => $valor,
                        "banco" => $datos_cuenta->banco,
                        "num_cuenta" => $datos_cuenta->numero,
                    );
                    $this->Model_comercio->enviarPeticion($arre);
                    //resta de valor a comercio
                    $Wallet_COP = ($datos_usuario->cuenta_COP - $valor);
                    $dato = array('cuenta_COP' => $Wallet_COP);
                    $this->Model_comercio->actualizarwallet_comercio($id, $dato);


                    $this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Solicitud exitosa</div></center>');
                    redirect(base_url() . 'Comercio?Id=' . $id, 'refresh');
                } else {
                    $this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error , no dispones de esa cantidad</div></center>');
                    redirect(base_url() . 'Comercio?Id=' . $id, 'refresh');
                }
            } else {
                $this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error , no supera el monto minimo</div></center>');
                redirect(base_url() . 'Comercio?Id=' . $id, 'refresh');
            }
        }

    }
    public function detalles()
    {
        $result['perfil'] = $this->Model_login->cargar_datos();
        $result['tb_recar'] = $this->Model_recargas->tb_historial_recargaspro($result['perfil']->cedula);
        $result['tb_soli'] = $this->Model_solicitudes->tb_histo_pro();
        $result['tb_paso'] = $this->Model_solicitudes->tb_histo_pasowallet();
        $result['categorias'] = $this->Model_cupones->traerCategorias();
        $result['ciudad'] = $this->Model_comercio->traerciudad1();
        $this->load->view('prueba_header', $result);
        $this->load->view('solicitudes/solicitudes_cliente', $result);
        $this->load->view('prueba_footer', $result);
    }
    public function detallescomer()
    {
        $result['categorias'] = $this->Model_cupones->traerCategorias();
        $result['perfil'] = $this->Model_login->cargar_datos_comercio();
        $result['tb_soli'] = $this->Model_solicitudes->tb_histo_comer();
        $result['tb_pagos'] = $this->Model_recargas->dataNegocio();
        
        $this->load->view('prueba_header', $result);
        $this->load->view('solicitudes/solicitudes_comer', $result);
        $this->load->view('prueba_footer', $result);
    }
    public function solicitudesAdmin()
    {
        $result['categorias'] = $this->Model_cupones->traerCategorias();

        $result['perfil'] = $this->Model_login->cargar_datos();
        $result['tb_user'] = $this->Model_solicitudes->tb_histo_admin();
        $result['tb_paso'] = $this->Model_solicitudes->tb_histo_pasowalletadmi();
        $result['tb_comer'] = $this->Model_solicitudes->tb_histo_admincomer();
        $this->load->view('prueba_header', $result);
        $this->load->view('solicitudes/solicitudes_admin', $result);
        $this->load->view('prueba_footer', $result);
    }
    public function aprobacionUser($id)
    {
        $mi_archivo = 'img';
        $config['upload_path'] = './assets/img/soporte/envio_solicitudes/';
        $config['allowed_types'] = "jpg|png|jpeg|pdf";
        $config['maintain_ratio'] = TRUE;
        $config['create_thumb'] = FALSE;
        $config['width'] = 800;
        $config['height'] = 800;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            redirect(base_url() . "Solicitudes/solicitudesAdmin", "refresh");
            $this->session->set_flashdata('error_maximo', ' <center><div class="alert alert-danger align-items-center d-flex" style="width: 1000px;"> Error al subir certificado de transferencia </div></center> ');
        } else {
            $data = array("upload_data" => $this->upload->data());
            $imagen = $data['upload_data']['file_name'];

            $arre = array(

                "comprobante" => $imagen,
                "estado" => 1,

            );
            $this->Model_solicitudes->update_solicitudesuser($arre, $id);
            $this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Envio exitoso</div></center>');
            redirect(base_url() . 'Solicitudes/solicitudesAdmin', 'refresh');
        }
    }
    public function pasarpuntos($id)
    {
        $valor = $this->input->post("valor");
        //porcentaje de por retiro
        $porcentaje = $this->Model_comercio->traer_parametros(12);

        $datos_usuario = $this->Model_login->cargar_datos();

        if ($datos_usuario->cuenta_EPUNTOS >= $valor) {
            $datos_ecomm = $this->Model_login->cargar_datos_cliente(7);
            $ganancias_ecomm = ($valor * $porcentaje->cashback / 100);
            $valor_real = $valor - $ganancias_ecomm;
            $arre = array(
                "id_usuario" => $id,
                "valor" => $valor_real,
                "ganancia_ecomm" => $ganancias_ecomm,
            );
            //resta de valor a cliente
            $Wallet_COP = ($datos_usuario->cuenta_EPUNTOS - $valor);
            $dato = array('cuenta_EPUNTOS' => $Wallet_COP);
            $this->Model_comercio->actualizarwallet($datos_usuario->id, $dato);

            //envio de plata a e´comm
            $Wallet_COP2 = ($datos_ecomm->cuenta_COP + $ganancias_ecomm);
            $dato = array('cuenta_COP' => $Wallet_COP2);
            $this->Model_comercio->actualizarwallet(7, $dato);

            //envio plata wallet principal
            $Wallet_COP3 = ($datos_usuario->cuenta_COP + $valor_real);
            $dato = array('cuenta_COP' => $Wallet_COP3);
            $this->Model_comercio->actualizarwallet($datos_usuario->id, $dato);


            $this->Model_solicitudes->insert_enviowallet($arre);
            $this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Proceso exitoso</div></center>');
            redirect(base_url() . 'Comercio?Id=' . $id, 'refresh');
        } else {
            $this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error , no dispones de esa cantidad</div></center>');
            redirect(base_url() . 'Comercio?Id=' . $id, 'refresh');
        }
    }
    public function aprobacionComer($id)
    {
        $mi_archivo = 'img';
        $config['upload_path'] = './assets/img/soporte/envio_solicitudes/';
        $config['allowed_types'] = "jpg|png|jpeg|pdf";
        $config['maintain_ratio'] = TRUE;
        $config['create_thumb'] = FALSE;
        $config['width'] = 800;
        $config['height'] = 800;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            redirect(base_url() . "Solicitudes/solicitudesAdmin", "refresh");
            $this->session->set_flashdata('error_maximo', ' <center><div class="alert alert-danger align-items-center d-flex" style="width: 1000px;"> Error al subir certificado de transferencia </div></center> ');
        } else {
            $data = array("upload_data" => $this->upload->data());
            $imagen = $data['upload_data']['file_name'];

            $arre = array(

                "comprobante" => $imagen,
                "estado" => 1,

            );
            $this->Model_solicitudes->update_solicitudescomer($arre, $id);
            $this->session->set_flashdata('error_maximo', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Envio exitoso</div></center>');
            redirect(base_url() . 'Solicitudes/solicitudesAdmin', 'refresh');
        }
    }
}