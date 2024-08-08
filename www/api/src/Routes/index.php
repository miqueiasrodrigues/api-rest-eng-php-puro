<?php

use App\Exceptions\AppException;
use App\Http\Middleware\AuthMiddleware;
use App\Response;
use Routes\Classes\Router;

require_once __DIR__ . '/../App/Http/Middlewares/AuthMiddleware.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

/* VERIFICAR SE A API EXIGE CHAVE DE ACESSO */

if (API_EXGIR_KEY && (!isset($_SERVER['HTTP_API_KEY']) || $_SERVER['HTTP_API_KEY'] !== API_KEY)) {
    echo Response::json(401, 'Acesso Negado');
    exit;
}

$router = new Router("v1");
$id = '(\d+)';

/* ADICIONA AS ROTAS */

$router->add('GET', '/', function () {
    echo Response::json(200, 'Bem-vindo a API do projeto ' . PROJECT_NAME, [
        'description' => 'Esta API foi desenvolvida utilizando PHP puro.',
        'api_version' => API_VERSION,
        'author' => AUTHOR,
    ]);
});

require_once __DIR__ . '/user.php';
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/notification.php';
require_once __DIR__ . '/camera.php';


/* ROTEAMENTO */

$publicRoutes = [
    /*'GET' => ['#^/user/.*$#'],*/
    'GET' => ['#^/$#'],
    'POST' => ['#^/session$#', '#^/user$#']
];

$authMiddleware = new AuthMiddleware($publicRoutes);

try {
    $router->route($method, $router->getPath($uri), $authMiddleware);
} catch (AppException $e) {
    echo Response::json($e->getCode(), $e->getMessage());
} catch (Exception $e) {
    echo Response::json(500, $e->getMessage());
}