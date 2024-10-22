<?php

include_once 'Database.php';

class projectController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }


    public function createProject(
        $project_name,
        $project_code,
        $project_description,
        $project_duration,
        $status,
        $specific_job,
        $operations,
        $total_cost,
        $proposal_file_path,
        $materials,
        $sk_member_id,
        $barangay_id
    ) {
        $this->db->beginTransaction();

        try {

            $query = "INSERT INTO projects(project_name, project_code, project_description, project_duration, status, specific_job, operations, total_cost, proposal_file_path, sk_member_id, barangay_id) 
                      VALUES (:project_name, :project_code, :project_description, :project_duration, :status, :specific_job, :operations, :total_cost, :proposal_file_path, :sk_member_id, :barangay_id)";
            $stmt = $this->db->prepare($query);


            $params = [
                ':project_name' => $project_name,
                ':project_code' => $project_code,
                ':project_description' => $project_description,
                ':project_duration' => $project_duration,
                ':status' => $status,
                ':specific_job' => $specific_job,
                ':operations' => $operations,
                ':total_cost' => $total_cost,
                ':proposal_file_path' => $proposal_file_path,
                ':sk_member_id' => $sk_member_id,
                ':barangay_id' => $barangay_id
            ];
            $stmt->execute($params);


            $project_id = $this->db->lastInsertId();


            $materials = json_decode($materials, true);
            $materialQuery = "INSERT INTO materials(project_id, material_name, quantity, amount) 
                              VALUES (:project_id, :material_name, :quantity, :amount)";
            $materialStmt = $this->db->prepare($materialQuery);

            foreach ($materials as $material) {
                $materialParams = [
                    ':project_id' => $project_id,
                    ':material_name' => $material['materialName'],
                    ':quantity' => $material['quantity'],
                    ':amount' => $material['amount'],
                ];
                $materialStmt->execute($materialParams);
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }


    public function getProjects($sk_member_id)
    {
        // Corrected query to fetch projects by sk_member_id
        $query = "
            SELECT 
                p.*, 
                b.id AS barangay_id, 
                b.name AS barangay_name, 
                sm.position AS sk_member_position,
                sm.name AS sk_member_name
            FROM 
                projects p
            INNER JOIN 
                sk_members sm ON p.sk_member_id = sm.id
            INNER JOIN 
                barangays b ON sm.barangay_id = b.id
            WHERE 
                p.sk_member_id = :sk_member_id
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':sk_member_id', $sk_member_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    public function getProjectByID($project_id)
    {
        $query = "SELECT * FROM projects WHERE project_id = :project_id";
        $stmt = $this->db->prepare($query);
        $params = [':project_id' => $project_id];
        $stmt->execute($params);
        return $stmt->fetch();
    }

    public function getMaterialsByProjectId($project_id)
    {
        $query = "SELECT * FROM materials WHERE project_id = :project_id";
        $stmt = $this->db->prepare($query);
        $params = [':project_id' => $project_id];
        $stmt->execute($params);
        return $stmt->fetchAll();
    }


    public function getProjectNotif()
    {
        $query = "SELECT * FROM projects WHERE status = 'Hearing'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getNotificationCount()
    {
        $query = "SELECT COUNT(*) as count FROM projects WHERE status = 'Hearing'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getMaterialsForProject($project_id)
    {
        $query = "SELECT * FROM materials WHERE project_id = :project_id";
        $stmt = $this->db->prepare($query);
        $params = [':project_id' => $project_id];


        if (!$stmt->execute($params)) {
            $errorInfo = $stmt->errorInfo();
            throw new Exception('Database error: ' . $errorInfo[2]);
        }

        $materials = $stmt->fetchAll(PDO::FETCH_ASSOC);


        if (empty($materials)) {
            throw new Exception('No materials found for this project ID.');
        }

        return $materials;
    }
    public function submitLiquidation($data, $files)
    {
        $this->db->beginTransaction();

        try {
            // Modified query to include 'status' column
            $insertLiquidationQuery = "INSERT INTO Liquidation (material_id, project_id, material_name, quantity, amount, or_image_path, status) 
                                       VALUES (:material_id, :project_id, :material_name, :quantity, :amount, :or_image_path, :status)";
            $stmt = $this->db->prepare($insertLiquidationQuery);

            $materials = json_decode($data['materials'], true);
            $projectId = $data['projectId'];

            foreach ($materials as $index => $material) {
                $base_path = '../../../';
                $uploadDir = $base_path . 'uploads/or_images/';
                $orImagePath = null;

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                if (isset($files["orImage_{$index}"]) && $files["orImage_{$index}"]['error'] === UPLOAD_ERR_OK) {
                    $tmp_name = $files["orImage_{$index}"]['tmp_name'];
                    $name = basename($files["orImage_{$index}"]['name']);
                    $orImagePath = $uploadDir . uniqid('or_image_', true) . '_' . $name;

                    if (!move_uploaded_file($tmp_name, $orImagePath)) {
                        throw new Exception('Failed to move uploaded file.');
                    }
                }

                // Bind parameters including the default status 'pending'
                $status = 'pending';
                $stmt->bindParam(':material_id', $material['materialId']);
                $stmt->bindParam(':project_id', $projectId);
                $stmt->bindParam(':material_name', $material['name']);
                $stmt->bindParam(':quantity', $material['quantity']);
                $stmt->bindParam(':amount', $material['amount']);
                $stmt->bindParam(':or_image_path', $orImagePath);
                $stmt->bindParam(':status', $status); // Binding 'pending' status

                if (!$stmt->execute()) {
                    throw new Exception('Failed to insert liquidation detail: ' . implode(', ', $stmt->errorInfo()));
                }
            }

            // Commit the transaction
            $this->db->commit();
            return true; // Success
        } catch (Exception $e) {
            // Roll back the transaction in case of failure
            $this->db->rollBack();
            throw $e; // Rethrow exception to handle it elsewhere
        }
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


    public function getTasks($project_id)
    {
        $sql = "SELECT id AS task_id, 
                       name, 
                       description, 
                       status, 
                       createdAt, 
                       updatedAt 
                FROM tasks 
                WHERE project_id = :project_id 
                ORDER BY createdAt DESC"; // Or updatedAt DESC based on your preference

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT); // Bind the project_id parameter
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all tasks for the given project_id
    }


    public function addTask($project_id, $name, $description, $status)
    {
        try {

            $sql = "INSERT INTO tasks (project_id, name, description, status)
                VALUES (:project_id, :name, :description, :status)";


            $stmt = $this->db->prepare($sql);


            $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "Task added successfully!";
            } else {
                return "Failed to add the task.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function updateTask($task_id, $project_id, $name, $description, $status)
    {
        try {
            $sql = "UPDATE tasks SET name = :name, description = :description, status = :status 
                WHERE id = :task_id AND project_id = :project_id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
            $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }


}

