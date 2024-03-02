<?php

namespace Src\Repository;

use Core\DBManager\DatabaseManager;
use Exception;

class UserRepository
{

    public static function getAllManagers()
    {
        $dbm = DatabaseManager::getInstance();
        $query = "SELECT * FROM user WHERE role='manager'";
        return $dbm->connection->execute_query($query)->fetch_all();
    }

    public static function getUsersWithPrivilegies(array $roles)
    {
        $dbm = DatabaseManager::getInstance();
        $query = "SELECT id, username, email, role FROM user WHERE role in (" . str_repeat("?,", count($roles) - 1) . "?)";
        return $dbm->connection->execute_query($query, $roles)->fetch_all();
    }

    public static function getUserById($uid = -1) {
        $dbm = DatabaseManager::getInstance();
        $query = "SELECT id, username, email, role FROM user WHERE id = ?";
        return $dbm->connection->execute_query($query, [$uid]);
    }

    /**
     * @throw Exception
     */
    public static function addUser(array $data)
    {
        $dbm = DatabaseManager::getInstance();
        if (empty($email = $data['email'])) {
            throw new Exception("'email' field is required");
        }

        if (empty($password = $data['password'])) {
            throw new Exception("'email' field is required");
        }

        $email = htmlspecialchars($email);
        $password = hash('sha256', $password);

        $query = $dbm->connection->prepare("INSERT INTO user(email, password, role) values(?, ?, 'user')");
        $query->bind_param('ss', $email, $password);
        $query->execute();
        $query->close();
    }

    /**
     * @throw Exception
     */
    public static function getUserByEmail($email): array | null
    {
        $dbm = DatabaseManager::getInstance();
        try {
            return $dbm->connection->execute_query("SELECT * FROM user WHERE email = ?", [$email])->fetch_array();
        } catch (Exception $e) {
            throw new Exception('User not found');
        }
    }
}