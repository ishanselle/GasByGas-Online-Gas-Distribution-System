<?php
$servername = "localhost";
$username = "root";
$password = "ishan@2001";
$dbname = "gasbygas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['adminName']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Password pattern check (Optional)
    $password_pattern = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    if (!preg_match($password_pattern, $password)) {
        echo "<script>
                alert('Password must be at least 8 characters long, include one uppercase letter, one lowercase letter, one number, and one special character.');
                window.history.back();
              </script>";
        exit();
    }

    if ($password !== $confirm_password) {
        echo "<script>
                alert('Passwords do not match.');
                window.history.back();
              </script>";
        exit();
    }

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the admin with the hashed password
    $stmt = $conn->prepare("INSERT INTO add_admin (name, username, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "<script>
                alert('Admin profile added successfully!');
                window.location.href = 'adminM.html';
              </script>";
    } else {
        echo "<script>
                alert('Error: Unable to add admin profile. Please try again.');
                window.history.back();
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>