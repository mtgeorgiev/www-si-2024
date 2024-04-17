<?php

$errors = [];

if (!$_POST['username']) {
    $errors[] = 'Потребителското име е задължително';
}

echo json_encode([
        'errors' => $errors
    ], JSON_UNESCAPED_UNICODE);

    
// file_get_contents('php://input');
