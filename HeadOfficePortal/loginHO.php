<?php
session_start(); // Start the session

include 'db_connection.php'; // Include database connection

// Initialize error message variable
$errorMessage = "";

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL query to get the password
    $stmt = $conn->prepare("SELECT password FROM add_admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if username exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password']; // Get the stored hashed password

        // Compare the entered password with the stored hashed password
        if (password_verify($password, $storedPassword)) {
            // Password is correct, login user
            $_SESSION['admin_name'] = $username;  // Set correct session variable

            // Remember me functionality
            if (isset($_POST['remember'])) {
                setcookie("username", $username, time() + (86400 * 30), "/"); // 30 days
            }

            // Redirect to dashboard
            header("Location: dashboardHO.php");
            exit;
        } else {
            // Incorrect password
            $errorMessage = "Incorrect password!";
        }
    } else {
        // Username does not exist
        $errorMessage = "Username not found!";
    }
}

// Fetch existing usernames for dropdown
$usernameQuery = "SELECT username FROM add_admin";
$usernameResult = $conn->query($usernameQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Head Office Portal</title>
    <link rel="stylesheet" href="loginHO.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <form action="loginHO.php" method="POST">
            <h1>Login</h1>

            <!-- Username dropdown -->
            <div class="input-box">
                <select name="username" required>
                    <option value="">Select Username</option>
                    <?php while ($row = $usernameResult->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($row['username']); ?>">
                            <?php echo htmlspecialchars($row['username']); ?>
                        </option>
                    <?php } ?>
                </select>
                <i class="fas fa-user-circle"></i>
            </div>

            <!-- Password input -->
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>

            <!-- Remember me and forgot password links -->
            <div class="remember-forgot">
                <label><input type="checkbox" name="remember"> Remember Me</label>
                <a href="forgot_password.php">Forgot Password?</a>
            </div>

            <!-- Login button -->
            <button type="submit" class="btn">Login</button>

            <!-- Display error message if any -->
            <?php
            if (!empty($errorMessage)) {
                echo "<p style='color: red;'>$errorMessage</p>";
            }
            ?>
        </form>
    </div>
</body>
</html>