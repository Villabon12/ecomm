<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<style>
    @-webkit-keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(calc(-250px * 7));
        }
    }

    @keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(calc(-250px * 7));
        }
    }

    .slider {
        background: white;
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.125);
        height: 100px;
        margin: auto;
        overflow: hidden;
        position: relative;
        width: 100%;
    }

    .slider::before,
    .slider::after {
        background: linear-gradient(to right, white 0%, rgba(255, 255, 255, 0) 100%);
        content: "";
        height: 100px;
        position: absolute;
        width: 200px;
        z-index: 2;
    }

    .slider::after {
        right: 0;
        top: 0;
        transform: rotateZ(180deg);
    }

    .slider::before {
        left: 0;
        top: 0;
    }

    .slider .slide-track {
        -webkit-animation: scroll 40s linear infinite;
        animation: scroll 40s linear infinite;
        display: flex;
        width: calc(250px * 14);
    }

    .slider .slide {
        height: 100px;
        width: 250px;
    }
</style>
<?php if ($this->session->flashdata("realizado")) { ?>
    <p>
        <?php echo $this->session->flashdata("realizado") ?>
    </p>
<?php } ?>
<?php if ($this->session->flashdata("error_maximo")) { ?>
    <p>
        <?php echo $this->session->flashdata("error_maximo") ?>
    </p>
<?php } ?>
<!-- parte Socio -->
<?php if ($perfil->tipo == 'Socio') { ?>
    <?php $epuntos = ($c1->plata + $c2->plata + $c3->plata + $c4->plata) ?>
    <div class="row" style="margin:20px;">
        <div class="col-lg-4 col-md-6" style="margin-bottom: 10px;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block flex-row">
                        <div class="cc-icon align-self-center"><i class=" bi bi-coin" style="font-size: 60px;"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                            <h5 class="text-muted m-b-0 blan">$
                                <?= number_format($perfil->cuenta_COP, 0) ?>
                            </h5>
                            <h6 class="text-muted m-b-0 blan"> E-puntos Total: $
                                <?= $epuntos ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6" style="margin-bottom: 10px;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block flex-row">
                        <div class="cc-icon align-self-center"><i class=" bi bi-coin" style="font-size: 60px;"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h4 class="m-b-0 amar">E-puntos</h4>
                            <h5 class="text-muted m-b-0 blan">$
                                <?= $perfil->cuenta_EPUNTOS ?>
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="p-20">
                            <?php if ($perfil->cuenta_EPUNTOS > $parametro->cashback) { ?>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#solicita_retiro"
                                    class="btn btn-success btn-sm" aria-current="page">Solicitar retiro</a>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#pasar" class="btn btn-success btn-sm"
                                    aria-current="page">Pasar E-puntos a billetera</a>
                            <?php } else { ?>
                                <p>Solo puedes retirar si tienes minimo $
                                    <?= number_format($parametro->cashback, 0) ?> en E-puntos
                                </p>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#pasar" class="btn btn-success btn-sm"
                                    aria-current="page">Pasar E-puntos a billetera</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6" style="margin-bottom: 10px;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block flex-row">
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 amar">Invita un comercio a Ser parte de Ecomm</h3>
                            <h6 class="text-muted m-b-0 blan"> </h6>
                            <h5> </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            Folleto informativo
                            <a href="<?= base_url() ?>assets\img\documentacion\FOLLETO.pdf" download="FOLLETO.pdf"><br>
                                <i style="font-size: 50px" class="mdi mdi-file-pdf-box"></i>
                            </a>
                        </div>
                        <div class="col">
                            propuesta
                            <a href="<?= base_url() ?>assets\img\documentacion\propuesta.pdf" download="propuesta.pdf"><br>
                                <i style="font-size: 50px" class="mdi mdi-file-pdf-box"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($count->contar >= 1) { ?>
        <h4>Mis Tarjetas:</h4>
        <?php foreach ($tb_tarje as $t) { ?>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block flex-row">
                            <div class="cc-icon align-self-center"><i class="mdi mdi-credit-card" style="font-size: 60px;"></i>
                            </div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">
                                    <?= $t->nombre_tarje ?>
                                </h4>
                                <h5 class="text-muted m-b-0 blan">$
                                    <?= number_format($t->cupo, 0) ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    <?php } else {
    } ?>
    <!-- Modal solicitar retiro -->
    <div class="modal fade" id="solicita_retiro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Solicitar retiro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url() ?>Solicitudes/enviarsoli/<?= $perfil->id ?>" method="POST">
                    <div class="modal-body">
                        <h4 style="color: black;">hola
                            <?= $perfil->nombre ?> cuentanos cuanto quieres que te giremos?
                        </h4>

                        <div class="row">
                            <div class="col-6">
                                <h5 style="color: black;">Tu valor en E-puntos en estos momentos es de: $
                                    <?= number_format($perfil->cuenta_EPUNTOS, 0) ?>
                                </h5>
                                <div class="col-auto">
                                    <div class="input-group">
                                        <div class="input-group-text">$</div>
                                        <input type="text" class="form-control" id="autoSizingInputGroup" name="valor"
                                            placeholder="valor" required>
                                    </div>
                                </div><br>
                                <select class="form-select form-select-sm" aria-label="Default select example" name="banco"
                                    required>
                                    <option value="0">Seleccione la cuenta</option>
                                    <?php foreach ($cuentas as $c) { ?>
                                        <option value="<?= $c->id ?>"><?= $c->banco ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <center><img src="<?= base_url() ?>dist/favicon.png" class="d-flex" width="180" height="120"
                                        alt=""> </center>
                            </div>
                        </div>
                        <p>Tener en cuenta: <br>
                            -Al momento de solicitar retiro se te descuenta el
                            <?= $d1->cashback ?>% del valor seleccionado
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Pasar puntos -->
    <div class="modal fade" id="pasar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pasar E-puntos a billetera</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url() ?>Solicitudes/pasarpuntos/<?= $perfil->id ?>" method="POST">
                    <div class="modal-body">
                        <h4 style="color: black;">hola
                            <?= $perfil->nombre ?> cuentanos cuanto quieres pasar a billetera?
                        </h4>

                        <div class="row">
                            <div class="col-6">
                                <h5 style="color: black;">Tu valor en E-puntos en estos momentos es de: $
                                    <?= number_format($perfil->cuenta_EPUNTOS, 0) ?>
                                </h5>
                                <div class="col-auto">
                                    <div class="input-group">
                                        <div class="input-group-text">$</div>
                                        <input type="text" class="form-control" id="autoSizingInputGroup" name="valor"
                                            placeholder="valor " required>
                                    </div>
                                </div><br>
                                <p>Tener en cuenta: <br>
                                    -Al momento de solicitar paso de E-puntos se te descuenta el
                                    <?= $d2->cashback ?>% del valor seleccionado
                                </p>
                            </div>
                            <div class="col-6">
                                <center><img src="<?= base_url() ?>dist/favicon.png" class="d-flex" width="80%" height="80%"
                                        alt=""> </center>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="tablas" style="margin:20px;">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4> Bienvenido
                        <?= $perfil->nombre ?>
                        <?= $perfil->apellido1 ?>
                    </h4>
                    <h5>Tu compras pendientes:</h5>
                    <br>
                    <div class="table-responsive">
                        <table class="table" id="order-listing2">
                            <thead>
                                <tr>
                                    <th scope="col">Fecha Compra</th>
                                    <th scope="col">codigo</th>
                                    <th scope="col">detallles</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($historial as $h) { ?>
                                    <tr>
                                        <td>
                                            <?= $h->fecha ?>
                                        </td>
                                        <td>
                                            <?= $h->codigo ?>
                                        </td>
                                        <td><a type="button" target="_blank"
                                                href="<?= base_url() ?>proceso/detalles2/<?= $h->id ?>"
                                                class="btn btn-warning"><i class="mdi mdi-magnify"></i> </a></td>
                                        <td>
                                            <?= number_format($h->total, 0) ?>
                                        </td>
                                        <?php if ($h->estado == 0) { ?>
                                            <td><button type="button" class="btn btn-danger">pendiente </button></td>
                                        <?php } else { ?>
                                            <td> <button type="button" class="btn btn-success">Compra Exitosa</button></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12" style="margin-top: 1rem;">
            <div class="card">
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
                    <h5>Ganancias por referidos </h5>
                    <br>
                    <div class="table-responsive">

                        <table class="table" id="order-listing5">
                            <thead>
                                <tr>
                                    <th>fecha de compra</th>
                                    <th>Nombre Cliente</th>
                                    <th>Apellido Cliente</th>
                                    <th>E-puntos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($historial1 as $h2) { ?>

                                    <tr>
                                        <td>
                                            <?= $h2->fecha_compra ?>
                                        </td>
                                        <td>
                                            <?= $h2->nombre ?>
                                        </td>
                                        <td>
                                            <?= $h2->apellido1 ?>
                                        </td>
                                        <td>
                                            <?= $h2->plata ?>
                                        </td>
                                    </tr>

                                <?php } ?>
                                <?php foreach ($historial2 as $h3) { ?>

                                    <tr>
                                        <td>
                                            <?= $h3->fecha_compra ?>
                                        </td>
                                        <td>
                                            <?= $h3->nombre ?>
                                        </td>
                                        <td>
                                            <?= $h3->apellido1 ?>
                                        </td>
                                        <td>
                                            <?= number_format($h3->plata, 0) ?>
                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12" style="margin-top: 1rem;">
            <div class="card">
                <div class="card-body">
                    <h4>
                        <?= $perfil->nombre ?>
                        <?= $perfil->apellido1 ?>
                    </h4>
                    <h5>Ganancias por ventas de comercios registrados </h5>
                    <br>
                    <div class="table-responsive">
                        <table class="table" id="order-listing5">
                            <thead>
                                <tr>
                                    <th>Nombre Negocio</th>
                                    <th>E-puntos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($gana as $g) { ?>
                                    <tr>
                                        <td>
                                            <?= $g->nombre_negocio ?>
                                        </td>
                                        <td>
                                            <?= $g->plata ?>
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
<?php } else if ($perfil->tipo == 'Comercio') { ?>
        <div class="row" style="margin:20px;">
            <div class="col-lg-4 col-md-6">
                <div class="card cc-widget " style="margin-top:1rem;">
                    <div class="card-body">
                        <div class="d-flex no-block flex-row">
                            <div class="cc-icon align-self-center"><i class=" mdi mdi-qrcode" style="font-size: 60px;"
                                    title="BTC"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Pagos Rapidos por Codigo</h4>
                                <h5 class="m-b-0 blan" style="color:green;"></h5>
                                <form action="<?= base_url() ?>Proceso/buscarCodigo" method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="digite el codigo de compra"
                                            name="codigo" aria-label="Recipient's username" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-success  btn-sm" type="submit"
                                            id="button-addon2">Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card cc-widget" style="margin-top:1rem;">
                    <div class="card-body">
                        <div class="d-flex no-block flex-row">
                            <div class="cc-icon align-self-center"><i class=" bi bi-coin" style="font-size: 60px;"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                <h5 class="text-muted m-b-0 blan">$
                                <?= number_format($perfil->cuenta_COP, 0) ?>
                                </h5>
                            </div>
                        </div>
                        <div class="p-20">
                        <?php if ($perfil->cuenta_COP_deuda > 0) { ?>
                                <p style="color: red;">Debes primero ponerte al dia con tus deudas para poder solicitar retiros</p>

                        <?php } else { ?>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#solicitanego">
                                    solicitar retiro!
                                </button>

                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card cc-widget" style="margin-top:1rem;">
                    <div class="card-body">
                        <div class="d-flex no-block flex-row">
                            <div class="cc-icon align-self-center"><i class=" bi bi-coin" title="BTC"
                                    style="font-size: 60px;"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Saldo pendiente con Ecomm</h4>
                                <h5 class="m-b-0 blan" style="color:red;">$
                                <?= number_format($perfil->cuenta_COP_deuda, 0) ?>
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="p-20">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#cruce_cuentas">
                                    cruce Cuentas
                                </button>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#pagatodo">
                                    Pagar cuenta pendiente
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Retiro -->
        <div class="modal fade" id="solicitanego" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Solicitar retiro de dinero</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url() ?>Solicitudes/enviarsolicomer/<?= $perfil->id ?>" method="post">
                        <div class="modal-body">
                            <h4 style="color: black;">hola
                            <?= $perfil->nombre_negocio ?> cuentanos cuanto quieres que te giremos ??
                            </h4>

                            <div class="row">
                                <div class="col-6">
                                    <h5 style="color: black;">Tu valor en wallet en estos momentos es de: $
                                    <?= number_format($perfil->cuenta_COP, 0) ?>
                                    </h5>
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <div class="input-group-text">$</div>
                                            <input type="text" class="form-control" id="autoSizingInputGroup" name="valor"
                                                placeholder="valor ">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <center><img src="<?= base_url() ?>dist/favicon.png" class="d-flex" width="180" height="120"
                                            alt=""> </center>
                                </div>
                            </div>
                            <select class="form-select form-select-sm" aria-label="Default select example" name="banco"
                                required>
                                <option value="0">Seleccione la cuenta</option>
                            <?php foreach ($cuentas as $c) { ?>
                                    <option value="<?= $c->id ?>"><?= $c->banco ?></option>
                            <?php } ?>
                            </select><br>
                            <textarea class="form-control" name="nota" placeholder="Mensaje o Nota" require></textarea>

                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success btn-sm">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Cruce Cuentas-->
        <div class="modal fade" id="cruce_cuentas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cruce Cuentas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url() ?>Recargas/Crucedecuentas/<?= $perfil->id ?>" method="post">
                        <div class="modal-body">
                            <h4 style="color: black;">hola
                            <?= $perfil->nombre_negocio ?> ¿Quieres pagar tu deuda con Ecomm?
                            </h4>
                            <div class="row">
                                <div class="col-6">
                                    <h5 style="color: black;">Tu valor en wallet en estos momentos es de: $
                                    <?= number_format($perfil->cuenta_COP, 0) ?>
                                    </h5>
                                    <h5 style="color: black;">Tu deuda en estos momentos es de: $
                                    <?= number_format($perfil->cuenta_COP_deuda, 0) ?>
                                    </h5>

                                </div>
                                <div class="col-6">
                                    <center><img src="<?= base_url() ?>dist/favicon.png" class="d-flex" width="180" height="120"
                                            alt=""> </center>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal  pagar saldo-->
        <div class="modal fade" id="pagatodo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pagar toda la cuenta deudora</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url() ?>Recargas/pago_todo/<?= $perfil->id ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="modal-body">
                            <h4 style="color: black;">hola
                            <?= $perfil->nombre_negocio ?> ¿Quieres pagar tu deuda con Ecomm?
                            </h4>
                            <div class="row">
                                <div class="col-6">
                                    <h5 style="color: black;">Tu deuda en estos momentos es de: $
                                    <?= number_format($perfil->cuenta_COP_deuda, 0) ?>
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <center><img src="<?= base_url() ?>dist/favicon.png" class="d-flex" width="180" height="120"
                                            alt=""> </center>
                                </div>
                                <h6>
                                    pasos a seguir:<br><br>
                                    1)consigna el valor de tu deuda a la cuenta bancaria de Ecomm Nequi Bancolombia.<br><br>
                                </h6>
                                <h5 style="background-color: #FAFA2C;">3194780042 </h5>
                                2)Adjunta el certificado de transferencia en este apartado.<br><br>
                                <h6> Tener un cuenta:<br><br>
                                    -Tendra 2 dias habiles para validar que llego correctamente la transferencia.<br><br>
                                    -Se te pondra a paz y salvo cuando la oficina de Ecomm S.A valide toda la
                                    informacion.<br><br>
                                </h6><br><br>
                                <label for="">Valor:</label>
                                <input type="number" name="valor" class="form-control" required>
                                <label for="">Certificado</label>
                                <input type="file" name="img" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="tablas" style="margin:20px;">
            <div class="col-lg 12">
                <div class="card" style="margin-top:7rem;">
                    <div class="card-body">
                        <h4> Bienvenido
                        <?= $perfil->nombre ?>
                        <?= $perfil->apellido1 ?>
                        </h4>
                        <h4>
                        <?= $perfil->nombre_negocio ?>
                        </h4>
                        <h5>Tus Ventas pendientes Carrito:</h5>
                        <br>
                        <div class="table-responsive">
                            <table class="table" id="order-listing6">
                                <thead>
                                    <tr>
                                        <th scope="col">Fecha Compra</th>
                                        <th scope="col">codigo</th>
                                        <th scope="col">detallles</th>
                                        <th scope="col">Nombre Cliente</th>
                                        <th scope="col">Apellido Cliente</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Ganancias</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">confirmar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($carrito as $h) { ?>
                                        <tr>
                                            <td>
                                            <?= $h->fecha ?>
                                            </td>
                                            <td>
                                            <?= $h->codigo ?>
                                            </td>
                                            <td>
                                                <a type="button" target="_blank"
                                                    href="<?= base_url() ?>proceso/detalles/<?= $h->id ?>"
                                                    class="btn btn-warning"><i class="mdi mdi-magnify"></i> </a>
                                            <?php if ($h->qr == null) { ?>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#generar<?= $h->id ?>">Generar</button>
                                            <?php } else { ?>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#QR<?= $h->id ?>"><i class="mdi mdi-qrcode-scan"></i></button>
                                            <?php } ?>
                                            </td>
                                            <td>
                                            <?= $h->nombre ?>
                                            </td>
                                            <td>
                                            <?= $h->apellido1 ?>
                                            </td>
                                            <td>
                                            <?= number_format($h->total, 0) ?>
                                            </td>
                                            <td>
                                            <?= number_format($h->ganancias_comercio, 0) ?>
                                            </td>
                                        <?php if ($h->estado == 2) { ?>
                                                <td>
                                                    <button type="button" class="btn btn-success">Compra Exitosa</button>
                                                </td>
                                        <?php } else { ?>
                                                <td>
                                                    <button type="button" class="btn btn-danger">pendiente </button>
                                                </td>
                                        <?php } ?>
                                        <?php if ($h->estado == 0) { ?>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#compra<?= $h->id ?>">confirmar</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#cancelar<?= $h->id ?>">Anular</button>
                                                </td>
                                        <?php } else { ?>
                                                <td>
                                                    <i class="mdi mdi-check-circle " style="color: #20EADA; font-size:25px;"></i>
                                                </td>
                                        <?php } ?>

                                        </tr>
                                        <!-- Modal QR -->
                                        <div class="modal fade" id="QR<?= $h->id ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <center> <img src="<?= base_url() . $h->qr ?>" width="50%" height="50%"
                                                                alt=""></center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Generar -->
                                        <div class="modal fade" id="generar<?= $h->id ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>¿Esta seguro que desea generar el coodigo QR?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="<?= base_url() ?>Proceso/generaQR/<?= $h->id ?>" method="get">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Confirmar manual -->
                                        <div class="modal fade" id="compra<?= $h->id ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmacion
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="post"
                                                        action="<?= base_url() ?>Proceso/aceptaCompraNego/<?= $h->id ?>">
                                                        <div class="modal-body">
                                                            ¿Esta seguro que ya despacho el pedido?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Rechazar manual -->
                                        <div class="modal fade" id="cancelar<?= $h->id ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Anular el pedido
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="post"
                                                        action="<?= base_url() ?>Proceso/rechazarPedido/<?= $h->id ?>">
                                                        <div class="modal-body">
                                                            ¿Esta seguro que desea cancelar este pedido?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary  btn-sm"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary  btn-sm">Aceptar</button>
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
        </div>
<?php } else if ($perfil->tipo == 'SocioAdmin') { ?>
            <div class="row" style="margin:20px;">
                <div class="col-lg-4 col-md-6">
                    <div class="card cc-widget">
                        <div class="card-body">
                            <div class="d-flex no-block flex-row">
                                <div class="cc-icon align-self-center"><i class=" bi bi-coin" style="font-size: 60px;"></i></div>
                                <div class="m-l-10 align-self-center">
                                    <h4 class="m-b-0 amar">Pesos Colombianos </h4>
                                    <h5 class="text-muted m-b-0 blan"> saldo:$
                                <?= number_format($perfil->cuenta_COP + $ganancias->ganancias, 0) ?>
                                    </h5>
                                    <h6 class="text-muted m-b-0 blan"> Ganacias : $
                                <?= number_format($perfil->cuenta_COP, 0) ?>
                                    </h6>
                                    <h6 class="text-muted m-b-0 blan"> Ganacias Negocios: $
                                <?= number_format($ganancias->ganancias, 0) ?>
                                    </h6>
                                    <h6 class="text-muted m-b-0 blan"> Cuentas deudas: $
                                <?= number_format($suma->suma, 0) ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tablas" style="margin:20px;">
                <div class="col-12" style="margin-top: 1rem;">
                    <div class="card">
                        <div class="card-body">
                            <h4>
                        <?= $perfil->nombre ?>
                        <?= $perfil->apellido1 ?>
                            </h4>
                            <h4>
                        <?= $perfil->nombre_negocio ?>
                            </h4>
                            <h5>Total ventas realizadas</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="order-listing">
                                    <thead>
                                        <tr>
                                            <th>Fecha Compra</th>
                                            <th>Nombre Socio</th>
                                            <th>Precio</th>
                                            <th>Nombre Comercio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php foreach ($total as $tu) { ?>
                                            <tr>
                                                <td>
                                            <?= $tu->fecha_compra ?>
                                                </td>
                                                <td>
                                            <?= $tu->nombre ?>
                                                </td>
                                                <td>
                                            <?= number_format($tu->precio, 0) ?>
                                                </td>
                                                <td>
                                            <?= $tu->nombre_negocio ?>
                                                </td>
                                            </tr>
                                <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="margin-top: 1rem;">
                    <div class="card">
                        <div class="card-body">
                            <h4>
                        <?= $perfil->nombre ?>
                        <?= $perfil->apellido1 ?>
                            </h4>
                            <h4>
                        <?= $perfil->nombre_negocio ?>
                            </h4>
                            <h5>Datos negocios Asociados</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="order-listing2">
                                    <thead>
                                        <tr>
                                            <th>Fecha registro</th>
                                            <th>Nombre Comercio</th>
                                            <th>Nombre Encargado </th>
                                            <th>Correo</th>
                                            <th>Celular</th>
                                            <th>Cuenta COP</th>
                                            <th>check</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php foreach ($todo as $t) { ?>
                                            <tr>
                                                <td>
                                            <?= $t->fecha_registro ?>
                                                </td>
                                                <td>
                                            <?= $t->nombre_negocio ?>
                                                </td>
                                                <td>
                                            <?= $t->nombre_encargado ?>
                                                </td>
                                                <td>
                                            <?= $t->correo ?>
                                                </td>
                                                <td>
                                            <?= $t->celular ?>
                                                </td>
                                                <td>
                                            <?= number_format($t->cuenta_COP, 0) ?>
                                                </td>
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
<?php } ?>
</body>

</html>