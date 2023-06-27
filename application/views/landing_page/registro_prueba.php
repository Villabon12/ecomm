<!DOCTYPE html>
<html lang="en">

<head>
  <title skip-price>ECOMM - Registrar</title>
  <meta name="description" content="Tiindo" />
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>dist/f.png">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
  <link rel="stylesheet" href="<?= base_url() ?>asset/comercio/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>asset/css/style.css">
  <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet">

  <script type="text/javascript">
    $(document).ready(function() {
      $('body').hide();
      $('body').fadeIn(2000);
    });
  </script>


</head>

<body>

  <!-- partial:index.partial.html -->
  <div class="cont">
    <div class="demoregi">
      <div class="login margen">
        <h1 style="color: yellow;">REGÍSTRATE</h1>
        <?php if ($this->session->flashdata("error")) { ?>
          <p><?php echo $this->session->flashdata("error") ?></p>
        <?php } ?>
        <form class="form" action="<?= base_url() ?>Inicio_page/insertarprueba" method="post" enctype="multipart/form-data">
          <div class="login__row">
            <input type="text" class="login__input name plac" placeholder="Nombre" name="Nombre_enca"  />
          </div>
          <div class="login__row">
            <input type="text" class="login__input name plac" placeholder="Apellido" name="Apellido1"  />
            <input type="hidden" name="tipo" value="Socio" />'
          </div>
          <div class="login__row">
            <input type="number" class="login__input pass plac" placeholder="Cédula" name="cedula" id="cedula"  />
            <div id="verificar3"></div>
          </div>
          <div class="login__row">
            <input type="email" class="login__input pass plac" placeholder="Correo" name="Correo" id="email"  />
            <div id="verificar1"></div>
          </div>
          <div class="login__row">
            <input type="number" class="login__input pass plac" placeholder="Telefono" name="Telefono"  />
          </div>
          <div class="login__row">
            <input type="text" class="login__input pass plac" placeholder="Usuario" name="User" id="user"  />
            <div id="verificar2"></div>
          </div>
          <div class="login__row">
            <input type="password" class="login__input pass plac" placeholder="Contraseña" name="Contra"  />
          </div>
          <div class="login__row">
            <input type="password" class="login__input pass plac" placeholder="Confirmación de contraseña" name="contra1"  />
          </div>
          <div class="login__row">
            <select aria-label="Default select example" style="width:450px" class="text-center" name="ciudad" >
              <option selected> seleccione ciudad</option>
              <?php foreach ($departamentos as $d) { ?>
                <option value="<?= $d->municipio ?>"><?= $d->municipio ?></option>
              <?php } ?>
            </select>
          </div>
          <button type="submit" class="login__submit">Registrarse</button>
        </form>
      </div>

    </div>
  </div>
  <!-- partial -->

</body>
<script>
  $(document).ready(function() {
    var base_url = "<?= base_url() ?>";

    $("#email").keyup(function() {
      var email = $(this).val()
      $.ajax({
        url: '<?= base_url() ?>Inicio_page/validarCorreo',
        type: "POST",
        data: {
          email: email
        },
        success: function(resp) {
          html = '<h5 style="color:red;">' + resp + '</h5>';
          $('#verificar1').html(html);
        }
      })
    })
    $("#user").keyup(function() {
      var usuario = $(this).val()
      $.ajax({
        url: '<?= base_url() ?>Inicio_page/validarUser',
        type: "POST",
        data: {
          usuario: usuario
        },
        success: function(resp) {
          html = '<h5 style="color:red;">' + resp + '</h5>';
          $('#verificar2').html(html);
        }
      })
    })
    $("#cedula").keyup(function() {
      var cedula = $(this).val()
      $.ajax({
        url: '<?= base_url() ?>Inicio_page/validarCedula',
        type: "POST",
        data: {
          cedula: cedula
        },
        success: function(resp) {
          html = '<h5 style="color:red;">' + resp + '</h5>';
          $('#verificar3').html(html);
        }
      })
    })

    const MAXIMO_TAMANIO_BYTES = 3000000; // 1MB = 1 millón de bytes

    // Obtener referencia al elemento
    const $miInput = document.querySelector("#miInput");

    $miInput.addEventListener("change", function() {
      // si no hay archivos, regresamos
      if (this.files.length <= 0) return;

      // Validamos el primer archivo únicamente
      const archivo = this.files[0];
      if (archivo.size > MAXIMO_TAMANIO_BYTES) {
        const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
        alert(`El tamaño máximo es ${tamanioEnMb} MB`);
        // Limpiar
        $miInput.value = "";
      } else {
        // Validación pasada. Envía el formulario o haz lo que tengas que hacer
      }
    });
    const $miInput2 = document.querySelector("#miInput2");

    $miInput2.addEventListener("change", function() {
      // si no hay archivos, regresamos
      if (this.files.length <= 0) return;

      // Validamos el primer archivo únicamente
      const archivo = this.files[0];
      if (archivo.size > MAXIMO_TAMANIO_BYTES) {
        const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
        alert(`El tamaño máximo es ${tamanioEnMb} MB`);
        // Limpiar
        $miInput2.value = "";
      } else {
        // Validación pasada. Envía el formulario o haz lo que tengas que hacer
      }
    });
    const $miInput3 = document.querySelector("#miInput3");

    $miInput3.addEventListener("change", function() {
      // si no hay archivos, regresamos
      if (this.files.length <= 0) return;

      // Validamos el primer archivo únicamente
      const archivo = this.files[0];
      if (archivo.size > MAXIMO_TAMANIO_BYTES) {
        const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
        alert(`El tamaño máximo es ${tamanioEnMb} MB`);
        // Limpiar
        $miInput3.value = "";
      } else {
        // Validación pasada. Envía el formulario o haz lo que tengas que hacer
      }
    });

  })
</script>

</html>