<?php
require_once 'core/surveyController.php';
$youth = new surveyController();
// $barangays = $youth->getBarangay();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Youth Survey Form</title>
    <meta name="description" content="Survey form with QR code generator">
    <meta name="keywords" content="survey, qr code, youth">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="assets/css/global.css" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <style>
        body {
            background: url('assets/img/youth-cover.jfif') no-repeat center center fixed;
            background-size: cover;
            /* filter: blur(8px); */
            height: 100vh;
            margin: 0;
        }

        .survey-container {
            max-width: 900px;
            /* background-color: rgba(255, 255, 255, 0.8); */
            padding: 20px;
            border-radius: 10px;
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
    </style>
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100">

    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">SKeynected</span>
            </a>
        </div><!-- End Logo -->
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
            <div class="col-md-6 p-4 p-md-5">
                <h2 class="mb-4 fw-bold">Youth Survey Form</h2>
                <form id="surveyForm">
                    <div class="mb-3">
                        <label for="youthName" class="form-label">Barangay</label>
                        <select name="" id="barangayName" class="form-control">
                            <?php foreach ($barangays as $barangay): ?>
                                <option value="<?php echo $barangay['name']; ?>"><?php echo $barangay['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Take Survey Form</button>
                </form>
            </div>
            <div class="col-md-6 bg-light p-4 p-md-5 d-flex flex-column justify-content-center align-items-center">
                <h4 class="mb-4 fw-bold">QR Code</h4>
                <div id="qrCode">
                    <div class="qr-placeholder d-flex justify-content-center align-items-center bg-white rounded">
                        <span class="text-muted text-center">QR code will appear here after generating</span>
                    </div>
                </div>
                <span class="mt-2">Please scan the QR Code</span>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('surveyForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // const youthName = document.getElementById('youthName').value;
            const barangayName = document.getElementById('barangayName').value;
            const surveyUrl = `survey-forms.php?barangay=${encodeURIComponent(barangayName)}`;

            document.getElementById('qrCode').innerHTML = '';

            new QRCode(document.getElementById('qrCode'), {
                text: surveyUrl,
                width: 200,
                height: 200
            });
        });
    </script>
</body>

</html>