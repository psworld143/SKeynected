<?php
require_once 'Database.php';

class surveyController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getBarangay()
    {
        $query = "SELECT * FROM barangays";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }


    public function addSurveyResponse($responseData)
    {
        $query = "INSERT INTO survey_responses (
            barangay_id, lastname, firstname, middlename, address, sex, age, dob, 
            school_youth, age_classification, civil_status, phoneno, place_of_birth, 
            religion, ethnicity, fbname, youth_classification, gender_pref, 
            educational_attainment, tech_voc, still_studying, grade_level_if_studying, 
            if_no_studying, disability, disability_spec, have_any_child, 
            registered_voter, have_involvement, created_at
        ) VALUES (
            :barangay_id, :lastname, :firstname, :middlename, :address, :sex, :age, :dob, 
            :school_youth, :age_classification, :civil_status, :phoneno, :place_of_birth, 
            :religion, :ethnicity, :fbname, :youth_classification, :gender_pref, 
            :educational_attainment, :tech_voc, :still_studying, :grade_level_if_studying, 
            :if_no_studying, :disability, :disability_spec, :have_any_child, 
            :registered_voter, :have_involvement, NOW()
        )";

        $stmt = $this->db->prepare($query);

        $params = [
            ':barangay_id' => $responseData['barangay_id'],
            ':lastname' => $responseData['lastname'],
            ':firstname' => $responseData['firstname'],
            ':middlename' => $responseData['middlename'],
            ':address' => $responseData['address'],
            ':sex' => $responseData['sex'],
            ':age' => $responseData['age'],
            ':dob' => $responseData['dob'],
            ':school_youth' => $responseData['school_youth'],
            ':age_classification' => $responseData['age_classification'],
            ':civil_status' => $responseData['civil_status'],
            ':phoneno' => $responseData['phoneno'],
            ':place_of_birth' => $responseData['place_of_birth'],
            ':religion' => $responseData['religion'],
            ':ethnicity' => $responseData['ethnicity'],
            ':fbname' => $responseData['fbname'],
            ':youth_classification' => $responseData['youth_classification'],
            ':gender_pref' => $responseData['gender_pref'],
            ':educational_attainment' => $responseData['educational_attainment'],
            ':tech_voc' => $responseData['tech_voc'],
            ':still_studying' => $responseData['still_studying'],
            ':grade_level_if_studying' => $responseData['grade_level_if_studying'],
            ':if_no_studying' => $responseData['if_no_studying'],
            ':disability' => $responseData['disability'],
            ':disability_spec' => $responseData['disability_spec'],
            ':have_any_child' => $responseData['have_any_child'],
            ':registered_voter' => $responseData['registered_voter'],
            ':have_involvement' => $responseData['have_involvement']
        ];

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        return $stmt->execute();
    }
}
