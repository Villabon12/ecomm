<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');


class Probar extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Model_login');

        $this->load->model('Model_comercio');

        $this->load->model('Model_landing');

        $this->load->model('Model_wallet');
    }

    public function index()
    {
        $id = $this->input->get('id');
        $result['departamentos'] = $this->Model_login->traerDepar();
        $result['perfil'] = $this->Model_login->cargar_datosRegistro($id);
        $this->load->view('prueba', $result);
    }


    public function insertar_registrar($id_refe)

    {
        $contrasena = $this->input->post('Contra');
        $contrasena1 = $this->input->post('contra1');
        $tipo = $this->input->post('tipo');

        $miarchivo1 = 'CC_front';
        $config['upload_path'] = './asset/images/confirmacion/';
        $config['allowed_types'] = "jpg|png|jpeg|pdf";

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($miarchivo1)) {

            $error = array('error' => $this->upload->display_errors());

            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Revisa la primera imagen</label></div>');
            redirect(base_url() . "Inicio_page/registro/" . $id_refe);
        } else {
            /// poner if de tippo
            if ($tipo == "Comercio") {
                if ($contrasena != $contrasena1) {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Contraseña no coinciden</label></div>');
                    redirect(base_url() . "Inicio_page/registro/" . $id_refe);
                } else {

                    $data = array("upload_data" => $this->upload->data());
                    $imagen1 = $data['upload_data']['file_name'];

                    $ciudad = $this->input->post('ciudad');
                    $insertar = array(

                        "nombre_negocio" => $this->input->post('Nombre_nego'),

                        "nombre" => $this->input->post('Nombre_enca'),

                        "apellido1" => $this->input->post('Apellido1'),

                        "correo" => $this->input->post('Correo'),

                        "celular" => $this->input->post('Telefono'),

                        "id_papa_pago" => $id_refe,

                        "user" => $this->input->post('User'),

                        "ciudad" => $ciudad,

                        "tipo" => $tipo,

                        "contrasena" => md5($contrasena),

                        "img_cedula_front" => $imagen1

                    );
                    if ($this->Model_login->ingresar_registro($insertar)) {

                        $id = $this->Model_login->lastID();

                        $miarchivo2 = 'CC_back';
                        $config['upload_path'] = './asset/images/confirmacion/';

                        $config['allowed_types'] = "jpg|png|jpeg|pdf";
                        $this->load->library('upload', $config);



                        if (!$this->upload->do_upload($miarchivo2)) {

                            $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Revisa la segunda imagen</label></div>');
                            redirect(base_url() . "Inicio_page/registro/" . $id_refe);
                        } else {

                            $data = array("upload_data" => $this->upload->data());

                            $imagen2 = $data['upload_data']['file_name'];



                            $arre = array(

                                "img_cedula_back" => $imagen2,

                            );

                            if ($this->Model_login->addImg2($arre, $id)) {
                            } else {

                                $id2 = $id;

                                $miarchivo3 = 'RUT';

                                $config['upload_path'] = './asset/images/confirmacion/';

                                $config['allowed_types'] = "jpg|png|jpeg|pdf";

                                $this->load->library('upload', $config);

                                if (!$this->upload->do_upload($miarchivo3)) {

                                    $error = array('error' => $this->upload->display_errors());
                                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Revisa la tercera imagen</label></div>');
                                    redirect(base_url() . "Inicio_page/registro/" . $id_refe);
                                } else {

                                    $data = array("upload_data" => $this->upload->data());

                                    $imagen3 = $data['upload_data']['file_name'];
                                    $arre2 = array(

                                        "RUT" => $imagen3,

                                    );
                                    if ($this->Model_login->addImg2($arre2, $id2)) {

                                        echo "vas por buen camino :)";
                                    } else {

                                        $wallet = $this->generateRandomString(10);

                                        $data = array(

                                            "wallet" => $wallet,

                                            "id_usuario" => $id2

                                        );
                                        $idUser = $this->Model_wallet->insertwallet1($data);

                                        $data2 = array(
                                            "wallet_id" => $idUser
                                        );
                                        $this->Model_login->addImg2($data2, $id2);

                                        $izquierda = $this->Model_login->traerPrueba($id_refe);
                                        $estado = $this->Model_comercio->estadoRegisto($id_refe);
                                        $derecha = $this->Model_login->traerPruebaDerecha($id_refe);
                                        if ($estado->ubica == "izquierda") {
                                            if (count($izquierda) == 1) {
                                                $data = array(
                                                    "id_izquierda" => $id,
                                                );
                                                echo "estoy en comercio";
                                                // $this->Model_login->ModificarDerecha($data, $izquierda->id);
                                                // $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                                // redirect(base_url() . "Inicio_page/login", "refresh");
                                            } else {
                                                do {
                                                    if ($izquierda->id_izquierda == 0) {
                                                        $data = array(
                                                            "id_izquierda" => $id,
                                                        );
                                                        echo "estoy en comercio";
                                                        // $this->Model_login->ModificarDerecha($data, $izquierda->id);
                                                        // $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                                        // redirect(base_url() . "Inicio_page/login", "refresh");
                                                    }
                                                    $izquierda = $this->Model_login->traerPrueba($izquierda->id_izquierda);
                                                } while ($izquierda->id_izquierda != 0);
                                            }
                                        } else {
                                            if (count($derecha) == 1) {
                                                $data = array(
                                                    "id_derecha" => $id,
                                                );
                                                echo "estoy en comercio";

                                                // $this->Model_login->ModificarDerecha($data, $derecha->id);
                                                // $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                                // redirect(base_url() . "Inicio_page/login", "refresh");
                                            } else {
                                                do {
                                                    if ($derecha->id_derecha == 0) {
                                                        $data = array(
                                                            "id_derecha" => $id,
                                                        );
                                                        echo "estoy en comercio";

                                                        // $this->Model_login->ModificarDerecha($data, $derecha->id);
                                                        // $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                                        // redirect(base_url() . "Inicio_page/login", "refresh");
                                                    } else {
                                                        $derecha = $this->Model_login->traerPruebaDerecha($derecha->id_derecha);
                                                    }
                                                } while ($derecha->id_derecha != 0);
                                            }
                                        }
                                        echo "estoy en comercio";

                                        // $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                        // redirect(base_url() . "Inicio_page/login", "refresh");
                                    }
                                }
                            }
                        }
                    } else {

                        $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Contraseña no coinciden</div>');

                        redirect(base_url() . "Inicio_page/login");
                    }
                }
            } else {
                if ($contrasena != $contrasena1) {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Contraseña no coinciden</label></div>');
                    redirect(base_url() . "Inicio_page/registro/" . $id_refe);
                } else {

                    $data = array("upload_data" => $this->upload->data());
                    $imagen1 = $data['upload_data']['file_name'];
                    $ciudad = $this->input->post('ciudad');

                    $insertar = array(

                        "nombre" => $this->input->post('Nombre_enca'),

                        "apellido1" => $this->input->post('Apellido1'),

                        "correo" => $this->input->post('Correo'),

                        "cedula" => $this->input->post('cedula'),

                        "celular" => $this->input->post('Telefono'),

                        "id_papa_pago" => $id_refe,

                        "user" => $this->input->post('User'),

                        "ciudad" => $ciudad,

                        "tipo" => $tipo,

                        "contrasena" => md5($contrasena),

                        "img_cedula_front" => $imagen1

                    );

                    if ($this->Model_login->ingresar_registro($insertar)) {



                        $id = $this->Model_login->lastID();

                        $miarchivo2 = 'CC_back';
                        $config['upload_path'] = './asset/images/confirmacion/';

                        $config['allowed_types'] = "jpg|png|jpeg|pdf";
                        $this->load->library('upload', $config);



                        if (!$this->upload->do_upload($miarchivo2)) {

                            $error = array('error' => $this->upload->display_errors());

                            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Revisa la segunda imagen</label></div>');
                            redirect(base_url() . "Inicio_page/registro/" . $id_refe);
                        } else {

                            $data = array("upload_data" => $this->upload->data());

                            $imagen2 = $data['upload_data']['file_name'];



                            $arre = array(

                                "img_cedula_back" => $imagen2,

                            );

                            if ($this->Model_login->addImg2($arre, $id)) {

                                echo "no vas por buen camino :)";
                            } else {

                                $id2 = $id;
                                $miarchivo3 = 'img_selfie';
                                $config['upload_path'] = './asset/images/confirmacion/';

                                $config['allowed_types'] = "jpg|png|jpeg|pdf";

                                $this->load->library('upload', $config);

                                if (!$this->upload->do_upload($miarchivo3)) {

                                    $error = array('error' => $this->upload->display_errors());

                                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Revisa la tercera imagen</label></div>');
                                    redirect(base_url() . "Inicio_page/registro/" . $id_refe);
                                } else {

                                    $data = array("upload_data" => $this->upload->data());

                                    $imagen3 = $data['upload_data']['file_name'];
                                    $arre2 = array(

                                        "img_selfie" => $imagen3,

                                    );
                                    if ($this->Model_login->addImg2($arre2, $id2)) {
                                    } else {

                                        $wallet = $this->generateRandomString(10);

                                        $data = array(

                                            "wallet" => $wallet,

                                            "id_usuario" => $id2

                                        );
                                        $idUser = $this->Model_wallet->insertwallet($data);

                                        $data2 = array(
                                            "wallet_id" => $idUser
                                        );
                                        $this->Model_login->addImg2($data2, $id2);

                                        $izquierda = $this->Model_login->traerPrueba($id_refe);
                                        $estado = $this->Model_comercio->estadoRegisto($id_refe);
                                        $derecha = $this->Model_login->traerPruebaDerecha($id_refe);
                                        if ($estado->ubica == "izquierda") {
                                            if ($izquierda->id_izquierda == 0) {
                                                $data = array(
                                                    "id_izquierda" => $id,
                                                );
                                                // $this->Model_login->ModificarDerecha($data, $izquierda->id);
                                                // $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                                // redirect(base_url() . "Inicio_page/login", "refresh");
                                            } else if (count($izquierda) > 1) {
                                                do {
                                                    if ($izquierda->id_izquierda == 0) {
                                                        $data = array(
                                                            "id_izquierda" => $id,
                                                        );
                                                        // $this->Model_login->ModificarDerecha($data, $izquierda->id);
                                                        // $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                                        // redirect(base_url() . "Inicio_page/login", "refresh");
                                                    }
                                                    $izquierda = $this->Model_login->traerPrueba($izquierda->id_izquierda);
                                                } while ($izquierda->id_izquierda != 0);
                                            }
                                        } else {
                                            if ($derecha->id_derecha == 0) {

                                                $data = array(
                                                    "id_derecha" => $id,
                                                );
                                                // $this->Model_login->ModificarDerecha($data, $derecha->id);
                                                // $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                                // redirect(base_url() . "Inicio_page/login", "refresh");

                                            } else {
                                                do {
                                                    print_r($derecha);
                                                    if ($derecha->id_derecha == 0) {
                                                        $data = array(
                                                            "id_derecha" => $id,
                                                        );
                                                        // $this->Model_login->ModificarDerecha($data, $derecha->id);
                                                        // $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                                        // redirect(base_url() . "Inicio_page/login", "refresh");
                                                    } else {
                                                        $derecha = $this->Model_login->traerPruebaDerecha($derecha->id_derecha);
                                                    }
                                                } while ($derecha->id_derecha != 0);
                                            }
                                        }
                                        // $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                        // redirect(base_url() . "Inicio_page/login", "refresh");
                                    }
                                }
                            }
                        }
                    } else {

                        $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Contraseña no coinciden</div>');

                        redirect(base_url() . "Inicio_page/login");
                    }
                }
            }
        }
    }

    function generateRandomString($length)

    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public function consultar($id_refe)
    {
        $id = 10782;

        $izquierda = $this->Model_login->traerPrueba($id_refe);
        $estado = $this->Model_comercio->estadoRegisto($id_refe);
        $derecha = $this->Model_login->traerPruebaDerecha($id_refe);
        if ($estado->ubica == "izquierda") {
            if ($izquierda->id_izquierda == 0) {
                $data = array(
                    "id_izquierda" => $id,
                );
                $this->Model_login->ModificarDerecha($data, $izquierda->id);
                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                redirect(base_url() . "Inicio_page/login", "refresh");
            } else if (count($izquierda) > 1) {
                do {
                    if ($izquierda->id_izquierda == 0) {
                        $data = array(
                            "id_izquierda" => $id,
                        );
                        $this->Model_login->ModificarDerecha($data, $izquierda->id);
                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                        redirect(base_url() . "Inicio_page/login", "refresh");
                    }
                    $izquierda = $this->Model_login->traerPrueba($izquierda->id_izquierda);
                } while ($izquierda->id_izquierda != null);
            }
        } else {
            if ($derecha->id_derecha == 0) {

                $data = array(
                    "id_derecha" => $id,
                );
                $this->Model_login->ModificarDerecha($data, $derecha->id);
                 $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                 redirect(base_url() . "Inicio_page/login", "refresh");

            } else {
                do {
                    if ($derecha->id_derecha == 0) {
                        $data = array(
                            "id_derecha" => $id,
                        );
                         $this->Model_login->ModificarDerecha($data, $derecha->id);
                         $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                         redirect(base_url() . "Inicio_page/login", "refresh");
                    } 
                    $derecha = $this->Model_login->traerPruebaDerecha($derecha->id_derecha);
                } while ($derecha->id_derecha != null);
            }
        }
    }
}
