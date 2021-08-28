<?php
require_once 'response.php';

function create_user_account(string $username, string $password, string $crypto_algorithm) 
{
	$crypto_algorithm = strtolower($crypto_algorithm);
	$result = encrypt_passwd($crypto_algorithm, $password);
	if(!$result)
		return response_soap(false, $crypto_algorithm . ' is not in the webservice policies. Please check the WSDL file');
	
	error_reporting(0);
	$mysqli = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
	if($mysqli->connect_error)
		return response_soap(false, 'Failed connection: ' . $mysqli->connect_error);
	
	$stmt = $mysqli->prepare("INSERT INTO users(username, password, crypto_algorithm) VALUES (?,?,?)");
	if(!$stmt)
		return response_soap(false, 'Preparation failed: ' . $mysqli->error);
	
	$password = $result;
	if (!$stmt->bind_param("sss", $username, $password, $crypto_algorithm))
		return response_soap(false, 'Parameter binding failed: ' . $stmt->error);

	if (!$stmt->execute()) 
		return response_soap(false, 'Failed execution: ' . $stmt->error);
	
	$stmt->close();
	$mysqli->close();
	
   return response_soap(true, 'User successfully created!');
}

function encrypt_passwd(string $crypto_algorithm, string $password)
{
	switch($crypto_algorithm)
	{
		case 'sha1':
			return hash('sha1', $password);
		case 'sha256':
			return hash('sha256', $password);
		case 'aes128':
			return openssl_encrypt($password, 'AES-128-CBC', random_bytes(16), 0, random_bytes(16));
		case 'aes256':
			return openssl_encrypt($password, 'AES-256-CBC', random_bytes(32), 0, random_bytes(16));
	}
	return false;
}