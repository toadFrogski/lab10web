<?php

namespace Src\Repository;

use Core\DBManager\DatabaseManager;

class RecordRepository
{
    public static function setRecord(array $data): void
    {
        $dbm = DatabaseManager::getInstance();
        $conn = $dbm->connection;
        $query = "SELECT parent_id from parent where parent_name='{$data['name']}' and parent_email = '{$data['email']}'";
        $parent_id = $conn->query($query)->fetch_array()[0];
        if (empty($parent_id)) {
            $query = "INSERT into parent(parent_name, parent_email) values('{$data['name']}', '{$data['email']}')";
            $conn->query($query);
            $query = "SELECT parent_id from parent where parent_name='{$data['name']}' and parent_email = '{$data['email']}'";
            $parent_id = $conn->query($query)->fetch_array();
        }
        $query = "SELECT child_id from child where child_name = '{$data['child_name']}' and child_birth = '{$data['date']}' and parent_id = '" . (int) $parent_id[0] . "'";
        $child_id = $conn->query($query)->fetch_array()[0];
        if (empty($child_id)) {
            $query = "INSERT into child(child_name, child_birth, parent_id) values('{$data['child_name']}', '{$data['date']}', '" . (int) $parent_id[0] . "')";
            $conn->query($query);
        }
        $query = "INSERT into event_record(er_date, parent_id, child_id) values('{$data['date']}', '{$parent_id}', '{$child_id}')";
        $conn->query($query);
    }
}