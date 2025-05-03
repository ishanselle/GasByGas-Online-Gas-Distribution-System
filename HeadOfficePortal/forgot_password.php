<?php
// Include PHPMailer manually
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'db_connection.php';

$message = ""; // Initialize message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM add_admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['id'];

        // Generate a unique token
        $token = bin2hex(random_bytes(50));

        // Store the token in the database
        $stmt = $conn->prepare("UPDATE add_admin SET reset_token = ?, reset_token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE id = ?");
        $stmt->bind_param("si", $token, $userId);
        $stmt->execute();

        // Send email with reset link using PHPMailer
        $resetLink = "http://localhost/gasbygas/reset_password.php?token=$token"; // Replace with your domain

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'sithumiaparekkage16@gmail.com'; // Replace with your email
            $mail->Password = 'scldizfdyfkcaiui'; // Replace with your email password or app-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('sithumiaparekkage16@gmail.com', 'GasByGas');
            $mail->addAddress('dhananjayaanuradha4@gmail.com', 'user'); // Add a recipient

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "Click the following link to reset your password: <a href='$resetLink'>$resetLink</a>";

            $mail->send();
            $message = "Password reset link has been sent to your email.";
        } catch (Exception $e) {
            $message = "Failed to send reset link. Error: {$mail->ErrorInfo}";
        }
    } else {
        $message = "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
        <form action="forgot_password.php" method="POST">
            <h1>Forgot Password</h1>
            <!-- Display the message in a styled box -->
            <?php if (!empty($message)): ?>
                <div class="message-box <?php echo strpos($message, 'Failed') === false ? 'success' : 'error'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <div class="input-box">
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <button type="submit" class="btn">Reset Password</button>
        </form>
    </div>
</body>
</html>