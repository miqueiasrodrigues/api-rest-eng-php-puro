<?php

spl_autoload_register(function ($className) {
    $baseDir = __DIR__ . '/src/';

    $file = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
