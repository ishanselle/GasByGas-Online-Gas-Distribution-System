<?php
include 'db_connection.php'; // Include the database connection

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $query = "SELECT name, email FROM add_admin WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($name, $email);
    $stmt->fetch();

    $data = [
        'name' => $name,
        'email' => $email
    ];

    echo json_encode($data);

    $stmt->close();
} else {
    echo json_encode(['error' => 'Username not provided']);
}

$conn->close();
?>
