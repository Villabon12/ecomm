<body>

    <div class="main-panel">
        <div class="content-wrapper">


        <h1>Crear un nuevo cupon</h1>
        <br><br>
        <!-- Agregar cupon modal -->
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Crear Cupones
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width:500px ; ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear cupon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="<?= base_url() ?>Comercio/guardarCupones" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" class="visually-hidden" name="id_usuario" value="<?= $perfil->id ?> " placeholder="id-producto">

                                <select class="form-select" aria-label="Default select example" name="id_producto" style="margin-bottom:1rem ;">
                                    <option selected>Seleccione un producto</option>
                                    <?php foreach ($productos as $p) { ?>
                                        <option value="<?= $p->id ?>"><?= $p->nombre ?></option>
                                    <?php } ?>
                                </select>
                                <div class="mb-3">
                                    <input type="tex" class="form-control" name="descuento" placeholder="descuento"> <p style="color: red;">Descuento para ECOMM</p>
                                </div>
                                <div class="mb-3" style="padding-right: 70px;">
                                    <label class="form-label">Fecha de cierre</label>
                                    <input type="datetime-local" class="form-control" name="fecha_corte" placeholder="fecha cierre">
                                </div>
                                <div class="mb-3"style="padding-right: 50px;">
                                    <input type="tex" class="form-control" name="stok" placeholder="stock" >
                                </div><br>
                                <div class="mb-3">
                                <input class="form-check-input" style="width: 20px ; height:20px; padding-left: 40px;;" type="checkbox" value=""><p> Ilimitados</p>
                                </div><br>
                                <div class="input-group mb-2" id="ilimitado"></div> <!-- id= add para designar el lugar donde quiere decignar JS -->



                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-warning">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-lg 12" style="padding-top: 5rem;">
            <div class="card cc-widget">
                <div class="card-body">

                    <h2>Mis Cupones </h2> <br>

                    <div class="row">
                        <?php foreach ($cupones as $c) { ?>

                            <div class="col-lg-4 col-md-2" style="padding-right: 2rem;">
                                <div class="card cc-widget btn-warning">
                                    <div class="card-body btn-warning">
                                        <img src="<?= base_url() ?>assets/img/<?= $c->img  ?>" alt="imagen" width="270px" height="250px">
                                        <h3 style="color:black"><?= $c->nombre ?></h3>
                                        <?php if ( $c->stok>300 ) { ?>
                                           <p style="color:black">stock:ilimitado</p>
                                           <?php } else{?>
                                            <p style="color:black">stock: <?=$c->stok ?></p>
                                            <?php  if($c->stok<5){?>
                                            <p style="color:red">¡Pocas unidades!</p>
                                            <?php }?>
                                            
                                          <?php } ?>
                                        
                                        <p style="color:black">precio: $ <?= number_format($c->precio,0)  ?></p>
                                    <!--   <p style="color:black">cashback: $<?= (($c->precio * $c->descuento)/100)* $c->cashback /100 ?> </p>-->
                                        <p style="color:black">fecha de corte:<?= $c->fecha_corte ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
