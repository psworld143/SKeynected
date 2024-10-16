<?php
session_start();
require_once '../../core/userController.php';

$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Skeynected/lydo/manage-user/";
$userController = new userController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $role = htmlspecialchars(trim($_POST['role'] ?? ''));
    $status = htmlspecialchars(trim($_POST['status'] ?? ''));
    $barangay_id = htmlspecialchars(trim($_POST['barangay_id'] ?? ''));
    $password = trim($_POST['password'] ?? ''); 


    if (empty($name) || empty($username) || empty($role) || empty($status) || empty($email) || empty($barangay_id)) {
        $_SESSION['error'] = "All fields are required!";
    } else {

        if (empty($password)) {
            switch ($role) {
                case 'skchairman':
                    $password = 'skchairman123';
                    break;
                case 'sksecretary':
                    $password = 'sksecretary123';
                    break;
                default:
                    $password = 'default123';
                    break;
            }
        }


        $position = ($role === 'skchairman') ? 'SK Chairman' : 'SK Secretary';


        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);


        $result = $userController->createSK($name, $username, $email, $hashedPassword, $role, $position, $status, $barangay_id);

        if ($result) {
            $_SESSION['success'] = "SK Account added successfully!";
        } else {
            $_SESSION['error'] = "Failed to add SK account!";
        }

        header("Location: " . $base_url . "SKtables.php?id=" . urlencode($barangay_id));
        exit;
    }
}
