<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,1000&display=swap" rel="stylesheet">
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
        <div class="banner_section layout_padding ">
            <div class="container">
                <div id="my_slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 class="banner_taital">¡Ten ingresos pasivos de manera
                                        automatica!</h1>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 class="banner_taital">Compra y <br> Gana , en E`comm</h1>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 class="banner_taital">Apoyemos las microempresas <br>Colombianas</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- banner section end -->
    </div>
    <!-- banner bg main end -->
    <!-- fashion section start -->
    <div class="fashion_section">
<div class="notifiacion">
<?php if ($this->session->flashdata("error")) { ?>
        <p>
            <?php echo $this->session->flashdata("error") ?>
        </p>
<?php } ?>
</div>
        <div id="main_slider" class="carousel slide" >
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <h1 class="fashion_taital" style="margin-top:20px;">Comida</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                <?php foreach ($comida as $c) { ?>
                                    <div class="col-lg-3 col-sm-3">
                                        <div class="box_main" style="height:598px;border-radius: 20px;">
                                            <div style="height:100px;">
                                                <h4 class="shirt_text">
                                                    <?= $c->nombre ?>
                                                </h4>
                                                <p class="price_text">Precio: <span style="color: #262626;">
                                                        <?= number_format($c->precio, 0) ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div style="margin-bottom:100px;">
                                                <img src="<?= base_url() ?>assets/img/<?= $c->img ?>" style="height:300px;" width="100%">
                                            </div>
                                            <div class="btn_main">
                                                <div class="buy_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#carrito<?= $c->id ?>">Compra ahora</a></div>
                                                <div class="seemore_bt"><a href="#">gana:
                                                        $
                                                        <?= number_format(((($c->precio * $c->descuento) / 100) * $c->cashback / 100), 0) ?><br>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <h1 class="fashion_taital" style="margin-top:20px;">Moda</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                <?php foreach ($moda as $c) { ?>
                                    <div class="col-lg-3 col-sm-3">
                                        <div class="box_main" style="height:598px; border-radius: 20px;">
                                            <div style="height:100px;">
                                                <h4 class="shirt_text">
                                                    <?= $c->nombre ?>
                                                </h4>
                                                <p class="price_text">Precio: <span style="color: #262626;">
                                                        <?= number_format($c->precio, 0) ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div style="margin-bottom:100px;">
                                                <img src="<?= base_url() ?>assets/img/<?= $c->img ?>" style="height:300px;" width="100%">
                                            </div>
                                            <div class="btn_main">
                                                <div class="buy_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#carrito<?= $c->id ?>">Compra ahora</a></div>
                                                <div class="seemore_bt"><a href="#">gana:
                                                        $
                                                        <?= number_format(((($c->precio * $c->descuento) / 100) * $c->cashback / 100), 0) ?><br>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <h1 class="fashion_taital" style="margin-top:20px;">Vacaciones / Tour</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                <?php foreach ($vaca as $c) { ?>
                                    <div class="col-lg-3 col-sm-3">
                                        <div class="box_main" style="height:598px; border-radius: 20px;">
                                            <div style="height:100px;">
                                                <h4 class="shirt_text">
                                                    <?= $c->nombre ?>
                                                </h4>
                                                <p class="price_text">Precio: <span style="color: #262626;">
                                                        <?= number_format($c->precio, 0) ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div style="margin-bottom:100px;">
                                                <img src="<?= base_url() ?>assets/img/<?= $c->img ?>" style="height:300px;" width="100%">
                                            </div>
                                            <div class="btn_main">
                                                <div class="buy_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#carrito<?= $c->id ?>">Compra ahora</a></div>
                                                <div class="seemore_bt"><a href="#">gana:
                                                        $
                                                        <?= number_format(((($c->precio * $c->descuento) / 100) * $c->cashback / 100), 0) ?><br>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    <!-- fashion section end -->
    <!-- electronic section start -->
    <div class="fashion_section">
        <div id="electronic_main_slider" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="container">
                        <h1 class="fashion_taital">Salud y belleza</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                <?php foreach ($salud as $c) { ?>
                                    <div class="col-lg-3 col-sm-3">
                                        <div class="box_main" style="height:598px; border-radius: 20px;">
                                            <div style="height:100px;">
                                                <h4 class="shirt_text">
                                                    <?= $c->nombre ?>
                                                </h4>
                                                <p class="price_text">Precio: <span style="color: #262626;">
                                                        <?= number_format($c->precio, 0) ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div style="margin-bottom:100px;">
                                                <img src="<?= base_url() ?>assets/img/<?= $c->img ?>" style="height:300px;" width="100%">
                                            </div>
                                            <div class="btn_main">
                                            <div class="buy_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#carrito<?= $c->id ?>">Compra ahora</a></div>
                                                <div class="seemore_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#carrito<?= $c->id ?>">gana:
                                                        $
                                                        <?= number_format(((($c->precio * $c->descuento) / 100) * $c->cashback / 100), 0) ?><br>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <h1 class="fashion_taital">Tecnologia</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                <?php foreach ($electro as $c) { ?>
                                    <div class="col-lg-3 col-sm-3">
                                        <div class="box_main" style="height:598px; border-radius: 20px;">
                                            <div style="height:100px;">
                                                <h4 class="shirt_text">
                                                    <?= $c->nombre ?>
                                                </h4>
                                                <p class="price_text">Precio: <span style="color: #262626;">
                                                        <?= number_format($c->precio, 0) ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div style="margin-bottom:100px;">
                                                <img src="<?= base_url() ?>assets/img/<?= $c->img ?>" style="height:100%;" width="100%">
                                            </div>
                                            <div class="btn_main">
                                                <div class="buy_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#carrito<?= $c->id ?>">Compra ahora</a></div>
                                                <div class="seemore_bt"><a href="#">gana:
                                                        $
                                                        <?= number_format(((($c->precio * $c->descuento) / 100) * $c->cashback / 100), 0) ?><br>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <h1 class="fashion_taital">Muchos mas productos</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                <?php foreach ($vaca as $c) { ?>
                                    <div class="col-lg-3 col-sm-3">
                                        <div class="box_main" style="height:598px; border-radius: 20px;">
                                            <div style="height:100px;">
                                                <h4 class="shirt_text">
                                                    <?= $c->nombre ?>
                                                </h4>
                                                <p class="price_text">Precio: <span style="color: #262626;">
                                                        <?= number_format($c->precio, 0) ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div style="margin-bottom:100px;">
                                                <img src="<?= base_url() ?>assets/img/<?= $c->img ?>" style="height:300px;" width="100%">
                                            </div>
                                            <div class="btn_main">
                                                <div class="buy_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#carrito<?= $c->id ?>">Compra ahora</a></div>
                                                <div class="seemore_bt"><a href="#">gana:
                                                        $
                                                        <?= number_format(((($c->precio * $c->descuento) / 100) * $c->cashback / 100), 0) ?><br>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#electronic_main_slider" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control-next" href="#electronic_main_slider" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div> <br><br><br><br><br><br>

        <section style="background-color:#F9C442; margin-top:50px;" >
            <div class="container" style="margin-bottom:50px;">
                <div class="col-12" ><br><br>
                    <center>
                        <h1 style="margin-top:15px; font-family: 'Nunito', sans-serif;"><b>E´comm donde comprar es ganar</b></h1>
                    </center>
                </div><br>
                <div class="row g-2  row-cols-1 row-cols-lg-2">
                    <div class="feature col">
                        <center>
                            <video width="500" height="300" controls>
                                <source src="<?= base_url() ?>assets\img\publicidad\publicidad.mp4" type="video/mp4">
                                Tu navegador no admite el elemento de video.
                            </video>
                        </center>
                    </div>
                    <div class="feature col" be>
                        <h2>Conoce Algunos beneficios de comprar por E`comm</h2> <br>
                        <h2>
                            -Gana incentivos puntos (e-puntos) por cada una de tu compras . <br><br>
                            -Entre mas compres mas ganas, por que con cada compra tu ganas puntos. <br><br>
                            -Compras agiles, en tus Comercios cercanos.<br><br>
                            -Los puntos por cada compra es dinero  que puedes retirar o redimirlos para seguir comprando.                         </h2>
                    </div>
                </div>
            </div>
            <br><br><br>
        </section>
    </div>
    <!-- Modal -->
                    <?php foreach ($e as $C) { ?>
                        <!-- Modal carrito-->
                        <div class="modal fade" id="carrito<?= $C->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="<?= base_url() ?>Proceso/aggCarrito/<?= $C->id ?>" method="post">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Estas seguro de agregar
                                                <?= $C->nombre ?> al carrito
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="">Cantidad</label>
                                                    <input type="number" class="form-control form-control-sm" value="1"
                                                        name="cantidad" required>
                                                </div>
                                                <div class="col-6">
                                                    <center>
                                                        <div>
                                                            <img src="<?= base_url() ?>assets/img/<?= $C->img ?>" alt="imagen"
                                                                height="150px" style="max-width: 100%;">
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                                <div class="col">
                                                    <button type="submit" class="btn btn-success btn-sm">Agregar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


</body>
<script>
        // function showModal() {
        //     document.getElementById("myModal").style.display = "block";
        // }
        // function closeModal() {
        //     document.getElementById("myModal").style.display = "none";
        // }
    </script>
</html>