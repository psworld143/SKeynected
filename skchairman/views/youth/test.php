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
    <link rel="stylesheet" href="../assets/css/forms.css">
    <style>
        .form-container {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .form-1, .form-2, .form-3 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
        }

        .form-1.active, .form-2.active, .form-3.active {
            display: block;
        }

        .next-btn {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .prev-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
        }
    </style>
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
            <div class="container">
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add Youth</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-container">
                                <form class="form-1 active">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lname">Last name (Apilyedo)</label>
                                                <input type="text" id="lname" class="form-control" placeholder="Enter Last Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">First name (Pangalan)</label>
                                                <input type="email" id="youth_email" class="form-control" placeholder="Enter First name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mname">Middle name (PUT N/A if not Applicable)</label>
                                                <input type="tel" id="youth_phone" class="form-control" placeholder="Enter Middle name">
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
                                                <label for="birthdate">Birthdate</label>
                                                <input type="date" id="birthdate" class="form-control" placeholder="Enter Birthdate">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="age">Age</label>
                                                <input type="number" id="age" class="form-control" placeholder="Enter Age">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" id="address" class="form-control" placeholder="Enter Address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contact">Contact Number</label>
                                                <input type="tel" id="contact" class="form-control" placeholder="Enter Contact Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" class="form-control" placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" id="password" class="form-control" placeholder="Enter Password">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary next-btn">Next</button>
                                </form>
                                <form class="form-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="father_name">Father's Name</label>
                                                <input type="text" id="father_name" class="form-control" placeholder="Enter Father's Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mother_name">Mother's Name</label>
                                                <input type="text" id="mother_name" class="form-control" placeholder="Enter Mother's Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="father_occupation">Father's Occupation</label>
                                                <input type="text" id="father_occupation" class="form-control" placeholder="Enter Father's Occupation">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mother_occupation">Mother's Occupation</label>
                                                <input type="text" id="mother_occupation" class="form-control" placeholder="Enter Mother's Occupation">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary prev-btn">Previous</button>
                                    <button type="button" class="btn btn-primary next-btn">Next</button>
                                </form>
                                <form class="form-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="school">School</label>
                                                <input type="text" id="school" class="form-control" placeholder="Enter School">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="course">Course</label>
                                                <input type="text" id="course" class="form-control" placeholder="Enter Course">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="year">Year</label>
                                                <input type="number" id="year" class="form-control" placeholder="Enter Year">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="semester">Semester</label>
                                                <input type="text" id="semester" class="form-control" placeholder="Enter Semester">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn -primary prev-btn">Previous</button>
                                    <button type="button" class="btn btn-primary submit-btn">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="../assets/js/index.js">
        
    </script>
</body>

</html>