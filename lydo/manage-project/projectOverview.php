<?php
require_once '../core/projectController.php';
require_once '../core/userController.php';
$projectController = new projectController();
$userController = new userController();

$projects = [];


$project_id = isset($_GET['project_id']) ? (int) $_GET['project_id'] : 0;

if ($project_id > 0) {
    $projects = $projectController->getProjectsById($project_id);
    $materials = $projectController->getMaterialsByProjectId($project_id);
    $disbursements = $projectController->getDisbursementByBarangay($project_id);
    $liquidations = $projectController->getLiquidationByBarangay($project_id);

    $tasksWithUpdates = $projectController->getTasks($project_id);
}

$file = basename($projects['proposal_file_path']);
$preview_url = "process/preview.php?file=" . urlencode($file);
$download_url = "process/download.php?file=" . urlencode($file);
$preview_or = "process/preview_or.php?file=" . urlencode($file);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Project and Materials Tables</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="../assets/img/LYDOO.jpg" rel="icon">
    <link href="../assets/img/SK-logo.png" rel="apple-touch-icon">

    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="../assets/css/style.css" rel="stylesheet">

    <style>
        .btn-close {
            background: transparent;
            border: 0;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1rem;
            max-height: 70vh;
            overflow-y: auto;
        }

        .download-link {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin: 1rem;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 0.25rem;
            transition: background-color 0.2s;
        }

        .download-link:hover {
            background-color: #0056b3;
        }

        .btn {
            width: 100px;
            height: 40px;
            padding: 6px 0;
            border-radius: 4px;
            text-align: center;
            font-size: 1.2rem;
            line-height: 1.428571429;
        }

        .icon-bg {
            border-radius: 4px;
            width: 30px;
            display: inline-block;
            text-align: center;
            cursor: pointer;
        }

        .icon-bg.edit {
            background-color: #007bff;
            color: white;
        }

        .icon-bg.delete {
            background-color: #dc3545;
            color: white;
        }

        .icon-bg.view {
            background-color: #007bff;
            color: white;
        }

        .icon-bg.update-status {
            background-color: green;
        }

        .icon-bg i {
            font-size: 16px;
            color: white;
        }

        .icon-bg:hover {
            opacity: 0.8;
        }

        .badge {
            padding: 0.5em 1em;
            border-radius: 50px;
            font-weight: bold;
        }

        .bg-pending {
            background-color: orange;
            color: white;
        }

        .bg-hearing {
            background-color: blue;
            color: white;
        }

        .bg-approved {
            background-color: lightgreen;
            color: white;
        }

        .bg-for-clarrification {
            background-color: blue;
            color: white;
        }

        .bg-declined {
            background-color: red;
            color: white;
        }

        .bg-info {
            background-color: #17a2b8;
            color: white;
        }

        .nav-link {
            color: #175895;
        }
    </style>
</head>

