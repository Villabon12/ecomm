<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Teko" />
    <link rel="shortcut icon" type="image/png" href="https://www.ecomm.com.co/dist/f.png">
    <title>Vista api</title>

    <style>
        pre {
            background-color: #f7f7f7;
            padding: 10px;
            border: 1px solid #ccc;
            font-size: 14px;
            font-family: monospace;
            white-space: pre;
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <br><br><br>
        <div class="card">
            <div class="container">
                <br>
                <h2 style="font-family:Teko; font-size: 250%">Integración de API</h2>
                <br>
                <p style="color: gray;">La integración API de E.pay le permite a tu negocio procesar transacciones desde
                    diferentes tipos de aplicaciones (web, móvil, IVR, etc).</p>
                <p style="color: gray;">Puedes conectar tu tienda en línea a la plataforma E.pay y el proceso de pago se
                    realizará en tu sitio web. Para integrar esta opción debes tener una cuenta ECOMM (comercio) y
                    conocimientos avanzados de programación.</p>
                <br>
                <img style="width: 40%; heigth: 40%;" src="http://localhost/Prueba/image/api.png">
                <br><br>
                <h2 style="font-family:Teko; font-size: 250%">Ajustes iniciales</h2>
                <br>
                <p style="color: gray;">E.Pay también permite integrarse con la pasarela transaccional y ofrece
                    herramientas
                    de pago disponibles y consultas para desarrollar un cliente HTTPS para enviar la información de la
                    transacción a través de SSL. Es igualmente fundamental que los datos confidenciales de las
                    transacciones, como el número de la tarjeta de crédito y la fecha de vencimiento, no se almacenen.
                    Se
                    recomienda seguir las mejores prácticas de PCI DSS (Payment Card Industry Data Security Standard)
                    para
                    garantizar la seguridad de las transacciones.</p>
                <p style="color: gray;">La transmisión de transacciones también está asegurada a través de una conexión
                    TLS
                    (Transport Layer Security) de 256 bits desde el servidor de la tienda a la pasarela de pago de
                    E.Pay. El
                    intercambio de mensajes se realiza a través de cadenas JSON y las operaciones se distinguen por un
                    comando que se incluye en la solicitud. Consulte el siguiente ejemplo de JSON para integrar su sitio
                    web
                    con E.Pay.</p>
                <br>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">JSON </a>
                    </li>
                </ul>
                <h6>POST /ecomm.com.co/api/ecommpay/search</h6>
                <h6>Host: ecomm.com.co/api/</h6>
                <h6>Tipo de contenido: application/json; charset=utf-8</h6>
                <h6>Aceptar: application/json</h6>
                <pre>
    {
        "apikey": "xxxxxxxxxxxxxxx",
        "secretkey": "xxxxxxxxxxxxxxx",
        "valor": xxxx
    }
                </pre>
                <br>
                <h2 style="font-family:Teko; font-size: 250%">Consideraciones</h2>
                <br>
                <ul>
                    <li style="color: gray;" type="disc">Debes tener una cuenta ECOMM (comercio) activa.</li>
                    <li style="color: gray;" type="disc">Debe instalar un certificado SSL válido en su servidor y su
                        sitio debe poder realizar conexiones SSL. Debido a esto, la máquina virtual debe tener las
                        extensiones de seguridad adecuadas.</li>
                    <li style="color: gray;" type="disc">Debe poder almacenar sus credenciales de autenticación (clave
                        de API e inicio de sesión de API) de forma segura.</li>
                    <li style="color: gray;" type="disc">Debe tener lenguajes de servidor como Java, C#, VB, PHP, etc.
                    </li>
                </ul>
            </div>
        </div>
        <br><br><br>
    </div>
</body>

</html>