<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentação - Skeleton PHP</title>
    <link rel="stylesheet" href="public/assets/css/home.css">
    <link rel="stylesheet" href="public/assets/css/sobre.css">
    <style>
        .doc-container {
            max-width: 900px;
            margin: 3rem auto 2rem auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            padding: 2.5rem 2rem 2rem 2rem;
            font-size: 1.08rem;
        }
        .doc-container h1, .doc-container h2, .doc-container h3 {
            color: #2196f3;
            margin-top: 2.2rem;
            margin-bottom: 1rem;
        }
        .doc-container h1 {
            font-size: 2.2rem;
            margin-top: 0;
        }
        .doc-container h2 {
            font-size: 1.4rem;
        }
        .doc-container h3 {
            font-size: 1.1rem;
        }
        .doc-container ul, .doc-container ol {
            margin-left: 1.5rem;
        }
        .doc-container code, .doc-container pre {
            background: #f4f6fb;
            color: #23272f;
            border-radius: 6px;
            padding: 0.2em 0.5em;
            font-size: 1em;
        }
        .doc-container pre {
            padding: 1em;
            overflow-x: auto;
        }
        .doc-container table {
            border-collapse: collapse;
            width: 100%;
            margin: 1.5rem 0;
        }
        .doc-container th, .doc-container td {
            border: 1px solid #e3e3e3;
            padding: 0.6em 1em;
            text-align: left;
        }
        .doc-container th {
            background: #f8fafc;
        }
        .doc-container .badge {
            display: inline-block;
            background: #00bcd4;
            color: #fff;
            border-radius: 12px;
            padding: 0.2em 0.8em;
            font-size: 0.95em;
            margin-left: 0.5em;
        }
        .doc-container .tip {
            background: #e3f6fd;
            border-left: 4px solid #00bcd4;
            padding: 1em 1.5em;
            margin: 1.5em 0;
            border-radius: 8px;
            color: #222;
        }
        @media (max-width: 700px) {
            .doc-container { padding: 1rem 0.5rem; }
        }
    </style>
</head>
<body>
<?php include __DIR__ . '/partials/header.php'; ?>
<main>
    <div class="doc-container">
        <h1>Documentação da Plataforma <span class="badge">Skeleton PHP</span></h1>
        <p>Bem-vindo à documentação oficial do Skeleton PHP! Aqui você encontra tudo sobre estrutura, variáveis, rotas, tratamento de erros, testes e como rodar o projeto.</p>

        <h2>1. Estrutura de Pastas e Arquivos</h2>
        <pre><code>Skeleton-php/
├── app/
│   ├── Controllers/
│   ├── Core/
│   ├── Views/
│   │   └── partials/
│   └── Router.php
├── config.php
├── config/
│   └── env.php
├── public/
│   └── assets/
│       └── css/
├── routes/
│   └── web.php
├── vendor/
├── .env
├── index.php
└── README.md
</code></pre>
        <ul>
            <li><b>app/Controllers/</b>: Controllers da aplicação.</li>
            <li><b>app/Core/</b>: Classes centrais (Request, Response, etc).</li>
            <li><b>app/Views/</b>: Views (páginas HTML) e partials reutilizáveis.</li>
            <li><b>app/Router.php</b>: Sistema de rotas.</li>
            <li><b>config.php</b>: Configurações centralizadas (usa .env).</li>
            <li><b>config/env.php</b>: Loader do .env.</li>
            <li><b>public/assets/css/</b>: Arquivos CSS.</li>
            <li><b>routes/web.php</b>: Definição das rotas.</li>
            <li><b>index.php</b>: Ponto de entrada da aplicação.</li>
        </ul>

        <h2>2. Variáveis e Funções Globais</h2>
        <ul>
            <li><b>Variáveis de ambiente</b>: Definidas no <code>.env</code> e acessadas via <code>getenv()</code> ou <code>config.php</code>.</li>
            <li><b>Função <code>loadEnv()</code></b>: Carrega variáveis do <code>.env</code> para o ambiente.</li>
            <li><b>Configuração centralizada</b>: Use <code>$config = require 'config.php';</code> para acessar configs em qualquer parte do sistema.</li>
        </ul>

        <h2>3. Modelagem e Organização</h2>
        <ul>
            <li><b>MVC Simples</b>: Controllers recebem <code>Request</code> e <code>Response</code>, manipulam dados e renderizam views.</li>
            <li><b>Views</b>: HTML com includes para <code>header.php</code> e <code>footer.php</code> (partials).</li>
            <li><b>Rotas</b>: Definidas em <code>routes/web.php</code> usando <code>$router->get()</code> e <code>$router->post()</code>.</li>
            <li><b>CSS externo</b>: Todas as páginas utilizam arquivos CSS externos, inclusive <code>sobre.css</code> para a página Sobre.</li>
        </ul>
            <h3>Diagrama de Classes (PlantUML)</h3>
            <pre class="uml"><code>@startuml
    'skinparam classAttributeIconSize 0'
    skinparam backgroundColor #f8fafc
    skinparam class {
        BackgroundColor White
        BorderColor #2196f3
        ArrowColor #2196f3
        FontName Inter
        FontSize 15
        AttributeFontColor #2563eb
        AttributeFontSize 13
        StereotypeFontColor #2196f3
        StereotypeFontSize 12
        Shadowing false
    }
    hide empty members

    class Router {
        - routes: array
        + get(uri: string, controller: callable|string, middleware: callable|null): void
        + post(uri: string, controller: callable|string, middleware: callable|null): void
        + dispatch(request: Request, response: Response): void
        .. Métodos privados ..
        - addRoute(method: string, uri: string, controller: callable|string, middleware: callable|null): void
        - resolve(controller: callable|string, request: Request, response: Response, params: array): void
        - extractParamNames(uri: string): array
        - convertUriToPattern(uri: string): string
        - setRouteParamsOnRequest(request: Request, paramNames: array, params: array): void
        - handleMiddleware(middleware: callable|null, request: Request, response: Response): ?bool
        - handleNotFound(response: Response): void
    }

    class Request {
        - method: string
        - uri: string
        - routeParams: array
        + __construct()
        + getMethod(): string
        + getUri(): string
        + getParam(key: string): mixed
        + setRouteParam(name: string, value: mixed): void
        + getRouteParam(name: string): mixed
    }

    class Response {
        - statusCode: int
        + setStatusCode(code: int): void
        + renderView(view: string, data: array = []): void
        + send(): void
    }

    class HomeController {
        + index(request: Request, response: Response): void
        + sobre(request: Request, response: Response): void
    }

    class DocumentacaoController {
        + index(request: Request, response: Response): void
    }

    Router --> Request : usa
    Router --> Response : usa
    HomeController --> Request : depende
    HomeController --> Response : depende
    DocumentacaoController --> Request : depende
    DocumentacaoController --> Response : depende

    @enduml</code></pre>
            <p style="font-size:0.97em;color:#666;margin-top:0.5em;">O diagrama acima ilustra a relação entre as principais classes do Skeleton PHP. Você pode copiar o código PlantUML e gerar o diagrama visual em <a href="https://plantuml.com/pt/plantuml" target="_blank" rel="noopener">plantuml.com</a>.</p>
            <div style="text-align:center;margin:2.5rem 0;">
                <img src="/public/assets/images/diagramas/diagrama_classe.png" alt="Diagrama de Classes Skeleton PHP" style="max-width:100%;border:1.5px solid #e3e3e3;border-radius:10px;box-shadow:0 2px 12px rgba(33,150,243,0.07);">
                <div style="color:#888;font-size:0.98em;margin-top:0.5em;">Visualização pronta do diagrama de classes do projeto</div>
            </div>

        <h2>4. Rotas</h2>
        <pre><code>// routes/web.php
