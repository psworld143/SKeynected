<?php
require_once '../core/userController.php';
$userController = new userController();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'] ?? null;
    $lname = $_POST['lname'] ?? null;
    $mname = $_POST['mname'] ?? null;
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $role = $_POST['role'] ?? null;

    if (empty($fname) || empty($lname) || empty($username) || empty($email) || empty($role)) {
        $error = "All fields are required!";
    } else {
        if ($role === 'skchairman') {
            $password = 'skchairman123';
        } elseif ($role === 'admin') {
            $password = 'admin123';
        } elseif (empty($password)) {
            $error = "Password is required for other roles!";
        }

        if (!$error) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $result = $userController->createUser($fname, $lname, $mname, $username, $email, $hashedPassword, $role);

            if ($result) {
                header("Location: manage-users.php");
                exit;
            } else {
                $error = "Failed to add user!";
            }
        }
    }
}
