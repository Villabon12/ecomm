<!DOCTYPE html>

<html lang="en">



<head>

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


            <h1>Ecomm</h1>

            <p>Escoge cédula frontal</p>
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
                redirect(base_url("Probar/updateCuenta"));
            }
            ?>
            <?php
            $attributes = array('name' => 'image_upload_form', 'id' => 'image_upload_form');
            echo form_open_multipart($this->uri->uri_string(), $attributes);
            ?>
            <p><input name="image_name" class="form-control" id="image_name" readonly="readonly" type="file" /></p>
            <p><input name="image_resize" class="btn btn-primary" value="Upload Image" type="submit" /></p>
            <?php
            echo form_close();
            ?>
        </center>
    </div>

</body>

</html>