<?php

use Core\Routing\Route;
use Core\Routing\Router;

use Src\Controllers\ManagerController;
use Src\Controllers\AdminController;
use Src\Controllers\AuthController;
use Src\Controllers\HomeController;
use Src\Controllers\Lab2Controller;

$router = new Router();

if (isset($_SESSION['role']) && ($_SESSION['role'] == 'manager' || $_SESSION['role'] == 'admin')) {
    $router->add(
        new Route('manager', '/manager', [ManagerController::class, 'getAction'], 'GET'),
        new Route('eventEditGet', '/manager/event/edit', [ManagerController::class, 'eventEditGetAction'], 'GET'),
        new Route('eventEditPost', '/manager/event/edit', [ManagerController::class, 'eventEditPostAction'], 'POST'),
        new Route('eventDelete', '/manager/event/delete', [ManagerController::class, 'eventDeleteAction'], 'GET'),
        new Route('eventNewGet', '/manager/event/new', [ManagerController::class, 'eventNewGetAction'], 'GET'),
        new Route('eventNewPost', '/manager/event/new', [ManagerController::class, 'eventNewPostAction'], 'POST'),
    );
}

if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    $router->add(
        new Route('admin', '/admin', [AdminController::class, 'getAction'], 'GET'),
        new Route('userAddGet', '/admin/user/add', [AdminController::class, 'userAddGetAction'], 'GET'),
        new Route('userAddPost', '/admin/user/add', [AdminController::class, 'userAddPostAction'], 'POST'),
        new Route('userEditGet', '/admin/user/edit', [AdminController::class, 'userEditGetAction'], 'GET'),
        new Route('userEditPost', '/admin/user/edit', [AdminController::class, 'userEditPostAction'], 'POST'),
        new Route('userDelete', '/admin/user/delete', [AdminController::class, 'userDeleteAction'], 'GET'),
    );
}

$router->add(
    new Route('home', '/', [HomeController::class, 'getAction'], 'GET'),
    new Route('recordGet', '/record', [HomeController::class, 'recordGetAction'], 'GET'),
    new Route('recordPost', '/record', [HomeController::class, 'recordPostAction'], 'POST'),
    new Route('loginGet', '/login', [AuthController::class, 'loginGetAction'], 'GET'),
    new Route('loginPost', '/login', [AuthController::class, 'loginPostAction'], 'POST'),
    new Route('logout', '/logout', [AuthController::class, 'logoutAction'], 'GET'),
    new Route('registerGet', '/register', [AuthController::class, 'registerGetAction'], 'GET'),
    new Route('registerPost', '/register', [AuthController::class, 'registerPostAction'], 'POST'),
);

// lab2
$router->add(
    new Route('lab2Get', '/lab2', [Lab2Controller::class, 'getAction'], 'GET'),
    new Route('lab2Post', '/lab2', [Lab2Controller::class, 'postAction'], 'POST')
);

$router->dispatch($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);