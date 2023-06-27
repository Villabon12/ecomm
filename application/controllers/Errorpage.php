<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class errorpage extends CI_Controller {



  function __construct(){

    parent::__construct();

  }



  public function error($ban=null)

  {

    $this->load->view('view_error_loading');


  }

}

