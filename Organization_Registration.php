<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="GasByGas_C_Login.css">
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $B_Name = $conn->real_escape_string(trim($_POST['businessName']));
    $BR_Number = $conn->real_escape_string(trim($_POST['registrationNumber']));
    $P_Number = $conn->real_escape_string(trim($_POST['contactPhone']));
    $E_Address = $conn->real_escape_string(trim($_POST['contactEmail']));
    $Username = $conn->real_escape_string(trim($_POST['username']));
    $Password = trim($_POST['password']);

    // Validation flags
    $errors = [];

    // Validate Business Name
    if (empty($B_Name)) {
        $errors[] = "Business Name is required.";
    }

    // Validate Registration Number
    if (empty($BR_Number)) {
        $errors[] = "Business Registration Number is required.";
    }

    // Validate Phone Number
    if (!preg_match("/^[0-9]{10}$/", $P_Number)) {
        $errors[] = "Invalid phone number. It should be exactly 10 digits.";
    }

    // Validate Email
    if (!filter_var($E_Address, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address format.";
    }

    // Validate Password
    if (strlen($Password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    } else {
        // Encrypt the password
        // No password hashing
    }

    // Check if Registration Number or Email already exists
    $checkQuery = "SELECT * FROM organization_registration WHERE BR_Number = '$BR_Number' OR E_Address = '$E_Address'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        $errors[] = "Registration Number or Email already exists. Please try with different credentials.";
    }

    // If no errors, insert the data into the database
    if (empty($errors)) {
        $insertQuery = "INSERT INTO organization_registration (B_Name, BR_Number, P_Number, E_Address, Username, Password)
                        VALUES ('$B_Name', '$BR_Number', '$P_Number', '$E_Address', '$Username', '$Password')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "<script>
                    alert('Registration successful!');
                    window.location.href = 'Login.php';
                  </script>";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<script>
                    alert('$error');
                    window.location.href = 'organization_registration.html';
                  </script>";
        }
    }
}
// Close the connection
$conn->close();
?>

</body>
</html>