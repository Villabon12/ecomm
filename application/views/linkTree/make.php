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
                                        href="<?= base_url() ?>LinkTree/apariencia/<?= $id_plan ?>">
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
                        <h1 style="font-family: 'Righteous', cursive;">Personalizar Tu carta de presentación</h1>
                    </strong>
                </header>

                <div class="card align-self-center" style="width: 80%;margin-bottom:4rem; border-radius: 35px;">
                    <div class="card-body">
                        <h1 class="card-title">Organiza tu carta de presentación</h1>
                        <p class="card-text">En estos momentos Tienes
                            <?= $contar->contar ?> Links.
                        </p>
                    </div>
                </div>
                <button type="button" class="btn btn-primary  btn-lg bt" data-bs-toggle="modal" data-bs-target="#links"
                    style="width: 80%;border-radius: 35px;">Agrega un Link
                </button>
                <button type="button" id="newDescripcion" class="btn btn-primary btn-lg bt"
                    style="width: 80%;border-radius: 35px;">Agrega
                    Descripciòn</button>
                <div id="respuesta2"></div>

                <button type="button" id="newProfesion" class="btn btn-primary btn-lg bt"
                    style="width: 80%;border-radius: 35px;">Agrega
                    Profesión</button>
                <br>
                <div id="respuesta3"></div>
            </center>
        </div>
        <!-- Modal Link -->
        <div class="modal fade" id="links" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?= base_url() ?>LinkTree/saveData/<?= $id_plan ?>" method="post">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agrega un link</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <div id="carrusel" class="slider">
                                    <label for="">Escoje la red Social:</label>
                                    <div id="carrusel-slides" class="slides">
                                        <?php foreach ($get as $g) { ?>
                                            <div class="slide">
                                                <label for="myCheckbox<?= $g->id_boton ?>" class="checkbox-container">
                                                    <img class="option"
                                                        src="<?= base_url() ?>assets/img/logos/<?= $g->logo ?>" width="80px"
                                                        height="80px" style="border-radius:25px;" alt="logos" srcset="">
                                                    <input type="checkbox" id="myCheckbox<?= $g->id_boton ?>"
                                                        style="display:none;" value="<?= $g->id_boton ?>" name="red">
                                                </label>
                                            </div>
                                            <script>
                                                $(document).ready(function () {
                                                    var base_url = "<?= base_url() ?>";
                                                    $('#myCheckbox<?= $g->id_boton ?>').on("change", function () {
                                                        var id_link = $(this).val();
                                                        var id = $(this).val();
                                                        if (id_link == 15) {
                                                            html = '<label>Escriba nombre de Link</label>'
                                                            html += '<input type="text" class="form-control" name="nombreLink" value="" >';
                                                            console.log('es otro');
                                                            console.log(id_link);
                                                            $('#resp').html(html);
                                                        } else {
                                                            $.ajax({
                                                                url: base_url + "LinkTree/infoLink",
                                                                type: "POST",
                                                                data: {
                                                                    id: id
                                                                },
                                                                dataType: "json",
                                                                success: function (data) {
                                                                    html = '<label> Escogiste el para agregar un link de ' + data.nombre_boton + '</label> <br>'
                                                                    $('#resp').html(html);
                                                                    console.log(data.nombre_boton);
                                                                }
                                                            });
                                                        }
                                                    })
                                                })
                                            </script>
                                        <?php } ?>
                                    </div>
                                    <br><br>
                                    <div class="col" id="resp"></div> <br>
                                    <label for="">Enlace</label>
                                    <input type="text" name="enlace" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Agregar</button>
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
        $('#newDescripcion').on("click", function () {

            new_input = "";
            new_input += "<div class='card' style='width: 80%;margin-top:4rem;border-radius: 35px; justify-content-center align-self-center'>";
            new_input += '<div class="card-body">';
            new_input += '<form action="' + base_url + 'LinkTree/Updatedata/' + id + '" method="post">';
            new_input += "<Label>Agrega Tu descripciòn</Label><br><br>";
            new_input += "<input class='form-control' name='descripcion' type='text' placeholder='Soy estudiante de Arte de la Universidad...'style='width:80%;' requiered > <br>";
            new_input += '<button type="submit" class="btn btn-primary " style="width:40%;">+</button>';
            new_input += '</form>';
            new_input += "</div>";
            new_input += "</div>";
            console.log('responde el boton');
            $('#respuesta4').hide("fast"); //muestro mediante id
            $('#respuesta').hide("fast"); //muestro mediante id
            $('#respuesta3').hide("fast"); //muestro mediante id
            $('#respuesta2').show("fast"); //muestro mediante id
            $("#respuesta2").html(new_input);
        });
        $('#newProfesion').on("click", function () {
            new_input = "";
            new_input += "<div class='card' style='width: 80%;margin-top:4rem; border-radius: 35px; justify-content-center align-self-center'>";
            new_input += '<div class="card-body">';
            new_input += '<form action="' + base_url + 'LinkTree/Updatedata/' + id + '" method="post">';
            new_input += "<Label>Agrega Tu Profesion</Label><br><br>";
            new_input += "<input class='form-control' name='profesion' type='text' placeholder='Ingeniero de Software'style='width:80%;' requiered > <br>";
            new_input += '<button type="submit" class="btn btn-primary " style="width:40%;">+</button>';
            new_input += '</form>';
            new_input += "</div>";
            new_input += "</div> <br>";
            console.log('responde el boton');
            $('#respuesta4').hide("fast"); //muestro mediante id
            $('#respuesta2').hide("fast"); //muestro mediante id
            $('#respuesta').hide("fast"); //muestro mediante id
            $('#respuesta3').show("fast"); //muestro mediante id
            $("#respuesta3").html(new_input);
        });
        $('#otrico').on("click", function () {
            console.log('holi');

        });
    })
</script>

<script>
    const carSld = document.getElementById("carrusel-slides");
    const carSlds = document.querySelector("#carrusel-slides .slide");



</script>

</html>