<?php

use Core\Routing\Route;
use Core\Routing\Router;

use Src\Controllers\AdminController;
use Src\Controllers\AuthController;
use Src\Controllers\HomeController;

$router = new Router();

if (isset($_SESSION['role']) && $_SESSION['role'] = 'admin') {
    $router->add(
        new Route('admin', '/admin', [AdminController::class, 'getAction'], 'GET'),
        new Route('eventEditGet', '/event/edit', [AdminController::class, 'eventEditGetAction'], 'GET'),
        new Route('eventEditPost', '/event/edit', [AdminController::class, 'eventEditPostAction'], 'POST'),
        new Route('eventDelete', '/event/delete', [AdminController::class, 'eventDeleteAction'], 'GET'),
        new Route('eventNewGet', '/event/new', [AdminController::class, 'eventNewGetAction'], 'GET'),
        new Route('eventNewPost', '/event/new', [AdminController::class, 'eventNewPostAction'], 'POST'),
        new Route('logout', '/logout', [AdminController::class, 'logoutAction'], 'GET'),
    );
}

$router->add(
    new Route('home', '/', [HomeController::class, 'getAction'], 'GET'),
    new Route('recordGet', '/record', [HomeController::class, 'recordGetAction'], 'GET'),
    new Route('recordPost', '/record', [HomeController::class, 'recordPostAction'], 'POST'),
    new Route('loginGet', '/login', [AuthController::class, 'loginGetAction'], 'GET'),
    new Route('loginPost', '/login', [AuthController::class, 'loginPostAction'], 'POST'),
    new Route('registerGet', '/register', [AuthController::class, 'registerGetAction'], 'GET'),
    new Route('registerPost', '/register', [AuthController::class, 'registerPostAction'], 'POST'),
);

$router->dispatch($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);