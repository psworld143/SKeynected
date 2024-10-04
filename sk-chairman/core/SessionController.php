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
        $params = [':username' => $_POST['username']];
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        $user = $stmt->fetch();

        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['u'] = trim($user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname']);
            $_SESSION['user'] = $user;
            $_SESSION['logged_in'] = true;
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid username or password";
        }
    }

    public function logout()
    {
        
        $_SESSION = array();

    
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();

        
        header("Location: ./index.php");
        exit();
    }
}
