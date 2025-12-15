<?php
header('Content-Type: application/json');

try {
    $databaseUrl = getenv('DATABASE_URL');

    if (!$databaseUrl) {
        throw new Exception('DATABASE_URL not set');
    }

    $pdo = new PDO($databaseUrl, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    echo json_encode([
        'status' => 'success',
        'message' => 'Connexion PostgreSQL OK (internal Render network)'
    ]);
} catch (Throwable $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
