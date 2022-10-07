
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row" style="justify-content: center;">
                <?php if ($this->session->flashdata("realizado")) { ?>
                    <p><?php echo $this->session->flashdata("realizado") ?></p>
                <?php } ?>
                <?php if ($this->session->flashdata("error")) { ?>
                    <p><?php echo $this->session->flashdata("error") ?></p>
                <?php } ?>
                <!-- Column -->
                <div class="col-lg-6 col-md-6 ppbtn">
                    <div class="card cc-widget">
                        <button class="buttomo">
                            <center>
                                <div class="row">
                                    <div class="cc-icon align-self-center"><i class="mdi mdi-shopping icon-lg" title="Ofertar Activos"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h4 class="m-b-0 amar"> Recargas con <?= $perfil->nombre_negocio ?></h4>
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
                <div class="content-wrapper">

                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="tab-content">
                                <h1> Hola <?= $perfil->nombre_negocio ?></h1>
                                <h5>
                                    Valida la cedula de la ciudadania de la persona antes de ejecutar la recarga <br>
                                    Luego Digita el valor que quiere la persona recargar
                                </h5> <br>

                                <div class="row">
                                    <div class="col-6">
                                        <form id="enviar" action="<?= base_url() ?>Comercio/puntoRecarga" method="POST" enctype="multipart/form-data">
                                            <h5>Digita el numero de cedula que va a recargar</h5>
                                            <div class="input-group mb-2">
                                                <input type="text" id="cedula" name="cedula" style="background-color:#4D4D55 ;color:aliceblue;" placeholder="digite el numero de cedula que va a recargar">
                                                <button type="button" class="btn btn-warning" id="cedula2">Validar</button>
                                            </div>
                                            <div class="input-group mb-2" id="add"></div> <!-- id= add para designar el lugar donde quiere decignar JS -->
                                            <br>
                                            <div class="input-group mb-2">
                                                <input type="text" name="valor" style="background-color:#4D4D55 ;color:aliceblue;" placeholder="digite el valor que quieres recargar" required>
                                                <input type="hidden" name="id_pocentaje" value="1">
                                                <input type="hidden" name="id_comercio" value="<?= $perfil->id ?>">
                                            </div>
                                    </div>

                                    <div class="col-6">
                                        <center><img src="<?= base_url() ?>dist/favicon.png" width="260" height="120" alt=""> </center>
                                    </div>
                                </div>
                                <center><button type="button" class=" btn-warning btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#confirmar">Enviar</button></center>
                                <div class="modal fade" id="confirmar" aria-hidden="true" style="z-index: 1000;" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalToggleLabel2">Estas seguro de realizar esta operacion?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body anadir"></div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-warning" form="enviar">Aceptar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <center>
                <div class="col-lg-6 col-md-6 ppbtn" style="padding-top: 10rem;">
                    <div class="card cc-widget">
                        <button class="buttomo">
                            <center>
                                <div class="row">
                                    <div class="cc-icon align-self-center"><i class="fa-solid fa-money-bill-wave coloramarillo"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h4 class="m-b-0 amar"> Cruce cuentas Con ECOMM </h4>
                                    </div>
                                    <div class="buttomo__horizontal"></div>
                                    <div class="buttomo__vertical"></div>
                                </div>
                            </center>
                        </button>
                    </div>
                </div>
            </center>
            <div class="content-wrapper">
                <div class="col-lg-4 col-md-6">
                    <div class="card cc-widget">
                        <div class="card-body">
                            <div class="d-flex no-block flex-row">
                                <div class="cc-icon align-self-center"><i class=" bi bi-coin" title="BTC"></i></div>
                                <div class="m-l-10 align-self-center">
                                    <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                    <h5 class="text-muted m-b-0 blan"><?= number_format($perfil->cuenta_COP_deuda, 0) ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-wrapper">

                <div class="col-lg 12">
                    <div class="card cc-widget">
                        <div class="card-body">
                            <h4><?= $perfil->nombre ?></h4>
                            <h4><?= $perfil->nombre_negocio ?></h4>
                            <h5>id_referido: <?= $perfil->id ?></h5>
                            <h5>Historial de Recargas(Debe con ECOMM)</h5>
                            <br>
                            <div class="table-responsive">

                                <table class="table" id="order-listing">
                                    <thead>
                                        <tr>
                                            <th scope="col">codigo</th>
                                            <th scope="col">Nombre_negocio</th>
                                            <th scope="col">Nombre Cliente</th>
                                            <th scope="col">fecha pago</th>
                                            <th scope="col">valor</th>
                                            <th scope="col">estado</th>
                                            <th scope="col">truce_cuentas</th>
                                            <th scope="col">comprobante</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($historial_reca as $h) { ?>
                                            <tr>
                                                <td><?= $h->id ?></td>
                                                <td><?= $h->nombre_negocio ?></td>
                                                <td><?= $h->nombre ?></td>
                                                <td><?= $h->fecha_pago ?></td>
                                                <td><?= number_format($h->valor, 0) ?></td>
                                                <?php if ($h->estado == "debe") { ?>
                                                    <td> <button type="" class="btn btn-danger"><?= $h->estado ?></button></td>
                                                <?php } else if ($h->estado == "pendiente_confirmacion") { ?>
                                                    <td> <button type="" class="btn btn-warning"><?= $h->estado ?></button></td>
                                                <?php } else { ?>
                                                    <td> <button type="" class="btn btn-success"><?= $h->estado ?></button></td>
                                                <?php } ?>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transferir<?= $h->id ?>"><i class="fa-solid fa-money-bill-transfer"></i></button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="transferir<?= $h->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel" style="color: black;">Cruce de cuentas #<?= $h->id ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="<?= base_url() ?>comercio/cruce_cuentas/<?= $h->id ?>" method="post" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                        <p style="color: black;">sube el certificado de transferencia</p>
                                                                        <input type="file" name="img">
                                                                        <input type="hidden" name="valor" value="<?= $h->valor ?>">
                                                                        <input type="hidden" name="negocio" value="<?= $perfil->id ?>">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-primary">enviar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="<?= base_url() ?>assets/img/<?= $h->img ?>"><?= $h->img ?></a></td>

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ============================================================== -->
            <!-- End contain-fluid  -->

</body>