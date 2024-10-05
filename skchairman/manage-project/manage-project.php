<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title></title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/SK-logo.png" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="../assets/css/style.css" rel="stylesheet">


</head>

<body>
    <?php
    include_once '../partials/navbar.php';
    include_once '../partials/sidebar.php';
    ?>

    <main id="main" class="main" style="margin-top: 100px;">
        <div class="pagetitle">
            <h1>Manage Projects</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Projects</a></li>
                    <li class="breadcrumb-item active">Manage Projects</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Recent Activity <span>| Today</span></h5>

                            <div class="activity">

                                <div class="activity-item d-flex">
                                    <div class="activite-label">32 min</div>
                                    <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                                    <div class="activity-content">
                                        Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">56 min</div>
                                    <i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>
                                    <div class="activity-content">
                                        Voluptatem blanditiis blanditiis eveniet
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">2 hrs</div>
                                    <i class="bi bi-circle-fill activity-badge text-primary align-self-start"></i>
                                    <div class="activity-content">
                                        Voluptates corrupti molestias voluptatem
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">1 day</div>
                                    <i class="bi bi-circle-fill activity-badge text-info align-self-start"></i>
                                    <div class="activity-content">
                                        Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">2 days</div>
                                    <i class="bi bi-circle-fill activity-badge text-warning align-self-start"></i>
                                    <div class="activity-content">
                                        Est sit eum reiciendis exercitationem
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">4 weeks</div>
                                    <i class="bi bi-circle-fill activity-badge text-muted align-self-start"></i>
                                    <div class="activity-content">
                                        Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                                    </div>
                                </div><!-- End activity item-->

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProjectModalLabel">Create New Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Start of collapsible sections -->
                        <div class="accordion" id="projectAccordion">

                            <!-- Project Management Section -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingManagement">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseManagement" aria-expanded="true" aria-controls="collapseManagement">
                                        Project Management
                                    </button>
                                </h2>
                                <div id="collapseManagement" class="accordion-collapse collapse show" aria-labelledby="headingManagement" data-bs-parent="#projectAccordion">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <label for="projectName" class="form-label">Project Name</label>
                                            <input type="text" class="form-control" id="projectName" name="projectName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="projectDescription" class="form-label">Project Description</label>
                                            <textarea class="form-control" id="projectDescription" name="projectDescription" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="projectCode" class="form-label">Project Code</label>
                                            <input type="text" class="form-control" id="projectCode" name="projectCode" placeholder="e.g., SKP-0001" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="projectDuration" class="form-label">Project Duration</label>
                                            <input type="text" class="form-control" id="projectDuration" name="projectDuration" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Costs Section -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingCosts">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCosts" aria-expanded="false" aria-controls="collapseCosts">
                                        Project Costs
                                    </button>
                                </h2>
                                <div id="collapseCosts" class="accordion-collapse collapse" aria-labelledby="headingCosts" data-bs-parent="#projectAccordion">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <label for="materialName" class="form-label">Material Name</label>
                                            <input type="text" class="form-control" id="materialName" name="materialName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="materialQuantity" class="form-label">Material Quantity</label>
                                            <input type="number" class="form-control" id="materialQuantity" name="materialQuantity" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="materialAmount" class="form-label">Material Amount</label>
                                            <input type="number" class="form-control" id="materialAmount" name="materialAmount" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="totalCost" class="form-label">Total Cost</label>
                                            <input type="number" class="form-control" id="totalCost" name="totalCost" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Operation Section -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOperation">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOperation" aria-expanded="false" aria-controls="collapseOperation">
                                        Project Operation
                                    </button>
                                </h2>
                                <div id="collapseOperation" class="accordion-collapse collapse" aria-labelledby="headingOperation" data-bs-parent="#projectAccordion">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <label for="specificJob" class="form-label">Specific Job</label>
                                            <input type="text" class="form-control" id="specificJob" name="specificJob" placeholder="e.g., Flooring, Roofing, etc." required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Finalization Section -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFinalization">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFinalization" aria-expanded="false" aria-controls="collapseFinalization">
                                        Project Finalization
                                    </button>
                                </h2>
                                <div id="collapseFinalization" class="accordion-collapse collapse" aria-labelledby="headingFinalization" data-bs-parent="#projectAccordion">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <label for="proposalFile" class="form-label">Attach Soft Copy of Project Proposal</label>
                                            <input type="file" class="form-control" id="proposalFile" name="proposalFile" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="proposalReview" class="form-label">Review Proposal</label>
                                            <textarea class="form-control" id="proposalReview" name="proposalReview" rows="3" placeholder="Project Name, Project Cost, etc." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of collapsible sections -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Project</button>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/bootstrap/css/bootstrap.min.css"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script>
        document.getElementById('addProjectBtn').addEventListener('click', function() {
            var myModal = new bootstrap.Modal(document.getElementById('addProjectModal'), {
                keyboard: true
            });
            myModal.show();
        });

        document.getElementById('materialQuantity').addEventListener('input', calculateTotalCost);
        document.getElementById('materialAmount').addEventListener('input', calculateTotalCost);

        function calculateTotalCost() {
            let quantity = document.getElementById('materialQuantity').value;
            let amount = document.getElementById('materialAmount').value;
            let totalCost = quantity * amount;
            document.getElementById('totalCost').value = totalCost;
        }
    </script>


</body>

</html>