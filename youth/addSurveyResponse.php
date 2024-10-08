<?php

require_once './core/surveyController.php'; 

$surveyController = new SurveyController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $responseData = [
        'barangay_id' => $_POST['barangay_id'],
        'lastname' => $_POST['lastname'],
        'firstname' => $_POST['firstname'],
        'middlename' => $_POST['middlename'],
        'address' => $_POST['address'],
        'sex' => $_POST['sex'],
        'age' => $_POST['age'],
        'dob' => $_POST['dob'],
        'school_youth' => $_POST['school_youth'],
        'age_classification' => $_POST['age_classification'],
        'civil_status' => $_POST['civil_status'],
        'phoneno' => $_POST['phoneno'],
        'place_of_birth' => $_POST['place_of_birth'],
        'religion' => $_POST['religion'],
        'ethnicity' => $_POST['ethnicity'],
        'fbname' => $_POST['fbname'],
        'youth_classification' => $_POST['youth_classification'],
        'gender_pref' => $_POST['gender_pref'],
        'educational_attainment' => $_POST['educational_attainment'],
        'tech_voc' => $_POST['tech_voc'],
        'still_studying' => $_POST['still_studying'],
        'grade_level_if_studying' => $_POST['grade_level_if_studying'],
        'if_no_studying' => $_POST['if_no_studying'],
        'disability' => $_POST['disability'],
        'disability_spec' => $_POST['disability_spec'],
        'have_any_child' => $_POST['have_any_child'],
        'registered_voter' => $_POST['registered_voter'],
        'have_involvement' => $_POST['have_involvement'],
    ];

    if ($surveyController->addSurveyResponse($responseData)) {
        echo "Survey response added successfully!";
    } else {
        echo "Error adding survey response.";
    }
} else {
    echo "Invalid request method.";
}
