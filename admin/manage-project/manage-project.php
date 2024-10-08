<?php
require_once '../core/projectController.php';
$projectController = new projectController();


$projects = $projectController->getProjects();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LYDO - Manage Admin</title>
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="assets/images/LYDO-logo.png" />

</head>
<style>
    .card {
        height: 100%;
    }

    .card-body {
        display: flex;
        flex-direction: column;
    }

    .progress {
        margin-top: auto;
    }

    .project-card {
        border: 1px solid #ebedf2;
        border-radius: 4px;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
    }

    .text-muted {
        font-size: 0.875rem;
        line-height: 1.4;
        max-height: 3.6em;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
</style>

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
                                    <h3 class="font-weight-bold">Projects</h3>
                                    <h6 class="font-weight-normal mb-0"></h6>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="mdi mdi-calendar"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                                <a class="dropdown-item" href="#">January - March</a>
                                                <a class="dropdown-item" href="#">March - June</a>
                                                <a class="dropdown-item" href="#">June - August</a>
                                                <a class="dropdown-item" href="#">August - November</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-4 stretch-card transparent">
                                            <div class="card card-tale">
                                                <div class="card-body">
                                                    <p class="mb-4">Hearing</p>
                                                    <p class="fs-30 mb-2"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4 stretch-card transparent">
                                            <div class="card card-dark-blue">
                                                <div class="card-body">
                                                    <p class="mb-4">Approved</p>
                                                    <p class="fs-30 mb-2"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4 stretch-card transparent">
                                            <div class="card card-light-blue">
                                                <div class="card-body">
                                                    <p class="mb-4">Declined</p>
                                                    <p class="fs-30 mb-2"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4 stretch-card transparent">
                                            <div class="card card-light-danger">
                                                <div class="card-body">
                                                    <p class="mb-4">Total Projects</p>
                                                    <p class="fs-30 mb-2"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <?php foreach ($projects as $project) : ?>
                                                <div class="col-md-6 col-xl-4 mb-4 stretch-card transparent">
                                                    <a href="<?php echo 'projectOverview.php?project_id=' . $project['project_id'] ?>">
                                                        <div class="card project-card">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between align-items-baseline">
                                                                    <h6 class="card-title mb-0"><?= $project['project_name'] ?></h6>
                                                                    <div class="dropdown mb-2">
                                                                        <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="icon-ellipsis"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                            <a class="dropdown-item" href="#">Edit</a>
                                                                            <a class="dropdown-item" href="#">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="text-muted mt-3 mb-0"><?= $project['project_description'] ?></p>
                                                                <div class="mt-3">
                                                                    <div class="d-flex justify-content-between align-items-baseline">
                                                                        <div class="d-flex align-items-center">
                                                                            <p class="mb-0 mr-2">Status:</p>
                                                                            <p class="mb-0 text-success">
                                                                                <?= $project['status'] ?>
                                                                                <i class="ti-arrow-up ml-1"></i>
                                                                            </p>
                                                                        </div>
                                                                        <p class="mb-0"><?= $project['project_duration'] ?> Days</p>
                                                                    </div>
                                                                    <div class="progress progress-md mt-3">
                                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div
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