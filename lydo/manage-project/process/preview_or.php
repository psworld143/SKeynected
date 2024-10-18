<?php
if (isset($_GET['file'])) {

    $file = basename($_GET['file']);

    $file_path = realpath('../../../uploads/or_images/' . $file);

    if ($file_path && file_exists($file_path) && exif_imagetype($file_path)) {
       
        header('Content-Type: ' . mime_content_type($file_path));
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    } else {
        header('HTTP/1.0 404 Not Found');
        echo 'Image not found';
    }
} else {
    echo 'No file specified.';
}
