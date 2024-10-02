<?php

include_once '../../controllers/index.controllers.php';
include_once './controllers/project.controllers.php';
$dashboardController = new IndexController();
$projectController = new ProjectControllers();
$userId = 3;
$userData = $dashboardController->getUserById($userId);
$projectId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$projectData = $projectController->getProjectById($projectId);
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
            background-color: #ffffff;
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

        .horizontal-layout {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .horizontal-item {
            flex: 1;
            min-width: 150px;
            padding: 10px;
            background: #4caf50;
            border-radius: 8px;
            margin-right: 10px;
            color: #fff;
        }

        .horizontal-item:last-child {
            margin-right: 0;
        }

        .card-header {
            background-color: #4caf50;
            color: #fff;
            border-radius: 8px 8px 0 0;
            font-weight: bold;
            position: relative;
        }

        .action-buttons {
            position: absolute;
            right: 20px;
            top: 10px;
        }

        .action-buttons button {
            margin-left: 5px;
        }

        .card-body {
            padding: 20px;
        }

        .float-end a {
            color: #fff;
        }

        .float-end i {
            color: #ffff00;
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
        <img src="https://www.iied.org/sites/default/files/styles/scale_lg/public/images/2021/07/27/4_planting_vegetable_seedlings_0.jpeg" alt="Project Image" class="card-image" style="width: 100%; height: auto; object-fit: cover;">
        <section class="section">

            <div class="project-card">
                <div class="card-header">
                    <img src="../assets/img/sk.png" alt="SK Logo" style="width: 50px; height: 50px; margin-right: 10px; vertical-align: middle;">
                    <?= htmlspecialchars($projectData['project_name']) ?>
                    <div class="float-end">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                            <i class="bi bi-arrow-repeat"></i> Update Status
                        </a>
                        <span class="mx-2">|</span>
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#setBudgetModal">
                            <i class="bi bi-cash"></i> Set Budget Allocation
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-description"><?= htmlspecialchars($projectData['project_description']) ?></p>
                    <div class="mb-3">
                        <span class="badge rounded-pill <?= ($projectData['status'] == 'completed') ? 'bg-success' : 'bg-warning' ?>"><?= ucfirst($projectData['status']) ?></span>
                    </div>

                    <div class="budget-info mb-3">
                        <span>Total Cost: ₱<?php echo number_format($projectData['total_cost'], 2); ?></span><br>
                        <span>Project Date: <?= htmlspecialchars($projectData['project_date']) ?></span><br>
                        <span><strong>Duration:</strong> <?= htmlspecialchars($projectData['duration']) ?></span>
                    </div>

                    <div class="horizontal-layout">
                        <div class="horizontal-item"><strong>SK Chairman:</strong> <?= htmlspecialchars($projectData['sk_chairman']) ?></div>
                        <div class="horizontal-item"><strong>Purok Assigned:</strong> <?= htmlspecialchars($projectData['purok_name']) ?></div>
                        <div class="horizontal-item"><strong>Barangay:</strong> <?= htmlspecialchars($projectData['barangay_name']) ?></div>
                    </div>
                    <div class="horizontal-layout">
                        <div class="horizontal-item"><strong>Plans:</strong> <?= htmlspecialchars($projectData['plans']) ?></div>
                        <div class="horizontal-item"><strong>Beneficiaries:</strong> <?= htmlspecialchars($projectData['beneficiaries']) ?></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Update Status Modal -->
        <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateStatusModalLabel">Update Project Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="status" class="form-label">Select New Status</label>
                                <select class="form-select" id="status">
                                    <option value="in-progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="on-hold">On Hold</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="comments" class="form-label">Comments (optional)</label>
                                <textarea class="form-control" id="comments" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Update Status</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Set Budget Allocation Modal -->
        <div class="modal fade" id="setBudgetModal" tabindex="-1" aria-labelledby="setBudgetModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="setBudgetModalLabel">Set Budget Allocation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="budget" class="form-label">Total Budget</label>
                                <input type="number" class="form-control" id="budget" placeholder="₱0.00">
                            </div>
                            <div class="mb-3">
                                <label for="budgetDetails" class="form-label">Budget Details</label>
                                <textarea class="form-control" id="budgetDetails" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Set Budget Allocation</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>