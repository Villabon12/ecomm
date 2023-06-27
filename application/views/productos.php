<body>

    <div class="main-panel">
        <div class="content-wrapper">
            <?php if ($this->session->flashdata("error")) { ?>
                <p><?php echo $this->session->flashdata("error") ?></p>
            <?php } ?>
            <?php if ($perfil->img_selfie == (NULL) || $perfil->img_cedula_back == (NULL) || $perfil->img_cedula_front == (NULL)) { ?>
                <div class="col-lg 12">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <i class="mdi mdi-alert-circle-outline icon-lg" style="color:red;"></i>
                                <h1>Espera un momento</h1>
                                <h2>Valida tus datos primero</h2>
                                <a href="<?= base_url() ?>Perfil/perfilcomer" type="button" class="btn btn-success  ">validar</a>
                            </center>
                        </div>
                    </div>
                </div>
            <?php } else { ?>

                <h1>Crear un Producto</h1>
                <br>
                <!-- Agregar cupon modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearproducto">
                    Crear Productos
                </button>

                <!-- Modal -->
                <div class="modal fade" id="crearproducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Crear Producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url() ?>Comercio/guardarProducto" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" class="visually-hidden" name="id_usuario" value="<?= $perfil->id ?> " placeholder="id-producto">
                                    <div class="mb-3">
                                        <select class="form-select" aria-label="Default select example" name="categoria">
                                            <option selected>Categorias</option>
                                            <?php foreach ($categorias as $c) { ?>
                                                <option value="<?= $c->id ?>"><?= $c->nombre ?></option>
                                            <?php } ?>
                                        </select>

                                    </div><br>
                                    <div class="mb-3">
                                        <input type="tex" class="form-control" name="nombre" placeholder="producto">
                                    </div><br>
                                    <div class="mb-3">
                                        <input type="tex" class="form-control" name="precio" placeholder="precio">
                                    </div>
                                    <div class="mb-3">
                                        <input type="file" class="form-control" name="img" placeholder="imagen producto">
                                    </div>
                                    <div class="form-check " style="padding-left: 2rem;">
                                        <div class="row">
                                            <div class="input-group lg-5">
                                                <label class="form-check-label" style="color: black;" id="domicilio" for="flexCheckDefault">Realiza domicilios?</label>
                                                <input class="form-check-input" style="width: 20px ; height:20px; padding-left: 40px;;" type="checkbox" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-2" id="add"></div> <!-- id= add para designar el lugar donde quiere decignar JS -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-lg 12" style="padding-top: 5rem;">
                    <div class="card">
                        <div class="card-body">

                            <h2>Mis productos</h2> <br>
                            <div class="row">
                                <?php foreach ($productos as $p) { ?>
                                    <div class="col-lg-4 col-md-3" style="padding-right: 2rem;">
                                        <div class="card ">
                                            <div class="card-body btn-success">
                                                <img src="<?= base_url() ?>assets/img/<?= $p->img  ?>" alt="imagen" width="270px" height="250px" class="d-flex">
                                                <h3 style="color:black"><?= $p->nombre ?></h3>
                                                <p style="color:black">Precio: $<?= number_format($p->precio, 0) ?></p>
                                                <?php if ($p->valor_domicilio > 0) { ?>
                                                    <p style="color:black">Domicilio: $<?= number_format($p->valor_domicilio, 0) ?></p>
                                                <?php } else { ?>
                                                    <p style="color:black">Domicilio: No Domicilio</p>
                                                <?php } ?>
                                                <!-- Button trigger modal Eliminar -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarproducto<?= $p->id ?>">
                                                    Eliminar
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="eliminarproducto<?= $p->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="<?= base_url() ?>Comercio/eliminarProducto/<?= $p->id ?>" method="post">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel" style="color:black">Eliminar Producto</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h3 style="color: black;">Estas seguro que quieres eliminar <?= $p->nombre ?> ?</h3> <input type="hidden" class="visually-hidden" name="id_usuario" value="<?= $perfil->id ?> " placeholder="id-producto">
                                                                    <input type="hidden" value="<?= $perfil->id ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-danger">Eliminar</a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br><br>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
</body>
<?php } ?>