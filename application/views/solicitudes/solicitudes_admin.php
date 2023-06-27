<div style="margin:20px;">
    <div class="col-lg-12" style="margin-top: 2rem;">
        <div class="card">
            <div class="card-body">
                <h2 class="m-b-0">
                    <?= $perfil->nombre ?>
                    <?= $perfil->apellido1 ?>
                </h2>
                <p class=" m-b-0">
                    <?= $perfil->correo ?>
                </p>
                <h4>Solicitudes retiro Usuarios:</h4>
                <div class="table-responsive">

                    <table class="table" id="order-listing">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">fecha</th>
                                <th scope="col">Nombre usuario</th>
                                <th scope="col">Apellido usuario</th>
                                <th scope="col">Cedula</th>
                                <th scope="col">valor</th>
                                <th scope="col">Banco</th>
                                <th scope="col">N° Cuenta</th>
                                <th scope="col">Estado</th>
                                <th scope="col">buton</th>
                                <th scope="col">Comprobante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tb_user as $t) { ?>
                                <tr <?php if ($t->estado == 0) { ?> style="background-color: #E7F778 ;" <?php } else { ?>
                                        style="background-color: #8CF95C ;" <?php } ?>>
                                    <td>
                                        <?= $t->id ?>
                                    </td>
                                    <td>
                                        <?= $t->fecha ?>
                                    </td>
                                    <td>
                                        <?= $t->nombre ?>
                                    </td>
                                    <td>
                                        <?= $t->apellido1 ?>
                                    </td>
                                    <td>
                                        <?= $t->cedula ?>
                                    </td>
                                    <td>
                                        <?= number_format($t->valor, 0) ?>
                                    </td>
                                    <td>
                                        <?= $t->banco ?>
                                    </td>
                                    <td>
                                        <?= $t->num_cuenta ?>
                                    </td>
                                    <?php if ($t->estado == 0) { ?>
                                        <td>Pendiente</td>
                                        <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#solicitud<?= $t->id ?>"> Enviar</button></td>
                                        <td></td>
                                    <?php } else { ?>
                                        <td>Realizado</td>
                                        <td><a
                                                href="<?= base_url() ?>assets/img/soporte/envio_solicitudes/<?= $t->comprobante ?>"><?=
                                                        $t->comprobante ?></a></td>
                                        <td></td>
                                    <?php } ?>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="solicitud<?= $t->id ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="<?= base_url() ?>Solicitudes/aprobacionUser/<?= $t->id ?>"
                                                method="POST" enctype="multipart/form-data">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Estas seguro de
                                                        enviar la solicitud #
                                                        <?= $t->id ?>
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>
                                                        Datos envio: <br>
                                                        Nombre Cliente:
                                                        <?= $t->nombre ?><br>
                                                        Apellido Cliente:
                                                        <?= $t->apellido1 ?><br>
                                                        Banco:
                                                        <?= $t->banco ?><br>
                                                        N° cuenta:
                                                        <?= $t->num_cuenta ?><br>
                                                        Valor:
                                                        <?= number_format($t->valor, 0) ?><br> <br>
                                                    </h5>
                                                    <input type="file" name="img">
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
    <div class="col-lg-12" style="padding-top: 2rem;">
        <div class="card">
            <div class="card-body">

                <h2 class="m-b-0">
                    <?= $perfil->nombre ?>
                    <?= $perfil->apellido1 ?>
                </h2>
                <p class=" m-b-0">
                    <?= $perfil->correo ?>
                </p>

                <h4>Solicitudes retiro Comercio:</h4>
                <div class="table-responsive">

                    <table class="table" id="order-listing2">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">fecha</th>
                                <th scope="col">Nombre Negocio</th>
                                <th scope="col">Celula</th>
                                <th scope="col">valor</th>
                                <th scope="col">Banco</th>
                                <th scope="col">N° Cuenta</th>
                                <th scope="col">Estado</th>
                                <th scope="col">buton</th>
                                <th scope="col">Comprobante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tb_comer as $t) { ?>
                                <tr <?php if ($t->estado == 0) { ?> style="background-color: #E7F778 ;" <?php } else { ?>
                                        style="background-color: #8CF95C ;" <?php } ?>>
                                    <td>
                                        <?= $t->id ?>
                                    </td>
                                    <td>
                                        <?= $t->fecha ?>
                                    </td>
                                    <td>
                                        <?= $t->nombre_negocio ?>
                                    </td>
                                    <td>
                                        <?= $t->celular ?>
                                    </td>
                                    <td>
                                        <?= number_format($t->valor, 0) ?>
                                    </td>
                                    <td>
                                        <?= $t->banco ?>
                                    </td>
                                    <td>
                                        <?= $t->num_cuenta ?>
                                    </td>
                                    <?php if ($t->estado == 0) { ?>
                                        <td>Pendiente</td>
                                        <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#solicitud<?= $t->id ?>"> Enviar</button></td>
                                        <td></td>
                                    <?php } else { ?>
                                        <td>Realizado</td>
                                        <td><a
                                                href="<?= base_url() ?>assets/img/soporte/envio_solicitudes/<?= $t->comprobante ?>"><?=
                                                        $t->comprobante ?></a></td>
                                        <td></td>
                                    <?php } ?>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="solicitud<?= $t->id ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="<?= base_url() ?>Solicitudes/aprobacionComer/<?= $t->id ?>"
                                                method="post" enctype="multipart/form-data">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Estas seguro de
                                                        enviar la solicitud #
                                                        <?= $t->id ?>
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>
                                                        Datos envio: <br>
                                                        Nombre Cliente:
                                                        <?= $t->nombre_negocio ?><br>
                                                        Banco:
                                                        <?= $t->banco ?><br>
                                                        N° cuenta:
                                                        <?= $t->num_cuenta ?><br> <br>
                                                    </h5>
                                                    <input type="file" name="img">
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
    <div class="col-lg-12" style="padding-top: 2rem;">
        <div class="card">
            <div class="card-body">

                <h2 class="m-b-0">
                    <?= $perfil->nombre ?>
                    <?= $perfil->apellido1 ?>
                </h2>

                <h4>Historial de paso de E-puntos a billetera:</h4>
                <div class="table-responsive">
                    <table class="table" id="order-listing4">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">fecha</th>
                                <th scope="col">Nombre usuario</th>
                                <th scope="col">Apellido usuario</th>
                                <th scope="col">Cedula</th>
                                <th scope="col">Celular</th>
                                <th scope="col">valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tb_paso as $t) { ?>
                                <tr>
                                    <td>
                                        <?= $t->id ?>
                                    </td>
                                    <td>
                                        <?= $t->fecha ?>
                                    </td>
                                    <td>
                                        <?= $t->nombre ?>
                                    </td>
                                    <td>
                                        <?= $t->apellido1 ?>
                                    </td>
                                    <td>
                                        <?= $t->cedula ?>
                                    </td>
                                    <td>
                                        <?= $t->celular ?>
                                    </td>
                                    <td>
                                        <?= $t->valor ?>
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