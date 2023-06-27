<!-- footer section start -->
<div class="footer_section layout_padding">
  <div class="container">
    <div class="footer_logo"><a href="index.html"><img src="<?= base_url() ?>dist/favicon.png" width="200px"
          height="700px"></a></div>
    <!-- <div class="input_bt">
      <input type="text" class="mail_bt" placeholder="tu correo electronico" name="Your Email">
      <span class="subscribe_bt" id="basic-addon2"><a href="#">Quiero mas informacion</a></span>
    </div>
    <div class="footer_menu">
      <ul>
        <li><a href="#">Mejores productos</a></li>
        <li><a href="#">Quiero traer un comercio</a></li>
        <li><a href="#">Sugerencias</a></li>
        <li><a href="#">Servicio al cliente</a></li>
      </ul>
    </div> -->
    <div class="location_main">Linea de atencion : <a href="#">+57 3112209514</a></div>
  </div>
</div>
<!-- footer section end -->
<!-- copyright section start -->
<div class="copyright_section">
  <div class="container">
    <p class="copyright_text">Copyright © 2023. Todos los derechos reservados.</p>
  </div>
</div>

<!-- copyright section end -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
  integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Javascript files-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>recursos/js/jquery.min.js"></script>
<script src="<?= base_url() ?>recursos/js/popper.min.js"></script>
<script src="<?= base_url() ?>recursos/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>recursos/js/jquery-3.0.0.min.js"></script>
<script src="<?= base_url() ?>recursos/js/plugin.js"></script>
<!-- sidebar -->
<script src="<?= base_url() ?>recursos/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?= base_url() ?>recursoss/js/custom.js"></script>
<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
</script>
<script>
  $(document).ready(function () {
    var base_url = "<?= base_url() ?>";

    $("#buscar").keyup(function () {

      buscar = $(this).val();

      if (buscar == 0) {
        console.log('es 0');
        $('#respuesta').hide("fast");
        $('.respuesta').hide("fast"); //muestro mediante clase
      } else {
        $.ajax({
          url: base_url + "Inicio_page/traerlanding",
          type: "POST",
          data: {
            buscar: buscar
          },
          dataType: "json",
          success: function (resp) {
            console.log(resp);
            $('#respuesta').show("fast");
            if (resp == 0) {
              html = "";
              html += '<center>'
              html += '<p style="color:red;">No se encuentran coincidencias</p>'
              html += '</center>'
              $('#respuesta').html(html);
            } else {
              console.log(resp);
              html = "";
              $.each(resp, function (key, value) {
                html += '<tr>'
                html += '<td><button type="button" style="border:none;background:none;" data-bs-toggle="modal" data-bs-target="#carrito' + value.id + ' ">' + value.nombre + '->' + value.nombre_negocio + '</a></td>'
                html += '</tr>'
                $('#respuesta').html(html);
              });
            }

          }
        })
      }
    })
    $("#buscarint").keyup(function () {

      buscar = $(this).val();

      if (buscar == 0) {
        console.log('es 0');
        $('#respuesta').hide("fast");
        $('.respuesta').hide("fast"); //muestro mediante clase
      } else {
        $.ajax({
          url: base_url + "Comercio/traerproducto",
          type: "POST",
          data: {
            buscar: buscar
          },
          dataType: "json",
          success: function (resp) {
            console.log(resp);
            $('#respuesta').show("fast");
            if (resp == 0) {
              html = "";
              html += '<center>'
              html += '<p style="color:red;">No se encuentran coincidencias</p>'
              html += '</center>'
              $('#respuesta').html(html);
            } else {
              console.log(resp);
              html = "";
              $.each(resp, function (key, value) {
                html += '<tr>'
                html += '<td><button type="button" style="border:none;background:none;" data-bs-toggle="modal" data-bs-target="#carrito' + value.id + ' ">' + value.nombre + '->' + value.nombre_negocio + '</a></td>'
                html += '</tr>'
                $('#respuesta').html(html);
              });
            }

          }
        })
      }
    })
  });
</script>



<!-- plugins:js -->

<script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>

<!-- endinject -->

<!-- Plugin js for this page -->

<script src="<?= base_url() ?>admin_temp/vendors/chart.js/Chart.min.js"></script>

<script src="<?= base_url() ?>admin_temp/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script src="<?= base_url() ?>admin_temp/vendors/progressbar.js/progressbar.min.js"></script>



<!-- End plugin js for this page -->

<!-- inject:js -->

<script src="<?= base_url() ?>admin_temp/js/off-canvas.js"></script>

<script src="<?= base_url() ?>admin_temp/js/hoverable-collapse.js"></script>

<script src="<?= base_url() ?>admin_temp/js/template.js"></script>

<script src="<?= base_url() ?>admin_temp/js/settings.js"></script>

<script src="<?= base_url() ?>admin_temp/js/todolist.js"></script>

<!-- endinject -->

<!-- Custom js for this page-->

<script src="<?= base_url() ?>admin_temp/js/jquery.cookie.js" type="text/javascript"></script>

<script src="<?= base_url() ?>admin_temp/js/dashboard.js"></script>

<script src="<?= base_url() ?>admin_temp/js/Chart.roundedBarCharts.js"></script>

<!-- End custom js for this page-->


<!-- estilos para la datatable-->

<script src="<?= base_url() ?>admin_temp/vendors/datatables.net/jquery.dataTables.js"></script>

<script src="<?= base_url() ?>admin_temp/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<script src="<?= base_url() ?>admin_temp/js/data-table.js"></script>



