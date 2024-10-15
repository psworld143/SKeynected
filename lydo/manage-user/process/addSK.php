<?php
require_once '../../core/userController.php';
$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Skeynected/lydo/manage-user/";
$userController = new userController();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? null;
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $role = $_POST['role'] ?? null;
    $status = $_POST['status'] ?? null;
    $password = $_POST['password'] ?? '';
    $barangay_id = $_POST['barangay_id'] ?? null;

    if (empty($name) || empty($username) || empty($role) || empty($status) || empty($email) || empty($barangay_id)) {
        $_SESSION['error'] = "All fields are required!";
    } else {

        if (empty($password)) {
            if ($role === 'skchairman') {
                $password = 'skchairman123';
            } elseif ($role === 'sksecretary') {
                $password = 'sksecretary123';
            } else {
                $password = 'default123';
            }
        }
        $position = ($role === 'skchairman') ? 'SK Chairman' : 'SK Secretary';


        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $result = $userController->createSK($name, $username, $email, $hashedPassword, $role, $position, $status, $barangay_id);

        if ($result) {
            $_SESSION['success'] = "SK Account added successfully!";
            header("Location: " . $base_url . "SKtables.php?id=" . urlencode($barangay_id));
            exit;
        } else {
            $_SESSION['error'] = "Failed to add SK account!";
        }
    }
}
