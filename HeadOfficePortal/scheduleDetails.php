<?php
// Include database connection
include 'db_connection.php';

// Fetch outlet details from database
$sql = "SELECT id, outlet_id, outlet_name, handover_date, delivery_date, gas_type, quantity, status FROM delivery_details";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Details|GasByGas Online</title>
    <link rel="stylesheet" href="scheduleDetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="top-right">
        <a href="scheduleM.html" class="btn go-back-btn">Back</a>
    </div>

    <div class="content">
        <h1>Schedule Details</h1>
    </div>

    <div class="wrapper">
    <table id="scheduleDetailsTable">
    <thead>
        <tr>
            <th>Outlet ID</th>
            <th>Outlet Name</th>
            <th>Hand Over Date</th>
            <th>Delivery Date</th>
            <th>Gas Type</th>
            <th>Quantity</th>
            <th>Status</th>
        </tr>
    </thead>
            <tbody>
            <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['outlet_id'] . "</td>";
                echo "<td>" . $row['outlet_name'] . "</td>";
                echo "<td>" . $row['handover_date'] . "</td>";
                echo "<td>" . $row['delivery_date'] . "</td>";
                echo "<td>" . $row['gas_type'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>
                        <select onchange='updateStatus(" . $row['id'] . ", this.value)'>
                            <option value='Pending' " . ($row['status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                            <option value='In Process' " . ($row['status'] == 'In Process' ? 'selected' : '') . ">In Process</option>
                            <option value='Delivered' " . ($row['status'] == 'Delivered' ? 'selected' : '') . ">Delivered</option>
                        </select>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No scheduled deliveries found.</td></tr>";
        }
        ?>
            
        </table>
        
    </div>
    <!-- Success Message Box -->
    <div id="successMessage" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 20px; background-color: #4CAF50; color: white; border-radius: 5px; z-index: 1000; text-align: center;">
    <span id="successMessageText"></span>
</div>

    <script>
        function updateStatus(deliveryId, newStatus) {
            fetch('updateStatus.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + deliveryId + '&status=' + newStatus
            })
            .then(response => response.text())
            .then(data => {
                // Show success message
                const successMessage = document.getElementById('successMessage');
                const successMessageText = document.getElementById('successMessageText');
                successMessageText.textContent = "Status successfully updated!"; // Custom message
                successMessage.style.display = 'block';

                // Hide the message after 3 seconds
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000);
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

</body>
</html>
