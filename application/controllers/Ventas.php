
<?php

defined('BASEPATH') or exit('No direct script access allowed');



class inicio_page extends CI_Controller

{

	function __construct()

	{
		parent::__construct();
		if ($this->session->userdata('is_logged_in')) {
		} else {
			redirect(base_url() . "index");
		}

		$this->load->model('comercio/Model_login');
		$this->load->model('comercio/Model_comercio');
		$this->load->model('model_errorpage');
		
	}
    
    protected function   index() {
		$this->load->view('/comercio/header');
		$this->load->view('/comercio/ventas/modal_ventas');
		$this->load->view('/comercio/footer');
    }
}