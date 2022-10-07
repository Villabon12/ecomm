<!DOCTYPE html>
<html lang="en">

<head>
  <title skip-price>Tiindo</title>
  <meta name="description" content="Tiindo" />
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>wp-content/uploads/2022/05/favicon-cryptoce.png">

  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
  <link rel="stylesheet" href="<?= base_url() ?>asset/css/style.css">


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
    <?php if ($this->session->flashdata("error")) { ?>
      <div class="alert alert-danger">
        <p><?php echo $this->session->flashdata("error") ?></p>
      </div>
    <?php } ?>
    <div class="demoreg">
      <div class="login marg">

        <div class="centrot">
          <header>
            <h1 class="fonth1">REGISTRATE</h1>
          </header>

        </div>
        <div>
          <form class="form" action="<?= base_url() ?>index.php/Login/registrarNew" method="post" enctype="multipart/form-data">
            <div class="login__row">
              <input type="text" class="login__input name plac" placeholder="Nombre" name="nombre" required />
            </div>
            <div class="login__row">
              <input type="text" class="login__input name plac" placeholder="Apellido" name="apellido1" required />
            </div>
            <div class="login__row">
              <input type="email" class="login__input pass plac" placeholder="Correo" name="correo" required />
            </div>
            <div class="login__row">
              <input type="tel" class="login__input pass plac" placeholder="telefono" name="celular" required />
            </div>
            <div class="login__row">
              <input type="tel" class="login__input pass plac" placeholder="Num Referidor" name="id_papa_pago" required />
            </div>
            <div class="login__row">
              <input type="tel" class="login__input pass plac" placeholder="usuario" name="user" required />
            </div>
            <div class="login__row">
              <input type="password" class="login__input pass plac" placeholder="Contraseña" name="contrasena" required />
            </div>
            <div class="login__row">
              <input type="password" class="login__input pass plac" placeholder="Confirmacion de contraseña" name="contrasena1" required />
            </div>
            <div class="login__row">
              <label class="login__input name">Foto cedula parte delantera</label>
              <input type="file" class="login__input pass plac" name="img_cedula_front" required />
            </div>
            <div class="login__row">
              <label class="login__input name">Foto cedula parte trasera</label>
              <input type="file" class="login__input pass plac" name="img_cedula_back" required />
            </div>
            <div class="login__row">
              <label class="login__input name">Selfie de usuario</label>
              <input type="file" class="login__input pass plac" name="img_selfie" required />
            </div>
            <button type="submit" class="login__submit">Registrarse</button>
            <p class="login__signup">Ya tienes Cuenta? &nbsp;<a href="<?= base_url() ?>ingreso">Login</a></p>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- partial -->


</body>

</html>