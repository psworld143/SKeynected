<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK Chairman / Project</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="icon" href="../assets/img/sk-logo.png">
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/vendor/quill/quill.snow.css">
    <link rel="stylesheet" href="../assets/vendor/quill/quill.bubble.css">
    <link rel="stylesheet" href="../assets/vendor/remixicon/remixicon.css">
    <link rel="stylesheet" href="../assets/vendor/simple-datatables/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <main id="main" class="main">
        <?php
        include '../inc/navbar.php';
        include '../inc/sidebar.php';
        ?>

        <div class="pagetitle">
            <h1>Manage Youth</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Youth</a></li>
                    <li class="breadcrumb-item active">Manage Youth</li>
                </ol>
            </nav>
        </div>

        <section class="section charts-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Barangay Population Distribution</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-barangay"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section charts-section mb-4">
            <div class="container">
                <div class="row d-flex">
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h4>Sex:</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-sex"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h4>Member of Out of School Youth:</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-school-youth-members"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="section charts-section mb-4">
            <div class="container">
                <div class="row d-flex">
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h4>Age:</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-age"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h4>Age Classification:</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-age-classification"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section charts-section">
            <div class="container">
                <div class="row d-flex">
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h4>Gender Preference:</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-gender-pref"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h4>Civil Status:</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-civil-status"></div>
                            </div>
                        </div>
                    </div>
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

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/charts.js"></script>
</body>

</html>