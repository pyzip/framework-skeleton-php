<?php

namespace App\Core;

class Response
{

    /**
     * Código HTTP da resposta
     * @var int
     */
    private int $statusCode = 200;

    /**
     * Cabeçalhos HTTP a serem enviados
     * @var array
     */
    private array $headers = [];

    /**
     * Conteúdo da resposta
     * @var mixed
     */
    private mixed $body = null;

    /**
     * Define o código HTTP da resposta
     * @param int $code
     * @return void
     */
    public function setStatusCode(int $code): void
    {
        $this->statusCode = $code;
        http_response_code($code);
    }

    /**
     * Adiciona ou substitui um header HTTP
     * @param string $key
     * @param string $value
     * @return void
     */
    public function setHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
        if (!headers_sent()) {
            header("$key: $value");
        }
    }

    /**
     * Renderiza uma view e armazena o conteúdo no body
     * @param string $view Nome da view (sem .php)
     * @param array $data Variáveis a serem extraídas para a view
     * @return void
     */
    public function renderView(string $view, array $data = []): void
    {
        $basePath = __DIR__ . '/../../app/Views/';
        $viewPath = $basePath . $view . '.php';

        if (!file_exists($viewPath)) {
            $this->setStatusCode(404);
            $this->body = "404 - View not found";
            return;
        }

        // Extrai as variáveis do array $data para uso na view
        if (!empty($data)) {
            extract($data, EXTR_SKIP);
        }
        ob_start();
        include $viewPath;
        $this->body = ob_get_clean();
    }

    /**
     * Redireciona para uma URL
     * @param string $url
     * @param int $statusCode
     * @return void
     */
    public function redirect(string $url, int $statusCode = 302): void
    {
        $this->setStatusCode($statusCode);
        if (!headers_sent()) {
            header("Location: $url", true, $statusCode);
        }
        exit(); // Garante que o script pare após o redirecionamento
    }

    /**
     * Envia resposta JSON
     * @param array $data
     * @param int $statusCode
     * @return void
     */
    public function json(array $data, int $statusCode = 200): void
    {
        $this->setStatusCode($statusCode);
        $this->setHeader('Content-Type', 'application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit(); // Garante que o script pare após o envio da resposta JSON
    }

    /**
     * Envia qualquer conteúdo definido como $body
     * @param mixed|null $body
     * @return void
     */
    public function send(mixed $body = null): void
    {
        if ($body !== null) {
            $this->body = $body;
        }

        if ($this->body !== null) {
            echo $this->body;
        }
    }
}
