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
        $Full_Name = $conn->real_escape_string(trim($_POST['fullName']));
        $Username = $conn->real_escape_string(trim($_POST['username']));
        $Password = trim($_POST['password']);
        $NIC = $conn->real_escape_string(trim($_POST['nic']));
        $P_Number = $conn->real_escape_string(trim($_POST['phone']));
        $E_Address = $conn->real_escape_string(trim($_POST['email']));

        // Validation flags
        $errors = [];

        // Validate Full Name
        if (empty($Full_Name)) {
            $errors[] = "Full Name is required.";
        }

        // Validate Password
        if (strlen($Password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        } else {
            // Encrypt the password
            // No password hashing
        }

        // Validate NIC
        if (!preg_match("/^[0-9Vv]{10,12}$/", $NIC)) {
            $errors[] = "Invalid NIC number. It should be 10-12 characters long with numbers and optionally 'V/v'.";
        }

        // Validate Phone Number
        if (!preg_match("/^[0-9]{10}$/", $P_Number)) {
            $errors[] = "Invalid phone number. It should be exactly 10 digits.";
        }

        // Validate Email
        if (!filter_var($E_Address, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email address format.";
        }

        // Check if NIC or Email already exists
        //$checkQuery = "SELECT * FROM customer_registration WHERE NIC = '$NIC' OR E_Address = '$E_Address'";
        //$checkResult = $conn->query($checkQuery);

        //if ($checkResult->num_rows > 0) {
       //     $errors[] = "NIC or Email already exists. Please try with different credentials.";
        //}

        // If no errors, insert the data into the database
        if (empty($errors)) {
            $insertQuery = "INSERT INTO customer_registration (Full_Name, Username, Password, NIC, P_Number, E_Address)
                            VALUES ('$Full_Name', '$Username', '$Password', '$NIC', '$P_Number', '$E_Address')";

            if ($conn->query($insertQuery) === TRUE) {
                echo "<script>
                        alert('Registration successful!');
                        window.location.href = 'GasByGas_C_Login.html';
                      </script>";
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        } else {
            // Display errors
            foreach ($errors as $error) {
                echo "<script>
                        alert('$error');
                        window.location.href = 'Customer_Registration.html';
                      </script>";
            }
        }
    }

    // Close the connection
    $conn->close();
    ?>
</body>
</html>