<?php
require_once '../core/userController.php';
require_once '../core/projectController.php';
require_once '../core/youthController.php';
include_once '../core/sessionController.php';
(new sessionController())->checkLogin();

$barangay_id = $_SESSION['barangay_id'] ?? null;
$barangay = (new youthController())->getYouthCountByBarangay($barangay_id);
$success = '';
$error = '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Manage Youth</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="../assets/img/SK-logo.png" rel="icon">
    <link href="../assets/img/SK-logo.png" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: #1916a3;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
        }

        .card-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card-stats {
            display: flex;
            justify-content: space-around;
            padding: 15px 0;
            background-color: #f7f8fa;
        }

        .stat {
            text-align: center;
        }

        .stat-label {
            font-size: 12px;
            color: #adb8c2;
            font-weight: 700;
            text-transform: uppercase;
        }

        .stat-value {
            font-size: 16px;
            color: #59687f;
            font-weight: 600;
        }

        .button-group {
            display: flex;
            justify-content: center;
            margin: 10px;
        }

        .btn {
            padding: 5px;
            width: 100px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            border: none;
            color: white;
        }

        .btn-add {
            background-color: #4CAF50;
        }

        .btn-add:hover {
            background-color: #45a049;
            color: #1916a3;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-delete:hover {
            background-color: #da190b;
            color: #1916a3
        }
    </style>
</head>

<body>
    <?php
    include_once '../partials/navbar.php';
    include_once '../partials/sidebar.php';
    ?>

    <main id="main" class="main" style="margin-top: 100px;">
        <div class="pagetitle">
            <h1>Manage Barangay Youth</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Youth</li>
                </ol>
            </nav>
        </div>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="background-image" style="background-image: url('../assets/img/received_586949182760855-1.jpeg'); background-size: cover; background-position: center; padding: 10px; border-radius: 5px; margin-bottom: 20px; height:50vh; width:100%">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="grid-container">
                        <?php foreach ($barangay as $barangays): ?>
                            <div class="card">
                                <div class="card-header">
                                    Barangay <?php echo htmlspecialchars($barangays['name']); ?>
                                </div>
                                <img src="../assets/img/received_586949182760855-1.jpeg" alt="SK Logo" class="card-img">
                                <div class="card-stats">
                                    <div class="stat">
                                        <div class="stat-label">Population</div>
                                        <div class="stat-value"><?php echo htmlspecialchars($barangays['youth_count']); ?></div>
                                    </div>
                                    <div class="stat">
                                        <div class="stat-label">Youth</div>
                                        <div class="stat-value"><?php echo htmlspecialchars($barangays['youth_count']); ?></div>
                                    </div>
                                    <div class="stat">
                                        <div class="stat-label">Projects</div>
                                        <div class="stat-value"><?php echo htmlspecialchars($barangays['youth_count']); ?></div>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <a href="barangayYouth.php?id=<?php echo urlencode($barangays['id']); ?>">
                                        <button class="btn btn-add"><i class="bi bi-eye"> View</i></button>
                                    </a>
                                    <button class="btn btn-delete"><i class="bi bi-trash"> Delete</i></button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>