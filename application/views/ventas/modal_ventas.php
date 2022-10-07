<div class="page-wrapper bacblan">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== --><br>
    <center>
        <h1>Prueba de escritorio de ventas</h1>
    </center>
    <div class="container-fluid">

        <div class="row">
            <!-- modal de Venta Escritorio -->
            <!-- wallet Tiindo-->
            <div class="col-lg-4 col-md-6" style="padding-top:3rem ;">
                <div class="card cc-widget">
                    <div class="card-body">
                        <h5>nombre: <?= $perfil1->nombre ?></h5>
                        <h5>id_referido: <?= $perfil1->id ?></h5>
                        <div class="d-flex no-block flex-row">
                            <div class="cc-icon align-self-center"><i class=" mdi mdi-wallet auni" title="BTC"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                <h5 class="text-muted m-b-0 blan"><?= number_format($perfil1->cuenta_COP, 0) ?></h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- wallet Usuario-->
            <div class="col-lg-4 col-md-6" style="padding-top:3rem ;">
                <div class="card cc-widget">
                    <div class="card-body">
                        <h5>nombre: <?= $perfil->nombre ?> hola </h5>
                        <h5>id_referido: <?= $perfil->id ?></h5>
                        <div class="d-flex no-block flex-row">
                            <div class="cc-icon align-self-center"><i class=" mdi mdi-wallet auni" title="BTC"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                <h5 class="text-muted m-b-0 blan"><?= number_format($perfil->cuenta_COP, 0) ?></h5>
                            </div>
                        </div>

                    </div>
                    <div id="spark1" class="sparkchart"></div>
                </div>
            </div>

            <!-- wallet Comercio-->
            <div class="col-lg-4 col-md-6" style="padding-top:3rem ;">
                <div class="card cc-widget">
                    <div class="card-body">
                        <h5>nombre: <?= $perfil2->nombre_negocio ?></h5>
                        <h5>id_referido: <?= $perfil2->id ?></h5>

                        <div class="d-flex no-block flex-row">
                            <div class="cc-icon align-self-center"><i class=" mdi mdi-wallet auni" title="BTC"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                <h5 class="text-muted m-b-0 blan"><?= number_format($perfil2->cuenta_COP, 0) ?></h5>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-6" style="padding-top:2rem ;">
                <div class="card cc-widget">
                    <div class="card-body">
                    </div>
                </div>
            </div>

            <!-- wallet papa-->
            <div class="col-lg-4 col-md-6" style="padding-top:2rem ;">
                <div class="card cc-widget">
                    <div class="card-body">
                        <h5>Papá</h5>
                        <h5>nombre: <?= $perfil3->nombre ?></h5>
                        <h5>id_referido: <?= $perfil3->id ?></h5>

                        <div class="d-flex no-block flex-row">
                            <div class="cc-icon align-self-center"><i class=" mdi mdi-wallet auni" title="BTC"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                <h5 class="text-muted m-b-0 blan"><?= number_format($perfil3->cuenta_COP, 0) ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-6" style="padding-top:2rem ; padding-left: 32rem;">
        <div class="card cc-widget">
            <div class="card-body">
                <h5>Abuelo</h5>
                <h5>nombre: <?= $perfil4->nombre ?></h5>
                <h5>id_referido: <?= $perfil4->id ?></h5>
                <div class="d-flex no-block flex-row">
                    <div class="cc-icon align-self-center"><i class=" mdi mdi-wallet auni" title="BTC"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                        <h5 class="text-muted m-b-0 blan"><?= number_format($perfil4->cuenta_COP, 0) ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <center>
        <h1>Prueba escritorio solicitudes</h1>
    </center>
    <div style="padding-left:70rem ;">
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cruce_cuentas">
            solicitar retiro
        </button> <br>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="cruce_cuentas" tabindex="-1" aria-labelledby="exampleModalLabel" style="z-index: 1000;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 134%;">
                <div class="modal-header" style="background-color: #444446;">
                    <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Cruce cuentas con Tiindo </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url() ?>comercio/Comercio/peticion" method="POST">
                    <div class="modal-body" style="background-color:#7E7E87;">
                        <h4 style="color: black;">hola <?= $perfil2->nombre_negocio ?> cuentanos cuanto quieres que te giremos ??</h4>

                        <div class="row">
                            <div class="col-6">
                                <h5 style="color: black;">Tu valor en wallet en estos momentos es de: $<?= number_format($perfil2->cuenta_COP, 0) ?></h5>
                                <div class="input-group mb-2">
                                    <input type="hidden" value="<?= $perfil2->id ?>" name="id_comercio">
                                    <span class="input-group-text">$</span><input type="text" class="form-control" name="valor" style="width: 200px;" placeholder="Ingrese el valor " require>
                                    <input type="hidden" value="<?= $perfil2->cuenta_COP ?>" name="cuenta_COP">
                                </div>
                            </div>
                            <div class="col-6">
                                <center><img src="https://www.tiindo.com/wp-content/uploads/2022/05/logo-cryptoce.png" alt=""> </center>
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

    <div class="row">
        <div class="col-lg-6 col-md-6" style="padding-top:2rem ;">
            <div class="card cc-widget">
                <div class="card-body">
                  <h2>solicitudes para responder Tiindo</h2>  
                    <!-- Button trigger modal -->

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nombre negocio</th>
                                <th scope="col">Fecha peticion</th>
                                <th scope="col">valor</th>
                                <th scope="col">Nota</th>
                                <th scope="col">Aceptar</th>
                                <th scope="col">Rechazar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($peticiones as $p) { ?>
                                <tr>
                                    <td><?= $p->nombre_negocio ?> </td>
                                    <td><?= $p->fecha_peticion ?></td>
                                    <td><?= number_format($p->valor, 0) ?></td>
                                    <td><?= $p->nota ?></td>

                                    <td><button type="button" class="btn_primarycard btnc3 " data-bs-toggle="modal" data-bs-target="#aprobar_peticion<?= $p->id ?>">Aprobar</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="aprobar_peticion<?= $p->id ?>" style="z-index: 1000;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="width: 134%;">
                                                    <div class="modal-header" style="background-color: #444446;">
                                                        <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Aprobacion de peticion </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?= base_url() ?>comercio/Comercio/aprobarPeticion/<?= $p->id ?>" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body" style="background-color:#7E7E87;">
                                                            <h4 style="color: black;">hola <?= $perfil->nombre ?> Sube el certificado de trasnferencia para terminar el proceso</h4>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="input-group mb-2">
                                                                        <input type="hidden" name="activo" value="0">
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <input type="file" class="form-control" name="img" placeholder=" " required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <center><img src="https://www.tiindo.com/wp-content/uploads/2022/05/logo-cryptoce.png" alt=""> </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer " style="background-color: #444446;">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </td>
                                    <td> <button type="submit" class="btn waves-effect waves-light btn-danger" data-bs-toggle="modal" style="border: 1px solid ;padding: 10px; /*espacio alrededor texto*/background-color: #ef0202;background-image: linear-gradient(62deg, #ef0202 20%, #FBAB7E 48%, #F7CE68 85%);color:black; text-decoration: none;text-transform: uppercase; font-family: 'Helvetica', sans-serif; border-radius: 50px; " data-bs-target="#cancelar_peticion<?= $p->id ?>">Cancelar</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="cancelar_peticion<?= $p->id ?>" style="z-index: 1000;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="width: 134%;">
                                                    <div class="modal-header" style="background-color: #444446;">
                                                        <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Aprobacion de peticion </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?= base_url() ?>/comercio/Comercio/rechazarPeticion" method="post">
                                                        <div class="modal-body" style="background-color:#7E7E87;">
                                                            <h4 style="color: black;">hola <?= $perfil->nombre ?> ¿Por que rechazas esta solicitud?</h4>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="input-group mb-2">
                                                                        <input type="hidden" name="id_comercio" value="<?= $p->id_comercio ?>">
                                                                        <input type="hidden" name="valor" value="<?= $p->valor ?>">
                                                                        <input type="hidden" name="activo" value="0">
                                                                        <input type="hidden" name="id" value="<?= $p->id ?>">
                                                                        <input type="text" name="estado" placeholder="Escribe un mensaje para esta comercio">
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <center><img src="https://www.tiindo.com/wp-content/uploads/2022/05/logo-cryptoce.png" alt=""> </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer " style="background-color: #444446;">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Enviar</button>
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
        <div class="col-lg-6 col-md-6" style="padding-top:2rem ;">
            <div class="card cc-widget">
                <div class="card-body">
                     <h2>solicitudes Polo a Tiindo</h2>
                    <!-- Button trigger modal -->

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nombre negocio</th>
                                <th scope="col">valor solicitado</th>
                                <th scope="col">cuenta actual</th>
                                <th scope="col">Fecha peticion</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Comprobante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($peticion_comercio as $p) { ?>
                                <tr>
                                    <td><?= $p->nombre_negocio ?></td>
                                    <td><?= number_format($p->valor, 0) ?></td>
                                    <td><?= number_format($p->cuenta_COP, 0) ?></td>
                                    <td><?= $p->fecha_peticion ?></td>
                                    <td><?= $p->estado ?></td>
                                    <td><a href="<?= base_url() ?>assets/img/<?= $p->img ?>"><?= $p->img ?></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <center>
        <h1>Prueba de escritorio de Recargas</h1>
    </center>
    <div class="row">
        <div class="col-6">
            <div class="col-lg-6 col-md-6" style="padding-top:3rem ;">
                <div class="card cc-widget">
                    <div class="card-body">
                        <h5>nombre: <?= $perfil2->nombre_negocio ?> wallet deudas</h5>
                        <h5>id_referido: <?= $perfil2->id ?></h5>

                        <div class="d-flex no-block flex-row">
                            <div class="cc-icon align-self-center"><i class=" mdi mdi-wallet auni" title="BTC"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                <h5 class="text-muted m-b-0 blan"><?= number_format($perfil2->cuenta_COP_deuda, 0) ?></h5>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-6">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#punto_recarga">Punto de recarga</button>
            <br><br>
            <div class="modal fade" id="punto_recarga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="width: 134%;">
                        <div class="modal-header" style="background-color: #444446;">
                            <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Realiza Recargas con <?= $perfil2->nombre_negocio ?> </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="enviar" action="<?= base_url() ?>comercio/Comercio/puntoRecarga" method="POST" enctype="multipart/form-data">
                            <div class="modal-body" style="background-color:#7E7E87;">
                                <h4 style="color: black;">hola <?= $perfil2->nombre_negocio ?> cuentanos a quien y cuento vas a recargar??</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 style="color: black;">Digita el numero de cedula que va a recargar</h5>
                                        <div class="input-group mb-2">
                                            <input type="text" id="cedula" name="cedula" placeholder="digite el numero de cedula que va a recargar">
                                            <button type="button" class="btn btn-warning" id="cedula2">Validar</button>
                                        </div>
                                        <div class="input-group mb-2" id="add"></div> <!-- id= add para designar el lugar donde quiere decignar JS -->
                                        <br>
                                        <div class="input-group mb-2">
                                            <input type="text" name="valor" id="hola" placeholder="digite el valor que quieres recargar">
                                            <input type="hidden" name="id_pocentaje" value="1">
                                            <input type="hidden" name="id_comercio" value="<?= $perfil2->id ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <center><img src="<?= base_url() ?>wp-content/uploads/2022/05/logo-cryptoce.png" width="250px" height="250px" alt=""> </center>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer " style="background-color: #444446;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmar">Enviar</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmar" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Estas seguro de realizar esta operacion?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <input id="holi" readonly>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="enviar">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    </form>

    <div class="col-lg-12 col-md-6">
        <div class="card cc-widget">
            <div class="card-body">
                <h2>Historial Recargas Polo</h2>
                <!-- Button trigger modal -->

                <table class="table">
                    <thead>
                        <tr>
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
                                                <form action="<?= base_url() ?>comercio/Comercio/cruce_cuentas/<?= $h->id ?>" method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <p style="color: black;">sube el certificado de transferencia</p>
                                                        <input type="file" name="img">
                                                        <input type="hidden" name="valor" value="<?= $h->valor ?>">
                                                        <input type="hidden" name="negocio" value="<?= $perfil2->id ?>">
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

    <div class="col-lg-12 col-md-6" style="padding-top:2rem ;">
        <div class="card cc-widget">
            <div class="card-body">
                <h2>Historial recargas negocios (view TIINDO)</h2>
                <!-- Button trigger modal -->

                <table class="table">
                    <thead>
                        <tr>
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
                                                <form action="<?= base_url() ?>comercio/Comercio/aceptarPago/<?= $h->id ?>" method="POST">
                                                    <div class="modal-body">
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



    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->