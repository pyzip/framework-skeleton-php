<?php

namespace App\Core;

class Request
{
    /**
     * // Método HTTP (GET, POST, etc.)
     * @var string
     */
    protected string $method;
    
    /**
     * Caminho da URI requisitada (sem dominio e query string)
     * @var string
     */
    protected string $uri;

    /**
     * Parâmetros extraídos da rota (Ex: /user/{id})
     * @var array
     */
    protected array $routeParams = [];

    /**
     * Construtor: inicializa método, URI e parâmetros
     * @param string|null $method
     * @param string|null $uri
     * @param array $routeParams
     */
    public function __construct(?string $method = null, ?string $uri = null, array $routeParams = [])
    {
        $this->method = $method ?? ($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $uriValue = $uri ?? ($_SERVER['REQUEST_URI'] ?? '/');
        $this->uri = trim(parse_url($uriValue, PHP_URL_PATH), '/');
        $this->routeParams = is_array($routeParams) ? $routeParams : [];
    }

    /**
     * Retorna o método HTTP utilizado (GET, POST, etc.)
     * @return string
     */
    public function getMethod() : string
    {
        return strtoupper($this->method);
    }

    /**
     * Retorna a URI requisitada, já normalizada (sem barra no final)
     * @return string
     */
    public function getUri() : string
    {
        return $this->uri;
    }

    /**
     * Define parâmetros da rota
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setRouteParam(string $key, mixed $value) : void
    {
        $this->routeParams[$key] = $value;
    }

    /**
     * Retorna um parâmetro específico da rota
     * @param string $key
     * @return mixed|null
     */
    public function getRouteParam(string $key) : mixed
    {
        return $this->routeParams[$key] ?? null;
    }

    /**
     * Retorna os dados de POST, ou uma chave específica se fornecida
     * @param string|null $key
     * @return mixed
     */
    public function post(?string $key = null) : mixed
    {
        if ($key !== null) return $_POST[$key] ?? null;
        return $_POST;
    }

    /**
     * Retorna os dados de GET, ou uma chave específica se fornecida
     * @param string|null $key
     * @return mixed
     */
    public function get(?string $key = null) : mixed
    {
        if ($key !== null) return $_GET[$key] ?? null;
        return $_GET; 
    }

    /**
     * Função geral para pegar os dados de entrada (GET ou POST)
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function input(string $key, mixed $default = null) : mixed
    {
        // Verifica primeiro se a chave está em POST, senão busca em GET
        return $this->post($key) ?? $this->get($key) ?? $default;
    }
    
    /**
     * Retorna todos os dados de GET e POST mesclados
     * @return array
     */
    public function all() : array
    {
        return array_merge($_GET, $_POST);
    }
}
