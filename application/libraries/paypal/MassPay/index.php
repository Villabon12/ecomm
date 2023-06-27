<?php
$image_err = "";
$uploadOk = 0;
//Validation for Account Holders File (File should be csv or txt)
if (!empty($_FILES["up_file"])) {
    $uploadOk = 1;
    $imageFileType = pathinfo(basename($_FILES["up_file"]["name"]), PATHINFO_EXTENSION);
    if ($imageFileType != "csv" && $imageFileType != "txt") {
        $image_err = "Sorry, only .csv, .txt files are allowed.";
        $uploadOk = 0;
    }
}
?>
<html>
    <head>
        <title>Paypal Mass Payment in PHP</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="css/flexslider.css" type="text/css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/popup-style.css" />
    </head>
    <body>
        <div id = "main">
            <h1>PayPal Mass Payment in PHP</h1>
            <div id = "container">
                <h2>Send Payments to Many Recipients</h2>
                <hr/>
                <div class="fg-row">
                    <form action="index.php" method="post" id="myform" enctype="multipart/form-data">
                        <label class="block fg-label">Import File of Account Holders <a href="account_holders_detail.csv">(Download Sample .csv)</a></label>
                        <div class="fg-upload-parent">
                            <input id="up_file" type="file" class="file1" name="up_file" style="visibility:hidden; height:0px !important;" >  
                            <input class="fg-input text inline_path" id="import_file_text" placeholder="" type="text" onclick="document.getElementById('up_file').click();" value="<?php echo (!empty($_FILES["up_file"]["name"])) ? $_FILES["up_file"]["name"] : ''; ?>" readonly>
                            <span class="fg-upload-btn" onclick="document.getElementById('up_file').click();"><i class="fa fa-folder-open"></i> Choose File</span>
                            <div class="fg-clear"></div>
                        </div>
                        <p class="fg-help red"><?php echo $image_err; ?></p>
                    </form>
                </div>
                <?php if ($uploadOk === 1) { ?>
                    <div id="holders">
                        <form action="MassPayment.php" method="POST">
                            <table id="results" >
                                <thead>
                                    <tr class="head">
                                        <th>Sno.</th>
                                        <th>Name</th>
                                        <th>Mail Address</th>
                                        <th>Amount</th>
                                        <th>Currency Code</th>
                                    </tr>
                                </thead>
                                <?php
                                //Getting data from csv or txt file
                                $csv = array_map('str_getcsv', file($_FILES["up_file"]["tmp_name"]));
                                $i = 0;
                                foreach ($csv as $v1) {
                                    ?>
                                    <tbody>
                                        <tr class="row-data unread_new">
                                            <td><?php echo ++$i; ?></td>
                                            <td><?php echo $v1[0]; ?></td>
                                            <td>
                                                <?php echo $v1[1]; ?>
                                                <input type="hidden" name="mail[]" value="<?php echo $v1[1]; ?>"/>
                                            </td>
                                            <td>
                                                <?php echo $v1[2]; ?>
                                                <input type="hidden" name="amount[]" value="<?php echo $v1[2]; ?>"/>
                                            </td>

                                            <td>
                                                <?php echo $v1[3]; ?>
                                                <input type="hidden" name="currencyCode[]" value="<?php echo $v1[3]; ?>"/>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php
                                }
                                ?> 
                            </table>
                            <input type="submit" id="submit"  value="PayNow">
                        </form>
                    </div>
                <?php } ?>
            </div>

            <img id="paypal_logo" style="margin-left: 722px;" src="images/secure-paypal-logo.jpg">
        </div>
        <div id="pop2" class="simplePopup">
            <div id="loader"><img src="images/ajax-loader.gif"/><img id="processing_animation" src="images/processing_animation.gif"/></div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script type="text/javascript">
                                $(document).ready(function() {
                                    $('#up_file').change(function() {
                                        document.getElementById('import_file_text').value = $('#up_file').val();
                                        document.getElementById('myform').submit();
                                    });

                                });
        </script>
        <script src="js/jquery.simplePopup.js" type="text/javascript"></script>
        <script type="text/javascript">
                                $(document).ready(function() {
                                    $('input#submit').click(function() {
                                        $('#pop2').simplePopup();
                                    });
                                });
        </script>
    </body>
</html>
