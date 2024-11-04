<?php
include_once './core/Database.php';
include_once './core/SessionController.php';
(new SessionController())->checkLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - SK Chairman</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/LYDOO.jpg" rel="icon">
  <link href="assets/img/SK-logo.png" rel="apple-touch-icon">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<style>
  .bg-gradient-incoming {
    background: linear-gradient(135deg, #66a6ff 0%, #0C484CFF 100%);
  }

  .bg-gradient-pending {
    background: linear-gradient(135deg, #FFBF00FF 0%, #5F490AFF 100%);
  }

  .bg-gradient-received {
    background: linear-gradient(135deg, #00FF3CFF 0%, #126425FF 100%);
  }

  .bg-gradient-ended {
    background: linear-gradient(135deg, #FF0505FF 0%, #4C0C0CFF 100%);
  }

  .card-icon i {
    font-size: 2rem;
  }

  .carousel {
    height: 450px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .carousel-inner {
    height: 100%;
  }

  .carousel-item {
    height: 100%;
  }

  .carousel-item img {
    height: 100%;
    width: 100%;
    border-radius: 5px;
    object-fit: cover;
  }
</style>

<body>
  <?php
  include_once 'partials/navbar.php';
  include_once 'partials/sidebar.php';
  ?>

  <main id="main" class="main" style="margin-top: 100px;">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item">
                <img src="assets/img/LYDC.png" class="d-block" alt="...">
              </div>
              <div class="carousel-item">
                <img src="assets/img/SK.jpg" class="d-block" alt="...">
              </div>
              <div class="carousel-item active">
                <img src="assets/img/LYDO-tupi.jpg" class="d-block" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>

        <div class="col-lg-12 mt-2">
          <h5 class="card-title">Demographic View</h5>
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div id="barangayChart" style="min-height: 400px;"></div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div id="youthChart" style="min-height: 400px;"></div>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-lg-6">
              <div class="card">
                <div id="sexChart" style="min-height: 400px;"></div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div id="ageChart" style="min-height: 400px;"></div>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-lg-6">
              <div class="card">
                <div id="genderPrefChart" style="min-height: 400px;"></div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div id="civilStatusChart" style="min-height: 400px;"></div>
              </div>
            </div>
          </div>

          <script>
            document.addEventListener("DOMContentLoaded", () => {
              const apiUrl = 'barangayApi.php';

              const createPieChart = (chartElementId, titleText, seriesName, data, labels) => {
                const chart = echarts.init(document.querySelector(chartElementId));
                const options = {
                  title: {
                    text: titleText,
                    subtext: 'Dynamic Data',
                    left: 'center'
                  },
                  tooltip: {
                    trigger: 'item'
                  },
                  legend: {
                    orient: 'vertical',
                    left: 'left'
                  },
                  series: [{
                    name: seriesName,
                    type: 'pie',
                    radius: '50%',
                    data: data.map((value, index) => ({
                      value: value,
                      name: labels[index]
                    })),
                    emphasis: {
                      itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                      }
                    }
                  }]
                };
                chart.setOption(options);
              };

              fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                  createPieChart('#barangayChart', 'Barangay Data', 'Barangay', data.baranggayData, data.baranggays);
                  createPieChart('#youthChart', 'Youth Data', 'Youth', data.youthData, data.youthLabels);
                  createPieChart('#sexChart', 'Sex Data', 'Sex', data.sexData, data.sexLabels);
                  createPieChart('#ageChart', 'Age Data', 'Age Group', data.ageData, data.ageLabels);
                  createPieChart('#genderPrefChart', 'Gender Preference', 'Gender Preference', data.genderPrefData, data.genderPrefLabels);
                  createPieChart('#civilStatusChart', 'Civil Status', 'Civil Status', data.civilStatusData, data.civilStatusLabels);
                })
                .catch(error => console.error('Error fetching data:', error));
            });
          </script>
        </div>
      </div>
    </section>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>