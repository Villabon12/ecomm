<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">

            <div class="col-lg 12">
                <div class="card">
                    <div class="card-body">
                        <h4><?= $perfil->nombre ?> <?= $perfil->apellido1 ?></h4>
                        <h4><?= $perfil->nombre_negocio ?></h4>
                        <h5>id_referido: <?= $perfil->id ?></h5>
                        <h5>Historial recargas Usuarios</h5>
                        <br>
                        <table class="table" id="order-listing2">
                            <thead>
                                <tr>
                                    <th>codigo</th>
                                    <th>Nombre_negocio</th>
                                    <th>Nombre Cliente</th>
                                    <th>fecha pago</th>
                                    <th>valor</th>
                                    <th>estado</th>
                                    <th>truce_cuentas</th>
                                    <th>comprobante</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($historial_reca as $h) { ?>
                                    <tr>
                                        <td><?= $h->id ?></td>
                                        <td><?= $h->nombre_negocio ?></td>
                                        <td><?= $h->nombre ?></td>
                                        <td><?= $h->fecha_pago ?></td>
                                        <td><?= number_format($h->valor, 0)  ?></td>
                                        <?php if ($h->estado == "debe") { ?>
                                            <td> <button type="" class="btn btn-danger"><?= $h->estado ?></button></td>
                                        <?php } else if ($h->estado == "pendiente_confirmacion") { ?>
                                            <td> <button type="" class="btn btn-warning"><?= $h->estado ?></button></td>
                                        <?php } else { ?>
                                            <td> <button type="" class="btn btn-success"><?= $h->estado ?></button></td>
                                        <?php } ?>
                                        <td><a href="<?= base_url() ?>assets/img/<?= $h->img ?>"><?= $h->img ?></a></td>
                                        <td>
                                            <!-- Button Aceptar  modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#aceptar<?= $h->id ?>">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="aceptar<?= $h->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" style="color: black;" id="exampleModalLabel">Esta seguro que quiere Aceptar el pago <?= $h->id ?> </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="<?= base_url() ?>comercio/aceptarPago/<?= $h->id ?>" method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" value="<?= $h->valor ?>" name="valor">
                                                                <input type="hidden" value="<?= $h->id_negocio ?>" name="id_negocio">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-warning">Confirmar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#negar<?= $h->id ?>">
                                            <i class="fa-solid fa-ban"></i>
                                        </button>
                                        <div class="modal fade" id="negar<?= $h->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Esta seguro que quiere negar la #<?= $h->id ?>?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?= base_url() ?>comercio/Comercio/NegarPago/<?= $h->id ?>" method="POST">
                                                        <div class="modal-body">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Negar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> -->

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card cc-widget">
                    <div class="card-body">
                        <h4>Tabla general deudas comercio</h4>
                        <table class="table" id="order-listing">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre negocio</th>
                                    <th scope="col">Cuenta Deudora</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($total_cuentas as $t) { ?>
                                    <tr>
                                        <td><?= $t->nombre_negocio ?></td>
                                        <td><?= number_format($t->cuenta_COP_deuda, 0)  ?></td>
                                    </tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-4">
                <div class="card cc-widget">
                    <div class="card-body">
                        <div class="d-flex no-block flex-row">
                            <div class="cc-icon align-self-center"><i class="cc USDT auni" title="BTC"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                <h5 class="text-muted m-b-0"> $<?= number_format($suma->suma, 0)  ?> Pesos Colombianos</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
<!-- Button trigger modal -->