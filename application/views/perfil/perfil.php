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
</style>
<!-- banner section start -->
<!-- banner bg main end -->
<!-- fashion section start -->
<!-- <div class="container"> -->
<div class="tablas" style="margin:20px;">
    <div class="notifiacion">
        <?php if ($this->session->flashdata("error")) { ?>
            <p>
                <?php echo $this->session->flashdata("error") ?>
            </p>
        <?php } ?>
    </div>
    <div class="col-12">
        <div class="card" style="margin-top: 2rem;">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="border-bottom text-center pb-4">
                            <button type="button" style="border:none;background:none;" data-bs-toggle="modal"
                                data-bs-target="#verFoto<?= $perfil->id ?>"><img
                                    src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>"
                                    alt="profile" class="img-lg rounded-circle mb-3" /> </button><button type="button"
                                style="padding:0;border:none;background:none;position: relative; top:35px; right:30px; "
                                data-bs-toggle="modal" data-bs-target="#subirFoto<?= $perfil->id ?>"><i
                                    style=" color:#36E1F9;  font-size: 30px; hover;" class="bi bi-gear-fill"></i>
                            </button>
                            <div class="mb-3">
                                <h3>
                                    <?= $perfil->nombre . "  " . $perfil->apellido1 ?>
                                </h3>
                                <div class="d-flex align-items-center justify-content-center">
                                    <h5 class="mb-0 me-2 text-muted">
                                        <?= $perfil->ciudad ?>
                                    </h5>
                                </div><br>
                                <?php if ($perfil->cedula == "1003895100" || $perfil->cedula == "1075316223") { ?>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h5 class="mb-0 me-2 text-muted"> Desarrollador</h5>
                                    </div> <br>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h5 class="mb-0 me-2 text-muted">
                                            <?= $perfil->tipo ?>
                                        </h5>
                                    </div>
                                <?php } else { ?>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h5 class="mb-0 me-2 text-muted">
                                            <?= $perfil->tipo ?>
                                        </h5>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="card cc-widget">
                                    <div class="card-body text-center">
                                        <div class="d-flex no-block flex-row">
                                            <div class="container">
                                                <div class="cc-icon align-self-center"><i class=" bi bi-coin"
                                                        title="BTC"></i></div>
                                                <div class="m-l-10 align-self-center">
                                                    <center>
                                                        <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                                    </center>
                                                    <h5 class="text-muted m-b-0 blan">$
                                                        <?= number_format($perfil->cuenta_COP, 0) ?>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-4">
                            <p class="clearfix">
                                <span class="float-left">
                                </span>
                                <?= $perfil->verificar_user ?>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Estado
                                </span>
                                <span class="float-right text-muted">
                                    <?php if ($perfil->verificar_user == "inac") { ?>
                                        usuario inactivo para subir comercios </br>
                                        Observacion: <strong>
                                            <?= $perfil->msm ?>
                                        </strong>
                                    <?php } else if ($perfil->verificar_user == "habilitado") { ?>
                                        <?= $perfil->verificar_user ?>
                                    <?php } else {
                                        } ?>
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    holi
                                </span>
                                <span class="float-right text-muted">
                                    <?= $perfil->celular ?>
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Correo electronico
                                </span>
                                <span class="float-right text-muted">
                                    <?= $perfil->correo ?>
                                </span>
                            </p>
                            <?php if ($perfil->tipo == 'SocioAdmin' || $perfil->tipo == 'Socio') { ?>
                                <?php if ($perfil->img_cedula_front == null || $perfil->img_cedula_back == null || $perfil->img_selfie == null) { ?>
                                    <br>
                                    <a class="btn btn-success" href="<?= base_url() ?>Perfil/updateCuenta/<?= $perfil->id ?>"
                                        target="_blank">Verificar usuario</a>
                                <?php } else { ?>

                                <?php } ?>
                            <?php } else { ?>
                                <?php if ($perfil->img_cedula_front == null || $perfil->img_cedula_back == null || $perfil->RUT == null) { ?>
                                    <br>
                                    <a class="btn btn-success" href="<?= base_url() ?>Perfil/updateCuenta/<?= $perfil->id ?>"
                                        target="_blank">Verificar usuario</a>
                                <?php } else { ?>
                                    <label for="">Contrato:</label>
                                    <a href="<?= base_url() ?>assets\img\documentacion\contrato.docx"
                                        download="Contrato.docx"><br>
                                        <i style="font-size: 50px" class="mdi mdi-file-word"></i>
                                    </a><br>
                                    <label for="">Propuesta Ecomm:</label>
                                    <a href="<?= base_url() ?>assets\img\documentacion\propuesta.pdf"
                                        download="propuesta.pdf"><br>
                                        <i style="font-size: 50px" class="mdi mdi-file-pdf-box"></i>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                            <a class="btn btn-success" href="<?= base_url() ?>Perfil/otroperfil/" target="_blank">Ver
                                carta de presentación</a>
                            <?php if ($perfil->tipo = "Comercio") { ?>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#getApikey">
                                    Obtener EcommPay
                                </button>
                            <?php } else { ?>

                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="mt-4 py-2 border-top border-bottom">
                            <ul class="nav profile-navbar">
                                <li class="nav-item">
                                    <?php if ($perfil->tipo == "Socio" || $perfil->tipo == "SocioAdmin") { ?>
                                        <a class="nav-link active" href="<?= base_url() ?>Perfil/perfil">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                                            </svg>
                                            Informacion
                                        </a>
                                    <?php } else { ?>
                                        <a class="nav-link active" href="<?= base_url() ?>Perfil/perfilcomer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                                            </svg>
                                            Informacion
                                        </a>
                                    <?php } ?>
                                </li>
                                <li class="nav-item">
                                    <?php if ($perfil->tipo == "Socio" || $perfil->tipo == "SocioAdmin") { ?>
                                        <a class="nav-link " href="<?= base_url() ?>Perfil/perfil2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                                                <path
                                                    d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                                <path
                                                    d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                            </svg>
                                            Datos bancarios
                                        </a>
                                    <?php } else { ?>
                                        <a class="nav-link " href="<?= base_url() ?>Perfil/perfil2comer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                                                <path
                                                    d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                                <path
                                                    d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                            </svg>
                                            Datos bancarios
                                        </a>
                                    <?php } ?>
                                </li>
                                <li class="nav-item">
                                    <?php if ($perfil->tipo == "Socio" || $perfil->tipo == "SocioAdmin") { ?>
                                        <!-- <a class="nav-link "
                                            href="<?= base_url() ?>perfil/perfilPresentacion">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                                <path
                                                    d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                                                <path
                                                    d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
                                            </svg>
                                            Carta de presentación
                                        </a> -->
                                    <?php } else { ?>
                                        <a class="nav-link " href="<?= base_url() ?>Perfil/perfil2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                                <path
                                                    d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                                                <path
                                                    d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
                                            </svg>
                                            Carta de presentación
                                        </a>
                                    <?php } ?>
                                </li>
                                <?php if ($perfil->tipo == "Comercio") { ?>
                                    <li class="nav-item">
                                        <a class="nav-link " href="<?= base_url() ?>Perfil/perfil2redes">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-diagram-3-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5v-1zm-6 8A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm6 0A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm6 0a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1z" />
                                            </svg>
                                            Redes Sociales
                                        </a>
                                    </li>
                                <?php } else {
                                } ?>
                            </ul>
                        </div>
                        <?php if ($perfil->tipo == "Socio" || $perfil->tipo == "SocioAdmin") { ?>
                            <form method="post" action="<?= base_url() ?>Perfil/actualizarPerfil/<?= $perfil->id ?>">
                            <?php } else { ?>
                                <form method="post"
                                    action="<?= base_url() ?>Perfil/actualizarPerfilcomer/<?= $perfil->id ?>">
                                <?php } ?>
                                <div class="row">
                                    <div class="col">
                                        <label for="inputCity" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre"
                                            value="<?= $perfil->nombre ?>" name="nombre">
                                    </div>
                                    <div class="col">
                                        <label for="inputCity" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" placeholder=""
                                            value="<?= $perfil->apellido1 ?>" name="apellido1">
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="col">
                                        <label for="inputCity" class="form-label">Cedula</label>
                                        <span class="input-group-text" id="basic-addon2">
                                            <?= $perfil->cedula ?>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <label for="inputCity" class="form-label">Celular</label>
                                        <input type="text" class="form-control" placeholder="celular"
                                            value="<?= $perfil->celular ?>" name="celular">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col">
                                        <label for="inputCity" class="form-label">Contraseña</label>
                                        <div class="row">
                                            <div class="input-group lg-3">
                                                <input type="text" class="form-control" placeholder=""
                                                    value="***************" aria-label="Recipient's username"
                                                    aria-describedby="button-addon2" readonly>
                                                <button class="btn btn-success" style="line-height: 0;" type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#actualizarcontra<?= $perfil->id ?>"><i
                                                        class="mdi mdi-wrench"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="inputCity" class="form-label">Usuario</label>
                                        <span class="input-group-text" id="basic-addon2" type="password">
                                            <?= $perfil->user ?>
                                        </span>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col">
                                        <label for="inputCity" class="form-label">Fecha nacimiento</label>
                                        <input type="date" class="form-control" placeholder="fecha_nacimiento"
                                            value="<?= $perfil->fecha_nacimiento ?> " name="fecha_nacimiento">

                                        <p style="color: green;"> Su fecha de nacimiento es :
                                            <?= $perfil->fecha_nacimiento ?>
                                        </p>
                                    </div>
                                    <div class="col">
                                        <label for="inputCity" class="form-label">Ciudad</label>
                                        <select class="form-select" aria-label="Default select example" name="ciudad">
                                            <option selected value="<?= $perfil->ciudad ?>"><?= $perfil->ciudad ?>
                                            </option>
                                            <?php foreach ($ciudad as $m) { ?>
                                                <option value="<?= $m->municipio ?>"><?= $m->municipio ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <label for="inputCity" class="form-label">Correo</label>
                                    <span class="input-group-text" id="basic-addon2">
                                        <?= $perfil->correo ?>
                                    </span>
                                </div><br>
                                <div class="row">
                                    <label for="inputCity" class="form-label">Fecha registro</label>
                                    <span class="input-group-text" id="basic-addon2">
                                        <?= $perfil->fecha_registro ?>
                                    </span>
                                </div><br>
                                <div class="row">
                                    <button type="submit" class="btn btn-success">Modificar</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Solicitar boton de pagos -->
<div class="modal fade" id="getApikey" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <form action="<?= base_url() ?>Ecommpay/OptenerApikey" method="post">  -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Solicitar Boton de Pagos con
                    E´comm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1 style="color:red;">Importante:</h1>
                <h6>-Las credenciales solo se podran ver una sola vez, copie y peguelas o guardelas
                    en un lugar seguro donde no las olvidara</h6>
                <h6>-El porcentaje a continuacion es el de intereses por transferencias utilizando
                    el boton ecommPay</h6>
                <label for=""> Porcentaje por pago</label>
                <input type="number" name="porcentaje" id="valordes" class="form-control"
                    placeholder="Digite el porcentaje para utilizar el medio de pago Ecommpay" requiered>
                <br><br>
                <div id="add"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-warning" id="enviardata">Aceptar</button>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>
<!-- Modal ver Foto de Perfil -->
<div class="modal fade" id="verFoto<?= $perfil->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <center>
                <div class="modal-body">
                    <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>" width="300px"
                        height="250px" alt="profile">
                </div>
            </center>
        </div>
    </div>
</div>
<!-- Modal actualizar Foto -->
<div class="modal fade" id="subirFoto<?= $perfil->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php if ($perfil->tipo == "Socio" || $perfil->tipo == "SocioAdmin") { ?>
                <form action="<?= base_url() ?>Perfil/actualizarFoto/<?= $perfil->id ?>" method="post"
                    enctype="multipart/form-data">
                <?php } else { ?>
                    <form action="<?= base_url() ?>Perfil/actualizarFotocomer/<?= $perfil->id ?>" method="post"
                        enctype="multipart/form-data">

                    <?php } ?>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Sube una
                            foto de perfil</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <label for=" sube un archivo"></label>
                            <input type="file" class="form-control" placeholder="Username" aria-label="img"
                                aria-describedby="basic-addon1" name="img">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" style="background-color: #36E1F9;" class="btn ">Modificar</button>
                    </div>
                </form>
        </div>
    </div>
</div>
<!-- Modal Update da -->
<div class="modal fade" id="actualizarcontra<?= $perfil->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">actualizar
                    contraseña</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php if ($perfil->tipo == "Socio") { ?>
                <form action="<?= base_url() ?>Perfil/actualizarcontra/<?= $perfil->id ?>" method="POST">
                <?php } else { ?>
                    <form action="<?= base_url() ?>Perfil/actualizarcontracomer/<?= $perfil->id ?>" method="POST">
                    <?php } ?>
                    <div class="modal-body">
                        <div class="col">
                            <label for="inputCity" class="form-label">Contraseña
                                actual</label>
                            <div class="row">
                                <div class="input-group lg-3">
                                    <input type="password" class="form-control" placeholder="" name="contra_actual"
                                        aria-label="Recipient's username" aria-describedby="button-addon2">
                                </div>
                            </div>
                            <label for="inputCity" class="form-label">Contraseña
                                nueva</label>
                            <div class="row">
                                <div class="input-group lg-3">
                                    <input type="password" class="form-control" placeholder="" id="Input"
                                        name="contra_nueva" aria-label="Recipient's username"
                                        aria-describedby="button-addon2">
                                    <!-- <button class="btn btn-success" style="line-height: 0;" id="Eye" type="button" ><i class="mdi mdi-adjust"></i></button> -->
                                </div>
                            </div>
                            <label for="inputCity" class="form-label">Confirme su
                                contraseña</label>
                            <div class="row">
                                <div class="input-group lg-3">
                                    <input type="password" class="form-control" placeholder=""
                                        aria-label="Recipient's username" name="confir_contra"
                                        aria-describedby="button-addon2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
        </div>
    </div>
</div>

</body>


<script>
    $("#valordes").keyup(function (e) {

        $b = $(this).val();

        $("#enviardata").val($b);

    })



    $("#enviardata").on("click", function () {

        var data = $(this).val()

        $.ajax({

            url: '<?= base_url() ?>Ecommpay/OptenerApikey',

            type: "POST",

            data: {

                porcentaje: data

            },

            success: function (resp) {

                html = '<div class="input-group mb-2">';

                html += '<h4 style="color:black;">' + resp + '</h4>';

                html += '</div>';

                $('#add').html(html);


                console.log(resp)

            }
        })
    })
</script>

</html>