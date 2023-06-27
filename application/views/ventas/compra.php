<div class="tablas" style="margin:20px;">
    <div class="col-lg 12" style="margin-top: 2rem;">
        <div class="card">
            <div class="card-body">
                <?php if ($this->session->flashdata("error")) { ?>
                    <p>
                        <?php echo $this->session->flashdata("error") ?>
                    </p>
                <?php } ?>
                <h4> Bienvenido
                    <?= $perfil->nombre ?>
                    <?= $perfil->apellido1 ?>
                </h4>
                <h4>
                    <?= $perfil->nombre_negocio ?>
                </h4>
                <h5>Tus compras detalladas:</h5>
                <br>
                <div class="table-responsive">
                    <table class="table" id="order-listing">
                        <thead>
                            <tr>
                                <th scope="col">Nombre Cliente</th>
                                <th scope="col">Negocio</th>
                                <th scope="col">Producto</th>
                                <th scope="col">cantidad</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Fecha Compra</th>
                                <th scope="col">Estado</th>
                                <th scope="col">confirmar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cp as $h) { ?>
                                <tr>
                                    <td>
                                        <?= $h->nombre ?>
                                    </td>
                                    <td>
                                        <?= $h->nombre_negocio ?>
                                    </td>
                                    <td>
                                        <?= $h->producto ?>
                                    </td>
                                    <td>
                                        <?= $h->cantidad ?>
                                    </td>
                                    <td>
                                        <?= number_format($h->precio, 0) ?>
                                    </td>
                                    <td>
                                        <?= $h->fecha_compra ?>
                                    </td>
                                    <?php if ($h->estado == "Compra existosa") { ?>
                                        <td> <button type="button" class="btn btn-success">Compra Exitosa</button></td>
                                    <?php } else { ?>
                                        <td><button type="button" class="btn btn-danger">
                                                <?= $h->estado ?>
                                            </button></td>
                                    <?php } ?>
                                    <?php if ($h->estado == "pendiente" || $h->estado == "confirmado comercio") { ?>
                                        <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#compra<?= $h->id ?>">confirmar</button></td>
                                    <?php } else { ?>
                                        <td><i class="mdi mdi-check-circle " style="color: #20EADA; font-size:25px;"></i></td>
                                    <?php } ?>
                                    <!-- Modal -->
                                    <div class="modal fade" id="compra<?= $h->id ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmacion </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="post"
                                                    action="<?= base_url() ?>Proceso/Aceptarcomprafisica/<?= $h->id ?>">
                                                    <div class="modal-body">
                                                        ¿Esta seguro que ya tiene su producto?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Aceptar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg 12" style="margin-top: 20px;">
        <div class="card">
            <div class="card-body">
                <h4> Bienvenido
                    <?= $perfil->nombre ?>
                </h4>
                <h5>Tus Carrito:</h5>
                <br>
                <div class="table-responsive">
                    <table class="table" id="order-listing2">
                        <thead>
                            <tr>
                                <th scope="col">Fecha Compra</th>
                                <th scope="col">codigo</th>
                                <th scope="col">detallles</th>
                                <th scope="col">Total</th>
                                <th scope="col">Estado</th>
                                <th scope="col">confirmar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($carrito as $h) { ?>
                                <tr>
                                    <td>
                                        <?= $h->fecha ?>
                                    </td>
                                    <td>
                                        <?= $h->codigo ?>
                                    </td>
                                    <td><a type="button" target="_blank"
                                            href="<?= base_url() ?>proceso/detalles2/<?= $h->id ?>"
                                            class="btn btn-warning"><i class="mdi mdi-magnify"></i> </a></td>
                                    <td>
                                        <?= number_format($h->total, 0) ?>
                                    </td>
                                    <?php if ($h->estado == 1) { ?>
                                        <td><button type="button" class="btn btn-danger">pendiente </button></td>
                                    <?php } else { ?>
                                        <td> <button type="button" class="btn btn-success">Compra Exitosa</button></td>
                                    <?php } ?>
                                    <?php if ($h->estado == 1) { ?>
                                        <td></td>
                                    <?php } else { ?>
                                        <td><i class="mdi mdi-check-circle " style="color: #20EADA; font-size:25px;"></i></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg 12" style="margin-top: 20px;">
        <div class="card">
            <div class="card-body">
                <?php if ($this->session->flashdata("error2")) { ?>
                    <p>
                        <?php echo $this->session->flashdata("error2") ?>
                    </p>
                <?php } ?>
                <h4> Bienvenido
                    <?= $perfil->nombre ?>
                    <?= $perfil->apellido1 ?>
                </h4>
                <h4>
                    <?= $perfil->nombre_negocio ?>
                </h4>
                <h5>Tus compras a domilicio:</h5>
                <br>
                <div class="table-responsive">
                    <table class="table" id="order-listing4">
                        <thead>
                            <tr>
                                <th scope="col">Nombre Cliente</th>
                                <th scope="col">Negocio</th>
                                <th scope="col">Producto</th>
                                <th scope="col">cantidad</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Fecha Compra</th>
                                <th scope="col">direccion</th>
                                <th scope="col">valor domicilio</th>
                                <th scope="col">Estado</th>
                                <th scope="col">confirmar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cd as $h) { ?>
                                <tr>
                                    <td>
                                        <?= $h->nombre ?>
                                    </td>
                                    <td>
                                        <?= $h->nombre_negocio ?>
                                    </td>
                                    <td>
                                        <?= $h->producto ?>
                                    </td>
                                    <td>
                                        <?= $h->cantidad ?>
                                    </td>
                                    <td>$
                                        <?= number_format($h->precio, 0) ?>
                                    </td>
                                    <td>
                                        <?= $h->fecha_compra ?>
                                    </td>
                                    <td>
                                        <?= $h->direccion ?>
                                    </td>
                                    <td>$
                                        <?= number_format($h->valor_domicilio, 0) ?>
                                    </td>
                                    <?php if ($h->estado == "Compra existosa") { ?>
                                        <td> <button type="button" class="btn btn-success">Compra Exitosa</button></td>
                                    <?php } else { ?>
                                        <td><button type="button" class="btn btn-danger">
                                                <?= $h->estado ?>
                                            </button></td>
                                    <?php } ?>
                                    <?php if ($h->estado == "pendiente" || $h->estado == "confirmado comercio") { ?>
                                        <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#compra<?= $h->id ?>">confirmar</button></td>
                                    <?php } else { ?>
                                        <td><i class="mdi mdi-check-circle " style="color: #20EADA; font-size:25px;"></i></td>
                                    <?php } ?>
                                    <!-- Modal -->
                                    <div class="modal fade" id="compra<?= $h->id ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmacion </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="post"
                                                    action="<?= base_url() ?>Proceso/Aceptarcomprafisica/<?= $h->id ?>">
                                                    <div class="modal-body">
                                                        ¿Esta seguro que ya tiene su producto?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Aceptar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php if ($contar->contar >= 1) { ?>
        <div class="col-lg 12" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-body">
                            <?php if ($this->session->flashdata("error2")) { ?>
                                <p><?php echo $this->session->flashdata("error2") ?></p>
                            <?php } ?>
                            <h4> Hola <?= $perfil->nombre ?> <?= $perfil->apellido1 ?>!</h4>
                            <h5>Tus cotizaciones de Seguros</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="order-listing6">
                                    <thead>
                                        <tr>
                                            <th scope="col">Fecha cotizacion</th>
                                            <th scope="col">Nombre seguro</th>
                                            <th scope="col">duracion</th>
                                            <th scope="col">descripcion</th>
                                            <th scope="col">estado</th>
                                            <th scope="col">cotizacion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tb as $h) { ?>
                                            <tr>
                                                <td><?= $h->fecha_cotizacion ?></td>
                                                <td><?= $h->nombre_seguro ?></td>
                                                <td><?= $h->duracion ?></td>
                                                <td><?= $h->descripcion ?></td>
                                                <?php if ($h->estado == 0) { ?>
                                                    <td><button class="btn btn-warning btn-sm">Pendiente</button></td>
                                                <?php } else { ?>
                                                    <td><button class="btn btn-success btn-sm">Cotizacion enviada</button></td>
                                                <?php } ?>
                                                <td><a target="_blank" href="<?= base_url() ?>assets/img/seguros/<?= $h->img ?>"><?= $h->img ?></a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        </div>
    <?php } ?>
</div>