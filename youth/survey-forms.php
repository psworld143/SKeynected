<?php
require_once 'core/surveyController.php';
$barangay = new surveyController();
$barangays = $barangay->getBarangay();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Youth Survey Form</title>
    <meta name="description" content="Modern sliding survey form with QR code generator">
    <meta name="keywords" content="survey, qr code, youth, modern">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="assets/css/global.css" rel="stylesheet">

    <style>
        body {
            background: url('assets/img/youth-cover.jfif') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .survey-container {
            max-width: 1000px;
            padding: 20px;
            border-radius: 15px;
            z-index: 1;
            margin-top: 50px;
        }

        .qr-placeholder {
            width: 200px;
            height: 200px;
            border: 2px dashed #ced4da;
        }

        .container {
            position: relative;
            z-index: 2;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(10px);
            z-index: -1;
        }

        #surveyForm {
            display: flex;
            overflow-x: hidden;
            scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
            /* height: 650px; */
        }

        .form-section {
            flex: 0 0 100%;
            scroll-snap-align: start;
            padding: 2rem;
            opacity: 0.3;
            transition: opacity 0.3s ease;
        }

        .form-section.active {
            opacity: 1;
        }

        .progress-bar {
            height: 5px;
            background-color: #007bff;
            width: 0;
            transition: width 0.3s ease;
        }

        input,
        select {
            border: none;
            border-bottom: 2px solid #007bff;
            border-radius: 0;
            padding: 10px 5px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        input:focus,
        select:focus {
            outline: none;
            box-shadow: none;
            border-color: #0056b3;
        }

        .btn-submit {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .next-btn,
        .prev-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .prev-btn {
            background-color: #6c757d;
            /* Grey color for the previous button */
        }

        .prev-btn:hover {
            background-color: #5a6268;
        }

        .custom-mt {
            margin-top: 40px;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100">
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">SKeynected</span>
            </a>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle" href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container survey-container">
        <div class="row g-0 bg-white rounded-3 shadow-lg overflow-hidden">
            <div class="col-12 p-0">
                <div class="progress-bar"></div>
                <form id="surveyForm" action="addSurvey.php" method="POST">
                    <div class="form-section active" id="section1">
                        <div class="row">
                            <h3>Personal Information</h3>
                            <div class="col-md-6">
                                <label for="lastname" class="form-label">Last name (Apilyedo)</label>
                                <input type="text" class="form-control" id="lastname" placeholder="Last name"
                                    name="lastname" required>
                                <label for="firstname" class="form-label">First name (Pangalan)</label>
                                <input type="text" class="form-control" id="firstname" placeholder="First name"
                                    name="firstname" required>
                                <label for="middlename" class="form-label">Middle name (Put N/A if not
                                    applicable)</label>
                                <input type="text" class="form-control" id="middlename" placeholder="Middle name"
                                    name="middlename" required>
                                <label for="suffix" class="form-label">Complete Address</label>
                                <textarea name="address" id="" class="form-control"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Sex</label>
                                <div class="d-flex mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="male" value="male"
                                            required>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="female"
                                            value="female" required>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="other" value="other"
                                            required>
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                                <label for="" class="form-label">Age</label>
                                <input type="text" name="age" id="" class="form-control" placeholder="Age" required>
                                <label for="" class="form-label">Barangay</label>
                                <select name="barangayId" id="barangayName" class="form-control" required>
                                    <?php foreach ($barangays as $barangay): ?>
                                        <option value="<?php echo $barangay['id']; ?>"><?php echo $barangay['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="" class="form-label">Date of Birth</label>
                                <input type="date" name="dob" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary next-btn">Next</button>
                        </div>
                    </div>

                    <div class="form-section" id="section2">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Member of Out of School Youth</label>
                                <select class="form-select" id="education" name="schoolYouth" required>
                                    <option value="yes">Yes</option>
                                    <option value="postgrad">No</option>
                                </select>

                                <label for="" class="form-label">Age Classification</label>
                                <div class="d-flex mt-2 mb-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ageClassification" id="male"
                                            value="male" required>
                                        <label class="form-check-label" for="male">CHILD YOUTH (15-17 YEARS OLD)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ageClassification"
                                            id="female" value="female" required>
                                        <label class="form-check-label" for="female">CORE YOUTH (18-24 YEARS
                                            OLD)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ageClassification" id="other"
                                            value="other" required>
                                        <label class="form-check-label" for="other">ADULT YOUTH (25-30 YEARS
                                            OLD)</label>
                                    </div>
                                </div>
                                <label for="" class="form-label">Civil Status</label>
                                <select name="civilStatus" id="civilStatus" class="form-control" required>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="widowed">Widowed</option>
                                    <option value="separated">Separated</option>
                                    <option value="divorced">Divorced</option>
                                </select>
                                <label for="" class="form-label">Cellphone Number (Put N/A if not applicable)</label>
                                <input type="number" name="phoneno" id="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="" class="form-label">Place Of Birth</label>
                                    <input type="text" name="placeOfBirth" id="" class="form-control" required>
                                </div>

                                <div class="mb-5">
                                    <label for="" class="form-label">Religion</label>
                                    <input type="text" name="religion" id="" class="form-control" required>
                                </div>
                                <label for="" class="form-label">Ethnicity</label>
                                <select name="ethnicity" id="" class="form-control">
                                    <option value="tagalog">Tagalog</option>
                                    <option value="bisaya">Bisaya</option>
                                    <option value="ilocano">Ilocano</option>
                                    <option value="bicolano">Bicolano</option>
                                    <option value="waray">Waray</option>
                                    <option value="pangasinense">Pangasinense</option>
                                    <option value="kapampangan">Kapampangan</option>
                                    <option value="maranao">Maranao</option>
                                    <option value="maguindanao">Maguindanao</option>
                                    <option value="tausug">Tausug</option>
                                    <option value="other">Others</option>
                                </select>

                                <label for="" class="form-label">Facebook name (Put N/A if not applicable)</label>
                                <input type="text" name="fbname" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                            <button type="button" class="btn btn-primary next-btn">Next</button>
                        </div>
                    </div>

                    <div class="form-section" id="section3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Youth Classification</label>
                                <select name="youthClassification" id="" class="form-control" required>
                                    <option value="in-school">In-School Youth</option>
                                    <option value="out-school">Out-of-School Youth</option>
                                    <option value="postgrad">Post-Graduate</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Gender Preference</label>
                                <select name="genderPref" id="genderPreference" class="form-control" required>
                                    <option value="girl">Girl</option>
                                    <option value="boy">Boy</option>
                                    <option value="other">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                            <button type="button" class="btn btn-primary next-btn">Next</button>
                        </div>
                    </div>

                    <div class="form-section" id="section4">
                        <div class="row">
                            <h3>Educational Background</h3>
                            <div class="col-md-6">
                                <label for="" class="form-label">Highest Educational Attainment (Grade Year
                                    Level)</label>
                                <select name="educationalAttainment" id="" class="form-control">
                                    <option value="pre-school">Pre-School</option>
                                    <option value="elementary">Elementary</option>
                                    <option value="7th-grade">7th Grade</option>
                                    <option value="high-school">High School</option>
                                    <option value="1st-year-college">1st Year College</option>
                                    <option value="2nd-year-college">2nd Year College</option>
                                    <option value="3rd-year-college">3rd Year College</option>
                                    <option value="4th-year-college">4th Year College</option>
                                    <option value="vocational">Vocational</option>
                                    <option value="bachelor-degree">Bachelor's Degree</option>
                                    <option value="master-degree">Master's Degree</option>
                                    <option value="doctoral-degree">Doctoral Degree</option>
                                </select>
                                <label for="" class="form-label">If Technical/Vocational, please specify. <br> (If none
                                    please put N/A)</label>
                                <input type="text" name="techVoc" id="" class="form-control">

                                <label for="" class="form-label">Still Studying?</label>
                                <select name="stillStudying" id="" class="form-control">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>

                                <label for="" class="form-label">If Yes, What Grade/Year Level If NO, please select
                                    N/A</label>
                                <select name="GradeLevelIfStudying" id="" class="form-control">
                                    <option value="N/A">N/A</option>
                                    <option value="grade-1">Grade 1</option>
                                    <option value="grade-2">Grade 2</option>
                                    <option value="grade-3">Grade 3</option>
                                    <option value="grade-4">Grade 4</option>
                                    <option value="grade-5">Grade 5</option>
                                    <option value="grade-6">Grade 6</option>
                                    <option value="1st-year-college">1st Year College</option>
                                    <option value="2nd-year-college">2nd Year College</option>
                                    <option value="3rd-year-college">3rd Year College</option>
                                    <option value="4th-year-college">4th Year College</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">If NO, Why Did You Stop Studying?</label>
                                <input type="text" name="ifNoStudying" id="" class="form-control">

                                <div style="margin-top: 45px;">
                                    <label for="" class="form-label">Do You Have Any Disability?</label>
                                    <input type="text" name="disability" id="" class="form-control">
                                </div>

                                <label for="" class="form-label">If Yes, Please Specify</label>
                                <input type="text" name="disabilitySpec" id="" class="form-control">

                                <label for="" class="form-label">have any child/children?</label>
                                <input type="text" name="haveAnyChild" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                            <button type="button" class="btn btn-primary next-btn">Next</button>
                        </div>
                    </div>

                    <div class="form-section" id="section5">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">a registered voter?</label>
                                <select name="registeredVoter" id="" class="form-control">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">have involvement from any organization?</label>
                                <select name="haveInvolvement" id="" class="form-control">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('surveyForm');
            const sections = document.querySelectorAll('.form-section');
            const nextBtns = document.querySelectorAll('.next-btn');
            const prevBtns = document.querySelectorAll('.prev-btn');
            const progressBar = document.querySelector('.progress-bar');
            const submitBtn = document.getElementById('submitBtn');
            let currentSection = parseInt(localStorage.getItem('currentSection')) || 0;

            // Restore input values from localStorage
            function restoreInputs() {
                for (let section of sections) {
                    const inputs = section.querySelectorAll('input, select, textarea');
                    inputs.forEach(input => {
                        if (input.type === 'radio' || input.type === 'checkbox') {
                            input.checked = localStorage.getItem(input.name) === input.value;
                        } else {
                            input.value = localStorage.getItem(input.name) || '';
                        }
                    });
                }
            }

            function saveInputs() {
                sections.forEach((section) => {
                    const inputs = section.querySelectorAll('input, select, textarea');
                    inputs.forEach(input => {
                        if (input.type === 'radio' || input.type === 'checkbox') {
                            if (input.checked) {
                                localStorage.setItem(input.name, input.value);
                            } else {
                                localStorage.removeItem(input.name);
                            }
                        } else {
                            localStorage.setItem(input.name, input.value);
                        }
                    });
                });
            }

            function updateProgress() {
                const progress = ((currentSection + 1) / sections.length) * 100;
                progressBar.style.width = `${progress}%`;
                submitBtn.style.display = (currentSection === sections.length - 1) ? 'block' : 'none';
            }

            function showSection(index) {
                sections.forEach((section, i) => {
                    section.classList.toggle('active', i === index);
                });
                form.scrollTo({
                    left: sections[index].offsetLeft,
                    behavior: 'smooth'
                });
                currentSection = index;
                updateProgress();
                localStorage.setItem('currentSection', currentSection);
                saveInputs();
            }

            nextBtns.forEach((btn) => {
                btn.addEventListener('click', function () {
                    if (currentSection < sections.length - 1) {
                        showSection(currentSection + 1);
                    }
                });
            });

            prevBtns.forEach((btn) => {
                btn.addEventListener('click', function () {
                    if (currentSection > 0) {
                        showSection(currentSection - 1);
                    }
                });
            });

            submitBtn.addEventListener('click', function () {
                form.submit();
            });

            restoreInputs();
            showSection(currentSection);
            updateProgress();
        });
    </script>


</body>

</html>