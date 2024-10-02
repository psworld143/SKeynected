<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK Chairman / Project Overview</title>
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

    .badge-plan {
        margin-right: 5px;
        margin-bottom: 5px;
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
            <div class="container my-5">
                <h2 class="purok-title">Project Details</h2>
                <div class="project-card">
                    <h3 class="card-title">Project Name</h3>
                    <p class="card-description">Project Description</p>

                    <div class="mb-3">
                        <span class="badge rounded-pill bg-success">Completed</span>
                    </div>

                    <!-- Budget Allocation -->
                    <div class="mb-3">
                        <label for="budget" class="form-label">Budget Allocation</label>
                        <input type="number" class="form-control" id="budget" placeholder="Enter budget allocation">
                    </div>

                    <!-- Project Plans with Tags -->
                    <div class="mb-3">
                        <label for="project-plans" class="form-label">Project Plans</label>
                        <div id="tags-container" class="mb-2"></div>
                        <div class="input-group">
                            <input type="text" id="project-plan-input" class="form-control" placeholder="Add project plan" aria-label="Add project plan">
                            <button class="btn btn-outline-secondary" type="button" id="add-plan-btn">Add</button>
                        </div>
                    </div>

                    <!-- Project Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Update Project Status</label>
                        <select class="form-select" id="status">
                            <option selected>Choose status...</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="stopped">Stopped</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Save Changes</button>
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

    <script>
        
        document.getElementById('add-plan-btn').addEventListener('click', function() {
            const input = document.getElementById('project-plan-input');
            const planText = input.value.trim();

            if (planText) {
                const tagsContainer = document.getElementById('tags-container');
                const newBadge = document.createElement('span');
                newBadge.className = 'badge rounded-pill bg-info badge-plan';
                newBadge.textContent = planText;
                tagsContainer.appendChild(newBadge);
                input.value = '';
            }
        });
    </script>
</body>

</html>