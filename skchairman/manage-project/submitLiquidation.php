<?php
require_once '../core/projectController.php';
$projectController = new projectController();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}


try {
    $result = $projectController->submitLiquidation($_POST, $_FILES);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Liquidation submitted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to submit liquidation']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
