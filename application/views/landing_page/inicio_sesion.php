<!DOCTYPE html>
<html lang="en">

<head>
  <title skip-price>Ecomm</title>
  <meta name="description" content="Ecomm" />
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>dist/f.png">

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

  <link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet">





  <!-- partial:index.partial.html -->
  <div class="cont">
    <div class="demo">
      <div class="login">
        <div class="container" style="padding-top: 65px;">
          <center>
            <img src="<?= base_url() ?>dist/favicon.png" width="280" height="120">
          </center>
        </div>
        <?php if ($this->session->flashdata("error") ) { ?>
            <p><?php echo $this->session->flashdata("error") ?></p>
        <?php } ?>
        <?php if ($this->session->flashdata("exito") ) { ?>
            <p><?php echo $this->session->flashdata("exito") ?></p>
        <?php } ?>
        <div class="login__form">
          <form class="form" action="<?= base_url() ?>Inicio_page/validaAcceso" method="post">
            <div class="login__row">
              <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
              </svg>
              <input type="text" class="login__input name" placeholder="Usuario" name="user" required />
            </div>
            <div class="login__row">
              <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
              </svg>
              <input type="password" class="login__input pass" placeholder="Contraseña" name="pass" required />
            </div>
            <button type="submit" class="login__submit">Iniciar Sesion</button>
            <!-- <p class="login__signup">No tienes Cuenta? &nbsp;<a href="<?= base_url() ?>Inicio_page/registro/10732">Registrate</a></p> -->
          </form>
          <div class="input-group">


          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- partial -->






</body>

</html>