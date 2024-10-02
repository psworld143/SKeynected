<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK Chairman / Project</title>
    <link rel="icon" href="../assets/img/sk-logo.png">
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/vendor/remixicon/remixicon.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
</head>
<style>
    .project-card {
        border-left: 8px solid #4caf50;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .project-card:hover {
        transform: translateY(-3px);

    }

    .progress-bar-custom {
        background-color: #4caf50;

    }

    .row {
        margin-bottom: 1rem;

    }

    .card-title {
        margin-bottom: 0.5rem;

    }

    .card-text {
        margin-bottom: 0.5rem;

    }

    .progress {
        height: 0.75rem;

    }

    .project-completion {
        font-size: 0.85rem;
        margin-top: 0.25rem;

    }

    .purok-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 1rem;
        color: #4caf50;
    }
</style>

<body>
    <main id="main" class="main">
        <?php
        include '../inc/navbar.php';
        include '../inc/sidebar.php';
        ?>

        <div class="pagetitle">
            <h1>Project Overview</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Overview</a></li>
                    <li class="breadcrumb-item active">Project Overview</li>
                </ol>
            </nav>
        </div>

        <!-- Project Management Section -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Purok Youths</h5>
                            <p>Add lightweight datatables to your project using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library.</p>

                            <!-- Table with stripped rows -->
                            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                <div class="datatable-top">
                                    <div class="datatable-dropdown">
                                        <label>
                                            <select class="datatable-selector" name="per-page">
                                                <option value="5">5</option>
                                                <option value="10" selected="">10</option>
                                                <option value="15">15</option>
                                                <option value="-1">All</option>
                                            </select> entries per page
                                        </label>
                                    </div>
                                    <div class="datatable-search">
                                        <input class="datatable-input" placeholder="Search..." type="search" name="search" title="Search within table">
                                    </div>
                                </div>
                                <div class="datatable-container">
                                    <table class="table datatable datatable-table">
                                        <thead>
                                            <tr>
                                                <th data-sortable="true">ID</th>
                                                <th data-sortable="true">Name</th>
                                                <th data-sortable="true">Age</th>
                                                <th data-sortable="true">Purok</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr data-index="0">
                                                <td>1</td>
                                                <td>John Doe</td>
                                                <td>18</td>
                                                <td>Purok 1</td>
                                                <td><a href="view-youth.php?id=1" class="btn-view">View Details</a></td>
                                            </tr>
                                            <tr data-index="1">
                                                <td>2</td>
                                                <td>Jane Smith</td>
                                                <td>19</td>
                                                <td>Purok 2</td>
                                                <td><a href="view-youth.php?id=2" class="btn-view">View Details</a></td>
                                            </tr>
                                            <!-- Add more youth records here -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="datatable-bottom">
                                    <div class="datatable-info">Showing 1 to 10 of 100 entries</div>
                                    <nav class="datatable-pagination">
                                        <ul class="datatable-pagination-list">
                                            <li class="datatable-pagination-list-item datatable-hidden datatable-disabled">
                                                <button data-page="1" class="datatable-pagination-list-item-link" aria-label="Page 1">‹</button>
                                            </li>
                                            <li class="datatable-pagination-list-item datatable-active">
                                                <button data-page="1" class="datatable-pagination-list-item-link" aria-label="Page 1">1</button>
                                            </li>
                                            <li class="datatable-pagination-list-item">
                                                <button data-page="2" class="datatable-pagination-list-item-link" aria-label="Page 2">2</button>
                                            </li>
                                            <li class="datatable-pagination-list-item">
                                                <button data-page="3" class="datatable-pagination-list-item-link" aria-label="Page 3">3</button>
                                            </li>
                                            <li class="datatable-pagination-list-item datatable-ellipsis datatable-disabled">
                                                <button class="datatable-pagination-list-item-link">…</button>
                                            </li>
                                            <li class="datatable-pagination-list-item">
                                                <button data-page="10" class="datatable-pagination-list-item-link" aria-label="Page 10">10</button>
                                            </li>
                                            <li class="datatable-pagination-list-item">
                                                <button data-page="2" class="datatable-pagination-list-item-link" aria-label="Page 2">›</button>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
</body>

</html>