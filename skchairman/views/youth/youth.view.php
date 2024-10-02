<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purok Youths</title>
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
    <style>
        .purok-card {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);

            transition: all 0.3s ease;
            position: relative;
            background-color: #fff;
        }

        .purok-body {
            padding: 20px;
            margin-bottom: 20px;
        }

        .purok-card:hover {
            transform: translateY(-3px);
        }

        .purok-header {
            text-align: center;
            margin-bottom: 15px;
        }

        .purok-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .purok-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
            text-align: center;
        }

        .btn-add-youth {
            display: block;
            width: fit-content;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            text-align: center;
            font-size: 10px;
            margin: 50px auto;
            position: relative;
        }

        .btn-add-youth::after {
            content: '';
            display: block;
            width: 100%;
            height: 2px;
            background-color: white;
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
        }

        .btn-add-youth:hover {
            background-color: #0056b3;
        }

        .youths-count {
            font-size: 1rem;
            color: #666;
            position: absolute;
            bottom: 20px;
            left: 20px;
            margin: 0;
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
            <h1>Purok Youths</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Purok Youths</li>
                </ol>
            </nav>
        </div>

        <!-- Purok Card Section -->
        <section class="section">
            <div class="row">
                <!-- Example Purok Card -->
                <div class="col-lg-4">
                    <div class="purok-card">
                        <div class="purok-image">
                            <img src="../../assets/img/test.jpg" alt="Purok 1" class="purok-image">
                        </div>

                        <div class="purok-body">
                            <div class="purok-title">Purok 1 Youths</div>
                            <div class="purok-address">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>Barangay 1, City of San Fernando, La Union</span>
                            </div>
                            <a href="add-youth.php?purok=1" class="btn-add-youth">Add Youth Details</a>
                        </div>
                        <div class="youths-count">
                            <i class="bi bi-person-fill"></i>
                            <span>50</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>