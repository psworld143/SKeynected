<?php
$base_url = '/Skeynected/admin/';
$base_url2 = '/Skeynected/admin/partials/';
require_once '../core/Database.php';
require_once '../core/userController.php';
if (!isset($_SESSION['logged_in'])) {
  header('Location: index.php');
  exit();
}


$barangay = (new userController())->getBarangays();

$success = '';
$error = '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LYDO - Barangay SK Management</title>
  <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../assets/css/vertical-layout-light/global.css">
  <link rel="shortcut icon" href="../assets/images/LYDO-logo.png" />
  <style>
    .barangay-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }

    .barangay-card {
      background: linear-gradient(135deg, rgba(75, 73, 172, 0.5) 0%, rgba(75, 73, 172, 0.5) 100%);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border-radius: 8px;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      border: 1px solid rgba(255, 255, 255, 0.18);
      padding: 20px;
      text-align: center;
      transition: all 0.3s ease;
    }

    .barangay-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.45);
    }

    .barangay-name {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #333;
    }

    .sk-logo {
      width: 100px;
      height: 100px;
      margin-bottom: 15px;
      object-fit: contain;
    }

    .button-group {
      display: flex;
      justify-content: space-evenly;
      margin-top: 50px;
    }

    .btn {
      padding: 8px 30px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 14px;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 4px;
      transition: background-color 0.3s ease;
      border: none;
      color: white;
    }

    .btn-add {
      background-color: #4B49AC;
    }

    .btn-add:hover {
      background-color: #3c3a87;
    }

    .btn-delete {
      background-color: #dc3545;
    }

    .btn-delete:hover {
      background-color: #c82333;
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
                <h3>Manage Barangay SK</h3>
                <div class="header-actions">
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBaragayModal">
                    <i class="ti ti-plus"></i> Add Barangay
                  </button>
                </div>
              </div>
              <nav>
                <ol class="breadcrumb" style="border: none">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item">Manage</li>
                  <li class="breadcrumb-item active">Barangay SK</li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="background-image" style="background-image: url('../assets/images/barangay-cv.jpg'); background-size: cover; background-position: center; padding: 40px; border-radius: 5px; margin-bottom: 20px;">
            <div class="barangay-grid">
              <?php foreach ($barangay as $barangays): ?>
                <div class="barangay-card">
                  <img src="assets/images/sk-logo.png" alt="SK Logo" class="sk-logo">
                  <div class="barangay-name"><?php echo htmlspecialchars($barangays['name']); ?></div> <!-- Corrected here -->
                  <div class="button-group">
                    <a href="sk.php?id=<?php echo urlencode($barangays['id']); ?>">
                      <button class="btn btn-add">View</button>
                    </a>
                    <button class="btn btn-delete">Delete</button>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="../assets/js/dataTables.select.min.js"></script>
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/template.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/Chart.roundedBarCharts.js"></script>
</body>

</html>