<?php
require_once 'db_connection.php';

if (isset($_POST['scheduleDelivery'])) {
    $outletId = $_POST['outletId'];
    $outletName = $_POST['outletName'];
    $handoverDate = $_POST['handoverDate'];
    $deliveryDate = $_POST['deliveryDate'];
    $gasType = $_POST['gasType'];
    $quantity = $_POST['quantity'];

    // Prepare and execute the INSERT query
    $stmt = $conn->prepare("INSERT INTO delivery_details (outlet_id, outlet_name, handover_date, delivery_date, gas_type, quantity, status) 
                            VALUES (?, ?, ?, ?, ?, ?, 'Pending')");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("issssi", $outletId, $outletName, $handoverDate, $deliveryDate, $gasType, $quantity);

    if ($stmt->execute()) {
        echo "<script>
                alert('Delivery scheduled successfully!');
                window.location.href = 'scheduleM.html';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $stmt->error . "');
                window.location.href = 'scheduleDelivery.html';
              </script>";
    }

    $stmt->close();
} else {
    echo "<script>
            alert('Invalid request');
            window.location.href = 'scheduleDelivery.html';
          </script>";
}

$conn->close();
?>
