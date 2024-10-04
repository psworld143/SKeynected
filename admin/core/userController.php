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

    public function createAdmin($fname, $lname, $mname, $username, $email, $password,  $role)
    {
        $query = "INSERT INTO admins(firstname, lastname, middlename, username, email, password, role) VALUES (:firstname, :lastname, :middlename, :username, :email, :password, :role)";
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

    public function createSK($skname, $username, $email, $password, $role,  $position, $status, $barangay_id)
    {
        $query = "INSERT INTO sk_members (name, username, email, password, role, position, status, barangay_id) VALUES (:name, :username, :email,  :password, :role, :position, :status, :barangay_id)";
        $stmt = $this->db->prepare($query);
        $params = [
            ':name' => $skname,
            ':username' => $username,
            ':email' => $email,
            ':password' => $password,
            ':role' => $role,
            ':position' => $position,
            ':status' => $status,
            ':barangay_id' => $barangay_id
        ];

        $stmt->execute($params);
        return $stmt->rowCount();
    }


    public function setSKStatus($id, $status)
    {
        $query = "UPDATE sk_members SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $params = [
            ':status' => $status,
            ':id' => $id
        ];
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    public function getAdminUsers()
    {
        $query = "SELECT * FROM admins";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll();
    }

    public function getBarangays()
    {
        $query = "SELECT * FROM  barangays";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll();
    }
}
