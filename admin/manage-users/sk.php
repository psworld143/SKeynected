<?php
$base_url = '/Skeynected/admin/';
$base_url2 = '/Skeynected/admin/partials/';
require_once '../core/Database.php';
require_once '../core/userController.php';
if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit();
}

$success = '';
$error = '';

$db = new Database();
$conn = $db->getConnection();

$barangay_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sk_members = [];
$barangay_name = '';

if ($barangay_id) {
    $stmt = $conn->prepare("SELECT id, name, position, gender, civil_status, birth_date, contact, term, status FROM sk_members WHERE barangay_id = :barangay_id");
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

// Sort SK members to ensure the Chairman is first
usort($sk_members, function ($a, $b) {
    if ($a['position'] == 'SK Chairman') return -1;
    if ($b['position'] == 'SK Chairman') return 1;
    return 0;
});
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
        .members-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding-top: 120px;
            position: relative;
        }

        .sk-chairman-card {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 300px;
        }

        .member-card {}

        .member-header {
            padding: 15px;
            color: white;
            text-align: center;
        }

        .member-body {
            padding: 15px;
            background-color: white;
        }

        .member-avatar {
            width: 100px;
            height: 100px;
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

        .member-info {
            margin-bottom: 5px;
        }

        .view-btn {
            background-color: transparent;
            border: 1px solid #007bff;
            color: #007bff;
            padding: 5px 10px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
        }

        .view-btn:hover {
            background-color: #007bff;
            color: white;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }

        a {
            color: #333;
            -moz-transition: all 200ms ease-in;
            -o-transition: all 200ms ease-in;
            -webkit-transition: all 200ms ease-in;
            transition: all 200ms ease-in;
        }

        a:hover,
        a:focus {
            color: #32c5d2;
            text-decoration: none;
        }

        .margin40 {
            margin-bottom: 40px;
        }

        /************************image hover effect*******************/
        .item-img-wrap {
            position: relative;
            text-align: center;
            overflow: hidden;

        }

        .item-img-wrap img {
            -moz-transition: all 200ms linear;
            -o-transition: all 200ms linear;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
            width: 100%;
        }

        .item-img-overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
        }

        .item-img-overlay span {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background: url(http://bootstraplovers.com/templates/assan-2.2/main-template/img/plus.png) no-repeat center center rgba(0, 0, 0, 0.7);
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
            opacity: 0;
            -moz-transition: opacity 250ms linear;
            -o-transition: opacity 250ms linear;
            -webkit-transition: opacity 250ms linear;
            transition: opacity 250ms linear;
        }

        .item-img-wrap:hover .item-img-overlay span {
            opacity: 1;
        }

        .item-img-wrap:hover img {
            -moz-transform: scale(1.1);
            -o-transform: scale(1.1);
            -ms-transform: scale(1.1);
            -webkit-transform: scale(1.1);
            transform: scale(1.1);
        }

        .work-desc {
            width: 100%;
            padding: 10px 10px;
            background: #FFF;
            border-top: none;
            position: relative;
        }

        .work-desc:before {
            content: "";
            display: block;
            position: absolute;
            top: -8px;
            margin-left: 20px;
            width: 8px;
            height: 8px;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-bottom: 8px solid #fff;
            z-index: 100;
        }

        .work-desc h3 {
            margin: 0;
            padding: 0;
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
        }


        /*******section heading**********/
        .center-heading {
            text-align: center;
            margin-bottom: 40px;
        }

        .center-heading h2 {
            margin-bottom: 0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #333;
            font-size: 25px;
        }

        .center-heading p {
            font-size: 20px;
            line-height: 35px;
        }

        .center-heading h2 strong {
            font-weight: 700;
        }

        .center-line {
            display: inline-block;
            width: 70px;
            height: 1px;
            border-top: 1px solid #bbb;
            /* border-bottom: 1px solid $skincolor; */
            margin: auto;
        }

        .center-heading p {
            margin-top: 10px;
        }

        .overflow-hidden {
            overflow: hidden;
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
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3>Manage SK</h3>
                                <div class="header-actions">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBaragayModal">
                                        <i class="ti ti-plus"></i> Add SK
                                    </button>
                                </div>
                            </div>
                            <nav>
                                <ol class="breadcrumb" style="border: none">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item">Manage</li>
                                    <li class="breadcrumb-item active">SK</li>
                                </ol>
                            </nav>
                        </div>
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
                                    <label for="position">Position</label>
                                    <select class="form-control" id="position" name="position" required>
                                        <option value="" disabled selected>Select Position</option>
                                        <option value="SK Chairman">SK Chairman</option>
                                        <option value="SK Secretary">SK Secretary</option>
                                    </select>
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