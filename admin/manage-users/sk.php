<?php
$base_url = '/Skeynected/admin/';
$base_url2 = '/Skeynected/admin/partials/';

require_once '../core/Database.php';
require_once '../core/userController.php';

$success = '';
$error = '';

$db = new Database();
$conn = $db->getConnection();

$barangay_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sk_members = [];
$barangay_name = '';

if ($barangay_id) {
    $stmt = $conn->prepare("SELECT name, role, gender, civil_status, birth_date, contact, term, status FROM sk_members WHERE barangay_id = :barangay_id");
    $stmt->bindParam(':barangay_id', $barangay_id);
    $stmt->execute();
    $sk_members = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $stmt_barangay = $conn->prepare("SELECT name FROM barangays WHERE id = :barangay_id");
    $stmt_barangay->bindParam(':barangay_id', $barangay_id);
    $stmt_barangay->execute();
    $barangay = $stmt_barangay->fetch(PDO::FETCH_ASSOC);


    if ($barangay) {
        $barangay_name = $barangay['name'];
    } else {
        $error = "Barangay not found.";
    }
}

if (empty($sk_members)) {
    $error = "No SK members found for the selected barangay.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LYDO - Barangay SK Management</title>
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="assets/images/LYDO-logo.png" />
    <style>
        .member-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .member-header {
            padding: 15px;
            color: white;
        }

        .member-body {
            padding: 15px;
            background-color: white;
        }

        .member-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
        }

        .status-dot {
            height: 10px;
            width: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }

        .status-active {
            background-color: #28a745;
        }

        .status-inactive {
            background-color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <?php include_once '../partials/navbar.php' ?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once '../partials/sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Barangay <?= htmlspecialchars($barangay_name) ?> SK</h3>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addMemberModal">Add SK Member</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php if ($error): ?>
                            <div class="col-md-12">
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($sk_members as $index => $member): ?>
                                <div class="col-md-4">
                                    <div class="member-card">
                                        <div class="member-header" style="background-color: <?php echo ['#4B49AC', '#248AFD', '#FFC100', '#FF4747', '#57B657', '#7978E9'][$index % 6]; ?>;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0"><?php echo $member['role']; ?></h5>
                                                <img src="https://via.placeholder.com/150" alt="avatar" class="member-avatar">
                                            </div>
                                            <p class="mb-0"><?php echo $member['name']; ?></p>
                                        </div>
                                        <div class="member-body">
                                            <p>
                                                <strong>Status:</strong>
                                                <span class="status-dot <?php echo $member['status'] == 'Active' ? 'status-active' : 'status-inactive'; ?>"></span>
                                                <?php echo $member['status']; ?>
                                            </p>
                                            <button class="btn btn-outline-primary btn-sm">View</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Member Modal -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel">Add SK Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="add-sk.php">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="memberName">Name</label>
                                    <input type="hidden" class="form-control" id="memberName" name="bgid" value="<?= $barangay_id ?>">
                                    <input type="text" class="form-control" id="memberName" name="skname" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="memberName">Username</label>
                                    <input type="text" class="form-control" id="memberName" name="username" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="memberName">Email</label>
                                    <input type="email" class="form-control" id="memberName" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="memberName">Role</label>
                                    <input type="text" class="form-control" id="memberName" name="role" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Member</button>
                    </div>
                </form>
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
</body>

</html>