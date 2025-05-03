<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['Username'])) {
    header("Location: GasByGas_Customer.php");
    exit();
}

// Database credentials
$servername = "localhost";
$username_db = "root";
$password_db = "ishan@2001";
$dbname = "gasbygas";

// Create a connection to the database
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $username = $_SESSION['Username']; // Username from session
    $name = htmlspecialchars(trim($_POST['name']));
    $contactNo = htmlspecialchars(trim($_POST['contactNo']));
    $email = htmlspecialchars(trim($_POST['email']));
    $gasType = htmlspecialchars(trim($_POST['gasType']));
    $outletName = htmlspecialchars(trim($_POST['outlet']));
    $outletID = htmlspecialchars(trim($_POST['Outlet_ID']));
    $quantity = (int)$_POST['quantity'];
    $day = htmlspecialchars(trim($_POST['day']));

    // Validate required fields
    if (empty($name) || empty($contactNo) || empty($email) || empty($gasType) || empty($outletName) || empty($outletID) || empty($quantity) || empty($day)) {
        echo "<script>alert('Please fill in all fields!');</script>";
    } else {
        // Prepare the SQL query to insert the data into the `gas_request` table
        $sql = "INSERT INTO gas_request (Username, Name, P_number, Email, Gas_Type, Outlet_name, Outlet_id, Quantity, Gas_Req_day)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind the parameters to the prepared statement
            $stmt->bind_param("sssssssis", $username, $name, $contactNo, $email, $gasType, $outletName, $outletID, $quantity, $day);

            // Execute the query
            if ($stmt->execute()) {
                echo "<script>alert('Gas request submitted successfully!'); 
                window.location.href='GasByGas_Customer.php';</script>";
            } else {
                echo "<script>alert('Error submitting request: " . $stmt->error . "');</script>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
        }
    }
}

// Close the database connection
$conn->close();
?>
