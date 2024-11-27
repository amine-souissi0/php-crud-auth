<?php

require_once __DIR__ . '/../core/App.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';
require_once __DIR__ . '/../src/controllers/UserController.php';
require_once __DIR__ . '/../src/models/User.php';

use Core\App;

$url = isset($_GET['url']) ? $_GET['url'] : 'auth/login';
$urlParts = explode('/', $url);

$controllerName = ucfirst($urlParts[0]) . 'Controller';
$methodName = $urlParts[1] ?? 'index';

if (class_exists("Controllers\\$controllerName")) {
    $controllerClass = "Controllers\\$controllerName";
    $controller = new $controllerClass();

    if (method_exists($controller, $methodName)) {
        call_user_func([$controller, $methodName]);
    } else {
        echo "Method not found!";
    }
} else {
    echo "Controller not found!";
}
