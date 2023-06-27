<div class="contenido" style="margin:20px;">
    <?php if ($this->session->flashdata("error")) { ?>
        <p>
            <?php echo $this->session->flashdata("error") ?>
        </p>
    <?php } ?>
    <div class="container">
        <h1>Crear Seguro</h1>
        <br>
        <!-- Agregar cupon modal -->
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#creartarjeta">
            Crear Seguro
        </button>
    </div>
    <!-- Modal create tarjeta -->
    <div class="modal fade" id="creartarjeta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Tarjeta regalo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url() ?>Seguros/insertdata/<?= $perfil->id ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <label for="">categoria:</label>
                                <select class="form-select" aria-label="Default select example" name="categoria">
                                    <?php foreach ($categorias as $c) { ?>
                                        <option value="<?= $c->id ?>"><?= $c->nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <label for="">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" placeholder="nombre seguro">
                            </div><br>
                            <div class="mb-3">
                                <label for="">Imagen:</label>
                                <input type="file" class="form-control" name="img" placeholder="imagen">
                            </div><br>
                            <div class="mb-3">
                                <label for=""> Tiempo vigencia:</label>
                                <input type="text" class="form-control" name="duracion" placeholder="duracion">
                            </div>
                            <div class="mb-3">
                                <label for=""> descripción:</label>
                                <textarea class="form-control" aria-label="With textarea" name="descripcion"></textarea>
                            </div>
                        </div>
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
                        <div class="card cc-widget">
                            <div class="card-body">

                                <h2>Mis Seguros: </h2> <br>

                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table" id="order-listing4">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Duracion</th>
                                                    <th scope="col">Descripcion</th>
                                                    <th scope="col">Modificar</th>
                                                    <th scope="col">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($tb_seguros as $t) { ?>

                                                    <tr>
                                                        <td><?= $t->nombre ?></td>
                                                        <td><?= $t->duracion ?></td>
                                                        <td><?= $t->descripcion ?></td>
                                                        <td><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modificar<?= $t->id ?>">Modificar</button></td>
                                                        <?php if ($t->estado == 1) { ?>
                                                            <td> <button type="button" class="btn btn-danger btn-sm " style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#habi<?= $t->id ?>">Inhabilitar Ecommvale</button></td>
                                                        <?php } else { ?>
                                                            <td><button type="button" class="btn btn-info  btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#habi<?= $t->id ?>">Habilitar Ecommvale</button></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modificar<?= $t->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="<?= base_url() ?>Seguros/updatedata/<?= $t->id ?>" method="get">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar <?= $t->nombre ?></h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="mb-3">
                                                                                <label for="">Nombre:</label>
                                                                                <input type="text" class="form-control" name="nombre" value="<?= $t->nombre ?>" placeholder="nombre seguro">
                                                                            </div><br>
                                                                            <div class=" mb-3" style="padding-right: 50px;">
                                                                                <label for="">Cantidad</label>
                                                                                <input type="number" class="form-control" value="<?= $t->cantidad ?>" name="stok" placeholder="stock">
                                                                            </div><br>
                                                                            <div class="mb-3">
                                                                                <label for=""> Tiempo vigencia:</label>
                                                                                <input type="text" class="form-control" name="duracion" value="<?= $t->duracion ?>" placeholder="duracion">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for=""> descripción:</label>
                                                                                <input type="text" class="form-control" aria-label="With textarea" value="<?= $t->descripcion ?>" name="descripcion">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="habi<?= $t->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <?php if ($t->estado == 1) { ?>
                                                                    <form action="<?= base_url() ?>Seguros/inhabilitar/<?= $t->id ?>" method="get">
                                                                    <?php   } else { ?>
                                                                        <form action="<?= base_url() ?>Seguros/habilitar/<?= $t->id ?>" method="get">
                                                                        <?php   } ?>

                                                                        <div class="modal-header">
                                                                            <?php if ($t->estado == 1) { ?>
                                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Esta seguro de Inhabilitar <?= $t->nombre ?></h1>
                                                                            <?php   } else { ?>
                                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Esta seguro de habilitar <?= $t->nombre ?></h1>
                                                                            <?php   } ?>

                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                                                            <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
                                                                        </div>
                                                                        </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg 12" style="padding-top: 5rem;">
                        <div class="card cc-widget">
                            <div class="card-body">

                                <h2>Seguros por validar: </h2> <br>

                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table" id="order-listing6">
                                            <thead>
                                                <tr>
                                                    <th scope="col">fecha cotizacion</th>
                                                    <th scope="col">categoria</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Apellido</th>
                                                    <th scope="col">Celular</th>
                                                    <th scope="col">Fecha nacimiento</th>
                                                    <th scope="col">Estado</th>
                                                    <th scope="col">Cotizacion</th>
                                                    <th scope="col">##</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($cotizaciones as $t) { ?>
                                                    <tr>
                                                        <td><?= $t->fecha_cotizacion ?></td>
                                                        <td><?= $t->categoria ?></td>
                                                        <td><?= $t->nombre ?></td>
                                                        <td><?= $t->apellido1 ?></td>
                                                        <td><?= $t->celular ?></td>
                                                        <td><?= $t->fecha_nacimiento ?></td>
                                                        <?php if ($t->estado == 0) { ?>
                                                            <td><button class="btn btn-warning btn-sm">Pendiente</button></td>
                                                        <?php } else { ?>
                                                            <td><button class="btn btn-success btn-sm">Cotizacion enviada</button></td>
                                                        <?php } ?>
                                                        <td><a target="_blank" href="<?= base_url() ?>assets/img/seguros/<?= $t->img ?>"><?= $t->img ?></a></td>
                                                        <?php if ($t->estado == 0) { ?>
                                                            <td><button type="button" class="btn btn-info  btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#validar<?= $t->id ?>">Validar</button></td>
                                                        <?php } else { ?>
                                                            <td>Valor:$<?= number_format($t->valor,0)  ?> <br>
                                                                Valor_prima:$<?= number_format( $t->prima,0) ?> <br>
                                                                Porcentaje:<?= $t->porcentaje ?>% <br>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>

                                                    <div class="modal fade" id="validar<?= $t->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="<?= base_url() ?>/Seguros/valida_seguros/<?= $t->id ?>" method="post" enctype="multipart/form-data">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Enviar cotizacion de <?= $t->nombre . " " . $t->apellido1 ?> </h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="mb-3">
                                                                                <label for="">Cotizacion:</label>
                                                                                <input type="file" name="img" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="">Valor Seguro:</label>
                                                                                <input type="number" class="form-control" name="valor" placeholder="valor">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="">Valor Prima:</label>
                                                                                <input type="number" class="form-control" name="prima" placeholder="prima">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="">Porcentaje acordado:</label>
                                                                                <input type="number" class="form-control" name="porcentaje" placeholder="porcentaje">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary  btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-success btn-sm">Enviar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
</div>