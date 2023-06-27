<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uecomm extends CI_Controller {

	//metodo contructor 

	function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('Ecommpay/home');
	}
	public function checkout()
	{
		$this->load->view('Ecommpay/checkout');

	}
}