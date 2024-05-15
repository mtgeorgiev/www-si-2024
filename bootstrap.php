<?php

session_start();

spl_autoload_register(function (string $className)
{
    $includePaths = [
        "./classes",
    ];
    foreach ($includePaths as $path) {
        $file = "${path}/${className}.php";
        if (file_exists($file)) {
            require_once $file;
            break;
        }
    }
});

set_exception_handler(function (Throwable $e)
{
    if ($e instanceof DuplicateUserException) {
        http_response_code(400);
    } else {
        http_response_code(500);
    }
    echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
});
