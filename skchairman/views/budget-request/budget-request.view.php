<?php
include_once '../../controllers/index.controllers.php';


$dashboardController = new IndexController();

$userId = 3;
$userData = $dashboardController->getUserById($userId);
?>

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
    <link rel="stylesheet" href="../assets/css/budget.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebarsss.css">
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
            <h1>Budget Request</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Budget</a></li>
                    <li class="breadcrumb-item active">Budget Request</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="card mb-4">
                <div class="card-header" style=" background-color: rgba(4, 92, 156, 0.85);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2)">
                    <h5 class="card-title">Send Budget Request</h5>
                </div>
                <div class="card-body">
                    <form id="budgetRequestForm" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="requestTitle" class="form-label">Request Title</label>
                            <input type="text" class="form-control" id="requestTitle" name="requestTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="requestDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="requestDescription" name="requestDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="budgetProposal" class="form-label">Attach Budget Proposal (PDF)</label>
                            <input type="file" class="form-control" id="budgetProposal" name="budgetProposal" accept=".pdf" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header" style=" background-color: rgba(4, 92, 156, 0.85);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2)">
                    <h5 class="card-title">Budget Proposal Status</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="budgetRequestTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Request Title</th>
                                <th>Description</th>
                                <th>Submission Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Community Park Development</td>
                                <td>Proposal for developing a community park.</td>
                                <td>2024-10-01</td>
                                <td><span class="badge bg-success">Approved</span></td>
                            </tr>
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
            let budgetTable = document.querySelector('#budgetRequestTable');
            if (budgetTable) {
                new simpleDatatables.DataTable(budgetTable);
            }
        });
    </script>
</body>

</html>