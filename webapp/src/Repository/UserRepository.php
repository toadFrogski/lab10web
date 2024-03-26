<?php

namespace Src\Repository;

use Core\DBManager\DatabaseManager;
use Exception;

class UserRepository
{

    public static function getAllUsers()
    {
        $dbm = DatabaseManager::getInstance();
        return $dbm->connection->execute_query("SELECT id, username, email, role from user")->fetch_all();
    }
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

    public static function getUserById($uid = -1)
    {
        $dbm = DatabaseManager::getInstance();
        $query = "SELECT id, email, role FROM user WHERE id = ?";
        return $dbm->connection->execute_query($query, [$uid])->fetch_assoc();
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

        if (empty($role = $data['role'])) {
            throw new Exception("'role' field is required");
        }

        $email = htmlspecialchars($email);
        $password = hash('sha256', $password);

        $result = $dbm->connection
            ->execute_query("SELECT count(*) > 0 as is_registered_email FROM user WHERE  email = ?", [$email])
            ->fetch_assoc();
        if ($result['is_registered_email']) {
            throw new Exception("Email already exist");
        }

        $dbm->connection
            ->execute_query("INSERT INTO user(email, password, role) values(?, ?, ?)", [$email, $password, $role]);
    }

    public static function updateUserEmail(int $uid, string $email)
    {
        $dbm = DatabaseManager::getInstance();
        $email = htmlspecialchars($email);
        $dbm->connection->execute_query("UPDATE user set email = ? WHERE id = ?", [$email, $uid]);
    }

    public static function updateUserPassword(int $uid, string $password)
    {
        $dbm = DatabaseManager::getInstance();
        $password = hash('sha256', $password);
        $dbm->connection->execute_query("UPDATE user set password = ? WHERE id = ?", [$password, $uid]);
    }

    public static function updateUserRole(int $uid, string $role)
    {
        $dbm = DatabaseManager::getInstance();
        $dbm->connection->execute_query("UPDATE user set role = ? WHERE id = ?", [$role, $uid]);
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

    public static function deleteUser(int $uid)
    {
        $dbm = DatabaseManager::getInstance();
        try {
            $dbm->connection->execute_query("DELETE FROM user WHERE id = ?", [$uid]);
        } catch (Exception $e) {
            // throw new Exception('User profile not deleted');
            throw new $e;
        }
    }
}
