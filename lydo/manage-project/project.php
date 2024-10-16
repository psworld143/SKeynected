<?php
require_once '../core/projectController.php';
$projectController = new projectController();

$projects = $projectController->getProjects();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Project Management</title>
    <meta content="Project Management Dashboard" name="description">
    <meta content="projects, management, dashboard" name="keywords">

    <link href="../assets/img/LYDOO.jpg" rel="icon">

    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        .project-card {
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .project-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .project-card p {
            font-size: 14px;
            color: #666;
        }

        .progress {
            height: 10px;
            margin-bottom: 10px;
        }

        .project-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .project-team img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: -10px;
            border: 2px solid #fff;
        }

        .time-left {
            font-size: 12px;
            background-color: #e9ecef;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .add-project-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .add-project-btn:hover {
            background-color: #45a049;
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
            background-color: green;
            color: white;
        }

        .bg-declined {
            background-color: red;
            color: white;
        }

        .card-custom {
            height: 150px;
        }

        .card-custom i {
            font-size: 20px;
        }

        .card-custom .rounded-circle {
            width: 50px;
            height: 50px;
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
            <div class="d-flex justify-content-between align-items-center">
                <h1>Projects</h1>
                <div class="header-actions">
                </div>
            </div>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Manage</li>
                    <li class="breadcrumb-item active">Projects</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="background-image-container" style="background-image: url('../assets/img/bg-blue.jpg'); background-size: cover; background-position: center; padding: 40px; border-radius: 5px; margin-bottom: 20px;">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card info-card sales-card card-custom">
                                            <div class="card-body">
                                                <h5 class="card-title">Hearing</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-clock-history"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card info-card revenue-card card-custom">
                                            <div class="card-body">
                                                <h5 class="card-title">Approved</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-check-circle"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card info-card customers-card card-custom">
                                            <div class="card-body">
                                                <h5 class="card-title">Declined</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-x-circle"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card info-card sales-card card-custom">
                                            <div class="card-body">
                                                <h5 class="card-title">Total Projects</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-folder"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <?php foreach ($projects as $project): ?>
                            <div class="col-md-3">
                                <a href="projectOverview.php?project_id=<?php echo $project['project_id']; ?>">
                                    <div class="card">
                                        <img class="card-img-top" src="../assets/img/bg-blue.jpg" alt="Unsplash" width="100%" height="150px" style="object-fit: cover;">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0"><?php echo htmlspecialchars($project['project_name']); ?></h5>
                                            <div class="badge 
                                                <?php
                                                if ($project['status'] == 'pending') {
                                                    echo 'bg-pending';
                                                } elseif ($project['status'] == 'hearing') {
                                                    echo 'bg-hearing';
                                                } elseif ($project['status'] == 'approved') {
                                                    echo 'bg-approved';
                                                } elseif ($project['status'] == 'declined') {
                                                    echo 'bg-declined';
                                                }
                                                ?>">
                                                <?php echo htmlspecialchars($project['status']); ?>
                                            </div>
                                        </div>
                                        <div class="card-body" style="background-color: #f9f9f9;">
                                            <div class="sk-member-info d-flex align-items-center mt-2">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle me-2" alt="Avatar" width="40" height="40">
                                                <div>
                                                    <p class="sk-member-name" style="margin: 0; font-size: 14px; font-weight: bold; color: #007bff;"><?php echo htmlspecialchars($project['sk_member_name']); ?></p>
                                                    <p class="sk-member-position" style="margin: 0; font-size: 12px; color: #666;"><?php echo htmlspecialchars($project['sk_member_position']); ?></p>
                                                </div>
                                            </div>
                                            <p class="barangay-name " style="font-size: 12px; color: darkslategray;">Barangay: <strong><?php echo htmlspecialchars($project['barangay_name']); ?></strong></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Your existing JS files -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>