<?php

include_once '../../core/Database.php';

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
            $stmt->bindParam(':project_id', $projectId, PDO::PARAM_INT);
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
            $query = "INSERT INTO project(project_id, plans) VALUES (:project_id, :plans)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':project_id', $projectId, PDO::PARAM_INT);
            $stmt->bindParam(':plan', $plan, PDO::PARAM_STR);
            $stmt->execute();
            return true; 
        } catch (PDOException $e) {
            throw new RuntimeException('Failed to add project plan', 0, $e);
        }
    }
}
