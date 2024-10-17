<?php


require_once 'Database.php';

class SessionController
{


    private $db;
    private $base_url = "/SKeynected/skchairman/";

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }



    public function login($username, $password)
    {
        $query = "SELECT * FROM sk_members WHERE username = :username AND status = 'Active'";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['barangay_id'] = $user['barangay_id'];
            $_SESSION['u'] = $user['name'];
            $_SESSION['user'] = $user;
            $_SESSION['role'] = $user['role'];
            $_SESSION['logged_in'] = true;


            header("Location: dashboard.php");
            exit;
        } else {
            $_SESSION['error'] = 'Invalid username or password or account is inactive';
            header("Location: index.php");
            exit;
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
    public function checkLogin()
    {
        if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
            header("Location: " . $this->base_url . "404.php");
            exit();
        }
    }
}
