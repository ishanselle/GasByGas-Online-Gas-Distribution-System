<?php
// Include your database connection file
include 'db_connection.php';

// Fetch all users with plain-text passwords
$query = "SELECT id, password FROM add_admin";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $plainPassword = $row['password'];

        // Hash the plain-text password
        $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

        // Update the user's password with the hashed version
        $stmt = $conn->prepare("UPDATE add_admin SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashedPassword, $id);

        if ($stmt->execute()) {
            echo "Password for user ID $id has been hashed successfully.<br>";
        } else {
            echo "Error updating password for user ID $id: " . $stmt->error . "<br>";
        }
    }
} else {
    echo "No users found in the database.";
}

// Close the database connection
$conn->close();
?>