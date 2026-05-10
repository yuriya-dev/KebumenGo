<?php
declare(strict_types=1);

require __DIR__ . '/app/helpers/functions.php';

define('APP_NAME', 'KebumenGo');
define('BASE_URL', '/');

$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '', '/');
$segments = $path === '' ? [] : explode('/', $path);

$viewData = [];

if ($path === '') {
    $view = __DIR__ . '/app/views/home/index.php';
} elseif ($path === 'destinasi') {
    $view = __DIR__ . '/app/views/destination/index.php';
} elseif (($segments[0] ?? '') === 'destinasi' && !empty($segments[1])) {
    $view = __DIR__ . '/app/views/destination/show.php';
    $viewData['slug'] = $segments[1];
} elseif ($path === 'rekomendasi') {
    $view = __DIR__ . '/app/views/destination/results.php';
} else {
    http_response_code(404);
    $view = __DIR__ . '/app/views/errors/404.php';
}

require $view;
