<div style="margin:20px;">
    <div class="col-lg 12 col-md-12" style="margin-bottom:20px;">
        <div class="card cc-widget">
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
                <h5>Datos negocios Asociados</h5>
                <br>
                <div class="table-responsive">
                    <table class="table" id="order-listing">
                        <thead>
                            <tr>
                                <th scope="col">Nombre Comercio</th>
                                <th scope="col">Nombre Encargado</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Cedula frente</th>
                                <th scope="col">Cedula trasera</th>
                                <th scope="col">Rut</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Aprobar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($validacion as $v) { ?>
                                <tr>
                                    <td>
                                        <?= $v->nombre_negocio ?>
                                    </td>
                                    <td>
                                        <?= $v->nombre ?>
                                    </td>
                                    <td>
                                        <?= $v->celular ?>
                                    </td>
                                    <td><a target="_blank"
                                            href="<?= base_url() ?>asset/images/confirmacion/<?= $v->img_cedula_front ?>">imagen
                                            cedula frontal</a></td>
                                    <td><a target="_blank"
                                            href="<?= base_url() ?>asset/images/confirmacion/<?= $v->img_cedula_back ?>">imagen
                                            cedula trasera</a></td>
                                    <td><a target="_blank" href="<?= base_url() ?>asset/images/confirmacion/<?= $v->RUT ?>">
                                            <?=
                                                $v->RUT ?></a></td>
                                    <?php if ($v->estado == 0) { ?>
                                        <td>
                                            <p style="color: red;">Inhabilitado</p>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#aprobarvalidacion<?= $v->id ?>">
                                                Habilitar
                                            </button>
                                        </td>

                                    <?php } else { ?>
                                        <td></td>
                                        <td>
                                            <p style="color: green;"> Habilitado </p>
                                        </td>
                                    <?php } ?>
                                    <!-- Modal -->
                                    <div class="modal fade" id="aprobarvalidacion<?= $v->id ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title fs-5" id="exampleModalLabel">validacion
                                                        de
                                                        <?= $v->nombre_negocio ?>
                                                    </h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="<?= base_url() ?>validacion/habilitarComer/<?= $v->id ?>"
                                                    method="post">
                                                    <div class="modal-body">
                                                        <p>Estas seguro que quieres habilitar a
                                                            <?= $v->nombre_negocio ?>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerra</button>
                                                        <button type="submit" class="btn btn-success">Habilitar</button>
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
    <div class="col-lg 12 col-md-12" style="margin-bottom:20px;">
        <div class="card cc-widget">
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
                <h5>Socios .Validar cuentas Bancarias </h5>
                <br>
                <div class="table-responsive">
                    <table class="table" id="order-listing3">
                        <thead>
                            <tr>
                                <th scope="col">Nombre cliente</th>
                                <th scope="col">Apellido cliente</th>
                                <th scope="col">Tipo Cuenta</th>
                                <th scope="col">Banco</th>
                                <th scope="col">Nº cuenta</th>
                                <th scope="col">certificado</th>
                                <th scope="col">estado</th>
                                <th scope="col">Aprobar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($banco as $b) { ?>
                                <tr>
                                    <td>
                                        <?= $b->nombre_negocio ?>
                                    </td>
                                    <td>
                                        <?= $b->titular ?>
                                    </td>
                                    <td>
                                        <?= $b->tipo ?>
                                    </td>
                                    <td>
                                        <?= $b->banco ?>
                                    </td>
                                    <td>
                                        <?= $b->numero ?>
                                    </td>
                                    <td><a target="_blank"
                                            href="<?= base_url() ?>assets\img\certificadosBanco\<?= $b->img ?>"><?=
                                                    $b->img ?> </a></td>
                                    <?php if ($b->estado == "En Validacion") { ?>
                                        <td>
                                            <p style="color: blue;">
                                                <?= $b->estado ?>
                                            </p>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#aprobarcuenta<?= $b->id ?>">
                                                Aprobar
                                            </button>
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="aprobarcuenta<?= $b->id ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">validacion
                                                            de cuenta de
                                                            <?= $b->nombre_negocio ?>
                                                        </h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?= base_url() ?>validacion/habilitarBanco/<?= $b->id ?>"
                                                        method="post">
                                                        <div class="modal-body">
                                                            <h3>Estas seguro de validar esta cuenta bancaria ?</h3>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-success">Aceptar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <td>
                                            <p style="color: green;">
                                                <?= $b->estado ?>
                                            </p>
                                        </td>
                                        <td></td>
                                    <?php } ?>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg 12 col-md-12">

        <div class="card cc-widget">
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
                <h5>Datos detallado de comercio</h5>
                <br>
                <div class="table-responsive">
                    <table class="table" id="order-listing2">
                        <thead>
                            <tr>
                                <th scope="col">Nombre Comercio</th>
                                <th scope="col">Nombre quien trajo</th>
                                <th scope="col">Apellido quien trajo</th>
                                <th scope="col">Celular quien trajo</th>
                                <th scope="col">N° productos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tb as $t) { ?>
                                <tr>
                                    <td>
                                        <?= $t->nombre_negocio ?>
                                    </td>
                                    <td>
                                        <?= $t->nombretraer ?>
                                    </td>
                                    <td>
                                        <?= $t->apellidotraer ?>
                                    </td>
                                    <td>
                                        <?= $t->celulartraer ?>
                                    </td>
                                    <td>
                                        <?= $t->cupon ?>
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