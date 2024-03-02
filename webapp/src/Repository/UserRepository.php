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

    public static function getUserByEmail($email): array
    {
        $dbm = DatabaseManager::getInstance();
        try {
            return $dbm->connection->execute_query("SELECT * FROM user WHERE email = ?", [$email])->fetch_array();
        } catch (Exception $e) {
            return [];
        }
    }
}
