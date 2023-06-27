<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<?php if ($principal != (null)) { ?>
    <?php if ($principal->img_p == (null)) {

        $idp = $principal->id_p;

        $nombrep = $principal->nombre_p . " " . $principal->apellido_p;

        $principalp = "usuario.png";

    } else {

        $idp = $principal->id_p;

        $nombrep = $principal->nombre_p . " " . $principal->apellido_p;

        $principalp = $principal->img_p;

    } ?>

<?php } else {

    $idp = 0;

    $nombrep = "No hay nada";

    $principalp = "vacio.png";

} ?>

<?php if ($principal != (null)) { ?>



    <!-- derecha principal -->

    <?php if ($principal->img_d == (null)) {

        $idpd = $principal->r_d;

        $nombred = $principal->nombre_d . " " . $principal->apellido_d;

        $principalde = "usuario.png";

    } else {

        $idpd = $principal->r_d;

        $nombred = $principal->nombre_d . " " . $principal->apellido_d;

        $principalde = $principal->img_d;

    } ?>

<?php } else {

    $idpd = 0;

    $nombred = "No hay nada";

    $principalde = "vacio.png";

} ?>

<?php if ($izquierdap != (null)) { ?>



    <!-- izquierda principal -->

    <?php if ($izquierdap->img_d == (null)) {

        $idpi = $izquierdap->r_d;

        $nombreiz = $izquierdap->nombre_d . " " . $izquierdap->apellido_d;

        $principaliz = "usuario.png";

    } else {

        $idpi = $izquierdap->r_d;

        $nombreiz = $izquierdap->nombre_d . " " . $izquierdap->apellido_d;

        $principaliz = $izquierdap->img_d;

    } ?>

<?php } else {

    $idpi = 0;

    $nombreiz = "No hay nada";

    $principaliz = "vacio.png";

} ?>

<!-- DERECHA derecha-->

<?php if ($derecha != (null)) { ?>

    <?php if ($derecha->img_d == (null)) {

        $idpdd = $derecha->r_d;

        $nombrede = $derecha->nombre_d . " " . $derecha->apellido_d;

        $derechade = "usuario.png";

    } else {

        $idpdd = $derecha->r_d;

        $nombrede = $derecha->nombre_d . " " . $derecha->apellido_d;

        $derechade = $derecha->img_d;

    } ?>

<?php } else {

    $idpdd = 0;

    $nombrede = "No hay nada";

    $derechade = "vacio.png";

} ?>

<!-- DERECHA izquierda -->

<?php if ($derechai != (null)) { ?>

    <?php if ($derechai->img_d == (null)) {

        $idpdi = $derechai->r_d;

        $nombreiz2 = $derechai->nombre_d . " " . $derechai->apellido_d;

        $derechaiz = "usuario.png";

    } else {

        $idpdi = $derechai->r_d;

        $nombreiz2 = $derechai->nombre_d . " " . $derechai->apellido_d;

        $derechaiz = $derechai->img_d;

    } ?>

<?php } else {

    $idpdi = 0;

    $nombreiz2 = "No hay nada";

    $derechaiz = "vacio.png";

} ?>

<!-- IZQUIERDA derecha -->

<?php if ($izquierda != null) { ?>

    <?php if ($izquierda->img_d == (null)) {

        $idpid = $izquierda->r_d;

        $nombreizq = $izquierda->nombre_d . " " . $izquierda->apellido_d;

        $fotoizd = "usuario.png";

    } else {

        $idpid = $izquierda->r_d;

        $nombreizq = $izquierda->nombre_d . " " . $izquierda->apellido_d;

        $fotoizd = $izquierda->img_d;

    } ?>

<?php } else {

    $idpid = 0;

    $nombreizq = "No hay nada";

    $fotoizd = "vacio.png";

} ?>

<!-- IZQUIERDA izquierda -->

