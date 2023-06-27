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
            <img src="<?= base_url() ?>dist/favicon.png" width="70%" height="50%">
          </center>
        </div>
        <?php if ($this->session->flashdata("error") ) { ?>
            <p><?php echo $this->session->flashdata("error") ?></p>
        <?php } ?>
        <div class="login__form">
          <form class="form" action="<?= base_url() ?>Ecommpay/acceptPay" method="post">
            <h3 style="color:white;"><?= $perfil->nombre . " ". $perfil->apellido1 ?> estas seguro que deseas pagar por ecomm el valor de $<?= number_format($valor,0) ?></h3>
            <button type="submit" class="login__submit">Aceptar</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- partial -->






</body>

</html>