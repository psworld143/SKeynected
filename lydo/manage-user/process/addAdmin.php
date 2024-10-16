<?php
session_start();
require_once '../../core/userController.php';

$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Skeynected/lydo/manage-user/";
$userController = new userController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = htmlspecialchars(trim($_POST['fname'] ?? ''));
    $lname = htmlspecialchars(trim($_POST['lname'] ?? ''));
    $mname = htmlspecialchars(trim($_POST['mname'] ?? ''));
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $role = $_POST['role'] ?? null;
    $password = $_POST['password'] ?? null;

    if (empty($fname) || empty($lname) || empty($username) || empty($email)) {
        $_SESSION['error'] = "All required fields must be filled!";
    } else {
        // Default password for now,
        //* -> We can improve this by sending an email to the user with a link to set their password 
        if (empty($password)) {
            $password = 'admin123';
        }
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $result = $userController->createAdmin($fname, $lname, $mname, $username, $email, $hashedPassword, $role);

        if ($result) {
            $_SESSION['success'] = "Admin account added successfully!";
        } else {
            $_SESSION['error'] = "Failed to add admin account!";
        }

       
        header("Location: " . $base_url . "adminTables.php");
        exit;
    }
}
