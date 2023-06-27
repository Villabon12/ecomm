<div class="main-panel">
    <?php if ($perfil->img_perfil == (NULL)) {
        $perfil->img_perfil = "usuario.png";
    } else {
        $perfil->img_perfil = $perfil->img_perfil;
    } ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="border-bottom text-center pb-4">
                                    <button type="button" style="border:none;background:none;" data-bs-toggle="modal" data-bs-target="#verFoto<?= $perfil->id ?>"><img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>" alt="profile" class="img-lg rounded-circle mb-3" /> </button><button type="button" style="padding:0;border:none;background:none;position: relative; top:35px; right:30px; " data-bs-toggle="modal" data-bs-target="#subirFoto<?= $perfil->id ?>"><i style=" color:#36E1F9;  font-size: 30px; hover;" class="bi bi-gear-fill"></i></button>
                                    <!-- Button trigger modal -->

                                    <!-- Modal ver -->
                                    <div class="modal fade" id="verFoto<?= $perfil->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <center>
                                                    <div class="modal-body">
                                                        <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>" width="300px" height="250px" alt="profile">
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal actualizar -->
                                    <div class="modal fade" id="subirFoto<?= $perfil->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?= base_url() ?>Inicio_page/actualizarFoto/<?= $perfil->id ?>" method="post" enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Sube una foto de perfil</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="input-group mb-3">
                                                            <label for=" sube un archivo"></label>
                                                            <input type="file" class="form-control" placeholder="Username" aria-label="img" aria-describedby="basic-addon1" name="img">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" style="background-color: #36E1F9;" class="btn ">Modificar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <h3><?= $perfil->nombre . "  " . $perfil->apellido1 ?></h3>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h5 class="mb-0 me-2 text-muted"><?= $perfil->ciudad ?></h5>
                                        </div><br>
                                        <?php if ($perfil->cedula == "1003895100") { ?>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <h5 class="mb-0 me-2 text-muted"> Desarrollador Jr</h5>
                                            </div> <br>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <h5 class="mb-0 me-2 text-muted"><?= $perfil->tipo ?></h5>
                                            </div>
                                        <?php } else { ?>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <h5 class="mb-0 me-2 text-muted"><?= $perfil->tipo ?></h5>
                                            </div>
                                        <?php } ?>

                                    </div>

                                    <div class="col-lg-12 col-md-6">
                                        <div class="card cc-widget">
                                            <div class="card-body text-center">
                                                <div class="d-flex no-block flex-row">
                                                    <div class="container">
                                                        <div class="cc-icon align-self-center"><i class=" bi bi-coin" title="BTC"></i></div>
                                                        <div class="m-l-10 align-self-center">
                                                            <center>
                                                                <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                                            </center>
                                                            <h5 class="text-muted m-b-0 blan">$<?= number_format($perfil->cuenta_COP, 0) ?></h5>
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
                                            <a class="nav-link active" href="<?=base_url()?>Comercio/perfil/">
                                                <i class="ti-user"></i>
                                                Informacion
                                            </a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="nav-link " href="#">
                                                <i class="ti-receipt"></i>
                                                Datos bancarios
                                            </a>
                                        </li> 
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="#">
                                                <i class="ti-calendar"></i>
                                                Direcciones
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                                <div class="profile-feed">
                                    <div class="d-flex align-items-start profile-feed-item">

                                        <form method="post" action="<?= base_url() ?>Inicio_page/actualizarPerfil/<?= $perfil->id ?>">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="inputCity" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" placeholder="Nombre" value=" <?= $perfil->nombre ?>" name="nombre">
                                                </div>
                                                <div class="col">
                                                    <label for="inputCity" class="form-label">Apellido</label>
                                                    <input type="text" class="form-control" placeholder="Apellido" value=" <?= $perfil->apellido1 ?>" name="apellido1">
                                                </div>
                                            </div> <br>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="inputCity" class="form-label">Cedula</label>
                                                    <span class="input-group-text" id="basic-addon2"> <?= $perfil->cedula ?> </span>
                                                </div>
                                                <div class="col">
                                                    <label for="inputCity" class="form-label">Celular</label>
                                                    <input type="text" class="form-control" placeholder="celular" value=" <?= $perfil->celular ?>" name="celular">
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="inputCity" class="form-label">Fecha nacimiento</label>
                                                    <input type="date" class="form-control" placeholder="fecha_nacimiento" value="<?= $perfil->fecha_nacimiento ?> " name="fecha_nacimiento">
                                                    <p style="color: red;"> su fecha de nacimiento es :<br> <?= $perfil->fecha_nacimiento ?></p>
                                                </div>
                                                <div class="col">
                                                    <label for="inputCity" class="form-label">Usuario</label>
                                                    <span class="input-group-text" id="basic-addon2"> <?= $perfil->user ?> </span>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <label for="inputCity" class="form-label">Correo</label>
                                                <span class="input-group-text" id="basic-addon2"> <?= $perfil->correo ?> </span>
                                            </div><br>
                                            <div class="row">
                                                <label for="inputCity" class="form-label">Fecha registro</label>
                                                <span class="input-group-text" id="basic-addon2"> <?= $perfil->fecha_registro ?> </span>
                                            </div><br>
                                            <div class="row">
                                                <button style="background-color: #36E1F9;" type="submit" class="btn">Modificar</button>
                                            </div>
                                        </form>
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