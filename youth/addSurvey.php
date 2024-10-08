<?php

require_once './core/surveyController.php';

$surveyController = new SurveyController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $responseData = [
        'barangay_id' => $_POST['barangayId'] ?? null,
        'lastname' => $_POST['lastname'] ?? null,
        'firstname' => $_POST['firstname'] ?? null,
        'middlename' => $_POST['middlename'] ?? null,
        'address' => $_POST['address'] ?? null,
        'sex' => $_POST['sex'] ?? null,
        'age' => $_POST['age'] ?? null,
        'dob' => $_POST['dob'] ?? null,
        'school_youth' => $_POST['schoolYouth'] ?? null,
        'age_classification' => $_POST['ageClassification'] ?? null,
        'civil_status' => $_POST['civilStatus'] ?? null,
        'phoneno' => $_POST['phoneno'] ?? null,
        'place_of_birth' => $_POST['placeOfBirth'] ?? null,
        'religion' => $_POST['religion'] ?? null,
        'ethnicity' => $_POST['ethnicity'] ?? null,
        'fbname' => $_POST['fbname'] ?? null,
        'youth_classification' => $_POST['youthClassification'] ?? null,
        'gender_pref' => $_POST['genderPref'] ?? null,
        'educational_attainment' => $_POST['educationalAttainment'] ?? null,
        'tech_voc' => $_POST['tech_voc'] ?? null,
        'still_studying' => $_POST['stillStudying'] ?? null,
        'grade_level_if_studying' => $_POST['GradeLevelIfStudying'] ?? null,
        'if_no_studying' => $_POST['if_no_studying'] ?? null,
        'disability' => $_POST['disability'] ?? null,
        'disability_spec' => $_POST['disability_spec'] ?? null,
        'have_any_child' => $_POST['have_any_child'] ?? null,
        'registered_voter' => $_POST['registeredVoter'] ?? null,
        'have_involvement' => $_POST['haveInvolvement'] ?? null,
    ];


    if (empty($responseData['barangay_id'])) {
        die('Error: Barangay ID is required.');
    }


    if ($surveyController->addSurveyResponse($responseData)) {
        header('Location: thank-you.php');
        exit();
    } else {
        echo "Error adding survey response.";
    }
} else {
    echo "Invalid request method.";
}
