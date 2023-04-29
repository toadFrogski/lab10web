<?php

require_once(BASEDIR . '/core/DBManager/MysqlConnectManager.php');

use Core\DBManager\MysqlConnectManager;

class EventRepository
{

    public static function getAllEvents()
    {
        $dbm = new MysqlConnectManager();
        $query = "SELECT e.event_name, e.event_location, e.event_price, m.manager_login, e.event_id
        FROM event e
        INNER JOIN manager m on e.manager_id = m.manager_id";
        return $dbm->getConnection()->query($query)->fetch_all();
    }

    public static function getEventById(int $id)
    {
        $dbm = new MysqlConnectManager();
        $query = "SELECT e.event_name, e.event_location, e.event_price, m.manager_login, e.event_id, m.manager_id
        FROM event e
        INNER JOIN manager m on e.manager_id = m.manager_id
        WHERE e.event_id='{$id}'";
        return $dbm->getConnection()->query($query)->fetch_assoc();
    }

    public static function changeEvent(array $data)
    {
        $dbm = new MysqlConnectManager();
        $query = "UPDATE event
            SET
                event_name='{$data['name']}',
                manager_id='{$data['manager']}',
                event_location='{$data['location']}',
                event_price='{$data['price']}'
            WHERE event_id='{$data['event_id']}'";
        $dbm->getConnection()->query($query);
    }

    public static function newEvent(array $data)
    {
        $dbm = new MysqlConnectManager();
        $query = "INSERT into event(event_name, manager_id, event_location, event_price) 
            values('{$data['name']}', '{$data['manager']}', '{$data['location']}', '{$data['price']}')";
        $dbm->getConnection()->query($query);
    }

    public static function deleteEvent(int $eid)
    {
        $dbm = new MysqlConnectManager();
        $query = "DELETE FROM event WHERE event_id='{$eid}'";
        $dbm->getConnection()->query($query);
    }
}