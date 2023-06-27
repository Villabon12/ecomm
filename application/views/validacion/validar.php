<div class="tablas" style="margin:20px;">
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
                <h5>Validar socios para agregar comercios </h5>
                <br>
                <div class="table-responsive">
                    <table class="table" id="order-listing">
                        <thead>
                            <tr>
                                <th scope="col">Nombre cliente</th>
                                <th scope="col">Apellido cliente</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Cedula</th>
                                <th scope="col">cedula frente</th>
                                <th scope="col">cedula trasera</th>
                                <th scope="col">Selfie user</th>
                                <th scope="col">estado</th>
                                <th scope="col">Aprobar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($validacion as $v) { ?>
                                <tr>
                                    <td>
                                        <?= $v->nombre ?>
                                    </td>
                                    <td>
                                        <?= $v->apellido1 ?>
                                    </td>
                                    <td>
                                        <?= $v->celular ?>
                                    </td>
                                    <td>
                                        <?= $v->cedula ?>
                                    </td>
                                    <td><a target="_blank"
                                            href="<?= base_url() ?>asset/images/confirmacion/<?= $v->img_cedula_front ?>">imagen
                                            cedula frontal</a></td>
                                    <td><a target="_blank"
                                            href="<?= base_url() ?>asset/images/confirmacion/<?= $v->img_cedula_back ?>">imagen
                                            cedula trasera</a></td>
                                    <td><a target="_blank"
                                            href="<?= base_url() ?>asset/images/confirmacion/<?= $v->img_selfie ?>">
                                            imagen selfie</a></td>
                                    <?php if ($v->verificar_user == "inac") { ?>
                                        <td>
                                            <p style="color: red;">
                                                <?= $v->verificar_user ?>
                                            </p>
                                        </td>

                                        <td>

                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#aprobarvalidacion<?= $v->id ?>">
                                                Aprobar
                                            </button>
                                        </td>

                                        <!-- Modal -->
                                        <div class="modal fade" id="aprobarvalidacion<?= $v->id ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">validacion
                                                            de cuenta de
                                                            <?= $v->nombre ?>
                                                            <?= $v->apellido1 ?>
                                                        </h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?= base_url() ?>validacion/habilitarUser/<?= $v->id ?>"
                                                        method="post">
                                                        <div class="modal-body">
                                                            <p>Estas seguro que quieres habilitar a
                                                                <?= $v->nombre ?>
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
                                    <?php } else { ?>
                                        <td>
                                            <p style="color: green;">
                                                <?= $v->verificar_user ?>
                                            </p>
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#bloquear<?= $v->id ?>">
                                                inhabilitar
                                            </button>
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="bloquear<?= $v->id ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">inhabilitar
                                                            <?= $v->nombre ?>
                                                            <?= $v->apellido1 ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?= base_url() ?>/validacion/inhabilitar/<?= $v->id ?>"
                                                        method="post">
                                                        <div class="modal-body">
                                                            Estas seguro de inhabilitar a
                                                            <?= $v->nombre ?>
                                                            <?= $v->apellido1 ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="subtmit" class="btn btn-success">Guardar
                                                                cambios</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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
                <h5>Seguimiento Usuarios con permiso para agregar comercios </h5>
                <br>
                <div class="table-responsive">
                    <table class="table" id="order-listing4">
                        <thead>
                            <tr>
                                <th scope="col">Nombre cliente</th>
                                <th scope="col">Apellido cliente</th>
                                <th scope="col">Celular</th>
                                <th scope="col">N° comercios</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Observacion</th>
                                <th scope="col">Fecha futura Observacion</th>
                                <th scope="col">Botones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tb as $b) { ?>
                                <tr>
                                    <td>
                                        <?= $b->nombre ?>
                                    </td>
                                    <td>
                                        <?= $b->apellido1 ?>
                                    </td>
                                    <td>
                                        <?= $b->celular ?>
                                    </td>
                                    <td>
                                        <?= $b->Cantidad ?>
                                    </td>
                                    <?php if ($b->verificar_user == "habilitado") { ?>
                                        <td><button type="button" class="btn btn-success btn sm">
                                                <?= $b->verificar_user ?>
                                            </button></td>
                                        <td></td>
                                        <td></td>
                                    <?php } else { ?>
                                        <td><button type="button" class="btn btn-warning btn sm">pendiente</button></td>
                                        <td>
                                            <?= $b->msm ?>
                                        </td>
                                        <td>
                                            <?= $b->fecha_msm ?>
                                        </td>
                                    <?php } ?>
                                    <td><button type="button" class="btn btn-danger btn sm" data-bs-toggle="modal"
                                            data-bs-target="#inac<?= $b->id_papa_pago ?>">Opciones</button></td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="inac<?= $b->id_papa_pago ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="<?= base_url() ?>Validacion/inhabilitar2/<?= $b->id_papa_pago ?>"
                                                method="post">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Esta segura
                                                        de inhabilitar a
                                                        <?= $b->nombre . " " . $b->apellido1 ?>
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="">Opciones</label>
                                                    <select class="form-select form-select-sm" name="estado"
                                                        aria-label=".form-select-sm example">
                                                        <option value="1" selected>inhabilitar</option>
                                                        <option value="2">Pediente</option>
                                                        <option value="3">Habilitar</option>
                                                    </select><br>
                                                    <label for="">Observacion:</label> <br>
                                                    <input type="text" name="msm" class="form-control form-control-sm"> <br>
                                                    <label for="">Fecha futuro seguimiento:</label> <br>
                                                    <input type="date" name="fecha" class="form-control form-control-sm">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-danger btn-sm">Aceptar</button>
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
                <h5>Socios .Validar cuentas Bancarias </h5>
                <br>
                <div class="table-responsive">
                    <table class="table" id="order-listing2">
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
                                        <?= $b->nombre ?>
                                    </td>
                                    <td>
                                        <?= $b->apellido1 ?>
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
                                            href="<?= base_url() ?>assets\img\certificadosBanco\<?= $b->img ?>"> <?=
                                                    $b->img ?></a></td>
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
                                                            <?= $b->nombre ?>
                                                            <?= $b->apellido1 ?>
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
                                                            <button type="submit" class="btn btn-warning">Aceptar</button>
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
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>