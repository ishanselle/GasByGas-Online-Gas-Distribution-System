<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db_connection.php';

header('Content-Type: application/json'); // Set response type

if (isset($_GET['outlet_id']) && isset($_GET['gasType'])) {
    $outletId = intval($_GET['outlet_id']); // Ensure outlet_id is an integer
    $gasType = floatval($_GET['gasType']);  // Convert gasType to float for safety

    // Debugging logs
    error_log("Received outlet_id: $outletId, gasType: $gasType");

    // Validate gasType to ensure it's one of the allowed values
    $validGasTypes = [2.3, 5, 12.5, 37.5];
    if (!in_array($gasType, $validGasTypes)) {
        echo json_encode(['success' => false, 'message' => 'Invalid gas type']);
        exit;
    }

    // Prepare SQL query to fetch quantity
    $sql = "SELECT quantity FROM gas_token_details WHERE outlet_id = ? AND gas_type = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'SQL preparation failed']);
        exit;
    }

    $stmt->bind_param("id", $outletId, $gasType); // "i" for integer, "d" for double (float)

    if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($quantity);
            $stmt->fetch();
            echo json_encode(['success' => true, 'quantity' => $quantity]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No data found']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Query execution failed']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
}

$conn->close();
?>
