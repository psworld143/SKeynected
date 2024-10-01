<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK Chairman / Budget Request</title>
    <link rel="icon" href="../assets/img/sk-logo.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/vendor/simple-datatables/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <main id="main" class="main">
        <?php
        include '../inc/navbar.php';
        include '../inc/sidebar.php';
        ?>

        <div class="pagetitle">
            <h1>Budget Request</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Budget</a></li>
                    <li class="breadcrumb-item active">Budget Request</li>
                </ol>
            </nav>
        </div>

        <!-- Budget Management Section -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <!-- View Budget Requests Table with DataTables -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>View Budget Requests</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="budgetRequestTable">
                                    <thead>
                                        <tr>
                                            <th>Barangay</th>
                                            <th>Requested Amount</th>
                                            <th>Current Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Barangay 1</td>
                                            <td>₱100,000</td>
                                            <td>Pending</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm">Update</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Barangay 2</td>
                                            <td>₱150,000</td>
                                            <td>Approved</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm">Update</a>
                                            </td>
                                        </tr>
                                        <!-- Add more rows dynamically with PHP or JS -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h3>Update Budget Request</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="barangay_select">Select Barangay</label>
                                        <select class="form-control" id="barangay_select" name="barangay_select" required>
                                            <option value="Barangay 1">Barangay 1</option>
                                            <option value="Barangay 2">Barangay 2</option>
                                            <!-- Dynamically add more barangays here -->
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="requested_amount">Requested Amount</label>
                                        <input type="number" class="form-control" id="requested_amount" name="requested_amount" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Pending">Pending</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-success">Update Request</button>
                                </form>
                            </div>
                        </div>
                    </div>

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
        // Initialize DataTable for the budget requests table
        document.addEventListener("DOMContentLoaded", function() {
            let budgetTable = document.querySelector('#budgetRequestTable');
            if (budgetTable) {
                new simpleDatatables.DataTable(budgetTable);
            }
        });
    </script>
</body>

</html>