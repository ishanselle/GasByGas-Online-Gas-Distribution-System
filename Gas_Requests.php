<?php
session_start(); // Start the session

// Database connection
$servername = "localhost";
$username_db = "root";
$password_db = "ishan@2001";
$dbname = "gasbygas";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if all required fields are set
if (
    isset($_POST['username'], $_POST['name'], $_POST['contactNo'], $_POST['email'],
          $_POST['gasType'], $_POST['outlet'], $_POST['Outlet_ID'], $_POST['quantity'], $_POST['day'])
) {
    // Retrieve form data
    $Uname = $_POST['username'];
    $name = $_POST['name'];
    $cno = $_POST['contactNo'];
    $Email = $_POST['email'];
    $Gas_Type = $_POST['gasType'];
    $Outlet_ID = $_POST['Outlet_ID'];
    $quantity = $_POST['quantity'];
    $Day = $_POST['day'];

    // Fetch Outlet Name using Outlet_ID
    $stmt = $conn->prepare("SELECT outlet_name FROM gas_outlet_details WHERE outlet_id = ?");
    $stmt->bind_param("s", $Outlet_ID);
    $stmt->execute();
    $stmt->bind_result($Outlet);
    $stmt->fetch();
    $stmt->close();

    if (!$Outlet) {
        echo "Error: Invalid Outlet ID.";
        exit();
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO gas_request (Username, Name, P_number, Email, Gas_Type, Outlet_name, Outlet_id, Quantity, Gas_Req_day)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssds", $Uname, $name, $cno, $Email, $Gas_Type, $Outlet, $Outlet_ID, $quantity, $Day);

    if ($stmt->execute()) {
        echo "<script>
                alert('Gas request submitted successfully.');
                window.location.href='GasByGas_Customer.php';
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: Missing required form data.";
}

$conn->close();
?>
