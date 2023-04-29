<?php

require_once(BASEDIR . '/core/Routing/Route.php');
require_once(BASEDIR . '/core/Routing/Router.php');
require_once(BASEDIR . '/core/HttpFoundation/Request.php');

require_once(BASEDIR . '/src/Controllers/HomeController.php');
require_once(BASEDIR . '/src/Controllers/AuthController.php');
require_once(BASEDIR . '/src/Controllers/AdminController.php');

use Core\Routing\Route;
use Core\Routing\Router;

if (isset($_SESSION['role']) && $_SESSION['role'] = 'manager') {
    $router = new Router([
        new Route('home', '/', ['AdminController', 'getAction'], 'GET'),
        new Route('eventEditGet', '/event/edit', ['AdminController', 'eventEditGetAction'], 'GET'),
        new Route('eventEditPost', '/event/edit', ['AdminController', 'eventEditPostAction'], 'POST'),
        new Route('eventDelete', '/event/delete', ['AdminController', 'eventDeleteAction'], 'GET'),
        new Route('eventNewGet', '/event/new', ['AdminController', 'eventNewGetAction'], 'GET'),
        new Route('eventNewPost', '/event/new', ['AdminController', 'eventNewPostAction'], 'POST'),
        new Route('parents', '/parents', ['AdminController', 'parentsAction'], 'GET'),
        new Route('children', '/children', ['AdminController', 'childrenAction'], 'GET'),
        new Route('logout', '/logout', ['AdminController', 'logoutAction'], 'GET'),
    ]);
} else {
    $router = new Router([
        new Route('home', '/', ['HomeController', 'getAction'], 'GET'),
        new Route('recordGet', '/record', ['HomeController', 'recordGetAction'], 'GET'),
        new Route('recordPost', '/record', ['HomeController', 'recordPostAction'], 'POST'),
        new Route('loginGet', '/login', ['AuthController', 'loginGetAction'], 'GET'),
        new Route('loginPost', '/login', ['AuthController', 'loginPostAction'], 'POST'),
    ]);
}
$router->dispatch($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);