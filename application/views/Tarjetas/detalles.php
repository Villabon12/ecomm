<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
<div class="main-panel">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="content-wrapper">

        <!-- ciclo cupones -->

        <!-- Column -->

        <div class="row">
            <?php if ($perfil->img_cedula_back == (NULL) || $perfil->img_cedula_front == (NULL)) { ?>
                <div class="col-lg 12">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <i class="mdi mdi-alert-circle-outline icon-lg" style="color:red;"></i>
                                <h1>Espera un momento</h1>
                                <h2>Valida tus datos primero</h2>
                                <a href="<?= base_url() ?>Perfil/perfil" type="button" class="btn btn-success  ">validar</a>
                            </center>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <?php if ($perfil->ciudad == (NULL) || $perfil->ciudad == "seleccione ciudad") { ?>
                    <div class="col-lg 12">
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <i class="mdi mdi-alert-circle-outline icon-lg" style="color:red;"></i>
                                    <h1>Espera un momento</h1>
                                    <h2>No has seleccionado tu ciudad , Ve a perfil y actualiza tus datos</h2>
                                    <a href="<?= base_url() ?>Perfil/perfil" type="button" class="btn btn-success  ">Actualizar</a>
                                </center>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row "><br>
                        <?php if ($this->session->flashdata("error")) { ?>
                            <p><?php echo $this->session->flashdata("error") ?></p>
                        <?php } ?>
                        <h4 style="margin-top:1rem ;"> Tarjetas Disponibles : </h4>
                        <?php foreach ($tb_tarjetas as $t) { ?>
                            <div class="col-4" style="padding-top: 1rem;">
                                <div class="card">
                                    <div class="card-body">
                                        <center>
                                            <h5 class="card-title"><?= $t->nombre_negocio . "->" . $t->nombre ?></h5>
                                            <div class="container-fluid">
                                                <img src="<?= base_url() ?>assets/img/banner/tarjeta.jpg" height="150px" width="100%" alt="100%">
                                                <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $t->img_perfil ?>" width="50px" style="margin-top: -200px;margin-left: 150px; " height="50px" alt="profile">
                                            </div>
                                            <button style="margin-top: 1rem;" type="button" class="btn btn-success  btn-sm" data-bs-toggle="modal" data-bs-target="#mas_info<?= $t->id ?>">Mas info</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal mas info -->
                            <div class="modal fade" id="mas_info<?= $t->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<? base_url() ?>/Tarjetas/compra_tarjeta/<?= $t->id ?>" method="get">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel"> Comprar tarjeta <?= $t->nombre ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Cupo:<?= number_format($t->valor, 0) ?></h5>
                                                <h5>Cantidad:<?= $t->cantidad ?></h5>
                                                <h5>promoción hasta:<?= $t->fecha_corte ?></h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-success">Comprar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                <?php } ?>
            <?php } ?>

        </div> <br><br>

        <!-- End Container fluid  -->
        <!-- ============================================================== -->

        <!-- INICIO MODAL VENTAS -->
        <!-- Modal -->



        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
    </div>

  