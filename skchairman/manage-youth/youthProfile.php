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
                        <form id="updateForm" method="POST" action="./process/updateYouth.php">
                            <!-- <input type="hidden" name="update_youth" value="1"> -->
                            <input type="hidden" name="youth_id" value="<?= $youthId ?>">
                            <!-- Progress bar -->
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20"
                                    aria-valuemin="0" aria-valuemax="100">Step 1 of 5</div>
                            </div>

                            <!-- Step 1: Personal Information -->
                            <div class="form-step">
                                <h4 class="mb-3">Personal Information</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstname" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname"
                                            value="<?= htmlspecialchars($responseData['firstname']) ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="middlename" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middlename" name="middlename"
                                            value="<?= htmlspecialchars($responseData['middlename']) ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastname" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname"
                                            value="<?= htmlspecialchars($responseData['lastname']) ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="age" class="form-label">Age</label>
                                        <input type="number" class="form-control" id="age" name="age"
                                            value="<?= htmlspecialchars($responseData['age']) ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="sex" class="form-label">Sex</label>
                                        <select class="form-control" id="sex" name="sex" required>
                                            <option value="male" <?= $responseData['sex'] == 'male' ? 'selected' : '' ?>>
                                                Male</option>
                                            <option value="female" <?= $responseData['sex'] == 'female' ? 'selected' : '' ?>>Female</option>
                                            <option value="others" <?= $responseData['sex'] == 'others' ? 'selected' : '' ?>>Others</option>
                                        </select>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="<?= htmlspecialchars($responseData['address']) ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phoneno" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phoneno" name="phoneno"
                                            value="<?= htmlspecialchars($responseData['phoneno']) ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="fbname" class="form-label">Facebook Name</label>
                                        <input type="text" class="form-control" id="fbname" name="fbname"
                                            value="<?= htmlspecialchars($responseData['fbname']) ?>">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 2: Demographic Information -->
                            <div class="form-step">
                                <h4 class="mb-3">Demographic Information</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="barangay_name" class="form-label">Barangay</label>
                                        <input type="text" class="form-control" id="barangay_name" name="barangay_name"
                                            value="<?= htmlspecialchars($responseData['barangay_id']) ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="civil_status" class="form-label">Civil Status</label>
                                        <select name="civilStatus" id="civilStatus" class="form-control" required>
                                            <option value="single" <?= $responseData['civil_status'] == 'single' ? 'selected' : '' ?>>Single</option>
                                            <option value="married" <?= $responseData['civil_status'] == 'married' ? 'selected' : '' ?>>Married</option>
                                            <option value="widowed" <?= $responseData['civil_status'] == 'widowed' ? 'selected' : '' ?>>Widowed</option>
                                            <option value="separated" <?= $responseData['civil_status'] == 'separated' ? 'selected' : '' ?>>Separated</option>
                                            <option value="divorced" <?= $responseData['civil_status'] == 'divorced' ? 'selected' : '' ?>>Divorced</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="religion" class="form-label">Religion</label>
                                        <input type="text" class="form-control" id="religion" name="religion"
                                            value="<?= htmlspecialchars($responseData['religion']) ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="ethnicity" class="form-label">Ethnicity</label>
                                        <select class="form-control" id="ethnicity" name="ethnicity" required>
                                            <option value="tagalog" <?= $responseData['ethnicity'] == 'tagalog' ? 'selected' : '' ?>>Tagalog</option>
                                            <option value="bisaya" <?= $responseData['ethnicity'] == 'bisaya' ? 'selected' : '' ?>>Bisaya</option>
                                            <option value="ilocano" <?= $responseData['ethnicity'] == 'ilocano' ? 'selected' : '' ?>>Ilocano</option>
                                            <option value="bicolano" <?= $responseData['ethnicity'] == 'bicolano' ? 'selected' : '' ?>>Bicolano</option>
                                            <option value="waray" <?= $responseData['ethnicity'] == 'waray' ? 'selected' : '' ?>>Waray</option>
                                            <option value="pangasinense" <?= $responseData['ethnicity'] == 'pangasinense' ? 'selected' : '' ?>>Pangasinense</option>
                                            <option value="kapampangan" <?= $responseData['ethnicity'] == 'kapampangan' ? 'selected' : '' ?>>Kapampangan</option>
                                            <option value="maranao" <?= $responseData['ethnicity'] == 'maranao' ? 'selected' : '' ?>>Maranao</option>
                                            <option value="maguindanao" <?= $responseData['ethnicity'] == 'maguindanao' ? 'selected' : '' ?>>Maguindanao</option>
                                            <option value="tausug" <?= $responseData['ethnicity'] == 'tausug' ? 'selected' : '' ?>>Tausug</option>
                                            <option value="other" <?= $responseData['ethnicity'] == 'other' ? 'selected' : '' ?>>Others</option>
                                        </select>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            value="<?= htmlspecialchars($responseData['dob']) ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="place_of_birth" class="form-label">Place of Birth</label>
                                        <input type="text" class="form-control" id="place_of_birth"
                                            name="place_of_birth"
                                            value="<?= htmlspecialchars($responseData['place_of_birth']) ?>" required>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-secondary prev-step me-2">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 3: Classification -->
                            <div class="form-step">
                                <h4 class="mb-3">Classification</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="age_classification" class="form-label">Age Classification</label>
                                        <select class="form-control" id="age_classification" name="age_classification"
                                            required>
                                            <option value="CHILD YOUTH (15-17 YEARS OLD)"
                                                <?= $responseData['age_classification'] == 'CHILD YOUTH (15-17 YEARS OLD)' ? 'selected' : '' ?>>CHILD YOUTH (15-17 YEARS OLD)</option>
                                            <option value="CORE YOUTH (18-24 YEARS OLD)"
                                                <?= $responseData['age_classification'] == 'CORE YOUTH (18-24 YEARS OLD)' ? 'selected' : '' ?>>CORE YOUTH (18-24 YEARS OLD)</option>
                                            <option value="ADULT YOUTH (25-30 YEARS OLD)"
                                                <?= $responseData['age_classification'] == 'ADULT YOUTH (25-30 YEARS OLD)' ? 'selected' : '' ?>>ADULT YOUTH (25-30 YEARS OLD)</option>
                                        </select>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="gender_pref" class="form-label">Gender Preference</label>
                                        <select class="form-control" id="gender_pref" name="gender_pref" required>
                                            <option value="boy" <?= $responseData['gender_pref'] == 'boy' ? 'selected' : '' ?>>Boy</option>
                                            <option value="girl" <?= $responseData['gender_pref'] == 'girl' ? 'selected' : '' ?>>Girl</option>
                                            <option value="others" <?= $responseData['gender_pref'] == 'others' ? 'selected' : '' ?>>Others</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="youth_classification" class="form-label">Youth
                                            Classification</label>
                                        <select class="form-control" id="youth_classification"
                                            name="youth_classification" required>
                                            <option value="in-school"
                                                <?= $responseData['youth_classification'] == 'in-school' ? 'selected' : '' ?>>In-School Youth</option>
                                            <option value="out-school"
                                                <?= $responseData['youth_classification'] == 'out-school' ? 'selected' : '' ?>>Out-of-School Youth</option>
                                            <option value="postgrad"
                                                <?= $responseData['youth_classification'] == 'postgrad' ? 'selected' : '' ?>>Post-Graduate</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-secondary prev-step me-2">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 4: Education -->
                            <div class="form-step">
                                <h4 class="mb-3">Education</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="educational_attainment" class="form-label">Highest Educational
                                            Attainment</label>
                                        <select class="form-control" id="educational_attainment"
                                            name="educational_attainment" required onchange="toggleVocationalField()">
                                            <option value="pre-school"
                                                <?= $responseData['educational_attainment'] == 'pre-school' ? 'selected' : '' ?>>Pre-School</option>
                                            <option value="elementary"
                                                <?= $responseData['educational_attainment'] == 'elementary' ? 'selected' : '' ?>>Elementary</option>
                                            <option value="7th-grade"
                                                <?= $responseData['educational_attainment'] == '7th-grade' ? 'selected' : '' ?>>7th Grade</option>
                                            <option value="high-school"
                                                <?= $responseData['educational_attainment'] == 'high-school' ? 'selected' : '' ?>>High School</option>
                                            <option value="1st-year-college"
                                                <?= $responseData['educational_attainment'] == '1st-year-college' ? 'selected' : '' ?>>1st Year College</option>
                                            <option value="2nd-year-college"
                                                <?= $responseData['educational_attainment'] == '2nd-year-college' ? 'selected' : '' ?>>2nd Year College</option>
                                            <option value="3rd-year-college"
                                                <?= $responseData['educational_attainment'] == '3rd-year-college' ? 'selected' : '' ?>>3rd Year College</option>
                                            <option value="4th-year-college"
                                                <?= $responseData['educational_attainment'] == '4th-year-college' ? 'selected' : '' ?>>4th Year College</option>
                                            <option value="vocational"
                                                <?= $responseData['educational_attainment'] == 'vocational' ? 'selected' : '' ?>>Vocational</option>
                                            <option value="bachelor-degree"
                                                <?= $responseData['educational_attainment'] == 'bachelor-degree' ? 'selected' : '' ?>>Bachelor's Degree</option>
                                            <option value="master-degree"
                                                <?= $responseData['educational_attainment'] == 'master-degree' ? 'selected' : '' ?>>Master's Degree</option>
                                            <option value="doctoral-degree"
                                                <?= $responseData['educational_attainment'] == 'doctoral-degree' ? 'selected' : '' ?>>Doctoral Degree</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3" id="tech_voc_container"
                                        style="display: <?= $responseData['educational_attainment'] == 'vocational' ? 'block' : 'none' ?>;">
                                        <label for="techVoc" class="form-label">If Technical/Vocational, please specify.
                                            <br>(If none please put N/A)</label>
                                        <input type="text" class="form-control" id="techVoc" name="tech_voc"
                                            value="<?= htmlspecialchars($responseData['tech_voc'] ?? 'N/A') ?>"
                                            placeholder="Technical/Vocational">
                                    </div>
                                    <script>
                                        function toggleVocationalField() {
                                            var educationalAttainmentSelect = document.getElementById('educational_attainment');
                                            var techVocContainer = document.getElementById('tech_voc_container');
                                            if (educationalAttainmentSelect.value === 'vocational') {
                                                techVocContainer.style.display = 'block';
                                            } else {
                                                techVocContainer.style.display = 'none';
                                            }
                                        }
                                    </script>

                                    <div class="col-md-6 mb-3">
                                        <label for="still_studying" class="form-label">Currently Studying</label>
                                        <select class="form-control" id="still_studying" name="still_studying" required
                                            onchange="toggleStudyingFields()">
                                            <option value="yes" <?= $responseData['still_studying'] == 'yes' ? 'selected' : '' ?>>Yes</option>
                                            <option value="no" <?= $responseData['still_studying'] == 'no' ? 'selected' : '' ?>>No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3" id="reason_not_studying_container"
                                        style="display: <?= $responseData['still_studying'] == 'no' ? 'block' : 'none' ?>;">
                                        <label for="if_no_studying" class="form-label">Reason for Not Studying</label>
                                        <input type="text" class="form-control" id="if_no_studying"
                                            name="if_no_studying"
                                            value="<?= htmlspecialchars($responseData['if_no_studying'] ?? 'N/A') ?>">
                                    </div>
                                    <div class="col-md-6 mb-3" id="grade_level_container"
                                        style="display: <?= $responseData['still_studying'] == 'yes' ? 'block' : 'none' ?>;">
                                        <label for="GradeLevelIfStudying" class="form-label">If Yes, What Grade/Year
                                            Level If NO, please select N/A</label>
                                        <select name="GradeLevelIfStudying" id="GradeLevelIfStudying"
                                            class="form-control" placeholder="Grade/Year Level">
                                            <option value="N/A" <?= $responseData['grade_level_if_studying'] == 'N/A' ? 'selected' : '' ?>>N/A</option>
                                            <option value="grade-1"
                                                <?= $responseData['grade_level_if_studying'] == 'grade-1' ? 'selected' : '' ?>>Grade 1</option>
                                            <option value="grade-2"
                                                <?= $responseData['grade_level_if_studying'] == 'grade-2' ? 'selected' : '' ?>>Grade 2</option>
                                            <option value="grade-3"
                                                <?= $responseData['grade_level_if_studying'] == 'grade-3' ? 'selected' : '' ?>>Grade 3</option>
                                            <option value="grade-4"
                                                <?= $responseData['grade_level_if_studying'] == 'grade-4' ? 'selected' : '' ?>>Grade 4</option>
                                            <option value="grade-5"
                                                <?= $responseData['grade_level_if_studying'] == 'grade-5' ? 'selected' : '' ?>>Grade 5</option>
                                            <option value="grade-6"
                                                <?= $responseData['grade_level_if_studying'] == 'grade-6' ? 'selected' : '' ?>>Grade 6</option>
                                            <option value="1st-year-college"
                                                <?= $responseData['grade_level_if_studying'] == '1st-year-college' ? 'selected' : '' ?>>1st Year College</option>
                                            <option value="2nd-year-college"
                                                <?= $responseData['grade_level_if_studying'] == '2nd-year-college' ? 'selected' : '' ?>>2nd Year College</option>
                                            <option value="3rd-year-college"
                                                <?= $responseData['grade_level_if_studying'] == '3rd-year-college' ? 'selected' : '' ?>>3rd Year College</option>
                                            <option value="4th-year-college"
                                                <?= $responseData['grade_level_if_studying'] == '4th-year-college' ? 'selected' : '' ?>>4th Year College</option>
                                        </select>
                                    </div>

                                    <script>
                                        function toggleStudyingFields() {
                                            var stillStudyingSelect = document.getElementById('still_studying');
                                            var gradeLevelContainer = document.getElementById('grade_level_container');
                                            var reasonNotStudyingContainer = document.getElementById('reason_not_studying_container');
                                            if (stillStudyingSelect.value === 'yes') {
                                                gradeLevelContainer.style.display = 'block';
                                                reasonNotStudyingContainer.style.display = 'none';
                                            } else {
                                                gradeLevelContainer.style.display = 'none';
                                                reasonNotStudyingContainer.style.display = 'block';
                                            }
                                        }
                                    </script>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-secondary prev-step me-2">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 5: Additional Information -->
                            <div class="form-step">
                                <h4 class="mb-3">Additional Information</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="disability" class="form-label">Any Disability</label>
                                        <select class="form-control" id="disability" name="disability" required
                                            onchange="toggleDisabilitySpec()">
                                            <option value="N/A" <?= $responseData['disability'] == 'N/A' ? 'selected' : '' ?>>N/A</option>
                                            <option value="yes" <?= $responseData['disability'] == 'yes' ? 'selected' : '' ?>>Yes</option>
                                            <option value="no" <?= $responseData['disability'] == 'no' ? 'selected' : '' ?>>No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3" id="disability_spec_container"
                                        style="display: <?= $responseData['disability'] == 'yes' ? 'block' : 'none' ?>;">
                                        <label for="disability_spec" class="form-label">If Yes, Please Specify the
                                            Disability</label>
                                        <input type="text" class="form-control" id="disability_spec"
                                            name="disability_spec"
                                            value="<?= htmlspecialchars($responseData['disability_spec'] ?? 'N/A') ?>">
                                    </div>

                                    <script>
                                        function toggleDisabilitySpec() {
                                            var disabilitySelect = document.getElementById('disability');
                                            var disabilitySpecContainer = document.getElementById('disability_spec_container');
                                            if (disabilitySelect.value === 'yes') {
                                                disabilitySpecContainer.style.display = 'block';
                                            } else {
                                                disabilitySpecContainer.style.display = 'none';
                                            }
                                        }
                                    </script>
                                    <div class="col-md-6 mb-3">
                                        <label for="have_any_child" class="form-label">Have Children</label>
                                        <select class="form-control" id="have_any_child" name="have_any_child" required>
                                            <option value="Yes" <?= $responseData['have_any_child'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
                                            <option value="No" <?= $responseData['have_any_child'] == 'No' ? 'selected' : '' ?>>No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="registered_voter" class="form-label">Registered Voter</label>
                                        <select class="form-control" id="registered_voter" name="registered_voter"
                                            required>
                                            <option value="Yes" <?= $responseData['registered_voter'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
                                            <option value="No" <?= $responseData['registered_voter'] == 'No' ? 'selected' : '' ?>>No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="have_involvement" class="form-label">Organization
                                            Involvement</label>
                                        <input type="text" class="form-control" id="have_involvement"
                                            name="have_involvement"
                                            value="<?= htmlspecialchars($responseData['have_involvement']) ?>" required>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-secondary prev-step me-2">Previous</button>
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