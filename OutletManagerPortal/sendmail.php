	<?php
		session_start();

		// Check if the user is logged in
		if (!isset($_SESSION['username'])) {
			header("Location: loginmanager.php");
			exit;
		}

		// Database connection
		$servername = "localhost";  
		$username = "root";         
		$password = "ishan@2001";             
		$dbname = "gasbygas";     

		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check database connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}


				if (isset($_POST['send'])) {
					$name = trim($_POST['name']);
					$email = trim($_POST['email']);
					$subject = trim($_POST['subject']);
					$message = trim($_POST['message']);

					if (empty($name) || empty($email) || empty($subject) || empty($message)) {
						echo "<div class='alert alert-danger text-center'>All fields are required.</div>";
					} else {
						$mail = new PHPMailer(true);

						try {
							// SMTP Settings
							$mail->isSMTP();
							$mail->Host = 'smtp.gmail.com';
							$mail->SMTPAuth = true;
							$mail->SMTPSecure = 'ssl';
							$mail->Port = 465;
							//$mail->SMTPDebug = 2; // or use 3 for more details
							
							// Fix SSL Certificate Verification Issues
							$mail->SMTPOptions = array(
								'ssl' => array(
									'verify_peer' => false,
									'verify_peer_name' => false,
									'allow_self_signed' => true
								)
							);

							// Email Headers
							$mail->addAddress($email, $name);
							$mail->Subject = $subject;
							$mail->Body = nl2br(htmlspecialchars($message));
							$mail->isHTML(true);

				// Send Email and Save to Database
				if ($mail->send()) {
					// Save email details in database
					$stmt = $conn->prepare("INSERT INTO email_details (name, email, subject, message) VALUES (?, ?, ?, ?)");
					$stmt->bind_param("ssss", $name, $email, $subject, $message);
					$stmt->execute();
					$stmt->close();

					$_SESSION['email_success'] = "Your mail was sent successfully to $email .";
				} else {
					$_SESSION['email_error'] = "Failed to send email.";
				}
			} catch (Exception $e) {
				$_SESSION['email_error'] = "Mailer Error: " . $mail->ErrorInfo;
			}

			// Redirect to prevent form resubmission
			header("Location: sendmail.php");
			exit;
		}
	}

	// Close database connection
	$conn->close();
	?>
	


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman:wght@300;400;600;700&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
    <title>Send Email</title>
</head>
<body>

	<style>
		 html, body {
			height: 100%;
			margin: 0;
			verflow: hidden;
	}
	.success-message {
        color: green;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .error-message {
        color: red;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }


		body {
			 background-image: url('https://media.licdn.com/dms/image/v2/D5612AQHUgMx0-td3mQ/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1712300078667?e=2147483647&v=beta&t=kEJoPg4J26Obn7AA9LaBhHGNdqTgq0y0KiRJGr3v_9w');
			 background-size: cover;
			 background-attachment: fixed;
			 margin: 0;
			 padding: 0;
			 display: flex;
			 flex-direction: column;
			 align-items: center;
		}

		header {
			background-color: #4665e2;
            color: white;
            width: 100%;
            padding: 30px 0px;
			background-image: url('https://media.istockphoto.com/id/1368776209/vector/petroleum-oil-refinery-complex-panorama-business-concept-finance-economy-polygonal.jpg?s=612x612&w=0&k=20&c=Ug005I9SoWDJRV30iF3LbI1zI1L5BUVgICoACrO6MUo=');
            text-align: center;
			font-size: 1.5em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			font-family: Times New Roman;
			z-index: 1000; /* Ensures it stays above other content */
		}

		.container {
			margin-top: 5px; /* Push below the header */
			margin-left: 200px; /* Push content to the right of the sidebar */
			padding: 20px;
			width: 300 px;
			height: calc(650px - 45px); /* Occupies the rest of the viewport below the header */
			overflow-y: auto; /* Enables scrolling within the container */
			background: rgba(255, 255, 255, 0); /* Optional: Add some contrast */
		}

/* Sidebar Styling */
		aside {
			background-image: url('https://media.istockphoto.com/id/1368776209/vector/petroleum-oil-refinery-complex-panorama-business-concept-finance-economy-polygonal.jpg?s=612x612&w=0&k=20&c=Ug005I9SoWDJRV30iF3LbI1zI1L5BUVgICoACrO6MUo=');
			width: 200px;
			color: #fff;
			padding: 40px 20px;
			min-height: 580px; /* Ensure the sidebar has a minimum height */
			background-size: cover;
			position: fixed; /* Keeps the sidebar fixed */
			top: 0; /* Position at the top */
			left: 0; /* Align to the left */
			z-index: 10; /* Make sure it's above other content */
			margin-top: 85px;
			transition: transform 0.3s ease; /* Smooth transition for showing/hiding */
		}
		aside img {
			width: 100px; /* Set the width of the profile picture */
			height: 100px; /* Set the height */
			border-radius: 50%; /* Makes the image circular */
			margin-bottom: 20px; /* Adds spacing below the picture */
			border: 2px solid #fff; /* Optional border for styling */
			margin-left: 40px;
			border: 2px solid rgba(17, 246, 33, 0.8); /* Adds a subtle border */
			box-shadow: 0px 8px 20px rgba(0, 255, 38, 1); /* Adds a soft shadow effect */
		}


		aside ul {
			list-style: none;
		}

		aside ul li {
			margin: 30px 0;
		}

		aside ul li a {
			color: #fff;
			text-decoration: none;
			font-weight: bold;
			font-weight: 600;
		}

		aside ul li a:hover {
			text-decoration: underline;
		}

/* Style for the icon */
		li a {
			color: #fff; /* White text color */
			text-decoration: none; /* Remove underline */
			font-size: 16px; /* Adjust the font size */
			display: flex; /* Align the icon and text in a row */
			align-items: center; /* Vertically center the icon and text */
			padding: 4px 10px; /* Add some padding around the text */
			transition: background-color 0.3s ease; /* Smooth background color transition on hover */
			margin-left: -20px;
		}

		li a i {
			margin-right: 30px; /* Add space between the icon and the text */
			font-size: 15px; /* Set the size of the icon */
		}

		li a:hover {
			background-color: rgba(131, 237, 242, 0.22); /* Darker background on hover */
			border-radius: 5px; /* Rounded corners on hover */
		}

		li a:hover i {
			transform: scale(1.2); /* Slightly increase icon size */
		}

		li a:hover {
			font-weight: bold; /* Make the text bold on hover */
		}
		.logout-item a:hover {
			color: rgba(255, 0, 0, 0.38);
			
		}
		.icon-m a:hover {
			color: rgba(43, 247, 63, 0.83);
		}
/* Toggle Button Styling */
        .toggle-btn {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: #fff;
            color: #4665e2;
            border: 2px solid rgba(19, 255, 0, 0.22);
            padding: 10px 12px;
            cursor: pointer;
            font-size: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 255, 38, 1);
			margin-left: 190px;
			margin-top: 20px;
			box-shadow: 0 60px 30px rgba(32, 230, 137, 0.49);
			
        }
