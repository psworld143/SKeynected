<?php
include_once '../../controllers/index.controllers.php';
include_once './controllers/project.controllers.php';

$dashboardController = new IndexController();
$projectController = new ProjectControllers();


$userId = 3;
$userData = $dashboardController->getUserById($userId);
$projectData = $projectController->getAllProjects();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK Chairman / Create A Project</title>
    <link rel="icon" href="../assets/img/sk-logo.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/vendor/simple-datatables/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/budget.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <style>
        .card-title {
            margin-bottom: 0;
            color: #fff;
        }
    </style>
</head>

<body>
    <main id="main" class="main">
        <?php
        include '../inc/navbar.php';
        include '../inc/sidebar.php';
        ?>

        <div class="pagetitle">
            <h1>Create A Project</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Create</a>
                    </li>
                    <li class="breadcrumb-item active">Projects</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Add Project</h5>
                </div>
                <div class="card-body p-3">
                    <form id="projectForm" method="POST" action="../../backend/projects/add.php" enctype="multipart/form-data">
                        <div class="mb-3 mt-3">
                            <label for="projectName" class="form-label">Project Title</label>
                            <input type="text" class="form-control" id="projectNameInput" name="project_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="projectDetails" class="form-label">Description</label>
                            <textarea class="form-control" id="projectDetailsInput" name="project_description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDateInput" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="endDateInput" name="end_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="totalCost" class="form-label">Total Cost</label>
                            <input type="number" class="form-control" id="totalCostInput" name="total_cost" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create a Project</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Project Status</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="projectStatusTable">
                        <thead>
                            <tr>
                                <th>Project Code</th>
                                <th>Submission Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($projectData as $project) {
                            ?>
                                <tr>
                                    <td><?= $project['project_code'] ?></td>
                                    <td><?= $project['project_name'] ?></td>
                                    <td><?= $project['created_at'] ?></td>
                                    <td><span class="badge rounded-pill <?= ($project['status'] == 'completed') ? 'bg-success' : 'bg-warning' ?>"><?= ucfirst($project['status']) ?></span></td>
                                    <td><a href="overview.php?id=<?= $project['project_id'] ?>">View Details</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <script src="../assets/js/main.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let budgetTable = document.querySelector('#projectStatusTable');
            if (budgetTable) {
                new simpleDatatables.DataTable(budgetTable);
            }
        });
    </script>
</body>

</html>