<?php if ($izquierdad != null) { ?>

    <?php if ($izquierdad->img_d == (null)) {

        $idpii = $izquierdad->r_d;

        $nombreder = $izquierdad->nombre_d . " " . $izquierdad->apellido_d;

        $fotoizi = "usuario.png";

    } else {

        $idpii = $izquierda->r_d;



        $nombreder = $izquierdad->nombre_d . " " . $izquierdad->apellido_d;

        $fotoizi = $izquierdad->img_d;

    } ?>

<?php } else {

    $idpii = 0;

    $nombreder = "No hay nada";

    $fotoizi = "vacio.png";

} ?>

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
    .card {
        margin-top: 3rem;
    }

    .nietos {
        margin-right: 3rem;
    }

    .tarj {
        height: 250px
    }
    .imagenes{
        height: 100px;
    }
</style>
<center>
    <h1 style="font-family: 'Abyssinica SIL', serif;margin-top:3rem;"> Tu Arbol de Nivel</h1>
</center>
<div class="col-12" style="margin-top:2rem;">
    <center>
        <div class="card tarj" style="width: 10rem;">
            <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $principalp ?>" class="card-img-top imagenes" alt="..."
                width="50%">
            <div class="card-body">
                <p class="card-title">
                    <?= $nombrep ?>
                </p>
                <p class="card-text">
                    <?= $idp ?>
                </p>
            </div>
        </div>
    </center>
</div>
<!--Hijos-->
<center>
    <div class="row">
        <!--Hijo Izquierda -->
        <div class="col-6">
            <div class="card tarj" style="width: 10rem;">
                <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $principaliz ?>" class="card-img-top imagenes" alt="..."
                    width="50%">
                <div class="card-body">
                    <p class="card-title">
                        <?= $nombreiz ?>
                    </p>
                    <p class="card-text">
                        <?= $idpi ?>
                    </p>
                </div>
            </div>

            <br>
        </div>
        <!--Hijo derecha -->
        <div class="col-6">
            <div class="card tarj" style="width: 10rem;">
                <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $principalde ?>" class="card-img-top imagenes" alt="..."
                    width="50%">
                <div class="card-body">
                    <p class="card-title">
                        <?= $nombred ?>
                    </p>
                    <p class="card-text">
                        <?= $idpd ?>
                    </p>
                </div>
            </div>
            <br>
        </div>
    </div>
</center>
<!-- Nietos -->
<center>
    <div class="row g-4 row-cols-2 row-cols-lg-4" style="margin-bottom: 1rem;">
        <!-- Nieto Izquierda Izquierda -->
        <div class="feature col" style="padding-top: 1rem;">
            <div class="card nietos tarj" style="width: 10rem;">
                <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $fotoizi ?>" class="card-img-top imagenes"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-title">
                        <?= $nombreder ?>
                    </p>
                    <p class="card-text">
                        <?= $idpii ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="feature col" style="padding-top: 1rem;">
            <!-- Nieto derecha Izquierda -->
            <div class="card nietos tarj" style="width: 10rem;">
                <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $fotoizd ?>" class="card-img-top imagenes"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-title">
                        <?= $nombreizq ?>
                    </p>
                    <p class="card-text">
                        <?= $idpid ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="feature col" style="padding-top: 1rem;">
            <!-- Nieto izquierda Derecha -->
            <div class="card nietos tarj" style="width: 10rem;">
                <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $derechaiz ?>" class="card-img-top imagenes"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-title">
                        <?= $nombreiz2 ?>
                    </p>
                    <p class="card-text">
                        <?= $idpdi ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="feature col" style="padding-top: 1rem;">
            <!-- Nieto Derecha derecha -->
            <div class="card nietos tarj" style="width: 10rem;">
                <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $derechade ?>" class="card-img-top imagenes"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-title">
                        <?= $nombrede ?>
                    </p>
                    <p class="card-text">
                        <?= $idpdd ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</center>