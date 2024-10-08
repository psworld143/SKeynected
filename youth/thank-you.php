
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You - Youth Survey</title>
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
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .survey-container {
            max-width: 900px;
            padding: 20px;
            border-radius: 10px;
            z-index: 1;
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

        .thank-you-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            backdrop-filter: blur(10px);
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            color: #4a4a4a;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            color: #666;
        }

        .organizations {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e0e0e0;
        }

        .org-item {
            margin-bottom: 1rem;
            font-weight: 300;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .org-item p {
            margin: 0;
            text-align: center;
        }

        .org-item img {
            margin-right: 10px;
            width: 50px;
            height: auto;
            border-radius: 50%;
        }

        .org-item:hover {
            transform: translateX(5px);
            color: #764ba2;
        }

        .icon-checkmark {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .thank-you-card {
                padding: 2rem;
            }
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100">
    <!-- <header id="header" class="header fixed-top d-flex align-items-center">
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
    </header> -->
    <div class="container survey-container">
        <div class="row g-0 bg-white rounded-3 shadow-lg overflow-hidden mt-">
            <div class="thank-you-card ">
                <i class="bi bi-check-circle icon-checkmark"></i>
                <h1>Maraming salamat sa iyong kooperasyon!</h1>
                <p>Ito ay makakatulong sa pagbibigay ng tamang programa para sa kabataan dito sa bayan ng Tupi.</p>
                <div class="organizations">
                    <div class="org-item">
                        <img src="assets/img/LGU.jfif" alt="Local Government Unit of Tupi Logo">
                        <p>Local Government Unit of Tupi</p>
                    </div>
                    <div class="org-item">
                        <img src="assets/img/LYDC.png" alt="Local Youth Development Office Logo">
                        <p>Local Youth Development Office</p>
                    </div>
                    <div class="org-item">
                        <img src="assets/img/sk-logo.png" alt="Sangguniang Kabataan Municipal Federation Logo">
                        <p>Sangguniang Kabataan Municipal Federation</p>
                    </div>
                    <div class="org-item">
                        <img src="assets/img/LYDO-tupi.jpg" alt="Local Youth Development Council Logo">
                        <p>Local Youth Development Council</p>
                    </div>
                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>