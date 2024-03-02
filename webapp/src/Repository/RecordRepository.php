<?php

namespace Src\Repository;

use Core\DBManager\DatabaseManager;
use Exception;

class RecordRepository
{
    public static function setRecord(array $data): void
    {
        try {
            $dbm = DatabaseManager::getInstance();
            $query = "INSERT INTO event_record(client_email, client_name) values(?,?)";
            $dbm->connection->execute_query($query, [$data['email'], $data['name']]);
        } catch (Exception $e) {
        }
    }
}