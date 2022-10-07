<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class model_wallet extends CI_Model {



  function __construct(){

    parent::__construct();

  }

  public function consulta_consecutivo(){

    $query_admin = $this->db->get_where("master_pagina_conf", array("url" => "9450") );

    $consecutivo= $query_admin->row()->parametro;

    return $consecutivo;

  }

  public function infoUser(){

    $usuario=$this->session->userdata('USUARIO');

    $sql="SELECT * from master_usuarios u where u.correo='$usuario'";

    $query=$this->db->query($sql);

    return $query->row();

  }



  public function consultaParametro(){

    $sql="SELECT * FROM master_pagina_conf WHERE id IN(5,6,7,23,28);";

    $query=$this->db->query($sql);

    return $query->result();

  }



  public function cantSocios(){

    $sql="SELECT id, porcent_socio FROM master_usuarios WHERE (tipo='Socio' || tipo='Ultra')";

    $query=$this->db->query($sql);

    return $query->result();

  }





  public function consultaTransferencia(){

    $usuario=$this->session->userdata('ID');

    $sql="SELECT mt.* , met.estado, mb.banco,(SELECT parametro

					FROM master_pagina_conf mpc

					WHERE mpc.id=mt.id_cobro_tipo_tranfer) AS porcent_transfe

				    ,(SELECT parametro

					FROM master_pagina_conf mpc

					WHERE mpc.id=mt.id_cobro_adicional) AS porcent_adicional

          ,(SELECT descri

					FROM master_pagina_conf mpc

					WHERE mpc.id=mt.id_cobro_tipo_tranfer) AS descri_transfe

				    ,(SELECT descri

					FROM master_pagina_conf mpc

					WHERE mpc.id=mt.id_cobro_adicional) AS descri_adicional

    FROM master_transferencia mt, master_estados_transfer met, master_bancos mb

    WHERE id_usuario='$usuario'

    AND mt.id_estado=met.id

 AND mb.id= mt.id_banco_entidad

 ORDER BY 1 DESC;

    ";



    $query=$this->db->query($sql);

    return $query->result();

  }



  public function consultaPais(){

    $sql="SELECT * from pais";

    $query=$this->db->query($sql);

    return $query->result();

  }

  public function inserta_pedido($data_pedido){

    $this->db->insert("master_pedido", $data_pedido);

    return $this->db->insert_id();

  }



  public function inserta_cliente_pedido($data_cliente){

    $this->db->insert("master_nacional", $data_cliente);

    return $this->db->insert_id();



  }



  public function consult_pedido($id_producto,$email_user){

    $sql = "select * from master_pedido";

    $query_admin = $this->db->query($sql);

    return $query_admin->result();

  }



  public function con_pedido($cod_pedido=NULL,$id_pedido=NULL){

    $sql = "SELECT * FROM master_pedido WHERE cod_pedido='".$cod_pedido."' AND id_usuario='".$id_pedido."';";

    $query_admin = $this->db->query($sql);

    return $query_admin->result();

  }



  public function averigua_dueno_producto($id_producto){



    #calcula valor de la promocion

    $sql = "SELECT id_usuario

    FROM master_producto

    WHERE id_producto=".$id_producto.";";

    $query_admin = $this->db->query($sql);



    ##if ($query_admin->num_rows() >= 1){

    $id_usuario= $query_admin->row()->id_usuario;



    ##}

    return $id_usuario;

  }



  public function cmoneda($idproducto){



    #calcula valor de la promocion

    $sql = "SELECT moneda FROM  master_producto  WHERE id_producto=".$idproducto.";";

    $query_admin = $this->db->query($sql);



    ##if ($query_admin->num_rows() >= 1){

    $moneda= $query_admin->row()->moneda;



    ##}

    return $moneda;

  }



  public function porcentajeV($idproducto){



    #calcula valor de la promocion

    $sql = "SELECT porcentaje_vendedor FROM  master_producto  WHERE id_producto=".$idproducto.";";



    $query_admin = $this->db->query($sql);

    $porcentaje= $query_admin->row()->porcentaje_vendedor;





    return $porcentaje;

  }



  public function consultaVendedor($idusuario){



    #calcula valor de la promocion

    $sql = "SELECT id_vendedor FROM master_nacional WHERE id=".$idusuario.";";

    $query_admin = $this->db->query($sql);



    ##if ($query_admin->num_rows() >= 1){

    $id_vendedor= $query_admin->row()->id_vendedor;



    ##}

    return $id_vendedor;

  }



  public function consultaFechacorte($fecha){



    #calcula valor de la promocion

    $sql = "SELECT mcp.fin_corte, DATE_FORMAT(DATE_ADD(mcp.fin_corte, INTERVAL +14 DAY),'%Y-%m-%d') AS fecha_pago

    FROM master_corte_pagos mcp

    WHERE DATE_FORMAT('".$fecha."','%Y-%m-%d')

    BETWEEN DATE_ADD(mcp.fin_corte, INTERVAL -6 DAY)

    AND mcp.fin_corte;";

    $query_admin = $this->db->query($sql);



    ##if ($query_admin->num_rows() >= 1){

    $fecha_corte= $query_admin->row()->fin_corte;

    $fecha_pago= $query_admin->row()->fecha_pago;



    ##}

    return $fecha_corte;

  }



  public function consultaFechapago($fecha){



    #calcula valor de la promocion

    $sql = "SELECT mcp.fin_corte, DATE_FORMAT(DATE_ADD(mcp.fin_corte, INTERVAL +14 DAY),'%Y-%m-%d') AS fecha_pago

    FROM master_corte_pagos mcp

    WHERE DATE_FORMAT('".$fecha."','%Y-%m-%d')

    BETWEEN DATE_ADD(mcp.fin_corte, INTERVAL -6 DAY)

    AND mcp.fin_corte;";

    $query_admin = $this->db->query($sql);



    ##if ($query_admin->num_rows() >= 1){

    $fecha_corte= $query_admin->row()->fin_corte;

    $fecha_pago= $query_admin->row()->fecha_pago;



    ##}

    return $fecha_pago;

  }



  public function consul_cuenta_payU($var){

    $query_usuario = $this->db->get_where("master_config_payu", array("id" => 1) );

    if ($var=='accountId' || $var=='merchantId' || $var='ApiKey'){

      return $query_usuario->row()->$var;

    }

  }





  public function ventas_semanales(){

    $id_login = $this->session->userdata('ID');

    #calcula valor de la promocion

    $sql = "SELECT DATE_FORMAT(DATE_ADD(mcp.fin_corte, INTERVAL -6 DAY),'%Y-%m-%d') AS inicio,

    DATE_FORMAT(mcp.fin_corte,'%Y-%m-%d') AS fin,

    round(SUM(mc.cantidad),0)AS ganancia, mcp.semana,mc.estado,

    DATE_FORMAT(DATE_ADD(mcp.fin_corte, INTERVAL +7 DAY),'%Y-%m-%d') AS pago, mc.id_usuario,mu.nombre AS nombre ,mu.apellido1 AS apellido,

    mu.numero_cuenta, mu.tipo_cuenta,mu.cedula, mu.banco

    FROM master_comisiones mc, master_corte_pagos mcp, master_usuarios mu

    WHERE mc.fecha_comision BETWEEN DATE_ADD(mcp.fin_corte, INTERVAL -6 DAY) AND DATE_ADD(mcp.fin_corte, INTERVAL +1 DAY)

    AND mc.estado=1

    AND mc.id_usuario= mu.id

    GROUP BY mc.id_usuario ORDER BY mcp.semana DESC;";

    $query_admin = $this->db->query($sql);



    return $query_admin->result();

  }



  public function walletuser(){

    $id_login = $this->session->userdata('ID');

    $sql="SELECT DATE_FORMAT(DATE_ADD(mc.fecha_comision, INTERVAL +0 DAY),'%Y-%m-%d') AS fecha_comision,

    ROUND(SUM(mc.cantidad),0)AS ganancia,mc.estado,

    mc.id_usuario,mu.nombre AS nombre ,mu.apellido1 AS apellido,

    mu.numero_cuenta, mu.tipo_cuenta,mu.cedula, mu.banco, mu.cuenta_paypal

    FROM master_comisiones mc, master_usuarios mu

    WHERE mc.estado=1

    AND mc.id_usuario= mu.id

    AND mu.id=$id_login

    GROUP BY fecha_comision,mc.id_usuario ORDER BY fecha_comision DESC;";

    $query_admin = $this->db->query($sql);



    return $query_admin->result();

  }









  public function addTransfer($estado,$valor,$name,$identification,$banco,$tipeacc,$numacc,$option){

    $id=$this->session->userdata('ID');

    $this->db->insert('master_transferencia',array('estado'=>$estado,'id_usuario'=>$id, 'titular_cuenta'=>$name,'tipo_transfer'=>$option, 'monto'=>$valor, 'tipo_cuenta'=>$tipeacc, 'cuenta'=>$numacc, 'banco_entidad'=>$banco, 'identificacion'=>$identification));

  }



  public function addTransferPay($estado,$valor,$banco,$acc,$option){

    $id=$this->session->userdata('ID');

    $this->db->insert('master_transferencia',array('estado'=>$estado,'id_usuario'=>$id,'tipo_transfer'=>$option, 'monto'=>$valor, 'cuenta'=>$acc, 'banco_entidad'=>$banco));

  }



  public function addAccountpaypal($data){

    $this->db->insert('master_config_paypal', $data);

  }

  public function updateAccountpaypal($data){





    $Idusuario=$this->session->userdata('ID');

    $this->db->where(array("id_usuario" => $Idusuario))->update("master_config_paypal", $data);

  }



  public function consultapaypal(){

    $Idusuario=$this->session->userdata('ID');

    $sql="select count(*) as cant from master_config_paypal where id_usuario='$Idusuario' ";

    $query = $this->db->query($sql);

    return  $query->row()->cant;



  }



  public function infoBank(){

    $usuario=$this->session->userdata('USUARIO');

    $sql="SELECT * from master_usuarios where correo='$usuario'";

    $query=$this->db->query($sql);

    return $query->row();

  }



  public function listaBanco(){

    $sql="SELECT * from master_bancos";

    $query=$this->db->query($sql);

    return $query->result();

  }



  public function listaTypB(){

    $sql="SELECT * from master_bancos_tipoacc order by tipo_cuenta";

    $query=$this->db->query($sql);

    return $query->result();



  }

  public function listaPaypal(){

    $usuario=$this->session->userdata('ID');

    $sql="SELECT cuenta_paypal from master_config_paypal where id_usuario='$usuario'";

    $query=$this->db->query($sql);

    return $query->row();

  }

  public function opcionPago(){

    $sql="SELECT * FROM master_pagina_conf WHERE id IN(9,10,21,22,11,12);";

    $query=$this->db->query($sql);

    return $query->result();

  }



  public function calrestawallet($cantidad){

    $usuario=$this->session->userdata('ID');

    $sql="SELECT

    ROUND(SUM(mc.cantidad),0)-$cantidad  AS restwallet

    FROM master_comisiones mc

    WHERE mc.estado=1

    AND mc.id_usuario=$usuario

    GROUP BY mc.id_usuario ORDER BY fecha_comision DESC;";

    $query=$this->db->query($sql);

    if (!empty($query->row()->restwallet)){

      $saldo=$query->row()->restwallet;

    }else {

      $saldo=0;

    }



    return $saldo;



  }



  public function walletmovi(){

    $id=$this->session->userdata('ID');

    $sql="SELECT mc.id_usuario AS id,mc.fecha_comision AS fecha ,round(mc.cantidad,2) AS valor, 'en' AS tipo,

    mc.tipo_comision AS motivo, mu.user AS cuenta, mc.fecha_pago AS fechafin, CONCAT('ClassGo: ',muu.user) AS transmite

    FROM master_comisiones mc, master_usuarios mu, master_usuarios muu

    WHERE mc.id_usuario='$id' AND mc.id_usuario=mu.id

    AND mc.tipo='CLassgo' AND mc.id_usuario_realiza=muu.id

    UNION

    SELECT mt.id_usuario AS id,mt.fecha_registro AS fecha ,mt.monto_total AS valor, 'sa' AS tipo, 'Transferencia' AS motivo,

    mt.cuenta AS cuenta,mt.fecha_pago AS fechafin, CONCAT(mb.banco,': ',mt.cuenta) AS transmite

    FROM master_transferencia mt, master_bancos mb, master_usuarios mu

    WHERE mt.id_usuario='$id'

    AND mt.id_banco_entidad=mb.id

    UNION

    SELECT mp.id_usuario AS id,mp.fecha_pago AS fecha ,mp.monto_pagado AS valor, 'sa' AS tipo, mp.tipo AS motivo,

    mp.cuenta_transfiriente AS cuenta,mp.fecha_pago AS fechafin, 'Tiindo' AS transmite

    FROM master_pagos mp, master_bancos mb

    WHERE mp.id_usuario='$id'

    AND mp.id_banco='3'

    ORDER BY fecha DESC;

    ";

    $query=$this->db->query($sql);

    return $query->result();

  }



  public function consulporcent($num){

  $sql="SELECT parametro FROM master_pagina_conf WHERE id='$num'";

  $query=$this->db->query($sql);

  return $query->row()->parametro;

  }



  public function inserttrans($data){

    $this->db->insert("master_transferencia", $data);

		return $this->db->insert_id();

  }

  public function insertcomi($data){

    $this->db->insert("master_comisiones", $data);

		return $this->db->insert_id();

  }


  public function insertcomi1($inserta_transferD){

    $this->db->insert("master_comisiones", $inserta_transferD);

    return $this->db->insert_id();

  }

  public function insertwallet($data){

    $this->db->insert("master_wallet", $data);

    return $this->db->insert_id();

  }
  public function insertwallet1($data){

    $this->db->insert("master_wallet_comercio", $data);

    return $this->db->insert_id();

  }



}
