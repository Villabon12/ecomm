<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>dist/f.png">
    <title>Create LinkTree</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="description" content="List all your links on one website.">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&amp;display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/js/select.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>

<style>
    label {
        color: black;
    }

    p {
        color: black;
    }

    .card-title {
        color: black;
    }

    .bt {
        margin-top: 1rem;
    }


    body {
        background-color: #CCD2D5;
    }

    .slides {
        width: 100%;
        /* card * 4 + margin * 4 */
        display: flex;
        overflow-x: scroll;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        transition: all .5s ease;
    }

    .slides .slide {
        scroll-snap-align: start;
        flex-shrink: 0;
        width: 100px;
        height: 100px;
        margin-right: 15px;
        margin-left: 15px;
        border-radius: 10px;
        background: #eee;
        transition: transform 0.5s;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 50px;
        transform: translateX(0px);
    }
</style>
<?php if ($sett->colorBoton != null) { ?>
    <style>
        button {
            color:
                <?= $sett->colorBoton ?>
            ;
        }
    </style>
<?php } ?>

<body style="background-color:#CCD2D5;">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <h5 class="card-title">
                <nav class="navbar navbar-expand-lg ">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="<?= base_url() ?>MCMLink">
                            <img src="<?= base_url() ?>dist/f.png" alt="Logo" width="50" height="50">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarScroll">
                            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll"
                                style="--bs-scroll-height: 100px;">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="<?= base_url() ?>LinkTree/making/<?= $id_plan ?>">
                                        <h3 style="font-size: 30px;font-family: 'Righteous', cursive; ">Links</h3>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="<?= base_url() ?>LinkTree/apariencia/<?= $id_plan ?>">
                                        <h3 style="font-size: 30px;font-family: 'Righteous', cursive;">Apariencias</h3>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="<?= base_url() ?>LinkTree/apariencia/<?= $id_plan ?>">
                                        <h3 style="font-size: 30px;font-family: 'Righteous', cursive;">Analisis</h3>
                                    </a>
                                </li>
                            </ul>
                            <!-- <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>"
                                style="border-radius:25px;" alt="" width="50px" height="50px"> -->
                        </div>
                    </div>
                </nav>
            </h5>
        </div>
    </div>

    <div class="row">
        <div class="col" style="background-color:#E7EBED;  height:150vh;"> <br><br><br>
            <?php if ($this->session->flashdata("error")) { ?>
                <p>
                    <?php echo $this->session->flashdata("error") ?>
                </p>
            <?php } ?>
            <center>
                <header style="margin-top:3rem;margin-bottom:4rem;">
                    <strong>
                        <h1 style="font-family: 'Righteous', cursive; color:'black';">Personalizar la apariencia de tu
                            carta de
                            presentacion</h1>
                    </strong>
                </header>
                <div class="card align-self-center" style="width: 80%;margin-bottom:4rem; border-radius: 35px;">
                    <div class="card-body">
                        <h1 class="card-title" style="font-family: 'Righteous', cursive;">Utilizar algunas de nuestras
                            plantillas gratis o Pro</h1>
                    </div>
                </div>
                <!-- Button fotirris modal -->
                <button type="button" class="btn btn-primary btn-lg bt" style="width: 80%;border-radius: 35px;"
                    data-bs-toggle="modal" data-bs-target="#subirfoto">
                    Agregar una Foto
                </button>
                <button type="button" id="botonOption" class="btn btn-primary btn-lg bt"
                    style="width: 80%;border-radius: 35px;">Personaliza
                    el color de botones</button>
                <br>
                <div id="respuesta4"></div> <br><br>
            </center>
            <div class="card text-center" style="width: 100%;">
                <div class="card-body">
                    <center>
                        <h2>Escoje Tu Plantilla</h1>
                    </center>
                    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center" style="margin-top:2rem ;">
                        <?php foreach ($plantillas as $p) { ?>
                            <div class="col">
                                <div class="card" style="width: 18rem; margin-top:25px;">
                                    <a target="_blank" href="<?= base_url() ?>LinkTree/viewPlantilla/<?= $p->id ?>">
                                        <img src="<?= base_url() ?>assets/img/muestra/<?= $p->img ?>" class="card-img-top"
                                            style="height:250px;" alt="..."></a>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?= $p->nombre ?>
                                        </h5>
                                        <a type="button" class="btn btn-warning" target="_blank"
                                            href="<?= base_url() ?>LinkTree/apariencia/<?= $p->id ?>">
                                            Probar
                                        </a>
                                        <?php if ($p->type == 2) { ?>
                                            <a href="" type="button" class="btn "> <i class="bi bi-star-fill"></i> Pro</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button type="button" style="width:80%;text-align:center;" id="comprarPlan"
                        class="btn btn-warning btn-lg" onclick="ventanaSecundaria()" >Obtener</button>
                </div>
            </div>
        </div>
        <!-- Modal subir fotirris -->
        <div class="modal fade" id="subirfoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= base_url() ?>LinkTree/savePhoto/<?= $id_plan ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agrega una foto a tu carta de
                                presentacion
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label> Selecciona la foto:</label>
                            <input type="file" name="img" class='form-control' requiered>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col making" style="height:auto;">
            <div id="contenido">
                <?php $this->load->view($contenido); ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>

</body>
<script>
    function updateColorCode() {
        var colorPicker = document.getElementById("colorPicker");
        var colorCode = document.getElementById("colorCode");
        colorCode.innerHTML = colorPicker.value;
    }
</script>
<script>
    $(document).ready(function () {
        var base_url = "<?= base_url() ?>";
        var id = "<?= $id_plan ?>";
        $('#botonOption').on("click", function () {
            new_input = "";
            new_input += "<div class='card' style='width: 80%;margin-top:4rem; border-radius: 35px; justify-content-center align-self-center'>";
            new_input += '<div class="card-body">';
            new_input += '<form action="' + base_url + 'LinkTree/UpdateColor/' + id + '" method="post">';
            new_input += "<label>Personaliza el color de tus botones:</label> <br><br>";
            new_input += '<input type="color" value="" id="colorPicker" name="color"onchange="updateColorCode()">';
            new_input += '<span id="colorCode" style="color:black;">#000000</span> <br><br>';
            new_input += '<button type="submit" class="btn btn-primary " style="width:40%;">+</button>';
            new_input += '</form>';
            new_input += "</div>";
            new_input += "</div>";
            console.log('responde el boton');
            $('#respuesta').hide("fast"); //muestro mediante id
            $('#respuesta2').hide("fast"); //muestro mediante id
            $('#respuesta3').hide("fast"); //muestro mediante id
            $('#respuesta4').show("fast"); //muestro mediante id
            $("#respuesta4").html(new_input);
        });
        $('#comprarPlan').on("click", function () {
            $.ajax({

                url: base_url + "LinkTree/infoPlantilla",
                type: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function (resp) {
                    console.log(resp);
                }
            });
        })
    })
</script>
<script>
    function ventanaSecundaria() {
        window.open("https://www.myconnectmind.com/ingreso", "v entana1", "w idth=600,height=500,scrollbars=NO")
    } 
</script>

</html>