<?php
require_once '../core/userController.php';
require_once '../core/projectController.php';
require_once '../core/youthController.php';
$base_url = "/SKeynected/skchairman/";
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: " . $base_url . "index.php");
    exit();
}

$notificationCount = (new projectController())->getNotificationCount();
$youthController = new youthController();
$barangay_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($barangay_id) {
    $youthProfiles = $youthController->getAllYouthProfiles($barangay_id);
    $barangay = (new youthController())->getBarangayByID($barangay_id);
}
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

    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="../assets/css/globalss.css" rel="stylesheet">

    <style>
        img.profile-photo-md {
            height: 50px;
            width: 50px;
            border-radius: 50%;
        }

        .friend-list .friend-card {
            border-radius: 4px;
            border-bottom: 1px solid #f1f2f2;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            margin-bottom: 20px;
        }


        .friend-list .friend-card .card-info {
            padding: 0 20px 10px;
        }

        .friend-list .friend-card .card-info img.profile-photo-lg {
            margin-top: -60px;
            border: 7px solid #fff;
        }

        img.profile-photo-lg {
            height: 80px;
            width: 80px;
            border-radius: 50%;
        }

        .text-green {
            color: #8dc63f;
        }

        .friend-card {
            position: relative;
            overflow: hidden;
        }

        .custom-image {
            width: 400px;
            height: 100px;
            object-fit: fill;
            display: block;
            margin: 0 auto;
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
            <h1><?= $barangay['name'] ?> Youth</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Youth</li>
                </ol>
            </nav>
        </div>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <section class="section">
            <div class="friend-list">
                <div class="row">
                    <?php foreach ($youthProfiles as $youth): ?>
                        <div class="col-md-4 col-sm-4 mb-4">
                            <a href="youthProfile.php?id=<?php echo urlencode($youth['response_id']); ?>">
                                <div class="friend-card">
                                    <img src="../assets/img/project-header.png" alt="profile-cover" class="img-responsive cover custom-image">
                                    <div class="card-info">
                                        <img src="../assets/img/profile.png" alt="user" class="profile-photo-lg">
                                        <div class="friend-info">
                                            <h5 class="mt-1"><a href="#" class="profile-link"><?php echo $youth['firstname'] . ' ' . $youth['lastname']; ?></a></h5>
                                            <a href="#" class="pull-right text-green">Barangay <?php echo $barangay['name']; ?> Youth</a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    </main>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>