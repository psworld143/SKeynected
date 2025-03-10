<?php
require_once '../core/projectController.php';
include_once '../core/sessionController.php';
(new sessionController())->checkLogin();
$projectController = new projectController();

$notif = new projectController();
$notifications = $notif->getProjectNotif();
$notificationCount = $notif->getNotificationCount();
$user_id = $_SESSION['id'] ?? null;
$barangay_id = $_SESSION['barangay_id'] ?? null;

$projects = $projectController->getProjects($user_id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Project Management</title>
    <meta content="Project Management Dashboard" name="description">
    <meta content="projects, management, dashboard" name="keywords">

    <link href="../assets/img/SK-logo.png" rel="icon">

    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        .project-card {
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .project-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .project-card p {
            font-size: 14px;
            color: #666;
        }

        .progress {
            height: 10px;
            margin-bottom: 10px;
        }

        .project-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .project-team img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: -10px;
            border: 2px solid #fff;
        }

        .time-left {
            font-size: 12px;
            background-color: #e9ecef;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .add-project-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .add-project-btn:hover {
            background-color: #45a049;
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

        .card-custom {
            height: 150px;
        }

        .card-custom i {
            font-size: 20px;
        }

        .card-custom .rounded-circle {
            width: 50px;
            height: 50px;
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
            <div class="d-flex justify-content-between align-items-center">
                <h1>Projects</h1>
                <div class="header-actions">
                    <button class="add-project-btn" data-bs-toggle="modal" data-bs-target="#addProjectModal">
                        <i class="bi bi-plus"></i> Add Project
                    </button>
                </div>
            </div>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Manage</li>
                    <li class="breadcrumb-item active">Projects</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="background-image-container"
                        style="background-image: url('../assets/img/bg-blue.jpg'); background-size: cover; background-position: center; padding: 40px; border-radius: 5px; margin-bottom: 20px;">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card info-card sales-card card-custom">
                                            <div class="card-body">
                                                <h5 class="card-title">Hearing</h5>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-clock-history"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card info-card revenue-card card-custom">
                                            <div class="card-body">
                                                <h5 class="card-title">Approved</h5>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-check-circle"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card info-card customers-card card-custom">
                                            <div class="card-body">
                                                <h5 class="card-title">Declined</h5>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-x-circle"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card info-card sales-card card-custom">
                                            <div class="card-body">
                                                <h5 class="card-title">Total Projects</h5>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-folder"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <?php foreach ($projects as $project): ?>
                            <div class="col-md-3">
                                <a href="projectOverview.php?project_id=<?php echo $project['project_id']; ?>">
                                    <div class="card">
                                        <img class="card-img-top" src="../assets/img/bg-blue.jpg" alt="Unsplash"
                                            width="100%" height="150px" style="object-fit: cover;">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">
                                                <?php echo htmlspecialchars($project['project_name']); ?>
                                            </h5>
                                            <div class="badge 
                                                <?php
                                                if ($project['status'] == 'pending') {
                                                    echo 'bg-pending';
                                                } elseif ($project['status'] == 'hearing') {
                                                    echo 'bg-hearing';
                                                } elseif ($project['status'] == 'approved') {
                                                    echo 'bg-approved';
                                                } elseif ($project['status'] == 'declined') {
                                                    echo 'bg-declined';
                                                }
                                                ?>">
                                                <?php echo htmlspecialchars($project['status']); ?>
                                            </div>
                                        </div>
                                        <div class="card-body" style="background-color: #f9f9f9;">
                                            <div class="sk-member-info d-flex align-items-center mt-2">
                                                <img src="../assets/img/avatar.gif" class="rounded-circle me-2" alt="Avatar"
                                                    width="40" height="40">
                                                <div>
                                                    <p class="sk-member-name"
                                                        style="margin: 0; font-size: 14px; font-weight: bold; color: #007bff;">
                                                        <?php echo htmlspecialchars($project['sk_member_name']); ?>
                                                    </p>
                                                    <p class="sk-member-position"
                                                        style="margin: 0; font-size: 12px; color: #666;">
                                                        <?php echo htmlspecialchars($project['sk_member_position']); ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <p class="barangay-name" style="font-size: 12px; color: darkslategray;">
                                                Barangay:
                                                <strong><?php echo htmlspecialchars($project['barangay_name']); ?></strong>
                                            </p>
                                            <?php
                                            $progressPercentage = 0;
                                            $progressColor = 'bg-secondary';

                                            switch ($project['status']) {
                                                case 'pending':
                                                    $progressPercentage = 25;
                                                    $progressColor = 'bg-warning';
                                                    break;
                                                case 'hearing':
                                                    $progressPercentage = 50;
                                                    $progressColor = 'bg-info';
                                                    break;
                                                case 'approved':
                                                    $progressPercentage = 75;
                                                    $progressColor = 'bg-primary';
                                                    break;
                                                case 'completed':
                                                    $progressPercentage = 100;
                                                    $progressColor = 'bg-success';
                                                    break;
                                                default:
                                                    $progressPercentage = 0;
                                                    $progressColor = 'bg-secondary';
                                                    break;
                                            }


                                            if ($project['status'] === 'declined') {
                                                $progressColor = 'bg-danger';
                                            }
                                            ?>
                                            <div class="progress " style="height: 10px;">
                                                <div class="progress-bar <?php echo $progressColor; ?>" role="progressbar"
                                                    style="width: <?php echo $progressPercentage; ?>%;"
                                                    aria-valuenow="<?php echo $progressPercentage; ?>" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <p class="text-muted mt-1" style="font-size: 12px;">
                                                Project Progress: <?php echo $progressPercentage; ?>%
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- <div class="modal fade" id="validationModal" tabindex="-1" role="dialog" aria-labelledby="validationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="validationModalLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalMessageContent">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->
    <div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProjectModalLabel">Add New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProjectForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="projectName" class="form-label">Project Name</label>
                                <input type="hidden" name="barangay_id" value="<?php echo $barangay_id; ?>">
                                <input type="text" class="form-control" id="projectName" name="projectName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="projectCode" class="form-label">Project Code</label>
                                <input type="text" class="form-control" id="projectCode" name="projectCode" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="projectDuration" class="form-label">Project Duration (In Days)</label>
                                <input type="text" class="form-control" id="projectDuration" name="projectDuration">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="projectDescription" class="form-label">Project Description</label>
                            <textarea class="form-control" id="projectDescription" name="projectDescription" rows="3"
                                required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="specificJob" class="form-label">Specific Job</label>
                                <input type="text" class="form-control" id="specificJob" name="specificJob" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="operations" class="form-label">Operations</label>
                                <input type="text" class="form-control" id="operations" name="operations" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="materials" class="form-label">Material</label>
                                <input type="text" class="form-control" id="materials" name="materials"
                                    placeholder="e.g., Cement">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                    placeholder="e.g., 5">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label">Amount (₱ per unit)</label>
                                <input type="number" class="form-control" id="amount" name="amount"
                                    placeholder="e.g., 100">
                            </div>
                        </div>
                        <button type="button" class="btn btn-info mb-3" onclick="addMaterial()">Add Material</button>
                        <div id="materialList"></div>
                        <div class="mb-3">
                            <div id="receipt" class="p-2"></div>
                            <button type="button" class="btn btn-info mt-2" onclick="printReceipt()">
                                <i class="bi bi-printer"></i> Print Receipt
                            </button>
                        </div>

                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="totalCost" name="totalCost" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="proposal" class="form-label">Project Proposal</label>
                            <input type="file" class="form-control" id="proposal" name="proposal"
                                accept=".pdf,.doc,.docx">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="submitProject()">Submit
                                Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Your existing JS files -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>

    <script>
        let materialsArray = [];

        function generateProjectCode() {
            const prefix = "SKP-";
            const randomNum = Math.floor(Math.random() * 9000) + 1000;
            return prefix + randomNum;
        }

        function setProjectCode() {
            document.getElementById('projectCode').value = generateProjectCode();
        }

        window.onload = setProjectCode;

        function addMaterial() {
            const materialName = document.getElementById('materials').value;
            const quantity = parseFloat(document.getElementById('quantity').value);
            const amount = parseFloat(document.getElementById('amount').value);

            // Removed reference to or_number from validation
            if (!materialName || isNaN(quantity) || isNaN(amount)) {
                alert('Please enter valid values for all material fields.');
                return;
            }

            // Push material to the array without or_number
            materialsArray.push({
                materialName,
                quantity,
                amount
            });

            // Clear the input fields after adding the material
            document.getElementById('materials').value = '';
            document.getElementById('quantity').value = '';
            document.getElementById('amount').value = '';

            renderMaterialsList();
            calculateTotalCost();
            updateReceipt();
        }

        function renderMaterialsList() {
            const materialListDiv = document.getElementById('materialList');
            materialListDiv.innerHTML = '';

            materialsArray.forEach((material) => {
                const materialItem = document.createElement('div');
                materialItem.className = 'row mb-2';
                materialItem.innerHTML = `
                <div class="col-lg-12">
                    <div class="row">
                        <div>Material name: <strong>${material.materialName}</strong></div>
                        <div>Quantity: <strong>${material.quantity}</strong></div>
                        <div>Amount: <strong>₱${material.amount.toFixed(2)}</strong></div>
                    </div>
                </div>
            `;
                materialListDiv.appendChild(materialItem);
            });
        }

        function calculateTotalCost() {
            let totalCost = materialsArray.reduce((sum, material) => sum + material.quantity * material.amount, 0);
            document.getElementById('totalCost').value = totalCost.toFixed(2);
        }

        function updateReceipt() {
            let tableHTML = `
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Materials Total Cost</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
        `;

            materialsArray.forEach(material => {
                const total = material.quantity * material.amount;
                tableHTML += `
                <tr>
                    <td>${material.materialName}</td>
                    <td>${material.quantity}</td>
                    <td>₱${material.amount.toFixed(2)}</td>
                    <td>₱${total.toFixed(2)}</td>
                </tr>
            `;
            });

            let totalCost = materialsArray.reduce((sum, material) => sum + material.quantity * material.amount, 0);

            tableHTML += `
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" style="text-align: right;"><strong>Total Cost:</strong></td>
                                <td>₱${totalCost.toFixed(2)}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        `;

            // Set the generated HTML to the receipt div
            document.getElementById('receipt').innerHTML = tableHTML;
        }

        function submitProject() {
            const formData = new FormData(document.getElementById('addProjectForm'));
            formData.append('materials', JSON.stringify(materialsArray));
            formData.append('status', 'pending');

            fetch('addProject.php', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.text();
                })
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        console.log(data);
                        if (data.success) {
                            alert(data.message || "Project submitted successfully!");
                            document.getElementById('addProjectForm').reset();
                            materialsArray = [];
                            renderMaterialsList();
                            updateReceipt();
                        } else {
                            alert(data.message || "Failed to submit the project.");
                        }
                    } catch (error) {
                        console.error('Error parsing JSON:', error);
                        console.log('Raw response:', text);
                        alert("An error occurred while processing the response.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An error occurred: " + error.message);
                });
        }
    </script>


    <script>
        function printReceipt() {
            const receiptContent = document.getElementById('receipt').value;
            const printWindow = window.open('', '', 'width=800,height=600');


            printWindow.document.write(`
            <html>
            <head>
                <title>Print Receipt</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        padding: 20px;
                    }
                    pre {
                        font-family: monospace;
                        white-space: pre-wrap;
                    }
                </style>
            </head>
            <body>
                <h2>Receipt</h2>
                <pre>${receiptContent}</pre>
                <script>
                    window.onload = function() {
                        window.print();
                        window.onafterprint = function() {
                            window.close(); // Close the window after printing
                        };
                    }
                <\/script>
            </body>
            </html>
        `);
            printWindow.document.close();
        }
        $(document).ready(function () {
            // Check for error message
            <?php if (isset($_SESSION['error'])): ?>
                $('#modalMessageContent').html('<div class="alert alert-danger" role="alert"><?php echo $_SESSION['error']; ?></div>');
                $('#validationModal').modal('show'); // Show the modal
                <?php unset($_SESSION['error']); ?> // Clear the error message from session
            <?php endif; ?>

            // Check for success message
            <?php if (isset($_SESSION['success'])): ?>
                $('#modalMessageContent').html('<div class="alert alert-success" role="alert"><?php echo $_SESSION['success']; ?></div>');
                $('#validationModal').modal('show'); // Show the modal
                <?php unset($_SESSION['success']); ?> // Clear the success message from session
            <?php endif; ?>
        });
    </script>

</body>

</html>