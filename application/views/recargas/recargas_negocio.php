<div class="row" style="margin:20px;">
    <?php if ($this->session->flashdata("realizado")) { ?>
        <p>
            <?php echo $this->session->flashdata("realizado") ?>
        </p>
    <?php } ?>
    <?php if ($this->session->flashdata("error")) { ?>
        <p>
            <?php echo $this->session->flashdata("error") ?>
        </p>
    <?php } ?>
    <center>
        <div class="col-lg-6 col-md-6 ppbtn">
            <div class="card cc-widget">
                <button class="buttomo">

                    <div class="row">
                        <div class="cc-icon align-self-center"><i class="mdi mdi-shopping icon-lg"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h4 class="m-b-0 amar"> Recargas con
                                <?= $perfil->nombre_negocio ?>
                            </h4>
                        </div>
                        <div class="buttomo__horizontal"></div>
                        <div class="buttomo__vertical"></div>
                    </div>

                </button>
            </div>
        </div>
    </center>
    <div class="col-lg-12 col-xlg-12 col-md-12" style="margin-top: 1rem;">
        <div class="card">
            <div class="tab-content">
                <h1> Hola
                    <?= $perfil->nombre_negocio ?>
                </h1>
                <h5>
                    Valida la cedula de la ciudadania de la persona antes de ejecutar la recarga <br>
                    Luego Digita el valor que quiere la persona recargar
                </h5> <br>
                <form id="enviar" action="<?= base_url() ?>Comercio/puntoRecarga" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">

                            <h5>Digita el numero de cedula que va a recargar</h5>

                            <div class="col-auto">
                                <div class="row">
                                    <input type="text" class="form-control" id="cedula" name="cedula"
                                        placeholder="digite la cedula que va a recargar" required>
                                    <button type="button" class="btn btn-success btn-sm" id="cedula2">Validar</button>
                                </div>
                            </div>
                            <div class="input-group mb-2" id="add"></div>
                            <!-- id= add para designar el lugar donde quiere decignar JS -->
                            <br>
                            <div class="input-group mb-2">
                                <input type="number" class="form-control" name="valor" id=""
                                    placeholder="Digite el saldo a recargar">
                                <input type="hidden" name="id_comercio" value="<?= $perfil->id ?>">
                            </div>
                        </div>

                        <div class="col-6">
                            <center><img src="<?= base_url() ?>dist/favicon.png" class="d-flex" width="150"
                                    height="120"> </center>
                        </div>
                    </div>

                    <?php if ($perfil->auto_recar == 2 || $perfil->auto_recar == 3) { ?>
                        <center> <button type="button" class=" btn-success btn-lg btn-block" data-bs-toggle="modal"
                                data-bs-target="#confirmar">Enviar</button></center>
                        <div class="modal fade" id="confirmar" aria-hidden="true"
                            aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalToggleLabel2">Estas seguro de
                                            realizar esta operacion?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body anadir">
                                        <label for="">recargar por:</label>
                                        <?php if ($perfil->auto_recar == 2) { ?>
                                            <select class="form-select" aria-label="Default select example" name="metodo"
                                                id="transfe">
                                                <option value="99">Prestamo</option>
                                            </select>
                                        <?php } else { ?>
                                            <select class="form-select" aria-label="Default select example" name="metodo"
                                                id="transfe">
                                                <?php foreach ($tb_tarjetas as $m) { ?>
                                                    <option value="<?= $m->id ?>"><?= $m->nombre_paquete ?></option>
                                                <?php } ?>
                                            </select>
                                        <?php } ?>
                                        <label for="">Metodo de pago</label>
                                        <select class="form-select" aria-label="Default select example" name="tipo"
                                            id="transfe">
                                            <?php foreach ($metodos as $m) { ?>
                                                <option value="<?= $m->id ?>"><?= $m->nombre ?></option>
                                            <?php } ?>
                                        </select>

                                        <div class="input-group mb-2" id="respuesta">
                                            <label for="">Seleccionaste Pago Efectivo</label>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-success" form="enviar">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } elseif ($perfil->auto_recar == 0) { ?>
                    <center>
                        <h4 style="color: red;">¡No se encuentra habilitado para realizar recargas!</h4>
                        <button type="button" class=" btn-success btn-lg btn-block" data-bs-toggle="modal"
                            data-bs-target="#solicitud">Quiero ser un punto recarga</button>
                    </center>
                    <div class="modal fade" id="solicitud" aria-hidden="true" style="z-index: 1000;"
                        aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel2">¿Estas seguro de ser un
                                        punto de recargas?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body ">
                                    <center>
                                        <div class="row">
                                            <label style="margin-bottom: 1rem;" for="">Conoce nuestros
                                                planes</label> <br>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#prestamo">Paquete
                                                    prestamo</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#cupo">Paquete cupo
                                                </button>
                                            </div>
                                        </div>
                                    </center>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="prestamo" aria-hidden="true" style="z-index: 1000;"
                        aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <form action="<?= base_url() ?>Recargas/peticion_recargas/<?= $perfil->id ?>" method="post"
                                id="info">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalToggleLabel2">Conoce como Funciona
                                            el plan Prestamo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body ">
                                        <p>
                                            Condiciones: <br>
                                            -la respuesta de la solicitud tiene un plazo de 2 dias habiles <br>
                                            -Solo puede realizar un máximo de pesos en recargas segun la antiguedad
                                            y la cantidad de recargas. <br>
                                            -Hacer cruce de cuentas para volver habilitar recargas. <br>
                                            -El cruce de cuenta se puede realizar por tus ventas o por medio de
                                            transferencia. <br>
                                            -Se tienen que enviar el dinero de la recarga 5 dias habiles. <br>
                                        </p>
                                    </div>
                                    <div class="modal-body ">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-success" form="info">Aceptar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal fade" id="cupo" aria-hidden="true" style="z-index: 1000;" style="width: 700px;"
                        aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered" style="width: 700px;">
                            <div class="modal-content" style="width: 700px;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel2">Conoce como Funciona el
                                        plan Cupo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Condiciones: <br>
                                        -la respuesta de la solicitud tiene un plazo de 2 dias habiles despues del
                                        pago <br>
                                        -Solo puede realizar un el valor total del cupo. <br>
                                        -Vigencia hasta que se realice la totalidad de del cupo. <br>
                                        -El dinero de las recargas queda para la empresa. <br>
                                    </p>
                                    <div class="row">

                                    </div>
                                </div>
                                <div class="modal-body ">

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else if ($perfil->auto_recar == 1) { ?>
                        <center>
                            <h4 style="color: red;">En validacion de e´comm</h4>
                        </center>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-lg 12" style="margin-top: 1rem;">
        <div class="card cc-widget">
            <div class="card-body">
                <h4>
                    <?= $perfil->nombre_negocio ?>
                </h4>
                <h5>id_referido:
                    <?= $perfil->id ?>
                </h5>
                <h5>Informacion de Plan cupos</h5>
                <br>
                <div class="table-responsive">

                    <table class="table" id="order-listing4">
                        <thead>
                            <tr>
                                <th scope="col">fecha Pago</th>
                                <th scope="col">codigo</th>
                                <th scope="col">nombre_paquete</th>
                                <th scope="col">Valor cupo Actual</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Certificado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($info as $i) { ?>
                                <tr>
                                    <td>
                                        <?= $i->fecha ?>
                                    </td>
                                    <td>
                                        <?= $i->id ?>
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

                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <center>
        <div class="col-lg-6 col-md-6 ppbtn" style="margin-top: 1rem;">
            <div class="card cc-widget">
                <button class="buttomo">
                    <div class="row">
                        <div class="cc-icon align-self-center"><i class="mdi mdi-shopping icon-lg"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h4 class="m-b-0 amar"> Cruce cuentas Con ECOMM </h4>
                        </div>
                        <div class="buttomo__horizontal"></div>
                        <div class="buttomo__vertical"></div>
                    </div>
                </button>
            </div>
        </div>
    </center>
    <div class="row" style="margin-top: 1rem;">
        <div class="col-lg-6 col-md-6"style="margin-top: 1rem;">
            <div class="card cc-widget">
                <div class="card-body">
                    <div class="d-flex no-block flex-row">
                        <div class="cc-icon align-self-center"><i class=" bi bi-coin" style="font-size: 60px;"
                                title="BTC"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                            <h5 class="m-b-0 blan" style="color:red;">$
                                <?= number_format($perfil->cuenta_COP_deuda, 0) ?>
                            </h5>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6"style="margin-top: 1rem;">
            <div class="card cc-widget">
                <div class="card-body">
                    <div class="d-flex no-block flex-row">
                        <div class="cc-icon align-self-center"><i class=" bi bi-coin" style="font-size: 60px;"
                                title="BTC"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h4 class="m-b-0 amar">Ganancias por Recarga</h4>
                            <h5 class="m-b-0 blan" style="color:green;">$
                                <?= number_format($perfil->cuenta_comision, 0) ?>
                            </h5>
                            <h6 class="m-b-0 blan"> Valor no redimible</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg 12" style="margin-top: 1rem;">
        <div class="card cc-widget">
            <div class="card-body">
                <h4>
                    <?= $perfil->nombre_negocio ?>
                </h4>
                <h5>id_referido:
                    <?= $perfil->id ?>
                </h5>
                <h5>Historial de Recargas(Debe con ECOMM)</h5>
                <br>
                <div class="table-responsive">

                    <table class="table" id="order-listing">
                        <thead>
                            <tr>
                                <th scope="col">fecha pago</th>
                                <th scope="col">codigo</th>
                                <th scope="col">Nombre Cliente</th>
                                <th scope="col">valor Debe Ecomm</th>
                                <th scope="col">Modalidad de pago</th>
                                <th scope="col">estado</th>
                                <th scope="col">cruce_cuentas</th>
                                <th scope="col">comprobante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historial_reca as $h) { ?>
                                <tr>
                                    <td>
                                        <?= $h->fecha_pago ?>
                                    </td>
                                    <td>
                                        <?= $h->id ?>
                                    </td>
                                    <td>
                                        <?= $h->nombre ?>
                                    </td>
                                    <td>
                                        <?= number_format($h->valor, 0) ?>
                                    </td>
                                    <td>
                                        <?= $h->tipo ?>
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
                                    <?php if ($h->estado == "debe") { ?>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#transferir<?= $h->id ?>"><i
                                                    class="fa-solid fa-money-bill-transfer"></i></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="transferir<?= $h->id ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"
                                                                style="color: black;">Cruce de cuentas #
                                                                <?= $h->id ?>
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="<?= base_url() ?>comercio/cruce_cuentas/<?= $h->id ?>"
                                                            method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <p style="color: black;">sube el certificado de
                                                                    transferencia</p>
                                                                <input type="file" name="img">
                                                                <input type="hidden" name="valor" value="<?= $h->valor ?>">
                                                                <input type="hidden" name="negocio" value="<?= $perfil->id ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary">enviar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    <?php } else { ?>
                                        <td></td>
                                    <?php } ?>

                                    <td><a href="<?= base_url() ?>assets/img/<?= $h->img ?>"><?= $h->img ?></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg 12" style="margin-top: 1rem;">
        <div class="card cc-widget">
            <div class="card-body">
                <h4>
                    <?= $perfil->nombre_negocio ?>
                </h4>
                <h5>id_referido:
                    <?= $perfil->id ?>
                </h5>
                <h5>Historial de cruce de cuenta</h5>
                <br>
                <div class="table-responsive">

                    <table class="table" id="order-listing2">
                        <thead>
                            <tr>
                                <th scope="col">fecha pago</th>
                                <th scope="col">valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cruce as $h) { ?>
                                <tr style="background-color: #6CEC7D;">
                                    <td>
                                        <?= $h->fecha ?>
                                    </td>
                                    <td>
                                        <?= number_format($h->valor, 0) ?>
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