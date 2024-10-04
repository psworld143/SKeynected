<?php
require_once '../core/userController.php';
$userController = new userController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $status = $_POST['status'] ?? null;

    if (empty($id) || empty($status)) {
        $error = "All fields are required!";
    } else {
        $result = $userController->setSKStatus($id, $status);

        if ($result) {
            $success = "SK status updated successfully!";
            header("Location: sk-profile.php?id=" . urlencode($id));
            exit;
        } else {
            $error = "Failed to update SK status!";
        }
    }
}
