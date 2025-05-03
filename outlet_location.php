<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="GasByGas_Customer.css">
    <title>Customer</title>
</head>
<body>
    <?php
    // Database connection
    $con = mysqli_connect("localhost", "root", "ishan@2001", "gasbygas");

    // Check connection
    if (!$con) {
        echo "Connection Failed: " . mysqli_connect_error();
    }
    ?>
</body>
</html>
