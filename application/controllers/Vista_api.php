<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vista_api extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
    public function index()
	{
		$this->load->view('vista_api');
	}
}