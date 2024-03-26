<?php

use Core\HttpFoundation\Request;

function authMiddleware(Request $request)
{
    global $router;
    $path = $request->getPath();
    $role = $_SESSION['role'] ?? "";

    if (in_array($path, [
        '/admin',
        '/admin/user/add',
        '/admin/user/add',
        '/admin/user/edit',
        '/admin/user/edit',
        '/admin/user/delete',
    ]) && !in_array($role, ['admin'])) {
        $router->redirect("loginGet");
    }

    if (in_array($path, [
        '/manager',
        '/manager/event/edit',
        '/manager/event/edit',
        '/manager/event/delete',
        '/manager/event/new',
        '/manager/event/new',
    ]) && !in_array($role, ['admin', 'manager'])) {
        $router->redirect("loginGet");
    }
}
