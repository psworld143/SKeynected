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
        $query = "SELECT * FROM projects";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getProjectsByID($project_id)
    {
        $query = "SELECT * FROM projects WHERE project_id = :project_id";
        $stmt = $this->db->prepare($query);
        $params = [':project_id' => $project_id];
        $stmt->execute($params);
        return $stmt->fetch();
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
}
