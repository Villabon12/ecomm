<div class="main-panel">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="content-wrapper">

        <div class="row">
            <!-- Column -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h2 class="m-b-0"><?= $perfil->nombre ?> <?= $perfil->apellido1 ?></h2>
                        <p class=" m-b-0"><?= $perfil->correo ?></p>
                        <p class="m-b-0">Numero Referir: <?= $perfil->id ?></p>
                        <h4>tu equipo:</h4>

                        <div class="table-responsive">

                            <table class="table" id="order-listing">
                                <thead>
                                    <tr>
                                        <th scope="col"># referir</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Celular</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($binario as $B) { ?>

                                        <tr>
                                            <td><?php echo $B->id ?></td>
                                            <td><?php echo $B->nombre ?></td>
                                            <td><?php echo $B->apellido1 ?></td>
                                            <td><?php echo $B->celular ?></td>
                                        </tr>

                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Column -->

    <!-- <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card cc-widget">
                    <div class="card-body">
                        <div class="d-flex no-block flex-row">
                            <img src="https://i.pinimg.com/564x/62/d8/c9/62d8c979a184a03d8bafac31aefedccf.jpg" width="900px" alt="arbol_binario">

                        </div>
                    </div>
                    <div id="spark1" class="sparkchart"></div>
                </div>
            </div>
        </div>
    </div> -->




    <!-- <div class="col-md-3 marg ">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <div class="">
                                <header>Convertidor de divisas</header>

                                <script src="https://www.dolar-colombia.com/widget.js?t=3&c=1"></script>
                            </div>
                        </center>

                    </div>
                </div>
            </div> -->
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card cc-widget">
                    <div class="card-body">
                        <div class="d-flex no-block flex-row">
                            <h3>proximo ingreso ubicarlo en : <?= $registro->ubica ?> </h3>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modificarregistro<?= $perfil->id ?>">
                                cambiar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modificarregistro<?= $perfil->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Esta seguro de cambiar de lado ?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form action="<?= base_url() ?>comercio/modificarUbica/<?= $perfil->id ?> " method="post">
                                            <div class="modal-body">
                                                <p>cambiar a <?php if ($registro->ubica == "izquierda") { ?>Derecha<?php } else { ?>izquierda <?php } ?></p>
                                                <input type="hidden" value="<?= $registro->ubica ?>" name="ubica" readonly>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Aceptar </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 style="color:white;"> Link para incribir todo.
                            <a href="<?= base_url() ?>Inicio_page/registro/<?= $perfil->id ?>"><?= base_url() ?>Inicio_page/registro/<?= $perfil->id ?></a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
                                    
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- End Page wrapper  -->