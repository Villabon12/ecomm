<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Inicio_page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'login';
$route['olvidar'] = 'Login/recupera-contra';
$route['ingreso'] = 'Login/ingreso';
$route['principal_p'] = 'Login/principal_p';
$route['curso_p'] = 'Login/curso';

/* rompezabeza */
$route['puzzle/(:any)'] = 'puzzle/game/$1';   



$route['classgo/(:any)'] = 'landing/registro/$1';
$route['classgo/registro/(:any)'] = 'landing/registroClass/$1';
$route['ingreso/(:any)'] = 'landing/registroClass/$1';
$route['classgo/evento/(:any)'] = 'landing/eventoClass/$1';
$route['registro/academy/(:any)'] = 'Payments/freeRegisterTiindoAcademy/$1';
$route['registro/academy/ingreso/(:any)'] = 'Payments/freeRegisterTiindoAcademyIngreso/$1';

//rutas Siemst
$route['siemst/empresa'] = 'landing/registroEmpresa';
$route['siemst/empleado/(:any)'] = 'landing/registroEmpleado/$1';
$route['siemst/registeEempresa'] = 'payments/registerEmpresaSiemst';
$route['siemst/registeEmpleado'] = 'payments/registerEmpleadoSiemst';
$route['siemst/home'] = 'Login/home_admin_sm';
$route['siemst/perfil_empresa'] = 'user/siemst_perfil_empresa';

// fin rutas Siemst

$route['academy/home'] = 'Login/home_admin_academia';
$route['academy/capacitacion'] = 'product/indexproductos';

//inicio rutas multinivel privado
$route['multnivel/home'] = 'Login/home_admin_multinivel';
$route['minegocio'] = 'Product/indexNegocio';
$route['minegocio/landings'] = 'Payment/landingsNegocios';
$route['minegocio/correos'] = 'Correo/masivosNegocio';
$route['minegocio/envia'] = 'Correo/masivosNegocio_enviar';
$route['minegocio/ecommerce'] = 'admin_negocio/configtienda';
$route['minegocio/testimonios'] = 'admin_negocio/configtestimonios';
$route['minegocio/pago']   = 'payments/realizar_pago';
$route['minegocio/mipago']   = 'payments/realiza_pago_tiindo';
$route['minegocio/historial-correos'] = 'Correo/historialMasivos';
$route['minegocio/registro/(:any)'] = 'landing/registroLibertad/$1';
$route['minegocio/medal/(:any)'] = 'landing/registronegocio/$1';     

$route['asesoria/(:any)'] = 'landing/registroLibertad/$1';
$route['minegocio/registrar/(:any)'] = 'payments/freeRegisterLandingLibertad/$1';
$route['minegocio/reparte/(:any)/(:any)/(:any)'] = 'payments/confirma_pago/$1/$2/$3';
$route['minegocio/pagosaldo/(:any)/(:any)/(:any)'] = 'payments/confirma_pago_saldo/$1/$2/$3';
$route['minegocio/langracias/(:any)'] = 'landing/registroGraciasLibertad/$1';

$route['tienda/(:any)'] = 'landing/registroGraciasLibertadDos/$1';
$route['libertad/gracias/(:any)/(:any)'] = 'landing/registroGraciasLibertadDos/$1/$2';
$route['minegocio/webinar/(:any)'] = 'landing/webinarLibertad/$1';
$route['minegocio/webgracias/(:any)'] = 'landing/registroGraciasWebinarLibertad/$1';
$route['minegocio/webregistro/(:any)'] = 'payments/freeRegisterWebinarLibertad/$1';
$route['minegocio/perfil'] = 'user/minegocio_perfil';
$route['minegocio/referido/(:any)'] = 'landing/registroReferido/$1';
$route['registro/(:any)'] = 'landing/registroReferido/$1';
$route['registrar/(:any)'] = 'landing/registroReferido_promo/$1';
$route['minegocio/gracias/(:any)'] = 'Landing/registroGraciasLibertad/$1';

$route['adminNegocio']='admin_negocio';
$route['negocio/pqr']='admin_negocio/respuestas';
$route['negocio/atencion']='admin_reclamos';

$route['negocio/registrados']='admin_negocio/consultaRegistrados';
$route['negocio/modifica/parametros']='admin_negocio/modificaParametros';
$route['negocio/membership']='Admin_negocio_members';
$route['negocio/pagos']='admin_negocio_payments/pagoMembresia';
$route['capacitacion/avanzado']='Product/indexCapacitacionAvanzado';

//fin multinivel privado

//inicio rutas multiApp privado
$route['multiapp/home'] = 'Login/home_admin_multiapp';
$route['negocio/(:any)'] = 'landing/multi_invita/$1';
$route['evento/(:any)/(:any)'] = 'landing/multi_invita/$1/$2';
$route['appclass/(:any)/(:any)'] = 'landing/appilo/$1/$2';

/* INICIO RUTAS MULTIAPPS */
$route['multiapps/countdown'] = 'multiapp/countdown';
$route['multiapps/primerpaso'] = 'multiapp/primerpaso';
$route['multiapps/segundopaso'] = 'multiapp/segundopaso';
/* FIN RUTAS MULTIAPPS */
       