$router->get('', 'HomeController@index');
$router->get('sobre', 'HomeController@sobre');
$router->get('produto/{id}', 'ProdutoController@show');
</code></pre>
        <ul>
            <li>Rotas aceitam parâmetros dinâmicos (ex: <code>produto/{id}</code>).</li>
            <li>Controllers podem ser strings (<code>Controller@metodo</code>) ou funções anônimas.</li>
        </ul>

        <h2>5. Tratamento de Erros</h2>
        <ul>
            <li><b>404</b>: Tratado no <code>Router.php</code> (view <code>errors/404.php</code>), layout padronizado e centralizado, seguindo o padrão visual da home.</li>
            <li><b>500</b>: Tratado globalmente no <code>index.php</code> (view <code>errors/500.php</code>), layout padronizado e centralizado, seguindo o padrão visual da home.</li>
        </ul>

        <h2>6. Testes Realizados</h2>
        <ul>
            <li>Testes manuais de navegação, rotas, parâmetros e tratamento de erros.</li>
            <li>Testes de renderização de views e integração de controllers.</li>
            <li>Testes de variáveis do <code>.env</code> e configs dinâmicas.</li>
            <li>Testes de responsividade e padronização visual das páginas de erro e sobre.</li>
        </ul>
        <div class="tip">
            <b>Dica:</b> Para testes automatizados, recomenda-se usar PHPUnit e criar uma pasta <code>tests/</code>.
        </div>

        <h2>7. Como Rodar o Projeto</h2>
        <ol>
            <li>Clone o repositório e instale as dependências com <code>composer install</code>.</li>
            <li>Configure o arquivo <code>.env</code> conforme seu ambiente.</li>
            <li>Inicie o servidor embutido do PHP:<br>
                <code>php -S localhost:8000 -t public</code>
            </li>
            <li>Acesse <a href="http://localhost:8000" target="_blank">http://localhost:8000</a> no navegador.</li>
        </ol>
        <div class="tip">
            <b>Experiência do Usuário:</b> O Skeleton PHP foi projetado para ser simples, responsivo e fácil de evoluir. O menu é intuitivo, as páginas são rápidas, o código é limpo e toda a estilização é feita via CSS externo para facilitar a colaboração e manutenção.
        </div>
        <h2>8. Sobre</h2>
        <ul>
            <li>A página <b>Sobre</b> apresenta informações do projeto, as tecnologias utilizadas e autoria.</li>
            <li>Desenvolvido por <a href="https://github.com/adimael" target="_blank" rel="noopener">Adimael</a>.</li>
        </ul>
    </div>
</main>
<?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
