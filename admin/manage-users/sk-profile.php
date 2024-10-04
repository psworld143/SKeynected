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
    $stmt = $conn->prepare("SELECT name, position, gender, civil_status, birth_date, contact, term, status FROM sk_members WHERE barangay_id = :barangay_id");
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
        /* Custom CSS for Profile Layout */
        .profile-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-card img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }

        .profile-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .profile-card p {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .profile-card .social-icons {
            margin-bottom: 20px;
        }

        .profile-card .social-icons a {
            margin: 0 5px;
            color: #777;
            font-size: 1.2rem;
        }

        .profile-details {
            text-align: left;
        }

        .profile-details h4 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .profile-details p {
            color: #555;
        }

        .tabs {
            margin-top: 20px;
        }

        .tabs a {
            margin-right: 20px;
            color: #007bff;
            text-decoration: none;
            cursor: pointer;
        }

        .tabs a.active {
            font-weight: bold;
            color: #000;
        }

        .tab-content {
            display: none;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
        }

        .tab-content.active {
            display: block;
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
                        <div class="col-md-4">
                            <div class="profile-card">
                                <img src="assets/images/profile-picture.png" alt="Profile Picture">
                                <h3>Kevin Anderson</h3>
                                <p>Web Designer</p>
                                <div class="social-icons">
                                    <a href="#"><i class="ti-twitter"></i></a>
                                    <a href="#"><i class="ti-facebook"></i></a>
                                    <a href="#"><i class="ti-instagram"></i></a>
                                    <a href="#"><i class="ti-linkedin"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="tabs">
                                <a href="#" class="tab-link active" data-tab="overview">Overview</a>
                                <a href="#" class="tab-link" data-tab="edit-profile">Edit Profile</a>
                                <a href="#" class="tab-link" data-tab="settings">Settings</a>
                                <a href="#" class="tab-link" data-tab="change-password">Change Password</a>
                            </div>

                            <div class="tab-content active" id="overview">
                                <h4>About</h4>
                                <p>Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus...</p>

                                <div class="profile-details">
                                    <h4>Profile Details</h4>
                                    <p><strong>Full Name:</strong> Kevin Anderson</p>
                                    <p><strong>Company:</strong> Lueilwitz, Wisoky and Leuschke</p>
                                    <p><strong>Job:</strong> Web Designer</p>
                                    <p><strong>Country:</strong> USA</p>
                                    <p><strong>Address:</strong> A108 Adam Street, New York, NY 535022</p>
                                    <p><strong>Phone:</strong> (436) 486-3538 x29071</p>
                                    <p><strong>Email:</strong> k.anderson@example.com</p>
                                </div>
                            </div>

                            <div class="tab-content" id="edit-profile">
                                <h4>Edit Profile</h4>
                                <!-- Add edit profile form here -->
                            </div>

                            <div class="tab-content" id="settings">
                                <h4>Settings</h4>
                                <!-- Add settings form here -->
                            </div>

                            <div class="tab-content" id="change-password">
                                <h4>Change Password</h4>
                                <!-- Add change password form here -->
                            </div>
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
        // JavaScript for Tab Functionality
        const tabs = document.querySelectorAll('.tab-link');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', (event) => {
                event.preventDefault();

                // Remove 'active' class from all tabs and contents
                tabs.forEach(item => item.classList.remove('active'));
                contents.forEach(content => content.classList.remove('active'));

                // Add 'active' class to clicked tab and corresponding content
                tab.classList.add('active');
                const contentId = tab.getAttribute('data-tab');
                document.getElementById(contentId).classList.add('active');
            });
        });
    </script>
</body>

</html>