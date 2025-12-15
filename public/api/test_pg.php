<?php
header('Content-Type: application/json');

echo json_encode([
    'DATABASE_URL' => getenv('DATABASE_URL'),
    'DB_CONNECTION' => getenv('DB_CONNECTION'),
    'DB_HOST' => getenv('DB_HOST'),
    'DB_PORT' => getenv('DB_PORT'),
    'DB_DATABASE' => getenv('DB_DATABASE'),
    'DB_USERNAME' => getenv('DB_USERNAME'),
    'DB_PASSWORD_SET' => getenv('DB_PASSWORD') ? 'yes' : 'no',
]);
