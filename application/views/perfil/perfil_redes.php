<div class="main-panel">
    <?php if ($perfil->img_perfil == (NULL)) {
        $perfil->img_perfil = "usuario.png";
    } else {
        $perfil->img_perfil = $perfil->img_perfil;
    } ?>

    <div class="content-wrapper"
        style="background-image: url(https://www.tucash.co/wp-content/uploads/2022/03/fondo-banner-tucash-1400x397.png); background-repeat:no-repeat;background-attachment:fixed;background-size:cover;">
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
                                                                foto de perfil</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                <a class="nav-link active" href="<?= base_url() ?>Perfil/perfil">
                                                    <i class="ti-user"></i>
                                                    Informacion
                                                </a>
                                            <?php } else { ?>
                                                <a class="nav-link active" href="<?= base_url() ?>Perfil/perfilcomer">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        fill="currentColor" class="bi bi-diagram-3-fill"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5v-1zm-6 8A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm6 0A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm6 0a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1z" />
                                                    </svg>
                                                    Redes Sociales
                                                </a>
                                            </li>
                                        <?php } else {
                                        } ?>
                                    </ul>
                                </div>
                                <h4>
                                    Tus redes sociales:
                                </h4>

                                <div class="row">
                                    <div class="col">
                                        <?php if ($perfil->user_instagram != NULL) { ?>
                                            <a href=" <?= $perfil->user_instagram ?>"><i class="mdi mdi-instagram icon-lg"
                                                    style="color:#cc2074;"></i></a>
                                        <?php } else { ?>
                                        <?php } ?>
                                        <?php if ($perfil->user_facebook != NULL) { ?>
                                            <a href=" <?= $perfil->user_instagram ?>"><img
                                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/1200px-Facebook_Logo_%282019%29.png"
                                                    width="30" height="30" alt=""></a>
                                        <?php } else { ?>
                                        <?php } ?>
                                        <?php if ($perfil->user_tiktok != NULL) { ?>
                                            <a href=" <?= $perfil->user_instagram ?>"><img
                                                    src="https://assets.stickpng.com/images/602179070ad3230004b93c28.png"
                                                    width="30" height="30" alt=""></a>
                                        <?php } else { ?>
                                        <?php } ?>
                                    </div>
                                </div><br>

                                <form method="get" action="<?= base_url() ?>Perfil/subir_redes/<?= $perfil->id ?>">
                                    <div class="row">
                                        <label for="inputCity" class="form-label">Link Instragram</label>
                                        <input type="text" class="form-control" value="<?= $perfil->user_instagram ?>"
                                            placeholder="" name="insta">
                                    </div> <br>
                                    <div class="row">
                                        <label for="inputCity" class="form-label">Link Facebook</label>
                                        <input type="text" class="form-control" value="<?= $perfil->user_facebook ?>"
                                            placeholder="" value="" name="facebook">
                                    </div> <br>
                                    <div class="row">
                                        <label for="inputCity" class="form-label">Link Tiktok</label>
                                        <input type="text" class="form-control" value="<?= $perfil->user_tiktok ?>"
                                            placeholder="" value="" name="tiktok">
                                    </div> <br>
                                    <div class="row">
                                        <button type="submit" class="btn btn-success">Agregar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>