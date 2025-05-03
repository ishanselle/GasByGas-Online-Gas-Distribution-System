<?php
// Start the session
session_start();

// Database connection
$host = 'localhost'; // Replace with your database host
$dbname = 'gasbygas'; // Replace with your database name
$user = 'root'; // Replace with your database username
$pass = 'ishan@2001'; // Replace with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$error = ""; // Initialize error message

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Fetch user from the database
    $stmt = $pdo->prepare("SELECT username, Password FROM outlet_manager_regis WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Validate the password
    if ($user && $password === $user['Password']) { 
        // Store username in session
        $_SESSION['username'] = $user['username'];
		
		// Set success message
        $_SESSION['successMessage'] = "Login successful! Welcome " . $user['username'];

        // Redirect to manage.php
        header("refresh:0;url=managemain.php");
        exit;
    } else {
        // If invalid, set the error message
        $error = "Invalid username or password.";
      }
	}
	// Display success message if it exists
		$successMessage = "";
		if (isset($_SESSION['successMessage'])) {
			$successMessage = $_SESSION['successMessage'];
			unset($_SESSION['successMessage']); // Clear the success message after displaying
		}
	?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Login Outlet Managers</title>

    <style>
        
        body {
			background-image: url('https://media.licdn.com/dms/image/v2/D4D12AQGr5C2_TZ9VMg/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1703949537962?e=2147483647&v=beta&t=lZomZvlsNskT49G7Arppr7_-JJfAtogrDuxP_o96haU');
            font-family: Times New Roman;
            margin: 0;
            padding: 0;
            animation: fadeIn 0.8s ease-in-out;
			
        }

        /* Animation for fade-in effect */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        header {
			background-image: url('https://media.licdn.com/dms/image/v2/D4D12AQGr5C2_TZ9VMg/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1703949537962?e=2147483647&v=beta&t=lZomZvlsNskT49G7Arppr7_-JJfAtogrDuxP_o96haU');
            background-color: #4665e2;
            color: white;
            width: 100%;
            padding: 30px 0px;
			font-size: 0.7em;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        h1 {
            margin: 0;
            font-size: 2.5em;
        }

   /* Login Form Styling */
        .login-container {
            max-width: 400px;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: rgba(42, 67, 224, 0.8);
            margin-top: 150px;
            animation: fadeIn 1s ease-in-out; /* Fade-in for the login form */
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container input {
			font-family: Times New Roman;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
		.login-container input[type="username"] {
			width: 380px; 
		}
		.login-container input[type="password"] {
			width: 380px; 
		}

        .login-container button {
			font-family: Times New Roman;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
        }

        .login-container button:hover {
            background-color: rgba(36, 169, 215, 0.8);
        }
 /* Login Form sign up link Styling */
		.signup-link {
			display: inline-block;
			color: white;
			font-size: 1.2em;
			text-align: center;
			text-decoration: none; /* No underline by default */
			cursor: pointer;
			margin-top: 15px;
			margin-left: 170px;
			
		}

		.signup-link:hover {
			text-decoration: underline; /* Underline on hover */
			color: rgba(0, 255, 0, 1);
		}
		.forgot-link {
			display: inline-block;
			color: white;
			font-size: 1.2em;
			text-align: center;
			text-decoration: none; /* No underline by default */
			cursor: pointer;
			margin-top: 15px;
			margin-left: 146px;
			
		}

		.forgot-link:hover {
			text-decoration: underline; /* Underline on hover */
			color: rgba(255, 0, 0, 1);
		}
		
		.error {
			color: rgba(248, 0, 0, 0.8); 
			font-size: 1rem; 
			text-align: center; 
			margin: 15px auto; 
			width: 90%; 
			
		}
		
		.success {
			color: rgba(0, 255, 18, 0.8); 
			font-size: 1rem; 
			text-align: center;
			margin: 15px auto;
			width: 90%;
			
		}
	/* Valid password styles */
		.password-container input {
			border: 2px solid rgba(255, 0, 40, 1); /* Red border initially */
			color: rgba(255, 0, 40, 1); /* Red text initially */
			padding: 8px;
			font-size: 16px;
			outline: none;
			transition: border 0.3s, color 0.3s;
		}

		.password-container input.valid {
			border: 2px solid rgba(25, 255, 6, 0.73); /* Green border when valid */
			color: rgba(25, 255, 6, 0.73); /* Green text when valid */
		}
		




    </style>
</head>
<body>

<header>
    <div class="container">
        <h1>--- Outlet Manager Login ---</h1>
    </div>
</header>

	<div class="login-container">
		<h2>Login</h2>
		
		<!-- Display Error Message -->
			<?php if (!empty($error)): ?>
				<p class="error"><?= htmlspecialchars($error) ?></p>
			<?php endif; ?>

		<!-- Display Success Message -->
			<?php if (!empty($successMessage)): ?>
				<p class="success"><?= htmlspecialchars($successMessage) ?></p>
			<?php endif; ?>
			
		<form action="" method="POST">
			<input type="username" name="username" placeholder="Username" required>
			<div class="password-container">
				<input type="password" name="password" id="password" placeholder="Password" required>
			</div>
			<button type="submit">Login</button>
			<a href="signup.php" class="signup-link">Sign Up</a>
			<a href="resetpass.php" class="forgot-link">Forgot Password</a>
		</form>
	</div>
	
	<script>
		document.getElementById("password").addEventListener("input", function() {
			let passwordField = this;
			if (passwordField.value.length >= 8) {
				passwordField.classList.add("valid"); 
			} else {
				passwordField.classList.remove("valid"); 
			}
		});
	</script>

</body>
</html>
