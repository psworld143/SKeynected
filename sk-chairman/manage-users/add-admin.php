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

    if (empty($fname) || empty($lname) || empty($username) || empty($email)) {
        $error = "All fields are required!";
    } else {
        if (empty($password)) {
            $password = 'admin123';
        }
        $role = 'admin';

        if (!$error) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $result = $userController->createAdmin($fname, $lname, $mname, $username, $email, $hashedPassword, $role);
            if ($result) {
                $success = "Admin added successfully!";
                header("Location: manage-admin.php");
                exit;
            } else {
                $error = "Failed to add admin!";
            }
        }
    }
}
