<!DOCTYPE html>

<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>E`comm</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>recursos/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>recursos/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="<?= base_url() ?>recursos/css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="<?= base_url() ?>recursos/images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>recursos/css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  -->
    <!-- owl stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>recursos/css/owl.carousel.min.css">
    <link rel="stylesoeet" href="<?= base_url() ?>recursos/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>dist/f.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>
<style>
    .content-table {
        width: 95%;
        max-height: 200px;
        margin-left: 15px;
        height: auto;
        overflow-y: visible;
        overflow-x: hidden;
    }

    .content-table table {
        width: 100%;
    }

    tbody tr td a {
        display: block;
        padding: 10px;
        color: black;
        text-decoration: none;
    }

    /* tbody tr td a:hover {
        background: rgba(0, 0, 0, 0.3);
    } */

    #table_length,
    #table_filter,
    #table_info,
    #table_paginate {
        display: none;
    }
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,1000&display=swap" rel="stylesheet">

<body onload="showModal()">
    <!-- banner bg main start -->
    <div class="banner_bg_main">
        <?php if ($this->session->flashdata("error")) { ?>
            <p>
                <?php echo $this->session->flashdata("error") ?>
            </p>
        <?php } ?>
        <!-- header top section start -->
        <div class="container">
            <div class="header_section_top">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="custom_menu">
                            <ul>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- header top section start -->
        <!-- logo section start -->
        <div class="logo_section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="logo"><a href="#"><img src="<?= base_url() ?>dist/favicon.png" width="200px"
                                    height="700px"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- logo section end -->
        <!-- header section start -->
        <div class="header_section">
            <div class="container">
                <div class="containt_main">
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a href="#">Inicio</a>
                        <a href="#">Quienes Somos</a>
                        <a href="#">Preguntas Frecuentes</a>
                    </div>
                    <span class="toggle_icon" onclick="openNav()"><i class="fa-solid fa-bars"></i></span>
                    <div class="main">
                        <!-- Another variation with a button -->
                        <div class="input-group">
                            <input type="search" class="form-control" id="buscar" name="buscar" value=""
                                placeholder="Busca tu producto">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button"
                                    style="background-color: #037272; border-color:white, ">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="content-table" style="margin-top:0px;">
                            <table id="table" class="table">
                                <tbody id="respuesta" style="background: rgba(235, 235, 239);">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="header_box">
                        <div class="login_menu">
                            <ul>
                                <li>
                                    <button type="button" class="btn " style="background:none; color:white;"
                                        data-bs-toggle="modal" data-bs-target="#login">
                                        <i class="fa fa-user" style="color:black;" aria-hidden="true"></i>
                                        <span class="padding_10" style="color:black;">Iniciar sesion</span>
                                    </button>
                                    <!-- Button trigger modal -->

                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Modal Login -->

                    <div class="modal fade" id="login" style="margin-top:3rem;" tabindex="-1" aria-labelledby="login"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form class="form" action="<?= base_url() ?>Inicio_page/validaAcceso" method="post">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-cente " id="exampleModalLabel">Iniciar sesion
                                        </h1>
                                        <button type="button" class="btn" data-bs-dismiss="modal">X</button>
                                    </div>
                                    <div class="modal-body p-5 pt-0">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control " name="user" placeholder="Usuario"
                                                id="floatingInput" required>
                                            <label for="floatingInput">Usuario</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="floatingPassword"
                                                name="pass" placeholder="Contraseña" required>
                                            <label for="floatingPassword">Contraseña</label>
                                        </div>
                                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-warning"
                                            type="submit">iniciar</button>
                                    </div>
                                </form>
                                <p class="login__signup">¿Olvidaste la contraseña? &nbsp;<a
                                        href="<?= base_url() ?>Inicio_page/olvidarContra">Olvidar clave</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header section end -->
        <div class="banner_section layout_padding ">
            <div class="container">
                <div id="my_slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 class="banner_taital">¡Ten ingresos pasivos de manera
                                        automatica!</h1>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 class="banner_taital">Compra y <br> Gana , en E`comm</h1>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 class="banner_taital">Apoyemos las microempresas <br>Colombianas</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- banner bg main end -->
    <!-- fashion section start -->
    <div class="fashion_section">
        <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <h1 class="fashion_taital">Comida</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                <?php foreach ($comida as $c) { ?>
                                    <div class="col-lg-3 col-sm-3">
                                        <div class="box_main" style="height:598px;border-radius: 20px;">
                                            <div style="height:100px;">
                                                <h4 class="shirt_text">
                                                    <?= $c->nombre ?>
                                                </h4>
                                                <p class="price_text">Precio: <span style="color: #262626;">
                                                        <?= number_format($c->precio, 0) ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div style="margin-bottom:100px;">
                                                <img src="<?= base_url() ?>assets/img/<?= $c->img ?>" style="height:300px;">
                                            </div>
                                            <div class="btn_main">
                                                <div class="buy_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#login">Compra ahora</a></div>
                                                <div class="seemore_bt"><a href="#">gana:
                                                        $
                                                        <?= number_format(((($c->precio * $c->descuento) / 100) * $c->cashback / 100), 0) ?><br>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <h1 class="fashion_taital">Moda</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                <?php foreach ($moda as $c) { ?>
                                    <div class="col-lg-3 col-sm-3">
                                        <div class="box_main" style="height:598px; border-radius: 20px;">
                                            <div style="height:100px;">
                                                <h4 class="shirt_text">
                                                    <?= $c->nombre ?>
                                                </h4>
                                                <p class="price_text">Precio: <span style="color: #262626;">
                                                        <?= number_format($c->precio, 0) ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div style="margin-bottom:100px;">
                                                <img src="<?= base_url() ?>assets/img/<?= $c->img ?>" style="height:300px;">
                                            </div>
                                            <div class="btn_main">
                                                <div class="buy_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#login">Compra ahora</a></div>
                                                <div class="seemore_bt"><a href="#">gana:
                                                        $
                                                        <?= number_format(((($c->precio * $c->descuento) / 100) * $c->cashback / 100), 0) ?><br>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <h1 class="fashion_taital">Vacaciones / Tour</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                <?php foreach ($vaca as $c) { ?>
                                    <div class="col-lg-3 col-sm-3">
                                        <div class="box_main" style="height:598px; border-radius: 20px;">
                                            <div style="height:100px;">
                                                <h4 class="shirt_text">
                                                    <?= $c->nombre ?>
                                                </h4>
                                                <p class="price_text">Precio: <span style="color: #262626;">
                                                        <?= number_format($c->precio, 0) ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div style="margin-bottom:100px;">
                                                <img src="<?= base_url() ?>assets/img/<?= $c->img ?>" style="height:300px;">
                                            </div>
                                            <div class="btn_main">
                                                <div class="buy_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#login">Compra ahora</a></div>
                                                <div class="seemore_bt"><a href="#">gana:
                                                        $
                                                        <?= number_format(((($c->precio * $c->descuento) / 100) * $c->cashback / 100), 0) ?><br>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    <!-- fashion section end -->
    <!-- electronic section start -->
    <div class="fashion_section">
        <div id="electronic_main_slider" class="carousel slide" data-ride="">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <h1 class="fashion_taital">Salud y belleza</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                <?php foreach ($salud as $c) { ?>
                                    <div class="col-lg-3 col-sm-3">
                                        <div class="box_main" style="height:598px; border-radius: 20px;">
                                            <div style="height:100px;">
                                                <h4 class="shirt_text">
                                                    <?= $c->nombre ?>
                                                </h4>
                                                <p class="price_text">Precio: <span style="color: #262626;">
                                                        <?= number_format($c->precio, 0) ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div style="margin-bottom:100px;">
                                                <img src="<?= base_url() ?>assets/img/<?= $c->img ?>" style="height:300px;">
                                            </div>
                                            <div class="btn_main">
                                                <div class="buy_bt"><a href="" data-bs-toggle="modal"
                                                        data-bs-target="#login">Compra ahora</a></div>
                                                <div class="seemore_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#login">gana:
                                                        $
                                                        <?= number_format(((($c->precio * $c->descuento) / 100) * $c->cashback / 100), 0) ?><br>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <h1 class="fashion_taital">tecnologia y electrodomesticos</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                <?php foreach ($electro as $c) { ?>
                                    <div class="col-lg-3 col-sm-3">
                                        <div class="box_main" style="height:598px; border-radius: 20px;">
                                            <div style="height:100px;">
                                                <h4 class="shirt_text">
                                                    <?= $c->nombre ?>
                                                </h4>
                                                <p class="price_text">Precio: <span style="color: #262626;">
                                                        <?= number_format($c->precio, 0) ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div style="margin-bottom:100px;">
                                                <img src="<?= base_url() ?>assets/img/<?= $c->img ?>" style="height:300px;">
                                            </div>
                                            <div class="btn_main">
                                                <div class="buy_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#login">Compra ahora</a></div>
                                                <div class="seemore_bt"><a href="#">gana:
                                                        $
                                                        <?= number_format(((($c->precio * $c->descuento) / 100) * $c->cashback / 100), 0) ?><br>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <h1 class="fashion_taital">Muchos mas productos</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                <?php foreach ($vaca as $c) { ?>
                                    <div class="col-lg-3 col-sm-3">
                                        <div class="box_main" style="height:598px; border-radius: 20px;">
                                            <div style="height:100px;">
                                                <h4 class="shirt_text">
                                                    <?= $c->nombre ?>
                                                </h4>
                                                <p class="price_text">Precio: <span style="color: #262626;">
                                                        <?= number_format($c->precio, 0) ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div style="margin-bottom:100px;">
                                                <img src="<?= base_url() ?>assets/img/<?= $c->img ?>" style="height:300px;">
                                            </div>
                                            <div class="btn_main">
                                                <div class="buy_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#login">Compra ahora</a></div>
                                                <div class="seemore_bt"><a href="#">gana:
                                                        $
                                                        <?= number_format(((($c->precio * $c->descuento) / 100) * $c->cashback / 100), 0) ?><br>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#electronic_main_slider" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control-next" href="#electronic_main_slider" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" tabindex="-1" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content"
                style="background-image:url('https://fondosmil.com/fondo/31320.jpg');background-size: cover; margin-top:4rem;">
                <div class="modal-body">
                    <form action="<?= base_url() ?>Inicio_page/encuesta" method="post">
                        <div class="row">
                            <div class="col-auto me-auto"> </div>
                            <div class="col-auto"> <button type="button" class="" data-bs-dismiss="modal"
                                    style="border:none;background:none;" aria-label="Close" onclick="closeModal()"><i
                                        style="font-size:20px;" class="bi bi-x-lg"></i></button><br><br>
                            </div>
                        </div>
                        <center>
                            <h1 style="font-family: 'Nunito', sans-serif;color:white;-webkit-text-stroke: 1.5px black;">
                                ¡Agiliza tus compras, con la nueva Version de<b> Ecomm</b> <br> </h1> <br>
                            <h1 style="font-family: 'Nunito', sans-serif;color:white;-webkit-text-stroke: 1.5px black;">
                                ¡Descàrgala Ahora!</h1><br><br>
                            <p style="color:red;"><b>Disponible solo para Android </b></p>
                            <a href="<?= base_url() ?>assets\img\documentacion\ecomm2.0.apk" type="button"
                                class="btn btn-warning" download target="_blank">Descargar App</a>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- electronic section end -->
    <!-- jewellery  section start -->
    <!-- <div class="jewellery_section">
        <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <h1 class="fashion_taital">Jewellery Accessories</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                <div class="col-lg-4 col-sm-4">
                                    <div class="box_main">
                                        <h4 class="shirt_text">Jumkas</h4>
                                        <p class="price_text">Start Price <span style="color: #262626;">$ 100</span></p>
                                        <div class="jewellery_img"><img src="images/jhumka-img.png"></div>
                                        <div class="btn_main">
                                            <div class="buy_bt"><a href="#">Buy Now</a></div>
                                            <div class="seemore_bt"><a href="#">See More</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="box_main">
                                        <h4 class="shirt_text">Necklaces</h4>
                                        <p class="price_text">Start Price <span style="color: #262626;">$ 100</span></p>
                                        <div class="jewellery_img"><img src="images/neklesh-img.png"></div>
                                        <div class="btn_main">
                                            <div class="buy_bt"><a href="#">Buy Now</a></div>
                                            <div class="seemore_bt"><a href="#">See More</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#jewellery_main_slider" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control-next" href="#jewellery_main_slider" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
            <div class="loader_main">
                <div class="loader"></div>
            </div>
        </div>
    </div> -->
    <br><br><br><br><br><br>



    <!-- Modal -->
    <?php foreach ($todito as $C) { ?>
        <div class="modal fade" id="carrito<?= $C->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Estas seguro de agregar
                            <?= $C->nombre ?> al carrito
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="">Cantidad</label>
                                <input type="number" class="form-control form-control-sm" value="1" name="cantidad"
                                    required>
                            </div>
                            <div class="col-6">
                                <center>
                                    <div>
                                        <img src="<?= base_url() ?>assets/img/<?= $C->img ?>" alt="imagen" height="150px"
                                            style="max-width: 100%;">
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-bs-dismiss="modal">Cerrar</button>
                            </div>
                            <div class="col">
                                <button type="buttom" class="btn btn-waning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#login">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="footer_section layout_padding">
        <div class="container">
            <div class="footer_logo"><a href="index.html"><img src="<?= base_url() ?>dist/favicon.png" width="200px"
                        height="700px"></a></div>
            <!-- <div class="input_bt">
                <input type="text" class="mail_bt" placeholder="tu correo electronico" name="Your Email">
                <span class="subscribe_bt" id="basic-addon2"><a href="#">Quiero mas informacion</a></span>
            </div>
            <div class="footer_menu">
                <ul>
                    <li><a href="#">Mejores productos</a></li>
                    <li><a href="#">Quiero traer un comercio</a></li>
                    <li><a href="#">Sugerencias</a></li>
                    <li><a href="#">Servicio al cliente</a></li>
                </ul>
            </div> -->
            <div class="location_main">Linea de atencion : <a href="#">+57 3112209514</a></div>
        </div>
    </div>
    <!-- footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">Copyright © 2023. Todos los derechos reservados.</p>
        </div>
    </div>
    <script>
        function showModal() {
            document.getElementById("myModal").style.display = "block";
        }
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>
    <!-- copyright section end -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Javascript files-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>recursos/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>recursos/js/popper.min.js"></script>
    <script src="<?= base_url() ?>recursos/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>recursos/js/jquery-3.0.0.min.js"></script>
    <script src="<?= base_url() ?>recursos/js/plugin.js"></script>
    <!-- sidebar -->
    <script src="<?= base_url() ?>recursos/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?= base_url() ?>recursoss/js/custom.js"></script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
    <script>
        $(document).ready(function () {
            var base_url = "<?= base_url() ?>";

            $("#buscar").keyup(function () {

                buscar = $(this).val();

                if (buscar == 0) {
                    console.log('es 0');
                    $('#respuesta').hide("fast");
                    $('.respuesta').hide("fast"); //muestro mediante clase
                } else {
                    $.ajax({
                        url: base_url + "Inicio_page/traerlanding",
                        type: "POST",
                        data: {
                            buscar: buscar
                        },
                        dataType: "json",
                        success: function (resp) {
                            console.log(resp);
                            $('#respuesta').show("fast");
                            if (resp == 0) {
                                html = "";
                                html += '<center>'
                                html += '<p style="color:red;">No se encuentran coincidencias</p>'
                                html += '</center>'
                                $('#respuesta').html(html);
                            } else {
                                console.log(resp);
                                html = "";
                                $.each(resp, function (key, value) {
                                    html += '<tr>'
                                    html += '<td><button type="button" style="border:none;background:none;" data-bs-toggle="modal" data-bs-target="#carrito' + value.id + ' ">' + value.nombre + '->' + value.nombre_negocio + '</a></td>'
                                    html += '</tr>'
                                    $('#respuesta').html(html);
                                });
                            }

                        }
                    })
                }
            })
        });
    </script>
</body>

</html>