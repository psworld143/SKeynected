<?php
require_once '../core/projectController.php';
include_once '../core/sessionController.php';
(new sessionController())->checkLogin();


$projectController = new projectController();
$projects = [];

$project_id = isset($_GET['project_id']) ? (int)$_GET['project_id'] : 0;

if ($project_id > 0) {
    $projects = $projectController->getProjectById($project_id);
    $materials = $projectController->getMaterialsByProjectId($project_id);
}
$file = basename($projects['proposal_file_path']);
$preview_url = "process/preview.php?file=" . urlencode($file);
$download_url = "process/download.php?file=" . urlencode($file);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Project and Materials Tables</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="../assets/img/SK-logo.png" rel="icon">
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

    <link href="../assets/css/globalss.css" rel="stylesheet">

    <style>
        .btn-close {
            background: transparent;
            border: 0;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1rem;
            max-height: 70vh;
            overflow-y: auto;
        }

        .download-link {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin: 1rem;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 0.25rem;
            transition: background-color 0.2s;
        }

        .download-link:hover {
            background-color: #0056b3;
        }

        .btn {
            width: 100px;
            height: 40px;
            padding: 6px 0;
            border-radius: 4px;
            text-align: center;
            font-size: 1.2rem;
            line-height: 1.428571429;
        }

        .icon-bg {
            border-radius: 4px;
            width: 30px;
            display: inline-block;
            text-align: center;
            cursor: pointer;
        }

        .icon-bg.edit {
            background-color: #007bff;
            color: white;
        }

        .icon-bg.delete {
            background-color: #dc3545;
            color: white;
        }

        .icon-bg.view {
            background-color: #007bff;
            color: white;
        }

        .icon-bg i {
            font-size: 16px;
            color: white;
        }

        .icon-bg:hover {
            opacity: 0.8;
        }

        .badge {
            padding: 0.5em 1em;
            border-radius: 50px;
            font-weight: bold;
        }

        .bg-pending {
            background-color: orange;
            color: white;
        }

        .bg-hearing {
            background-color: blue;
            color: white;
        }

        .bg-approved {
            background-color: green;
            color: white;
        }

        .bg-declined {
            background-color: red;
            color: white;
        }

        .bg-info {
            background-color: #17a2b8;
            color: white;
        }

        .nav-link {
            color: #175895;
        }
    </style>
</head>

