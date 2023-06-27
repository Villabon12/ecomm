<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
<!-- banner section start -->
<!-- banner bg main end -->
<!-- fashion section start -->
<!-- <div class="container"> -->
<div class="col-lg-12">
    <div class="card" style="margin-top: 2rem;margin-bottom: 20px;">
        <div class="card-body">
            <center>
                <h1 class="fashion_taital" style="margin-top:20px;">Tu Equipo</h1>
            </center>
            <h2 class="m-b-0">
                <?= $perfil->nombre ?>
                <?= $perfil->apellido1 ?>
            </h2>
            <p class=" m-b-0">
                <?= $perfil->correo ?>
            </p>
            <p class="m-b-0">Numero Referir:
                <?= $perfil->id ?>
            </p>
            <h4>tu equipo:</h4>

            <div class="table-responsive">

                <table class="table" id="order-listing">
                    <thead>
                        <tr>
                            <th scope="col"># referir</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Posición</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($binario as $B) { ?>

                            <tr>
                                <td>
                                    <?php echo $B->id ?>
                                </td>
                                <td>
                                    <?php echo $B->nombre ?>
                                </td>
                                <td>
                                    <?php echo $B->apellido1 ?>
                                </td>
                                <td>
                                    <?php echo $B->celular ?>
                                </td>
                                <td>
                                    <?php echo $B->posicion ?>
                                </td>
                            </tr>

                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <center>
                <a type="button " class="btn btn-primary btn-lg" href="<?= base_url() ?>comercio/graficoBin">
                    <i class="menu-icon mdi mdi-file-tree"></i>
                    <span class="menu-title">Ver Arbol de Nivel</span>
                    <i class="menu-arrow"></i>
                </a>
            </center>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6" style="margin-top: 2rem;margin-bottom: 2rem;">
    <div class="card cc-widget">
        <div class="card-body">
            <div class="d-flex no-block flex-row">
                <h3>próximo ingreso ubicarlo en :
                    <?= $registro->ubica ?>
                </h3>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modificarregistro<?= $perfil->id ?>">
                    cambiar
                </button>
            </div>
            <h4> Link para inscribir Usuarios. </h4>
            <a href="<?= base_url() ?>Inicio_page/registro/<?= $perfil->id ?>"><?= base_url() ?>Inicio_page/registro/<?=
                      $perfil->id ?></a>
            <?php if ($perfil->verificar_user == 'habilitado') { ?>
                <h4> Link para inscribir Comercios.</h4>
                <a href="<?= base_url() ?>Inicio_page/comercio/<?= $perfil->id ?>"><?= base_url() ?>Inicio_page/comercio/<?=
                          $perfil->id ?></a>
            <?php } ?>
        </div>
    </div>
</div>
<!-- </div> -->
<!-- Modal -->
<div class="modal fade" id="modificarregistro<?= $perfil->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Está seguro de cambiar de
                    lado ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= base_url() ?>comercio/modificarUbica/<?= $perfil->id ?> " method="post">
                <div class="modal-body">
                    <p>cambiar a
                        <?php if ($registro->ubica == "izquierda") { ?>Derecha
                        <?php } else { ?>izquierda
                        <?php } ?>
                    </p>
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
</body>

</html>