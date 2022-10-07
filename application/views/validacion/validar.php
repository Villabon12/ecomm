<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">

        <div class="col-lg 12 col-md-6">

            <div class="card cc-widget">
                <div class="card-body">
                    <h4><?= $perfil->nombre ?> <?= $perfil->apellido1 ?></h4>
                    <h4><?= $perfil->nombre_negocio ?></h4>
                    <h5>id_referido: <?= $perfil->id ?></h5>
                    <h5>Datos negocios Asociados</h5>
                    <br>
                    <table class="table" id="order-listing">
                        <thead>
                            <tr>
                                <th scope="col">Nombre cliente</th>
                                <th scope="col">Apellido cliente</th>
                                <th scope="col">Cedula</th>
                                <th scope="col">cedula frente</th>
                                <th scope="col">cedula trasera</th>
                                <th scope="col">Selfie user</th>
                                <th scope="col">estado</th>
                                <th scope="col">Aprobar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($validacion as $v) { ?>
                                <tr>
                                    <td><?= $v->nombre ?></td>
                                    <td><?= $v->apellido1 ?></td>
                                    <td><?= $v->cedula ?></td>
                                    <td><a href="<?= base_url() ?>asset/images/confirmacion/<?= $v->img_cedula_front?>">imagen cedula frontal</a></td>
                                    <td><a href="<?= base_url() ?>asset/images/confirmacion/<?= $v->img_cedula_back?>">imagen cedula trasera</a></td>
                                    <td><a href="<?= base_url() ?>asset/images/confirmacion/<?= $v->img_selfie ?>"> imagen selfie</a></td>
                                    <td><?= $v->verificar_user ?></td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#aprobarvalidacion<?= $v->id ?>">
                                            Aprobar
                                        </button>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="aprobarvalidacion<?= $v->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">validacion de <?= $v->nombre ?> </h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?=base_url()?>comercio/habilitarUser/<?= $v->id ?>" method="post">
                                                    <div class="modal-body">
                                                        <p>Estas seguro que quieres habilitar a <?= $v->nombre ?> </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerra</button>
                                                        <button type="submit" class="btn btn-warning">Habilitar</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                              
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>