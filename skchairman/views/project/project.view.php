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
    <link rel="stylesheet" href="../assets/css/navbar.css">

</head>

<body>
    <main id="main" class="main">
        <?php
        include '../inc/navbar.php';
        include '../inc/sidebar.php';
        ?>

        <div class="pagetitle">
            <h1>Manage Youth</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Youth</a></li>
                    <li class="breadcrumb-item active">Manage Youth</li>
                </ol>
            </nav>
        </div>

        <!-- Project Management Section -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <!-- Add New Project Card -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>Add New Project</h3>
                            </div>
                            <div class="card-body">
                                <form action="add_project.php" method="POST">
                                    <div class="form-group mb-3">
                                        <label for="project_name">Project Name</label>
                                        <input type="text" class="form-control" id="project_name" name="project_name" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="budget">Budget Allocation</label>
                                        <input type="number" class="form-control" id="budget" name="budget" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="status">Project Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="Stopped">Stopped</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Project</button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>Update Project Status</h3>
                            </div>
                            <div class="card-body">
                                <form action="update_project.php" method="POST">
                                    <div class="form-group mb-3">
                                        <label for="project_id">Select Project</label>
                                        <select class="form-control" id="project_id" name="project_id" required>

                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="status_update">New Status</label>
                                        <select class="form-control" id="status_update" name="status_update" required>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="Stopped">Stopped</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </div>


                                    <button type="submit" class="btn btn-warning">Update Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <script src="../assets/vendor/apexcharts/apexcharts.min.js">
    </script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>