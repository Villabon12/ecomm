<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Plantilla Juvenil</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>dist/f.png">

    <link rel="stylesheet" href="<?=base_url()?>reTemplate/Cap5/style.css">

</head>

<body style="background-color: #0f1442;">
    <!-- partial:index.partial.html -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
    <title>Page Links</title>
    </head>

    <body style="background-color: #0f1442;">
        <header>
            <div id="perfil">
                <a target="_blank" href="#">
                    <img src="https://i.pinimg.com/originals/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg"
                        alt="Perfil image" id="perfil-image">
                    <p id="name">
                        Usuario
                    </p>
                    <span>@Usuario</span>
                </a>
            </div>
        </header>
        <section id="grid-container">
            <a onmouseenter="enter(`i#git`)" onmouseout="out(`i#git`)" 
                href="#" class="grid-item">
                <div><i id="git" class="fab fa-github"></i></div>
                <span>gitHub</span>
            </a>
            <a onmouseenter="enter()" onmouseout="out()" 
                href="#" class="grid-item">
                <div><i class="fab fa-linkedin"></i></div>
                <span>linked-In</span>
            </a>
            <a onmouseenter="enter()" onmouseout="out()"  href="#"
                class="grid-item">
                <div><i class="fab fa-codepen"></i></div>
                <span>CodePen</span>
            </a>
            <a onmouseenter="enter()" onmouseout="out()" 
                href="#" class="grid-item">
                <div><i class="fas fa-rocket"></i></div>
                <span>Rocketseat</span>
            </a>
            <a onmouseenter="enter()" onmouseout="out()"  href="#"
                class="grid-item">
                <div><i class="fab fa-instagram"></i></div>
                <span>instagram</span>
            </a>
            <a onmouseenter="enter()" onmouseout="out()" 
                href="https://br.pinterest.com/eltonsantosalmeida01/_saved/" class="grid-item">
                <div><i class="fab fa-pinterest"></i></div>
                <span>Pinterest</span>
            </a>
        </section>
        <footer>
            <p id="copy">
                <i id="tree" class="fas fa-tree"></i> MTree &copy;
            </p>
        </footer>
        <script src="js/script.js"></script>
    </body>

</html>
<!-- partial -->

</body>

</html>