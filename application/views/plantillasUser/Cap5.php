<head>
    <meta charset="UTF-8">
    <title>Plantilla Juvenil</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>dist/f.png">

    <link rel="stylesheet" href="<?= base_url() ?>reTemplate/Cap5/style.css">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
    <title>Page Links</title>
</head>
<?php if ($sett->colorBoton != null) { ?>
    <style>
        .grid-item:hover {
            background-color:
                <?= $sett->colorBoton ?>
            ;
            transform: scale(1.1);
        }
    </style>
<?php } else { ?>
<?php } ?>
<section style="height:150vh;">
    <header style="margin-top:3rem;">
        <div id="perfil">
            <a target="_blank" href="#">
                <?php if ($sett->img_perfil == null) { ?>
                    <img src="https://i.pinimg.com/originals/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg"
                        alt="Perfil image" id="perfil-image">
                <?php } else { ?>
                    <img src=" <?= base_url() ?>reTemplate/imagenes/<?= $sett->img_perfil ?>" alt="Logo" />
                <?php } ?>
                <p id="name">
                    <?= $perfil->nombre . " " . $perfil->apellido1 ?>
                </p>
                <span>@
                    <?= $perfil->nombre . " " . $perfil->apellido1 ?>
                </span>
            </a>
        </div>
    </header>
    <section id="grid-container">
        <?php foreach ($links as $l) { ?>
            <a onmouseenter="enter(`i#git`)" style="color:white;" onmouseout="out(`i#git`)" href="#" class="grid-item boton">
                <div style="font-size:30px;">
                    <?= $l->icono ?>
                </div>
                <span>
                    <?= $l->nombreRed ?>
                </span>
            </a>
        <?php } ?>
    </section>
    <footer>
        <p id="copy">
            <i id="tree" class="fas fa-tree"></i> MTree &copy;
        </p>
    </footer>
    <script src="js/script.js"></script>
</section>

</html>
<!-- partial -->

</body>

</html>