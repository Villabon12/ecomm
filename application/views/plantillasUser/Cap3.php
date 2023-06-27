<!-- partial:index.partial.html -->
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet" />
<script src="https://kit.fontawesome.com/bb6d886fd4.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?= base_url() ?>reTemplate/Cap3/style.css" />

<?php if ($sett->colorBoton != null) { ?>
    <style>
        .boton:hover {
            background-color:
                <?= $sett->colorBoton ?>
            ;
            color: #fff;
        }
    </style>
<?php } else { ?>
    <style>
        .boton:hover {
            background-color: #3ce39c;
            color: #fff;
        }
    </style>

<?php } ?>
<section style="height:150vh;">
    <br><br><br>
    <!-- Logo -->
    <?php if ($sett->img_perfil == null) { ?>
        <img class="logo" src="https://i.pinimg.com/originals/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" />
    <?php } else { ?>
        <img class="logo" src=" <?= base_url() ?>reTemplate/imagenes/<?= $sett->img_perfil ?>" alt="Logo" />
    <?php } ?>
    <h1 class="plantilla">
        <?= $perfil->nombre . " " . $perfil->apellido1 ?>
    </h1>

    <!-- Profesion -->
    <?php if ($sett->profesion == null) { ?>
        <h2 class="plantilla">Tu Profesiòn</h2>
    <?php } else { ?>
        <h2 class="plantilla">
            <?= $sett->profesion ?>
        </h2>
    <?php } ?>

    <?php if ($sett->descripcion == null) { ?>
        <a class="featured" href="#"><i class="fas fa-award">&nbsp;</i> Descripcion<strong></strong></a>
    <?php } else { ?>
        <a class="featured" href="#"><i class="fas fa-award">&nbsp;</i>
            <?= $sett->descripcion ?><strong></strong>
        </a>
    <?php } ?>
    <!-- ALL LINKS -->
    <h2 class="plantilla">Contactos</h2>

    <?php foreach ($links as $l) { ?>
        <!-- Menu Item -->
        <a href="<?= $l->enlace ?>" class="boton" target="_blank"><?= $l->nombreRed ?></a>
    <?php } ?>
    <!-- Social Account -->
    <h2 class="plantilla">Sigueme....</h2>

    <center>
        <h4> Copyright Text</h34 </center>

</section>