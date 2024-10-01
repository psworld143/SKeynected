<?php
session_start();
require('dbcon.php'); // Include your database connection file

if (isset($_POST['firstname'])) {

    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = 'Seait123'; // Default password
    $account_type = mysqli_real_escape_string($con, $_POST['account_type']);

    // Define a secret key for hashing (keep this secure)
    $secret_key = 'Skeynected123'; // Replace with a secure key

    // Hash the password with the secret key
    $hashed_password = password_hash(hash_hmac('sha256', $password, $secret_key), PASSWORD_DEFAULT);

    // Get the current date and time for 'date_added'
    $date_added = date('Y-m-d H:i:s');

    // Check for duplicates in firstname, lastname, and username
    $query = "SELECT * FROM users WHERE 
              (firstname = '$firstname' AND lastname = '$lastname') 
              OR username = '$username'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $rows = mysqli_num_rows($result);

    if ($rows > 0) {
        // Fetch the result to determine what is duplicated
        $duplicate = mysqli_fetch_assoc($result);

        if ($duplicate['username'] === $username) {
            echo "<script>alert('Username already exists. Please choose a different username.'); window.location.href = '../user.php';</script>";
        } elseif ($duplicate['firstname'] === $firstname && $duplicate['lastname'] === $lastname) {
            echo "<script>alert('A user with the same name (firstname and lastname) already exists.'); window.location.href = '../user.php';</script>";
        }
        exit();

    } else {
        // No duplicates found, proceed to insert the user data
        $query = "INSERT INTO users (firstname, middlename, lastname, username, password, account_type, created_at) 
                  VALUES ('$firstname', '$middlename', '$lastname', '$username', '$hashed_password', '$account_type', '$date_added')";
        $result = mysqli_query($con, $query);
    
        if ($result) {
            echo "<script>alert('User added successfully!'); window.location.href = '../user.php';</script>";
        } else {
            echo "<script>alert('Error adding user: " . mysqli_error($con) . ". Please try again.'); window.location.href = '../user.php';</script>";
        }
        exit();
    }
}
?>
