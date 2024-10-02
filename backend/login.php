<?php
session_start();
require('dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password'];
    $secret_key = 'Skeynected123'; 

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $hashed_input_password = hash_hmac('sha256', $password, $secret_key);
        if (password_verify($hashed_input_password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['account_type'] = $user['account_type'];

            if ($user['account_type'] == 'admin') {
                header("Location: ../admin/index.php?user_id=" . $user['user_id']);
            } else if ($user['account_type'] == 'skchairman') {
                header("Location: ../skchairman/index.view.php?user_id=" . $user['user_id']);
            } 
            exit();
        } else {
            // Invalid password
            echo "<script>alert('Invalid username or password. Please try again.'); window.location.href = '../index.php';</script>";
        }
    } else {
        // Username not found
        echo "<script>alert('Invalid username or password. Please try again.'); window.location.href = '../index.php';</script>";
    }
}
?>
