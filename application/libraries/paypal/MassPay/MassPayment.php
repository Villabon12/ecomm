<?php
require_once('../PPBootStrap.php');
$massPayRequest = new MassPayRequestType();
$massPayRequest->MassPayItem = array();
for ($i = 0; $i < count($_REQUEST['mail']); $i++) {
    $masspayItem = new MassPayRequestItemType();
    $masspayItem->Amount = new BasicAmountType($_REQUEST['currencyCode'][$i], $_REQUEST['amount'][$i]);
    $masspayItem->ReceiverEmail = $_REQUEST['mail'][$i];
    $massPayRequest->MassPayItem[] = $masspayItem;
}

$massPayReq = new MassPayReq();
$massPayReq->MassPayRequest = $massPayRequest;

$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());


try {
    /* wrap API method calls on the service object with a try catch */
    $massPayResponse = $paypalService->MassPay($massPayReq);
} catch (Exception $ex) {
    include_once("Error.php");
    exit;
}
if (isset($massPayResponse)) {
    ?>
    <html>
        <head>
            <title>Paypal Mass Payment in PHP</title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <meta name="robots" content="noindex, nofollow">
            <script type="text/javascript">
                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-43981329-1']);
                _gaq.push(['_trackPageview']);
                (function() {
                    var ga = document.createElement('script');
                    ga.type = 'text/javascript';
                    ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(ga, s);
                })();
            </script>
        </head>
        <body>

            <div id="main">
                <div class="success_main_heading"> 
                    <h1>Paypal Mass Payment in PHP</h1>
                </div>
                <div id="return">
                    <h2>Payment Status </h2>
                    <hr/>

                    <?php
                    //Rechecking the product price and currency details
                    if ($massPayResponse->Ack == 'Success') {
                        echo "<h3 id='success'>Payment Successful</h3>";
                        echo "<P>Transaction Status - Completed</P>";
                        echo "<P>CorrelationID - " . $massPayResponse->CorrelationID . "</P>";
                        echo "<div class='back_btn'><a  href='index.php' id= 'btn'><< Back </a></div>";
                    } else {
                        echo "<h3 id='fail'>Payment Failed</h3>";
                        echo "<P>Transaction Status - Unompleted</P>";
                        echo "<P>Error Message -" . $massPayResponse->Errors[0]->LongMessage . "</P>";
                        echo "<div class='back_btn'><a  href='index.php' id= 'btn'><< Back </a></div>";
                    }
                    ?>
                </div>

                <!-- Right side div -->
                <div class="fr"id="formget">
                    <a href=http://www.formget.com/app><img style="margin-left: 12%;" src="images/formget.jpg" alt="Online Form Builder"/></a>
                </div>
            </div>
        </body>
    </html>
    <?php }
?>

