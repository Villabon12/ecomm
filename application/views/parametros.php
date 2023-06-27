<div class="tablas" style="margin:20px;">
    <div class="col-lg 12">
        <div class="card">
            <div class="card-body">
                <h4> Bienvenido
                    <?= $perfil->nombre ?>
                    <?= $perfil->apellido1 ?>
                </h4>
                <h4>
                    <?= $perfil->nombre_negocio ?>
                </h4>
                <h5>Los parametros que operan en Comercio son:</h5>
                <br>
                <div class="table-responsive">
                    <table class="table" id="order-listing">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Valor</th>
                                <th scope="col">descripcion</th>
                                <th scope="col">modificar</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach ($parametros as $p) { ?>
                                <tr>
                                    <td>
                                        <?= $p->id ?>
                                    </td>
                                    <td>
                                        <?= number_format($p->cashback, 0) ?>
                                    </td>
                                    <td><b>
                                            <?= $p->descripcion ?>
                                        </b></td>
                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modificarpara<?= $p->id ?>">
                                            Modificar</button>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modificarpara<?= $p->id ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="width: 134%;">
                                                <div class="modal-header" style="background-color: #444446;">
                                                    <h5 class="modal-title" style="color: white;" id="exampleModalLabel">
                                                        Modificar el parametro
                                                        <?= $p->id ?>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="<?= base_url() ?>comercio/Modificar_parametros/<?= $p->id ?>"
                                                    method="POST">
                                                    <div class="modal-body" style="background-color:#7E7E87;">
                                                        <h4 style="color: black;">hola
                                                            <?= $perfil->nombre_negocio ?> digita el cambio de valor
                                                        </h4>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="input-group mb-2">
                                                                    <input type="num" value="<?= $p->cashback ?>"
                                                                        name="cashback">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <center><img
                                                                        src="https://www.tiindo.com/wp-content/uploads/2022/05/logo-cryptoce.png"
                                                                        alt=""> </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer " style="background-color: #444446;">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Modificar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>