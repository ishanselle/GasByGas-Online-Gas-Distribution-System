<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="GasByGas_C_Login.css">
    <title>Customer Login</title>   
</head>
<body>
<?php
// Start the session
session_start();

// Database credentials
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "ishan@2001"; // Add your MySQL password here
$dbname = "gasbygas";

// Create a connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message
$errorMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $username = $conn->real_escape_string(trim($_POST['Username']));
    $password = trim($_POST['password']);

    // Validation flags
    if (empty($username) || empty($password)) {
        $errorMessage = "Both Username and Password are required.";
    } else {
        // Query to check `customer_registration` table
        $customerQuery = "SELECT * FROM customer_registration WHERE Username = '$username' AND Password = '$password'";
        $customerResult = $conn->query($customerQuery);

        // Query to check `organization_registration` table
        $organizationQuery = "SELECT * FROM organization_registration WHERE Username = '$username' AND Password = '$password'";
        $organizationResult = $conn->query($organizationQuery);

        if ($customerResult->num_rows > 0) {
            // Successful customer login
            $row = $customerResult->fetch_assoc();
            $_SESSION['userType'] = 'Customer';
            $_SESSION['username'] = $row['Username'];
            $_SESSION['Username'] = $row['Username'];
            echo "<script>
                    alert('Login successful as Customer!');
                    window.location.href = 'GasByGas_Customer.php';
                  </script>";
        } elseif ($organizationResult->num_rows > 0) {
            // Successful organization login
            $row = $organizationResult->fetch_assoc();
            $_SESSION['userType'] = 'Organization';
            $_SESSION['username'] = $row['Username'];
            $_SESSION['Username'] = $row['Username'];
            echo "<script>
                    alert('Login successful as Organization!');
                    window.location.href = 'GasByGas_Customer.php';
                  </script>";
        } else {
            // Invalid credentials
            $errorMessage = "Invalid Username or Password.";
            echo "<script>
                alert('Invalid Username or Password.');
                window.location.href = 'GasByGas_C_Login.html';
                  </script>";
        }
    }
}

// Close the connection
$conn->close();
?>
</body>
</html>