<?php
require_once './lib/nusoap.php';
require_once './user.php';

// Crear la instancia del servidor
$server = new soap_server('user.wsdl');

// Usar la solicitud para invocar el servicio
$server->service(file_get_contents('php://input'));
