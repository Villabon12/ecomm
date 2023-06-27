<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Marketing extends CI_Controller

{

    function __construct()

    {
        parent::__construct();
        if ($this->session->userdata('is_logged_in')) {
            $this->load->model('Model_login');
            $this->load->model('Model_comercio');
            $this->load->model('Model_marketing');
            $this->load->model('model_errorpage');
        } else {
            redirect(base_url() . "index");
        }

    }
    public function inicio($id)
    {
        if ($this->session->userdata('is_logged_in')) {



            if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Comercio') {



                $result['perfil'] = $this->Model_login->cargar_datos();
                $result['paquetes'] = $this->Model_marketing->traerPaquetes();


                $this->load->view('prueba_header', $result);

                $this->load->view('marketing/info', $result);

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
        }
    }
}
