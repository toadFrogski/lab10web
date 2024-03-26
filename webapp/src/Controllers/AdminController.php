<?php

namespace Src\Controllers;

use Core\HttpFoundation\Request;
use Core\Template\Template;
use Exception;
use Src\Repository\UserRepository;

class AdminController
{
    public function getAction(Request $request)
    {
        global $router;
        if (empty($_SESSION) || $_SESSION['role'] != "admin") {
            $router->redirect("loginGet");
        }
        $users = UserRepository::getAllUsers();
        return Template::view('admin/home.html', ['users' => $users ?? []]);
    }

    public function userAddGetAction(Request $request)
    {
        global $router;
        if (empty($_SESSION) || $_SESSION['role'] != "admin") {
            $router->redirect("loginGet");
        }
        return Template::view('admin/add.html', ['roles' => ['user', 'manager', 'admin']]);
    }

    public function userAddPostAction(Request $request)
    {
        global $router;
        if (empty($_SESSION) || $_SESSION['role'] != "admin") {
            $router->redirect("loginGet");
        }

        try {
            UserRepository::addUser($request->getParameters());
        } catch (Exception $e) {
        }

        $router->redirect('admin');
    }

    public function userEditGetAction(Request $request)
    {
        global $router;
        if (empty($_SESSION) || $_SESSION['role'] != "admin") {
            $router->redirect("loginGet");
        }
        $uid = (int) $request->getParameters()['uid'];
        $user = UserRepository::getUserById($uid);
        return Template::view('admin/edit.html', ['user' => $user, 'roles' => ['user', 'manager', 'admin']]);
    }

    public function userEditPostAction(Request $request)
    {
        global $router;
        if (empty($_SESSION) || $_SESSION['role'] != "admin") {
            $router->redirect("loginGet");
        }

        try {
            $data = $request->getParameters();
            $uid = (int) $data['uid'];
            $user = UserRepository::getUserById($uid);
            if ($user['email'] != $data['email']) {
                UserRepository::updateUserEmail($uid, $data['email']);
            }
            if (!empty($data['password'])) {
                UserRepository::updateUserPassword($uid, $data['password']);
            }
            if ($user['role'] != $data['role']) {
                UserRepository::updateUserRole($uid, $data['role']);
            }
        } catch (Exception $e) {
        }
        $router->redirect("admin");
    }

    public function userDeleteAction(Request $request)
    {
        global $router;
        if (empty($_SESSION) || $_SESSION['role'] != "admin") {
            $router->redirect("loginGet");
        }

        $id = (int) $request->getParameters()['uid'];
        try {
            UserRepository::deleteUser($id);
        } catch (Exception $e) {
            echo $e;
        }

        $router->redirect('admin');
    }
}
