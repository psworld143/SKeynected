<?php

include_once '../../controllers/index.controllers.php';
$dashboardController = new IndexController();
$userId = 3;
$userData = $dashboardController->getUserById($userId);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK Chairman / Youth</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="icon" href="../assets/img/sk-logo.png">
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/vendor/quill/quill.snow.css">
    <link rel="stylesheet" href="../assets/vendor/quill/quill.bubble.css">
    <link rel="stylesheet" href="../assets/vendor/remixicon/remixicon.css">
    <link rel="stylesheet" href="../assets/vendor/simple-datatables/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
</head>

<body>
    <main id="main" class="main">
        <?php
        include '../inc/navbar.php';
        include '../inc/sidebar.php';
        ?>

        <div class="pagetitle">
            <h1>Manage Youth</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Youth</a></li>
                    <li class="breadcrumb-item active">Manage Youth</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">

                <div class="col-12 mb-3">
                    <h3 class="purok-youth-name">Purok Youth Name Here</h3>
                </div>
                <div class="form-container carousel">
                    <div class="form-progress-bar">
                        <div class="form-progress" id="formProgress"></div>
                    </div>

                    <!-- Step 1 -->
                    <div class="card active" id="step1">
                        <form class="form-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lname" class="form-label">Last name (Apilyedo)</label>
                                        <input type="text" id="lname" class="form-control" placeholder="Enter Last Name" req>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">First name (Pangalan)</label>
                                        <input type="text" id="fname" class="form-control" placeholder="Enter First Name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mname">Middle name (PUT N/A if not Applicable)</label>
                                        <input type="text" id="mname" class="form-control" placeholder="Enter Middle Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sex">Sex</label>
                                        <select name="sex" id="sex" class="form-select">
                                            <option value="female">Female</option>
                                            <option value="male">Male</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="brgy">Barangay</label>
                                        <select name="brgy" id="brgy" class="form-select">
                                            <option value="opt1">Option 1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Complete Address</label>
                                        <input type="text" id="address" class="form-control" placeholder="N/A">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <input type="text" id="age" class="form-control" placeholder="Enter Age">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender-pref">Gender Preference</label>
                                        <select name="gender-pref" id="gender-pref" class="form-select">
                                            <option value="opt1">Option 1</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ageclaf">Age Classification</label>
                                        <div class="nice-radio">
                                            <input type="radio" name="age_classification" id="minor" value="minor">
                                            <label for="minor">CHILD YOUTH (15-17 YEARS OLD)</label>
                                        </div>
                                        <div class="nice-radio">
                                            <input type="radio" name="age_classification" id="adult" value="adult">
                                            <label for="adult">CORE YOUTH (18-24 YEARS OLD)</label>
                                        </div>
                                        <div class="nice-radio">
                                            <input type="radio" name="age_classification" id="senior" value="senior">
                                            <label for="senior">ADULT YOUTH (25-30 YEARS OLD)</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="civstats">Civil Status</label>
                                        <div class="nice-radio">
                                            <input type="radio" name="civstats" id="single" value="single">
                                            <label for="single">Single</label>
                                        </div>
                                        <div class="nice-radio">
                                            <input type="radio" name="civstats" id="married" value="married">
                                            <label for="married">Married</label>
                                        </div>
                                        <div class="nice-radio">
                                            <input type="radio" name="civstats" id="in-rs" value="in-rs">
                                            <label for="in-rs">In a Relationship</label>
                                        </div>
                                        <div class="nice-radio">
                                            <input type="radio" name="civstats" id="widowed" value="widowed">
                                            <label for="widowed">Widowed</label>
                                        </div>
                                        <div class="nice-radio">
                                            <input type="radio" name="civstats" id="separated" value="separated">
                                            <label for="separated">Separated</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="card" id="step2">
                        <form class="form-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="memb">Member of Out of School Youth</label>
                                        <select name="memb" id="memb" class="form-select">
                                            <option value="opt1">option 1</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Phone Number</label>
                                        <input type="number" id="phoneno" class="form-control" placeholder="Enter Phone Number">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mname">Date of Birth</label>
                                        <input type="date" id="dob" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pob">Place of Birth</label>
                                        <select name="pob" id="pob" class="form-control">
                                            <option value="opt1">option 1</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ethnicity">Ethnicity</label>
                                        <select name="ethnicity" id="ethnicity" class="form-control">
                                            <option value="opt1">option 1</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Step 3 -->
                    <div class="card" id="step3">
                        <form class="form-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Facebook Name</label>
                                        <input type="text" id="fbname" class="form-control" placeholder="N/A">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="youth-claf">Youth Classification</label>
                                        <select name="youth-claf" id="youth-claf" class="form-select">
                                            <option value="opt1">option 1</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hea">Highest Educational Attainment (Grade/Year Level)</label>
                                        <select name="hea" id="hea" class="form-select">
                                            <option value="opt1">option 1</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tech-voc">If technical/vocational, please specify (If none please put N/A)</label>
                                        <select name="tech-voc" id="tech-voc" class="form-select">
                                            <option value="opt1">option 1</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tech-voc">Still Studying</label>
                                        <select name="tech-voc" id="tech-voc" class="form-select">
                                            <option value="opt1">option 1</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tech-voc">If YES, what grade/year level. If NO, please select "N/A"</label>
                                        <select name="tech-voc" id="tech-voc" class="form-select">
                                            <option value="opt1">option 1</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tech-voc">Do you have any disability?</label>
                                        <select name="tech-voc" id="tech-voc" class="form-select">
                                            <option value="opt1">option 1</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tech-voc">If YES, please Specify. If NONE, please select "N/A"</label>
                                        <select name="tech-voc" id="tech-voc" class="form-select">
                                            <option value="opt1">option 1</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tech-voc">have any child/children?</label>
                                            <select name="tech-voc" id="tech-voc" class="form-select">
                                                <option value="opt1">option 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="civstats">A registered voter?</label>
                                            <div class="nice-radio">
                                                <input type="radio" name="civstats" id="single" value="single">
                                                <label for="single">Yes</label>
                                            </div>
                                            <div class="nice-radio">
                                                <input type="radio" name="civstats" id="married" value="married">
                                                <label for="married">No</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="civstats">have any involvement from any organization?</label>
                                            <div class="nice-radio">
                                                <input type="radio" name="civstats" id="single" value="single">
                                                <label for="single">Yes</label>
                                            </div>
                                            <div class="nice-radio">
                                                <input type="radio" name="civstats" id="married" value="married">
                                                <label for="married">No</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <ul data-carousel-dots>
                        <li data-carousel-dot data-active></li>
                        <li data-carousel-dot dot-2></li>
                        <li data-carousel-dot dot-3></li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <script src="../assets/js/prog.js"></script>
    <script>
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                navLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            });
        });
    </script>
</body>

</html>
</body>

</html>