<?php

namespace Src\Repository;

use Core\DBManager\DatabaseManager;

class ManagerRepository
{
    public static function getAllManagers()
    {
        $dbm = DatabaseManager::getInstance();
        $query = "SELECT m.manager_id, m.manager_login from manager m";
        return $dbm->connection->query($query)->fetch_all();
    }
}
