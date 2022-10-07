<div class="main-panel">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="content-wrapper">

        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block flex-row">
                            <div class="cc-icon align-self-center"><i class=" mdi mdi-wallet auni" title="BTC"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Pesos Colombianos</h4>
                                <h5 class="text-muted m-b-0 blan">0</h5>
                            </div>
                        </div>
                        <div class="d-flex no-block flex-row m-t-20 cc-details">
                            <div class="p-10 p-l-0 border-right">
                                <h6 class="font-light">Growth</h6><b class="growth">$0.00</b>
                            </div>
                            <div class="p-10 border-right">
                                <h6 class="font-light">Monthly</h6><b class="up">+0%</b>
                            </div>
                            <div class="p-10">
                                <h6 class="font-light">Daily</h6><b class="up">+0%</b>
                            </div>
                        </div>
                    </div>
                    <div id="spark1" class="sparkchart"></div>
                </div>
            </div>

            <!-- Column -->

            <div class="col-lg-4 col-md-6">
                <div class="card cc-widget">
                    <div class="card-body">
                        <div class="d-flex no-block flex-row">
                            <div class="cc-icon align-self-center"><i class="cc USDT auni" title="BTC"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">USDT</h4>
                                <h5 class="text-muted m-b-0"><?= $perfil->cuenta_usdt ?> USDT</h5>
                            </div>
                        </div>
                        <div class="d-flex no-block flex-row m-t-20 cc-details">
                            <div class="p-10 p-l-0 border-right">
                                <h6 class="font-light">Growth</h6><b class="growth">$0</b>
                            </div>
                            <div class="p-10 border-right">
                                <h6 class="font-light">Monthly</h6><b class="up">+0%</b>
                            </div>
                            <div class="p-10">
                                <h6 class="font-light">Daily</h6><b class="up">+0%</b>
                            </div>
                        </div>
                    </div>
                    <div id="spark1" class="sparkchart"></div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card cc-widget">

                    <!-- script divisas -->
                    <div class="card-body" style="padding-top: 3em;padding-bottom: 6em;">
                        <center>
                            <script src="https://www.dolar-colombia.com/widget.js?t=3&c=1"></script>
                        </center>
                    </div>
                    <div id="spark1" class="sparkchart"></div>
                </div>
            </div>

            <!-- <div class="col-md-3 marg ">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <div class="">
                                <header>Convertidor de divisas</header>

                                <script src="https://www.dolar-colombia.com/widget.js?t=3&c=1"></script>
                            </div>
                        </center>

                    </div>
                </div>
            </div> -->
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

        </div>



        <!-- modal de compra -->

        <div id="myModal" class="modal bagcl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered borderre">

                <div class="modal-content">
                    <div class="modal-header cverd">
                        <h4 class="modal-title blan" id="myModalLabel">DEPOSITAR</h4>
                        <button type="button" class="close blan" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body margcent ">

                        <!-- si es comprar pesos colombianos esconder el p2p -->
                        <a href="#"><button type="button" class="btn waves-effect waves-light btn-outline-success btncent ">Empresarial</button></a>
                        <a href="#"><button type="button" class="btn waves-effect waves-light btn-outline-info  btncent">P2P</button></a>
                    </div>



                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->



        <!-- modal de Venta -->

        <div id="mVender" class="modal bagcl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered borderre">

                <div class="modal-content">
                    <div class="modal-header bggr">
                        <h4 class="modal-title amar" id="myModalLabel">VENDER</h4>
                        <button type="button" class="close blan" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body margcent ">

                        <!-- PONER VARIABLE DEPENDIENDO SI LE DA COMPRAR O VENDER -->
                        <a href="vender.php"><button type="button" class="btn waves-effect waves-light btn-outline-success btncent ">Empresarial</button></a>
                        <a href="p2p.php"><button type="button" class="btn waves-effect waves-light btn-outline-info  btncent">P2P</button></a>
                    </div>



                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


                <!-- /trabla referidos / cupones utilizados  --> 
        <div class="col-lg 12 col-md-6">
            <div class="card cc-widget">
                <div class="card-body">
                            <h4>Leonardo jimenez</h4>
                            <h5>id_referido:1</h5>
                            <h5>tu Equipo:</h5> <br>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apelidos</th>
                                <th scope="col">Fecha Afiliciacion</th>
                                <th scope="col">Negocio</th>
                                <th scope="col">Cupones utilizados</th>
                                <th scope="col">  </th>
                            </tr>
                        </thead>
                      
                    </table>
                </div>
                <div id="spark1" class="sparkchart"></div>
            </div>
        </div>



    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->