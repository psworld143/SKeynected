<?php

include_once '../../views/project/controllers/project.controllers.php';

$projectController = new ProjectControllers();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize inputs
    $purok = htmlspecialchars($_POST['purok_name'] ?? '', ENT_QUOTES, 'UTF-8');
    $barangay = htmlspecialchars($_POST['barangay_name'] ?? '', ENT_QUOTES, 'UTF-8');
    $skChairman = htmlspecialchars($_POST['sk_chairman'] ?? '', ENT_QUOTES, 'UTF-8');
    $projectDate = htmlspecialchars($_POST['project_date'] ?? '', ENT_QUOTES, 'UTF-8');
    $projectName = htmlspecialchars($_POST['project_name'] ?? '', ENT_QUOTES, 'UTF-8');
    $projectDescription = htmlspecialchars($_POST['project_description'] ?? '', ENT_QUOTES, 'UTF-8');
    $plans = htmlspecialchars($_POST['plans'] ?? '', ENT_QUOTES, 'UTF-8');
    $beneficiaries = htmlspecialchars($_POST['beneficiaries'] ?? '', ENT_QUOTES, 'UTF-8');
    $duration = htmlspecialchars($_POST['duration'] ?? '', ENT_QUOTES, 'UTF-8');
    $totalCost = htmlspecialchars($_POST['total_cost'] ?? '', ENT_QUOTES, 'UTF-8');

    // Check if any required field is empty
    if (
        empty($purok) || empty($barangay) || empty($skChairman) || empty($projectDate) || empty($projectName) ||
        empty($projectDescription) || empty($plans) || empty($beneficiaries) || empty($duration) || empty($totalCost)
    ) {
        echo "Error: All fields are required.";
        exit();
    }

    try {
        $last_id = $projectController->getNextProjectId();
        $projectId = 'SKP-' . str_pad($last_id, 6, '0', STR_PAD_LEFT);
        $projectCode = 'PRJ-' . strtoupper(bin2hex(random_bytes(3)));

        // Call addProject with parameters in the correct order
        $projectController->addProject(
            $projectId,         // project_id
            $projectCode,       // project_code
            $projectName,       // project_name
            $projectDescription, // project_description
            $totalCost,         // total_cost
            $purok,             // purok_name
            $barangay,          // barangay_name
            $skChairman,        // sk_chairman
            $projectDate,       // project_date
            $plans,             // plans
            $beneficiaries,     // beneficiaries
            $duration           // duration
        );

        echo "<script>alert('Project added successfully!');</script>";
        exit();
    } catch (RuntimeException $e) {
        echo "Error: " . $e->getMessage();
    }
}
