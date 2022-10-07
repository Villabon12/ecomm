<!DOCTYPE html>
<html lang="en">

<head>
  <title skip-price>ECOMM - Registrar</title>
  <meta name="description" content="Tiindo" />
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>dist/f.png">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
  <link rel="stylesheet" href="<?= base_url() ?>asset/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>asset/comercio/style.css">
  <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>

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
    <div class="demoregi">
      <div class="login margen">
        <div class="centrot">
          <header>
            <h1 class="fonth1">REGISTRATE</h1>
            <?php if ($this->session->flashdata("error")) { ?>
              <div style="background-color: red;" class="alert alert-danger text-center">
                <p><?php echo $this->session->flashdata("error") ?></p>
              </div>
            <?php } ?>
          </header>
        </div>
        <select class="form-control" aria-label="Default select example" name="tipo" id="tipo" style="width: 100%; height :40px;">
          <option selected value="0">Eres?</option>
          <?php if ($perfil->verificar_user == "habilitado") { ?>
            <option value="1">Comercio</option>
            <option value="2">Socio</option>
          <?php } else { ?>
            <option value="2">Socio</option>
          <?php } ?>
        </select>
        <div id="add">
        </div>
      </div>

    </div>
  </div>
  <!-- partial -->

</body>
<script>
  $(document).ready(function() {
    var base_url = "<?= base_url() ?>";
    $('#tipo').on("change", function() {

      id = $(this).val();
      html = "";
      if (id == 1) {
        html = '<form class="form" action="<?= base_url() ?>Inicio_page/insertar_registrar/<?= $perfil->id ?>" method="post" enctype="multipart/form-data">';
        html += '<div class="login__row">'
        html += '<input type="text" class="login__input name plac" placeholder="Nombre Negocio" name="Nombre_nego"required  />'
        html += '<input type="hidden" name="tipo" value="Comercio"/>'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<input type="text" class="login__input name plac" placeholder="Nombre Encargado" name="Nombre_enca"required  />'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<input type="text" class="login__input name plac" placeholder="Apellido" name="Apellido1" required />'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<input type="email" class="login__input pass plac" placeholder="Correo" name="Correo" id="email" required  />'
        html += '<div id="verificar1"></div></div >'
        html += '<div class="login__row">'
        html += '<input type="number" class="login__input pass plac" placeholder="telefono" name="Telefono" required />'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<input type="text" class="login__input pass plac" placeholder="usuario" name="User" id="user" required/>'
        html += '<div id="verificar2"></div></div>'
        html += '<div class="login__row">'
        html += '<input type="password" class="login__input pass plac" placeholder="Contraseña" name="Contra" required/>'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<input type="password" class="login__input pass plac" placeholder="Confirmacion de contraseña" name="contra1" required />'
        html += '<div class="login__row">'
        html += '<select class="form-select lg-  7" aria-label="Default select example" required>'
        html += '<option selected>Tipo de persona</option>'
        html += '<option value="1">Juridica</option>'
        html += '<option value="2">Natural</option>'
        html += '</select>'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<select  aria-label="Default select example" style="width:450px" class="text-center" name="ciudad" required>'
        html += '<option selected> seleccione ciudad</option>'
        html += '<?php foreach ($departamentos as $d) { ?>'
        html += '<option value="<?= $d->municipio ?>" ><?= $d->municipio ?></option>'
        html += '<?php } ?>'
        html += '</select>'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<label class="login__input name">Foto cedula parte delantera</label>'
        html += '<input type="file" class="login__input pass plac" name="CC_front" required />'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<label class="login__input name">Foto cedula parte trasera</label>'
        html += '<input type="file" class="login__input pass plac" name="CC_back" required />'
        html += '</div>'
        html += '<div class="login__row">'
        html += ' <label class="login__input name">Foto Camara y comercio o RUT</label>'
        html += '<input type="file" class="login__input pass plac" name="RUT"  required/>'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<?php echo $this->session->flashdata('reco'); ?>'
        html += '</div>'
        html += '<button type="submit" class="login__submit">Registrarse</button>'
        html += '<p class="login__signup">Ya tienes Cuenta? &nbsp;<a href="<?= base_url() ?>Inicio_page/login">Login</a></p>'
        html += '</form>'

        $('#add').html(html);
      } else if (id == 2) {
        html = '<form class="form" action="<?= base_url() ?>Inicio_page/insertar_registrar/<?= $perfil->id ?>" method="post" enctype="multipart/form-data">';
        html += '<div class="login__row">'
        html += '<input type="text" class="login__input name plac" placeholder="Nombre" name="Nombre_enca" required/>'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<input type="text" class="login__input name plac" placeholder="Apellido" name="Apellido1" required/>'
        html += '<input type="hidden" name="tipo" value="Socio"/>'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<input type="number" class="login__input pass plac" placeholder="cedula" name="cedula" required />'
        html += '</div >'
        html += '<div class="login__row">'
        html += '<input type="email" class="login__input pass plac" placeholder="Correo" name="Correo" id="email" required />'
        html += '<div id="verificar1"></div> </div >'
        html += '<div class="login__row">'
        html += '<input type="number" class="login__input pass plac" placeholder="telefono" name="Telefono" required />'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<input type="text" class="login__input pass plac" placeholder="usuario" name="User" id="user" required />'
        html += '<div id="verificar2"></div></div>'
        html += '<div class="login__row">'
        html += '<input type="password" class="login__input pass plac" placeholder="Contraseña" name="Contra" required  />'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<input type="password" class="login__input pass plac" placeholder="Confirmacion de contraseña" name="contra1" required  />'
        html += '<div class="login__row">'
        html += '<select  aria-label="Default select example" style="width:450px" class="text-center" name="ciudad" required>'
        html += '<option selected> seleccione ciudad</option>'
        html += '<?php foreach ($departamentos as $d) { ?>'
        html += '<option value="<?= $d->municipio ?>" ><?= $d->municipio ?></option>'
        html += '<?php } ?>'
        html += '</select>'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<label class="login__input name">Foto cedula parte delantera</label>'
        html += '<input type="file" class="login__input pass plac" name="CC_front"required  />'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<label class="login__input name">Foto cedula parte trasera</label>'
        html += '<input type="file" class="login__input pass plac" name="CC_back" required />'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<<label class="login__input name">Selfie de usuario</label>'
        html += '<input type="file" class="login__input pass plac" name="img_selfie" required />'
        html += '</div>'
        html += '<div class="login__row">'
        html += '<?php echo $this->session->flashdata('reco'); ?>'
        html += '</div>'
        html += '<button type="submit" class="login__submit">Registrarse</button>'
        html += '<p class="login__signup">Ya tienes Cuenta? &nbsp;<a href="<?= base_url() ?>Inicio_page/login">Login</a></p>'
        html += '</form>'
        $('#add').html(html);
      } else {
        html = '';
        $('#add').html(html);
      }
    })

    $("#email").keyup(function() {
      var data = $(this).val()
      $.ajax({
        url: '<?= base_url() ?>Inicio_page/validarCorreo',
        type: "POST",
        data: {
          email: data
        },
        success: function(resp) {
          html = '<h2 style="color:red;">' + resp + '</h2>';
          $('#verificar1').html(html);
        }
      })
    })
    $("#user").keyup(function() {
      var data = $(this).val()
      $.ajax({
        url: '<?= base_url() ?>Inicio_page/validarUser',
        type: "POST",
        data: {
          usuario: data
        },
        success: function(resp) {
          html = '<h2 style="color:red;">' + resp + '</h2>';
          $('#verificar2').html(html);
        }
      })
    })

  })
</script>

</html>