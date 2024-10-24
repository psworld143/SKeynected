]<?php

require_once '../../core/youthController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $base_url = '../../../uploads/img/';

    // Here is where the youth_id is retrieved from the POST request
    $youthId = $_POST['youth_id'];

    if (isset($_FILES['youthImage']) && $_FILES['youthImage']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['youthImage']['tmp_name'];
        $fileName = $_FILES['youthImage']['name'];
        $fileSize = $_FILES['youthImage']['size'];
        $fileType = $_FILES['youthImage']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['jpg', 'jpeg', 'png'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $dest_path = $base_url . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Proceed with adding the youth profile image
                try {
                    $youthController = new youthController();
                    $youthController->updateYouthImage($youthId, $fileName);
                    $_SESSION['success'] = 'Profile image updated successfully.';
                } catch (Exception $e) {
                    $_SESSION['error'] = 'An error occurred while updating the profile image: ' . $e->getMessage();
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

    header('Location: ../../manage-youth/youthProfile.php?id=' . urlencode($youthId));
    exit();
}