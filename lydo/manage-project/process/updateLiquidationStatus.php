<?php

require_once "../../core/projectController.php";

$liquidation = new projectController();
$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Skeynected/lydo/manage-project/";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $status = $_POST['status'] ?? null;
    $project_id = htmlspecialchars(trim($_POST['project_id'] ?? ''));

    if (empty($id) || empty($status)) {
        $_SESSION['error'] = 'Please provide both ID and status.';
        header("Location: " . $base_url . "projectOverview.php?project_id=" . urlencode($project_id));
        exit();
    }


    if ($liquidation->updateLiquidationStatus($id, $status)) {
        $_SESSION['success'] = 'Liquidation status updated successfully.';
    } else {
        $_SESSION['error'] = 'Failed to update liquidation status.';
    }


    header("Location: " . $base_url . "projectOverview.php?project_id=" . urlencode($project_id));
    exit();
}
