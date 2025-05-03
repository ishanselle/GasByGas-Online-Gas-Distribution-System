<?php
require_once 'db_connection.php';

// Check if request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['status'])) {
        // Sanitize and validate inputs
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
        $status = $_POST['status'];
        $validStatuses = ['Pending', 'In Process', 'Delivered']; // Allowed status values
        
        if ($id === false || !in_array($status, $validStatuses)) {
            echo json_encode(["success" => false, "message" => "Invalid input."]);
            exit();
        }

        // Prepare and execute the update query
        $sql = "UPDATE delivery_details SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Status updated successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error updating status: " . $conn->error]);
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(["success" => false, "message" => "Missing parameters."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
