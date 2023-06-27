<?php

defined('BASEPATH') or exit('No direct script access allowed');

class inicio_page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Model_login');
        $this->load->model('Model_comercio');
        $this->load->model('Model_landing');
        $this->load->model('Model_wallet');
        $this->load->model('Model_errorpage');
        $this->load->model('Model_email');
        $this->load->model('Model_cupones');
    }

    public function consultar($id)
    {
        $izquierda = $this->Model_login->traerPrueba($id);
        $estado = $this->Model_comercio->estadoRegisto($id);
        $derecha = $this->Model_login->traerPruebaDerecha($id);

        if ($estado->ubica == "izquierda") {
            do {
                print_r($izquierda);
                $izquierda = $this->Model_login->traerPrueba($izquierda->id_izquierda);
                if ($izquierda->id_izquierda == null) {
                    $data = array(
                        "id_izquierda" => 1,
                    );

                    $this->Model_login->ModificarDerecha($data, $izquierda->id);
                }
            } while ($izquierda != null);
        } else {
            do {
                $derecha = $this->Model_login->traerPruebaDerecha($derecha->id_derecha);
                if ($derecha->id_derecha == null) {
                    $data = array(
                        "id_derecha" => $id,
                    );

                    $this->Model_login->ModificarDerecha($data, $derecha->id);
                }
            } while ($derecha != null);
        }
    }

    public function index()
    {
        $result['comida'] = $this->Model_cupones->comida();
        $result['moda'] = $this->Model_cupones->moda();
        $result['vaca'] = $this->Model_cupones->vacation();
        $result['salud'] = $this->Model_cupones->salud();
        $result['electro'] = $this->Model_cupones->electro();
        $result['todito'] = $this->Model_cupones->todito();

        $result['categorias'] = $this->Model_cupones->traerCategorias();
        $this->load->view('landing_page/prueba', $result);
    }
    public function traerlanding()
    {
        $buscar = $this->input->post("buscar");
        $productos = $this->Model_comercio->traerproducto($buscar);
        echo json_encode($productos);
    }

    public function login()
    {
        $this->load->view('landing_page/inicio_sesion');
    }

    public function registro($id)
    {
        $result['departamentos'] = $this->Model_login->traerDepar();
        $result['perfil'] = $this->Model_login->cargar_datosRegistro($id);

        if (count($result['perfil']) == 1) {
            $this->load->view('landing_page/view_registro', $result);
        } else {
            $intruso = array(
                'id_usuario' => 0,
                'texto' => 'registro comercio',
                'fecha_registro' => date("Y-m-d H:i:s"),
            );

            $this->Model_errorpage->insertIntruso($intruso);
            redirect("" . base_url() . "errorpage/error");
        }
    }


    public function comercio($id)
    {
        $result['departamentos'] = $this->Model_login->traerDepar();
        $result['perfil'] = $this->Model_login->cargar_datosRegistro($id);

        if ($result['perfil']->verificar_user == 'habilitado') {
            $this->load->view('landing_page/registrar_comercio', $result);
        } else {
            $intruso = array(
                'id_usuario' => 0,
                'texto' => 'registro comercio',
                'fecha_registro' => date("Y-m-d H:i:s"),
            );

            $this->Model_errorpage->insertIntruso($intruso);

            redirect("" . base_url() . "errorpage/error");
        }
    }


    public function insertar_registrar($id_refe)
    {
        $user = $this->input->post('User');
        $cedula = $this->input->post('cedula');
        $correo = $this->input->post('Correo');
        $result = $this->Model_login->consultaregistro($user, $cedula, $correo);

        if ($result->contar == 1) { // no se puede registrar
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name" style="color:black;"> Registro invalido, ya existen las credenciales</label></div>');
            redirect(base_url() . "Inicio_page/registro/" . $id_refe);
        } else { // si se puede registrar
            $contrasena = $this->input->post('Contra');
            $contrasena1 = $this->input->post('contra1');
            $tipo = $this->input->post('tipo');

            if ($tipo == "Comercio") {
                if ($contrasena != $contrasena1) {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Contraseña no coinciden</label></div>');
                    redirect(base_url() . "Inicio_page/registro/" . $id_refe);
                } else {
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
                        "estado" => 0,
                        "contrasena" => md5($contrasena),
                    );

                    if ($this->Model_login->ingresar_registro($insertar)) {
                        $id = $this->Model_login->lastID();
                        $wallet = $this->generateRandomString(10);
                        $data = array(
                            "wallet" => $wallet,
                            "id_usuario" => $id
                        );

                        $idUser = $this->Model_wallet->insertwallet1($data);

                        $data2 = array(
                            "wallet_id" => $idUser
                        );
                        $this->Model_login->addImg2($data2, $id);

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
                            } elseif (count($izquierda) > 1) {
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
                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                        redirect(base_url() . "Inicio_page/login", "refresh");
                    } else {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">No se pudo guardar los datos</div>');
                        redirect(base_url() . "Inicio_page/login");
                    }
                }
            } else {
                if ($contrasena != $contrasena1) {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Contraseña no coinciden</label></div>');
                    redirect(base_url() . "Inicio_page/registro/" . $id_refe);
                } else {
                    $ciudad = $this->input->post('ciudad');
                    $insertar = array(
                        "nombre" => $this->input->post('Nombre_enca'),
                        "apellido1" => $this->input->post('Apellido1'),
                        "correo" => $this->input->post('Correo'),
                        "cedula" => $cedula,
                        "celular" => $this->input->post('Telefono'),
                        "id_papa_pago" => $id_refe,
                        "user" => $this->input->post('User'),
                        "ciudad" => $ciudad,
                        "tipo" => $tipo,
                        "contrasena" => md5($contrasena),
                    );
                    if ($this->Model_login->ingresar_registro($insertar)) {
                        $id2 = $this->Model_login->lastID();
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
                                    "id_izquierda" => $id2,
                                );
                                $this->Model_login->ModificarDerecha($data, $izquierda->id);
                                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                redirect(base_url() . "Inicio_page/login", "refresh");
                            } elseif (count($izquierda) > 1) {
                                do {
                                    if ($izquierda->id_izquierda == 0) {
                                        $data = array(
                                            "id_izquierda" => $id2,
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
                                    "id_derecha" => $id2,
                                );
                                $this->Model_login->ModificarDerecha($data, $derecha->id);
                                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                redirect(base_url() . "Inicio_page/login", "refresh");
                            } else {
                                do {
                                    if ($derecha->id_derecha == 0) {
                                        $data = array(
                                            "id_derecha" => $id2,
                                        );
                                        $this->Model_login->ModificarDerecha($data, $derecha->id);
                                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                        redirect(base_url() . "Inicio_page/login", "refresh");
                                    }
                                    $derecha = $this->Model_login->traerPruebaDerecha($derecha->id_derecha);
                                } while ($derecha->id_derecha != null);
                            }
                        }
                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                        redirect(base_url() . "Inicio_page/login", "refresh");
                    } else {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">No se pudo guardar</div>');
                        redirect(base_url() . "Inicio_page/login");
                    }
                }
            }
        }
    }

    public function generateRandomString($length)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
    public function encuesta()
    {
        $datos = $this->Model_login->cargar_datos();
        $calificacion = $this->input->post('estrellas');
        $are = array(
            "id_usuario" => $datos->id,
            "calificacion" => $calificacion,
        );
        $this->Model_login->encuenta($are);
        $this->session->set_flashdata('error', '<center><div class="alert alert-success text-center" d-flex >Gracias por tu Calificacion </div></center>');
        redirect(base_url() . 'Comercio/Cupones', 'refresh');
    }

    /* codigo para validar perfil y entrar*/
    public function validaAcceso()
    {
        $user = $this->input->post('user');
        $pass = md5($this->input->post('pass'));
        $result = $this->Model_login->consultaUser($user, $pass);
        if ($result->contar == 1) {
            $datos_user = $this->Model_login->trae_user($user, $pass);
            $session = array(
                'ID' => $datos_user->id,
                'USUARIO' => $datos_user->correo,
                'NOMBRE' => $datos_user->nombre,
                'APELLIDO' => $datos_user->apellido1,
                'CORREO' => $datos_user->correo,
                'USER' => $datos_user->user,
                'CONTRASENA' => $datos_user->contrasena,
                'ROL' => $datos_user->tipo,
                'SECURITY' => $datos_user->security,
                'url_img' => $datos_user->img_perfil,
                'is_logged_in' => true,
            );
            $this->session->set_userdata($session);
            if ($datos_user->tipo == 'Comercio') {
                if ($this->session->userdata('is_logged_in')) {
                    redirect(base_url() . "comercio?Id=$datos_user->id");
                }
            }

            if ($datos_user->tipo == 'Socio') {
                if ($this->session->userdata('is_logged_in')) {
                    redirect(base_url() . "comercio/cupones");
                }
            }

            if ($datos_user->tipo == 'SocioAdmin') {
                if ($this->session->userdata('is_logged_in')) {
                    redirect(base_url() . "comercio?Id=$datos_user->id");
                }
            }
            //
        } else {
            //en caso contrario mostramos el error de usuario o contraseña invalido

            $this->session->set_flashdata('error', '<script>alert("contraseña incorrecta")</script>');
            redirect(base_url() . "");
        }
    }



    public function session_dest()
    {
        $session = array(
            'logueado' => false
        );
        $this->session->set_userdata($session);
        $this->session->sess_destroy();
        redirect('Inicio_page');
    }

    public function validarCorreo()
    {
        $email = $this->input->post('email');
        $consulta = $this->Model_errorpage->verificarEmail($email);

        if ($consulta->contar == 1) {
            echo "Correo ya usado, elige otro";
        }
    }

    public function validarUser()
    {
        $usuario = $this->input->post('usuario');
        $consulta = $this->Model_errorpage->verificarUsuario($usuario);
        if ($consulta->contar == 1) {
            echo "Usuario ya usado, elige otro";
        }
    }

    public function validarCedula()
    {
        $usuario = $this->input->post('cedula');
        $consulta = $this->Model_errorpage->verificarCedula($usuario);
        if ($consulta->contar == 1) {
            echo "Cedula ya registrada";
        }
    }

    public function registroPrueba($id)
    {
        $result['departamentos'] = $this->Model_login->traerDepar();
        $result['perfil'] = $this->Model_login->cargar_datosRegistro($id);

        $this->load->view('landing_page/registro_prueba', $result);
    }

    public function olvidarContra()
    {
        $this->load->view('landing_page/olvidar');
    }

    public function Proceso($user)
    {
        $result['usuario'] = $user;
        $this->load->view('landing_page/proceso', $result);
    }

    public function olvidarClave()
    {
        $cedula = $this->input->post('cedula');
        $consulta = $this->Model_errorpage->verificarCedula($cedula);
        if ($consulta->contar == 1) {
            $date = new DateTime();
            $date->modify('+3 minute');

            $data = array(
                "cod_cambio" => $this->generateRandomString(6),
                "fecha_caduca_cod" => $date->format('Y-m-d H:i:s')
            );
            if (($this->Model_errorpage->update($data, $cedula) == 1)) {
                $datos = $this->Model_errorpage->traerDatos($cedula);

                $this->Model_email->codigo_seguridad($datos->correo, $datos->cod_cambio, $datos->user);
                $this->Model_email->envio_correos_pendientes_bd();
                $this->session->set_flashdata('error', '<div class="alert alert-success text-center">Revisa tu Correo electronico registrado</div>');
                redirect(base_url() . "Inicio_page/olvidarContra");
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Revisa tu conexion a internet</div>');
                redirect(base_url() . "Inicio_page/olvidarContra");
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Cedula no encontrada</div>');
            redirect(base_url() . "Inicio_page/olvidarContra");
        }
    }

    public function CambiarClave()
    {
        $user = $this->input->post('user');
        $contra = md5($this->input->post('pass'));
        $contra2 = md5($this->input->post('pass2'));
        $date = new DateTime();

        $datos = $this->Model_errorpage->traerDatosUser($user);

        if ($datos->fecha_caduca_cod >= $date->format('Y-m-d H:i:s')) {
            if ($contra == $contra2) {
                $data = array(
                    "contrasena" => $contra
                );
                $this->Model_errorpage->update($data, $datos->cedula);
                $this->session->set_flashdata('error', '<div class="alert alert-success text-center">Cambio realizado</div>');
                redirect(base_url() . "Inicio_page/login");
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Contraseñas no coinciden</div>');
                redirect(base_url() . "Inicio_page/Proceso/$user");
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Ya pasaron 3 minutos, vuelve a solicitar el codigo</div>');
            redirect(base_url() . "Inicio_page/olvidarContra");
        }
    }
    public function otroperfil($id)
    {
        $user = $this->Model_login->Perfil_2($id);
        if ($user != false) {
            $datos['master_usuarios'] = $user;
            $this->load->view('perfil2/perfil2', $datos);
        } else {
            $datos['master_usuarios'] = false;
            $this->load->view('perfil2/perfil2', $datos);
        }
    }

    public function contacto($id)
    {
        $user = $this->Model_login->Perfil_2($id);

        header('Cache-Control: public');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename=archivo.vcf');
        header('Content-Type: text/x-vcard');
        $str = 'BEGIN:VCARD
VERSION:3.0
N:' . $user->apellido1 . ';' . $user->nombre . '
FN:' . $user->nombre . ' ' . $user->apellido1 . '
PHOTO;VALUE=URL;https://www.ecomm.com.co/assets/img/fotosPerfil/' . $user->img_perfil . '
TEL;TYPE=HOME:' . $user->celular . '
EMAIL;TYPE:' . $user->correo . '
END:VCARD';
        echo $str;
    }

    public function inicio()
	{
		$this->load->view('vista_api');
	}
}

