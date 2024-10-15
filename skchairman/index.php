<?php 
$success = '';
$error = '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SKeynected - Login</title>
  <link href="assets/img/SK-logo.png" rel="icon">
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
      margin: 0;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('assets/img/project-header.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      filter: blur(5px);

      z-index: -1;
    }

    body::after {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(25, 22, 163, 0.5);
      z-index: -1;
    }

    body {
      position: relative;
      z-index: 1;
      backdrop-filter: blur(5px);
    }

    .left-section {
      padding: 100px;
      color: #fff;
    }

    .left-section h1 {
      font-size: 1.2rem;
      margin-bottom: 0;
    }

    .left-section h2 {
      font-size: 2.5rem;
      font-weight: bold;
      line-height: 1;
      margin-bottom: 2rem;
    }

    .core-values {
      list-style-type: none;
      padding-left: 0;
    }

    .core-values li {
      margin-bottom: 5px;
    }

    .login-section {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .logo {
      max-width: 80px;
      margin-bottom: 20px;
    }

    .btn-primary {
      background-color: #1916a3;
      border-color: #1916a3;
    }

    .btn-primary:hover {
      background-color: #1916a3;
      border-color: #1916a3;
    }

    .forgot-password {
      color: #1916a3;
    }

    span {
      color: #1916a3;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-md-7 left-section d-flex flex-column justify-content-center">
        <h1>Sangguniang Kabataan</h1>
        <h2>Empowering the<br>Youth<br>Nationwide</h2>
        <div>
          <h3>SK CORE:</h3>
          <ul class="core-values">
            <li><strong>S</strong>olidarity</li>
            <li><strong>K</strong>abataan (Youth Empowerment)</li>
            <li><strong>I</strong>ntegrity</li>
            <li><strong>P</strong>articipation</li>
            <li><strong>A</strong>ction</li>
          </ul>
          <h4 class="mt-4">Committed to the Total Development<br>of the Youth</h4>
        </div>
      </div>

      <div class="col-md-5 d-flex align-items-center justify-content-center">
        <div class="login-section">
          <div class="text-center mb-4">
            <img src="assets/img/sk-logo.png" alt="Logo" class="logo">
            <h6>Sign in to <span>SK</span>eynected</h6>
          </div>
          <form action="auth.php" method="post">
            <div class="mb-3">
              <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="showPassword">
              <label class="form-check-label" for="showPassword">Show Password</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign in</button>
          </form>

          <?php if (!empty($success)): ?>
            <div class="alert alert-success">
              <?php echo $success; ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
              <?php echo $error; ?>
            </div>
          <?php endif; ?>
          <div class="text-center mt-3">
            <a href="#" class="forgot-password">Forgot password? Click here</a>
          </div>
        </div>
      </div>
    </div>
  </div>
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