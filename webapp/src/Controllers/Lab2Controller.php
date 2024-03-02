<?php

namespace Src\Controllers;

use Core\DBManager\DatabaseManager;
use Core\HttpFoundation\Request;
use Core\Template\Template;


class Lab2Controller
{
    public function getAction(Request $request)
    {
        $dbm = DatabaseManager::getInstance()->connection;
        $rows = $dbm->execute_query("SELECT * from lab2")->fetch_all();
        return Template::view('lab2/list.html', ['rows' => $rows]);
    }

    public function postAction(Request $request)
    {
        global $router;
        $data = $request->getParameters();
        $username = htmlspecialchars($data['username'] ?? "");
        $text = htmlspecialchars($data['text'] ?? "");
        $dbm = DatabaseManager::getInstance()->connection;
        $dbm->execute_query("INSERT INTO lab2(username, text) values(?,?)", [$username, $text]);
        $router->redirect('recordGet');
    }
}
