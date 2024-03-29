<?php

spl_autoload_register(function ($class) {
    // Define the base directory for the root namespace
    $base_dir = __DIR__ . DIRECTORY_SEPARATOR;
    // Replace namespace separators with directory separators
    $file = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});