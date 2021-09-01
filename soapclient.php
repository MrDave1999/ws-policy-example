<?php 
require_once 'vendor/autoload.php';
if(count($argv) === 3)
{
   echo 'Error: You must pass three argument to the script!'. "\n";
   exit();
}
// Esta es la dirección URL de su servidor de servicios web WSDL
$wsdl = $_ENV['BASE_URI'];

// Crear objeto cliente
$client = new nusoap_client($wsdl, 'wsdl');
$err = $client->getError();
if ($err) 
{
   echo 'Error: ' . $err;
   // En este punto, sabes que la llamada que sigue fallará
   exit();
}

// Indicamos los parámetros de la función
$params = [
	'username' 	=> 	$argv[1], 
	'password' 	=> 	$argv[2], 
	'crypto_algorithm' => $argv[3]
];

// Llama al método "create_user_account"
$result = $client->call('create_user_account', $params);
$err = $client->getError();
if($err)
{
   echo 'Error: ' . $err;
   exit();
}
var_dump($result);

/*
echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
// Display the debug messages
echo '<h2>Debug</h2>';
echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
*/
