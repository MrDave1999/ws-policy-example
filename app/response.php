<?php 
function response_soap($success, $message)
{
	return	[
		'success' => $success,
		'message' => $message
	];
}