<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	//metodo contructor 

	function __construct(){
		parent::__construct();
		// $this->load->model('model_registro');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function uno()
	{
		$this->load->view('welcome_message');
	}

}
