<?php
require_once '../core/userController.php';
require_once '../core/projectController.php';
require_once '../core/youthController.php';

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
        .card {
            margin-bottom: 24px;
            /* box-shadow: 0 2px 3px #e4e8f0; */
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #eff0f2;
            border-radius: 1rem;
            padding: 5px;
        }

        .avatar-md {
            height: 4rem;
            width: 4rem;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .img-thumbnail {
            padding: 0.25rem;
            background-color: #f1f3f7;
            border: 1px solid #eff0f2;
            border-radius: 0.75rem;
        }

        .avatar-title {
            align-items: center;
            background-color: #3b76e1;
            color: #fff;
            display: flex;
            font-weight: 500;
            height: 100%;
            justify-content: center;
            width: 100%;
        }

        .bg-soft-primary {
            background-color: rgba(59, 118, 225, .25) !important;
        }

        a {
            text-decoration: none !important;
        }

        .badge-soft-danger {
            color: #f56e6e !important;
            background-color: rgba(245, 110, 110, .1);
        }

        .badge-soft-success {
            color: #63ad6f !important;
            background-color: rgba(99, 173, 111, .1);
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.6em;
            font-size: 75%;
            font-weight: 500;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.75rem;
        }

        .badge-soft-pink {
            background-color: #f8bbd0;
            color: #fff;
        }

        .badge-soft-blue {
            background-color: #add8e6;
            color: #fff;
        }

        .badge-soft-warning {
            background-color: #ffeeba;
            color: #212529;
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
            <div class="row">
                <div class="col-lg-12">
                    <?php foreach ($youthProfiles as $youth): ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-end">
                                        <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"><i class="bx bx-dots-horizontal-rounded"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Remove</a></div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div><img src="<?php echo $youth['profile_picture'] ?? '../assets/img/profile.png'; ?>" alt="<?php echo $youth['firstname']; ?>" alt="" class="avatar-md rounded-circle img-thumbnail" /></div>
                                        <div class="flex-1 ms-3">
                                            <h5 class="font-size-16 mb-1"><a href="#" class="text-dark"><?php echo $youth['firstname'] . ' ' . $youth['lastname']; ?></a></h5>
                                            <span class="badge 
                                            <?php
                                            if ($youth['sex'] == 'female') {
                                                echo 'badge-soft-pink';
                                            } elseif ($youth['sex'] == 'male') {
                                                echo 'badge-soft-blue';
                                            } else {
                                                echo 'badge-soft-warning';
                                            }
                                            ?> mb-0">
                                                <i class="bi bi-gender-ambiguous"></i>
                                                <?php echo $youth['sex']; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mt-3 pt-1">
                                        <p class="text-muted mb-0"><i class="bx bx-phone font-size-15 align-middle pe-2 text-primary"></i><?php echo $youth['phoneno']; ?> </p>
                                        <p class="text-muted mb-0 mt-2"><i class="bx bx-church font-size-15 align-middle pe-2 text-primary"></i> <?php echo $youth['religion']; ?></p>
                                        <p class="text-muted mb-0 mt-2"><i class="bx bx-home font-size-15 align-middle pe-2 text-primary"></i> <?php echo $youth['address']; ?></p>
                                    </div>
                                    <div class="d-flex gap-2 pt-4">
                                        <button type="button" class="btn btn-soft-primary btn-sm w-50" onclick="window.location.href='youthProfile.php?id=<?php echo urlencode($youth['response_id']); ?>'">
                                            <i class="bx bx-user me-1"></i> Profile
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm w-50"><i class="bx bx-trash"></i> Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
        </section>
    </main>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>