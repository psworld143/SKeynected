<?php

require_once "../../core/projectController.php";

$liquidation = new projectController();
$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Skeynected/lydo/manage-project/";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['project_id'] ?? null;
    $status = $_POST['status'] ?? null;
    $hearing_date = $_POST['hearingDate'] ?? null;
    $project_id = htmlspecialchars(trim($_POST['project_id'] ?? ''));

    if (empty($id) || empty($status)) {
        $_SESSION['error'] = 'Please provide both ID and status.';
        header("Location: " . $base_url . "projectOverview.php?project_id=" . urlencode($project_id));
        exit();
    }

    // Set hearing_date to null if not provided or status is not 'hearing'
    if ($status !== 'hearing' || empty($hearing_date)) {
        $hearing_date = null;
    }

    if ($liquidation->updateProjectStatus($id, $status, $hearing_date)) {
        $_SESSION['success'] = 'Project status updated successfully.';
    } else {
        $_SESSION['error'] = 'Failed to update project status.';
    }

    header("Location: " . $base_url . "projectOverview.php?project_id=" . urlencode($project_id));
    exit();
}
