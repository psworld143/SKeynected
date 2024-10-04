<?php
$base_url = '/Skeynected/admin/';
$base_url2 = '/Skeynected/admin/partials/';
require_once '../core/Database.php';
if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit();
}

// Test Data for Budget Disbursement
$budget_disbursement = [
    ['Barangay A', 'Community Plan', 'Water System Improvement', 'Improving the water supply system', 50000, 'Ongoing'],
    ['Barangay B', 'Environmental Plan', 'Tree Planting', 'Community tree planting event', 10000, 'Completed'],
    ['Barangay C', 'Health Plan', 'Health Center Renovation', 'Renovation of local health center', 75000, 'Stopped'],
    ['Barangay D', 'Education Plan', 'School Supplies Distribution', 'Distribution of school supplies to students', 25000, 'Ongoing'],
    ['Barangay E', 'Infrastructure Plan', 'Road Repair', 'Repairing roads damaged by recent floods', 120000, 'Ongoing']
];

// Test Data for Demographics
$demographics = [
    ['Barangay A', 5000, 2500, 2500, '18-35'],
    ['Barangay B', 3000, 1500, 1500, '36-50'],
    ['Barangay C', 4500, 2300, 2200, '51-65'],
    ['Barangay D', 6000, 3100, 2900, '18-35'],
    ['Barangay E', 3500, 1800, 1700, '18-35']
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LYDO - Budget Management</title>
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="assets/images/LYDO-logo.png" />
</head>

<body>
    <div class="container-scroller">
        <?php include_once '../partials/navbar.php'; ?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once '../partials/sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Budget Management</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs for Navigation -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="budget-tab" data-toggle="tab" href="#budget" role="tab" aria-controls="budget" aria-selected="true">Budget Disbursement</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="demographics-tab" data-toggle="tab" href="#demographics" role="tab" aria-controls="demographics" aria-selected="false">Demographic Data</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- Budget Disbursement Tab -->
                        <div class="tab-pane fade show active" id="budget" role="tabpanel" aria-labelledby="budget-tab">
                            <h4 class="mt-4">Budget Disbursement per Barangay</h4>
                            <table id="budgetTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Barangay</th>
                                        <th>Plan</th>
                                        <th>Project Name</th>
                                        <th>Description</th>
                                        <th>Budget</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- PHP Code to Display Budget Data from Test Array -->
                                    <?php foreach ($budget_disbursement as $row): ?>
                                        <tr>
                                            <td><?php echo $row[0]; ?></td>
                                            <td><?php echo $row[1]; ?></td>
                                            <td><?php echo $row[2]; ?></td>
                                            <td><?php echo $row[3]; ?></td>
                                            <td><?php echo number_format($row[4], 2); ?></td>
                                            <td><?php echo $row[5]; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Demographic Data Tab -->
                        <div class="tab-pane fade" id="demographics" role="tabpanel" aria-labelledby="demographics-tab">
                            <h4 class="mt-4">Demographic Data per Barangay</h4>
                            <table id="demographicsTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Barangay</th>
                                        <th>Total Population</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Age Group</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- PHP Code to Display Demographic Data from Test Array -->
                                    <?php foreach ($demographics as $row): ?>
                                        <tr>
                                            <td><?php echo $row[0]; ?></td>
                                            <td><?php echo $row[1]; ?></td>
                                            <td><?php echo $row[2]; ?></td>
                                            <td><?php echo $row[3]; ?></td>
                                            <td><?php echo $row[4]; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="assets/js/dataTables.select.min.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/Chart.roundedBarCharts.js"></script>

    <script>
        $(document).ready(function() {
            $('#budgetTable').DataTable();
            $('#demographicsTable').DataTable();
        });
    </script>
</body>

</html>