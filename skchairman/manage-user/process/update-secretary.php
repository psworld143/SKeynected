<?php

require_once '../../core/userController.php';
$userController = new userController();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? null;
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $user_id = $_POST['user_id'] ?? null;  
    $status = $_POST['status'] ?? null;


    if (empty($name) || empty($username) || empty($email) || empty($user_id)) {
        $_SESSION['error'] = "All fields are required!";
    } else {
      
        $result = $userController->updateSecretaryAccount($user_id, $name, $username, $email, $status);

        if ($result) {
            $_SESSION['success'] = "Update successful!";
            header("Location: ../manage-user.php");
            exit;
        } else {
            header("Location: ../manage-user.php");
            $_SESSION['error'] = "Failed to update secretary!";
            exit;
        }
    }
}
