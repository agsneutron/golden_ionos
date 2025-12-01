<?php

$fecha = date('Y-m-d');


$url = "http://tintoreriagolden.com/api/pendingDeliveries";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//a true, obtendremos una respuesta de la url, en otro caso, 
//true si es correcto, false si no lo es
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//establecemos el verbo http que queremos utilizar para la petición
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
//curl_setopt($ch, CURLOPT_POSTFIELDS,"username=myname&password=mypass");
//curl_setopt($ch, CURLOPT_POSTFIELDS, POST DATA);
$result = curl_exec($ch);

echo $result;

curl_close($ch);

?>