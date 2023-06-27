<div class="tablas" style="margin:20px;">
    <div class="row">
        <!-- Column -->
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

                    <h4>Historial recargas:</h4>

                    <div class="table-responsive">

                        <table class="table" id="order-listing">
                            <thead>
                                <tr>
                                    <th scope="col">fecha</th>
                                    <th scope="col">Nombre Negocio</th>
                                    <th scope="col">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tb_recar as $t) { ?>
                                    <tr>
                                        <td>
                                            <?= $t->fecha_pago ?>
                                        </td>
                                        <td>
                                            <?= $t->nombre_negocio ?>
                                        </td>
                                        <td>
                                            <?= number_format($t->valor_recarga, 0) ?>
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
    <div class="row" style="padding-top: 2rem;">
        <!-- Column -->
        <div class="col-lg-12">
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
    </div>
    <div class="row" style="padding-top: 2rem;">
        <!-- Column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h2 class="m-b-0">
                        <?= $perfil->nombre ?>
                        <?= $perfil->apellido1 ?>
                    </h2>
                    <p class=" m-b-0">
                        <?= $perfil->correo ?>
                    </p>

                    <h4>Historial Paso de E-puntos a billetera:</h4>

                    <div class="table-responsive">

                        <table class="table" id="order-listing4">
                            <thead>
                                <tr>
                                    <th scope="col">fecha</th>
                                    <th scope="col">valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tb_paso as $t) { ?>
                                    <tr>
                                        <td>
                                            <?= $t->fecha ?>
                                        </td>
                                        <td>
                                            <?= number_format($t->valor, 0) ?>
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
</div>