<?php
require_once '../core/projectController.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$project_id = isset($_GET['project_id']) ? (int)$_GET['project_id'] : 0;
if (!$project_id) { 
    echo json_encode(['error' => 'Project ID is required']);
    exit;
}

try {
    $projectController = new projectController();
    $materials = $projectController->getMaterialsForProject($project_id);
    $formattedMaterials = array_map(function ($material) {
        return [
            'material_id' => $material['material_id'] ?? '',
            'project_id' => $material['project_id'] ?? '',
            'material_name' => $material['material_name'] ?? 'Unknown',
            'quantity' => $material['quantity'] ?? 0,
            'amount' => $material['amount'] ?? 0,
            'total' => $material['total'] ?? '',
            'or_number' => $material['or_number'] ?? 0
        ];
    }, $materials);

    echo json_encode(['success' => true, 'materials' => $formattedMaterials]);
} catch (Exception $e) {
    echo json_encode(['error' => 'An error occurred while fetching materials: ' . $e->getMessage()]);
}
