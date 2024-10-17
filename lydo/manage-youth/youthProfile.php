<?php
require_once '../core/userController.php';
require_once '../core/youthController.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: index.php');
    exit();
}


$youthController = new youthController();

$youthId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

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
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <img src="../assets/img/profile.png" alt="Profile" class="rounded-circle">
                                <h2><?= htmlspecialchars($responseData['firstname'] . ' ' . $responseData['middlename'] . ' ' . $responseData['lastname']) ?></h2>
                                <h3>Barangay <?= htmlspecialchars($responseData['barangay_name']) ?> Youth</h3>
                                <div class="social-links mt-2">
                                    <a href="#" class="facebook"><i class="bi bi-facebook"></i> <?= htmlspecialchars($responseData['fbname']) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">

                        <div class="card">

                            <div class="card-body pt-3">
                                <div class="flex-end">
                                    <button type="button" class="btn btn-primary btn-update" data-bs-toggle="modal" data-bs-target="#updateModal">
                                        Update Details
                                    </button>
                                </div>
                                <h5 class="card-title">Youth Details</h5>
                                <div class="row">
                                    <div class="col-md-6 survey-section">
                                        <h6 class="survey-section-title">Personal Information</h6>
                                        <div class="survey-item">
                                            <div class="survey-label">Full Name</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['firstname'] . ' ' . $responseData['middlename'] . ' ' . $responseData['lastname']) ?></div>
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
                                            <div class="survey-value"><?= htmlspecialchars($responseData['address']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Phone</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['phoneno']) ?></div>
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
                                            <div class="survey-value"><?= htmlspecialchars($responseData['barangay_name']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Civil Status</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['civil_status']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Religion</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['religion']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Ethnicity</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['ethnicity']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Date of Birth</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['dob']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Place of Birth</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['place_of_birth']) ?></div>
                                        </div>
                                    </div>

                                    <!-- Classification -->
                                    <div class="col-md-6 survey-section">
                                        <h6 class="survey-section-title">Classification</h6>
                                        <div class="survey-item">
                                            <div class="survey-label">Age Classification</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['age_classification']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Gender Preference</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['gender_pref']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Youth Classification</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['youth_classification']) ?></div>
                                        </div>
                                    </div>

                                    <!-- Education -->
                                    <div class="col-md-6 survey-section">
                                        <h6 class="survey-section-title">Education</h6>
                                        <div class="survey-item">
                                            <div class="survey-label">Highest Educational Attainment</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['educational_attainment']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Technical/Vocational Course</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['tech_voc']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Currently Studying</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['still_studying']) ?></div>
                                        </div>
                                        <?php if ($responseData['still_studying'] == 'Yes'): ?>
                                            <div class="survey-item">
                                                <div class="survey-label">Current Grade Level</div>
                                                <div class="survey-value"><?= htmlspecialchars($responseData['grade_level_if_studying']) ?></div>
                                            </div>
                                        <?php else: ?>
                                            <div class="survey-item">
                                                <div class="survey-label">Reason for Not Studying</div>
                                                <div class="survey-value"><?= htmlspecialchars($responseData['if_no_studying']) ?></div>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Additional Information -->
                                    <div class="col-md-6 survey-section">
                                        <h6 class="survey-section-title">Additional Information</h6>
                                        <div class="survey-item">
                                            <div class="survey-label">Any Disability</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['disability']) ?></div>
                                        </div>
                                        <?php if ($responseData['disability'] == 'Yes'): ?>
                                            <div class="survey-item">
                                                <div class="survey-label">Disability Specification</div>
                                                <div class="survey-value"><?= htmlspecialchars($responseData['disability_spec']) ?></div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="survey-item">
                                            <div class="survey-label">Have Children</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['have_any_child']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Registered Voter</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['registered_voter']) ?></div>
                                        </div>
                                        <div class="survey-item">
                                            <div class="survey-label">Organization Involvement</div>
                                            <div class="survey-value"><?= htmlspecialchars($responseData['have_involvement']) ?></div>
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
                            <!-- Personal Information -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?= htmlspecialchars($responseData['firstname']) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="middlename" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename" value="<?= htmlspecialchars($responseData['middlename']) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?= htmlspecialchars($responseData['lastname']) ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" class="form-control" id="age" name="age" value="<?= htmlspecialchars($responseData['age']) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="sex" class="form-label">Sex</label>
                                    <select class="form-select" id="sex" name="sex">
                                        <option value="Male" <?= $responseData['sex'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                        <option value="Female" <?= $responseData['sex'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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