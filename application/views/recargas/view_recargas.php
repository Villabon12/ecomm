<div class="tablas" style="margin:20px;">

    <div class="col-lg 12 col-md-12" style="margin-top: 2rem;">
        <div class="card cc-widget">
            <div class="card-body">
                <h4>
                    <?= $perfil->nombre ?>
                    <?= $perfil->apellido1 ?>
                </h4>
                <h4>
                    <?= $perfil->nombre_negocio ?>
                </h4>
                <h5>id_referido:</h5>
                <h5>Tabla autorizaciones de recargas</h5>
                <br>
                <div class="table-responsive">
                    <table class="table" id="order-listing6">
                        <thead>
                            <tr>
                                <th scope="col">Nombre Comercio</th>
                                <th scope="col">estado</th>
                                <th scope="col">botones</th>
                                <th scope="col">Cupo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recar as $t) { ?>
                                <tr <?php if ($t->auto_recar == 1) { ?> style="background-color: #EDEB65 ;" <?php } else if ($t->auto_recar == 2) { ?> style="background-color: #88ED65 ;" <?php } ?>>
                                    <td>
                                        <?= $t->nombre_negocio ?>
                                    </td>
                                    <?php if ($t->auto_recar == 1) { ?>
                                        <td>pendiente por autorizacion</td>
                                        <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#ajuste<?= $t->id ?>">Habilitar</button></td>
                                        <td> </td>
                                    <?php } else { ?>
                                        <td>Habilitado</td>
                                        <td><button type="button" class="btn btn-danger btn-sm " data-bs-toggle="modal"
                                                data-bs-target="#ajuste<?= $t->id ?>">inhabilitar</button></td>
                                        <td>$
                                            <?= number_format($t->valor, 0) ?> <br>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal<?= $t->id ?>">
                                                Modificar
                                            </button>

                                            <!-- <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ajustecupo<?= $t->id ?>"><i class="mdi mdi-wrench"></i></button></td> -->
                                        <?php } ?>
                                </tr>
                                <div class="modal fade" id="exampleModal<?= $t->id ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="<?= base_url() ?>Recargas/updatecupo/<?= $t->id ?>" method="post">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar
                                                        cupo</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="">Escoje el paquete</label>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="cupo">
                                                        <option selected value="<?= $t->id_cupo ?>"> <?=
                                                              number_format($t->valor, 0) ?></option>
                                                        <?php foreach ($info_cupos as $i) { ?>
                                                            <option value="<?= $i->id ?>"><?= number_format($i->valor, 0) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="ajuste<?= $t->id ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <?php if ($t->auto_recar == 1) { ?>
                                            <form action="<?= base_url() ?>Validacion/habilitar_recar/<?= $t->id ?>"
                                                method="post">
                                            <?php } else { ?>
                                                <form action="<?= base_url() ?>Validacion/inhabilitar_recar/<?= $t->id ?>"
                                                    method="post">
                                                <?php } ?>
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">¿Esta
                                                            seguro que quieres
                                                            <?php if ($t->auto_recar == 1) { ?> habilitar
                                                            <?php } else { ?> inhabilitar
                                                            <?php } ?> a
                                                            <?= $t->nombre_negocio ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit"
                                                            class="btn btn-success btn-sm">Aceptar</button>
                                                    </div>
                                            </form>
                                    </div>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg 12" style="margin-top: 2rem;">
        <div class="card">
            <div class="card-body">
                <h4>
                    <?= $perfil->nombre ?>
                    <?= $perfil->apellido1 ?>
                </h4>
                <h4>
                    <?= $perfil->nombre_negocio ?>
                </h4>
                <h5>id_referido:
                    <?= $perfil->id ?>
                </h5>
                <h5>Historial recargas Usuarios</h5>
                <br>
                <div class="table-responsive">
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
                                    <td>
                                        <?= $h->id ?>
                                    </td>
                                    <td>
                                        <?= $h->nombre_negocio ?>
                                    </td>
                                    <td>
                                        <?= $h->nombre ?>
                                    </td>
                                    <td>
                                        <?= $h->fecha_pago ?>
                                    </td>
                                    <td>
                                        <?= number_format($h->valor, 0) ?>
                                    </td>
                                    <?php if ($h->estado == "debe") { ?>
                                        <td> <button type="" class="btn btn-danger">
                                                <?= $h->estado ?>
                                            </button></td>
                                    <?php } else if ($h->estado == "pendiente_confirmacion") { ?>
                                            <td> <button type="" class="btn btn-warning">
                                                <?= $h->estado ?>
                                                </button></td>
                                    <?php } else { ?>
                                            <td> <button type="" class="btn btn-success">
                                                <?= $h->estado ?>
                                                </button></td>
                                    <?php } ?>
                                    <td><a href="<?= base_url() ?>assets/img/<?= $h->img ?>"><?= $h->img ?></a></td>
                                    <td>
                                        <!-- Button Aceptar  modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#aceptar<?= $h->id ?>">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="aceptar<?= $h->id ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" style="color: black;"
                                                            id="exampleModalLabel">
                                                            Esta seguro que quiere Aceptar el
                                                            pago
                                                            <?= $h->id ?>
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?= base_url() ?>comercio/aceptarPago/<?= $h->id ?>"
                                                        method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" value="<?= $h->valor ?>" name="valor">
                                                            <input type="hidden" value="<?= $h->id_negocio ?>"
                                                                name="id_negocio">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-warning">Confirmar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="margin-top: 2rem;">
        <div class="card cc-widget">
            <div class="card-body">
                <h4>Tabla Comercios por cupo de recargas</h4>
                <div class="table-responsive">

                    <table class="table" id="order-listing7">
                        <thead>
                            <tr>
                                <th scope="col">fecha Pago</th>
                                <th scope="col">codigo</th>
                                <th scope="col">Nombre negocio</th>
                                <th scope="col">nombre paquete</th>
                                <th scope="col">Valor cupo Actual</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Certificado</th>
                                <th scope="col">Validar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tb_cupos as $i) { ?>
                                <tr>
                                    <td>
                                        <?= $i->fecha ?>
                                    </td>
                                    <td>
                                        <?= $i->id ?>
                                    </td>
                                    <td>
                                        <?= $i->nombre_negocio ?>
                                    </td>
                                    <td>
                                        <?= $i->nombre_paquete ?>
                                    </td>
                                    <td>
                                        <?= number_format($i->cupo, 0) ?>
                                    </td>
                                    <?php if ($i->estado == 0) { ?>
                                        <td> <button type="" class="btn btn-danger"> Proceso validacion</button></td>
                                    <?php } else { ?>
                                        <td> <button type="" class="btn btn-success">Activado</button></td>
                                    <?php } ?>
                                    <td><a href="<?= base_url() ?>assets/img/certificadosBanco/<?= $i->img ?>"><?=
                                            $i->img ?></a></td>
                                    <td><button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal"
                                            data-bs-target="#cupos<?= $i->id ?>">Validar</button></td>
                                </tr>
                                <div class="modal fade" id="cupos<?= $i->id ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Esta seguro que quiere
                                                    Aceptar la petición #
                                                    <?= $i->id ?>?
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="<?= base_url() ?>Recargas/Aceptar_pago/<?= $i->id ?>"
                                                method="get">
                                                <div class="modal-body">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Cerrar</button>
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
    <div class="col-lg-4" style="margin-top: 2rem;">
        <div class="card cc-widget">
            <div class="card-body">
                <div class="d-flex no-block flex-row">
                    <div class="cc-icon align-self-center"><i class="cc USDT auni" title="BTC"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                        <h5 class="text-muted m-b-0"> $
                            <?= number_format($suma->suma, 0) ?> Pesos Colombianos
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="margin-top: 2rem;">
        <div class="card cc-widget">
            <div class="card-body">
                <h4>Tabla general deudas comercio</h4>

                <table class="table" id="order-listing">
                    <thead>
                        <tr>
                            <th scope="col">Nombre negocio</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Cuenta Deudora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($total_cuentas as $t) { ?>
                            <tr>
                                <td>
                                    <?= $t->nombre_negocio ?>
                                </td>
                                <td>
                                    <?= $t->celular ?>
                                </td>
                                <?php if ($t->cuenta_COP_deuda > 0) { ?>
                                    <td style="background-color: #EDEB65;">$
                                        <?= number_format($t->cuenta_COP_deuda, 0) ?>
                                    </td>
                                <?php } else { ?>
                                    <td>$
                                        <?= number_format($t->cuenta_COP_deuda, 0) ?>
                                    </td>
                                <?php } ?>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="padding-top:2rem;">
        <div class="card cc-widget">
            <div class="card-body">
                <h4>Pagos directos cuenta deudora</h4>
                <div class="table-responsive">
                    <table class="table" id="order-listing4">
                        <thead>
                            <tr>
                                <th scope="col">fecha Pago</th>
                                <th scope="col">Nombre negocio</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Certificado</th>
                                <th scope="col">Validar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tb_pagos as $i) { ?>
                                <tr>
                                    <td>
                                        <?= $i->fecha ?>
                                    </td>
                                    <td>
                                        <?= $i->nombre_negocio ?>
                                    </td>
                                    <td>
                                        <?= number_format($i->valor, 0) ?>
                                    </td>
                                    <?php if ($i->estado == 1) { ?>
                                        <td> <button type="" class="btn btn-danger"> pendiente</button></td>
                                    <?php } else { ?>
                                        <td> <button type="" class="btn btn-success">revisado</button></td>
                                    <?php } ?>
                                    <td><a href="<?= base_url() ?>assets/img/certificadosBanco/transferencia/<?= $i->certificado ?>"
                                            target="_blank"><?=
                                                $i->certificado ?></a></td>
                                    <?php if ($i->estado == 1) { ?>
                                        <td><button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal"
                                                data-bs-target="#validar<?= $i->id ?>">Validar</button></td>
                                    <?php } else { ?>
                                        <td> </td>
                                    <?php } ?>
                                </tr>
                                <div class="modal fade" id="validar<?= $i->id ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Esta seguro que quiere
                                                    validar esta transferencia?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="<?= base_url() ?>Recargas/validarPago/<?= $i->id ?>"
                                                method="post">
                                                <div class="modal-body">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Cerrar</button>
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