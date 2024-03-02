<?php

namespace Src\Repository;

use Core\DBManager\DatabaseManager;

class ChildRepository
{
    public static function getAllChildren()
    {
        $dbm = DatabaseManager::getInstance();
        $query = "SELECT c.child_id, c.child_name, c.child_birth, p.parent_name from child c
            INNER JOIN parent p ON p.parent_id=c.parent_id";
        return $dbm->connection->query($query)->fetch_all();
    }
}