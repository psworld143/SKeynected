<?php

require_once 'Database.php';

class SessionController
{


    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function login()
    {
        var_dump($_POST);
        $query = "SELECT * FROM admins WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $_POST['username']);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['user'] = $user;
            $_SESSION['logged_in'] = true;
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid username or password";
        }
    }
}
