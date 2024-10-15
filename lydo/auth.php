<?php
require_once 'core/SessionController.php';
$session = new SessionController();
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'All fields are required';
        header('Location: index.php');
        exit();
    }

    $user = $session->login($username, $password);

    if ($user) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['u'] = trim($user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname']);
        $_SESSION['user'] = $user;
        $_SESSION['role'] = $user['role'];
        $_SESSION['logged_in'] = true;
        $_SESSION['success'] = 'Successfully logged in';
        header('Location: dashboard.php');
    } else {
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: index.php');
    }

    exit();
}
