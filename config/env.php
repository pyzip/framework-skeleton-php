<?php
// Função simples para carregar variáveis do .env para o ambiente
if (!function_exists('loadEnv')) {
    function loadEnv(string $path): void
    {
        if (!file_exists($path)) return;
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#') || trim($line) === '') continue;
            [$name, $value] = array_pad(explode('=', $line, 2), 2, null);
            if ($name && $value !== null && getenv($name) === false) {
                putenv(trim($name) . '=' . trim($value));
                $_ENV[trim($name)] = trim($value);
                $_SERVER[trim($name)] = trim($value);
            }
        }
    }
}
