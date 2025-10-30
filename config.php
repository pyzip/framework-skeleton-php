<?php
// Configurações centralizadas usando variáveis do .env
return [
    'app' => [
        'name' => getenv('APP_NAME') ?: 'Skeleton PHP',
        'env' => getenv('APP_ENV') ?: 'production',
        'debug' => getenv('APP_DEBUG') === 'true',
        'url' => getenv('APP_URL') ?: 'http://localhost:8000',
    ],
    'database' => [
        'connection' => getenv('DB_CONNECTION') ?: 'mysql',
        'host' => getenv('DB_HOST') ?: '127.0.0.1',
        'port' => getenv('DB_PORT') ?: 3306,
        'database' => getenv('DB_DATABASE') ?: 'skeleton',
        'username' => getenv('DB_USERNAME') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
    ],
    'session' => [
        'name' => getenv('SESSION_NAME') ?: 'skeleton_session',
    ],
];
