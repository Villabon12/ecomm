<div class="main-panel">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="content-wrapper">
        <?php if ($this->session->flashdata("realizado")) { ?>
            <p><?php echo $this->session->flashdata("realizado") ?></p>
        <?php } ?>
        <?php if ($this->session->flashdata("error_maximo")) { ?>
            <p><?php echo $this->session->flashdata("error_maximo") ?></p>
        <?php } ?>


        <div class="row">
            <!-- Column -->
            <!-- wallet usuario-->
            <?php if ($perfil->tipo == 'Socio') { ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block flex-row">
                                <div class="cc-icon align-self-center"><i class="mdi mdi-cards icon-lg"> </i></div>
                                <div class="m-l-10 align-self-center">
                                    <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                    <h5 class="text-muted m-b-0 blan">$<?= number_format($perfil->cuenta_COP, 0) ?></h5>
                                    <h6 class="text-muted m-b-0 blan"> Cashback: $<?= number_format($devolver->plata, 0) ?> </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if ($perfil->tipo == 'SocioAdmin') { ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card cc-widget">
                        <div class="card-body">
                            <div class="d-flex no-block flex-row">
                                <div class="cc-icon align-self-center"><i class="mdi mdi-cards icon-lg"></i></div>
                                <div class="m-l-10 align-self-center">
                                    <h4 class="m-b-0 amar">Pesos Colombianos </h4>
                                    <h5 class="text-muted m-b-0 blan"> saldo:$<?= number_format($perfil->cuenta_COP + $ganancias->ganancias, 0) ?></h5>
                                    <h6 class="text-muted m-b-0 blan"> Ganacias : $<?= number_format($perfil->cuenta_COP, 0) ?> </h6>
                                    <h6 class="text-muted m-b-0 blan"> Ganacias Negocios: $<?= number_format($ganancias->ganancias, 0) ?> </h6>
                                    <h6 class="text-muted m-b-0 blan"> Cuentas deudas: $<?= number_format($suma->suma, 0) ?> </h6>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if ($perfil->tipo == 'Comercio') { ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card cc-widget">
                        <div class="card-body">
                            <div class="d-flex no-block flex-row">
                                <div class="cc-icon align-self-center"><i class=" bi bi-coin" title="BTC"></i></div>
                                <div class="m-l-10 align-self-center">
                                    <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                    <h5 class="text-muted m-b-0 blan"><?= number_format($perfil->cuenta_COP, 0) ?></h5>
                                </div>
                            </div>
                            <div class="p-20">
                                <!-- Button Solicitar modal -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cruce_cuentas">
                                    solicitar retiro
                                </button> <br>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="cruce_cuentas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width: 134%;">
                                        <div class="modal-header" style="background-color: #444446;">
                                            <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Cruce cuentas con ECOMM </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url() ?>comercio/peticion" method="POST">
                                            <div class="modal-body" style="background-color:#7E7E87;">
                                                <h4 style="color: black;">hola <?= $perfil->nombre_negocio ?> cuentanos cuanto quieres que te giremos ??</h4>

                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 style="color: black;">Tu valor en wallet en estos momentos es de: $<?= number_format($perfil->cuenta_COP, 0) ?></h5>
                                                        <div class="input-group mb-2">
                                                            <input type="hidden" value="<?= $perfil->id ?>" name="id_comercio">
                                                            <span class="input-group-text">$</span><input type="number" class="form-control" name="valor" style="width: 200px;" placeholder="Ingrese el valor " required>
                                                            <input type="hidden" value="<?= $perfil->cuenta_COP ?>" name="cuenta_COP">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <center><img src="<?= base_url() ?>dist/favicon.png" width="260" height="120" alt=""> </center>
                                                    </div>
                                                </div>
                                                <textarea class="form-control" name="nota" placeholder="Mensaje o Nota" require></textarea>

                                            </div>
                                            <div class="modal-footer " style="background-color: #444446;">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if ($perfil->tipo == 'SocioAdmin') { ?>
        <div class="content-wrapper">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4><?= $perfil->nombre ?> <?= $perfil->apellido1 ?></h4>
                            <h4><?= $perfil->nombre_negocio ?></h4>
                            <h5>id_referido: <?= $perfil->id ?></h5>
                            <h5>Total ventas realizadas</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="order-listing">
                                    <thead>
                                        <tr>
                                            <th>Nombre Socio</th>
                                            <th>Precio</th>
                                            <th>Nombre Comercio</th>
                                            <th>Fecha Compra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($total as $tu) { ?>
                                            <tr>
                                                <td><?= $tu->nombre ?></td>
                                                <td><?= number_format($tu->precio, 0)  ?></td>
                                                <td><?= $tu->nombre_negocio ?></td>
                                                <td><?= $tu->fecha_compra ?></td>
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
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4><?= $perfil->nombre ?> <?= $perfil->apellido1 ?></h4>
                            <h4><?= $perfil->nombre_negocio ?></h4>
                            <h5>id_referido: <?= $perfil->id ?></h5>
                            <h5>Datos negocios Asociados</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="order-listing2">
                                    <thead>
                                        <tr>
                                            <th>Nombre Comercio</th>
                                            <th>Nombre Encargado </th>
                                            <th>Correo</th>
                                            <th>Celular</th>
                                            <th>Cuenta COP</th>
                                            <th>Fecha registro</th>
                                            <th>check</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($todo as $t) { ?>
                                            <tr>
                                                <td><?= $t->nombre_negocio ?></td>
                                                <td><?= $t->nombre_encargado ?></td>
                                                <td><?= $t->correo ?></td>
                                                <td><?= $t->celular ?></td>
                                                <td><?= number_format($t->cuenta_COP, 0) ?></td>
                                                <td><?= $t->fecha_registro ?></td>
                                                <td><i class="bi bi-check-circle-fill"></i></td>
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
        <div class="content-wrapper">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4><?= $perfil->nombre ?> <?= $perfil->apellido1 ?></h4>
                            <h4><?= $perfil->nombre_negocio ?></h4>
                            <h5>id_referido: <?= $perfil->id ?></h5>
                            <h5>Socios en sistema</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="order-listing3">
                                    <thead>
                                        <tr>
                                            <th>Nombre Socio</th>
                                            <th>Apellido</th>
                                            <th>Correo</th>
                                            <th>Ciudad</th>
                                            <th>Estado </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($socio as $s) { ?>
                                            <tr>
                                                <td><?= $s->nombre ?></td>
                                                <td><?= $s->apellido1 ?></td>
                                                <td><?= $s->correo ?></td>
                                                <td><?= $s->ciudad ?></td>
                                                <?php if ($s->verificar_user == "habilitado") { ?>
                                                    <td>si</td>
                                                <?php } else { ?>
                                                    <td>no</td>
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
        </div>
    <?php } ?>

    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->


    <?php if ($perfil->tipo == 'Socio') { ?>

        <!-- /trabla referidos / cupones utilizados /Para clientes   -->
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4><?= $perfil->nombre ?> <?= $perfil->apellido1 ?></h4>
                            <h4><?= $perfil->nombre_negocio ?></h4>
                            <h5>id_referido: <?= $perfil->id ?></h5>
                            <h5>Historial de Compras</h5>
                            <br>
                            <div class="table-responsive">

                                <table class="table" id="order-listing4">
                                    <thead>
                                        <tr>
                                            <th>Nombre Cliente</th>
                                            <th>nombre_negocio</th>
                                            <th>producto</th>
                                            <th>Precio</th>
                                            <th>Cashback</th>
                                            <th>fecha de compra</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($historial as $h) { ?>

                                            <tr>
                                                <td><?= $h->nombre ?></td>
                                                <td><?= $h->nombre_negocio ?></td>
                                                <td><?= $h->producto ?></td>
                                                <td><?= number_format($h->precio, 0) ?></td>
                                                <td><?= number_format($h->gana_cash, 0) ?></td>
                                                <td><?= $h->fecha_compra ?></td>
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

        <div class="content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4><?= $perfil->nombre ?> <?= $perfil->apellido1 ?></h4>
                            <h4><?= $perfil->nombre_negocio ?></h4>
                            <h5>id_referido: <?= $perfil->id ?></h5>
                            <h5>Historial de Compras por referidos </h5>
                            <br>
                            <div class="table-responsive">

                                <table class="table" id="order-listing5">
                                    <thead>
                                        <tr>
                                            <th>Nombre Cliente</th>
                                            <th>nombre_negocio</th>
                                            <th>producto</th>
                                            <th>Precio</th>
                                            <th>Cashback</th>
                                            <th>fecha de compra</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($historial_referidos as $h2) { ?>

                                            <tr>
                                                <td><?= $h2->nombre ?></td>
                                                <td><?= $h2->nombre_negocio ?></td>
                                                <td><?= $h2->producto ?></td>
                                                <td><?= number_format($h2->precio, 0) ?></td>
                                                <td><?= number_format($h2->gana_cash_papa, 0) ?></td>
                                                <td><?= $h2->fecha_compra ?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php foreach ($abuelo as $h3) { ?>

                                            <tr>
                                                <td><?= $h3->nombre ?></td>
                                                <td><?= $h3->nombre_negocio ?></td>
                                                <td><?= $h3->producto ?></td>
                                                <td><?= number_format($h3->precio, 0) ?></td>
                                                <td><?= number_format($h3->gana_cash_abuelo, 0) ?></td>
                                                <td><?= $h2->fecha_compra ?></td>
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

    <?php } ?>

    <?php if ($perfil->tipo == 'Comercio') { ?>

        <div class="content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4><?= $perfil->nombre ?> <?= $perfil->apellido1 ?> </h4>
                            <h4><?= $perfil->nombre_negocio ?></h4>
                            <h5>id_referido: <?= $perfil->id ?></h5>
                            <h5>Historial de Compras</h5>
                            <br>
                            <div class="table-responsive">

                                <table class="table" id="order-listing6">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre Cliente</th>
                                            <th scope="col">Apellido Cliente</th>
                                            <th scope="col">fecha de compra</th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">ganancias</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($ventas as $v) { ?>
                                            <?php $ganancias = $v->precio - (($v->precio * $v->descuento) / 100) ?>
                                            <tr>
                                                <td><?= $v->nombre ?> </td>
                                                <td><?= $v->apellido1 ?> </td>
                                                <td><?= $v->fecha_compra ?> </td>
                                                <td><?= $v->producto ?> </td>
                                                <td><?= number_format($ganancias, 0) ?> </td>

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
    <?php } ?>




    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- End Page wrapper  -->