<?php
// Database connection (update with your database credentials)
$servername = "localhost";
$username = "root";
$password = "ishan@2001";
$dbname = "gasbygas"; // Replace with your database name

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch Business Customers
$queryBusiness = "SELECT B_Name, BR_Number, P_Number, E_Address, Username FROM organization_registration";
$resultBusiness = mysqli_query($conn, $queryBusiness);

// Fetch Individual Customers
$queryIndividual = "SELECT Full_Name, Username, NIC, P_Number, E_Address FROM customer_registration";
$resultIndividual = mysqli_query($conn, $queryIndividual);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Customers Details</title>
    <link rel="stylesheet" href="userDetails.css"> <!-- Link the CSS -->
</head>
<body>
<div class="top-right">
        <a href="dashboardHO.php" class="btn go-back-btn">Back</a>
    </div>
<div class="content">
        <h1>Registered customer Details</h1>
    </div>
    <div class="wrapper">
         <!-- Business Customers Section -->
        <div class="table-container">
            <h2>Business Customers</h2>
            <table>
                <thead>
                    <tr>
                        <th>Business Name</th>
                        <th>Business Registration Number</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultBusiness && mysqli_num_rows($resultBusiness) > 0) {
                        while ($row = mysqli_fetch_assoc($resultBusiness)) {
                            echo "<tr>
                                    <td>{$row['B_Name']}</td>
                                    <td>{$row['BR_Number']}</td>
                                    <td>{$row['P_Number']}</td>
                                    <td>{$row['E_Address']}</td>
                                    <td>{$row['Username']}</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No business customer details found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Individual Customers Section -->
        <div class="table-container">
            <h2>Individual Customers</h2>
            <table>
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>NIC</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultIndividual && mysqli_num_rows($resultIndividual) > 0) {
                        while ($row = mysqli_fetch_assoc($resultIndividual)) {
                            echo "<tr>
                                    <td>{$row['Full_Name']}</td>
                                    <td>{$row['Username']}</td>
                                    <td>{$row['NIC']}</td>
                                    <td>{$row['P_Number']}</td>
                                    <td>{$row['E_Address']}</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No individual customer details found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
