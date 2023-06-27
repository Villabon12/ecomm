<div class="contenido" style="margin:20px;">
    <div class="container">
        <h1>Crear Tarjeta regalo</h1>
        <br>
        <!-- Agregar cupon modal -->
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#creartarjeta">
            Crear tarjeta
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
                <form action="<?= base_url() ?>Tarjetas/insertTarje/<?= $perfil->id ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <label for="">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" placeholder="valor">
                            </div><br>
                            <div class="mb-3">
                                <label for="">Cupo:</label>
                                <input type="number" class="form-control" name="cupo" placeholder="valor">
                            </div><br>
                            <div class="mb-3">
                                <label for="">Cantidad:</label>
                                <input type="number" class="form-control" name="cantidad" placeholder="Cantidad">
                            </div><br>
                            <div class="mb-3">
                                <label for=""> Porcentaje:</label>
                                <input type="numer" class="form-control" name="porcentaje" placeholder="Porcentaje">
                            </div>
                            <div class="mb-3" style="padding-right: 70px;">
                                <label class="form-label">Fecha de cierre</label>
                                <input type="datetime-local" class="form-control" name="fecha"
                                    placeholder="fecha cierre">
                            </div>
                            <!--id= add para designar el lugar donde quiere decignar JS  -->
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
                                <h2>Mis Tarjetas: </h2> <br>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table" id="order-listing4">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Valor</th>
                                                    <th scope="col">Porcentaje</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">fecha corte</th>
                                                    <th scope="col">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($tb as $t) { ?>

                                                    <tr>
                                                        <td><?= $t->nombre ?></td>
                                                        <td><?= number_format($t->valor, 0) ?></td>
                                                        <td><?= $t->descuento ?></td>
                                                        <?php if ($t->cantidad > 300) { ?>
                                                            <td>ilimitado</td>
                                                        <?php } else { ?>
                                                            <td><?= $t->cantidad ?></td>
                                                        <?php } ?>
                                                        <td><?= $t->fecha_corte ?></td>
                                                        <?php if ($t->estado == 1) { ?>
                                                            <td> <button type="button" class="btn btn-danger btn-sm " style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#eliminar<?= $t->id ?>">Inhabilitar Ecommvale</button></td>
                                                        <?php } else { ?>
                                                            <td><button type="button" class="btn btn-info  btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#eliminar<?= $t->id ?>">Habilitar Ecommvale</button></td>
                                                        <?php } ?>
                                                    </tr>
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

                                <h2>Tarjetas por validar: </h2> <br>

                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table" id="order-listing2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">fecha compra</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Apellido</th>
                                                    <th scope="col">Cedula</th>
                                                    <th scope="col">Nombre tarjeta</th>
                                                    <th scope="col">Valor</th>
                                                    <th scope="col">Validar</th>
                                                    <th scope="col">Certificado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($tb_vendi as $t) { ?>
                                                    <tr>
                                                        <td><?= $t->fecha_compra ?></td>
                                                        <td><?= $t->nombre ?></td>
                                                        <td><?= $t->apellido1 ?></td>
                                                        <td><?= $t->cedula ?></td>
                                                        <td><?= $t->nombre_tarje ?></td>
                                                        <td><?= number_format($t->cupo, 0) ?></td>
                                                        <?php if ($t->valida == 0) { ?>
                                                            <td><button type="button" class="btn btn-info  btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#validar<?= $t->id ?>">Validar</button></td>
                                                            <td></td>
                                                        <?php } else { ?>
                                                            <td></td>
                                                            <td><a target="_blank" href="<?= base_url() ?>assets/img/certificadosBanco/<?= $t->img ?>"> Comprobante</a></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="validar<?= $t->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="<?= base_url() ?>/Tarjetas/Valida_tarjeta/<?= $t->id ?>" method="post" enctype="multipart/form-data">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ya recibiste el pago de <?= $t->nombre . "" . $t->apellido1 ?> </h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="container">
                                                                            <label for="">Sube el certificado de tranferencia con el valor de $<?= number_format($t->cupo, 0) ?> </label>
                                                                            <input type="file" name="img">
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