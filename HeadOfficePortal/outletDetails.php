<?php
// Include database connection
include 'db_connection.php';

// Fetch outlet details from database
$sql = "SELECT outlet_id, outlet_name, phone_number, email, district, outlet_address, full_gas_stock, gas_stock_2_3kg, gas_stock_5_0kg, gas_stock_12_5kg, gas_stock_37_5kg, stock_status FROM gas_outlet_details";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Outlet Details | GasByGas Online</title>
    <link rel="stylesheet" href="outletDetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="top-right">
        <a href="dashboardHO.php" class="btn go-back-btn">Back</a>
    </div>

    <div class="content">
        <h1>Registered Outlet Details</h1>
    </div>

    <div class="wrapper">
        <table id="outletDetailsTable">
            <thead>
                <tr>
                    <th>Outlet ID</th>
                    <th>Outlet Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>District</th>
                    <th>Address</th>
                    <th>Gas Stock</th>
                    <th>Gas Stock(2.3kg)</th>
                    <th>Gas Stock(5kg)</th>
                    <th>Gas Stock(12.5kg)</th>
                    <th>Gas Stock(37.5kg)</th>
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
                        echo "<td>" . $row['phone_number'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['district'] . "</td>";
                        echo "<td>" . $row['outlet_address'] . "</td>";
                        echo "<td>" . $row['full_gas_stock'] . "</td>";
                        echo "<td>" . $row['gas_stock_2_3kg'] . "</td>";
                        echo "<td>" . $row['gas_stock_5_0kg'] . "</td>";
                        echo "<td>" . $row['gas_stock_12_5kg'] . "</td>";
                        echo "<td>" . $row['gas_stock_37_5kg'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No outlet details found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
