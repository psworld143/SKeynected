<?php

include_once '../../core/Database.php';

class IndexController
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getUserById($userId)
    {
        try {
            $query = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user ?: ['username' => 'Unknown User', 'account_type' => 'Unknown Account Type'];
        } catch (PDOException $e) {
            throw new RuntimeException('Failed to retrieve user data', 0, $e);
        }
    }
}
