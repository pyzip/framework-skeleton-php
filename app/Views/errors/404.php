<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro 404 - Página não encontrada</title>
    <link rel="stylesheet" href="/public/assets/css/home.css">
    <link rel="stylesheet" href="/public/assets/css/404.css">
</head>
<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>
    <main class="error-main-centered">
        <section class="error-hero">
            <div class="error-icon">😕</div>
            <div class="code">404</div>
            <h1>Página não encontrada</h1>
            <p>A página que você tentou acessar não existe ou foi removida.<br>Verifique o endereço ou volte para a página inicial.</p>
            <div class="error-actions">
                <a href="/" class="btn">Voltar para a Home</a>
                <a class="btn btn-ghost" href="javascript:history.back()">Voltar</a>
            </div>
        </section>
    </main>
    <?php include __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
