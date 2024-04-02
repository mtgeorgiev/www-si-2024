<?php

spl_autoload_register(function (string $className)
{
    $includePaths = [
        ".",
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


$ivan = new User("Ivan", "1234");

echo $ivan->getName();
