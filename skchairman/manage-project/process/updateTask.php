<?php
session_start();
require_once '../../core/projectController.php';

$projectController = new projectController();
$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Skeynected/skchairman/manage-project/";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = $_POST['task_id'];
    $project_id = $_POST['project_id'];
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $status = $_POST['status'];

    $result = $projectController->updateTask($task_id, $project_id, $task_name, $task_description, $status);

    if ($result) {
        $_SESSION['success'] = "Task updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update task.";
    }
}


header("Location: " . $base_url . "projectOverview.php?project_id=" . urlencode($project_id));
exit;
