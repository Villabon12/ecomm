<?php
class Configuration
{
  // For a full list of configuration parameters refer in wiki page (https://github.com/paypal/sdk-core-php/wiki/Configuring-the-SDK)
  public static function getConfig()
  {
    $config = array(
        // values: 'sandbox' for testing
        //       'live' for production
        "mode" => "live",
        'log.LogEnabled' => true,
        'log.FileName' => '../PayPal.log',
        'log.LogLevel' => 'FINE'

        // These values are defaulted in SDK. If you want to override default values, uncomment it and add your value.
        // "http.ConnectionTimeOut" => "5000",
        // "http.Retry" => "2",

    );
    return $config;
  }

  // Creates a configuration array containing credentials and other required configuration parameters.
  public static function getAcctAndConfig()
  {
    $config = array(
        // Signature Credential
        "acct1.UserName" => "payments_api1.tiindo.com",//"leo_empresas_api1.gmail.com",
        "acct1.Password" => "QAG8SZTGSJVKPJC6",//"KV7PPZR5AKU4SM68",
        "acct1.Signature" => "AWlTgeKUUzSYtVbhVW5akp4cygorAE9I4Sa3eTB6NVO4gIHjViUEoitU",//"AkNES1CGU.I75ypuC-.44iFFK.4CAL8vrF2EngeMyHyP85j5IRA3xXMa",

        //"acct1.UserName" => "correo-facilitator_api1.jorgenio.com",
        //"acct1.Password" => "BRYVUHB46RJYVSPB",
        //"acct1.Signature" => "A9LC3Qajo-H2V8mPq4eIktgPvG2RAZUtmdaquSxMYkF.2.WX1OMGzO1O",
    	// Subject is optional and is required only in case of third party authorization
    	//"acct1.Subject" => "",

        // Sample Certificate Credential
        // "acct1.UserName" => "certuser_biz_api1.paypal.com",
        // "acct1.Password" => "D6JNKKULHN3G5B8A",
        // Certificate path relative to config folder or absolute path in file system
        // "acct1.CertPath" => "cert_key.pem",
        // "acct1.AppId" => "APP-80W284485P519543T"
        );

    return array_merge($config, self::getConfig());;
  }

}
