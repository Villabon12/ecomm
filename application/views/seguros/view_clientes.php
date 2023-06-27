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
            <h1 class="fashion_taital" style="margin-top:20px;">Seguros disponibles</h1>
            <div class="fashion_section_2">
                <div class="row">
                    <?php foreach ($tb_seguros as $c) { ?>
                        <div class="col-lg-3 col-sm-3">
                            <div class="box_main" style="height:598px; border-radius: 20px;">
                                <div style="height:100px;">
                                    <h4 class="shirt_text">
                                        <?= $t->nombre_negocio . "->" . $t->nombre ?>
                                    </h4>
                                </div>
                                <div style="margin-bottom:100px;">
                                    <img src="https://portales.bancochile.cl/uploads/000/038/621/1a648e98-1745-4169-ade1-b35c9df3bdd3/original/img-seguros-marzo2022_0011_Seguro-auto-pro-grilla.jpg"
                                        width="100%" height="100%" alt="profile">
                                </div>
                                <div class="btn_main">
                                    <div class="buy_bt"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#mas_info<?= $t->id ?>">Cotizar</a></div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal mas info -->
                        <div class="modal fade" id="mas_info<?= $t->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="<? base_url() ?>/seguros/insertcotizacion/<?= $t->id ?>" method="get">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"> Comprar Seguro
                                                <?= $t->nombre ?>
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php if ($t->cantidad > 300) { ?>
                                                <h5>Cantidad:Ilimitados</h5>
                                            <?php } else { ?>
                                                <h5>Cantidad:
                                                    <?= $t->cantidad ?>
                                                </h5>
                                            <?php } ?>
                                            <h5>duracion:
                                                <?= $t->duracion ?>
                                            </h5>
                                            <h5>
                                                <?= $t->descripcion ?>
                                            </h5>
                                            <h6>tener en cuenta:</br>
                                                Se tomara datos privados registrados en e´comm para realizar la
                                                respectiva cotizaciíon
                                            </h6>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-success">Aceptar</button>
                                        </div>
                                    </div>
                                </form>
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