<!doctype html>
<html>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<head>
    <meta charset="UTF-8">
    <title>estrellas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,1000&display=swap" rel="stylesheet">
    <style>
        input[type="radio"] {
            display: none;
            size: 25px;
            /*position: absolute;top: -1000em;*/
        }

        label {
            color: grey;
            font-size: 45px;
        }

        .clasificacion {
            direction: rtl;
            unicode-bidi: bidi-override;
        }

        label:hover,
        label:hover~label {
            color: orange;
        }

        input[type="radio"]:checked~label {
            color: orange;
        }
    </style>
</head>

<body onload="showModal()">
    <div class="modal" tabindex="-1" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content"
                style="background-image:url('https://fondosmil.com/fondo/31320.jpg');background-size: cover;">
                <div class="modal-body">
                    <form action="<?= base_url() ?>Inicio_page/encuesta" method="post">
                        <div class="row">
                            <div class="col-auto me-auto"> </div>
                            <div class="col-auto"> <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close" onclick="closeModal()"></button><br><br>
                            </div>
                        </div>
                        <center>
                            <h2 style="font-family: 'Nunito', sans-serif;color:white;-webkit-text-stroke: 1.5px black;">
                                Califica la nueva interfaz de <br> E´comm</h2>
                            <p class="clasificacion">
                                <input id="radio1" type="radio" name="estrellas" value="5"><label
                                    for="radio1">&#9733;</label><input id="radio2" type="radio" name="estrellas"
                                    value="4"><label for="radio2">&#9733;</label><input id="radio3" type="radio"
                                    name="estrellas" value="3"><label for="radio3">&#9733;</label><input id="radio4"
                                    type="radio" name="estrellas" value="2"><label for="radio4">&#9733;</label><input
                                    id="radio5" type="radio" name="estrellas" value="1"><label
                                    for="radio5">&#9733;</label>
                            </p>
                            <button type="submit" class="btn btn-warning">Enviar</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal publicidad app -->
    <div class="modal" tabindex="-1" style="margin-top:10rem;">
        <div class="modal-dialog">
            <div class="modal-content"
                style="background-image:url('https://fondosmil.com/fondo/20893.jpg');width:100%;background-size: cover;">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-auto me-auto"> </div>
                        <div class="col-auto"> <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close" onclick="closeModal()"></button><br><br>
                        </div>
                    </div>
                    <center>
                        <h3 style="font-family: 'Nunito', sans-serif;">¡Agiliza tus compras, lleva <br> <b>E`comm</b> a
                            todos
                            lados!</h3> <br>
                        <h2 style="font-family: 'Nunito', sans-serif;">¡Decàrgala Ahora!</h2><br><br>
                        <p style="color:red;"> Disponible solo para Android </p>
                        <a href="<?= base_url() ?>assets\img\documentacion\ecomm.apk" type="button"
                            class="btn btn-success" download target="_blank">Descargar App</a>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" style="margin-top:10rem;">
        <div class="modal-dialog">
            <div class="modal-content"
                style="background-image:url('https://fondosmil.com/fondo/20893.jpg');width:100%;background-size: cover;">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-auto me-auto"> </div>
                        <div class="col-auto"> <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close" onclick="closeModal()"></button><br><br>
                        </div>
                    </div>
                    <h2 style="font-family: 'Nunito', sans-serif;color:white;-webkit-text-stroke: 1.5px black;">
                        Califica la nueva interfaz de <br> E´comm</h2>
                    <p class="clasificacion">
                        <input id="radio1" type="radio" name="estrellas" value="5"><label
                            for="radio1">&#9733;</label><input id="radio2" type="radio" name="estrellas"
                            value="4"><label for="radio2">&#9733;</label><input id="radio3" type="radio"
                            name="estrellas" value="3"><label for="radio3">&#9733;</label><input id="radio4"
                            type="radio" name="estrellas" value="2"><label for="radio4">&#9733;</label><input
                            id="radio5" type="radio" name="estrellas" value="1"><label for="radio5">&#9733;</label>
                    </p>
                    <button type="submit" class="btn btn-warning">Enviar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script>
        function showModal() {
            document.getElementById("myModal").style.display = "block";
        }
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>
</body>

</html>