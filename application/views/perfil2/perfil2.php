<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Carta de presentación</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>




<section style="background-color: black; width: auto; height:150vh;">
    <br><br><br><br><br><br><br><br><br><br><br><br>

    <div class="card  text-center" style="margin-top:2rem;">
        <div class="card-body">

            <figure>
                <?php if ($sett->img_perfil == null) { ?>
                    <img src=" <?= base_url() ?>reTemplate/Cap2/img/logo.png" alt="Responsive image"
                        sizes="(max-width: 767px) 80vw, (max-width: 933px) 90vw, 840px" class=""
                        style="max-width:100px;border-radius: 100px; width: 100%;" id="user-img" />
                <?php } else { ?>

                    <img src=" <?= base_url() ?>reTemplate/imagenes/<?= $sett->img_perfil ?>" alt="Responsive image"
                        sizes="(max-width: 767px) 80vw, (max-width: 933px) 90vw, 840px" class=""
                        style="max-width:100px;border-radius: 100px; width: 100%;" id="user-img">
                <?php } ?>

            </figure>

            <h3 style="text-align:center; font-family: serif; color:#000000;"><strong>
                    <?= $perfil->nombre . " " . $perfil->apellido1 ?>
                </strong></h3>

            <h5 style="text-align:center; color:#000000; font-family: sans-serif;">

                <?php if ($sett->profesion == null) { ?>
                    Tu Profesión
                <?php } else { ?>
                    <?= $sett->profesion ?>
                <?php } ?>
            </h5>
            <br>
            <?php foreach ($links as $b) { ?>
                <a href="<?= $b->enlace ?>"><?= $b->icono ?>&nbsp;&nbsp;</a>
            <?php } ?>
            <div>
                <br>
                <?php foreach ($links as $b) { ?>

                    <a target="_blank" style="margin-top:25px;" href="<?= $b->enlace ?>"><button
                            class="btn btn-warning btn-lg " type="button" style="width:70%"><?= $b->icono ?>&nbsp;<?= $b->nombre_boton ?></button></a>
                    <br><br>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</section>



</html>