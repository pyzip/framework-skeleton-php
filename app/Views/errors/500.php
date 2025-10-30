<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro 500 - Erro Interno do Servidor</title>
    <link rel="stylesheet" href="/public/assets/css/home.css">
    <link rel="stylesheet" href="/public/assets/css/500.css">
</head>
<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>
    <main>
        <section class="error-hero">
            <div class="error-icon">😵</div>
            <div class="code">500</div>
            <h1>Erro Interno do Servidor</h1>
            <p>Ocorreu um erro inesperado em nosso servidor.<br>Tente novamente mais tarde ou entre em contato com o suporte.</p>
            <div class="error-actions">
                <a href="/" class="btn">Voltar para a Home</a>
                <a class="btn" style="background:#fff;color:#ff5252;" href="javascript:history.back()">Voltar</a>
            </div>
        </section>
    </main>
    <?php include __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
