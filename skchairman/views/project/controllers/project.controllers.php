<?php
define("BASE_PATH", dirname(__DIR__, 3)); // Adjust based on your directory structure
include_once BASE_PATH . '/core/Database.php';

class ProjectControllers
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // Retrieve all projects
    public function getAllProjects()
    {
        try {
            $query = "SELECT * FROM projects";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $projects;
        } catch (PDOException $e) {
            throw new RuntimeException('Failed to retrieve project data', 0, $e);
        }
    }

    public function addBudgetAllocation($projectId, $expenseType, $amount)
    {
        try {
            $query = "INSERT INTO budget_allocations (project_id, expense_type, amount) VALUES (:project_id, :expense_type, :amount)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':project_id', $projectId, PDO::PARAM_STR); // Use PDO::PARAM_STR for consistency
            $stmt->bindParam(':expense_type', $expenseType, PDO::PARAM_STR);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new RuntimeException('Failed to add budget allocation', 0, $e);
        }
    }

    public function addProjectPlan($projectId, $plan)
    {
        try {
            $query = "INSERT INTO project_plans (project_id, plans) VALUES (:project_id, :plans)"; // Ensure correct table name
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':project_id', $projectId, PDO::PARAM_STR);
            $stmt->bindParam(':plans', $plan, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new RuntimeException('Failed to add project plan', 0, $e);
        }
    }

    public function addProject($projectId, $projectCode, $projectName, $projectDescription, $totalCost, $startDate, $endDate)
    {
        try {
            $query = "INSERT INTO projects (project_id, project_code, project_name, description, total_cost, start_date, end_date) VALUES (:project_id, :project_code, :project_name, :description, :total_cost, :start_date, :end_date)";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':project_id', $projectId, PDO::PARAM_STR);
            $stmt->bindParam(':project_code', $projectCode, PDO::PARAM_STR);
            $stmt->bindParam(':project_name', $projectName, PDO::PARAM_STR);
            $stmt->bindParam(':description', $projectDescription, PDO::PARAM_STR);
            $stmt->bindParam(':total_cost', $totalCost, PDO::PARAM_STR);
            $stmt->bindParam(':start_date', $startDate, PDO::PARAM_STR);
            $stmt->bindParam(':end_date', $endDate, PDO::PARAM_STR);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw new RuntimeException('Failed to add project', 0, $e);
        }
    }



    public function getNextProjectId()
    {
        try {
            $query = "SELECT MAX(project_id) AS last_id FROM projects";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['last_id'] ? $row['last_id'] + 1 : 1;
        } catch (PDOException $e) {
            throw new RuntimeException('Failed to retrieve project ID', 0, $e);
        }
    }

    public function getProjectById($projectId)
    {
        $query = "SELECT * FROM projects WHERE project_id = :projectId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
