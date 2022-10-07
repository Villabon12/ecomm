<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class correo extends CI_Controller {



    function __construct(){

        parent::__construct();

        $this->load->model('model_login');

        $this->load->model('model_correo');

        $this->load->model('model_payments');

        $this->load->model('model_errorpage');

        $this->load->model('model_sales');

    }





    public function index($ban=null)

    {

        if($this->session->userdata('is_logged_in')){

            if ($this->session->userdata('ROL')=='adminMultinivel' || $this->session->userdata('ROL')=='Multinivel') {

                $usuario=$this->session->userdata('ID');

                $result['correos']=$this->model_correo->consultaCorreos($usuario);

                $this->load->view('multinivel/header_admin');

                $this->load->view('multinivel/view_historial_correos',$result);

                $this->load->view('multinivel/footer_admin');

            }else {

                $intruso=array(

                    'id_usuario'=>$this->session->userdata('ID'),

                    'texto'=>'view_historial_correos',

                    'fecha_registro'=>date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("".base_url()."errorpage/error");

            }

        }else {

            redirect("".base_url()."login/");

        }

    }



    public function editarCorreo()

    {

        if($this->session->userdata('is_logged_in')){

            if ($this->session->userdata('ROL')=='adminMultinivel' || $this->session->userdata('ROL')=='Multinivel') {

                $id = $this->input->post('id');



                $dia = $this->input->post('dia');

                $asunto = $this->input->post('asunto');

                $mensaje = $this->input->post('mensaje');



                $this->model_correo->actualizarCorreo($id, $dia, $asunto, $mensaje);



                redirect("".base_url()."correo/index");

            }else {

                $intruso=array(

                    'id_usuario'=>$this->session->userdata('ID'),

                    'texto'=>'view_historial_correos',

                    'fecha_registro'=>date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("".base_url()."errorpage/error");

            }

        }else {

            redirect("".base_url()."login/");

        }

    }



    /* Función para restaurar los parámetros de webinar registro */

    public function restaurarCorreo ()

    {

        if($this->session->userdata('is_logged_in')) {

            $id_usuario = $this->input->post('id_usuario');

            $misCorreos = $this->model_correo->consultaCorreos($id_usuario);



            if(!empty($misCorreos)){

                $this->model_correo->eliminarCorreos($id_usuario);

            }



            $id_negocio = $this->input->post('id_negocio');

            $id_admin = $this->model_payments->conAdministradorNegocio($id_negocio);

            $correosAdmin = $this->model_correo->consultaCorreos($id_admin);

            $correosArray = array();



            foreach ($correosAdmin as $datos_aux){

                $datos = array(

                    'id_usuario' => $id_usuario,

                    'id_negocio' => $datos_aux->id_negocio,

                    'id_landing' => $datos_aux->id_landing,

                    'dia' => $datos_aux->dia,

                    'asunto' => $datos_aux->asunto,

                    'mensaje' => $datos_aux->mensaje

                );



                array_push($correosArray,$datos);



            }

            //var_dump($datos);

            $this->model_correo->insertar_correo_restaurado($correosArray);





            redirect(base_url()."correo/index",'refresh');

        } else {

            redirect("".base_url()."login/");

        }

    }







    /* correo masivo => para negocios */

    public function masivosNegocio(){

        if($this->session->userdata('is_logged_in')){

            if ($this->session->userdata('ROL')=='adminMultinivel' || $this->session->userdata('ROL')=='Multinivel') {

                $id=$this->session->userdata('ID');



                $id_negocio = 2;



                $result['dias'] = $this->model_payments->diasMemb();

                $result['precio'] = $this->model_payments->precioNegocio(2);

                $result['pixeles']=$this->model_payments->pixeles($id);

                $result['eventos']=$this->model_payments->consCiudadEvento($id);

                $result['registrados'] = $this->model_payments->cantidadRegistradosLanding($id);

                $result['cantpagos'] = $this->model_login->num_pagos();



                $this->load->view('multinivel/header_admin');

                $this->load->view('multinivel/view_correo_masivo',$result);

                $this->load->view('multinivel/footer_admin');

            }else {

                $intruso=array(

                    'id_usuario'=>$this->session->userdata('ID'),

                    'texto'=>'view_landings',

                    'fecha_registro'=>date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("".base_url()."Errorpage/error");

            }

        }else {

            redirect("".base_url()."login/");

        }

    }



     /* correo masivo => para negocios */

     public function masivosNegocio_tiindo(){

        if($this->session->userdata('is_logged_in')){

            if ($this->session->userdata('ROL')=='multinivelTiindo' || $this->session->userdata('ROL')=='Multinivel') {

                $id=$this->session->userdata('ID');



                $id_negocio = 2;



                $result['dias'] = $this->model_payments->diasMemb();

                $result['precio'] = $this->model_payments->precioNegocio(2);

                $result['pixeles']=$this->model_payments->pixeles($id);

                $result['eventos']=$this->model_payments->consCiudadEvento($id);

                $result['registrados'] = $this->model_payments->cantidadRegistradosLanding($id);

                $result['cantpagos'] = $this->model_login->num_pagos();



                $this->load->view('menu/header_all');

                $this->load->view('tiindo/view_correo_masivo',$result);

                $this->load->view('menu/footer_all');

            }else {

                $intruso=array(

                    'id_usuario'=>$this->session->userdata('ID'),

                    'texto'=>'view_landings',

                    'fecha_registro'=>date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("".base_url()."Errorpage/error");

            }

        }else {

            redirect("".base_url()."login/");

        }

    }



     /* correo masivo => para negocios */

     public function masivosNegocio_enviar(){

        if($this->session->userdata('is_logged_in')){

            if ($this->session->userdata('ROL')=='adminMultinivel' || $this->session->userdata('ROL')=='Multinivel') {

                $id=$this->session->userdata('ID');



                $id_negocio = 2;



                $result['dias'] = $this->model_payments->diasMemb();

                $result['precio'] = $this->model_payments->precioNegocio(2);

                $result['pixeles']=$this->model_payments->pixeles($id);

                $result['eventos']=$this->model_payments->consCiudadEvento($id);

                $result['registrados'] = $this->model_payments->cantidadRegistradosLanding($id);

                $result['cantpagos'] = $this->model_login->num_pagos();

                $result['ventas'] = $this->model_sales->registradosView_dist();



                $this->load->view('multinivel/header_admin');

                $this->load->view('multinivel/view_correo_enviar_masivo',$result);

                $this->load->view('multinivel/footer_admin');

            }else {

                $intruso=array(

                    'id_usuario'=>$this->session->userdata('ID'),

                    'texto'=>'view_landings',

                    'fecha_registro'=>date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("".base_url()."Errorpage/error");

            }

        }else {

            redirect("".base_url()."login/");

        }

    }



    /* correo masivo => para negocios */

    public function historialMasivos(){

        if($this->session->userdata('is_logged_in')){

            if ($this->session->userdata('ROL')=='adminMultinivel' || $this->session->userdata('ROL')=='Multinivel') {

                $usuario=$this->session->userdata('ID');

                $result['correos']=$this->model_correo->consultaCorreos($usuario);

                $this->load->view('multinivel/header_admin');

                $this->load->view('multinivel/view_historial_correos',$result);

                $this->load->view('multinivel/footer_admin');

            }else {

                $intruso=array(

                    'id_usuario'=>$this->session->userdata('ID'),

                    'texto'=>'view_historial_correos',

                    'fecha_registro'=>date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("".base_url()."errorpage/error");

            }

        }else {

            redirect("".base_url()."login/");

        }

    }



     /* correo masivo => para negocios */

     public function historialMasivos_tiindo(){

        if($this->session->userdata('is_logged_in')){

            if ($this->session->userdata('ROL')=='multinivelTiindo' || $this->session->userdata('ROL')=='Multinivel') {

                $usuario=$this->session->userdata('ID');

                $result['correos']=$this->model_correo->consultaCorreos($usuario);

                $this->load->view('menu/header_all');

                $this->load->view('tiindo/view_historial_correos',$result);

                $this->load->view('menu/footer_all');

            }else {

                $intruso=array(

                    'id_usuario'=>$this->session->userdata('ID'),

                    'texto'=>'view_historial_correos',

                    'fecha_registro'=>date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("".base_url()."errorpage/error");

            }

        }else {

            redirect("".base_url()."login/");

        }

    }



    /* Función para guardar los parámetros de correo masivo */

    public function guardarMasivoLibertad ($user = NULL)

    {

        if($this->session->userdata('is_logged_in')) {

            $datos = array(

                'id_usuario'    => $this->input->post('id_usuario'),

                'id_negocio'    => $this->input->post('id_negocio'),

                'id_landing'    => $this->input->post('id_landing'),

                'dia'        => $this->input->post('dia'),

                'asunto'   => $this->input->post('asunto'),

                'mensaje'   => $this->input->post('mensaje')

            );



            $creado = $this->model_correo->inserta_correo_negocio($datos);



            redirect(base_url()."minegocio/correos",'refresh');

        } else {

            redirect("".base_url()."login/");

        }

    }



     /* Función para guardar los parámetros de correo masivo */

     public function enviaMasivoLibertad ($user = NULL)

     {

         if($this->session->userdata('is_logged_in')) {

             $datos = array(

                 'id_usuario'    => $this->input->post('id_usuario'),

                 'id_negocio'    => $this->input->post('id_negocio'),

                 'id_landing'    => $this->input->post('id_landing'),

                 'dia'        => $this->input->post('dia'),

                 'asunto'   => $this->input->post('asunto'),

                 'mensaje'   => $this->input->post('mensaje')

             );

 

             $creado = $this->model_correo->inserta_correo_negocio($datos);

 

             redirect(base_url()."minegocio/correos",'refresh');

         } else {

             redirect("".base_url()."login/");

         }

     }

}



