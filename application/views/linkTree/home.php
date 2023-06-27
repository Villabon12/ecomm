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
                            <center>
                                <h2>Escoje Tu Plantilla</h1>
                            </center>
                            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center" style="margin-top:2rem ;">

                                <?php foreach ($plantillas as $p) { ?>
                                    <div class="col">
                                        <div class="card" style="width: 18rem; margin-top:25px;">
                                            <a target="_blank" href="<?= base_url() ?>LinkTree/viewPlantilla/<?= $p->id ?>">
                                                <img src="<?= base_url() ?>assets/img/muestra/<?= $p->img ?>"
                                                    class="card-img-top" style="height:250px;" alt="..."></a>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?= $p->nombre ?>
                                                </h5>
                                                <a type="button" class="btn btn-warning" target="_blank"
                                                    href="<?= base_url() ?>LinkTree/making/<?= $p->id ?>">
                                                    Personalizar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>