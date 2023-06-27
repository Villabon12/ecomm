<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<style>
    @-webkit-keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(calc(-250px * 7));
        }
    }

    @keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(calc(-250px * 7));
        }
    }

    .slider {
        background: white;
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.125);
        height: 100px;
        margin: auto;
        overflow: hidden;
        position: relative;
        width: 100%;
    }

    .slider::before,
    .slider::after {
        background: linear-gradient(to right, white 0%, rgba(255, 255, 255, 0) 100%);
        content: "";
        height: 100px;
        position: absolute;
        width: 200px;
        z-index: 2;
    }

    .slider::after {
        right: 0;
        top: 0;
        transform: rotateZ(180deg);
    }

    .slider::before {
        left: 0;
        top: 0;
    }

    .slider .slide-track {
        -webkit-animation: scroll 40s linear infinite;
        animation: scroll 40s linear infinite;
        display: flex;
        width: calc(250px * 14);
    }

    .slider .slide {
        height: 100px;
        width: 250px;
    }
</style> <!-- banner section start -->
<div class="banner_section layout_padding">
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
    <div id="main_slider">
        <div class="container">
            <h1 class="fashion_taital" style="margin-top:20px;">Sección de <?= $catego->nombre ?></h1>
            <div class="fashion_section_2">
                <div class="row">
                    <?php foreach ($e as $C) { ?>
                        <div class="col-lg-3 col-sm-3">
                            <div class="box_main" style="height:598px; border-radius: 20px;">
                                <div style="height:100px;">
                                    <h4 class="shirt_text">
                                        <?= $C->nombre ?>
                                    </h4>
                                    <p class="price_text">Precio: <span style="color: #262626;">
                                            <?= number_format($C->precio, 0) ?>
                                        </span>
                                    </p>
                                </div>
                                <div style="margin-bottom:100px;">
                                    <img src="<?= base_url() ?>assets/img/<?= $C->img ?>" style="height:300px;">
                                </div>
                                <div class="btn_main">
                                    <div class="buy_bt"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#carrito<?= $C->id ?>">Compra ahora</a></div>
                                    <div class="seemore_bt"><a href="#">gana:
                                            $
                                            <?= number_format(((($C->precio * $C->descuento) / 100) * $C->cashback / 100), 0) ?><br>
                                        </a></div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal mas info -->
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
                                                            <img src="<?= base_url() ?>assets/img/<?= $C->img ?>"
                                                                alt="imagen" height="150px" style="max-width: 100%;">
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
                </div>
            </div>

        </div>
    </div>
</div>
</body>

</html>