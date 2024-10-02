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
    <link rel="stylesheet" href="../assets/css/sidebar.css">
</head>
<style>
    .project-card {
        border-left: 8px solid #4caf50;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .project-card:hover {
        transform: translateY(-3px);

    }

    .progress-bar-custom {
        background-color: #4caf50;

    }

    .row {
        margin-bottom: 1rem;

    }

    .card-title {
        margin-bottom: 0.5rem;

    }

    .card-text {
        margin-bottom: 0.5rem;

    }

    .progress {
        height: 0.75rem;

    }

    .project-completion {
        font-size: 0.85rem;
        margin-top: 0.25rem;

    }

    .purok-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 1rem;
        color: #4caf50;
    }
</style>

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
            <div class="container my-5">
                <div class="purok-section">
                    <h2 class="purok-title">Purok 1</h2>
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <a href="overview.php">
                                <div class="project-card">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title project-name"></h3>
                                        
                                        <span class="card-date project-date"></span>
                                    </div>
                                    <p class="card-description project-description"></p>

                                    <div class="team-members">
                                    </div>

                                    <div class="tags">
                                        <span class="tag"></span>
                                        <span class="tag"></span>
                                        <span class="tag"></span>
                                    </div>

                                    <div class="mb-3">
                                        <span class="badge rounded-pill bg-success">Completed</span>
                                        <!-- Example: Use bg-warning for ongoing, bg-danger for stopped -->
                                        <!-- <span class="badge rounded-pill bg-warning">Ongoing</span> -->
                                        <!-- <span class="badge rounded-pill bg-danger">Stopped</span> -->
                                    </div>

                                    <div class="card-footer">
                                        <span class="budget"></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
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