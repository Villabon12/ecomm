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

}