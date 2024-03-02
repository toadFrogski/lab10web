<?php

namespace Src\Repository;

use Core\DBManager\DatabaseManager;

class ParentRepository
{
    public static function getAllParents()
    {
        $dbm = DatabaseManager::getInstance();
        $query = "SELECT * FROM parent";
        return $dbm->connection->query($query)->fetch_all();
    }
}