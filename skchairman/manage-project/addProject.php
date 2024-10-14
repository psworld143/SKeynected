<?php
header('Content-Type: application/json');

require_once '../core/projectController.php';
$projectController = new projectController();
$base_path = '../../'; 
$uploads_dir = $base_path . 'uploads/';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_name = $_POST['projectName'] ?? null;
    $project_code = $_POST['projectCode'] ?? null;
    $project_description = $_POST['projectDescription'] ?? null;
    $project_duration = $_POST['projectDuration'] ?? null;
    $status = $_POST['status'] ?? 'pending';
    $specific_job = $_POST['specificJob'] ?? null;
    $operations = $_POST['operations'] ?? null;
    $total_cost = $_POST['totalCost'] ?? null;
    $materials = isset($_POST['materials']) ? $_POST['materials'] : '[]';
    $proposal_file_path = null;
    $user_id = $_SESSION['id'] ?? null;

    if (!$user_id) {
        echo json_encode(['success' => false, 'message' => "User not logged in!"]);
        exit;
    }   

    if (empty($project_name) || empty($project_code) || empty($project_description) || empty($project_duration) || empty($status) || empty($specific_job) || empty($operations) || empty($total_cost)) {
        echo json_encode(['success' => false, 'message' => "All fields are required!"]);
        exit;
    }

    try {
        if (!file_exists($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }
        if (isset($_FILES['proposal']) && $_FILES['proposal']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['proposal']['tmp_name'];
            $proposal_file_path = 'uploads/' . basename($_FILES['proposal']['name']); // Use relative path for storage
            if (!move_uploaded_file($tmp_name, $uploads_dir . basename($_FILES['proposal']['name']))) {
                throw new Exception("Failed to move uploaded file.");
            }
        }

      
        $result = $projectController->createProject(
            $project_name,
            $project_code,
            $project_description,
            $project_duration,
            $status,
            $specific_job,
            $operations,
            $total_cost,
            $proposal_file_path,
            $materials,
            $user_id
        );

        if ($result) {
            echo json_encode(['success' => true, 'message' => "Project added successfully!"]);
        } else {
            throw new Exception("Failed to add project.");
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "An error occurred: " . $e->getMessage()]);
    }
    exit;
}


if ($success) {
    echo json_encode(['success' => true, 'message' => $success]);
} else {
    echo json_encode(['success' => false, 'message' => $error]);
}
exit;
