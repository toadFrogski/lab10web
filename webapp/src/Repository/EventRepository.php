<?php

namespace Src\Repository;

use Core\DBManager\DatabaseManager;
use Exception;

class EventRepository
{

    public static function getAllEvents()
    {
        $dbm = DatabaseManager::getInstance();
        $query = "SELECT e.event_name, e.event_location, e.event_price, u.email, e.id
        FROM event e
        INNER JOIN user u on e.event_manager = u.id";
        return $dbm->connection->query($query)->fetch_all();
    }

    public static function getEventById(int $id)
    {
        $dbm = DatabaseManager::getInstance();
        $query = "SELECT e.event_name, e.event_location, e.event_price, u.email as manager_login, e.id as event_id, u.id as manager_id
        FROM event e
        INNER JOIN user u on e.event_manager = u.id
        WHERE e.id = ?";
        return $dbm->connection->execute_query($query, [$id])->fetch_assoc();
    }

    public static function changeEvent(array $data)
    {
        $dbm = DatabaseManager::getInstance();
        $query = "UPDATE event
            SET
                event_name='{$data['name']}',
                event_manager='{$data['manager']}',
                event_location='{$data['location']}',
                event_price='{$data['price']}'
            WHERE id='{$data['event_id']}'";
        $dbm->connection->query($query);
    }

    public static function newEvent(array $data)
    {
        $dbm = DatabaseManager::getInstance();
        $query = "INSERT into event(event_name, event_manager, event_location, event_price)
            values('{$data['name']}', '{$data['manager']}', '{$data['location']}', '{$data['price']}')";
        $dbm->connection->query($query);
    }

    public static function deleteEvent(int $eid)
    {
        $dbm = DatabaseManager::getInstance();
        $query = "DELETE FROM event WHERE id= ? ";
        $dbm->connection->execute_query($query, [$eid]);
    }
}