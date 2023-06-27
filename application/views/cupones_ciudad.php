<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel=”stylesheet” href=”https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css”>


<div class="main-panel">

    <!-- ============================================================== -->

    <!-- Container fluid  -->

    <!-- ============================================================== -->

    <div class="content-wrapper"
        style="background-image: url(https://www.tucash.co/wp-content/uploads/2022/03/fondo-banner-tucash-1400x397.png); background-repeat:no-repeat;background-attachment:fixed;background-size:cover;">



        <!-- ciclo cupones -->



        <!-- Column -->



        <div class="row">

            <?php if ($perfil->img_cedula_back == (NULL) || $perfil->img_cedula_front == (NULL)) { ?>

                <div class="col-lg 12">

                    <div class="card" style="margin-top: 2rem;">

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



                <br>


                <div class="container" style="margin-top: 2rem;">
                    <div class="row">
                        <div class="col-8">
                            <h2> Ecommvale disponibles de
                                <?= $comercio->nombre_negocio ?> :
                            </h2>
                            <?php if ($comer->user_instagram != NULL) { ?>
                                <a href=" <?= $comer->user_instagram ?>"><i class="mdi mdi-instagram icon-lg"
                                        style="color:#cc2074;"></i></a>
                            <?php } else { ?>
                            <?php } ?>
                            <?php if ($comer->user_facebook != NULL) { ?>
                                <a href=" <?= $comer->user_facebook ?>"><i class="mdi mdi-facebook icon-lg"></i></a>
                            <?php } ?>
                        </div>
                        <div class="col-4">
                            <h5>direccion:
                                <?= $comer->direccion ?>
                            </h5>
                            <h5>ciudad:
                                <?= $comer->ciudad ?>
                            </h5>
                            <h5>celular:
                                <?= $comer->celular ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <?php if ($perfil->ciudad == (NULL) || $perfil->ciudad == "seleccione ciudad") { ?>

                    <div class="col-lg 12">

                        <div class="card">

                            <div class="card-body">

                                <center>

                                    <i class="mdi mdi-alert-circle-outline icon-lg" style="color:red;"></i>

                                    <h1>Espera un momento</h1>

                                    <h2>No has seleccionado tu ciudad , Ve a perfil y actualiza tus datos</h2>

                                    <a href="<?= base_url() ?>Perfil/perfil" type="button"
                                        class="btn btn-success  ">Actualizar</a>

                                </center>

                            </div>

                        </div>

                    </div>

                <?php } else { ?>



                    <div class="error">

                        <?php if ($this->session->flashdata("error")) { ?>

                            <p>
                                <?php echo $this->session->flashdata("error") ?>
                            </p>

                        <?php } ?>



                    </div>



                    <div style="padding-bottom: 2rem;"></div>

                    <div class="input-group mb-2" id="add"> </div>


                    <div class="row g-6  row-cols-1 row-cols-lg-6">
                        <?php foreach ($product as $C) { ?>

                            <div class="feature col" style="padding-top: 1rem;">
                                <div class="card">
                                    <div class="card-body" style="height:320px;">
                                        <center>
                                            <h5 class="card-title" style="height:28px;">
                                                <?php echo $C->nombre ?>?>
                                            </h5>
                                            <h6 class="card-title">$
                                                <?= number_format($C->precio, 0) ?>
                                            </h6>
                                            <div>
                                                <img src="<?= base_url() ?>assets/img/<?= $C->img ?>" alt="imagen" height="150px"
                                                    style="max-width: 100%;"><br><br>
                                            </div>
                                            <button type="button" class="btn btn-success  btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#carrito<?= $C->id ?>">comprar</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Carrito -->
                            <div class="modal fade" id="carrito<?php echo $C->id ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?= base_url() ?>Proceso/aggCarrito/<?= $C->id ?>" method="post">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Estas seguro de agregar
                                                    <?= $C->nombre ?> al carrito
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="">Cantidad</label>
                                                        <input type="number" class="form-control form-control-sm" value="1"
                                                            name="cantidad" required>
                                                    </div>
                                                    <div class="col-6">
                                                        <img src="<?= base_url() ?>assets/img/<?= $C->img ?>" alt="imagen"
                                                            width="200px" height="150px">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-success btn-sm">Agregar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="carrusel<?= $C->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Imagenes de
                                                <?= $C->nombre ?>
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-7">
                                                    <?php if ($C->img2 == "logo.png") { ?>
                                                        <img src="<?= base_url() ?>assets/img/<?= $C->img ?>" alt="imagen" width="100%"
                                                            height="300px">
                                                    <?php } else { ?>
                                                        <div id="carouselExampleControlsNoTouching<?= $C->id ?>" class="carousel slide"
                                                            data-bs-touch="false">
                                                            <div class="carousel-inner">
                                                                <div class="carousel-item active">
                                                                    <img src="<?= base_url() ?>assets/img/<?= $C->img ?>" alt="imagen"
                                                                        width="100%" height="300px">
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <img src="<?= base_url() ?>assets/img/<?= $C->img2 ?>" width="100%"
                                                                        height="300px" class="d-block w-100" alt="...">
                                                                </div>
                                                                <?php if ($C->img3 == "logo.png") { ?>

                                                                <?php } else { ?>
                                                                    <div class="carousel-item">
                                                                        <img src="<?= base_url() ?>assets/img/<?= $C->img3 ?>" width="100%"
                                                                            height="300px" class="d-block w-100" alt="...">
                                                                    </div>
                                                                <?php } ?>

                                                            </div>
                                                            <button class="carousel-control-prev" type="button"
                                                                data-bs-target="#carouselExampleControlsNoTouching<?= $C->id ?>"
                                                                data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button"
                                                                data-bs-target="#carouselExampleControlsNoTouching<?= $C->id ?>"
                                                                data-bs-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-5">
                                                    <h4>Detalles del producto</h4>
                                                    <p class=" m-b-0">Finaliza el:
                                                        <?= $C->fecha_corte ?>
                                                    </p>
                                                    <?php if ($C->id_tipo == "1") { ?>
                                                        <p class=' m-b-0'>Domicilio: No disponible</p>
                                                    <?php } else if ($C->id_tipo == "2") { ?>
                                                            <p class=" m-b-0"> Sólo domicilicios </p>
                                                            <p class=" m-b-0">Domicilio:$
                                                            <?= $C->valor_domicilio ?>
                                                            </p>
                                                            <p class=" m-b-0">Tiempo entrega:
                                                            <?= $C->hora ?> horas -
                                                            <?= $C->minutos ?>+ minutos
                                                            </p>
                                                    <?php } else { ?>
                                                            <p class=" m-b-0"> Domicilicios y Presencial </p>
                                                            <p class=" m-b-0">Domicilio:$
                                                            <?= $C->valor_domicilio ?>
                                                            </p>
                                                            <p class=" m-b-0">Tiempo entrega:
                                                            <?= $C->hora ?> horas -
                                                            <?= $C->minutos ?>+ minutos
                                                            </p>
                                                    <?php } ?>
                                                    <?php if ($C->envio_nacio == 0) { ?>
                                                        <p style="color:black"> No disponible envios nacionales</p>
                                                    <?php } else { ?>
                                                        <p style="color:black"> Disponibles envios nacionales</p>
                                                        <p style="color:black"> Valor envio:
                                                            <?= number_format($C->valor_nacio, 0) ?>
                                                        </p>
                                                    <?php } ?>
                                                    <p class=" m-b-0">Descripcion:
                                                        <?= $C->descripcion ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>



                        <!-- id= add para designar el lugar donde quiere decignar JS -->


                        <!-- 
                            <?php foreach ($e as $e) { ?>

                                    <div class="modal fade" id="compra_cupon<?= $e->id ?>" tabindex="-1" style="z-index: 1000;" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Comprar <?php echo $e->nombre ?> </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form action="<?= base_url() ?>Proceso/proceso/<?= $e->id ?>" method="POST">
                                                    <div class="modal-body">

                                                        <h3>Esta seguro de comprar este producto?</h3> <br><br>
                                                        <label for="disabledTextInput" class="form-label">Seleccione metodo de pago</label>
                                                        <select class="form-select form-select-sm" name="tarjeta" aria-label="Default select example" id="cambio<?= $e->id ?>">
                                                            <option value="1" selected>Wallet e`comm</option>
                                                            <?php foreach ($tb_tarje as $t) { ?>
                                                                    <option value="<?= $t->id ?>"><?= $t->nombre_tarje ?></option>
                                                            <?php } ?>
                                                        </select> <br>
                                                        <label for="">Cantidad:</label>
                                                        <input type="number" name="cantidad" placeholder="ingrese la cantidad" required><br><br>
                                                        <?php if ($e->id_tipo == 1) { ?>
                                                                <div class="row">
                                                                    <p class=" m-b-0">No disponible Domicilio </p>
                                                                </div>
                                                        <?php } else if ($e->id_tipo == 2) { ?>
                                                                    <div class="mb-3">
                                                                        <label class="form-label text-body">Dirección:</label>
                                                                        <select class="form-select" aria-label="Default select example" id="modo<?= $e->id ?>">
                                                                            <option selected>seleccione modalidad</option>
                                                                        <?php if ($e->envio_nacio == 1) { ?>
                                                                                    <option value="4">Envio nacional</option>
                                                                        <?php } ?>
                                                                            <option value="1">Domicilicio Local</option>
                                                                        </select>
                                                                    </div><br><br>
                                                                    <div id="addox2<?= $e->id ?>"></div>
                                                        <?php } else { ?>
                                                                    <div class="input-group lg-5">
                                                                        <select class="form-select" aria-label="Default select example" id="tipo22<?= $e->id ?>" name="id_tipo">
                                                                            <option selected>Opciones de Compra</option>
                                                                        <?php if ($e->envio_nacio == 1) { ?>
                                                                                    <option value="4">Envio nacional</option>
                                                                        <?php } ?>
                                                                        <?php foreach ($tipo as $t) { ?>
                                                                                    <option value="<?= $t->id ?>"><?= $t->nombre ?></option>
                                                                        <?php } ?>
                                                                        </select>
                                                                    </div><br><br>
                                                                    <div id="addo<?= $e->id ?>"></div>
                                                        <?php } ?>
                                                        <div class="input-group input-group-sm mb-2">
                                                            <input type="hidden" name="id_comercio" placeholder="comercio" value="<?= $e->id_usuario ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                            <input type="hidden" name="producto" placeholder="producto" value="<?= $e->nombre ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                            <input type="hidden" name="id_usuario" placeholder="id_usuario" value="<?= $perfil->id ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                            <input type="hidden" name="precio" placeholder="precio" value="<?= $e->precio ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                            <input type="hidden" name="id_papa_pago" placeholder="id_papa_pago" value="<?= $perfil->id_papa_pago ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                            <input type="hidden" name="stock" placeholder="stock" value="<?= $e->stok ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                            <input type="hidden" name="descuento" placeholder="descuento" value="<?= $e->descuento ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                            <script>
                                                                $('#tipo22<?= $e->id ?>').on("change", function() {

                                                                    id = $(this).val();
                                                                    html = "";
                                                                    if (id == 1) {
                                                                        html = '<div class="input-group mb-2">';
                                                                        html += '<h4 > Ir a reglamar al establecimiento  </h4>'
                                                                        html += '</div>';
                                                                        $('#addo<?= $e->id ?>').html(html);
                                                                    } else if (id == 2) {
                                                                        html = '<div>';
                                                                        html += '<h4 style="color:black;">Solo Domicilios: </h4>';
                                                                        html += '<input type="text" class="form-control" name="direccion" placeholder="digite la direccion" required>'
                                                                        html += '</div>'
                                                                        $('#addo<?= $e->id ?>').html(html);
                                                                    } else {

                                                                        html += '<h4 style="color:black;">Envio Nacional: </h4>';
                                                                        html += '<div class="input-group mb-3">';
                                                                        html += '<input type="text" class="form-control" name="ciudad" placeholder="digite la Ciudad" required>'
                                                                        html += '<input type="text" class="form-control" name="direccion" placeholder="digite la direccion de residencia" required>'
                                                                        html += '</div><br>';
                                                                        html += '<p>Condiciones:</p>'
                                                                        html += '<p>- 5 dias habiles</p>'
                                                                        html += '<p>- Se cancela el valor del envio de una vez de tu billetera</p>'
                                                                        $('#addo<?= $e->id ?>').html(html);
                                                                    };

                                                                });
                                                                $('#modo<?= $e->id ?>').on("change", function() {

                                                                    id = $(this).val();
                                                                    html = "";
                                                                    if (id == 1) {
                                                                        html = '<div>';
                                                                        html += '<h4 style="color:black;">Solo Domicilios: </h4>';
                                                                        html += '<input type="text" class="form-control" name="direccion" placeholder="digite la direccion" required>'
                                                                        html += '</div>'
                                                                        $('#addox2<?= $e->id ?>').html(html);
                                                                    } else if (id == 4) {
                                                                        html += '<h4 style="color:black;">Envio Nacional: </h4>';
                                                                        html += '<div class="input-group mb-3">';
                                                                        html += '<input type="text" class="form-control" name="direccion" placeholder="digite la Ciudad" required>'
                                                                        html += '<input type="text" class="form-control" name="direccion" placeholder="digite la direccion de residencia" required>'
                                                                        html += '</div><br>';
                                                                        html += '<p>Condiciones:</p>Envio 3 dias habiles</p>'
                                                                        html += '<p>- 5 dias habiles</p>'
                                                                        html += '<p>- Se cancela el valor del envio de una vez de tu billetera</p>'
                                                                        $('#addox2<?= $e->id ?>').html(html);
                                                                    } else {
                                                                        html += ''
                                                                        $('#addox2<?= $e->id ?>').html(html);
                                                                    };

                                                                });
                                                            </script>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-success">Comprar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            <?php } ?> -->

                    <?php } ?>

                <?php } ?>



            </div> <br><br>









            <!-- End Container fluid  -->

            <!-- ============================================================== -->





            <!-- ============================================================== -->

            <!-- End Container fluid  -->

            <!-- ============================================================== -->

            <!-- ============================================================== -->

            <!-- End Page wrapper  -->

        </div>



        <script>
            $(document).ready(function () {

                var base_url = "<?= base_url() ?>";

                $('#direccion1').on("change", function () {

                    if ($(this).is(':checked')) {

                        html = '<div class="input-group mb-2">';

                        html += '<input type="text" class="form-control" name="direccion" placeholder="digite la direccion">'

                        html += '</div>'

                        $('#addi').html(html);

                    } else {

                        html = '';

                        $('#addi').append(html);

                    }



                })


            });
        </script>