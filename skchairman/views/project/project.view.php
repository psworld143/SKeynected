<?php
include_once '../../controllers/index.controllers.php';
include_once './controllers/project.controllers.php';

$dashboardController = new IndexController();
$projectController = new ProjectControllers();

$userId = 3; // Example user ID
$userData = $dashboardController->getUserById($userId);
$projectData = $projectController->getAllProjects();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK Chairman / Project</title>
    <link rel="icon" href="../assets/img/sk-logo.png">
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/vendor/remixicon/remixicon.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebarsss.css">
    <link rel="stylesheet" href="../assets/css/project.css">

    <style>
        .project-card {
            border-left: 8px solid rgba(4, 92, 156, 0.85);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .project-card .tags .tag {
            margin-right: 5px;
        }

        .card-title {
            color: rgba(4, 92, 156, 0.85);
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

        <section class="section">
            <div class="purok-section">
                <div class="row g-3">
                    <?php foreach ($projectData as $project): ?>
                        <div class="col-lg-4">
                            <a href="overview.php?id=<?= htmlspecialchars($project['project_id']) ?>">
                                <img src="https://www.iied.org/sites/default/files/styles/scale_lg/public/images/2021/07/27/4_planting_vegetable_seedlings_0.jpeg" alt="Project Image" class="card-image" style="width: 100%; height: auto; object-fit: cover;">
                                <div class="project-card">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title project-name"><?= htmlspecialchars($project['project_name']) ?></h3>
                                    </div>
                                    <p class="card-description project-description"><?= htmlspecialchars($project['project_description']) ?></p>
                                    <div class="mb-3">
                                        <strong>Total Cost:</strong> <?= htmlspecialchars($project['total_cost']) ?><br>
                                        <strong>Plans:</strong> <?= htmlspecialchars($project['plans']) ?><br>
                                    </div>
                                    <div class="mb-3">
                                        <span class="badge rounded-pill <?= ($project['status'] == 'completed') ? 'bg-success' : 'bg-warning' ?>"><?= ucfirst($project['status']) ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
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

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
</body>

</html>