<?php

namespace App;

use App\Core\Request;
use App\Core\Response;

class Router
{
    /**
     * @var array<string, array<string, array>>
     */
    private array $routes = [];

    /**
     * Registra uma rota GET.
     * @param string $uri
     * @param callable|string $controller
     * @param callable|null $middleware
     */
    public function get(string $uri, callable|string $controller, ?callable $middleware = null): void
    {
        $this->addRoute('GET', $uri, $controller, $middleware);
    }

    /**
     * Registra uma rota POST.
     * @param string $uri
     * @param callable|string $controller
     * @param callable|null $middleware
     */
    public function post(string $uri, callable|string $controller, ?callable $middleware = null): void
    {
        $this->addRoute('POST', $uri, $controller, $middleware);
    }

    private function addRoute(string $method, string $uri, callable|string $controller, ?callable $middleware = null): void
    {
        $paramNames = $this->extractParamNames($uri);
        $pattern = $this->convertUriToPattern($uri);
        $this->routes[$method][$pattern] = [
            'controller' => $controller,
            'middleware' => $middleware,
            'paramNames' => $paramNames
        ];
    }

    /**
     * Faz o despacho da requisição para a rota correspondente.
     * @param Request $request
     * @param Response $response
     */
    public function dispatch(Request $request, Response $response): void
    {
        $method = $request->getMethod();
        $uri = $request->getUri();

        if (!isset($this->routes[$method])) {
            $this->handleNotFound($response);
            return;
        }

        foreach ($this->routes[$method] as $pattern => $route) {
            if (preg_match($pattern, $uri, $matches)) {
                $params = array_slice($matches, 1);
                $this->setRouteParamsOnRequest($request, $route['paramNames'], $params);

                if ($this->handleMiddleware($route['middleware'], $request, $response) === false) {
                    return;
                }

                $this->resolve($route['controller'], $request, $response, $params);
                return;
            }
        }

        $this->handleNotFound($response);
    }

    /**
     * Resolve o controller e executa o método correspondente.
     */
    /**
     * Resolve o controller e executa o método correspondente.
     * @param callable|string $controller
     * @param Request $request
     * @param Response $response
     * @param array $params
     * @throws \RuntimeException
     */
    private function resolve(callable|string $controller, Request $request, Response $response, array $params = []): void
    {
        if (is_callable($controller)) {
            call_user_func_array($controller, array_merge([$request, $response], $params));
            return;
        }

        if (is_string($controller)) {
            if (strpos($controller, '@') === false) {
                throw new \RuntimeException('Controller string must be in the format Controller@method');
            }
            [$class, $method] = explode('@', $controller, 2);
            $class = "App\\Controllers\\$class";
            if (class_exists($class)) {
                $instance = new $class;
                if (method_exists($instance, $method)) {
                    call_user_func_array([$instance, $method], array_merge([$request, $response], $params));
                    return;
                }
            }
        }

        throw new \RuntimeException('Controller not found');
    }

    /**
     * Extrai os nomes dos parâmetros da rota (ex: {id})
     * @return string[]
     */
    private function extractParamNames(string $uri): array
    {
        preg_match_all('/\{([a-zA-Z0-9_]+)\}/', $uri, $matches);
        return $matches[1] ?? [];
    }

    /**
     * Converte o URI para um padrão de expressão regular
     */
    private function convertUriToPattern(string $uri): string
    {
        return '#^' . preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $uri) . '$#';
    }

    /**
     * Seta os parâmetros capturados no objeto Request
     */
    private function setRouteParamsOnRequest(Request $request, array $paramNames, array $params): void
    {
        foreach ($paramNames as $idx => $name) {
            if (isset($params[$idx])) {
                $request->setRouteParam($name, $params[$idx]);
            }
        }
    }

    /**
     * Executa o middleware, se houver
     * @return bool|null false se bloqueado, null se não houver ou permitido
     */
    private function handleMiddleware(?callable $middleware, Request $request, Response $response): ?bool
    {
        if ($middleware && is_callable($middleware)) {
            $result = call_user_func($middleware, $request, $response);
            if ($result === false) {
                return false;
            }
        }
        return null;
    }

    /**
     * Responde com 404 caso rota não encontrada
     */
    private function handleNotFound(Response $response): void
    {
        $response->setStatusCode(404);
        $response->renderView('errors/404');
        $response->send();
    }
}