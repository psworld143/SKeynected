<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SKEYNECTED</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="" rel="icon">
    <link href="" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>


    <main id="main" class="main">
        <?php
      include 'inc/navbar.php';
      include 'inc/sidebar.php';
    ?>

        <div class="pagetitle">
            <h1>User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add User</h5>
                            <form class="row g-3" action="backend/add-user.php" method="POST">
                                <div class="col-md-12">
                                    <select class="form-select" name="account_type" id="account_type" required>
                                        <option selected disabled value="">Choose Account Type</option>
                                        <option value="admin">Admin</option>
                                        <option value="skchairman">Sk Chairman</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="firstname" id="firstname"
                                        placeholder="Firstname" required>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="middlename" id="middlename"
                                        placeholder="Middlename" required>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="lastname" id="lastname"
                                        placeholder="Lastname" required>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Username" required>
                                </div>
                                <div class="button">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">List of User</h5>
                            </div>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Account Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        require('backend/dbcon.php'); // Include your database connection file

                                        // Query to fetch user data
                                        $query = "SELECT firstname, middlename, lastname, username, email, account_type FROM users";
                                        $result = mysqli_query($con, $query);

                                        if ($result) {
                                            // Loop through each row of the result set
                                            while ($user = mysqli_fetch_assoc($result)) {
                                                // Concatenate first, middle, and last names for display
                                                $fullName = $user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname'];
                                                echo "<tr>
                                                        <td>$fullName</td>
                                                        <td>{$user['username']}</td>
                                                        <td>{$user['email']}</td>
                                                        <td>{$user['account_type']}</td>
                                                        <td>
                                                            <button type='button' class='btn s btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#viewstudent'>Update</button>
                                                            <button type='button' class='btn s btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#updatesof'>Delete</button>
                                                        </td>
                                                    </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center'>No users found</td></tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>