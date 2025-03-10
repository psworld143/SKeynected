<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LYDO - Login</title>
  <link href="assets/img/LYDOO.jpg" rel="icon">
  <link href="assets/img/SK-logo.png" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="assets/css/globalss.css" rel="stylesheet">
  <style>
    body,
    html {
      height: 100%;
    }

    .login-container {
      height: 100%;
    }

    .logo-section {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo {
      width: 90%;
      height: 100%;
    }

    .form-section {
      padding: 50px;
    }

    .form-control {
      background-color: #175895;
      border: none;
      color: white;
      padding: 10px 15px;
      margin-bottom: 15px;
    }

    .form-control::placeholder {
      color: #aaa;
    }

    .btn-connect {
      background-color: #175895;
      color: white;
      border: none;
      padding: 10px 20px;
    }

    .btn-connect:hover {
      background-color: #175895;
      color: black;
    }

    .forgot-password {
      font-size: 0.9em;
      color: #aaa;
      text-decoration: none;
    }

    .forgot-password:hover {
      color: #175895;
    }

    form h1 {
      color: #175895;
    }
  </style>
</head>

<body>
  <div class="container-fluid h-100">
    <div class="row login-container">
      <div class="col-md-6 logo-section">
        <img src="assets/img/LYDO-tupi.jpg" alt="NSA Logo" class="logo">
      </div>
      <div class="col-md-6 form-section d-flex align-items-center">
        <div class="w-100">
          <h1 class="mb-4">Login</h1>
          <p class="mb-2">Please login to access LYDO services.</p>
          <form action="auth.php" method="POST">
            <div class="mb-3">
              <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <a href="#" class="forgot-password">Forgot password?<br>What is this?</a>
              <button type="submit" class="btn btn-connect">Connect <span>&rarr;</span></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="assets/js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/Chart.roundedBarCharts.js"></script>

</body>

</html>