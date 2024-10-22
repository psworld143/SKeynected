<?php
require_once '../../core/projectController.php';

$projectController = new projectController();
$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Skeynected/skchairman/manage-project/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_name = $_POST['task_name'] ?? null;
    $description = $_POST['description'] ?? null;
    $status = $_POST['status'] ?? 'pending';
    $project_id = $_POST['project_id'] ?? null;

    if (empty($task_name) || empty($project_id)) {
        $_SESSION['error'] = "Task name and project ID are required!";
    } else {
        $result = $projectController->addTask($project_id, $task_name, $description, $status);

        if ($result) {
            $_SESSION['success'] = "Task added successfully!";
        } else {
            $_SESSION['error'] = "Failed to add task.";
        }
    }
    header("Location: " . $base_url . "projectOverview.php?project_id=" . urlencode($project_id));
    exit;
}
