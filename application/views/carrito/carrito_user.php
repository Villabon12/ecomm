<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-lg 12">
                <div class="card">
                    <div class="card-body">
                        <?php if ($this->session->flashdata("error")) { ?>
                            <p><?php echo $this->session->flashdata("error") ?></p>
                        <?php } ?>
                        <h4> Bienvenido <?= $perfil->nombre ?></h4>
                        <h5>Tus Carrito:</h5>
                        <br>
                        <div class="table-responsive">
                            <table class="table" id="order-listing2">
                                <thead>
                                    <tr>
                                        <th scope="col">Fecha Compra</th>
                                        <th scope="col">codigo</th>
                                        <th scope="col">detallles</th>
                                        <th scope="col">Nombre Cliente</th>
                                        <th scope="col">Apellido Cliente</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">confirmar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <?php foreach ($carrito as $h) { ?>
                                        <tr>
                                            <td><?= $h->fecha ?></td>
                                            <td><?= $h->id ?></td>
                                            <td><a type="button"  target="_blank"  href="<?=base_url()?>proceso/detalles/<?= $h->id ?>"  class="btn btn-warning" ><i class="mdi mdi-magnify"></i> </a></td> 
                                            <td><?= $h->nombre ?></td>
                                            <td><?= $h->apellido1 ?></td>
                                            <td><?= number_format($h->total,0) ?></td>
                                            <?php if ($h->estado ==1 ) { ?>
                                                <td> <button type="button" class="btn btn-success">Compra Exitosa</button></td>
                                            <?php } else { ?>
                                                <td><button type="button" class="btn btn-danger">pendiente </button></td>
                                            <?php } ?>
                                            <?php if ($h->estado == 0) { ?>
                                                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#compra<?= $h->id ?>">confirmar</button></td>
                                            <?php } else { ?>
                                                <td><i class="mdi mdi-check-circle " style="color: #20EADA; font-size:25px;"></i></td>
                                            <?php } ?>
                                            <!-- Modal -->
                                            <div class="modal fade" id="compra<?= $h->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmacion </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post" action="<?= base_url() ?>Proceso/Aceptarcomprafisica/<?= $h->id ?>">
                                                            <div class="modal-body">
                                                                ¿Esta seguro que ya tiene su producto?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary">Aceptar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    <?php } ?> -->
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div><br>
     
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->