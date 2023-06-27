<div class="tablas" style="margin:20px;margin-bottom:20px;">
    <div class="col-lg-12"style="margin-bottom:20px;">
        <div class="card">
            <div class="card-body">

                <h2 class="m-b-0">
                    <?= $perfil->nombre ?>
                    <?= $perfil->apellido1 ?>
                </h2>
                <p class=" m-b-0">
                    <?= $perfil->correo ?>
                </p>

                <h4>Historial solicitud de pago:</h4>

                <div class="table-responsive">

                    <table class="table" id="order-listing2">
                        <thead>
                            <tr>
                                <th scope="col">fecha</th>
                                <th scope="col">banco</th>
                                <th scope="col"># cuenta</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Comprobante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tb_soli as $t) { ?>
                                <tr <?php if ($t->estado == 0) { ?> style="background-color: #E7F778 ;" <?php } else { ?>
                                        style="background-color: #8CF95C ;" <?php } ?>>
                                    <td>
                                        <?= $t->fecha ?>
                                    </td>
                                    <td>
                                        <?= $t->banco ?>
                                    </td>
                                    <td>
                                        <?= $t->num_cuenta ?>
                                    </td>
                                    <td>
                                        <?= number_format($t->valor, 0) ?>
                                    </td>
                                    <?php if ($t->estado == 0) { ?>
                                        <td>En tramite de trasnferencia</td>
                                        <td></td>
                                    <?php } else { ?>
                                        <td>trasnferencia exitosa</td>
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4>Historial pago cuenta dedudora:</h4>

                <div class="table-responsive">

                    <table class="table" id="order-listing6">
                        <thead>
                            <tr>
                                <th scope="col">fecha</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Comprobante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tb_pagos as $t) { ?>
                                <tr>
                                    <td>
                                        <?= $t->fecha ?>
                                    </td>
                                    <td>
                                        <?= number_format($t->valor, 0) ?>
                                    </td>
                                    <?php if ($t->estado == 1) { ?>
                                        <td><button type="button" class="btn btn-waring">En validacion</button></td>
                                        <td><a
                                                href="<?= base_url() ?>assets/img/certificadosBanco/transferencia/<?= $t->certificado ?>"><?=
                                                        $t->certificado ?></a></td>
                                    <?php } else { ?>
                                        <td><button type="button" class="btn btn-success">Aceptado</button></td>
                                        <td><a
                                                href="<?= base_url() ?>assets/img/certificadosBanco/transferencia/<?= $t->certificado ?>"><?=
                                                        $t->certificado ?></a></td>
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