<?php

require_once '../../core/barangayController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate the input
    $barangayName = htmlspecialchars(trim($_POST['barangayName']));
    $base_url = '../../../uploads/img/';

    if (empty($barangayName)) {
        $_SESSION['error'] = 'Barangay name is required.';
        header('Location: ../../manage-barangay/barangay.php');
        exit();
    }

    // Handle file upload
    if (isset($_FILES['barangayImage']) && $_FILES['barangayImage']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['barangayImage']['tmp_name'];
        $fileName = $_FILES['barangayImage']['name'];
        $fileSize = $_FILES['barangayImage']['size'];
        $fileType = $_FILES['barangayImage']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['jpg', 'jpeg', 'png'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $dest_path = $base_url . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Proceed with adding the barangay
                try {
                    $barangayController = new barangayController();
                    $barangayController->addBarangay($barangayName, $fileName);
                    $_SESSION['success'] = 'Barangay added successfully.';
                } catch (Exception $e) {
                    $_SESSION['error'] = 'An error occurred while adding the barangay: ' . $e->getMessage();
                }
            } else {
                $_SESSION['error'] = 'There was an error moving the uploaded file.';
            }
        } else {
            $_SESSION['error'] = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
    } else {
        $_SESSION['error'] = 'There was an error with the file upload.';
    }

    header('Location: ../../manage-barangay/barangay.php');
    exit();
}