<script type="text/javascript">

  $(function () {

    $('#cc-table').DataTable({

      "displayLength": 10

    });

  });

</script>



<script>

  function cambiar() {

    var pdrs = document.getElementById('file-upload').files[0].name;

    document.getElementById('info').innerHTML = pdrs;

  }

</script>


<script>

  $(document).ready(function () {

    var base_url = "<?= base_url() ?>";



    $('#ocultar1').hide(); //muestro mediante id

    $('#ocultar2').hide(); //muestro mediante id





    $("#mostrar1").on("click", function () {

      $('#ocultar1').show(); //muestro mediante id

    });

    $("#mostrar2").on("click", function () {

      $('#ocultar2').show(); //muestro mediante id

    });





    $(".btn-oferta").on("click", function () {

      var id = $(this).val();

      alertify.confirm("¿Estas seguro de aprobar?", function (e) {

        $.ajax({

          url: base_url + "Ofertas/updPendiente",

          type: "POST",

          data: {

            id: id

          },

          success: function (data) {

            alertify.success('Ok');

 

            window.location.reload();

          }

        });

      });

    });



    $("#cedula").keyup(function (e) {

      $b = $(this).val();

      $("#cedula2").val($b);

    })



    $("#cedula2").on("click", function () {

      var data = $(this).val()

      $.ajax({

        url: '<?= base_url() ?>Comercio/traer_usuario',

        type: "POST",

        data: {

          cedula: data

        },

        success: function (resp) {

          html = '<div class="input-group mb-2">';

          html += '<h5 style="color:black;">' + resp + '</h5>';

          html += '</div>';

          $('#add').append(html);

        }
      })
    })



    //primer intento Ajax

    $("#hola").keyup(function (e) {

      $b = $(this).val();

      html = "<input type='text' data-type='holaa' value='" + $b + "'>";

      $(".anadir").html(html);

    })



    //segundo intento Ajax

    $('#domicilio1').on("change", function () {
      if ($(this).is(':checked')) {
        html = '<div class="input-group mb-2">';
        html += '<input type="text" class="form-control" name="valor_domicilio" placeholder="digite el valor del domicio">'
        html += '</div>'
        html += '<div class="input-group mb-2">'
        html += '<input type="text" class="form-control" name="hora" placeholder="horas">'
        html += '<span class="input-group-text">||</span>'
        html += '<input type="text" class="form-control" name="minutos" placeholder="minutos">'
        html += '</div>';
        dato = 'holi'
        $('#add').append(html);
      } else {
        html = '';
        $('#add').html(html);
      }
    })





    $('#ilimitado1').on("change", function () {

      if ($(this).is(':checked')) {

        html = '<h5 style="color: red;">stock ilimitado</h5>'

        html += '<input type="hidden" class="form-control" name="stok" value="1000000" readonly>';

        $('#ilimitado').append(html);

      } else {

        html = '';

        $('#ilimitado').html(html);

      }

    })



    $(".btn-cancelarOferta").on("click", function () {

      var id = $(this).val();

      alertify.confirm("¿Estas seguro de Cancelar?", function (e) {

        $.ajax({

          url: base_url + "Ofertas/cancelarOferta",

          type: "POST",

          data: {

            id: id

          },

          success: function (data) {

            alertify.success('Ok');



            window.location.reload();

          }

        });

      });

    });



    // $(".btn-comprobantesub").on("click", function() {

    //     var id = $(this).val();

    //     $.ajax({

    //         url: base_url + "P2P/userData",

    //         type: "POST",

    //         dataType: "html",

    //         data: {

    //             id: id

    //         },

    //         success: function(data) {

    //             $("#mCo .modal-body").html(data);

    //             id[0].reset();

    //         }

    //     });

    // });



    $("input[data-type='currency']").on({

      keyup: function () {

        formatCurrency($(this));

      },



    });



    $("input[data-type='currency']").on({

      keyup: function () {

        formatCurrency($(this));

      },



    });



    function formatNumber(n) {

      // format number 1000000 to 1,234,567

      return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")

    }





    function formatCurrency(input, blur) {

      // appends $ to value, validates decimal side

      // and puts cursor back in right position.



      // get input value

      var input_val = input.val();



      // don't validate empty input

      if (input_val === "") {

        return;

      }



      // original length

      var original_len = input_val.length;



      // initial caret position 

      var caret_pos = input.prop("selectionStart");



      // check for decimal

      if (input_val.indexOf(".") >= 0) {



        // get position of first decimal

        // this prevents multiple decimals from

        // being entered



        // split number by decimal point

        var right_side = input_val.substring(decimal_pos);





        // validate right side

        right_side = formatNumber(right_side);



        // On blur make sure 2 numbers after decimal

        if (blur === "blur") {

          right_side += "";

        }



        // Limit decimal to only 2 digits

        right_side = right_side.substring(0, 2);



        // join number by .

        input_val = "$" + left_side + "." + right_side;



      } else {

        // no decimal entered

        // add commas to number

        // remove all non-digits

        input_val = formatNumber(input_val);

        input_val = "$" + input_val;



        // final formatting

        if (blur === "blur") {

          input_val += ".00";

        }

      }



      // send updated string to input

      input.val(input_val);



      // put caret back in the right position

      var updated_len = input_val.length;

      caret_pos = updated_len - original_len + caret_pos;

      input[0].setSelectionRange(caret_pos, caret_pos);

    }

  });

</script>

<!-- Convertidor divisas -->

<!-- <script src="<?= base_url() ?>dist/comercio/js/country-list.js"></script>

<script src="<?= base_url() ?>dist/comercio/js/script.js"></script> -->