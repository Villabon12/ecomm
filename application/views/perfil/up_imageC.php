<!DOCTYPE html>

<html lang="en">



<head>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Ecomm</title>

    <!-- plugins:css -->

    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/feather/feather.css">

    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/mdi/css/materialdesignicons.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/ti-icons/css/themify-icons.css">

    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/typicons/typicons.css">

    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/simple-line-icons/css/simple-line-icons.css">

    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/css/vendor.bundle.base.css">

    <!-- endinject -->

    <!-- Plugin css for this page -->

    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/datatables.net-bs4/dataTables.bootstrap4.css">

    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/js/select.dataTables.min.css">

    <!-- End plugin css for this page -->

    <!-- inject:css -->

    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/css/vertical-layout-light/style.css">

    <!-- endinject -->

    <link rel="shortcut icon" href="<?= base_url() ?>dist/f.png" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <style type="text/css">
        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }


        .error {
            color: #E13300;
        }

        .success {
            color: darkgreen;
        }
    </style>
</head>

<body>
    <div class="main-panel">
        <center>


            <?php if ($this->session->flashdata("error")) { ?>



                <p><?php echo $this->session->flashdata("error") ?></p>



            <?php } ?>


            <h2>Escoge cédula frontal</h2>
            <?php
            if (isset($success) && strlen($success)) {
                echo '<div class="success">';
                echo '<p>' . $success . '</p>';
                echo '</div>';
            }
            if (isset($errors) && strlen($errors)) {
                echo '<div class="error">';
                echo '<p>' . $errors . '</p>';
                echo '</div>';
            }
            if (validation_errors()) {
                echo validation_errors('<div class="error">', '</div>');
            }
            if (isset($resize_img)) {
                redirect(base_url("Perfil/updateCuenta2/" . $perfil->id));
            }
            ?>
            <?php
            $attributes = array('name' => 'image_upload_form', 'id' => 'image_upload_form');
            echo form_open_multipart($this->uri->uri_string(), $attributes);
            ?>
            <p><input accept="image/*" name="image_name" class="form-control" id="image_name" readonly="readonly" type="file" /></p>
            <p><input name="image_resize" class="btn btn-primary" value="Upload Image" type="submit" /></p>
            <?php
            echo form_close();
            ?>
        </center>
    </div>

</body>

</html>