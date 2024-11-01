<?php
require_once '../core/userController.php';
require_once '../core/projectController.php';
require_once '../core/youthController.php';
include_once '../core/sessionController.php';

$youthController = new youthController();
(new sessionController())->checkLogin();

$youthId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$responseData = [];
if ($youthId) {
    $responseData = $youthController->getSurveyResponsesByResponseId($youthId);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Manage Youth</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<style>
    .survey-section {
        margin-bottom: 2rem;
    }

    .survey-section-title {
        font-weight: bold;
        margin-bottom: 1rem;
        color: #012970;
        border-bottom: 1px solid #012970;
        padding-bottom: 0.5rem;
    }

    .survey-label {
        font-weight: 600;
        color: #4154f1;
    }

    .survey-value {
        margin-bottom: 0.5rem;
    }

    .card-header {
        background-color: #012970;
        color: white;
    }

    .profile-image-container {
        position: relative;
        display: inline-block;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .profile-image-container:hover .image-overlay {
        opacity: 1;
    }

    .profile-photo-lg {
        border: 3px solid #012970;
        border-radius: 50%;
    }

    .bi-camera {
        font-size: 24px;
        margin-bottom: 8px;
    }

    .btn-custom {
        width: auto;
        padding: 0.375rem 0.75rem;
    }

    .hidden {
        display: none;
    }

    .form-step {
        display: none;
    }

    .form-step:first-of-type {
        display: block;
    }

    .modal-body {
        padding: 2rem;
    }

    .progress {
        height: 0.5rem;
    }

    .form-label {
        font-weight: 500;
    }

    .step-title {
        color: #0d6efd;
        margin-bottom: 1.5rem;
    }
</style>

<body>
    <?php
    include_once '../partials/navbar.php';
    include_once '../partials/sidebar.php';
    ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>
        <section class="section profile">
            <?php if ($responseData): ?>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <form action="process/uploadImage.php" method="post" enctype="multipart/form-data">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                    <div class="position-relative" style="cursor: pointer;">
                                        <input type="hidden" name="youth_id" value="<?= $youthId ?>">
                                        <input type="file" id="profileImageUpload" name="youthImage" style="display: none;"
                                            accept="image/*" onchange="handleImageUpload(this)">
                                        <div class="profile-image-container"
                                            onclick="document.getElementById('profileImageUpload').click()">
                                            <img src="<?php echo !empty($responseData['youth_image']) ? '../../uploads/img/' . htmlspecialchars($responseData['youth_image']) : ($responseData['sex'] == 'female' ? '../assets/img/female-avatar.gif' : '../assets/img/male-avatar.gif'); ?>"
                                                alt="user" id="profileImage" class="profile-photo-lg">
                                            <div class="image-overlay rounded-circle">
                                                <i class="bi bi-camera"></i>
                                                <div>Update Photo</div>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="text-center">
                                        <?= htmlspecialchars($responseData['firstname'] . ' ' . $responseData['middlename'] . ' ' . $responseData['lastname']) ?>
                                    </h2>
                                    <div class="social-links mt-2">
                                        <a href="#" class="facebook"><i class="bi bi-facebook"></i>
                                            <?= htmlspecialchars($responseData['fbname']) ?></a>
                                    </div>
                                    <button type="submit" id="saveButton"
                                        class="btn btn-primary btn-custom hidden w-100">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                        function handleImageUpload(input) {
                            previewImage(input);
                            document.getElementById('saveButton').classList.remove('hidden');
                        }

                        function previewImage(input) {
                            const reader = new FileReader();
                            reader.onload = function () {
                                const output = document.getElementById('profileImage');
                                output.src = reader.result;
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    </script>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body pt-3">
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn btn-primary me-2 btn-custom" data-bs-toggle="modal"
                                        data-bs-target="#updateModal">
                                        Update Details
                                    </button>
                                    <button type="button" class="btn btn-danger btn-custom"
                                        onclick="confirmDelete(<?= $youthId ?>)">
                                        Delete Profile
                                    </button>
                                </div>
                                <div class="card-header text-center mb-2">
                                    <h5>Youth Details</h5>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 survey-section">
                                        <h6 class="survey-section-title">Personal Information</h6>
                                        <div class="survey-item">
                                            <div class="survey-label">Full Name</div>
                                            <div class="survey-value">
                                                <?= htmlspecialchars($responseData['firstname'] . ' ' . $responseData['middlename'] . ' ' . $responseData['lastname']) ?>
                                            </div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Age</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['age']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Sex</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['sex']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Address</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['address']) ?>
                                            </div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Phone</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['phoneno']) ?>
                                            </div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Facebook Name</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['fbname']) ?></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 survey-section">
                                        <h6 class="survey-section-title">Demographic Information</h6>
                                        <div class="survey-item">
                                            <div class="survey-label">Barangay</div>
                                            <div class="survey-value">
                                                <?= htmlspecialchars($responseData['barangay_name']) ?>
                                            </div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Civil Status</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['civil_status']) ?>
                                            </div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Religion</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['religion']) ?>
                                            </div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Ethnicity</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['ethnicity']) ?>
                                            </div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Date of Birth</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['dob']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Place of Birth</div>
                                            <div class="survey-value">
                                                <?= htmlspecialchars($responseData['place_of_birth']) ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Classification -->
                                    <div class="col-md-6 survey-section">
                                        <h6 class="survey-section-title">Classification</h6>
                                        <div class="survey-item">
                                            <div class="survey-label">Age Classification</div>
                                            <div class="survey-value">
                                                <?= htmlspecialchars($responseData['age_classification']) ?>
                                            </div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Gender Preference</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['gender_pref']) ?>
                                            </div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Youth Classification</div>
                                            <div class="survey-value">
                                                <?= htmlspecialchars($responseData['youth_classification']) ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Education -->
                                    <div class="col-md-6 survey-section">
                                        <h6 class="survey-section-title">Education</h6>
                                        <div class="survey-item">
                                            <div class="survey-label">Highest Educational Attainment</div>
                                            <div class="survey-value">
                                                <?= htmlspecialchars($responseData['educational_attainment']) ?>
                                            </div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Technical/Vocational Course</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['tech_voc']) ?>
                                            </div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Currently Studying</div>
                                            <div class="survey-value">
                                                <?= htmlspecialchars($responseData['still_studying']) ?>
                                            </div>
                                        </div>
                                        <?php if ($responseData['still_studying'] == 'Yes'): ?>
                                            <div class="survey-item">
                                                <div class="survey-label">Current Grade Level</div>
                                                <div class="survey-value">
                                                    <?= htmlspecialchars($responseData['grade_level_if_studying']) ?>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="survey-item">
                                                <div class="survey-label">Reason for Not Studying</div>
                                                <div class="survey-value">
                                                    <?= htmlspecialchars($responseData['if_no_studying']) ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Additional Information -->
                                    <div class="col-md-6 survey-section">
                                        <h6 class="survey-section-title">Additional Information</h6>
                                        <div class="survey-item">
                                            <div class="survey-label">Any Disability</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['disability']) ?>
                                            </div>
                                        </div>
                                        <?php if ($responseData['disability'] == 'Yes'): ?>
                                            <div class="survey-item">
                                                <div class="survey-label">Disability Specification</div>
                                                <div class="survey-value">
                                                    <?= htmlspecialchars($responseData['disability_spec']) ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="survey-item">
                                            <div class="survey-label">Have Children</div>
                                            <div class="survey-value">
                                                <?= htmlspecialchars($responseData['have_any_child']) ?>
                                            </div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Registered Voter</div>
                                            <div class="survey-value">
                                                <?= htmlspecialchars($responseData['registered_voter']) ?>
                                            </div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Organization Involvement</div>
                                            <div class="survey-value">
                                                <?= htmlspecialchars($responseData['have_involvement']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p>No survey response data found for the selected youth.</p>
            <?php endif; ?>
        </section>
        <script>
            function confirmDelete(youthId) {
                if (confirm('Are you sure you want to delete this profile?')) {
                    window.location.href = 'deleteYouth.php?id=' + youthId;
                }
            }

        </script>
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Youth Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateForm" method="POST">
                            <input type="hidden" name="update_youth" value="1">

                            <!-- Progress bar -->
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20"
                                    aria-valuemin="0" aria-valuemax="100">Step 1 of 5</div>
                            </div>

                            <!-- Step 1: Personal Information -->
                            <div class="form-step">
                                <h4 class="mb-3">Personal Information</h4>
                                <!-- Your existing Step 1 fields here -->

                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 2: Demographic Information -->
                            <div class="form-step">
                                <h4 class="mb-3">Demographic Information</h4>
                                <!-- Your existing Step 2 fields here -->

                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 3: Classification -->
                            <div class="form-step">
                                <h4 class="mb-3">Classification</h4>
                                <!-- Your existing Step 3 fields here -->

                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 4: Education -->
                            <div class="form-step">
                                <h4 class="mb-3">Education</h4>
                                <!-- Your existing Step 4 fields here -->

                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 5: Additional Information -->
                            <div class="form-step">
                                <h4 class="mb-3">Additional Information</h4>
                                <!-- Your existing Step 5 fields here -->

                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .form-step {
                display: none;
            }

            .form-step:first-of-type {
                display: block;
            }

            .modal-body {
                padding: 2rem;
            }

            .progress {
                height: 0.5rem;
            }
        </style>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                let currentStep = 0;
                const formSteps = document.querySelectorAll(".form-step");
                const progressBar = document.querySelector(".progress-bar");

                function updateProgressBar(step) {
                    const progress = ((step + 1) / formSteps.length) * 100;
                    progressBar.style.width = progress + "%";
                    progressBar.textContent = `Step ${step + 1} of ${formSteps.length}`;
                }

                function showStep(step) {
                    formSteps.forEach((formStep, index) => {
                        formStep.style.display = index === step ? "block" : "none";
                    });
                    updateProgressBar(step);
                }

                function nextStep() {
                    if (currentStep < formSteps.length - 1) {
                        currentStep++;
                        showStep(currentStep);
                    }
                }

                function prevStep() {
                    if (currentStep > 0) {
                        currentStep--;
                        showStep(currentStep);
                    }
                }

                // Initialize first step
                showStep(currentStep);

                // Add event listeners for next and previous buttons
                document.querySelectorAll(".next-step").forEach(button => {
                    button.addEventListener("click", nextStep);
                });

                document.querySelectorAll(".prev-step").forEach(button => {
                    button.addEventListener("click", prevStep);
                });
            });
        </script>
    </main>


    <a href="#" class="btn btn-primary scroll-top"><i class="bi bi-arrow-up-short"></i></a>

    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>


</html>