<body>
    <?php
    include_once '../partials/navbar.php';
    include_once '../partials/sidebar.php';
    ?>

    <main id="main" class="main" style="margin-top: 100px;">
        <div class="pagetitle">
            <h1><b><?= $projects['project_name'] ?></b> and Materials Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Barangay <?= $projects['barangay_name'] ?> Project</h5>
                            <div
                                class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                <div class="datatable-top mb-3">
                                    <div class="datatable-dropdown">
                                        <label>
                                            <select class="datatable-selector" name="per-page">
                                                <option value="5">5</option>
                                                <option value="10" selected="">10</option>
                                                <option value="15">15</option>
                                                <option value="-1">All</option>
                                            </select> entries per page
                                        </label>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="projectTabs"
                                            role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="project-tab" data-bs-toggle="tab"
                                                    data-bs-target="#project" type="button" role="tab"
                                                    aria-controls="project" aria-selected="true">Project</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="materials-tab" data-bs-toggle="tab"
                                                    data-bs-target="#materials" type="button" role="tab"
                                                    aria-controls="materials" aria-selected="false">Materials</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="budget-disbursement-tab"
                                                    data-bs-toggle="tab" data-bs-target="#budget-disbursement"
                                                    type="button" role="tab" aria-controls="budget-disbursement"
                                                    aria-selected="false">Budget Disbursement</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="budget-liquidation-tab"
                                                    data-bs-toggle="tab" data-bs-target="#budget-liquidation"
                                                    type="button" role="tab" aria-controls="budget-liquidation"
                                                    aria-selected="false">Budget Liquidation</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="projectTabsContent">
                                    <div class="tab-pane fade show active" id="project" role="tabpanel"
                                        aria-labelledby="project-tab">
                                        <div class="datatable-top">
                                            <div class="datatable-dropdown">

                                            </div>
                                            <div class="d-flex align-items-center">
                                                <!-- <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                                                    <i class="bi bi-arrow-clockwise"></i> Update Status
                                                </button> -->
                                                <div class="datatable-search">
                                                    <input class="datatable-input" placeholder="Search..." type="search"
                                                        name="search" title="Search within table">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="datatable-container">
                                            <table class="table datatable datatable-table">
                                                <thead>
                                                    <tr>
                                                        <th><b>Project Name</b></th>
                                                        <th>Project Code</th>
                                                        <th>Description</th>
                                                        <th>Duration</th>
                                                        <th>Status</th>
                                                        <th>Hearing Schedule</th>
                                                        <th>Specific Job</th>
                                                        <th>Operation</th>
                                                        <th>Total Cost</th>
                                                        <th>Proposal</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- PHP logic for displaying projects -->
                                                    <?php if (!empty($projects)): ?>
                                                        <tr>
                                                            <td><strong
                                                                    class="text-primary"><?php echo htmlspecialchars($projects['project_name']) ?></strong>
                                                            </td>
                                                            <td class="text-secondary">
                                                                <?php echo htmlspecialchars($projects['project_code']); ?>
                                                            </td>
                                                            <td class="text-muted">
                                                                <?php echo htmlspecialchars($projects['project_description']); ?>
                                                            </td>
                                                            <td class="text-secondary">
                                                                <?php echo htmlspecialchars($projects['project_duration']); ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $statusClass = 'bg-info';
                                                                switch ($projects['status']) {
                                                                    case 'pending':
                                                                        $statusClass = 'bg-pending';
                                                                        break;
                                                                    case 'hearing':
                                                                        $statusClass = 'bg-hearing';
                                                                        break;
                                                                    case 'approved':
                                                                        $statusClass = 'bg-approved';
                                                                        break;
                                                                    case 'declined':
                                                                        $statusClass = 'bg-declined';
                                                                        break;
                                                                }
                                                                ?>
                                                                <span class="badge <?php echo $statusClass; ?>">
                                                                    <?php echo htmlspecialchars($projects['status']); ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if (!empty($projects['hearing_schedule'])) {
                                                                    echo htmlspecialchars(date('Y-m-d', strtotime($projects['hearing_schedule'])));
                                                                } else {
                                                                    echo '';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-secondary">
                                                                <?php echo htmlspecialchars($projects['specific_job']); ?>
                                                            </td>
                                                            <td class="text-secondary">
                                                                <?php echo htmlspecialchars($projects['operations']); ?>
                                                            </td>
                                                            <td class="text-success fw-bold">
                                                                <?php echo htmlspecialchars($projects['total_cost']); ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <span class="icon-bg view me-1" data-bs-toggle="modal"
                                                                        data-bs-target="#previewModal">
                                                                        <a href="<?php echo htmlspecialchars($preview_url); ?>"
                                                                            class="preview-link">
                                                                            <i class="bi bi-eye "></i>
                                                                        </a>
                                                                    </span>
                                                                    <span class="icon-bg view">
                                                                        <a href="<?php echo htmlspecialchars($download_url); ?>"
                                                                            download>
                                                                            <i class="bi bi-download "></i>
                                                                        </a>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-center">
                                                                    <span class="icon-bg update-status me-1"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#updateStatusModal"
                                                                        data-id="<?php echo $project['id']; ?>"
                                                                        data-status="<?php echo htmlspecialchars($project['status']); ?>"
                                                                        data-project-id="<?php echo htmlspecialchars($project_id); ?>">
                                                                        <i class="bi bi-arrow-up-circle"></i>
                                                                    </span>
                                                                    <span class="icon-bg edit me-1" data-bs-toggle="modal"
                                                                        data-bs-target="#editModal"
                                                                        data-id="<?php echo $projects['project_id']; ?>"
                                                                        data-name="<?php echo htmlspecialchars($projects['project_name']); ?>"
                                                                        data-code="<?php echo htmlspecialchars($projects['project_code']); ?>"
                                                                        data-description="<?php echo htmlspecialchars($projects['project_description']); ?>">
                                                                        <i class="bi bi-pencil"></i>
                                                                    </span>
                                                                    <span class="icon-bg delete" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteModal"
                                                                        data-id="<?php echo $projects['project_id']; ?>">
                                                                        <i class="bi bi-trash"></i>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="11" class="text-center text-muted">No projects
                                                                found.</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                            <div class="col-lg-12 mt-2">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5 class="card-title mb-0">Recent Activity <span>| Today</span>
                                                    </h5>
                                                </div>
                                                <div class="activity">
                                                    <?php if (!empty($tasksWithUpdates)): ?>
                                                        <?php foreach ($tasksWithUpdates as $task): ?>
                                                            <div class="activity-item d-flex">
                                                                <div class="activite-label ">
                                                                    <?php
                                                                    if (!empty($task['updatedAt']) && strtotime($task['updatedAt']) > strtotime($task['createdAt'])) {
                                                                        $display_time = strtotime($task['updatedAt']);

                                                                    } else {
                                                                        $display_time = strtotime($task['createdAt']);

                                                                    }

                                                                    $current_time = time();
                                                                    $time_diff = ($current_time - $display_time) / 60;


                                                                    if ($time_diff < 0) {
                                                                        echo 'Just now';
                                                                    } elseif ($time_diff < 60) {
                                                                        echo floor($time_diff) . ' min ago';
                                                                    } elseif ($time_diff < 1440) {
                                                                        echo floor($time_diff / 60) . ' hrs ago';
                                                                    } else {
                                                                        echo floor($time_diff / 1440) . ' days ago';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <i class="bi bi-circle-fill activity-badge
                                                                <?php
                                                                if ($task['status'] == 'completed')
                                                                    echo 'text-success';
                                                                elseif ($task['status'] == 'in_progress')
                                                                    echo 'text-primary';
                                                                else
                                                                    echo 'text-warning';
                                                                ?> align-self-start">
                                                                </i>
                                                                <div class="activity-content flex-grow-1"
                                                                    style="padding-bottom: 1.5rem;">
                                                                    <div style="font-weight: 500;">
                                                                        <?php echo $task['name']; ?>
                                                                    </div>
                                                                    <div class="text-muted">
                                                                        <?php echo $task['description']; ?>
                                                                    </div>

                                                                </div>
                                                            </div><!-- End activity item -->
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <p>No recent activity found.</p>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="materials" role="tabpanel"
                                        aria-labelledby="materials-tab">
                                        <div class="col-lg-12 ">
                                            <div
                                                class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                                <div class="datatable-container">
                                                    <table class="table datatable datatable-table">
                                                        <thead>
                                                            <tr>
                                                                <th><b>Material</b></th>
                                                                <th>Qty</th>
                                                                <th>Amount</th>

                                                                <th>Cost</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- PHP logic for displaying materials -->
                                                            <?php if (!empty($materials)): ?>
                                                                <?php foreach ($materials as $material): ?>
                                                                    <tr>
                                                                        <td><strong
                                                                                class="text-primary"><?php echo htmlspecialchars($material['material_name']) ?></strong>
                                                                        </td>
                                                                        <td class="text-secondary">
                                                                            <?php echo htmlspecialchars($material['quantity']); ?>
                                                                        </td>
                                                                        <td class="text-success">
                                                                            <?php echo htmlspecialchars($material['amount']); ?>
                                                                        </td>
                                                                        <td class="text-success fw-bold">
                                                                            <?php echo htmlspecialchars($material['total']); ?>
                                                                        </td>
                                                                        <td>
                                                                            <div class="d-flex">
                                                                                <span class="icon-bg edit me-2"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#editMaterialModal"
                                                                                    data-id="<?php echo $material['material_id']; ?>"
                                                                                    data-name="<?php echo htmlspecialchars($material['material_name']); ?>"
                                                                                    data-quantity="<?php echo htmlspecialchars($material['quantity']); ?>"
                                                                                    data-amount="<?php echo htmlspecialchars($material['amount']); ?>">
                                                                                    <i class="bi bi-pencil "></i>
                                                                                </span>
                                                                                <span class="icon-bg delete"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#deleteMaterialModal"
                                                                                    data-id="<?php echo $material['material_id']; ?>">
                                                                                    <i class="bi bi-trash"></i>
                                                                                </span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <tr>
                                                                    <td colspan="6" class="text-center text-muted">No
                                                                        materials found.</td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="budget-disbursement" role="tabpanel"
                                        aria-labelledby="budget-disbursement-tab">
                                        <div class="datatable-container">
                                            <div class="datatable-top mb-3">
                                                <div class="datatable-dropdown">

                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <button class="btn btn-primary me-2" data-bs-toggle="modal"
                                                        data-bs-target="#addDisbursementModal">
                                                        <i class="bi bi-plus-circle"></i> Add Disbursement
                                                    </button>
                                                    <div class="datatable-search">
                                                        <input class="datatable-input" placeholder="Search..."
                                                            type="search" name="search" title="Search within table">
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table datatable datatable-table">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Amount</th>
                                                        <th>Purpose</th>
                                                        <th>Notes</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- PHP logic for displaying budget disbursements -->
                                                    <?php if (!empty($disbursements)): ?>
                                                        <?php foreach ($disbursements as $disbursement): ?>
                                                            <tr>
                                                                <td><strong
                                                                        class="text-primary"><?php echo htmlspecialchars($disbursement['disbursement_id']) ?></strong>
                                                                </td>
                                                                <td class="text-secondary">
                                                                    <?php echo htmlspecialchars($disbursement['date']); ?>
                                                                </td>
                                                                <td class="text-success">
                                                                    <?php echo htmlspecialchars($disbursement['amount']); ?>
                                                                </td>
                                                                <td class="text-muted">
                                                                    <?php echo htmlspecialchars($disbursement['purpose']); ?>
                                                                </td>
                                                                <td class="text-muted">
                                                                    <?php echo htmlspecialchars($disbursement['notes']); ?>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge <?php echo $disbursement['status'] === 'approved' ? 'bg-approved' : ($disbursement['status'] === 'pending' ? 'bg-pending' : 'bg-declined'); ?>">
                                                                        <?php echo htmlspecialchars($disbursement['status']); ?>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <span class="icon-bg edit me-1" data-bs-toggle="modal"
                                                                            data-bs-target="#editDisbursementModal"
                                                                            data-id="<?php echo $disbursement['disbursement_id']; ?>"
                                                                            data-amount="<?php echo htmlspecialchars($disbursement['amount']); ?>"
                                                                            data-purpose="<?php echo htmlspecialchars($disbursement['purpose']); ?>"
                                                                            data-notes="<?php echo htmlspecialchars($disbursement['notes']); ?>">
                                                                            <i class="bi bi-pencil"></i>
                                                                        </span>
                                                                        <span class="icon-bg delete" data-bs-toggle="modal"
                                                                            data-bs-target="#deleteDisbursementModal"
                                                                            data-id="<?php echo $disbursement['disbursement_id']; ?>">
                                                                            <i class="bi bi-trash"></i>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="7" class="text-center text-muted">No disbursements
                                                                found.</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Add Disbursement Modal -->
                                        <div class="modal fade" id="addDisbursementModal" tabindex="-1"
                                            aria-labelledby="addDisbursementModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addDisbursementModalLabel">Add
                                                            Disbursement</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="mb-3">
                                                                <label for="amount" class="form-label">Amount</label>
                                                                <input type="text" class="form-control" id="amount"
                                                                    placeholder="Enter amount">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="purpose" class="form-label">Purpose</label>
                                                                <input type="text" class="form-control" id="purpose"
                                                                    placeholder="Enter purpose">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-select" id="status">
                                                                    <option value="approved">Approved</option>
                                                                    <option value="pending">Pending</option>
                                                                    <option value="declined">Declined</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="notes" class="form-label">Notes</label>
                                                                <textarea class="form-control" id="notes"
                                                                    placeholder="Enter notes"></textarea>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="budget-liquidation" role="tabpanel"
                                        aria-labelledby="budget-liquidation-tab">
                                        <div class="datatable-container">
                                            <table class="table datatable datatable-table">
                                                <thead>
                                                    <tr>
                                                        <th>Material name</th>
                                                        <th>Quantity</th>
                                                        <th>Amount</th>
                                                        <th>OR</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($liquidations)): ?>
                                                        <?php foreach ($liquidations as $liquidation):
                                                            $file_name = basename($liquidation['or_image_path']);
                                                            $image_url = 'process/preview_or.php?file=' . urlencode($file_name);
                                                            ?>
                                                            <tr>
                                                                <td><strong
                                                                        class="text-primary"><?php echo htmlspecialchars($liquidation['material_name']); ?></strong>
                                                                </td>
                                                                <td class="text-secondary">
                                                                    <?php echo htmlspecialchars($liquidation['quantity']); ?>
                                                                </td>
                                                                <td class="text-success">
                                                                    <?php echo htmlspecialchars($liquidation['amount']); ?>
                                                                </td>
                                                                <td class="text-muted">
                                                                    <a href="<?php echo $image_url; ?>" target="_blank">
                                                                        <img src="<?php echo $image_url; ?>" alt="OR Image"
                                                                            width="50px">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge <?php echo $liquidation['status'] === 'approved' ? 'bg-approved' : ($liquidation['status'] === 'pending' ? 'bg-pending' : ($liquidation['status'] === 'for-clarrification' ? 'bg-for-clarrification' : 'bg-declined')); ?>">
                                                                        <?php echo htmlspecialchars($liquidation['status']); ?>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <div class="">

                                                                        <span class="icon-bg update-status me-1"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#liquidationStatus"
                                                                            data-id="<?php echo $liquidation['id']; ?>"
                                                                            data-status="<?php echo htmlspecialchars($liquidation['status']); ?>"
                                                                            data-project-id="<?php echo htmlspecialchars($project_id); ?>">
                                                                            <i class="bi bi-arrow-up-circle"></i>
                                                                        </span>


                                                                        <span class="icon-bg edit me-1" data-bs-toggle="modal"
                                                                            data-bs-target="#editLiquidationModal"
                                                                            data-id="<?php echo $liquidation['id']; ?>"
                                                                            data-amount="<?php echo htmlspecialchars($liquidation['amount']); ?>"
                                                                            data-material-name="<?php echo htmlspecialchars($liquidation['material_name']); ?>"
                                                                            data-quantity="<?php echo htmlspecialchars($liquidation['quantity']); ?>"
                                                                            data-amount="<?php echo htmlspecialchars($liquidation['amount']); ?>"
                                                                            data-status="<?php echo htmlspecialchars($liquidation['status']) ?>">
                                                                            <i class="bi bi-pencil"></i>
                                                                        </span>
                                                                        <span class="icon-bg delete" data-bs-toggle="modal"
                                                                            data-bs-target="#deleteDisbursementModal"
                                                                            data-id="<?php echo $disbursement['disbursement_id']; ?>">
                                                                            <i class="bi bi-trash"></i>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="7" class="text-center text-muted">No Liquidation
                                                                found.</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <!-- Update Liquidation Status Modal -->
        <div class="modal fade" id="liquidationStatus" tabindex="-1" aria-labelledby="liquidationStatus"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="liquidationStatusLabel">Update Liquidation Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateStatusForm" action="process/updateLiquidationStatus.php" method="post">
                            <input type="hidden" name="id" id="update-liquidation-id">
                            <input type="hidden" name="project_id" id="update-project-id"
                                value="<?php echo htmlspecialchars($project_id); ?>">
                            <div class="mb-3">
                                <label for="update-status" class="form-label">Select Status</label>
                                <select class="form-select" id="update-status" name="status" required>
                                    <option value="pending">Pending</option>
                                    <option value="for-clarrification">For Clarification</option>
                                    <option value="approved">Approved</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Edit Liquidation Modal -->
        <div class="modal fade" id="editLiquidationModal" tabindex="-1" aria-labelledby="editLiquidationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLiquidationModalLabel">Edit Liquidation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editLiquidationForm" action="process/updateLiquidation.php" method="post">
                            <input type="hidden" name="id" id="edit-liquidation-id">
                            <div class="mb-3">
                                <label for="edit-material-name" class="form-label">Material Name</label>
                                <input type="text" class="form-control" id="edit-material-name" name="material_name"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="edit-quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="edit-quantity" name="quantity" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit-amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="edit-amount" name="amount" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit-status" class="form-label">Status</label>
                                <select class="form-select" id="edit-status" name="status" required>
                                    <option value="pending">Pending</option>
                                    <option value="for-clarrification">For Clarification</option>
                                    <option value="approved">Approved</option>
                                    <option value="declined">Declined</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" form="editLiquidationForm">Save
                                    changes</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="previewModalLabel">File Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body" id="previewContent">
                        <!-- Preview content will be loaded here -->
                    </div>
                    <a href="<?php echo htmlspecialchars($download_url); ?>" download class="download-link">
                        Download Proposal
                    </a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateStatusModalLabel">Update Project Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateStatusForm" action="process/updateProjectStatus.php" method="POST">
                            <input type="hidden" name="project_id" id="update-project-id"
                                value="<?php echo htmlspecialchars($project_id); ?>">
                            <div class="mb-3">
                                <label for="statusSelect" class="form-label">Select Status</label>
                                <select class="form-select" id="statusSelect" name="status"
                                    onchange="toggleHearingDate()">
                                    <option value="pending">Pending</option>
                                    <option value="hearing">Hearing</option>
                                    <option value="approved">Approved</option>
                                    <option value="declined">Declined</option>
                                </select>
                            </div>

                            <div class="mb-3" id="hearingDateDiv" style="display:none;">
                                <label for="hearingDate" class="form-label">Hearing Date</label>
                                <input type="date" class="form-control" id="hearingDate" name="hearingDate">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/vendor/chart.js/chart.umd.js"></script>
        <script src="../assets/vendor/echarts/echarts.min.js"></script>
        <script src="../assets/vendor/quill/quill.js"></script>
        <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="../assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="../assets/js/main.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const previewLinks = document.querySelectorAll('.preview-link');
                const previewContent = document.getElementById('previewContent');

                previewLinks.forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        const url = this.getAttribute('href');
                        fetch(url)
                            .then(response => response.text())
                            .then(data => {
                                previewContent.innerHTML = data;
                            })
                            .catch(error => {
                                previewContent.innerHTML = 'Error loading preview: ' + error;
                            });
                    });
                });
            });

            function toggleHearingDate() {
                const statusSelect = document.getElementById('statusSelect');
                const hearingDateDiv = document.getElementById('hearingDateDiv');

                if (statusSelect.value === 'hearing') {
                    hearingDateDiv.style.display = 'block';
                } else {
                    hearingDateDiv.style.display = 'none';
                }
            }


            document.addEventListener('DOMContentLoaded', function () {

                const previewLinks = document.querySelectorAll('.preview-link');
                const previewContent = document.getElementById('previewContent');

                previewLinks.forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        const url = this.getAttribute('href');
                        fetch(url)
                            .then(response => response.text())
                            .then(data => {
                                previewContent.innerHTML = data;
                            })
                            .catch(error => {
                                previewContent.innerHTML = 'Error loading preview: ' + error;
                            });
                    });
                });


                const tabs = document.querySelectorAll('#projectTabs button');
                tabs.forEach(tab => {
                    tab.addEventListener('click', function (e) {
                        e.preventDefault();
                        const tabId = this.getAttribute('data-bs-target');
                        document.querySelector(tabId).classList.add('show', 'active');
                        this.classList.add('active');
                        tabs.forEach(otherTab => {
                            if (otherTab !== this) {
                                otherTab.classList.remove('active');
                                const otherTabId = otherTab.getAttribute('data-bs-target');
                                document.querySelector(otherTabId).classList.remove('show', 'active');
                            }
                        });
                    });
                });
            });

            function toggleHearingDate() {
                const statusSelect = document.getElementById('statusSelect');
                const hearingDateDiv = document.getElementById('hearingDateDiv');
                const hearingDateInput = document.getElementById('hearingDate');

                if (statusSelect.value === 'hearing') {
                    hearingDateDiv.style.display = 'block';
                } else {
                    hearingDateDiv.style.display = 'none';
                    hearingDateInput.value = ''; // Clear the date when not "hearing"
                }
            }



            document.querySelectorAll('.edit').forEach(function (editBtn) {
                editBtn.addEventListener('click', function () {

                    const id = this.getAttribute('data-id');
                    const materialName = this.getAttribute('data-material-name');
                    const quantity = this.getAttribute('data-quantity');
                    const amount = this.getAttribute('data-amount');
                    const status = this.getAttribute('data-status');


                    document.getElementById('edit-liquidation-id').value = id;
                    document.getElementById('edit-material-name').value = materialName;
                    document.getElementById('edit-quantity').value = quantity;
                    document.getElementById('edit-amount').value = amount;
                    document.getElementById('edit-status').value = status;
                });
            });

            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('liquidationStatus');

                modal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');
                    const status = button.getAttribute('data-status');
                    const projectId = button.getAttribute('data-project-id');

                    document.getElementById('update-liquidation-id').value = id;
                    document.getElementById('update-status').value = status;
                    document.getElementById('update-project-id').value = projectId;
                });
            });
        </script>
</body>

</html>