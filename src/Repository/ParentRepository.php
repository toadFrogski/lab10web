<?php

require_once(BASEDIR . '/core/DBManager/MysqlConnectManager.php');

use Core\DBManager\MysqlConnectManager;

class ParentRepository
{
    public static function getAllParents()
    {
        $dbm = new MysqlConnectManager();
        $query = "SELECT * FROM parent";
        return $dbm->getConnection()->query($query)->fetch_all();
    }
}