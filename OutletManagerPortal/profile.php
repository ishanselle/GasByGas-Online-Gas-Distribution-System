<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: loginmanager.php");
    exit;
}

// Database connection details
$servername = "localhost"; 
$username = "root"; 
$password = "ishan@2001"; 
$database = "gasbygas"; 

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}


// Handle Save button click
if (isset($_POST['save'])) {    
    // Retrieve and sanitize form data
    $outlet_id = sanitize_input($_POST['outlet_id']);
    $outlet_name = sanitize_input($_POST['outlet_name']);
	$phone_number = sanitize_input($_POST['phone_number']);
	$email = sanitize_input($_POST['email']);
    $district = sanitize_input($_POST['district']);
    $outlet_address = sanitize_input($_POST['outlet_address']);
    $full_gas_stock = sanitize_input($_POST['full_gas_stock']);
    $gas_stock_2_3kg = sanitize_input($_POST['gas_stock_2_3kg']);
    $gas_stock_5_0kg = sanitize_input($_POST['gas_stock_5_0kg']);
    $gas_stock_12_5kg = sanitize_input($_POST['gas_stock_12_5kg']);
    $gas_stock_37_5kg = sanitize_input($_POST['gas_stock_37_5kg']);
    $stock_status = sanitize_input($_POST['stock_status']);
    $record_date = sanitize_input($_POST['record_date']);

     // **VALIDATION CHECKS**
    if (strlen($phone_number) !== 10 || !ctype_digit($phone_number)) {
        die("Error: Phone number must be exactly 10 digits.");
    }
    if (strlen($outlet_id) < 5) {
        die("Error: Outlet ID must be more than 5 characters.");
    }

    // SQL query using prepared statements
    $stmt = $conn->prepare("INSERT INTO gas_outlet_details (outlet_id, outlet_name, phone_number, email, district, outlet_address, full_gas_stock, gas_stock_2_3kg, gas_stock_5_0kg, gas_stock_12_5kg, gas_stock_37_5kg, stock_status, record_date) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss", $outlet_id, $outlet_name, $phone_number, $email, $district, $outlet_address, $full_gas_stock, $gas_stock_2_3kg, $gas_stock_5_0kg, $gas_stock_12_5kg, $gas_stock_37_5kg, $stock_status, $record_date);

    if ($stmt->execute()) {
		header("Location: profile.php?update_success=1");
		echo "<div class='success-message'>Record saved successfully!</div>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle Update button click
if (isset($_POST['update'])) {
    // Retrieve and sanitize form data
    $outlet_id = sanitize_input($_POST['outlet_id']);
    $outlet_name = sanitize_input($_POST['outlet_name']);
	$phone_number = sanitize_input($_POST['phone_number']);
	$email = sanitize_input($_POST['email']);
    $district = sanitize_input($_POST['district']);
    $outlet_address = sanitize_input($_POST['outlet_address']);
    $full_gas_stock = sanitize_input($_POST['full_gas_stock']);
    $gas_stock_2_3kg = sanitize_input($_POST['gas_stock_2_3kg']);
    $gas_stock_5_0kg = sanitize_input($_POST['gas_stock_5_0kg']);
    $gas_stock_12_5kg = sanitize_input($_POST['gas_stock_12_5kg']);
    $gas_stock_37_5kg = sanitize_input($_POST['gas_stock_37_5kg']);
    $stock_status = sanitize_input($_POST['stock_status']);
    $record_date = sanitize_input($_POST['record_date']);

    // **VALIDATION CHECKS**
    if (strlen($phone_number) !== 10 || !ctype_digit($phone_number)) {
        die("Error: Phone number must be exactly 10 digits.");
    }
    if (strlen($outlet_id) < 5) {
        die("Error: Outlet ID must be more than 5 characters.");
    }

    

    // SQL query using prepared statements
    $stmt = $conn->prepare("UPDATE gas_outlet_details SET outlet_name=?,phone_number=?, email=?, district=?, outlet_address=?, full_gas_stock=?, gas_stock_2_3kg=?, gas_stock_5_0kg=?, gas_stock_12_5kg=?, gas_stock_37_5kg=?, stock_status=?, record_date=? WHERE outlet_id=?");
    $stmt->bind_param("sssssssssssss", $outlet_name, $phone_number, $email, $district, $outlet_address, $full_gas_stock, $gas_stock_2_3kg, $gas_stock_5_0kg, $gas_stock_12_5kg, $gas_stock_37_5kg, $stock_status, $record_date, $outlet_id);

    if ($stmt->execute()) {
        header("Location: profile.php?update_success=1");
		echo "<div class='success-message'>Record updated successfully!</div>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle Delete button click
if (isset($_POST['delete'])) {
    // Retrieve the outlet_id to delete
    $outlet_id = sanitize_input($_POST['outlet_id']);

    // SQL query using prepared statements
    $stmt = $conn->prepare("DELETE FROM gas_outlet_details WHERE outlet_id=?");
    $stmt->bind_param("s", $outlet_id);

    if ($stmt->execute()) {
        header("Location: profile.php?delete_success=1");
		echo "<div class='success-message'>Record deleted successfully!</div>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the connection
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
    <title>Profile Management</title>
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
	/* Phone number digit color change */
	
		#phone_number:invalid {
			border: 2px solid rgba(255, 0, 19, 1);
			color: rgba(255, 0, 19, 1);
		}

		#phone_number:valid {
			border: 2px  solid rgba(0, 255, 38, 1);
			color: rgba(0, 255, 38, 1);
		}
	 /* Error message styling */
		.error-message {
			color: red;
			font-size: 12px;
			margin-top: 5px;
			display: block;
		}
	/* Outlet Id Validation */
		 #outlet_id.invalid {
			border: 2px solid rgba(255, 0, 19, 1);
			color: rgba(255, 0, 19, 1);
		}
		 #outlet_id.valid {
			border: 2px solid rgba(0, 255, 61, 1);
			color: rgba(0, 255, 38, 1);
		}

		/* Error message styling */
		.error-message {
			color: red;
			font-size: 12px;
			margin-top: 5px;
			display: block;
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
			margin-top: 20px;
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

		/* Style for Save button */
		.save-button {
			background-color: rgba(57, 48, 218, 0.8);
			color: white;
			margin-left: 60px;
		}

		.save-button:hover {
			background-color: rgba(3, 237, 63, 0.8);
		}

		/* Style for Update button */
		.update-button {
			background-color: rgba(236, 0, 255, 1);
			color: white;
			margin-right: -2px;
		}

		.update-button:hover {
			background-color: rgba(207, 148, 255, 0.8);
		}

		/* Style for Delete button */
		.delete-button {
			background-color: rgba(238, 81, 125, 0.89);
			color: white;
			margin-right: 80px;
		}

		.delete-button:hover {
			background-color: rgba(255, 0, 0, 0.8);
		}

		/* Focus effect for buttons */
		button:focus {
			outline: none;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
		}

	
			
    </style>	
    <header>
        <button class="toggle-btn" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
        ----Welcome to Create Prfile Page ----
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
            <h2>Creat Profile & Register</h2>
			
            <form method="POST" action="profile.php">
			
				<div class="input-container">
					<label for="outlet_id">Outlet ID NO</label>
					<input type="text" id="outlet_id" name="outlet_id" placeholder="Enter Outlet Id" required>
					<i class="fas fa-id-card"></i>
				</div>
				
				<div class="input-container">
					<label for="outlet_name">Outlte Name</label>
					<input type="text" id="outlet_name" name="outlet_name" placeholder="Enter Outlet Name" required>
					 <i class="fas fa-store"></i>
				</div>
				
				<div class="input-container">
				<label for="phone_number">Phone Number</label>
				<input type="text" id="phone_number" name="phone_number" placeholder="Enter Phone Number" required 
					   pattern="^\d{10}$" title="Phone number must be exactly 10 digits">
				<i class="fas fa-phone"></i>
			</div>
				
				<div class="input-container">
					<label for="email">Official Email</label>
					<input type="email" id="email" name="email" placeholder="Enter Email" required>
					<i class="fas fa-envelope"></i>
				</div>
				
				
				<div class="input-container">
						<label for="district">Place of District </label>
						<select id="district" name="district" required>
							<option value="">-- Select a District --</option>		
							<option value="Ampara">Ampara</option>
							<option value="Anuradhapura">Anuradhapura</option>
							<option value="Badulla">Badulla</option>
							<option value="Batticaloa">Batticaloa</option>
							<option value="Colombo">Colombo</option>
							<option value="Galle">Galle</option>
							<option value="Gampaha">Gampaha</option>
							<option value="Hambantota">Hambantota</option>
							<option value="Jaffna">Jaffna</option>
							<option value="Kalutara">Kalutara</option>
							<option value="Kandy">Kandy</option>
							<option value="Kegalle">Kegalle</option>
							<option value="Kilinochchi">Kilinochchi</option>
							<option value="Kurunegala">Kurunegala</option>
							<option value="Mannar">Mannar</option>
							<option value="Matale">Matale</option>
							<option value="Matara">Matara</option>
							<option value="Monaragala">Monaragala</option>
							<option value="Mullaitivu">Mullaitivu</option>
							<option value="Nuwara Eliya">Nuwara Eliya</option>
							<option value="Polonnaruwa">Polonnaruwa</option>
							<option value="Puttalam">Puttalam</option>
							<option value="Ratnapura">Ratnapura</option>
							<option value="Trincomalee">Trincomalee</option>
							<option value="Vavuniya">Vavuniya</option>
						</select>
					<span class="error-message"></span>
					</div>
					
					<div class="input-container">
						<label for="outlet_address">Outlet Address</label>
						<textarea name="outlet_address" id="outlet_address" cols="30" rows="10" placeholder="Enter Outlate Address" required></textarea>
						<span class="error-message"></span>
					</div>
					
					<div class="input-container">
					<label for="full_gas_stock">Full Gas Stock</label>
					<input type="text" id="full_gas_stock" name="full_gas_stock" placeholder="Enter Full Gas Stock" required>
					<i class="fas fa-boxes"></i>
					</div>
				
					<div class="input-container">
						<label for="gas_stock_2_3kg">2.3KG Gas Stock</label>
						<input type="text" id="gas_stock_2_3kg" name="gas_stock_2_3kg" placeholder="Enter (Full Gas Stock & in Stock Gas)" required>
						<i class="fas fa-boxes"></i>
					</div>
					<div class="input-container">
						<label for="gas_stock_5_0kg">5.0KG Gas Stock</label>
						<input type="text" id="gas_stock_5_0kg" name="gas_stock_5_0kg" placeholder="Enter (Full Gas Stock & in Stock Gas)" required>
						<i class="fas fa-boxes"></i>
					</div>
					
					<div class="input-container">
						<label for="gas_stock_12_5kg">12.5KG Gas Stock</label>
						<input type="text" id="gas_stock_12_5kg" name="gas_stock_12_5kg" placeholder="Enter (Full Gas Stock & in Stock Gas)" required>
						<i class="fas fa-boxes"></i>
					</div>
					
					<div class="input-container">
						<label for="gas_stock_37_5kg">37.5KG Gas Stock</label>
						<input type="text" id="gas_stock_37_5kg" name="gas_stock_37_5kg" placeholder="Enter (Full Gas Stock & in Stock Gas)" required>
						<i class="fas fa-boxes"></i>
					</div>
					
					<div class="input-container">
						<label for="stock_status">All Stock Status </label>
						<select id="stock_status" name="stock_status" required>
							<option value="">-- Select a Stock Status --</option>
							<option value="in stock">In Stock</option>
							<option value="in stock">Out of Stock</option>
						</select>
						<span class="error-message"></span>
					</div>
					
					<div class="input-container">
						<label for="record_date">Record Update</label>
						<input type="date" id="record_date" name="record_date" required>
						
					</div>
				<div class="buttons">
					<button type="save" class="save-button" name="save">Save</button>
					<button type="update" class="update-button" name="update">Update</button>
					<button type="delete" class="delete-button" name="delete">Delete</button>
				
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
			function deleteOutlet() {
			  const outletId = document.getElementById("outlet_id").value;

			  if (outletId === "") {
				alert("Please enter an outlet ID.");
				return;
			  }

			  // Sending AJAX request to backend to delete the record
			  const xhr = new XMLHttpRequest();
			  xhr.open("POST", "profile.php", true);
			  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			  xhr.onreadystatechange = function () {
				if (xhr.readyState === 4 && xhr.status === 200) {
				  const response = xhr.responseText;
				  alert(response); // Show success or error message
				}
			  };
			  xhr.send("outlet_id=" + outletId);
			}
		  </script>
		  
		  <script>
				document.getElementById("phone_number").addEventListener("input", function () {
					let phoneInput = this;
					let errorMessage = document.getElementById("phone_error");
					let phoneValue = phoneInput.value;

					// Regular expression to allow only digits and check for exactly 10 digits
					let phonePattern = /^[0-9]{10}$/;

					if (phonePattern.test(phoneValue)) {
						phoneInput.classList.add("valid");
						phoneInput.classList.remove("invalid");
						errorMessage.textContent = ""; // Clear error message
					} else {
						phoneInput.classList.add("invalid");
						phoneInput.classList.remove("valid");
						errorMessage.textContent = "Phone number must be exactly 10 digits";
					}
				});
			</script>
			<script>
				document.getElementById("outlet_id").addEventListener("input", function () {
					let outletInput = this;
					let errorMessage = document.getElementById("outlet_id_error");
					let outletValue = outletInput.value;

					if (outletValue.length > 5) {
						outletInput.classList.add("valid");
						outletInput.classList.remove("invalid");
						errorMessage.textContent = ""; // Clear error message
					} else {
						outletInput.classList.add("invalid");
						outletInput.classList.remove("valid");
						errorMessage.textContent = "Outlet ID must be more than 5 characters";
					}
				});
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
			document.querySelector("form").addEventListener("submit", function(event) {
			let phoneInput = document.getElementById("phone_number").value;
			let outletIdInput = document.getElementById("outlet_id").value;
			
			if (!/^\d{10}$/.test(phoneInput)) {
				alert("Phone number must be exactly 10 digits.");
				event.preventDefault(); // Prevent form submission
			}
			if (outletIdInput.length < 5) {
				alert("Outlet ID must be more than 5 characters.");
				event.preventDefault(); // Prevent form submission
			}
		});
		</script>
			

    
</body>
</html>
