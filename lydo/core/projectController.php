<?php

require 'Database.php';

class projectController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }


    public function getProjects()
    {

        $query = "
        SELECT p.*, b.name AS barangay_name, sm.name AS sk_member_name, sm.position AS sk_member_position
        FROM projects p
        LEFT JOIN barangays b ON p.barangay_id = b.id
        LEFT JOIN sk_members sm ON p.sk_member_id = sm.id
    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProjectsByID($project_id)
    {
        $query = "
            SELECT p.*, b.name AS barangay_name
            FROM projects p
            JOIN barangays b ON p.barangay_id = b.id
            WHERE p.project_id = :project_id
        ";

        $stmt = $this->db->prepare($query);
        $params = [':project_id' => $project_id];
        $stmt->execute($params);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getMaterialsByProjectID($project_id)
    {
        $query = "SELECT * FROM materials WHERE project_id = :project_id";
        $stmt = $this->db->prepare($query);
        $params = [':project_id' => $project_id];
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function updateStatus($project_id, $status, $hearing_date = null)
    {

        $query = "UPDATE projects SET status = :status, hearing_schedule = :hearing_schedule WHERE project_id = :project_id";
        $stmt = $this->db->prepare($query);

        $params = [
            ':project_id' => $project_id,
            ':status' => $status,
            ':hearing_schedule' => $hearing_date
        ];

        return $stmt->execute($params);
    }


    public function getDisbursementByBarangay($project_id)
    {
        $query = "SELECT * FROM disbursements WHERE project_id = :project_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLiquidationByBarangay($project_id)
    {
        $query = "SELECT * FROM liquidation WHERE project_id = :project_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':project_id', $project_id, PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
