<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abyssinica+SIL&display=swap" rel="stylesheet">

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row" style="justify-content: center;">
            <?php if ($this->session->flashdata("realizado")) { ?>
                <p><?php echo $this->session->flashdata("realizado") ?></p>
            <?php } ?>
            <?php if ($this->session->flashdata("error")) { ?>
                <p><?php echo $this->session->flashdata("error") ?></p>
            <?php } ?>
            <!-- Column -->
            <div class="col-lg-6 col-md-6 ppbtn">
                <div class="card cc-widget">
                    <button class="buttomo">
                        <center>
                            <div class="row">
                                <div class="cc-icon align-self-center"><i class="menu-icon mdi mdi-chart-areaspline" style="font-size: 50px;" title="Ofertar Activos"></i></div>
                                <div class="m-l-10 align-self-center">
                                    <h4 class="m-b-0 amar"> Marketing </h4>
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
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="tab-content">
                            <center>
                                <strong>
                                    <h2 style="font-family: 'Abyssinica SIL', serif; ">Nos enfocamos en posicionar y realizar estrategias de marketing para la marca dirigida a la comunidad a través de las plataformas digitales.</h2>
                                </strong>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <h4>Nuestros Paquetes:</h4><br><br><br>
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            <?php foreach ($paquetes as $p) { ?>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        <div class="card-header py-3 text-white bg-primary border-primary">
                            <h4 class="my-0 fw-normal"><?= $p->nombre  ?></h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$<?= number_format($p->precio, 0) ?><small class="text-muted fw-light">/Mensual</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li><?= $p->descripcion1?></li>
                                <li><?= $p->descripcion2 ?></li>
                                <li><?= $p->descripcion3 ?> </li>
                            </ul>
                            <button type="button" class="w-100 btn btn-lg btn-primary">Comprar</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
            <h4>Nuestros servicios:</h4><br><br><br>

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-xlg-6 col-md-6" style="padding-bottom: 10px;">
                        <div class="card">
                            <div class="tab-content">
                                <img src="https://i2.wp.com/visionstudiosci.com/wp-content/uploads/2021/06/R3deabbd79640cb7ffa19007e136950d7-1.jpg?w=1200&ssl=1" alt="" width="100%" height="250">
                                <h4 style="color: black;">Community Manager</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xlg-6 col-md-6">
                        <div class="card">
                            <div class="tab-content">
                                <img src="https://i.pinimg.com/736x/12/50/07/1250070bff835f4000bade508ed23ab3.jpg" alt="" width="100%" height="250">
                                <h4 style="color: black;">Desarrollo gráfico</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xlg-6 col-md-6">
                        <div class="card">
                            <div class="tab-content">
                                <img src="" alt="" width="100%" height="250">
                                <h4 style="color: black;">Tipos de contenido</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xlg-6 col-md-6">
                        <div class="card">
                            <div class="tab-content">
                                <img src="https://zipzapsocial.com/wp-content/uploads/2017/12/lll.jpg" alt="" width="100%" height="250">
                                <h4 style="color: black;">Redes sociales ADS</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End contain-fluid  --> <br><br><br>

    </div>

</body>