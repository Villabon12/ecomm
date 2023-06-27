<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <title>Ecomm</title>
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
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url() ?>dist/f.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/mdi/css/materialdesignicons.min.css">
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</head>



</head>
<style>
  .content-table {
    width: 80%;
    max-height: 150px;
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

<body >
  <!-- banner bg main start -->
  <div class="banner_bg_main">
    <!-- header top section start -->
    <div class="container">
      <div class="header_section_top">
        <div class="row">
          <center>
            <div class="col">
              <div class="custom_menu">
              <?php if ($perfil->tipo == 'Socio') { ?>
                <ul>
                  <li><a href="<?= base_url() ?>comercio/cupones/">
                      Todo
                    </a>
                  </li>
                  <?php foreach ($categorias as $c) { ?>
                    <li><a href="<?= base_url() ?>cupones/categorias/<?= $c->id ?>">
                        <?= $c->nombre ?>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
            <?php } else if ($perfil->tipo == 'Comercio') { ?>

            <?php } else if ($perfil->tipo == 'SocioAdmin') { ?>
              <ul>
                  <li><a href="<?= base_url() ?>comercio/cupones/">
                      Todo
                    </a>
                  </li>
                  <?php foreach ($categorias as $c) { ?>
                    <li><a href="<?= base_url() ?>cupones/categorias/<?= $c->id ?>">
                        <?= $c->nombre ?>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
            <?php } ?>
              </div>
            </div>
          </center>
        </div>
      </div>
    </div>
    <!-- header top section start -->
    <!-- logo section start -->
    <div class="logo_section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="logo"><a href="<?= base_url() ?>comercio/cupones"><img src="<?= base_url() ?>dist/favicon.png"
                  width="200px" height="700px"></a>
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
            <?php if ($perfil->tipo == 'Socio') { ?>
              <a href="<?= base_url() ?>cupones">Productos</a>
              <a href="<?= base_url() ?>seguros">Seguros</a>
              <a href="<?= base_url() ?>tarjetas">Tarjetas Regalo</a>
              <!-- <a href="">preguntas frecuentes</a> -->
            <?php } else if ($perfil->tipo == 'Comercio') { ?>
                <a href="<?= base_url() ?>comercio/viewRecargas/<?= $perfil->id ?>">Recargas</a>
                <a href="<?= base_url() ?>comercio/create_cupones/<?= $perfil->id ?>">Productos</a>
                <a href="<?= base_url() ?>Seguros/create_seguros">Seguros</a>
                <a href="<?= base_url() ?>Tarjetas/view_negocio">Tarjetas</a>
            <?php } else if ($perfil->tipo == 'SocioAdmin') { ?>
                  <a href="<?= base_url() ?>recargas/observacion">Recargas</a>
                  <a href="<?= base_url() ?>parametros">Configuracion parametros</a>
                  <a href="<?= base_url() ?>datos/socios">Socios</a>
                  <a href="<?= base_url() ?>datos/comercios">Comercios</a>
                  <a href="<?= base_url() ?>solicitudes/admin">Solicitudes</a>
            <?php } ?>
          </div>
          <span class="toggle_icon" onclick="openNav()"><img
              src="<?= base_url() ?>recursos/images/toggle-icon.png"></span>
          <div class="main">
            <!-- Another variation with a button -->
            <?php if ($perfil->tipo == 'Socio') { ?>
              <form action="<?= base_url() ?>Comercio/updateciudad/<?= $perfil->id ?>" method="get">
                <div class="input-group mb-3">
                  <input type="search" class="form-control" id="buscarint" name="buscar" value=""
                    placeholder="Busca tu producto" style="width:50%;">
                  <button class="btn btn-secondary btn-sm" type="button"
                    style="background-color: #037272; border-color:white, ">
                    <i class="fa fa-search"></i>
                  </button>
                  <select class="form-select form-select-sm" aria-label="Default select example" name="ciudad">
                    <option selected>
                      <?= $perfil->ciu_co ?>
                    </option>
                    <?php foreach ($ciudad as $c) { ?>
                      <option value="<?= $c->ciudad ?>"><?= $c->ciudad ?></option>
                    <?php } ?>
                  </select>
                  <button class="btn btn-secondary btn-sm" type="submit"
                    style="background-color: #037272; border-color:white, ">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </form>
            <?php } else if ($perfil->tipo == 'Comercio') { ?>
                <div class="input-group">
                </div>
            <?php } else if ($perfil->tipo == 'SocioAdmin') { ?>
                  <form action="<?= base_url() ?>Comercio/updateciudad/<?= $perfil->id ?>" method="get">
                    <div class="input-group mb-3">
                      <input type="search" class="form-control" id="buscar" name="buscar" value=""
                        placeholder="Busca tu producto" style="width:50%;">
                      <button class="btn btn-secondary btn-sm" type="button"
                        style="background-color: #037272; border-color:white, ">
                        <i class="fa fa-search"></i>
                      </button>
                      <select class="form-select form-select-sm" aria-label="Default select example" name="ciudad">
                        <option selected>
                      <?= $perfil->ciu_co ?>
                        </option>
                    <?php foreach ($ciudad as $c) { ?>
                          <option value="<?= $c->municipio ?>"><?= $c->municipio ?></option>
                    <?php } ?>
                      </select>
                      <button class="btn btn-secondary btn-sm" type="button"
                        style="background-color: #037272; border-color:white, ">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </form>
            <?php } ?>
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
                  <a class="nav-link " type="button" class="btn" href="<?= base_url() ?>wallet">
                    <i class="icon-wallet"></i><br>
                  </a>
                </li>
                <?php if ($perfil->tipo == "Socio") { ?>
                  <li>
                    <a class="nav-link" type="button" class="btn"
                      href="<?= base_url() ?>team">
                      <i class="menu-icon mdi mdi-account-network"></i>
                    </a>
                  </li>
                  <li>
                    <button class="btn " type="button" style="color:white;" data-bs-toggle="offcanvas"
                      data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                        class="menu-icon mdi mdi-cart-outline"></i></button>
                  </li>
                  <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasRight"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                      <h5 class="offcanvas-title" id="offcanvasRightLabel">Tu carrito</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                      <div class="row">
                        <div class="col-xs-12">
                          <div id="nuevo"></div>
                          <div id="viejo">
                            <?php foreach ($dt as $dt): ?>
                              <div class="card" style="width: 100%; margin: 10px; background-color:#BFF9F0;">
                                <div class="card-body">
                                  <h6 class="card-title">
                                    <?= $dt->producto; ?>
                                  </h6>
                                  <p class="card-text">Precio:$
                                    <?= number_format($dt->precio, 0); ?>
                                  <p class="card-text">Cantidad:
                                    <?= $dt->cantidad; ?>
                                  <div class="position-absolute bottom-0 end-0">
                                    <button type="submit" class="btn btn-danger btn-sm"
                                      style="margin-bottom:10px;margin-right:10px;" value="<?= $dt->id ?>"
                                      id="eliminarpro<?= $dt->id; ?>"> X</button>
                                  </div>
                                </div>
                              </div>
                              <script>
                                $(document).ready(function () {
                                  var base_url = "<?= base_url() ?>";
                                  $('#eliminarpro<?= $dt->id; ?>').click(function () {
                                    id = $(this).val();
                                    console.log("presiona");
                                    $.ajax({
                                      url: base_url + "Proceso/deleteListado",
                                      type: "POST",
                                      data: {
                                        id: id
                                      },
                                      dataType: "json",
                                      success: function (resp) {
                                        html = "";
                                        $('#viejo').hide("fast"); //muestro mediante id
                                        $.each(resp['carrito'], function (key, value) {
                                          html += '<div class="card" style="width: 100%; margin: 10px; background-color:#BFF9F0;">'
                                          html += '<div class="card-body">';
                                          html += '<h6 class="card-title">' + value.producto + '</h6>';
                                          html += '<p class="card-text">Precio:$' + value.precio + '</p>';
                                          html += '<p class="card-text">Cantidad:' + value.cantidad + '</p>';
                                          html += '<div class="position-absolute bottom-0 end-0">';
                                          html += '<button type="submit" class="btn btn-danger btn-sm"style="margin-bottom:10px;margin-right:10px;" value="' + value.id + '" id="eliminarpro' + value.id + '"> X</button>';
                                          html += '</div>';
                                          html += '</div>';
                                          html += '</div>';
                                          console.log(resp);
                                        })
                                        $('#total').hide("fast"); //muestro mediante id
                                        html += '<h2>Total : $ ' + resp["total"].total + ' </h2><br>';
                                        $('#nuevo').html(html);
                                      }
                                    });
                                  });
                                });
                              </script>
                            <?php endforeach; ?>
                          </div>
                        </div>
                      </div> <br>
                      <section>
                        <?php if ($dt == null) { ?>
                          <p>No hay productos en carrito</p>
                        <?php } else { ?>
                          <h2 id="total">Total : $
                            <?= number_format($carritoTotal->total, 0) ?>
                          </h2><br><br>

                          <center>
                            <form action="<?= base_url() ?>Proceso/compra" method="post">
                              <button type="submit" class="btn btn-success btn-lg">
                                Terminar compra</button>
                            </form>
                          </center>
                        <?php } ?>
                      </section>
                    </div>
                  </div>
                <?php } ?>
                <li>
                  <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle"
                      src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>" alt="Profile image">
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                      <img class="img-md rounded-circle"
                        src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>" width="100"
                        height="100">
                      <p class="mb-1 mt-3 font-weight-semibold">
                        <?= $perfil->nombre ?>
                        <?= $perfil->apellido1 ?>
                      </p>
                      <p class="fw-light text-muted mb-0">
                        <?= $perfil->correo ?>
                      </p>
                    </div>
                    <?php if ($perfil->tipo == 'Socio') { ?>
                      <a class="dropdown-item" style="color:black;" href="<?= base_url() ?>perfil"><i
                          class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Mi perfil</a>
                      <a class="dropdown-item" style="color:black;" href="<?= base_url() ?>compras"> <i
                          class="dropdown-item-icon mdi mdi-briefcase-check text-primary me-2 "></i>Compras</a>
                      <a class="dropdown-item" style="color:black;" href="<?= base_url() ?>Solicitudes/detalles"> <i
                          class="dropdown-item-icon mdi mdi-briefcase-check text-primary me-2 "></i>Movimientos</a>
                    <?php } ?>
                    <?php if ($perfil->tipo == 'Comercio') { ?>
                      <a class="dropdown-item" style="color:black;" href="<?= base_url() ?>Perfil/perfilcomer"><i
                          class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Mi perfil</a>
                      <a class="dropdown-item" style="color:black;" href="<?= base_url() ?>Proceso/ventas"> <i
                          class="dropdown-item-icon mdi mdi-basket-fill text-primary me-2"></i>Ventas</a>
                      <a class="dropdown-item" style="color:black;" href="<?= base_url() ?>Solicitudes/detallescomer"><i
                          class="dropdown-item-icon mdi mdi-square-inc-cash text-primary me-2 "></i>Movimientos</a>
                    <?php } ?>
                    <?php if ($perfil->tipo == 'SocioAdmin') { ?>
                      <a class="dropdown-item" style="color:black;" href="<?= base_url() ?>Perfil/perfil"><i
                          class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Mi perfil</a>
                    <?php } ?>
                    <a class="dropdown-item" style="color:black;" href="<?= base_url() ?>Inicio_page/session_dest"> <i
                        class="dropdown-item-icon mdi mdi-power text-primary me-2 "></i>Cerrar Sesion</a>
                  </div>
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
                      <input type="text" class="form-control " name="user" placeholder="Usuario" id="floatingInput"
                        required>
                      <label for="floatingInput">Usuario</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" class="form-control" id="floatingPassword" name="pass"
                        placeholder="Contraseña" required>
                      <label for="floatingPassword">Contraseña</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-warning" type="submit">iniciar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- header section end -->