<?php

include_once '../../core/Database.php';

class DashboardController
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getUserById($userId)
    {
        try {
            $query = "SELECT username, account_type FROM users WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return [
                'username' => $user['username'] ?: 'Unknown User',
                'account_type' => $user['account_type'] ?: 'Unknown Account Type'
            ];
        } catch (PDOException $e) {
            // Log the error or throw a custom exception
            throw new RuntimeException('Failed to retrieve user data', 0, $e);
        }
    }
}
