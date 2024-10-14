// Handle form submission for updating youth details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_youth'])) {
    $updatedData = [
        'firstname' => $_POST['firstname'],
        'middlename' => $_POST['middlename'],
        'lastname' => $_POST['lastname'],
        'age' => $_POST['age'],
        'sex' => $_POST['sex'],
        'address' => $_POST['address'],
        'phoneno' => $_POST['phoneno'],
        'fbname' => $_POST['fbname'],
        'civil_status' => $_POST['civil_status'],
        'religion' => $_POST['religion'],
        'ethnicity' => $_POST['ethnicity'],
        'dob' => $_POST['dob'],
        'place_of_birth' => $_POST['place_of_birth'],
        'educational_attainment' => $_POST['educational_attainment'],
        'still_studying' => $_POST['still_studying'],
        'grade_level_if_studying' => $_POST['grade_level_if_studying'],
        'if_no_studying' => $_POST['if_no_studying'],
        'disability' => $_POST['disability'],
        'disability_spec' => $_POST['disability_spec'],
        'have_any_child' => $_POST['have_any_child'],
        'registered_voter' => $_POST['registered_voter'],
        'have_involvement' => $_POST['have_involvement']
    ];

    $updateResult = $youthController->updateYouthDetails($youthId, $updatedData);
    if ($updateResult) {
        $responseData = $youthController->getSurveyResponsesByResponseId($youthId); // Refresh data
        $updateMessage = "Youth details updated successfully.";
    } else {
        $updateMessage = "Failed to update youth details.";
    }
}
?>