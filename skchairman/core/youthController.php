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

    public function getBarangay() {
        $query = "SELECT * FROM barangays";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
