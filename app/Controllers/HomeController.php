<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        $response->renderView('home');
        $response->send();
    }

    public function sobre(Request $request, Response $response)
    {
        $response->renderView('sobre');
        $response->send();
    }
}