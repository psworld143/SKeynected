<?php
require_once '../core/userController.php';
$userController = new userController();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['skname'] ?? null;
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $position = $_POST['position'] ?? null;
    $bgid = $_POST['bgid'] ?? null;
    $status = 'Inactive';

    if (empty($name) || empty($username) || empty($email) || empty($position) || empty($bgid)) {
        $error = "All fields are required!";
    } else {
        $password = 'sk123';
        $role = 'sk'; 

       
        if ($position === 'SK Chairman') {
            $role = 'skchairman';
        } elseif ($position === 'SK Secretary') {
            $role = 'sksecretary';
        }

        if (!$error) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $result = $userController->createSK($name, $username, $email, $hashedPassword, $role, $position, $status, $bgid);

            if ($result) {
                $success = "SK added successfully!";
                header("Location: sk.php?id=" . urlencode($bgid));
                exit;
            } else {
                $error = "Failed to add SK!";
            }
        }
    }
}
