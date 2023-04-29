<?php

require_once(BASEDIR . '/core/DBManager/MysqlConnectManager.php');

use Core\DBManager\MysqlConnectManager;

class ChildRepository
{
    public static function getAllChildren()
    {
        $dbm = new MysqlConnectManager();
        $query = "SELECT c.child_id, c.child_name, c.child_birth, p.parent_name from child c
            INNER JOIN parent p ON p.parent_id=c.parent_id";
        return $dbm->getConnection()->query($query)->fetch_all();
    }
}