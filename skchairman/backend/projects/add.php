<?php

include_once '../../views/project/controllers/project.controllers.php';

$projectController = new ProjectControllers();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $projectName = htmlspecialchars($_POST['project_name'] ?? '', ENT_QUOTES, 'UTF-8');
    $totalCost = htmlspecialchars($_POST['total_cost'] ?? '', ENT_QUOTES, 'UTF-8');
    $projectDescription = htmlspecialchars($_POST['project_description'] ?? '', ENT_QUOTES, 'UTF-8');
    $startDate = htmlspecialchars($_POST['start_date'] ?? '', ENT_QUOTES, 'UTF-8');
    $endDate = htmlspecialchars($_POST['end_date'] ?? '', ENT_QUOTES, 'UTF-8');

    if (empty($projectName) || empty($projectDescription) || empty($startDate) || empty($endDate)) {
        echo "Error: All fields are required.";
        exit();
    }

    try {
        $last_id = $projectController->getNextProjectId();
        $projectId = 'SKP-' . str_pad($last_id, 6, '0', STR_PAD_LEFT);
        $projectCode = 'PRJ-' . strtoupper(bin2hex(random_bytes(3)));
        $projectController->addProject($projectId, $projectCode, $projectName, $projectDescription, $totalCost, $startDate, $endDate);

        echo "<script>alert('Project added successfully!');</script>";
        exit();
    } catch (RuntimeException $e) {
        echo "Error: " . $e->getMessage();
    }
}
