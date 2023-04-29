<?php

require_once(BASEDIR . '/core/DBManager/MysqlConnectManager.php');

use Core\DBManager\MysqlConnectManager;

class ManagerRepository
{
    public static function getAllManagers() {
        $dbm = new MysqlConnectManager();
        $query = "SELECT m.manager_id, m.manager_login from manager m";
        return $dbm->getConnection()->query($query)->fetch_all();
    }
}