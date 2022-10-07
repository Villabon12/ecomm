<div class="main-panel">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="content-wrapper">
        <br>
        <h2> Ecommvale disponibles : </h2>
        <br>
        <!-- ciclo cupones -->

        <div class="row">
            <!-- Column -->
            <?php foreach ($cupones as $C) { ?>
                <div class="col-lg-3 col-md-6">
                    <div class="card cc-widget">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">

                                <!-- variables conversion -->
                                <?php $total = (($C->precio * $C->descuento) / 100) ?>
                                <?php $total_total = $C->precio - $total ?>

                                <? $devolver = ((($C->precio * $C->descuento) / 100) * $C->cashback / 100) ?>

                                <img src="<?= base_url() ?>assets/img/<?= $C->img  ?>" alt="imagen" width="250px" height="250px">
                                <h3 class=" m-b-0"><?php echo $C->nombre_negocio ?></h3>
                                <h4 class=" m-b-0"><?php echo $C->nombre ?></h4>
                                <p class=" m-b-0">precio: <?= number_format($C->precio, 0) ?></p>
                                <p class=" m-b-0">cashback: $ <?= $devolver ?></p>
                                <p class=" m-b-0">Finaliza el: <?php echo $C->fecha_corte ?></p>
                                <?php if ($C->stok > 300) { ?>
                                    <p class=" m-b-0">stock:ilimitado</p>
                                <?php } else { ?>
                                    <p class=" m-b-0">stock: <?= $C->stok ?></p>
                                <?php } ?>
                                <?php if ($C->valor_domicilio > 0) { ?>
                                    <p class=" m-b-0">Domicilio: $<?= number_format($C->valor_domicilio, 0) ?></p>
                                    <p class=" m-b-0">tiempo de entrega:<?= $C->hora ?> horas - <?= $C->minutos ?> min </p>
                                <?php } else { ?>
                                    <p class=" m-b-0">Domicilio: No Domicilio</p>
                                <?php } ?>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#compra_cupon<?php echo $C->id ?>">
                                    comprar
                                </button>
                                <div class="modal fade" id="compra_cupon<?php echo $C->id ?>" tabindex="-1"  style="z-index: 1000;" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title">Comprar <?php echo $C->nombre ?> </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="<?= base_url() ?>comercio/update_cupones" method="POST" >
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p class=" m-b-0">Finaliza el: <?php echo $C->fecha_corte ?></p>
                                                            <?php if ($C->stok > 500) { ?>
                                                                <p class=" m-b-0">Stok: ilimitado</p>
                                                            <?php } else { ?>
                                                                <p class=" m-b-0">Stok: <?php echo $C->stok ?></p>
                                                            <?php } ?>
                                                            <p class=" m-b-0">precio: <?= number_format($C->precio, 0) ?></p>

                                                        </div>
                                                        <div class="col-6">

                                                        </div>

                                                    </div>
                                                    <input type="hidden" name="id" value="<?= $C->id ?>">
                                                    <div class="input-group input-group-sm mb-2">

                                                        <input type="hidden" name="id_comercio" placeholder="comercio" value="<?= $C->id_usuario ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                        <input type="hidden" name="id_usuario" placeholder="id_usuario" value="<?= $perfil->id ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                        <input type="hidden" name="precio" placeholder="precio" value="<?= $C->precio ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                        <input type="hidden" name="descuento" placeholder="descuento" value="<?= $C->descuento ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                        <input type="hidden" name="id_producto" placeholder="id_producto" value="<?= $C->id_producto ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                        <input type="hidden" name="id_papa_pago" placeholder="id_papa_pago" value="<?= $perfil->id_papa_pago ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                        <input type="hidden" name="stock" placeholder="id_papa_pago" value="<? $C->stok ?>" class="col-lg-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-warning">Comprar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- Modal -->





    <!-- End Container fluid  -->
    <!-- ============================================================== -->

</div>



<!-- modal de compra -->


<div id="myModal" class="modal bagcl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered borderre">

        <div class="modal-content">
            <div class="modal-header cverd">
                <h4 class="modal-title blan" id="myModalLabel">DEPOSITAR</h4>
                <button type="button" class="close blan" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body margcent ">

                <!-- si es comprar pesos colombianos esconder el p2p -->
                <a href="#"><button type="button" class="btn waves-effect waves-light btn-outline-success btncent ">Empresarial</button></a>
                <a href="#"><button type="button" class="btn waves-effect waves-light btn-outline-info  btncent">P2P</button></a>
            </div>



        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- modal de Venta -->

<div id="mVender" class="modal bagcl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered borderre">

        <div class="modal-content">
            <div class="modal-header bggr">
                <h4 class="modal-title amar" id="myModalLabel">VENDER</h4>
                <button type="button" class="close blan" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body margcent ">

                <!-- PONER VARIABLE DEPENDIENDO SI LE DA COMPRAR O VENDER -->
                <a href="vender.php"><button type="button" class="btn waves-effect waves-light btn-outline-success btncent ">Empresarial</button></a>
                <a href="p2p.php"><button type="button" class="btn waves-effect waves-light btn-outline-info  btncent">P2P</button></a>
            </div>



        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->