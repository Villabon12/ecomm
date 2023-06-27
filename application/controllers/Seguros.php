<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Seguros extends CI_Controller

{

    function __construct()

    {
        parent::__construct();
        if ($this->session->userdata('is_logged_in')) {
            $this->load->model('Model_login');
            $this->load->model('Model_comercio');
            $this->load->model('Model_recargas');
            $this->load->model('model_errorpage');
            $this->load->model('Model_solicitudes');
            $this->load->model('Model_seguros');
        } else {
            redirect(base_url() . "Inicio_page");
        }
    }

    public function create_seguros()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Comercio') {

                $result['perfil'] = $this->Model_login->cargar_datos_comercio();
                $result['categorias'] = $this->Model_seguros->traer_categorias();
                $result['tb_seguros'] = $this->Model_seguros->traer_seguros_comer();
                $result['cotizaciones'] = $this->Model_seguros->traer_cotizaciones();

                $this->load->view('prueba_header', $result);

                $this->load->view('seguros/create_seguros', $result);

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
        } else {
            redirect("" . base_url() . "login/");
        }
    }
    public function insertdata($id)
    {

        $mi_archivo = 'img';
        $config['upload_path'] = './assets/img/seguros/';
        $config['allowed_types'] = "jpg|png|jpeg|pdf";
        $config['maintain_ratio'] = TRUE;
        $config['create_thumb'] = FALSE;
        $config['width'] = 800;
        $config['height'] = 800;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error al subir foto </div></center>');
            redirect(base_url() . "Seguros/create_seguros", "refresh");
        } else {
            $data = array("upload_data" => $this->upload->data());
            $imagen = $data['upload_data']['file_name'];
            $categoria = $this->input->post("categoria");
            $nombre = $this->input->post("nombre");

            $descripcion = $this->input->post("descripcion");
            $duracion = $this->input->post("duracion");
            $arre = array(
                "id_comercio" => $id,
                "img" => $imagen,
                "id_categoria" => $categoria,
                "nombre" => $nombre,
                "duracion" => $duracion,
                "descripcion" => $descripcion,
            );
            $this->Model_seguros->insert_seguro($arre);
            $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;">Registro exitoso</div></center>');
            redirect(base_url() . "Seguros/create_seguros", "refresh");
        }
    }
    public function seguros()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Socio') {

                $result['perfil'] = $this->Model_login->cargar_datos();
                $result['categorias'] = $this->Model_seguros->traer_categorias();
                $result['tb_seguros'] = $this->Model_seguros->traer_seguros();
                $result['ciudad'] = $this->Model_comercio->traerciudad1();

                $this->load->view('prueba_header', $result);

                $this->load->view('seguros/view_clientes', $result);

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
        } else {
            redirect("" . base_url() . "login/");
        }
    }
    public function insertcotizacion($id)
    {
        $datos_cliente = $this->Model_login->cargar_datos();
        $arre = array(
            "id_seguro" => $id,
            "id_cliente" => $datos_cliente->id,
        );
        $this->Model_seguros->insert_cotizacion($arre);
        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;">Registro exitoso</div></center>');
        redirect(base_url() . "Seguros/seguros", "refresh");
    }
    public function insertcotizacionautos($id)
    {
        $datos_cliente = $this->Model_login->cargar_datos();
        $arre = array(
            "id_seguro" => $id,
            "id_cliente" => $datos_cliente->id,
        );
        $this->Model_seguros->insert_cotizacion_autos($arre);
        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;">Registro exitoso</div></center>');
        redirect(base_url() . "Seguros/seguros", "refresh");
    }
    public function valida_seguros($id)
    {
        $mi_archivo = 'img';
        $config['upload_path'] = './assets/img/seguros/';
        $config['allowed_types'] = "jpg|png|jpeg|pdf";
        $config['maintain_ratio'] = TRUE;
        $config['create_thumb'] = FALSE;
        $config['width'] = 800;
        $config['height'] = 800;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error al subir Cotizacion </div></center>');
            redirect(base_url() . "Seguros/create_seguros", "refresh");
        } else {

            $valor=$this->input->post("valor");
            $prima=$this->input->post("prima");
            $porcentaje=$this->input->post("porcentaje");

            $data = array("upload_data" => $this->upload->data());
            $imagen = $data['upload_data']['file_name'];
            $arre = array(
                "estado" => 1,
                "img" => $imagen,
                "valor" => $valor,
                "porcentaje" => $porcentaje,
                "prima" => $prima,
            );
            $this->Model_seguros->update_seguros_cotizacion($id, $arre);
            $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;">proceso exitoso</div></center>');
            redirect(base_url() . "Seguros/create_seguros", "refresh");
        }
    }
    public function updatedata($id)
    {
        $nombre = $this->input->get("nombre");
        $stok = $this->input->get("stok");
        $descripcion = $this->input->get("descripcion");
        $duracion = $this->input->get("duracion");
        $arre = array(
            "nombre" => $nombre,
            "duracion" => $duracion,
            "cantidad" => $stok,
            "descripcion" => $descripcion,
        );
        $this->Model_seguros->update_seguros($id, $arre);
        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;">proceso exitoso</div></center>');
        redirect(base_url() . "Seguros/create_seguros", "refresh");
    }
    public function habilitar($id)
    {
        $arre = array(
            "estado" => 1,
        ); 
        $this->Model_seguros->update_seguros($id, $arre);
        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;">proceso exitoso</div></center>');
        redirect(base_url() . "Seguros/create_seguros", "refresh");
    }
    public function inhabilitar($id)
    {
        $arre = array(
            "estado" => 0,
        ); 
        $this->Model_seguros->update_seguros($id, $arre);
        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;">proceso exitoso</div></center>');
        redirect(base_url() . "Seguros/create_seguros", "refresh");
    }
}
