<?php
/**
 * Router for PHP built-in server.
 * Lets front-controller routes like /contact, /images, /crud work in local dev.
 */
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$fullPath = __DIR__ . $requestPath;

if ($requestPath !== '/' && file_exists($fullPath) && !is_dir($fullPath)) {
    return false; // serve real static files directly
}

require __DIR__ . '/index.php';
