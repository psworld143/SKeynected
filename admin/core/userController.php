<?php

include_once 'Database.php';

class userController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function createUser($fname, $lname, $mname, $username, $email, $password, $role)
    {
        $query = "INSERT INTO users (firstname, lastname, middlename, username, email, password, role) VALUES (:firstname, :lastname, :middlename, :username, :email, :password, :role)";
        $stmt = $this->db->prepare($query);
        $params = [
            ':firstname' => $fname,
            ':lastname' => $lname,
            ':middlename' => $mname,
            ':username' => $username,
            ':email' => $email,
            ':password' => $password,
            ':role' => $role
        ];
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    public function getUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll();
    }
}
