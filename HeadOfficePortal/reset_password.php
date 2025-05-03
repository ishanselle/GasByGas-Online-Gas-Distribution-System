<?php
include 'db_connection.php';

$message = ""; // Initialize message variable
$token = ""; // Initialize token variable

// Check if token is provided in the URL (GET request)
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if token is valid and not expired
    $stmt = $conn->prepare("SELECT id FROM add_admin WHERE reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $message = "Invalid or expired token.";
    }
}

// Handle form submission (POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
    $token = $_POST['token']; // Get token from hidden input
    $newPassword = $_POST['password'];

    // Check if token is valid and not expired
    $stmt = $conn->prepare("SELECT id FROM add_admin WHERE reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['id'];

        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password and clear reset token
        $stmt = $conn->prepare("UPDATE add_admin SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?");
        $stmt->bind_param("si", $hashedPassword, $userId);

        if ($stmt->execute()) {
            $message = "Password has been reset successfully.";
        } else {
            $message = "Failed to reset password. Please try again.";
        }
    } else {
        $message = "Invalid or expired token.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="loginHO.css">
    <style>
        .top-right {
    position: absolute;
    top: 20px;
    right: 20px;
}

.go-login-btn {
    background: #ffa500;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    padding: 10px 20px;
    border-radius: 8px;
    transition: background-color 0.3s ease;
}

.go-login-btn:hover {
    background-color: #e69500;
}
        /* Styling for the message box */
        .message-box {
            padding: 10px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
<div class="top-right">
        <a href="loginHO.php" class="btn go-login-btn">Back</a>
    </div>
    <div class="wrapper">
        <form action="reset_password.php" method="POST">
            <h1>Reset Password</h1>
            <!-- Display the message in a styled box -->
            <?php if (!empty($message)): ?>
                <div class="message-box <?php echo strpos($message, 'successfully') !== false ? 'success' : 'error'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <!-- Hidden input to store the token -->
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <div class="input-box">
                <input type="password" name="password" placeholder="Enter new password" required>
            </div>
            <button type="submit" class="btn">Reset Password</button>
        </form>
    </div>
</body>
</html>