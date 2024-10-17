<?php

require '../../../vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['file'])) {
    $file = basename($_GET['file']);
    $file_path = '../../../uploads/' . $file;

    if (!file_exists($file_path)) {
        echo 'File does not exist: ' . htmlspecialchars($file_path);
        exit;
    }

    $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

    switch ($file_extension) {
        case 'pdf':
            header('Content-Type: application/pdf');
            readfile($file_path);
            break;
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            echo '<img src="' . htmlspecialchars($file_path) . '" style="max-width: 100%; height: auto;" />';
            break;
        case 'txt':
        case 'csv':
            echo '<pre>' . htmlspecialchars(file_get_contents($file_path)) . '</pre>';
            break;
        case 'doc':
        case 'docx':
            try {
                $phpWord = IOFactory::load($file_path);
                $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
                $htmlWriter->save('php://output');
            } catch (Exception $e) {
                echo 'Error loading document: ' . htmlspecialchars($e->getMessage());
            }
            break;
        default:
            echo 'Preview not available for this file type. Please download to view.';
    }
} else {
    echo 'No file specified.';
}
