<?php
require_once '../../core/userController.php';
$userController = new userController();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_id = $_POST['user_id'] ?? null;
    if (empty($user_id)) {
        $error = "All fields are required!";
    } else {
        $result = $userController->deleteSecretaryAccount($user_id);

        if ($result) {
            $_SESSION['sucesss'] = "Deleted successfuly!";
            header("Location: ../manage-user.php");
            exit;
        } else {
            header("Location: ../manage-user.php");
            $_SESSION['error'] = "Something went wrong. Please try again later!";
            exit;
        }
    }
}
