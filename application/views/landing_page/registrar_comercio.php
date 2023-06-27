<!DOCTYPE html>

<html lang="en">



<head>

  <title skip-price>Ecomm</title>

  <meta name="description" content="Ecomm" />

  <meta charset="UTF-8">

  <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>dist/f.png">



  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">

  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>

  <link rel="stylesheet" href="<?= base_url() ?>asset/comercio/style.css">

  <link rel="stylesheet" href="<?= base_url() ?>asset/css/style.css">





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

        <h1 style="color: yellow;">REGISTRATE</h1>

        <?php if ($this->session->flashdata("error")) { ?>

          <div style="background-color: red;" class="alert alert-danger text-center">

            <p><?php echo $this->session->flashdata("error") ?></p>

          </div>

        <?php } ?>

        <form class="form" action="<?= base_url() ?>Inicio_page/insertar_registrar/<?= $perfil->id ?>" method="post" enctype="multipart/form-data">

          <div class="login__row">

            <input type="text" class="login__input name plac" placeholder="Nombre Negocio" name="Nombre_nego" required />

            <input type="hidden" name="tipo" value="Comercio" />

          </div>

          <div class="login__row">

            <input type="text" class="login__input name plac" placeholder="Nombre Encargado" name="Nombre_enca" required />

          </div>

          <div class="login__row">

            <input type="text" class="login__input name plac" placeholder="Apellido" name="Apellido1" required />

          </div>

          <div class="login__row">

            <input type="number" class="login__input pass plac" placeholder="NIT" name="cedula" id="cedula" required />

            <div id="verificar3"></div>

          </div>

          <div class="login__row">

            <input type="email" class="login__input pass plac" placeholder="Correo" name="Correo" id="email" required />

            <div id="verificar1"></div>

          </div>

          <div class="login__row">

            <input type="number" class="login__input pass plac" placeholder="telefono" name="Telefono" required />

          </div>

          <div class="login__row">

            <input type="text" class="login__input pass plac" placeholder="usuario" name="User" id="user" required />

            <div id="verificar2"></div>

          </div>

          <div class="login__row">

            <input type="password" class="login__input pass plac" placeholder="Contraseña" name="Contra" required />

          </div>

          <div class="login__row">

            <input type="password" class="login__input pass plac" placeholder="Confirmacion de contraseña" name="contra1" required />

          </div>

          <div class="login__row">

          <select aria-label="Default select example" style="width:450px" class="text-center" name="persona" required>

              <option selected>Tipo de persona</option>

              <option value="1">Juridica</option>

              <option value="2">Natural</option>

            </select>

          </div>

          <div class="login__row">

            <select aria-label="Default select example" style="width:450px" class="text-center" name="ciudad" required>

              <option selected> seleccione ciudad</option>

              <?php foreach ($departamentos as $d) { ?>

                <option value="<?= $d->municipio ?>"><?= $d->municipio ?></option>

              <?php } ?>

            </select>

          </div>

          <button type="submit" class="login__submit">Registrarse</button>

          <p class="login__signup">Ya tienes Cuenta? &nbsp;<a href="<?= base_url() ?>Inicio_page/login">Login</a></p>

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
  })

</script>



</html>