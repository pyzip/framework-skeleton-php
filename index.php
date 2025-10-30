<?php


require_once __DIR__ . '/config/env.php';
loadEnv(__DIR__ . '/.env');

$config = require __DIR__ . '/config.php';

// Define o nome da sessão a partir do .env/config.php
if (!empty($config['session']['name'])) {
	session_name($config['session']['name']);
}

session_start(); //iniciar a sessão

require __DIR__ . '/vendor/autoload.php';

use App\Core\Request;
use App\Core\Response;

$router = require __DIR__ . '/routes/web.php';

$request = new Request();
$response = new Response();

$hasError = false;
try {
	$router->dispatch($request, $response);
} catch (Throwable $e) {
	$hasError = true;
	$response->setStatusCode(500);
	$response->renderView('errors/500');
	$response->send();
	// Opcional: log do erro
	// error_log($e);
}