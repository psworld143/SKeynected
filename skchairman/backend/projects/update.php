<?php

include_once '../../views/project/controllers/project.controllers.php';

$projectController = new ProjectControllers();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $status = htmlspecialchars($_POST['status'] ?? '', ENT_QUOTES, 'UTF-8');
    $projectId = htmlspecialchars($_POST['project_id'] ?? '', ENT_QUOTES, 'UTF-8');


    if (empty($status)) {
        echo "Error: All fields are required.";
        exit();
    }

    try {
        $projectController->updateStatus(
            $projectId,        
            $status,      
        );

        echo "<script>alert('Status Updated successfully!');</script>";
        exit();
    } catch (RuntimeException $e) {
        echo "Error: " . $e->getMessage();
    }
}
