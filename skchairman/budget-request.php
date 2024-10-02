<?php
require('backend/dbcon.php');


$sql = "SELECT project_code, project_name, status, total_cost FROM projects";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Skeynected</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/sk-logo.png" rel="icon">
    <link href="assets/img/sk-logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>


    <main id="main" class="main">
        <?php
        include 'inc/navbar.php';
        include 'inc/sidebar.php';
        ?>

        <div class="pagetitle">
            <h1>Budget Request</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Budget Request</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">New Project</h5>
                            <form class="row g-3" action="backend/add_project.php" method="POST">
                                <div class="col-md-12">
                                    <label for="inputCity" class="form-label">Project Name</label>
                                    <input type="text" class="form-control" name="project" id="project">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputCity" class="form-label">Start</label>
                                    <input type="date" name="start" id="start" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputCity" class="form-label">End</label>
                                    <input type="date" name="end" id="end" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputCity" class="form-label">Description</label>
                                    <textarea type="text" class="form-control" style="height: 80px;"
                                        name="description" id="description"></textarea>
                                </div>
                                <div class="button">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Project</h5>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addproject" style="margin-right: 12px;">
                                    <i class="bx bx-plus"></i>Add Project
                                </button>
                            </div>
                            <button class='btn btn-danger btn-sm mb-3'><i class="bx bxs-trash"></i> Delete</button>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Code</th>
                                        <th>Project Name</th>
                                        <th>Status</th>
                                        <th>Total Cost</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td><input type='checkbox' class='tcheck'></td>";
                                            echo "<td>" . htmlspecialchars($row["project_code"]) . "</td>";
                                            echo "<td>" . htmlspecialchars($row["project_name"]) . "</td>";
                                            echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
                                            echo "<td>" . htmlspecialchars($row["total_cost"]) . "</td>";
                                            echo "<td class='button'>
                                          <button type='button' class='btn s btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#'>Items</button>
                                          <button type='button' class='btn s btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#'>Update</button>
                                      </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>No projects found</td></tr>"; // Adjusted colspan to match the table's structure
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <form action="backend/add_project.php" method="POST">
            <div class="modal fade" id="addproject" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-project">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3 mt-4">
                                <label for="project" class="col-sm-2 col-form-label">Project</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="project" id="project">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="start" class="col-sm-2 col-form-label">Start</label>
                                <div class="col-sm-10">
                                    <input type="date" name="start" id="start" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="end" class="col-sm-2 col-form-label">End</label>
                                <div class="col-sm-10">
                                    <input type="date" name="end" id="end" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-4 mt-4">
                                <label for="description" class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea type="text" class="form-control" style="height: 80px;" name="description"
                                        id="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </main><!-- End #main -->
    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>