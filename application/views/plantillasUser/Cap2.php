<!--
-----------------
https://github.com/ardacarofficial/links-website is open source project.
-----------------
-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>dist/f.png">
  <title>Plantilla Galactica</title>
  <meta name="description" content="List all your links on one website.">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&amp;display=swap">
  <link rel="stylesheet" href="<?= base_url() ?>reTemplate/Cap2/css/reset.css">
  <link rel="stylesheet" href="<?= base_url() ?>reTemplate/Cap2/css/style.css">
</head>


<div class="contenido">
  <h2>
    <header>
      <!-- Logo, Title and Description Codes Start -->
      <div class="header_img flex_column_center">
        <?php if ($sett->img_perfil == null) { ?>
          <img src=" <?= base_url() ?>reTemplate/Cap2/img/logo.png" alt="Logo" />
        <?php } else { ?>
          <img src=" <?= base_url() ?>reTemplate/imagenes/<?= $sett->img_perfil ?>" alt="Logo" />
        <?php } ?>
      </div>
      <div class="header_text flex_column_center">
        <h1 style="color:white;">
          <?= $perfil->nombre . " " . $perfil->apellido1 ?>
        </h1>
        <?php if ($sett->profesion == null) { ?>
          <h2 style="color:white;">Tu Profesión</h2>
        <?php } else { ?>
          <h2 style="color:white;">
            <?= $sett->profesion ?>
          </h2>
        <?php } ?>
      </div>
      <!-- Logo, Title and Description Codes End -->

      <!-- Social Media Icons Codes Start -->
      <div class="header_svg_list flex_row_center">
        <?php foreach ($links as $l) { ?>
          <!-- Icon 1 Codes -->
          <div class="header_svg_item">
            <a href="<?= $l->enlace ?>" target="_blank" rel="nofollow">
              <?= $l->icono ?>
            </a>
          </div>
        <?php } ?>
      </div>
      <!-- Social Media Icons Codes End -->
    </header>
    <main>
      <!-- Menu Container 1 Codes Start -->
      <section id="main_section_container_1" class="flex_column_center">
        <!-- Menu Text Item -->
        <div class="main_text_item">
          <?php if ($sett->descripcion == null) { ?>
            <p style="color:white;">Menu 1 text Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi
              molestiae
              nesciunt, exercitationem quaerat maxime non!</p>
          <?php } else { ?>
            <p style="color:white;">
              <?= $sett->descripcion ?>
            </p>
          <?php } ?>
        </div>
        <?php foreach ($links as $l) { ?>
          <!-- Menu Item -->
          <a class="main_a_item" href="<?= $l->enlace ?>" target="_blank" rel="nofollow">
            <?php if ($sett->colorBoton != null) { ?>
              <button class="main_button_item boton" style="background-color:<?= $sett->colorBoton ?>">
              <?php } else { ?>
                <button class="main_button_item">
                <?php } ?>
                <?= $l->nombreRed ?>
              </button>
          </a>
        <?php } ?>
      </section>
    </main>
    <footer>
      <div class="footer_div_item flex_row_center">
        <a class="footer_a_item" href="#link">
          <?= $perfil->nombre . " " . $perfil->apellido1 ?>
        </a>&nbsp;|
        Copyright Text
      </div>
    </footer>
  </h2>
</div>

</html>