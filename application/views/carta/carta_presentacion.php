<body>

    <br>

    <div class="container">

        <?php if ($this->session->flashdata("error")) { ?>

            <p>

                <?php echo $this->session->flashdata("error") ?>

            </p>

        <?php } ?>

        <div class="container">

            <div class="card border-0">

                <div class="card-body border-0">

                    <div class="card">

                        <table class="table table-bordered">

                            <thead>

                                <tr>
                                    <th scope="col">Red social</th>
                                    <th scope="col">Enlace</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach ($botones as $b) { ?>
                                    <tr>
                                        <td>
                                            <?= $b->nombre_boton ?>
                                        </td>
                                        <td>
                                            <?= $b->enlace ?>
                                        </td>
                                        <td>
                                            <center>
                                                <button type="button" class="btn btn-primary" style="heigth:10%;"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal<?= $b->id ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                </button>
                                                <!-- Button Delete Modal -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal<?= $b->id ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                </button>
                                            </center>
                                        </td>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $b->id ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form
                                                        action="<?= base_url() ?>Carta_presentacion/updateEnlace/<?= $b->id ?>"
                                                        method="post">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar red
                                                                social</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <input class="form-control" type="text" name="nombre_boton"
                                                                id="botones" value="<?= $b->nombre_boton ?>" readonly>
                                                            <input class="form-control" type="text" name="enlace"
                                                                id="enlace" value="<?= $b->enlace ?>">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Editar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal<?= $b->id ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar red:
                                                            <?= $b->nombre_boton ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Esta seguro que quires eliminar la red social
                                                        <?= $b->nombre_boton ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <a href="<?= base_url() ?>Carta_presentacion/deleteEnlace/<?= $b->id ?>"
                                                            class="btn btn-danger">Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                    <br><br>

                    <button type='button' class='btn btn-success  btn-adiciona' style='margin-left: 15px' id='add-btn'
                        value='0'><span class='mdi mdi-plus'></span></button>

                    <br><br>

                    <div class="container">

                        <form method="post" action="<?= base_url() ?>Carta_presentacion/recibirDatos">

                            <div id="input_fields">



                            </div>

                            <button type="submit" class="btn btn-success">Guardar</button>

                        </form>

                        <br><br>

                    </div>



                    <script>

                        $(document).ready(function () {

                            var base_url = "<?= base_url() ?>";

                            $("#add-btn").on("click", function () {

                                $.ajax({

                                    url: base_url + "Carta_presentacion/obtener_botones",

                                    type: "POST",

                                    dataType: "json",

                                    success: function (data) {

                                        new_input = "<label>";

                                        new_input += "Red social";

                                        new_input += "</label>";

                                        new_input += "<select class='form-select' name='red' aria-label='Default select example' style='width:20%;'>";

                                        $.each(data, function (key, value) {

                                            new_input += "<option value='" + value.id_boton + "'>" + value.nombre_boton + "</option>";

                                        });

                                        new_input += "</select>";

                                        new_input += "<input class='form-control'name='enlace' type='text' placeholder='Enlace'style='width:40%;'>";

                                        new_input += "</br>";

                                        $("#input_fields").append(new_input);

                                    }

                                });



                            });

                        });

                    </script>

                </div>

            </div>

        </div>

    </div>

    <br>

</body>



</html>