<body>
    <?php
    include_once '../partials/navbar.php';
    include_once '../partials/sidebar.php';
    ?>

    <main id="main" class="main" style="margin-top: 100px;">
        <div class="pagetitle">
            <h1><b><?= $projects['project_name'] ?></b> and Materials Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                <div class="datatable-top mb-3">
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
                                    <div class="d-flex flex-column">
                                        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="projectTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="project-tab" data-bs-toggle="tab" data-bs-target="#project" type="button" role="tab" aria-controls="project" aria-selected="true">Project</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="materials-tab" data-bs-toggle="tab" data-bs-target="#materials" type="button" role="tab" aria-controls="materials" aria-selected="false">Materials</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="budget-disbursement-tab" data-bs-toggle="tab" data-bs-target="#budget-disbursement" type="button" role="tab" aria-controls="budget-disbursement" aria-selected="false">Budget Disbursement</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="budget-liquidation-tab" data-bs-toggle="tab" data-bs-target="#budget-liquidation" type="button" role="tab" aria-controls="budget-liquidation" aria-selected="false">Budget Liquidation</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="projectTabsContent">
                                    <div class="tab-pane fade show active" id="project" role="tabpanel" aria-labelledby="project-tab">
                                        <div class="datatable-container">
                                            <table class="table datatable datatable-table">
                                                <thead>
                                                    <tr>
                                                        <th><b>Project Name</b></th>
                                                        <th>Project Code</th>
                                                        <th>Description</th>
                                                        <th>Duration</th>
                                                        <th>Status</th>
                                                        <th>Specific Job</th>
                                                        <th>Operation</th>
                                                        <th>Total Cost</th>
                                                        <th>Proposal</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($projects)) : ?>
                                                        <tr>
                                                            <td><strong class="text-primary"><?php echo htmlspecialchars($projects['project_name']) ?></strong></td>
                                                            <td class="text-secondary"><?php echo htmlspecialchars($projects['project_code']); ?></td>
                                                            <td class="text-muted"><?php echo htmlspecialchars($projects['project_description']); ?></td>
                                                            <td class="text-secondary"><?php echo htmlspecialchars($projects['project_duration']); ?></td>
                                                            <td>
                                                                <?php
                                                                $statusClass = 'bg-info'; // Default class
                                                                switch ($projects['status']) {
                                                                    case 'pending':
                                                                        $statusClass = 'bg-pending';
                                                                        break;
                                                                    case 'hearing':
                                                                        $statusClass = 'bg-hearing';
                                                                        break;
                                                                    case 'approved':
                                                                        $statusClass = 'bg-approved';
                                                                        break;
                                                                    case 'declined':
                                                                        $statusClass = 'bg-declined';
                                                                        break;
                                                                }
                                                                ?>
                                                                <span class="badge <?php echo $statusClass; ?>">
                                                                    <?php echo htmlspecialchars($projects['status']); ?>
                                                                </span>
                                                            </td>
                                                            <td class="text-secondary"><?php echo htmlspecialchars($projects['specific_job']); ?></td>
                                                            <td class="text-secondary"><?php echo htmlspecialchars($projects['operations']); ?></td>
                                                            <td class="text-success fw-bold"><?php echo htmlspecialchars($projects['total_cost']); ?></td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <span class="icon-bg view me-1" data-bs-toggle="modal" data-bs-target="#previewModal">
                                                                        <a href="<?php echo htmlspecialchars($preview_url); ?>" class="preview-link">
                                                                            <i class="bi bi-eye "></i>
                                                                        </a>
                                                                    </span>
                                                                    <span class="icon-bg view">
                                                                        <a href="<?php echo htmlspecialchars($download_url); ?>" download>
                                                                            <i class="bi bi-download "></i>
                                                                        </a>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-center">
                                                                    <span class="icon-bg edit me-1" data-bs-toggle="modal" data-bs-target="#editModal"
                                                                        data-id="<?php echo $projects['project_id']; ?>"
                                                                        data-name="<?php echo htmlspecialchars($projects['project_name']); ?>"
                                                                        data-code="<?php echo htmlspecialchars($projects['project_code']); ?>"
                                                                        data-description="<?php echo htmlspecialchars($projects['project_description']); ?>">
                                                                        <i class="bi bi-pencil"></i>
                                                                    </span>
                                                                    <span class="icon-bg delete" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                        data-id="<?php echo $projects['project_id']; ?>">
                                                                        <i class="bi bi-trash"></i>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php else : ?>
                                                        <tr>
                                                            <td colspan="10" class="text-center text-muted">No projects found.</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="materials-tab">
                                        <div class="datatable-container">
                                            <table class="table datatable datatable-table">
                                                <thead>
                                                    <tr>
                                                        <th><b>Material</b></th>
                                                        <th>Qty</th>
                                                        <th>Amount</th>

                                                        <th>Cost</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($materials)) : ?>
                                                        <?php foreach ($materials as $material) : ?>
                                                            <tr>
                                                                <td><strong><?php echo htmlspecialchars($material['material_name']) ?></strong></td>
                                                                <td><?php echo htmlspecialchars($material['quantity']); ?></td>
                                                                <td><?php echo htmlspecialchars($material['amount']); ?></td>
                                                                <td><?php echo htmlspecialchars($material['total']); ?></td>
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <span class="icon-bg edit me-2" data-bs-toggle="modal" data-bs-target="#editMaterialModal"
                                                                            data-id="<?php echo $material['material_id']; ?>"
                                                                            data-name="<?php echo htmlspecialchars($material['material_name']); ?>"
                                                                            data-quantity="<?php echo htmlspecialchars($material['quantity']); ?>"
                                                                            data-amount="<?php echo htmlspecialchars($material['amount']); ?>">
                                                                            <i class="bi bi-pencil"></i>
                                                                        </span>
                                                                        <span class="icon-bg delete" data-bs-toggle="modal" data-bs-target="#deleteMaterialModal"
                                                                            data-id="<?php echo $material['material_id']; ?>">
                                                                            <i class="bi bi-trash"></i>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="6">No materials found.</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">File Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body" id="previewContent">
                    <!-- Preview content will be loaded here -->
                </div>
                <a href="<?php echo htmlspecialchars($download_url); ?>" download class="download-link">
                    Download Proposal
                </a>
            </div>
        </div>
    </div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const previewLinks = document.querySelectorAll('.preview-link');
            const previewContent = document.getElementById('previewContent');

            previewLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.getAttribute('href');
                    fetch(url)
                        .then(response => response.text())
                        .then(data => {
                            previewContent.innerHTML = data;
                        })
                        .catch(error => {
                            previewContent.innerHTML = 'Error loading preview: ' + error;
                        });
                });
            });
        });

        function toggleHearingDate() {
            const statusSelect = document.getElementById('statusSelect');
            const hearingDateDiv = document.getElementById('hearingDateDiv');

            if (statusSelect.value === 'hearing') {
                hearingDateDiv.style.display = 'block';
            } else {
                hearingDateDiv.style.display = 'none';
            }
        }

        document.getElementById('updateStatusForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Add your code here to handle the form submission, e.g., AJAX request to update the status
            const formData = new FormData(this);
            // Perform an AJAX call to update the status in the backend
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Existing preview functionality
            const previewLinks = document.querySelectorAll('.preview-link');
            const previewContent = document.getElementById('previewContent');

            previewLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.getAttribute('href');
                    fetch(url)
                        .then(response => response.text())
                        .then(data => {
                            previewContent.innerHTML = data;
                        })
                        .catch(error => {
                            previewContent.innerHTML = 'Error loading preview: ' + error;
                        });
                });
            });

            // Tab functionality
            const tabs = document.querySelectorAll('#projectTabs button');
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tabId = this.getAttribute('data-bs-target');
                    document.querySelector(tabId).classList.add('show', 'active');
                    this.classList.add('active');
                    tabs.forEach(otherTab => {
                        if (otherTab !== this) {
                            otherTab.classList.remove('active');
                            const otherTabId = otherTab.getAttribute('data-bs-target');
                            document.querySelector(otherTabId).classList.remove('show', 'active');
                        }
                    });
                });
            });
        });

        function toggleHearingDate() {
            const statusSelect = document.getElementById('statusSelect');
            const hearingDateDiv = document.getElementById('hearingDateDiv');

            if (statusSelect.value === 'hearing') {
                hearingDateDiv.style.display = 'block';
            } else {
                hearingDateDiv.style.display = 'none';
            }
        }

        document.getElementById('updateStatusForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Add your code here to handle the form submission, e.g., AJAX request to update the status
            const formData = new FormData(this);
            // Perform an AJAX call to update the status in the backend
        });
    </script>
</body>

</html>