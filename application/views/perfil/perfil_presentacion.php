<div class="presentacion" style="margin:25px;">
    <div class="row">
        <?php if ($this->session->flashdata("error")) { ?>
            <p>
                <?php echo $this->session->flashdata("error") ?>
            </p>
        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>
            <p>
                <?php echo $this->session->flashdata("exito") ?>
            </p>
        <?php } ?>
        <div class="col-12" style="margin-top: 2rem;">
            <div class="card" style="margin-top: 2rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="border-bottom text-center pb-4">
                                <button type="button" style="border:none;background:none;" data-bs-toggle="modal"
                                    data-bs-target="#verFoto<?= $perfil->id ?>"><img
                                        src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>"
                                        alt="profile" class="img-lg rounded-circle mb-3" /> </button><button
                                    type="button"
                                    style="padding:0;border:none;background:none;position: relative; top:35px; right:30px; "
                                    data-bs-toggle="modal" data-bs-target="#subirFoto<?= $perfil->id ?>"><i
                                        style=" color:#36E1F9;  font-size: 30px; hover;"
                                        class="bi bi-gear-fill"></i></button>
                                <!-- Button trigger modal -->

                                <!-- Modal ver -->
                                <div class="modal fade" id="verFoto<?= $perfil->id ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <center>
                                                <div class="modal-body">
                                                    <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>"
                                                        width="300px" height="250px" alt="profile">
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal actualizar -->
                                <div class="modal fade" id="subirFoto<?= $perfil->id ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <?php if ($perfil->tipo == "Socio" || $perfil->tipo == "SocioAdmin") { ?>
                                                <form action="<?= base_url() ?>Perfil/actualizarFoto/<?= $perfil->id ?>"
                                                    method="post" enctype="multipart/form-data">
                                                <?php } else { ?>
                                                    <form
                                                        action="<?= base_url() ?>Perfil/actualizarFotocomer/<?= $perfil->id ?>"
                                                        method="post" enctype="multipart/form-data">
                                                    <?php } ?>

                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Sube una
                                                            foto de
                                                            perfil</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="input-group mb-3">
                                                            <label for=" sube un archivo"></label>
                                                            <input type="file" class="form-control"
                                                                placeholder="Username" aria-label="img"
                                                                aria-describedby="basic-addon1" name="img">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit"
                                                            class="btn btn-success ">Modificar</button>
                                                    </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <h3>
                                        <?= $perfil->nombre . "  " . $perfil->apellido1 ?>
                                    </h3>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h5 class="mb-0 me-2 text-muted">
                                            <?= $perfil->ciudad ?>
                                        </h5>
                                    </div><br>
                                    <?php if ($perfil->cedula == "1003895100") { ?>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h5 class="mb-0 me-2 text-muted"> Desarrollador </h5>
                                        </div> <br>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h5 class="mb-0 me-2 text-muted">
                                                <?= $perfil->tipo ?>
                                            </h5>
                                        </div>
                                    <?php } else { ?>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h5 class="mb-0 me-2 text-muted">
                                                <?= $perfil->tipo ?>
                                            </h5>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="card cc-widget">
                                        <div class="card-body text-center">
                                            <div class="d-flex no-block flex-row">
                                                <div class="container">
                                                    <div class="cc-icon align-self-center"><i class=" bi bi-coin"
                                                            title="BTC"></i></div>
                                                    <div class="m-l-10 align-self-center">
                                                        <center>
                                                            <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                                        </center>
                                                        <h5 class="text-muted m-b-0 blan">$
                                                            <?= number_format($perfil->cuenta_COP, 0) ?>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Estado
                                    </span>
                                    <span class="float-right text-muted">
                                        <?= $perfil->verificar_user ?>
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Celular
                                    </span>
                                    <span class="float-right text-muted">
                                        <?= $perfil->celular ?>
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Correo electronico
                                    </span>
                                    <span class="float-right text-muted">
                                        <?= $perfil->correo ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="mt-4 py-2 border-top border-bottom">
                                <ul class="nav profile-navbar">
                                    <li class="nav-item">
                                        <?php if ($perfil->tipo == "Socio" || $perfil->tipo == "SocioAdmin") { ?>
                                            <a class="nav-link " href="<?= base_url() ?>Perfil/perfil">
                                                <i class="ti-user"></i>
                                                Informacion
                                            </a>
                                        <?php } else { ?>
                                            <a class="nav-link " href="<?= base_url() ?>Perfil/perfilcomer">
                                                <i class="ti-user"></i>
                                                Informacion
                                            </a>
                                        <?php } ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php if ($perfil->tipo == "Socio" || $perfil->tipo == "SocioAdmin") { ?>
                                            <a class="nav-link " href="<?= base_url() ?>Perfil/perfil2">
                                                <i class="ti-receipt"></i>
                                                Datos bancarios
                                            </a>
                                        <?php } else { ?>
                                            <a class="nav-link " href="<?= base_url() ?>Perfil/perfil2comer">
                                                <i class="ti-receipt"></i>
                                                Datos bancarios
                                            </a>
                                        <?php } ?>
                                    </li>
                                    <?php if ($perfil->tipo == "Comercio") { ?>
                                        <li class="nav-item">
                                            <a class="nav-link " href="<?= base_url() ?>Perfil/perfil2redes">
                                                <i class="mdi mdi-google-circles-extended"></i>
                                                Redes Sociales
                                            </a>
                                        </li>
                                    <?php } else { ?>

                                        <!-- <a class="nav-link active" href="<?= base_url() ?>perfil/perfilPresentacion">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                                <path
                                                    d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                                                <path
                                                    d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
                                            </svg>
                                            Carta de presentación
                                        </a> -->
                                    <?php } ?>
                                </ul>
                            </div>

                            <div class="row row-cols-1 row-cols-md-2 mb-2 text-center" style="margin-top:2rem ;">
                                <div class="col">
                                    <div class="card mb-4 rounded-3 shadow-sm">
                                        <div class="card-header py-3 btn-warning">
                                            <h4 class="my-0 fw-normal">Gratis</h4>
                                        </div>
                                        <div class="card-body">
                                        <h1 class="card-title pricing-card-title">$0<small
                                                    class="text-muted fw-light">/Anual</small></h1>
                                            <ul class="list-unstyled mt-3 mb-4">
                                                <li>Diseño basico y estatico</li>
                                                <li>No personalizable </li>
                                                <li>Limite de Link 1</li>
                                            </ul>
                                            <a type="button" href="<?=base_url()?>Carta_presentacion/carta/<?=$perfil->id?> " class="w-100 btn btn-lg btn-outline-success">Adquirir</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card mb-4 rounded-3 shadow-sm">
                                        <div class="card-header py-3 btn-warning">
                                            <h4 class="my-0 fw-normal">Pro</h4>
                                        </div>
                                        <div class="card-body">
                                            <h1 class="card-title pricing-card-title">$15<small
                                                    class="text-muted fw-light">/Anual</small></h1>
                                            <ul class="list-unstyled mt-3 mb-4">
                                                <li>Escoger tu propia plantilla</li>
                                                <li>Personaliza los colores de tus botones</li>
                                                <li>Links ilimitado</li>
                                            </ul>
                                            <a type="button" href="<?=base_url()?>LinkTree/making/4" class="w-100 btn btn-lg btn-outline-success">Adquirir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>