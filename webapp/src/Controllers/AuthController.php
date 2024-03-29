<?php

namespace Src\Controllers;

use Core\HttpFoundation\Request;
use Core\Template\Template;
use Exception;
use Src\Repository\UserRepository;

class AuthController
{
    public function loginGetAction(Request $request)
    {
        return Template::view('auth/login.html');
    }

    public function loginPostAction(Request $request)
    {
        global $router;
        $data = $request->getParameters();
        try {
            $user = UserRepository::getUserByEmail($data['email']);
            if ($user == null) {
                $router->redirect('home');
            }
        } catch (Exception $e) {
            $router->redirect('home');
        }
        if (hash('sha256', $data['password']) == $user['password']) {
            $_SESSION['role'] = $user['role'];
            $router->redirect('home');
        }
        $router->redirect('loginGet');
    }

    public function registerGetAction(Request $request)
    {
        return Template::view('auth/sign.html');
    }

    public function registerPostAction(Request $request)
    {
        global $router;
        try {
            UserRepository::addUser($request->getParameters());
        } catch (Exception $e) {
            $router->redirect('registerGet');
        }
        $router->redirect('home');
    }

    public function logoutAction(Request $request)
    {
        global $router;
        session_destroy();
        $router->redirect('home');
    }
}
