<?php
use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Ecommpay extends CI_Controller
{

	//metodo contructor 

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_login');
		$this->load->model('Model_ecommpay');
		$this->load->model('Model_email');
	}

	public function index()
	{
		$this->load->view('Ecommpay/home');
	}
	public function checkout()
	{
		$this->load->helper('cookie');
		if (get_cookie('mi_cookie_1') == NULL || get_cookie('mi_cookie_2') == NULL) {

			$valor_cookie1 = 0;

			$valor_cookie2 = 0;

		} else {

			$valor_cookie1 = get_cookie('mi_cookie_1');

			$valor_cookie2 = get_cookie('mi_cookie_2');

		}
		print_r($valor_cookie2);
		
		print_r($valor_cookie1);
		$this->load->view('Ecommpay/checkout');

	}
	public function sendData($valor1, $valor2)
	{
		$this->load->helper('cookie');

		$cookie_1 = array(

			'name' => 'mi_cookie_1',

			'value' => $valor1,

			'expire' => 86400,

		);
		$cookie_2 = array(

			'name' => 'mi_cookie_2',

			'value' => $valor2,

			'expire' => 86400,

		);
		set_cookie($cookie_1);

		set_cookie($cookie_2);


		$this->load->view('landing_page/inicio_sesion');

	}

	public function login($valor)
	{
		$this->load->helper('cookie');
		$cookie_1 = array(
			'name' => 'mi_cookie_1',
			'value' => $valor,
			'expire' => 86400,
		);
		set_cookie($cookie_1);

		$this->load->view('landing_page/inicio_sesion');
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
				'is_logged_in' => TRUE,
			);
			$this->session->set_userdata($session);
			if ($datos_user->tipo == 'Socio') {
				if ($this->session->userdata('is_logged_in')) {
					redirect(base_url() . "confirm/api");
				}
			}
			//
		} else {
			//en caso contrario mostramos el error de usuario o contraseña invalido
			$this->session->set_flashdata('error', '<script>alert("contraseña incorrecta")</script>');
			redirect(base_url() . "Ecommpay/sendData/10734/20000");
		}
	}
	public function modalConfirm()
	{
		$this->load->helper('cookie');

		if (get_cookie('mi_cookie_1') == NULL) {
			$valor_cookie1 = 0;
		} else {
			$valor_cookie1 = get_cookie('mi_cookie_1');
		}
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['valor'] = $valor_cookie1;
		$this->load->view('Ecommpay/modalConfirm', $result);
	}
	public function acceptPay()
	{
		$this->load->library('curl');
		$this->load->helper('cookie');
		$result['perfil'] = $this->Model_login->cargar_datos();
		$id_usuario=$result['perfil']->id;
		if (get_cookie('mi_cookie_1') == NULL) {
			$valor_cookie1 = 0;
		} else {
			$valor_cookie1 = get_cookie('mi_cookie_1');
		}

		$url = 'www.ecomm.com.co/api/ecommpay/search';
		$api = '2zPZv40Xr3Hth1AgpxY9ucodbjyUV6fSQET7kWes';
		$ScKey = 'iI9cwWFhHsOyUmEXv3JP';
		$datos = array(
			'apikey' => $api,
			'secretkey' => $ScKey,
			'valor' => $valor_cookie1,
			'id_usuario'=>$id_usuario
		);
		$curl = curl_init();
		curl_setopt_array(
			$curl,
			array(
				CURLOPT_URL => $url,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => http_build_query($datos),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_SSL_VERIFYHOST => false
			)
		);
		$response = curl_exec($curl);
		if (!$response) {
			$error = curl_error($curl);
			// Manejar el error
		} else {
			$datos = json_decode($response, true);
			$msj = $datos['msj'];

			if ($msj == "Success") {

				$this->session->set_flashdata('error', ' <center><div class="alert alert-success align-items-center d-flex" style="width: 1000px;"> Proceso exitoso </div></center> ');
				$this->session->set_flashdata('error', ' <script>window.close();</script> ');

				redirect(base_url() . "confirm/api", "refresh");
			} else {
				$this->session->set_flashdata('error', ' <center><div class="alert alert-danger align-items-center d-flex" style="width: 1000px;"> Error, no se encuentra el negocio en sistema </div></center> ');
				redirect(base_url() . "confirm/api", "refresh");
			}
		}
		curl_close($curl);

	}
	public function OptenerApikey()
	{
		$Comercio = $this->Model_login->cargar_datos_comercio();
		$idComercio = $Comercio->id;
		$infoStatues = $this->Model_ecommpay->estadoRegisto($idComercio);

		//validacion si exite ya esa Apikey
		if ($infoStatues->contar != 0) {
			echo "Error usted ya tiene un boton de Ecommpay generado ";
		} else {
			$porcentaje = $this->input->post('porcentaje');
			$this->load->library('encryption');
			$this->encryption->initialize(array('key' => 'tu_clave_de_cifrado_segura'));
			$codigo = $this->generateRandomString(40);
			$secretKey = $this->generateRandomString(20);

			$arre = array(
				"id_comercio" => $idComercio,
				"porcentaje" => $porcentaje,
				"apikey" => md5($codigo),
				"secretkey" => $secretKey
			);
			$this->Model_ecommpay->insertNewUser($arre);
			//respuesta
			echo "IMPORTANTE : Copiar estas credenciales ya que son unicas y solo podra verlas en este momento <br/><br/>";
			echo " Proceso exitoso , su ApiKey es: <br/><br/>";
			echo $codigo . "<br/><br/>";
			echo "su SecretKey es:  <br/><br/>";
			echo $secretKey;
		}

	}
	function generateRandomString($length)
	{
		return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
	}
}