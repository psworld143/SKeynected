<?php
require_once '../../core/youthController.php';
require_once '../../core/sessionController.php';

// Check if user is logged in
(new sessionController())->checkLogin();

// Debug mode setting
$debug = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $youthController = new youthController();
    $youthId = isset($_POST['youth_id']) ? (int) $_POST['youth_id'] : 0;

    // Helper function to standardize Yes/No values
    function standardizeYesNo($value)
    {
        return ucfirst(strtolower($value));
    }

    // Process conditional fields
    $gradeLevelIfStudying = ($_POST['still_studying'] === 'yes') ? $_POST['GradeLevelIfStudying'] : null;
    $ifNoStudying = ($_POST['still_studying'] === 'no') ? $_POST['if_no_studying'] : null;
    $disabilitySpec = ($_POST['disability'] === 'yes') ? $_POST['disability_spec'] : null;

    // Prepare data array for update
    $data = [
        // Personal Information
        'firstname' => trim($_POST['firstname']),
        'middlename' => trim($_POST['middlename'] ?? ''),
        'lastname' => trim($_POST['lastname']),
        'age' => (int) $_POST['age'],
        'sex' => strtolower($_POST['sex']),
        'address' => trim($_POST['address']),
        'phoneno' => trim($_POST['phoneno']),
        'fbname' => trim($_POST['fbname'] ?? ''),

        // Demographic Information
        'civil_status' => strtolower($_POST['civilStatus']),
        'religion' => trim($_POST['religion']),
        'ethnicity' => strtolower($_POST['ethnicity']),
        'dob' => $_POST['dob'],
        'place_of_birth' => trim($_POST['place_of_birth']),

        // Classification
        'age_classification' => $_POST['age_classification'],
        'gender_pref' => strtolower($_POST['gender_pref']),
        'youth_classification' => $_POST['youth_classification'],

        // Education
        'educational_attainment' => strtolower($_POST['educational_attainment']),
        'tech_voc' => isset($_POST['tech_voc']) ? trim($_POST['tech_voc']) : 'N/A',
        'still_studying' => standardizeYesNo($_POST['still_studying']),
        'grade_level_if_studying' => $gradeLevelIfStudying,
        'if_no_studying' => $ifNoStudying,

        // Additional Information
        'disability' => $_POST['disability'],
        'disability_spec' => $disabilitySpec,
        'have_any_child' => standardizeYesNo($_POST['have_any_child']),
        'registered_voter' => standardizeYesNo($_POST['registered_voter']),
        'have_involvement' => trim($_POST['have_involvement'])
    ];

    try {
        // Basic validation
        if (empty($youthId)) {
            throw new Exception("Invalid youth ID");
        }

        if (empty($data['firstname']) || empty($data['lastname'])) {
            throw new Exception("First name and last name are required");
        }

        if (!is_numeric($data['age']) || $data['age'] < 15 || $data['age'] > 30) {
            throw new Exception("Age must be between 15 and 30");
        }

        // Attempt to update the youth details
        $result = $youthController->updateYouthDetails($youthId, $data);

        if ($result) {
            header('Location: ../youthProfile.php?id=' . $youthId . '&success=1');
            exit();
        } else {
            throw new Exception("Failed to update youth details");
        }
    } catch (Exception $e) {
        error_log("Error updating youth details: " . $e->getMessage());

        // Display error on page if in debug mode
        if ($debug) {
            echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
        } else {
            // Redirect with error message if not in debug mode
            header('Location: ../youthProfile.php?id=' . $youthId . '&error=1&message=' . urlencode($e->getMessage()));
            exit();
        }
    }
} else {
    // If not POST request, redirect to profile page
    header('Location: ../youthProfile.php');
    exit();
}
