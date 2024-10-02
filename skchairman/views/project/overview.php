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
    <title>SK Chairman / Project Overview</title>
    <link rel="icon" href="../assets/img/sk-logo.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/vendor/remixicon/remixicon.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <style>
        .project-card {
            border-left: 8px solid #4caf50;

            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .badge-plan {
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .budget-info {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 20px;
        }

        .expense-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .remove-expense {
            cursor: pointer;
            color: red;
            margin-left: 10px;
        }

        #error-message {
            display: none;
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
            <h1>Project Overview</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Overview</a></li>
                    <li class="breadcrumb-item active">Project Overview</li>
                </ol>
            </nav>
        </div>

        <!-- Project Management Section -->
        <section class="section">
            <img src="https://www.iied.org/sites/default/files/styles/scale_lg/public/images/2021/07/27/4_planting_vegetable_seedlings_0.jpeg" alt="Project Image" class="card-image" style="width: 100%; height: auto; object-fit: cover;">
            <?php foreach ($projectData as $project) : ?>
                <div class="project-card">
                    <h3 class="card-title"><?= htmlspecialchars($project['project_name']) ?></h3>
                    <p class="card-description">
                        <?= htmlspecialchars($project['description']) ?>
                    </p>

                    <div class="mb-3">
                         <td><span class="badge rounded-pill <?= ($project['status'] == 'completed') ? 'bg-success' : 'bg-warning' ?>"><?= ucfirst($project['status']) ?></span></td>
                    </div>

                    <div class="mb-3">
                        <strong>Start Date:</strong>
                        <?= htmlspecialchars($project['start_date']) ?>
                        <br>
                        <strong>End Date:</strong> <?= htmlspecialchars($project['end_date']) ?>
                    </div>


                    <div class="budget-info">
                        <span>Initial Budget: ₱<?php echo number_format($project['initial_budget'], 2); ?></span><br>
                        <span>Current Budget: ₱<span id="current-budget"><?php echo number_format($project['current_budget'], 2); ?></span></span>
                    </div>

                    <div id="error-message" class="alert alert-danger mt-2"></div>


                    <div class="mb-3">
                        <h5>Budget Allocations</h5>
                        <div id="expense-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" placeholder="Expense Type" id="expense-type">
                                <input type="number" class="form-control" placeholder="Amount" id="expense-amount" min="0">
                                <button class="btn btn-outline-secondary" type="button" id="add-expense-btn">Add</button>
                            </div>
                        </div>
                        <h6>Current Budget Allocations:</h6>
                        <ul id="expense-list" class="list-group"></ul>
                    </div>


                    <div class="mb-3">
                        <label for="project-plans" class="form-label">Project Plans</label>
                        <div id="tags-container" class="mb-2"></div>
                        <div class="input-group">
                            <input type="text" id="project-plan-input" class="form-control" placeholder="Add project plan" aria-label="Add project plan">
                            <button class="btn btn-outline-secondary" type="button" id="add-plan-btn">Add</button>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status">
                            <option selected>Choose status</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="stopped">Stopped</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-outline-secondary" type="button" id="add-plan-btn" data-project-id="<?= $project['project_id'] ?>">Add</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>

    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <script src="../assets/js/main.js"></script>

    <script src="../assets/js/project.js"></script>
</body>

</html>