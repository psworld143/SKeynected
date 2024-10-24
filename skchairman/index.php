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
      max-height: 120vh;
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

    .partner-logos {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 20px;
    }

    .partner-logos img {
      max-width: 100px;
      margin: 0 50px;
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
              <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="showPassword">
              <label class="form-check-label" for="showPassword">Show Password</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign in</button>
          </form>
          <div class="text-center mt-3">
            <a href="#" class="forgot-password">Forgot password? Click here</a>
          </div>
        </div>
      </div>
      <div class="col-12 partner-logos">
        <div><img src="assets/img/LYDC.png" alt="Partner 1 Logo"></div>
        <div><img src="assets/img/LYDO-tupi.jpg" alt="Partner 2 Logo"></div>
        <div><img src="assets/img/sk-logo.png" alt="Partner 3 Logo"></div>
        <div><img src="assets/img/LGU.jfif" alt="Partner 4 Logo"></div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('showPassword').addEventListener('change', function () {
      const passwordField = document.getElementById('password');
      if (this.checked) {
        passwordField.type = 'text';
      } else {
        passwordField.type = 'password';
      }
    });
  </script>
</body>

</html>