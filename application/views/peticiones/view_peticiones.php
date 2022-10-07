<body>
    <div class="main-panel">
        <div class="content-wrapper">


            <div class="row" style="justify-content: center;">
                <!-- Column -->
                <div class="col-lg-6 col-md-6 ppbtn">
                    <div class="card cc-widget">
                        <button class="buttomo">
                            <center>
                                <div class="row">
                                    <div class="cc-icon align-self-center"><i class="mdi mdi-shopping icon-lg " title="Ofertar Activos"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h4 class="m-b-0 amar">Peticiones Negocios</h4>
                                    </div>
                                    <div class="buttomo__horizontal"></div>
                                    <div class="buttomo__vertical"></div>
                                </div>
                            </center>
                        </button>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="content-wrapper">

                    <div class="col-lg-12 ">
                        <div class="card">
                            <div class="tab-content">
                                <div class="tab-pane active" id="compra" role="tabpanel">
                                    <div class="row">
                                        <?php foreach ($peticiones as $p) { ?>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="blog_post lyf">
                                                    <div class="img_podcconu">
                                                        <img class="imgpcard" src="https://pbs.twimg.com/profile_images/890901007387025408/oztASP4n.jpg" alt="random image">
                                                    </div>
                                                    <div class="container_copy">
                                                        <h1><?= $p->nombre_negocio ?> </h1></br>
                                                        <h4>
                                                            Fecha/hora :<?= $p->fecha_peticion ?> <br>
                                                            Valor solicitado: <?= number_format($p->valor, 0) ?><br>
                                                            Saldo actual:<?= number_format($p->cuenta_COP, 0) ?> <br>
                                                            <h4 style="color: black;">Nota: <?= $p->nota ?> <br></h4>
                                                        </h4>
                                                        <div class="espf">
                                                        </div>
                                                        <div style="float: right;">
                                                            <div class="row">
                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn_primarycard btnc3 " data-bs-toggle="modal" data-bs-target="#aprobar_peticion<?= $p->id ?>">Aprobar</button>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="aprobar_peticion<?= $p->id ?>" style="z-index: 1000;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content" style="width: 134%;">
                                                                            <div class="modal-header" style="background-color: #444446;">
                                                                                <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Aprobacion de peticion </h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <form action="<?= base_url() ?>comercio/aprobarPeticion/<?= $p->id ?>" method="post" enctype="multipart/form-data">
                                                                                <div class="modal-body" style="background-color:#7E7E87;">
                                                                                    <h4 style="color: black;">hola <?= $perfil->nombre ?> Sube el certificado de trasnferencia para terminar el proceso</h4>
                                                                                    <div class="row">
                                                                                        <div class="col-6">
                                                                                            <div class="input-group mb-2">
                                                                                                <input type="hidden" name="activo" value="0">
                                                                                            </div>
                                                                                            <div class="input-group mb-2">
                                                                                                <input type="file" class="form-control" name="img" placeholder=" " required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-6">
                                                                                            <center><img src="https://www.tiindo.com/wp-content/uploads/2022/05/logo-cryptoce.png" alt=""> </center>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer " style="background-color: #444446;">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </form>

                                                                <button type="submit" class="btn waves-effect waves-light btn-danger" data-bs-toggle="modal" style="border: 1px solid ;padding: 10px; /*espacio alrededor texto*/background-color: #ef0202;background-image: linear-gradient(62deg, #ef0202 20%, #FBAB7E 48%, #F7CE68 85%);color:black; text-decoration: none;text-transform: uppercase; font-family: 'Helvetica', sans-serif; border-radius: 50px; " data-bs-target="#cancelar_peticion<?= $p->id ?>">Cancelar</button>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="cancelar_peticion<?= $p->id ?>" style="z-index: 1000;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content" style="width: 134%;">
                                                                            <div class="modal-header" style="background-color: #444446;">
                                                                                <h5 class="modal-title" style="color: white;" id="exampleModalLabel">Aprobacion de peticion </h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <form action="<?= base_url() ?>/comercio/rechazarPeticion" method="post">
                                                                            <div class="modal-body" style="background-color:#7E7E87;">
                                                                                <h4 style="color: black;">hola <?= $perfil->nombre ?> ¿Por que rechazas esta solicitud?</h4>
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="input-group mb-2">
                                                                                            <input type="hidden" name="id_comercio" value="<?= $p->id_comercio ?>">
                                                                                            <input type="hidden" name="valor" value="<?= $p->valor ?>">
                                                                                            <input type="hidden" name="activo" value="0">
                                                                                            <input type="hidden" name="id" value="<?= $p->id ?>">
                                                                                            <input type="text" name="estado" placeholder="Escribe un mensaje para esta comercio">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <center><img src="https://www.tiindo.com/wp-content/uploads/2022/05/logo-cryptoce.png" alt=""> </center>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer " style="background-color: #444446;">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                                                            </div>
                                                                        </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- End contain-fluid  -->
            </div>
        </div>
</body>

