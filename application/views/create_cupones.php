<div class="contenido" style="margin:20px;">
    <div class="container">
        <div class="titulo">
            <h1>Crear un nuevo Ecommvale</h1>
            <br><br>
        </div>
        <!-- Agregar cupon modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearcupon">
            Crear Ecommvale
        </button>
    </div>
    
    <!-- Create modal -->
    <div class="modal fade" id="crearcupon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Ecommvale</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url() ?>Comercio/guardarCupones/<?= $perfil->id ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <select class="form-select" aria-label="Default select example" name="id_categoria"
                                    required>
                                    <option value="0" selected>Categorias</option>
                                    <?php foreach ($categorias as $c) { ?>
                                                        <option value="<?= $c->id ?>"><?= $c->nombre ?></option>
                                    <?php } ?>
                                </select>

                            </div><br>
                            <div class="mb-3">
                                <input type="tex" class="form-control" name="nombre" placeholder="producto" required>
                            </div><br>
                            <div class="mb-3" style="padding-right: 50px;">
                                <input type="number" class="form-control" name="stok" placeholder="Cantidad">
                            </div><br>
                            <div class="mb-3">
                                <input class="form-check-input" style="width: 20px ; height:20px; padding-left: 40px;;"
                                    type="checkbox" value="" id="ilimitado1">
                                <p> Ilimitados</p>
                                <div class="input-group" id="ilimitado"></div>
                                <!--id= add para designar el lugar donde quiere decignar JS -->
                            </div>

                            <div class="mb-3">
                                <input type="file" class="form-control" name="img" placeholder="imagen producto">
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="precio" placeholder="precio" required>
                            </div>
                            <div class="mb-3" style="padding-right: 70px;">
                                <label class="form-label">Fecha de cierre</label>
                                <input type="datetime-local" class="form-control" name="fecha_corte"
                                    placeholder="fecha cierre" required>
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="descuento" placeholder="descuento"
                                    required>
                                <p style="color: red;">Descuento para ECOMM</p>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">descripción</label>
                                <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1"
                                    rows="3"></textarea>
                            </div>
                            <div class="form-check " style="padding-left: 2rem;">
                                <div class="row">
                                    <div class="input-group mb-3">
                                        <select class="form-select" aria-label="Default select example" id="tipo2"
                                            name="id_tipo">
                                            <option selected>Opciones de Venta</option>
                                            <?php foreach ($tipo as $t) { ?>
                                                                <option value="<?= $t->id ?>"><?= $t->nombre ?></option>
                                            <?php } ?>
                                        </select>
                                    </div><br>
                                    <br>
                                    <div id="add"></div>
                                </div>
                            </div>
                            <div class="input-group mb-2" id="add"></div>
                            <!--id= add para designar el lugar donde quiere decignar JS  -->
                            <div class="mb-2" style=" padding-left: 2rem;">
                                <input class="form-check-input" style="width: 20px ; height:20px; padding-left: 3rem;"
                                    type="checkbox" value="" id="envios_nacio"> <br>
                                <p> Realiza envios nacionales?</p>
                            </div>
                            <div class="input-group" id="envios1"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg 12" style="padding-top: 5rem;">
                        <div class="card cc-widget">
                            <div class="card-body">

                                <h2>Mis Ecommvales: </h2> <br>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table" id="order-listing2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Imagen</th>
                                                    <th scope="col">Stok</th>
                                                    <th scope="col">Precio</th>
                                                    <th scope="col">Fecha Corte</th>
                                                    <th scope="col">Porcentaje</th>
                                                    <th scope="col">Modalidad de Venta</th>
                                                    <th scope="col">Configuracion</th>
                                                    <th scope="col">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($cupones as $c) { ?>

                                                                    <tr>
                                                                        <td><?= $c->nombre ?></td>
                                                                        <td><button type="button" style="border:none;background:none;" data-bs-toggle="modal" data-bs-target="#carrusel<?= $c->id ?>"><img src="<?= base_url() ?>assets/img/<?= $c->img ?>" alt="imagen" width="50%" height="50%"></button></td>
                                                                        <?php if ($c->stok > 300) { ?>
                                                                                            <td>ilimitado</td>
                                                                        <?php } else { ?>
                                                                                            <td><?= $c->stok ?></td>
                                                                        <?php } ?>
                                                                        <td>$ <?= number_format($c->precio, 0) ?></td>
                                                                        <td><?= $c->fecha_corte ?></td>
                                                                        <td><?= $c->descuento ?>%</td>
                                                                        <td><?= $c->tipo ?></td>
                                                                        <td><button type="button" class="btn btn-success " style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#modificar<?= $c->id ?>"><i class="mdi mdi-wrench"></i></button></td>
                                                                        <?php if ($c->activo == 1) { ?>
                                                                                            <td> <button type="button" class="btn btn-danger " style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#eliminar<?= $c->id ?>">Inhabilitar Ecommvale</button></td>
                                                                        <?php } else { ?>
                                                                                            <td><button type="button" class="btn btn-info " style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#habi<?= $c->id ?>">Habilitar Ecommvale</button></td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <!-- Modal carrusel -->
                                                                    <div class="modal fade" id="carrusel<?= $c->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Imagenes de <?= $c->nombre ?></h1>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <div id="myCarousel<?= $c->id ?>" class="carousel slide" data-bs-ride="carousel">
                                                                                        <div class="carousel-indicators">
                                                                                            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                                                            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                                                            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                                                        </div>
                                                                                        <div class="carousel-inner">
                                                                                            <div class="carousel-item active">
                                                                                                <img src="<?= base_url() ?>assets/img/<?= $c->img ?>" width="100%" height="400px">

                                                                                                <div class="container">
                                                                                                    <div class="carousel-caption">
                                                                                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modi1<?= $c->id ?>">Cambiar imagen</button>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <img src="<?= base_url() ?>assets/img/<?= $c->img2 ?>" width="100%" height="400px">


                                                                                                <div class="container">
                                                                                                    <div class="carousel-caption">
                                                                                                        <?php if ($c->img2 == "logo.png") { ?>
                                                                                                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modi2<?= $c->id ?>">Agregar imagen</button>
                                                                                                        <?php } else { ?>
                                                                                                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modi2<?= $c->id ?>">Cambiar imagen</button>
                                                                                                        <?php } ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="carousel-item">
                                                                                                <img src="<?= base_url() ?>assets/img/<?= $c->img3 ?>" width="100%" height="400px">


                                                                                                <div class="container">
                                                                                                    <div class="carousel-caption text-end">
                                                                                                        <?php if ($c->img3 == "logo.png") { ?>
                                                                                                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modi3<?= $c->id ?>">Agregar imagen</button>
                                                                                                        <?php } else { ?>
                                                                                                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modi3<?= $c->id ?>">Cambiar imagen</button>
                                                                                                        <?php } ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel<?= $c->id ?>" data-bs-slide="prev">
                                                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                                            <span class="visually-hidden">Previous</span>
                                                                                        </button>
                                                                                        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel<?= $c->id ?>" data-bs-slide="next">
                                                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                                            <span class="visually-hidden">Next</span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal fade" id="habi<?= $c->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h1 class="modal-title fs-5 text-body" id="exampleModalLabel">Habilitar <?= $c->nombre ?></h1>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form action="<?= base_url() ?>Comercio/habilitarCupon/<?= $c->id ?>" method="post" enctype="multipart/form-data">
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="mb-3">
                                                                                                <h6 class=" text-body">Esta seguro de habilitar <?= $c->nombre ?>?</h6>
                                                                                                <input type="hidden" value="<?= $perfil->id ?>" name="id_comercio">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal fade" id="eliminar<?= $c->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h1 class="modal-title fs-5 text-body" id="exampleModalLabel">Inhabilitar <?= $c->nombre ?></h1>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form action="<?= base_url() ?>Comercio/eliminarCupon/<?= $c->id ?>" method="post" enctype="multipart/form-data">
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="mb-3">
                                                                                                <h6 class=" text-body">Esta seguro de inhabilitar <?= $c->nombre ?>?</h6>
                                                                                                <input type="hidden" value="<?= $perfil->id ?>" name="id_comercio">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal fade" id="modificar<?= $c->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h1 class="modal-title fs-5 text-body" id="exampleModalLabel">Modificar Valores de <?= $c->nombre ?></h1>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form action="<?= base_url() ?>Comercio/modificarcupon/<?= $c->id ?>" method="POST" enctype="multipart/form-data">
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                        <div class="mb-3">
                                                                                                <label class="form-label text-body">Nombre:</label>
                                                                                                <input type="text" class="form-control" name="nombre" placeholder="nombre" value="<?= $c->nombre ?>">
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label class="form-label text-body">Precio:</label>
                                                                                                <input type="number" class="form-control" name="precio" placeholder="precio" value="<?= $c->precio ?>">
                                                                                            </div>
                                                                                            <div class="mb-3" style="padding-right: 70px;">
                                                                                                <label class="form-label text-body">Fecha de cierre:</label>
                                                                                                <input type="datetime-local" class="form-control" name="fecha_corte" placeholder="fecha cierre" value="<?= $c->fecha_corte ?>">
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label class="form-label text-body">Porcentaje:</label>
                                                                                                <input type="number" class="form-control" name="descuento" placeholder="descuento" value="<?= $c->descuento ?>">
                                                                                                <p style="color: red;">Debe ser mayor o igual al ya estipulado!</p>
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label class="form-label text-body">descripción:</label>
                                                                                                <input type="text" class="form-control" name="descripcion" placeholder="descripcion" value="<?= $c->descripcion ?>">
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label class="form-label text-body">Cambiar Modalidad de Venta</label>
                                                                                                <select class="form-select" aria-label="Default select example" id="tipo3<?= $c->id ?>" name="id_tipo">
                                                                                                    <option selected value="<?= $c->id_tipo ?>"><?= $c->tipo ?></option>
                                                                                                    <?php foreach ($tipo as $t) { ?>
                                                                                                                        <option value="<?= $t->id ?>"><?= $t->nombre ?></option>
                                                                                                    <?php } ?>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div id="addi<?= $c->id ?>"></div>
                                                                                            <input type="hidden" value="<?= $perfil->id ?>" name="id_comercio">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <button type="submit" class="btn btn-success">Guardar</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!--Modales para cambio de imagenes -->
                                                                    <div class="modal fade" id="modi1<?= $c->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h1 class="modal-title fs-5 text-body" id="exampleModalLabel">Actualizar imagen 1 de <?= $c->nombre ?></h1>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form action="<?= base_url() ?>Comercio/img1/<?= $c->id ?>" method="post" enctype="multipart/form-data">
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="mb-3">
                                                                                                <label for="">Agrega la imagen </label>
                                                                                                <input type="file" name="img">
                                                                                                <input type="hidden" value="<?= $perfil->id ?>" name="negocio">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal fade" id="modi2<?= $c->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h1 class="modal-title fs-5 text-body" id="exampleModalLabel">Actualizar imagen 2 de <?= $c->nombre ?></h1>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form action="<?= base_url() ?>Comercio/img2/<?= $c->id ?>" method="post" enctype="multipart/form-data">
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="mb-3">
                                                                                                <label for="">Agrega la imagen </label>
                                                                                                <input type="file" class="form-control" placeholder="Username" aria-label="img" aria-describedby="basic-addon1" name="img">
                                                                                                <input type="hidden" value="<?= $perfil->id ?>" name="negocio">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal fade" id="modi3<?= $c->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h1 class="modal-title fs-5 text-body" id="exampleModalLabel">Actualizar imagen 3 de <?= $c->nombre ?></h1>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form action="<?= base_url() ?>Comercio/img3/<?= $c->id ?>" method="post" enctype="multipart/form-data">
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="mb-3">
                                                                                                <label for="">Agrega la imagen </label>
                                                                                                <input type="file" name="img">
                                                                                                <input type="hidden" value="<?= $perfil->id ?> " name="negocio">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                                            <button type="submit" class="btn btn-success">Aceptar</button>
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
</div>

<script>
        $(document).ready(function() {
            var base_url = "<?= base_url() ?>";
            $('#tipo2').on("change", function() {

                id = $(this).val();
                html = "";
                if (id == 1) {
                    html = '<div class="input-group mb-2">';
                    html += '<h4 style="color:red;">Sólo presencial </h4>'
                    html += '</div>';
                    $('#add').html(html);
                } else if (id == 2) {

                    html = '<div class="input-group mb-2">';
                    html += '<h4>Solo Domicilios </h4>';
                    html += '</div>'
                    html = '<div class="input-group mb-2">';
                    html += '<input type="number" class="form-control" name="valor_domicilio" placeholder="digite el valor del domicio" required>'
                    html += '</div>'
                    html += '<div class="input-group mb-2">'
                    html += '<input type="number" class="form-control" name="hora" placeholder="horas" required>'
                    html += '<span class="input-group-text">||</span>'
                    html += '<input type="number" class="form-control" name="minutos" placeholder="minutos" required>'
                    html += '</div>';
                    $('#add').html(html);

                } else {
                    html = '';
                    html = '<div class="input-group mb-2">';
                    html += '<h4>Ambas </h4>';
                    html += '</div>'
                    html = '<div class="input-group mb-2">';
                    html += '<input type="text" class="form-control" name="valor_domicilio" placeholder="digite el valor del domicio">'
                    html += '</div>'
                    html += '<div class="input-group mb-2">'
                    html += '<input type="text" class="form-control" name="hora" placeholder="horas"required>'
                    html += '<span class="input-group-text">||</span>'
                    html += '<input type="text" class="form-control" name="minutos" placeholder="minutos"required>'
                    html += '</div>';
                    $('#add').html(html);
                }

            });

            $('#tipo3<?= $c->id ?>').on("change", function() {
                console.log("cambio");
                id = $(this).val();
                html = "";
                if (id == 1) {
                    console.log(id);
                    html = '';
                    html = '<div class="input-group mb-2">';
                    html += '<h4 style="color:red;">Sólo presencial </h4>'
                    html += '</div>';
                    $('#addi3<?= $c->id ?>').html(html);
                } else if (id == 2) {

                    console.log(id);
                    html = '';
                    html = '<div class="input-group mb-2">';
                    html += '<h4>Solo Domicilios </h4>';
                    html += '</div>'
                    html = '<div class="input-group mb-2">';
                    html += '<input type="number" class="form-control" name="valor_domicilio" placeholder="digite el valor del domicio" required>'
                    html += '</div>'
                    html += '<div class="input-group mb-2">'
                    html += '<input type="number" class="form-control" name="hora" placeholder="horas" required>'
                    html += '<span class="input-group-text">||</span>'
                    html += '<input type="number" class="form-control" name="minutos" placeholder="minutos" required>'
                    html += '</div>';
                    $('#addi3<?= $c->id ?>').html(html);
                } else {
                    console.log(id);
                    html = '';
                    html = '<div class="input-group mb-2">';
                    html += '<h4>Ambas </h4>';
                    html += '</div>'
                    html = '<div class="input-group mb-2">';
                    html += '<input type="text" class="form-control" name="valor_domicilio" placeholder="digite el valor del domicio">required'
                    html += '</div>'
                    html += '<div class="input-group mb-2">'
                    html += '<input type="text" class="form-control" name="hora" placeholder="horas"required>'
                    html += '<span class="input-group-text">||</span>'
                    html += '<input type="text" class="form-control" name="minutos" placeholder="minutos"required>'
                    html += '</div>';
                    $('#addi3<?= $c->id ?>').html(html);
                }

            });
            $('#envios_nacio').on("change", function() {

                if ($(this).is(':checked')) {
                    console.log("holi, cambio");
                    html = '<div class="input-group mb-2">';
                    html += '<h4>Haras envios Nacionales </h4>';
                    html += '</div>'
                    html = '<div class="input-group mb-2">';
                    html += '<input type="number" class="form-control" name="valor_nacio" placeholder="digite el valor del envio nacional" required>'
                    html += '</div>'
                    $('#envios1').html(html);

                } else {
                    console.log("holi, cambio");
                    html = '';

                    $('#envios1').html(html);

                }

            });
        })
    </script>