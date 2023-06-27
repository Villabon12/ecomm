<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">

            <div class="col-lg 12 col-md-6">

                <div class="card cc-widget">
                    <div class="card-body">
                        <h4><?= $perfil->nombre ?> <?= $perfil->apellido1 ?></h4>
                        <h4><?= $perfil->nombre_negocio ?></h4>
                        <h5>id_referido: <?= $perfil->id ?></h5>
                        <h5>Datos detallado de comercio</h5>
                        <br>
                        <table class="table" id="order-listing2">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre Comercio</th>
                                    <th scope="col">Nombre quien trajo</th>
                                    <th scope="col">Apellido quien trajo</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col"># cupones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tb as $t) { ?>
                                    <tr>
                                        <td><?= $t->nombre_negocio ?></td>
                                        <td><?= $t->nombretraer ?></td>
                                        <td><?= $t->apellidotraer ?></td>
                                        <td><?= $t->celulartraer ?></td>
                                        <td><?= $t->cupon ?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>