//inicio rutas multinivelTiindo   
$route['backoffice/home'] = 'Login/home_multinivel_tiindo';
$route['register/(:any)'] = 'Landing/registroReferido_tiindo/$1';
$route['invita/(:any)'] = 'Landing/prospecta_tiindo/$1';
$route['invita/zoom/(:any)'] = 'Landing/prospecta_zoom_tiindo/$1';
$route['invita/zoom/registrar/(:any)'] = 'Payments/freeRegisterProspecto_tiindo/$1';
$route['invita/gracias/(:any)'] = 'Landing/prospecta_zoom_gracias_tiindo/$1';
 
$route['searchuser'] = 'Landing/pide_user_tiindo';
$route['redirect'] = 'Landing/prospecta_registrar_tiindo';
   
$route['backoffice/register/(:any)'] = 'Landing/registroReferido_user_tiindo/$1'; 
$route['backoffice/premio/(:any)'] = 'Landing/reclama_premio_tiindo/$1'; 
$route['registrando/(:any)'] = 'Payments/freeRegisterReferido_tiindo/$1'; // formulario de registro
$route['backoffice/perfil'] = 'user/minegocio_perfil_tiindo';
$route['backoffice/pay'] = 'Admin_negocio_payments/pago_seguro_cliente_tiindo';
$route['backoffice/paysecurity'] = 'Admin_negocio_payments/reparte_negocios_clie_tiindo/';
$route['backoffice/membership']='Admin_negocio_members/membership_tiindo';
$route['backoffice/correos'] = 'Correo/masivosNegocio_tiindo';
$route['backoffice/historial-correos'] = 'Correo/historialMasivos_tiindo';
$route['backoffice/ecommerce'] = 'admin_negocio/configtienda_tiindo';
$route['backoffice/testimonios'] = 'admin_negocio/configtestimonios_tiindo';
$route['backoffice/wallet'] = 'wallet/wallet_tiindo';
$route['backoffice/business'] = 'Product/indexNegocio_tiindo';
$route['backoffice/business/landing'] = 'payment/landingsNegocios_tiindo';
$route['backoffice/registrados'] = 'Sales/consultaRegistradosTiindo';
$route['backoffice/creaproducto'] = 'user/minegocio_crea_producto_tiindo';
$route['backoffice/addproduct'] = 'user/addproduct_tiindo';
$route['backoffice/listacompras'] = 'user/consultaCompras_user_Tiindo';
$route['backoffice/listaproductos'] = 'user/consultaProductos_user_Tiindo';
$route['backoffice/modulos/(:any)'] = 'modulos/modulos_afiliado_tiindo/$1';
$route['backoffice/agregamodulo'] = 'modulos/agrega_modulo_tiindo';
$route['backoffice/editamodulo/(:any)'] = 'modulos/edit_modulo_tiindo/$1';
$route['backoffice/actmodulo'] = 'modulos/actModul_tiindo';
$route['backoffice/addvideomodulo'] = 'modulos/insertVideo_modulos_tiindo';
$route['backoffice/editvideomodulo/(:any)'] = 'modulos/edita_video_modulo_tiindo/$1';
$route['backoffice/actvideomodulo'] = 'modulos/actVideo_video_mod_tiindo';        
$route['backoffice/editarchivo'] = 'modulos/addArchivo_mod_tiindo';        
$route['backoffice/mercado'] = 'product/mercado_tiindo';        
$route['backoffice/curso'] = 'product/curso_tiindo';        
$route['backoffice/curso/avanzado']='Product/cursoMDtiindoAvanzado';
$route['backoffice/curso/basico']='product/cursoMDtiindoBasico';



/* FIN RUTAS Multiniveltiindo */

$route['api/'] = 'Ecommpay/pide_user_tiindo'; 

/* RUTAS PARA ECOMM */
$route['comercio/perfil'] = 'Perfil/perfilcomer';
$route['wallet'] = 'comercio';

$route['parametros'] = 'comercio/config_parametros';
$route['recargas/observacion'] = 'comercio/historial_recargas';
$route['datos/socios'] = 'Validacion/verificar_user';
$route['datos/comercios'] = 'Validacion/verificar_comer';
$route['solicitudes/admin'] = 'Solicitudes/solicitudesAdmin';

/* RUTAS PARA SOCIOS */
$route['cupones/categorias/(:any)'] = 'comercio/cuponescate/$1';
$route['cupones'] = 'comercio/cupones';
$route['seguros'] = 'Seguros/seguros';
$route['tarjetas'] = 'Tarjetas/view_tarjetas';
$route['team'] = 'comercio/binario';
$route['compras'] = 'Proceso/compras';

$route['perfil'] = 'Perfil/perfil';

//RUTAS PARA PROCESO DE ECOMMPAY
$route['open/api/(:any)'] = 'Ecommpay/login/$1';

$route['confirm/api'] = 'Ecommpay/modalConfirm';

