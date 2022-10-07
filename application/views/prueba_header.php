<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Ecomm</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url() ?>dist/f.png" />
</head>
<div class="container-scroller">

  <!-- partial:partials/_navbar.html -->
  <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
      <div class="me-3">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
      </div>
      <div>
        <a class="navbar-brand brand-logo" href="index.html">
          <img src="<?= base_url() ?>dist/favicon.png" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <img src="<?= base_url() ?>dist/f.png" alt="logo" />
        </a>
      </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
      <ul class="navbar-nav">
        <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
          <h1 class="welcome-text">Bienvenido, <span class="text-black fw-bold"><?= $perfil->nombre ?> <?= $perfil->apellido1 ?></span></h1>
          <?php if ($perfil->tipo == 'Comercio') { ?>
            <h3 class="welcome-sub-text">Nombre del negocio: <?= $perfil->nombre_negocio ?></h3>
          <?php } ?>
          <h3 class="welcome-sub-text">Tu sitio favorito para tus compras</h3>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
        <?php if ($perfil->tipo == 'SocioAdmin' || $perfil->tipo == 'SocioAdmin') { ?>
          <li class="nav-link count-indicator">
            <a class="dropdown-item" href="<?= base_url() ?>Comercio/view_peticion">
              <i class="dropdown-item-icon mdi mdi-square-inc-cash text-primary me-2"></i>Peticiones
            </a>
          </li>
        <?php } ?>
        <?php if ($perfil->tipo == 'Comercio' || $perfil->tipo == 'Comercio') { ?>
          <li class="nav-link count-indicator">
            <a class="dropdown-item" href="<?= base_url() ?>Comercio/peticionComercio/<?= $perfil->id ?>">
              <i class="dropdown-item-icon mdi mdi-square-inc-cash text-primary me-2 "></i>Peticiones
            </a>
          </li>
        <?php } ?>
        <li class="nav-link count-indicator">
          <a class="dropdown-item" href="<?= base_url() ?>Inicio_page/session_dest">
            <i class="dropdown-item-icon mdi mdi-power text-primary me-2 "></i>Cerrar sesion</a>
        </li>
      </ul>

      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->

  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->


    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url() ?>comercio?Id=<?= $perfil->id ?>">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Mi Wallet</span>
          </a>

        <li class="nav-item nav-category"></li>
        <?php if ($perfil->tipo == 'Comercio') { ?>

          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>comercio/productos/<?= $perfil->id ?>">
              <i class="menu-icon  mdi mdi-basket"></i>
              <span class="menu-title">Productos</span>
            </a>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>comercio/create_cupones/<?= $perfil->id ?>">
              <i class="menu-icon mdi mdi-barcode-scan"></i>
              <span class="menu-title">Ecommvale</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>comercio/viewRecargas/<?= $perfil->id ?>">
              <i class="menu-icon mdi mdi-remote"></i>
              <span class="menu-title">Recargas</span>
            </a>
          </li>
        <?php } ?>

        <?php if ($perfil->tipo == 'SocioAdmin' || $perfil->tipo == 'Socio') { ?>

          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>comercio/cupones/<?= $perfil->id ?>">
              <i class="menu-icon mdi mdi-barcode-scan"></i>
              <span class="menu-title">Ecommvale</span>
            </a>

          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="menu-icon mdi mdi-account-network"></i>
              <span class="menu-title">Equipo</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>comercio/binario/<?= $perfil->id ?>">Arbol Referidos</a></li>
              </ul>
            </div>
          </li>
        <?php } ?>

        <li class="nav-item nav-category"></li>

        <?php if ($perfil->tipo == 'SocioAdmin') { ?>

          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>comercio/historial_recargas">
              <i class="menu-icon mdi mdi-history"></i>
              <span class="menu-title">Historial Recargas</span>
            </a>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>comercio/config_parametros">
              <i class="menu-icon mdi mdi-wrench"></i>
              <span class="menu-title">Configuracion parametros</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>comercio/verificar_user">
              <i class="menu-icon mdi mdi-file-check"></i>
              <span class="menu-title">Validacion</span>
            </a>
          </li>
        <?php } ?>

      </ul>
    </nav>