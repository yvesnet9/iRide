<?php
header('Content-Type: application/json');

echo json_encode([
    'status' => 'warning',
    'message' => 'SQLite non persistante sur Render (démo)',
    'note' => 'En production réelle, PostgreSQL serait utilisé'
]);