/* Side Bar Options */
		 aside.hidden {
            transform: translateX(-100%); /* Moves the sidebar off-screen */
			transition: transform 0.3s ease; /* Smooth transition */
        }
		/* Add rotation effect to button */
		.toggle-btn.rotated {
			transform: rotate(180deg); /* Rotate 180 degrees when toggled */
		}
		 aside.sidebar-hidden {
            margin-left: 0;
			
        }

/* Registeration Container */
		.registration-container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-top:5px; /* Ensure spacing below the header */
            width: 400px;
            text-align: center;
            font-family: 'Times New Roman', serif;
			
        }

        .registration-container h2 {
            margin-bottom: 20px;
            color: #4665e2;
            font-weight: 600;
        }

        .registration-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        
		
/* Input Container */
		/* Input Container */
		.input-container {
			display: flex;
			flex-direction: column;
			position: relative; /* For positioning the icons */
			font-family: 'Times New Roman', serif;
		}
		
		.input-container label {
			font-family: 'Times New Roman', serif;
			font-size: 16px;
			font-weight: bold;
			color: #333;
			margin-right: 270px;
		}
		
		.input-container input,
		.input-container select,
		.input-container textarea {
			font-family: 'Times New Roman', serif;
			padding: 10px;
			font-size: 14px;
			border: 1px solid #ccc;
			border-radius: 5px;
			width: 100%;
			box-sizing: border-box;
			margin-top: 10px; /* Uniform spacing */

		}
		.input-container-D select{
			margin-top: 3px; /* Uniform spacing */
		}


		.input-container textarea {
			resize: vertical; /* Allow vertical resizing */
			margin-top: 10px; /* Uniform spacing */
		}
		
		
		.input-container input:focus,
		.input-container select:focus,
		.input-container textarea:focus {
			font-family: 'Times New Roman', serif;
			border-color: #4665e2;
			outline: none;
			box-shadow: 0 0 5px rgba(70, 101, 226, 0.5);
		}

	
		.input-container i {
			position: absolute;
			right: 15px;
			top: 50%;
			transform: translateY(-50%);
			font-size: 18px;
			color: rgba(0, 0, 0, 1);
			pointer-events: none; /* Prevent the icon from blocking clicks */
			margin-top: 10px; /* Uniform spacing */
		}
		
		.error-message {
			font-size: 12px;
			color: red;
			margin-top: 5px;
		}
  	/* Email Validation */
		 #email.invalid {
			border: 2px solid red;
			color: rgba(255, 0, 24, 1);
		}
		 #email.valid {
			border: 2px solid rgba(19, 254, 75, 1);
			color: rgba(19, 254, 75, 1);
		}

		/* Error message styling */
		.error-message {
			color: red;
			font-size: 12px;
			margin-top: 5px;
			display: block;
		}
		
		
