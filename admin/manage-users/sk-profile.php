<?php
session_start(); // Ensure session is started to access session variables

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
$member_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($barangay_id) {

    $stmt = $conn->prepare("SELECT * FROM sk_members WHERE barangay_id = :barangay_id");
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


$member_details = [];
if ($member_id) {
    $stmt_member = $conn->prepare("SELECT * FROM sk_members WHERE id = :member_id");
    $stmt_member->bindParam(':member_id', $member_id);
    $stmt_member->execute();
    $member_details = $stmt_member->fetch(PDO::FETCH_ASSOC);
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

        .profile-details h4 {
            font-weight: bold;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .profile-details p {
            color: #555;
            margin-bottom: 5px;
        }

        .profile-details p span {
            color: #888;
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }

        .tabs {
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .tabs a {
            margin-right: 30px;
            color: #007bff;
            text-decoration: none;
            cursor: pointer;
            padding-bottom: 5px;
        }

        .tabs a.active {
            font-weight: bold;
            color: #000;
            border-bottom: 3px solid #007bff;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            background-color: #ffffff;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .tab-content h4 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .tab-content p {
            color: #555;
            margin-bottom: 15px;
        }

        .container-fluid {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <?php include_once '../partials/navbar.php'; ?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once '../partials/sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-card">
                                <img src="assets/images/profile-picture.png" alt="Profile Picture">
                                <h3><?php echo $member_details['name'] ?? 'Unknown Member'; ?></h3>
                                <p><?php echo $member_details['position'] ?? 'Position not specified'; ?></p>
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
                                <p><?php echo $member_details['bio'] ?? 'Biography not available.'; ?></p>

                                <div class="profile-details">
                                    <h4>Profile Details</h4>
                                    <p><span>Full Name:</span> <?php echo $member_details['name']; ?></p>
                                    <p><span>Position:</span> <?php echo $member_details['position']; ?></p>
                                    <p><span>Gender:</span> <?php echo $member_details['gender']; ?></p>
                                    <p><span>Civil Status:</span> <?php echo $member_details['civil_status']; ?></p>
                                    <p><span>Birth Date:</span> <?php echo $member_details['birth_date']; ?></p>
                                    <p><span>Contact:</span> <?php echo $member_details['contact']; ?></p>
                                    <p><span>Term:</span> <?php echo $member_details['term']; ?></p>
                                    <p><span>Status:</span> <?php echo $member_details['status']; ?></p>
                                </div>
                            </div>

                            <div class="tab-content" id="edit-profile">
                                <h4>Edit Profile</h4>
                                <!-- Add edit profile form here -->
                                <form action="edit_member.php?id=<?php echo $member_id; ?>" method="POST">
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo $member_details['name']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="position">Position</label>
                                        <input type="text" class="form-control" name="position" value="<?php echo $member_details['position']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" name="gender" required>
                                            <option value="Male" <?php echo ($member_details['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                            <option value="Female" <?php echo ($member_details['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                            <option value="Other" <?php echo ($member_details['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="civil_status">Civil Status</label>
                                        <select class="form-control" name="civil_status" required>
                                            <option value="Single" <?php echo ($member_details['civil_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                                            <option value="Married" <?php echo ($member_details['civil_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                                            <option value="Divorced" <?php echo ($member_details['civil_status'] == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                                            <option value="Widowed" <?php echo ($member_details['civil_status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="birth_date">Birth Date</label>
                                        <input type="date" class="form-control" name="birth_date" value="<?php echo $member_details['birth_date']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact">Contact</label>
                                        <input type="text" class="form-control" name="contact" value="<?php echo $member_details['contact']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="term">Term</label>
                                        <input type="text" class="form-control" name="term" value="<?php echo $member_details['term']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" required>
                                            <option value="Active" <?php echo ($member_details['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                                            <option value="Inactive" <?php echo ($member_details['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </form>
                            </div>

                            <div class="tab-content" id="settings">
                                <h4>Account Settings</h4>
                                <form action="update-account-status.php" method="POST">
                                    <div class="form-group">
                                        <label for="account-status">Account Status</label>
                                        <input type="hidden" name="id" value="<?php echo $member_id; ?>">
                                        <select id="account-status" name="status" class="form-control">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="update_status" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>


                            <div class="tab-content" id="change-password">
                                <h4>Change Password</h4>
                                <form action="change_password.php?id=<?php echo $member_id; ?>" method="POST">
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" class="form-control" name="new_password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm New Password</label>
                                        <input type="password" class="form-control" name="confirm_password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="assets/js/vertical-layout-light.js"></script>
    <script>
        // Tab functionality
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabContents = document.querySelectorAll('.tab-content');

        tabLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetTab = e.target.dataset.tab;

                // Remove active class from all tabs and contents
                tabLinks.forEach(link => link.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to the clicked tab and corresponding content
                e.target.classList.add('active');
                document.getElementById(targetTab).classList.add('active');
            });
        });
    </script>
</body>

</html>