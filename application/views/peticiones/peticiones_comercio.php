<body>

    <div class="main-panel">
        <div class="content-wrapper">


            <div class="row" style="justify-content: center;">
                <!-- Column -->
                <div class="col-lg-6 col-md-6 ppbtn">
                    <div class="card cc-widget">
                        <button class="buttomo">
                            <center>
                                <div class="row">
                                    <div class="cc-icon align-self-center"><i class="mdi mdi-shopping icon-lg " title="Ofertar Activos"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h4 class="m-b-0 amar">Tus Peticiones <?= $perfil->nombre_negocio ?></h4>
                                    </div>
                                    <div class="buttomo__horizontal"></div>
                                    <div class="buttomo__vertical"></div>
                                </div>
                            </center>
                        </button>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">

                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="tab-content">
                                <h2><?= $perfil->nombre_negocio ?></h2>
                                <h4>Tu historial de peticiones</h4>
                                <br><br>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">codigo</th>
                                            <th scope="col">Nombre negocio</th>
                                            <th scope="col">valor solicitado</th>
                                            <th scope="col">cuenta actual</th>
                                            <th scope="col">Fecha peticion</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">icon</th>
                                            <th scope="col">comprobante</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($peticion_comercio as $p) { ?>
                                            <tr>
                                                <td><?= $p->id ?></td>
                                                <td><?= $p->nombre_negocio ?></td>
                                                <td><?= number_format($p->valor, 0) ?></td>
                                                <td><?= number_format($p->cuenta_COP, 0) ?></td>
                                                <td><?= $p->fecha_peticion ?></td>
                                                <td><?= $p->estado ?></td>
                                                <td><i class="<?= $p->icono ?> coloramarillo"></i></td>
                                                <td><a href="<?= base_url() ?>assets/img/<?= $p->img ?>"><?= $p->img ?></a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- End contain-fluid  -->
            </div>
        </div>
</body>
