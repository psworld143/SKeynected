<?php
require_once '../core/barangayController.php';

$barangay_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// static image for now
$backgroundImages = [
    1 => '../assets/img/acmonan.jpg', 
    2 => '../assets/img/bololmala.jpg', 
    3 => '../assets/img/bunao.jpg',    
    4 => '../assets/img/cebuano.jpg',   
    5 => '../assets/img/crossing-rubber.jpg',  
    6 => '../assets/img/kablon.jpg',   
    7 => '../assets/img/kalkam.jpg',  
    8 => '../assets/img/linan.png',   
];


$backgroundImage = '../assets/img/default_background.jpg'; 
if ($barangay_id && array_key_exists($barangay_id, $backgroundImages)) {
    $backgroundImage = $backgroundImages[$barangay_id];
}

if ($barangay_id) {
    $SKbarangay = (new barangayController())->getAllSKBarangayMember($barangay_id);
    $youths = (new barangayController())->getYouthCountByBarangay($barangay_id);
    $projects = (new barangayController())->getProjectByBrgy($barangay_id);
    $barangayName = (new barangayController())->getBarangayName($barangay_id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Barangay <?php echo $barangayName; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="../assets/img/LYDOO.jpg" rel="icon">
    <link href="../assets/img/SK-logo.png" rel="apple-touch-icon">



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
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .card {
            background: #eee;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: #175895;
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
            <h1>Manage Barangay <?php echo $barangayName; ?></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Manage</li>
                    <li class="breadcrumb-item active">Barangay</li>
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
                    <div class="background-image" style="
        background-image: url('<?php echo $backgroundImage; ?>'); 
        background-size: cover; /* or 'contain' based on your preference */
        background-position: center; /* Center the image */
        padding: 10px; 
        border-radius: 5px; 
        margin-bottom: 20px; 
        height: 70vh; 
        width: 100%; 
        background-repeat: no-repeat; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    </div>
                </div>

                <div class="grid-container col-md-12">
                    <?php foreach ($SKbarangay as $barangays): ?>
                        <div class="card">
                            <div class="card-header">
                                SK Members
                            </div>
                            <img src="../assets/img/received_586949182760855-1.jpeg" alt="SK Logo" class="card-img">
                            <div class="card-stats">
                                <div class="stat">
                                    <div class="stat-label">SK Members</div>
                                    <div class="stat-value"><?php echo htmlspecialchars($barangays['youth_count']); ?></div>
                                </div>
                            </div>
                            <div class="button-group">
                                <a href=../manage-user/SKtables.php?id=<?php echo urlencode($barangays['id']); ?>">
                                    <button class="btn btn-add"><i class="bi bi-eye"> View</i></button>
                                </a>
                                <button class="btn btn-delete"><i class="bi bi-trash"> Delete</i></button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php foreach ($youths as $youth): ?>
                        <div class="card">
                            <div class="card-header">
                                Youth
                            </div>
                            <img src="../assets/img/sk-carousel-20150520-1.png" alt="SK Logo" class="card-img">
                            <div class="card-stats">
                                <div class="stat">
                                    <div class="stat-label">Total Youth</div>
                                    <div class="stat-value"><?php echo htmlspecialchars($youth['youth_count']); ?></div>
                                </div>
                                <div class="stat">
                                    <div class="stat-label">Male</div>
                                    <div class="stat-value"><?php echo htmlspecialchars($youth['male_count']); ?></div>
                                </div>
                                <div class="stat">
                                    <div class="stat-label">Female</div>
                                    <div class="stat-value"><?php echo htmlspecialchars($youth['female_count']); ?></div>
                                </div>
                            </div>
                            <div class="button-group">
                                <a href="../manage-youth/barangayYouth.php?id=<?php echo urlencode($youth['id']); ?>">
                                    <button class="btn btn-add"><i class="bi bi-eye"> View</i></button>
                                </a>
                                <button class="btn btn-delete"><i class="bi bi-trash"> Delete</i></button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php foreach ($projects as $project): ?>
                        <div class="card">
                            <div class="card-header">
                                Projects
                            </div>
                            <img src="../assets/img/bg-blue.jpg" alt="SK Logo" class="card-img">
                            <div class="card-stats">
                                <div class="stat">
                                    <div class="stat-label">Total Projects</div>
                                    <div class="stat-value"><?php echo htmlspecialchars($project['project_count']); ?></div>
                                </div>
                            </div>
                            <div class="button-group">
                                <a href="../manage-project/project.php?id=<?php echo urlencode($project['id']); ?>">
                                    <button class="btn btn-add"><i class="bi bi-eye"> View</i></button>
                                </a>
                                <button class="btn btn-delete"><i class="bi bi-trash"> Delete</i></button>
                            </div>
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