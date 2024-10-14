<?php
require_once '../core/userController.php';
$userController = new userController();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? null;
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;

    if (empty($name) || empty($username) || empty($email)) {
        $error = "All fields are required!";
    } else {
        if (empty($password)) {
            $password = 'secretary123';
        }
        $position = 'SK Secretary'; 
        $role = 'secretary';
        $status = 'Inactive';

        if (!$error) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $result = $userController->createSecretaryAccount($name, $username, $email, $hashedPassword, $role, $position, $status);
            if ($result) {
                $success = "Secretary added successfully!";
                header("Location: manage-user.php");
                exit;
            } else {
                $error = "Failed to add secretary!";
            }
        }
    }
}
