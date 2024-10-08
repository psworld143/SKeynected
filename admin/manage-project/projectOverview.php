<?php
require_once '../core/projectController.php';
$projectController = new projectController();

$project_id = isset($_GET['project_id']) ? (int)$_GET['project_id'] : 0;

if ($project_id > 0) {
    $projects = $projectController->getProjectsById($project_id);
    $materials = $projectController->getMaterialsByProjectId($project_id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LYDO - Project Overview</title>
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="assets/images/LYDO-logo.png" />

</head>

<body>
    <div class="container-scroller">
        <?php
        include_once '../partials/navbar.php'
        ?>
        <div class="container-fluid page-body-wrapper">
            <?php
            include_once '../partials/sidebar.php';
            ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold"><?= $projects['project_name']?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Project Details</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <b>Project Code</b>
                                                    </th>
                                                    <th>
                                                        Description
                                                    </th>
                                                    <th>
                                                        Duration
                                                    </th>
                                                    <th>Status</th>
                                                    <th>Specific Job Needed</th>
                                                    <th>Operations</th>
                                                    <th>Total Cost</th>
                                                    <th>Proposal</th>
                                                    <th>Actions</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <?php if (!empty($projects)): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($projects['project_code']); ?></td>
                                                        <td><?php echo htmlspecialchars($projects['project_description']); ?></td>
                                                        <td><?php echo htmlspecialchars($projects['project_duration']); ?></td>
                                                        <td><?php echo htmlspecialchars($projects['status']); ?></td>
                                                        <td><?php echo htmlspecialchars($projects['specific_job']); ?></td>
                                                        <td><?php echo htmlspecialchars($projects['operations']); ?></td>
                                                        <td><?php echo htmlspecialchars($projects['total_cost']); ?></td>
                                                        <td>
                                                            <a href="<?php echo htmlspecialchars($projects['proposal_file_path']); ?>" download>
                                                                Download Proposal
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <i class="ti-pencil" style="cursor:pointer;" data-id="<?php echo $projects['project_id']; ?>" onclick="editUser(this)"></i> <!-- Edit Icon -->
                                                            <i class="ti-trash" style="cursor:pointer; margin-left:10px;" data-id="<?php echo $projects['project_id']; ?>" onclick="deleteUser(this)"></i> <!-- Delete Icon -->
                                                        </td>
                                                    </tr>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="5">No projects found.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Materials</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <b>Materials</b>
                                                </th>
                                                <th>
                                                    Qty
                                                </th>
                                                <th>
                                                    Amount
                                                </th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($materials)): ?>
                                                <?php foreach ($materials as $material): ?> <!-- Loop through materials array -->
                                                    <tr>
                                                        <td><?php echo isset($material['material_name']) ? htmlspecialchars($material['material_name']) : 'N/A'; ?></td>
                                                        <td><?php echo isset($material['quantity']) ? htmlspecialchars($material['quantity']) : 'N/A'; ?></td>
                                                        <td><?php echo isset($material['amount']) ? htmlspecialchars($material['amount']) : 'N/A'; ?></td>
                                                        <td><?php echo isset($material['total']) ? htmlspecialchars($material['total']) : 'N/A'; ?></td>
                                                        <td>
                                                            <i class="ti-pencil" style="cursor:pointer;" data-id="<?php echo isset($material['material_id']) ? $material['material_id'] : ''; ?>" onclick="editUser(this)"></i> <!-- Edit Icon -->
                                                            <i class="ti-trash" style="cursor:pointer; margin-left:10px;" data-id="<?php echo isset($material['material_id']) ? $material['material_id'] : ''; ?>" onclick="deleteUser(this)"></i> <!-- Delete Icon -->
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5">No materials found.</td>
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
        <script src="assets/vendors/js/vendor.bundle.base.js"></script>
        <script src="assets/vendors/chart.js/Chart.min.js"></script>
        <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
        <script src="assets/js/dataTables.select.min.js"></script>

        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="assets/js/off-canvas.js"></script>
        <script src="assets/js/hoverable-collapse.js"></script>
        <script src="assets/js/template.js"></script>
        <script src="assets/js/settings.js"></script>
        <script src="assets/js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="assets/js/dashboard.js"></script>
        <script src="assets/js/Chart.roundedBarCharts.js"></script>
</body>

</html>