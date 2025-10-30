<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;

class DocumentacaoController
{
    public function index(Request $request, Response $response)
    {
        $response->renderView('documentacao');
        $response->send();
    }
}
