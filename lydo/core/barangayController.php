<?php

require 'Database.php';

class barangayController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }


    public function getBarangay()
    {
        $query = "
            SELECT 
                b.id, 
                b.name, 
                COUNT(DISTINCT sr.response_id) AS youth_count,
                SUM(CASE WHEN sr.sex = 'male' THEN 1 ELSE 0 END) AS male_count,
                SUM(CASE WHEN sr.sex = 'female' THEN 1 ELSE 0 END) AS female_count,
                COUNT(DISTINCT sm.id) AS sk_member_count,
                COUNT(DISTINCT p.project_id) AS project_count
            FROM barangays b
            LEFT JOIN survey_responses sr ON sr.barangay_id = b.id
            LEFT JOIN sk_members sm ON sm.barangay_id = b.id
            LEFT JOIN projects p ON p.barangay_id = b.id
            GROUP BY b.id, b.name
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllSKBarangayMember($barangay_id = null)
    {
        $query = "
        SELECT b.id, b.name, COUNT(sm.id) AS youth_count
        FROM barangays b
        LEFT JOIN sk_members sm ON b.id = sm.barangay_id
    ";

        if ($barangay_id !== null) {
            $query .= " WHERE b.id = :barangay_id";
        }

        $query .= " GROUP BY b.id, b.name";

        $stmt = $this->db->prepare($query);


        if ($barangay_id !== null) {
            $stmt->bindParam(':barangay_id', $barangay_id, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getYouthCountByBarangay($barangay_id = null)
    {
        $query = "
        SELECT 
            b.id, 
            b.name, 
            COUNT(DISTINCT sr.response_id) AS youth_count,
            SUM(CASE WHEN sr.sex = 'male' THEN 1 ELSE 0 END) AS male_count,
            SUM(CASE WHEN sr.sex = 'female' THEN 1 ELSE 0 END) AS female_count
        FROM barangays b
        LEFT JOIN survey_responses sr ON sr.barangay_id = b.id
    ";


        if ($barangay_id !== null) {
            $query .= " WHERE b.id = :barangay_id";
        }

        $query .= " GROUP BY b.id, b.name";

        $stmt = $this->db->prepare($query);
        if ($barangay_id !== null) {
            $stmt->bindParam(':barangay_id', $barangay_id, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjectByBrgy($barangay_id = null)
    {
        $query = "
            SELECT 
                b.id, 
                b.name, 
                COUNT(DISTINCT p.project_id) AS project_count
            FROM barangays b
            LEFT JOIN projects p ON p.barangay_id = b.id
        ";


        if ($barangay_id !== null) {
            $query .= " WHERE b.id = :barangay_id";
        }

        $query .= " GROUP BY b.id, b.name";

        $stmt = $this->db->prepare($query);

        if ($barangay_id !== null) {
            $stmt->bindParam(':barangay_id', $barangay_id, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getBarangayName($barangay_id)
    {
        $query = "SELECT name FROM barangays WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $barangay_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function getProjectsByBarangay($barangay_id)
    {
        $query = "
        SELECT p.*, b.name AS barangay_name, sm.name AS sk_member_name, sm.position AS sk_member_position
        FROM projects p
        LEFT JOIN barangays b ON p.barangay_id = b.id
        LEFT JOIN sk_members sm ON p.sk_member_id = sm.id
        WHERE p.barangay_id = :barangay_id
    ";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':barangay_id', $barangay_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   
}
