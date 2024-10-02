<?php
session_start();
require('dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $project_name = $_POST['project'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $description = $_POST['description'];
    $status = 'Pending'; // Default project status
    $total_cost = isset($_POST['total_cost']) ? $_POST['total_cost'] : 0.00; // Default or input from form
    $user_id = $_SESSION['user_id']; // Get user_id from session

    // Debugging output
    echo "Start Date: " . $start; // Check what is captured
    echo "End Date: " . $end; // Check what is captured
    echo "Description: " . $description; // Check what is captured

    // Generate a unique project code (SKP-0001 format)
    $sql_code = "SELECT MAX(project_id) AS last_id FROM projects";
    $result = $con->query($sql_code);
    $row = $result->fetch_assoc();
    $last_id = $row['last_id'] + 1;
    $project_code = 'SKP-' . str_pad($last_id, 6, '0', STR_PAD_LEFT);

    // Prepare an insert statement
    $sql = "INSERT INTO projects (project_code, user_id, project_name, status, total_cost, description, start_date, end_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $con->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sissssss", $project_code, $user_id, $project_name, $status, $total_cost, $description, $start, $end);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect or show success message
            echo "<script>alert('Project added successfully!'); window.location.href='../budget-request.php';</script>";
        } else {
            // Handle errors
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle errors in preparing the statement
        echo "Error preparing query: " . $con->error;
    }

    // Close the database connection
    $con->close();
}
?>
