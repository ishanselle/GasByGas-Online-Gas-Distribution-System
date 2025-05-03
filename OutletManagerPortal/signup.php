<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Signup Page</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }
        body {
            background-image: url('https://media.licdn.com/dms/image/D4D12AQETIYFFPLWKTQ/article-cover_image-shrink_720_1280/0/1700778169965?e=2147483647&v=beta&t=gjpEbP4GNZa3IecJ4E109qrqAiegTyU34vqhSfOEWNA');
            background-size: cover;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        header {
            background-image: url('https://media.istockphoto.com/id/1368776209/vector/petroleum-oil-refinery-complex-panorama-business-concept-finance-economy-polygonal.jpg?s=612x612&w=0&k=20&c=Ug005I9SoWDJRV30iF3LbI1zI1L5BUVgICoACrO6MUo=');
            width: 100%;
            color: white;
            padding: 30px 0px;
            text-align: center;
            font-size: 1.5em;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .signup-container {
            background: rgba(42, 67, 224, 0.8);
			padding: 20px;
			border-radius: 20px;
			border: 2px solid rgba(0, 0, 0, 0.1); /* Adds a subtle border */
			box-shadow: 0 40px 10px rgba(32, 230, 137, 0.49); /* Enhances shadow depth */
			width: 300px;
			margin-top: 80px;
		}
        .signup-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .signup-container input {
            font-family: Times New Roman;
            width: calc(100% - 40px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding-right: 35px;
        }
		.input-container{
            position: relative;
            margin-bottom: 15px;
        }
		.input-container input {
           font-family: Times New Roman;
            width: calc(100% - 40px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding-right: 35px;;
        }
        .input-container i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }
		
        .password-container {
            position: relative;
            margin-bottom: 15px;
        }
        .password-container input {
           font-family: Times New Roman;
            width: calc(100% - 40px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding-right: 35px;;
        }
        .password-container i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }
		.password-container input.valid {
			border: 2px solid rgba(25, 255, 6, 0.73); /* Green border when valid */
			color: rgba(25, 255, 6, 0.73); /* Green text when valid */
		}
        .signup-container button {
            font-family: Times New Roman;
            width: 310px;
            padding: 10px;
            background: rgba(27, 15, 204, 0.8);
            color: #fff;
            font-size: 1.2em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .signup-container button:hover {
            background: rgba(15, 238, 59, 0.74);
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: -10px;
        }
        .success {
			background: rgba(16, 234, 100, 1);
            color: rgba(0, 0, 0, 0.99);
            font-size: 1.2em;
            text-align: center;
			border-radius: 8px;
        }
    </style>
</head>
<body>
    <header>
        ----Welcome to Signup Page----
    </header>
    <div class="signup-container">
       <?php
			$error = '';
			$successMessage = '';
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Get the form values
			$username = trim($_POST['username']);
			$email = trim($_POST['email']);
			$password = trim($_POST['password']);
			$confirmpassword = trim($_POST['confirmpassword']);

			// Check if any required field is empty
			if (empty($username) || empty($email) || empty($password) || empty($confirmpassword)) {
				$error = "All fields are required.";
			} 
			// Check if the email format is valid
			elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error = "Invalid email format.";
			}
			// Password validation: Minimum 8 characters, at least one number and one special character
			elseif (!preg_match('/^(?=.*[0-9])(?=.*[@#\/])[A-Za-z0-9@#\/]{8,}$/', $password)) {
				$error = "Password must be at least 8 characters long, include at least one number, and one special character (@, #, /).";
			}
			// Check if the password and confirm password match
			elseif ($password !== $confirmpassword) {
				$error = "Passwords do not match.";
			} else {
				// If no errors, connect to the database
				$conn = new mysqli('localhost', 'root', 'ishan@2001', 'gasbygas');
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				// Prepare the SQL statement to insert the plain text password
				if ($stmt = $conn->prepare("INSERT INTO outlet_manager_regis (username, email, password, confirmpassword) VALUES (?, ?, ?, ?)")) {
					$stmt->bind_param("ssss", $username, $email, $password, $confirmpassword);
					if ($stmt->execute()) {
						$successMessage = "Signup successful! You can now log in.";
					} else {
						$error = "Error executing query: " . $stmt->error;
					}
					$stmt->close();
				} else {
					$error = "Error preparing statement: " . $conn->error;
				}
				// Close the database connection
				$conn->close();
			}
		}
		?>


        <?php if ($successMessage): ?>
            <p class="success"><?= htmlspecialchars($successMessage); ?></p>
			<script>
				setTimeout(() => {
					window.location.href = 'loginmanager.php';
				}, 3000); // Redirect after 3 seconds
			</script>
        <?php else: ?>
            <h2>--Sign Up--</h2>
            <form action="" method="POST">
				<div class="input-container">
					<input type="text" name="username" placeholder="Username" required>
					  <i class="fas fa-user icon"></i>
				</div>
				<div class="input-container">
                <input type="email" name="email" placeholder="Email" required>
				<i class="fas fa-envelope icon"></i>
				</div>
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <i class="fas fa-eye toggle-icon" id="togglePassword"></i>
                </div>
                <div class="password-container">
                    <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required>
                    <i class="fas fa-eye toggle-icon" id="toggleConfirmPassword"></i>
                </div>
                <?php if (!empty($error)): ?>
                    <p class="error"><?= htmlspecialchars($error); ?></p>
                <?php endif; ?>
                <button type="submit">Sign Up</button>
            </form>
        <?php endif; ?>
    </div>

    <script>
		document.querySelectorAll('.toggle-icon').forEach(icon => {
			icon.addEventListener('click', () => {
				const input = icon.previousElementSibling;

				if (input.getAttribute('type') === 'password') {
					// Show password
					input.setAttribute('type', 'text');
					icon.classList.remove('fa-eye-slash');        // Remove the "open eye" icon
					icon.classList.add('fa-eye');    // Add the "closed eye" icon
				} else {
					// Hide password
					input.setAttribute('type', 'password');
					icon.classList.remove('fa-eye'); // Remove the "closed eye" icon
					icon.classList.add('fa-eye-slash');         // Add the "open eye" icon
				}
			});
		});
	</script>
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