/* Style for the buttons container */
		.buttons {
			display: flex;
			gap: 15px;
			margin-top: 5px;
			margin-bottom: 15px;
		}

		/* Common button styling */
		button {
			padding: 10px 20px;
			font-size: 16px;
			border: none;
			cursor: pointer;
			transition: all 0.3s ease;
			border-radius: 5px;
		}


	/* Style for Update button */
		.send-button {
			background-color: rgba(36, 3, 248, 0.8);
			color: white;
			margin-left: 110px;
			margin-top: -10px;
			width: 200px;
		}

		.send-button:hover {
			background-color: rgba(16, 234, 45, 0.8);
		}

		/* Focus effect for buttons */
		button:focus {
			outline: none;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
		}

	
			
    </style>	
    <header>
        <button class="toggle-btn" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
        ----Welcome to Sending Email Page----
    </header>
     <aside id="aside">
		  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVovyqEqNX_c5Bm4fEalIlBF-Yj034GuqtTKNem_fnRzJVdpPLVa_kEUjXbvOq8xPacnM&usqp=CAU" alt="Profile Picture">
        <ul>
			<li class="icon-m">
			<a href="manage.php"><i class="fas fa-home"></i> Home</a>
			</li>
			<li class="icon-m">
				<a href="profile.php"><i class="fas fa-user"></i> Profile Management</a>
			</li>
			<li class="icon-m">
				<a href="requested details.php"><i class="fas fa-envelope"></i> Request Management</a>
			</li>
			<li class="icon-m">
				<a href="Token Details.php"><i class="fas fa-coins"></i> Token Management</a>
			</li>
			<li class="logout-item">
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</li>
          
			
        </ul>
    </aside>
	<div class="container">
        <div class="registration-container">
            <h2>Send Email for Requesters</h2>
			<p class= "text-center">Send Mail for Requesters.</p>
		<?php
			if (isset($_SESSION['email_success'])) {
				echo "<div style='color: green; text-align: center;'>" . $_SESSION['email_success'] . "</div>";
				unset($_SESSION['email_success']);
			}
			if (isset($_SESSION['email_error'])) {
				echo "<div style='color: red; text-align: center;'>" . $_SESSION['email_error'] . "</div>";
				unset($_SESSION['email_error']);
			}
			?>
            <form method="POST" action="sendmail.php">
			
					<div class="input-container">
						<label for="name"> Name</label>
						<input type="text" id="name" name="name" placeholder="Enter Requester's Name" required>
						 <i class="fas fa-user icon"></i>
					</div>
					
					<div class="input-container">
						<label for="email"> Email</label>
						<input type="email" id="email" name="email" placeholder="Enter Requester's Email" required>
						<i class="fas fa-envelope"></i>
					</div>
					
					<div class="input-container">
						<label for="subject">Subject</label>
						<input type="text" id="subject" name="subject" placeholder="Enter subject" required>
						 <i class="fas fa-envelope"></i>
					</div>
					
					<div class="input-container">
						<label for="message">Message</label>
						<textarea name="message" id="message" cols="30" rows="10" placeholder="Enter Message" required></textarea>
						<span class="error-message"></span>
					</div>
					
	 
				<div class="buttons">
					<button type="send" class="send-button" name="send">Send</button>
				</div>
            </form>
        </div>
    </div>
	
			<script>
				// Function to toggle the sidebar
				function toggleSidebar() {
					const sidebar = document.getElementById('aside');
					const mainContent = document.getElementById('main-content');
					if (sidebar) {
						sidebar.classList.toggle('hidden');
						mainContent.classList.toggle('sidebar-hidden');
					} else {
						console.error("Sidebar element not found");
					}
				}
			</script>
    
	 
			<script>
				document.getElementById("email").addEventListener("input", function () {
					let emailInput = this;
					let errorMessage = document.getElementById("email_error");
					let emailValue = emailInput.value;

					// Regular expression to check if the email contains "@" and ends with "gmail.com"
					let emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

					if (emailPattern.test(emailValue)) {
						emailInput.classList.add("valid");
						emailInput.classList.remove("invalid");
						errorMessage.textContent = ""; // Clear error message
					} else {
						emailInput.classList.add("invalid");
						emailInput.classList.remove("valid");
						errorMessage.textContent = "Email must contain '@' and end with 'gmail.com'";
					}
				});
			</script>
			<script>
				if (window.history.replaceState) {
					window.history.replaceState(null, null, window.location.href);
				}
			</script>

</body>
</html>

