<?php

require_once(BASEDIR . '/core/HttpFoundation/Request.php');
require_once(BASEDIR . '/core/Template/Template.php');
require_once(BASEDIR . '/core/DBManager/MysqlConnectManager.php');

use Core\HttpFoundation\Request;
use Core\Template\Template;
use Core\DBManager\MysqlConnectManager;

class AuthController
{
    public function loginGetAction(Request $request)
    {
        return Template::view('auth/login.html');
    }

    public function loginPostAction(Request $request)
    {
        $dbm = new MysqlConnectManager();
        $query = "SELECT * from manager";
        $managers = $dbm->getConnection()->query($query)->fetch_all();
        if (
            in_array($request->getParameters()['email'], array_column($managers, 1))
            && in_array(md5($request->getParameters()['password']), array_column($managers, 2))
        ) {
            $_SESSION['role'] = 'manager';
        }
        header('Location: /');
    }
}