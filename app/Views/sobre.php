<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - Skeleton PHP</title>
    <link rel="stylesheet" href="public/assets/css/home.css">
    <link rel="stylesheet" href="public/assets/css/sobre.css">
</head>
<body>
    <?php include __DIR__ . '/partials/header.php'; ?>
    <main>
        <section class="sobre-section">
            <h2>Sobre o Skeleton PHP</h2>
            <p>
                O <strong>Skeleton PHP</strong> é um projeto de exemplo criado para demonstrar uma estrutura simples e organizada de aplicações PHP modernas.<br><br>
                Ele utiliza princípios de Clean Code, separação de responsabilidades, rotas amigáveis e fácil manutenção. Ideal para quem está começando ou deseja uma base sólida para novos projetos.<br><br>
                Sinta-se à vontade para explorar, modificar e evoluir este projeto conforme suas necessidades!
            </p>
        </section>

        <section class="sobre-section">
            <h2>Tecnologias Utilizadas</h2>
            <ul class="tech-list">
                <li><strong>PHP 8+</strong> — Linguagem principal do projeto</li>
                <li><strong>Composer</strong> — Gerenciador de dependências</li>
                <li><strong>HTML5 &amp; CSS3</strong> — Estrutura e estilização das páginas</li>
                <li><strong>Arquitetura MVC</strong> — Organização do código</li>
                <li><strong>Boas práticas e Clean Code</strong></li>
            </ul>
        </section>

        <section class="sobre-section autor-section">
            <h2>Desenvolvido por</h2>
            <p>
                <a href="https://github.com/adimael" target="_blank" rel="noopener" class="autor-link">Adimael</a>
            </p>
        </section>
    </main>
    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
