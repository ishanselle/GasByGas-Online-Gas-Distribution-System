<?php
// Include database connection
include 'db_connection.php';

// Fetch outlet details from database
$sql = "SELECT outlet_id, outlet_name, name, phone_number, email, token, gas_type, quantity, Payment, token_status, record_date, expiry_date FROM gas_token_details";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Token Details|GasByGas Online</title>
    <link rel="stylesheet" href="tokenDetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="top-right">
        <a href="dashboardHO.php" class="btn go-back-btn">Back</a>
    </div>

    <div class="content">
        <h1>Issued Token Details</h1>
    </div>

    <div class="wrapper">
        <table id="issuedTokenDetailsTable">
            <thead>
            <tr>
                    <th>Outlet ID</th>
                    <th>Outlet Name</th>
                    <th>Customer Name</th>
                    <th>Mobile Number</th>
                    <th>Token ID</th>
                    <th>Issued Date</th>
                    <th>Expiry Date</th>
                    <th>Token Status</th>
            </tr>
            </thead>
            <tbody>
                <?php
                // Display each row of data
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['outlet_id'] . "</td>";
                        echo "<td>" . $row['outlet_name'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['phone_number'] . "</td>";
                        echo "<td>" . $row['token'] . "</td>";
                        echo "<td>" . $row['record_date'] . "</td>";
                        echo "<td>" . $row['expiry_date'] . "</td>";
                        echo "<td>" . $row['token_status'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No outlet details found.</td></tr>";
                }
                ?>
            </tbody>
                </tr>
            </thead>
            
        </table>
    </div>

</body>
</html>
