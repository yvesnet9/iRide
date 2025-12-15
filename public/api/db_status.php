<?php
header('Content-Type: application/json');

// 🔒 Chemin ABSOLU (Render)
$dbPath = '/var/www/html/database/database.sqlite';

if (!file_exists($dbPath)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database file not found',
        'path' => $dbPath
    ]);
    exit;
}

if (!is_writable($dbPath)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database file not writable',
        'path' => $dbPath
    ]);
    exit;
}

try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo json_encode([
        'status' => 'success',
        'message' => 'Connexion SQLite OK',
        'path' => $dbPath
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
