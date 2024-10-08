<?php
header('Content-Type: application/json');

require_once '../core/projectController.php';
$projectController = new projectController();

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'] ?? null;
    $status = $_POST['status'] ?? null;
    $hearing_date = $_POST['hearing_date'] ?? null;
    if (empty($project_id) || empty($status)) {
        $response['message'] = 'All fields are required!';
    } else {
        $result = $projectController->updateStatus($project_id, $status, $hearing_date);

        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Project status updated!';
        } else {
            $response['message'] = 'Failed to update project status!';
        }
    }
}

echo json_encode($response);
