<?php

use App\Router;

$router = new Router();

//Rotas públicas metodo GET
$router->get('', 'HomeController@index');
$router->get('sobre', 'HomeController@sobre');

// Rota para documentação
$router->get('documentacao', 'DocumentacaoController@index');

return $router;