<?php
require_once '../core/userController.php';
$userController = new userController();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['skname'] ?? null;
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $role = $_POST['role'] ?? null;
    $bgid = $_POST['bgid'] ?? null;


    if (empty($name) || empty($username) || empty($email) || empty($role) || empty($bgid)) {
        $error = "All fields are required!";
    } else {
        $password = 'sk123'; 

        if (!$error) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $result = $userController->createSK($name, $username, $email, $hashedPassword, $role, $bgid);

            if ($result) {
                $success = "SK added successfully!";
                header("Location: sk.php");
                exit;
            } else {
                $error = "Failed to add SK!";
            }
        }
    }
}
