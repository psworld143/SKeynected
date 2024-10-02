<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Skeynected</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/sk-logo.png" rel="icon">
    <link href="assets/img/sk-logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>


    <main id="main" class="main">
        <?php
      include 'inc/navbar.php';
      include 'inc/sidebar.php';
    ?>

        <div class="pagetitle">
            <h1>Budget Request</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Budget Request</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">List of Budget</h5>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#adduser" style="margin-right: 12px;">
                                <i class="bx bx-plus"></i>Request Budget
                            </button>
                        </div>
                        <button class='btn btn-danger btn-sm mb-3'><i class="bx bxs-trash"></i>
                            Delete
                        </button>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Project</th>
                                    <th>Adress</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button class='btn btn-primary btn-sm'>
                                            View
                                        </button>
                                        <button class='btn btn-success btn-sm'>
                                            Update
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Modal Sizes</h5>
                <p>Modals have three optional sizes, available via modifier classes to be placed on a
                    <code>.modal-dialog</code>. These sizes kick in at certain breakpoints to avoid horizontal
                    scrollbars on narrower viewports..</p>

                <!-- Small Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#smallModal">
                    Small Modal
                </button>

                <div class="modal fade" id="smallModal" tabindex="-1">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Small Modal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et
                                reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit
                                dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo
                                sit molestias sint dignissimos.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div><!-- End Small Modal-->

                <!-- Large Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal">
                    Large Modal
                </button>

                <div class="modal fade" id="largeModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Large Modal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et
                                reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit
                                dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo
                                sit molestias sint dignissimos.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div><!-- End Large Modal-->

                <!-- Extra Large Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                    Extra Large Modal
                </button>

                <div class="modal fade" id="ExtralargeModal" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Extra Large Modal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et
                                reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit
                                dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo
                                sit molestias sint dignissimos.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div><!-- End Extra Large Modal-->

                <!-- Full Screen Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fullscreenModal">
                    Full Screen Modal
                </button>

                <div class="modal fade" id="fullscreenModal" tabindex="-1">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Full Screen Modal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et
                                reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit
                                dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo
                                sit molestias sint dignissimos.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div><!-- End Full Screen Modal-->

            </div>
        </div>

    </main><!-- End #main -->
    <!-- Vendor JS Files -->
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