<?php
session_start();
require_once '../../core/projectController.php';

$projectController = new projectController();
$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Skeynected/skchairman/manage-project/";

if (isset($_POST['task_id']) && isset($_POST['task_name']) && isset($_POST['status'])) {
    $task_id = $_POST['task_id'];
    $task_name = $_POST['task_name'];
    $status = $_POST['status'];

    // Call method to update task in the database
    $result = $projectController->updateTask($task_id, $task_name, $status);

    if ($result) {
        $_SESSION['success'] = "Task updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update task.";
    }
}


header("Location: " . $base_url . "projectOverview.php?project_id=" . urlencode($project_id));
exit;
