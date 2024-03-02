<?php

namespace Src\Controllers;

use Core\HttpFoundation\Request;
use Core\Template\Template;

use Src\Repository\UserRepository;

class AdminController
{
    public function getAction(Request $request)
    {
        $users = UserRepository::getUsersWithPrivilegies(['manager', 'user']);
        return Template::view('admin/home.html', ['users' => $users ?? []]);
    }

    public function userAddGetAction(Request $request)
    {
        $user = UserRepository::getUserById($request->getParameters()['uid'] ?? "");
        return Template::view('admin/add.html', ['user' => $user ?? []]);
    }

    public function userAddPostAction(Request $request)
    {
    }

    public function userEditGetAction(Request $request)
    {
    }

    public function userEditPostAction(Request $request)
    {
    }

    public function userDeleteAction(Request $request)
    {
    }
}
