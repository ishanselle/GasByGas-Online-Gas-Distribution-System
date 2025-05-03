<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Reset Password</title>
    <style>
        body {
            background-image: url('https://media.licdn.com/dms/image/v2/D4D12AQGr5C2_TZ9VMg/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1703949537962?e=2147483647&v=beta&t=lZomZvlsNskT49G7Arppr7_-JJfAtogrDuxP_o96haU');
            background-size: cover;
            background-position: center;
            font-family: "Times New Roman", serif;
            margin: 0;
            padding: 0;
            animation: fadeIn 0.8s ease-in-out;
        }

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
            color: white;
            width: 100%;
            padding: 30px 0px;
			font-size: 0.7em;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .reset-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: rgba(42, 67, 224, 0.8);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        .reset-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }

        .reset-container .form-group {
            position: relative;
            margin-bottom: 15px;
        }

        .reset-container input {
            font-family: "Times New Roman", serif;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        .reset-container .toggle-icon {
            position: absolute;
            top: 38px;
            right: 20px; /* Adjust distance from the right edge */
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
			font-size: 1.2em; /* Adjust the size of the icon */
        }
		.form-group .fa-user {
			position: absolute;
			top: 38px;
			right: 20px; /* Adjust distance from the right edge */
			transform: translateY(-50%);
			font-size: 1.2em; /* Adjust the size of the icon */
			color: #666;
			pointer-events: none; /* Prevent icon from blocking input interaction */
		}

        .reset-container button {
            font-family: "Times New Roman", serif;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
        }

        .reset-container button:hover {
            background-color: rgba(36, 169, 215, 0.8);
        }

        .message {
            text-align: center;
            margin-top: 10px;
            color: white;
        }
		
	/* Validation password input styles */
		.password-container input {
			border: 2px solid rgba(255, 0, 40, 1); /* Red border initially */
			color: rgba(255, 0, 40, 1); /* Red text initially */
			padding: 8px;
			font-size: 16px;
			outline: none;
			transition: border 0.3s, color 0.3s;
		}

		/* When password is valid */
		.password-container input.valid {
			border: 2px solid rgba(25, 255, 6, 0.73); /* Green border */
			color: rgba(25, 255, 6, 0.73); /* Green text */
		}
    </style>
</head>
<body>
<header>
    <h1>--- Reset Password ---</h1>
</header>

	<div class="reset-container">
		<form id="reset-password-form" method="POST" action="">
			<h2>Reset Password</h2>

			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" id="username" name="username" placeholder="Enter Username" required>
				<i class="fas fa-user"></i>
			</div>

			<div class="form-group password-container">
				<label for="newpassword">New Password</label>
				<input type="password" id="newpassword" name="newpassword" placeholder="Enter New Password" required>
				<i class="fas fa-eye toggle-icon"></i>
			</div>

			<div class="form-group password-container">
				<label for="confirm-password">Confirm Password</label>
				<input type="password" id="confirm-password" name="confirmnewpassword" placeholder="Confirm New Password" required>
				<i class="fas fa-eye toggle-icon"></i>
			</div>
			
			

			<button type="submit" name="reset">Reset Password</button>
		</form>
		<div class="message">
		<?php
			$host = 'localhost';
			$db = 'gasbygas';
			$user = 'root';
			$pass = 'ishan@2001';

			$conn = new mysqli($host, $user, $pass, $db);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset'])) {
				$username = trim($_POST['username']);
				$newpassword = trim($_POST['newpassword']);
				$confirmpassword = trim($_POST['confirmnewpassword']);

				// Password validation: Minimum 8 characters, at least one number, and one special character (@, #, /)
				if (!preg_match('/^(?=.*[0-9])(?=.*[@#\/])[A-Za-z0-9@#\/]{8,}$/', $newpassword)) {
					echo "<span style='color:red;'>Password must be at least 8 characters long, include at least one number, and one special character (@, #, /).</span>";
				}
				elseif ($newpassword !== $confirmpassword) {
					echo "<span style='color:red;'>Passwords do not match!</span>";
				} 
					else {
					$stmt = $conn->prepare("SELECT * FROM outlet_manager_regis WHERE username = ?");
					$stmt->bind_param("s", $username);
					$stmt->execute();
					$result = $stmt->get_result();

					if ($result->num_rows > 0) {
						// Update without hashed password
						$update = $conn->prepare("UPDATE outlet_manager_regis SET password = ?, confirmpassword = ? WHERE username = ?");
						$update->bind_param("sss", $newpassword, $newpassword, $username);
						if ($update->execute()) {
							echo "<span>Password and confirm password updated successfully!</span>";
							echo "<script>
									setTimeout(function() {
										window.location.href = 'loginmanager.php';
									}, 3000); // Redirect after 3 seconds
								  </script>";
						} else {
							echo "<span style='color:red;'>Error updating password: " . $conn->error . "</span>" . $conn->error;
						}
						$update->close();
					} else {
						echo "<span style='color:red;'>Username not found!</span>";;
					}

					$stmt->close();
				}
			}

			$conn->close();
			?>
	</div>
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
			document.getElementById("newpassword").addEventListener("input", function () {
			let passwordField = this;
			let password = passwordField.value;
			let passwordMessage = document.getElementById("password-message");

			// Regex: Minimum 8 chars, at least one number, and one special character (@, #, /)
			let passwordRegex = /^(?=.*[0-9])(?=.*[@#\/])[A-Za-z0-9@#\/]{8,}$/;

			if (passwordRegex.test(password)) {
				passwordField.classList.add("valid");
				passwordMessage.style.display = "none"; // Hide message
			} else {
				passwordField.classList.remove("valid");
				passwordMessage.style.display = "block"; // Show message
			}
		});

		// Confirm Password Validation
		document.getElementById("confirm-password").addEventListener("input", function () {
			let confirmPasswordField = this;
			let newPassword = document.getElementById("newpassword").value;

			if (confirmPasswordField.value === newPassword) {
				confirmPasswordField.classList.add("valid");
			} else {
				confirmPasswordField.classList.remove("valid");
			}
		});
	</script>
</body>
</html>
