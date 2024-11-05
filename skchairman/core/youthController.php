<?php
require_once 'Database.php';

class youthController
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
        return $stmt->fetchAll();
    }

    public function getBarangayByID($barangay_id)
    {
        $query = "SELECT * FROM barangays WHERE id = :barangay_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':barangay_id', $barangay_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }


    public function getYouthCountByBarangay($barangay_id)
    {
        $query = "
            SELECT b.id, b.name, COUNT(DISTINCT sr.response_id) AS youth_count
            FROM barangays b
            LEFT JOIN sk_members sm ON b.id = sm.barangay_id
            LEFT JOIN survey_responses sr ON sr.barangay_id = b.id
            WHERE b.id = :barangay_id
            GROUP BY b.id, b.name
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':barangay_id', $barangay_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }





    public function getAllYouthProfiles($barangay_id)
    {
        $query = "
        SELECT sr.*, b.name as barangay_name
        FROM survey_responses sr
        INNER JOIN barangays b ON sr.barangay_id = b.id
        WHERE sr.barangay_id = :barangay_id
    ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':barangay_id', $barangay_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getSurveyResponsesByResponseId($response_id)
    {

        $query = "
            SELECT sr.*, b.name AS barangay_name 
            FROM survey_responses sr 
            JOIN barangays b ON sr.barangay_id = b.id 
            WHERE sr.response_id = :response_id
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':response_id', $response_id, PDO::PARAM_INT);
        $stmt->execute();


        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateYouthImage($youth_id, $youth_image)
    {
        $query = "UPDATE survey_responses SET youth_image = :youth_image WHERE response_id = :response_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':response_id', $youth_id, PDO::PARAM_INT);
        $stmt->bindParam(':youth_image', $youth_image, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function updateYouthDetails($youth_id, $data)
    {
        try {
            // Start transaction
            $this->db->beginTransaction();

            $query = "UPDATE survey_responses SET 
                firstname = :firstname,
                middlename = :middlename,
                lastname = :lastname,
                age = :age,
                sex = :sex,
                address = :address,
                phoneno = :phoneno,
                fbname = :fbname,
                civil_status = :civil_status,
                religion = :religion,
                ethnicity = :ethnicity,
                dob = :dob,
                place_of_birth = :place_of_birth,
                age_classification = :age_classification,
                gender_pref = :gender_pref,
                youth_classification = :youth_classification,
                educational_attainment = :educational_attainment,
                tech_voc = :tech_voc,
                still_studying = :still_studying,
                grade_level_if_studying = :grade_level_if_studying,
                if_no_studying = :if_no_studying,
                disability = :disability,
                disability_spec = :disability_spec,
                have_any_child = :have_any_child,
                registered_voter = :registered_voter,
                have_involvement = :have_involvement
                WHERE response_id = :youth_id";

            $stmt = $this->db->prepare($query);

            // Bind all parameters
            $stmt->bindParam(':youth_id', $youth_id, PDO::PARAM_INT);
            $stmt->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
            $stmt->bindParam(':middlename', $data['middlename'], PDO::PARAM_STR);
            $stmt->bindParam(':lastname', $data['lastname'], PDO::PARAM_STR);
            $stmt->bindParam(':age', $data['age'], PDO::PARAM_INT);
            $stmt->bindParam(':sex', $data['sex'], PDO::PARAM_STR);
            $stmt->bindParam(':address', $data['address'], PDO::PARAM_STR);
            $stmt->bindParam(':phoneno', $data['phoneno'], PDO::PARAM_STR);
            $stmt->bindParam(':fbname', $data['fbname'], PDO::PARAM_STR);
            $stmt->bindParam(':civil_status', $data['civil_status'], PDO::PARAM_STR);
            $stmt->bindParam(':religion', $data['religion'], PDO::PARAM_STR);
            $stmt->bindParam(':ethnicity', $data['ethnicity'], PDO::PARAM_STR);
            $stmt->bindParam(':dob', $data['dob'], PDO::PARAM_STR);
            $stmt->bindParam(':place_of_birth', $data['place_of_birth'], PDO::PARAM_STR);
            $stmt->bindParam(':age_classification', $data['age_classification'], PDO::PARAM_STR);
            $stmt->bindParam(':gender_pref', $data['gender_pref'], PDO::PARAM_STR);
            $stmt->bindParam(':youth_classification', $data['youth_classification'], PDO::PARAM_STR);
            $stmt->bindParam(':educational_attainment', $data['educational_attainment'], PDO::PARAM_STR);
            $stmt->bindParam(':tech_voc', $data['tech_voc'], PDO::PARAM_STR);
            $stmt->bindParam(':still_studying', $data['still_studying'], PDO::PARAM_STR);
            $stmt->bindParam(':grade_level_if_studying', $data['grade_level_if_studying'], PDO::PARAM_STR);
            $stmt->bindParam(':if_no_studying', $data['if_no_studying'], PDO::PARAM_STR);
            $stmt->bindParam(':disability', $data['disability'], PDO::PARAM_STR);
            $stmt->bindParam(':disability_spec', $data['disability_spec'], PDO::PARAM_STR);
            $stmt->bindParam(':have_any_child', $data['have_any_child'], PDO::PARAM_STR);
            $stmt->bindParam(':registered_voter', $data['registered_voter'], PDO::PARAM_STR);
            $stmt->bindParam(':have_involvement', $data['have_involvement'], PDO::PARAM_STR);

            // Execute the query
            $result = $stmt->execute();

            // Commit the transaction
            $this->db->commit();

            return $result;

        } catch (PDOException $e) {
            // Rollback the transaction if something failed
            $this->db->rollBack();
            error_log("Database Error: " . $e->getMessage());
            throw new Exception("Failed to update youth details: " . $e->getMessage());
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("General Error: " . $e->getMessage());
            throw $e;
        }
    }



}
