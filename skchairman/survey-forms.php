<?php
require_once 'core/youthController.php';
$youth = new youthController();
$barangays = $youth->getBarangay();
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
                <form id="surveyForm">
                    <div class="form-section active" id="section1">
                        <h3>Personal Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="lastname" class="form-label">Last name (Apilyedo)</label>
                                <input type="text" class="form-control" id="lastname" placeholder="Last name" name="lastname" required>
                                <label for="firstname" class="form-label">First name (Pangalan)</label>
                                <input type="text" class="form-control" id="firstname" placeholder="First name" name="firstname" required>
                                <label for="middlename" class="form-label">Middle name (Put N/A if not applicable)</label>
                                <input type="text" class="form-control" id="middlename" placeholder="Middle name" name="middlename" required>
                                <label for="suffix" class="form-label">Complete Address</label>
                                <textarea name="address" id="" class="form-control"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Sex</label>
                                <div class="d-flex mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="male" value="male" required>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="female" value="female" required>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="other" value="other" required>
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                                <label for="" class="form-label">Age</label>
                                <input type="text" name="age" id="" class="form-control" placeholder="Age" required>
                                <label for="" class="form-label">Barangay</label>
                                <select name="" id="barangayName" class="form-control" required>
                                    <?php foreach ($barangays as $barangay): ?>
                                        <option value="<?php echo $barangay['name']; ?>"><?php echo $barangay['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <label for="" class="form-label">Gender Preference</label>
                                <select name="genderPref" id="genderPreference" class="form-control" required>
                                    <option value="girl">Girl</option>
                                    <option value="boy">Boy</option>
                                    <option value="other">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <button type="button" class="btn btn-submit next-btn">Next</button>
                        </div>
                    </div>

                    <div class="form-section" id="section2">
                        <h3>Educational Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-select" id="education" required>
                                    <option value="">Highest Educational Attainment</option>
                                    <option value="elementary">Elementary</option>
                                    <option value="highschool">High School</option>
                                    <option value="college">College</option>
                                    <option value="postgrad">Post Graduate</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <button type="button" class="btn btn-submit prev-btn">Previous</button>
                            <button type="button" class="btn btn-submit next-btn">Next</button>
                        </div>
                    </div>

                    <div class="form-section" id="section3">
                        <h3>Community Engagement</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="communityInvolvement" class="form-label">Are you involved in any community service or organization?</label>
                                <textarea name="communityInvolvement" id="communityInvolvement" class="form-control" placeholder="Describe your involvement..." required></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <button type="button" class="btn btn-submit prev-btn">Previous</button>
                            <button type="submit" class="btn btn-submit">Submit</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('surveyForm');
            const sections = document.querySelectorAll('.form-section');
            const nextBtns = document.querySelectorAll('.next-btn');
            const prevBtns = document.querySelectorAll('.prev-btn');
            const progressBar = document.querySelector('.progress-bar');
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

            // Save input values to localStorage
            function saveInputs() {
                sections.forEach((section, index) => {
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
                localStorage.setItem('currentSection', currentSection); // Save current section
                saveInputs(); // Save inputs whenever a section is shown
            }

            // Handle "Next" button
            nextBtns.forEach((btn) => {
                btn.addEventListener('click', function() {
                    if (currentSection < sections.length - 1) {
                        showSection(currentSection + 1);
                    }
                });
            });

            // Handle "Previous" button
            prevBtns.forEach((btn) => {
                btn.addEventListener('click', function() {
                    if (currentSection > 0) {
                        showSection(currentSection - 1);
                    }
                });
            });

            // Restore inputs and show the current section
            restoreInputs();
            showSection(currentSection);
            // Update progress on load
            updateProgress();
        });
    </script>
</body>

</html>