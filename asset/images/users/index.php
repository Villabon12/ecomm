<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php


// muestra caracter por caracter de lo que hay en el arreglo
$cadena="Esta es la frase donde haremos la búsqueda";
 
for($i=0;$i<strlen($cadena);$i++)
{
    	echo "<br>".$cadena[$i];
}





//encuentra la palabra y la pocision de donde se encuentra
$cadena_de_texto = 'Esta es la frase donde haremos la búsqueda';
$cadena_buscada   = 'la';
$posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);

if ($posicion_coincidencia === false) {
    echo "NO se ha encontrado la palabra deseada!!!!";
    } else {
            echo "Éxito!!! Se ha encontrado la palabra buscada en la posición: ".$posicion_coincidencia;
            }

$posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada, 20);
if ($posicion_coincidencia === false) {
    echo "NO se ha encontrado la palabra deseada!!!!";
    } else {
            echo "Éxito!!! Se ha encontrado la palabra buscada en la posición: ".$posicion_coincidencia;
            }

?>
    
</body>
</html>