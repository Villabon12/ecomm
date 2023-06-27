 <div class="tablas" style="margin:25px;">
    

    <div class="row">

                <div class="col-lg 12"  style="margin-bottom:15px;">
                    <div class="card" style="4rem;">
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
                            <h5>Tus Ventas Carrito:</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="order-listing2">
                                    <thead>
                                        <tr>
                                            <th scope="col">Fecha Compra</th>
                                            <th scope="col">codigo</th>
                                            <th scope="col">detallles</th>
                                            <th scope="col">Nombre Cliente</th>
                                            <th scope="col">Apellido Cliente</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Ganancias</th>
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
                                                            href="<?= base_url() ?>proceso/detalles/<?= $h->id ?>"
                                                            class="btn btn-warning"><i class="mdi mdi-magnify"></i> </a>
                                                        <?php if ($h->qr == null) { ?>
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                    data-bs-target="#generar<?= $h->id ?>">Generar</button>
                                                        <?php } else { ?>
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                    data-bs-target="#QR<?= $h->id ?>"><i
                                                                        class="mdi mdi-qrcode-scan"></i></button>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?= $h->nombre ?>
                                                    </td>
                                                    <td>
                                                        <?= $h->apellido1 ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($h->total, 0) ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($h->ganancias_comercio, 0) ?>
                                                    </td>
                                                    <?php if ($h->estado == 2) { ?>
                                                            <td> <button type="button" class="btn btn-success">Compra Exitosa</button>
                                                            </td>
                                                    <?php } else if ($h->estado == 3) { ?>
                                                                    <td><button type="button" class="btn btn-danger">Anulado</button></td>
                                                    <?php } else { ?>
                                                                    <td><button type="button" class="btn btn-danger">pendiente </button></td>
                                                    <?php } ?>
                                                    <?php if ($h->estado == 0 || $h->estado == 1) { ?>
                                                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                    data-bs-target="#compra<?= $h->id ?>">confirmar</button>
                                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                                    data-bs-target="#cancelar<?= $h->id ?>">Anular</button>
                                                            </td>
                                                    <?php } else if ($h->estado == 3) { ?>
                                                                    <td><button type="button" class="btn btn-danger">Anulado</button></td>
                                                    <?php } else { ?>
                                                                    <td><i class="mdi mdi-check-circle "
                                                                            style="color: #20EADA; font-size:25px;"></i></td>
                                                    <?php } ?>
                                                    <!-- Modal QR -->
                                                    <div class="modal fade" id="QR<?= $h->id ?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <center> <img src="<?= base_url() . $h->qr ?>" width="50%"
                                                                            height="50%" alt=""></center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Generar -->
                                                    <div class="modal fade" id="generar<?= $h->id ?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5>¿Esta seguro que desea generar el coodigo QR?</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="<?= base_url() ?>Proceso/generaQR/<?= $h->id ?>"
                                                                        method="get">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Aceptar</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Confirmar manual -->
                                                    <div class="modal fade" id="compra<?= $h->id ?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Confirmacion
                                                                    </h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form method="post"
                                                                    action="<?= base_url() ?>Proceso/aceptaCompraNego/<?= $h->id ?>">
                                                                    <div class="modal-body">
                                                                        ¿Esta seguro que ya despacho el pedido?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Aceptar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal anular manual -->
                                                    <div class="modal fade" id="cancelar<?= $h->id ?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Anular el
                                                                        pedido
                                                                    </h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form method="post"
                                                                    action="<?= base_url() ?>Proceso/rechazarPedido/<?= $h->id ?>">
                                                                    <div class="modal-body">
                                                                        ¿Esta seguro que desea cancelar este pedido?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary  btn-sm"
                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary  btn-sm">Aceptar</button>
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
                <br>
                <div class="col-lg 12" style="margin-bottom:15px;">
                    <div class="card" style="margin-top:2rem">
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
                            <h5>Tus ventas presenciales:</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="order-listing">
                                    <thead>
                                        <tr>
                                            <th scope="col">Fecha Compra</th>
                                            <th scope="col">Nombre Cliente</th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">cantidad</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Ganancias</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">confirmar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($vp as $v) { ?>
                                                <tr>
                                                    <td>
                                                        <?= $v->fecha_compra ?>
                                                    </td>
                                                    <td>
                                                        <?= $v->cliente ?>
                                                        <hr>Cedula:
                                                        <?= $v->cedula ?>
                                                    </td>
                                                    <td>
                                                        <?= $v->producto ?>
                                                    </td>
                                                    <td>
                                                        <?= $v->cantidad ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($v->precio, 0) ?>
                                                    </td>

                                                    <td>
                                                        <?= number_format($v->ganancias_comercio, 0) ?>
                                                    </td>
                                                    <?php if ($v->estado == "Compra existosa") { ?>
                                                            <td><button type="button" class="btn btn-success">Venta Exitosa</button> </td>
                                                    <?php } else { ?>
                                                            <td> <button type="button" class="btn btn-danger">
                                                                    <?= $v->estado ?>
                                                                </button>
                                                            </td>
                                                    <?php } ?>
                                                    <?php if ($v->estado == "pendiente" || $v->estado == "confirmado Usuario") { ?>
                                                            <td>
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                    data-bs-target="#venta<?= $v->id ?>">confirmar</button>
                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                                    data-bs-target="#ventarechazo<?= $v->id ?>">Anular pedido</button>
                                                            </td>
                                                    <?php } else { ?>
                                                            <td><i class="mdi mdi-check-circle "
                                                                    style="color: #20EADA; font-size:25px;"></i></td>
                                                    <?php } ?>
                                                    <div class="modal fade" id="venta<?= $v->id ?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmacion
                                                                    </h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form method="post"
                                                                    action="<?= base_url() ?>Proceso/Aceptarcomprafisicacomer/<?= $v->id ?>">
                                                                    <div class="modal-body">
                                                                        ¿Esta seguro que ya despacho su producto?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Aceptar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="ventarechazo<?= $v->id ?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Anular
                                                                        pedido</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form method="POST"
                                                                    action="<?= base_url() ?>Proceso/rechazar_pedido/<?= $v->id ?>">
                                                                    <div class="modal-body">
                                                                        <p>¿Esta seguro que desea cancelar este pedido ?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-danger">Confirmar
                                                                            Anulación</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                                </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div><br>
            <br>
            <div class="row">
                <div class="col-lg 12" style="margin-bottom:15px;">
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
                            <h5>Tus ventas a domicilio:</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="order-listing4">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre Cliente</th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Fecha Compra</th>
                                            <th scope="col">Ganancias</th>
                                            <th scope="col">Direccion</th>
                                            <th scope="col">Valor domicilio</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">confirmar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($vd as $v) { ?>
                                                <tr>
                                                    <td>
                                                        <?= $v->cliente ?>
                                                    </td>
                                                    <td>
                                                        <?= $v->producto ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($v->precio, 0) ?>
                                                    </td>
                                                    <td>
                                                        <?= $v->fecha_compra ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($v->ganancias_comercio, 0) ?>
                                                    </td>
                                                    <td>
                                                        <?= $v->direccion ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($v->valor_domicilio, 0) ?>
                                                    </td>
                                                    <?php if ($v->estado == "Compra existosa") { ?>
                                                            <td><button type="button" class="btn btn-success">Venta Exitosa</button> </td>
                                                    <?php } else { ?>
                                                            <td> <button type="button" class="btn btn-danger">
                                                                    <?= $v->estado ?>
                                                                </button>
                                                            </td>
                                                    <?php } ?>
                                                    <?php if ($v->estado == "pendiente" || $v->estado == "confirmado Usuario") { ?>
                                                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                    data-bs-target="#venta<?= $v->id ?>">confirmar</button></td>
                                                    <?php } else { ?>
                                                            <td><i class="mdi mdi-check-circle "
                                                                    style="color: #20EADA; font-size:25px;"></i></td>
                                                    <?php } ?>
                                                    <div class="modal fade" id="venta<?= $v->id ?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmacion
                                                                    </h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form method="post"
                                                                    action="<?= base_url() ?>Proceso/Aceptarcomprafisicacomer/<?= $v->id ?>">
                                                                    <div class="modal-body">
                                                                        ¿Esta seguro que ya despacho su producto?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Aceptar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                                </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            </div> 