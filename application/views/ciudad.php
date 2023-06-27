<div class="main-panel">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="content-wrapper">
        <?php if ($this->session->flashdata("realizado")) { ?>
            <p><?php echo $this->session->flashdata("realizado") ?></p>
        <?php } ?>
        <?php if ($this->session->flashdata("error_maximo")) { ?>
            <p><?php echo $this->session->flashdata("error_maximo") ?></p>
        <?php } ?>
        <div class="row">
            <?php if ($perfil->img_selfie == (NULL) || $perfil->img_cedula_back == (NULL) || $perfil->img_cedula_front == (NULL)) { ?>
                <div class="col-lg 12">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <i class="mdi mdi-alert-circle-outline icon-lg" style="color:red;"></i>
                                <h1>Espera un momento</h1>
                                <h2>Valida tus datos primero</h2>
                                <?php if ($perfil->tipo == "Socio") { ?>
                                    <a href="<?= base_url() ?>Perfil/perfil" type="button" class="btn btn-success  ">validar</a>
                                <?php } else { ?>
                                    <a href="<?= base_url() ?>Perfil/perfilcomer" type="button" class="btn btn-success  ">validar</a>
                                <?php } ?>
                            </center>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-lg 12" style="padding-top: 5rem;">
                    <div class="card">
                        <div class="card-body">
                            <center>

                                <h1>¿Donde Te gustaria comprar?</h1>
                                <h2>Escoge tu ciudad</h2>

                                <form action="<?= base_url() ?>Comercio/cupones/<?= $m->id_municipio ?>" method="POST">
                                    
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Selecciona tu ciudad</option>
                                            <?php foreach ($ciudad as $m) { ?>
                                            <option value="<?= $m->id_municipio ?>"><?= $m->municipio ?></option>
                                        <?php  } ?>
                                        </select>
                                        <button type="submit" class="btn btn-success">Buscar Ecommvale</button>
                                </form>

                            </center>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>