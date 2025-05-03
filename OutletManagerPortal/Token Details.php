<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman:wght@300;400;600;700&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
    <title>Tokens Details </title>
</head>
<body>
			
			 <!-- Filter Form -->
			<<div class="filter-form">
				<form method="GET" action="">
					<input type="text" name="outlet_name" placeholder="Outlet Name">
					<input type="text" name="outlet_id" placeholder="Outlet ID">
					<input type="date" name="requested_date">
					<button type="submit"><i class="fas fa-filter"></i> Filter</button>
				</form>
			</div>

	<style>
		 html, body {
			height: 100%;
			margin: 0;
			overflow: hidden;
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
			z-index: 1000; 
			margin-top: -170px;
			
		}

/* Sidebar Styling */
		aside {
			background-image: url('https://media.istockphoto.com/id/1368776209/vector/petroleum-oil-refinery-complex-panorama-business-concept-finance-economy-polygonal.jpg?s=612x612&w=0&k=20&c=Ug005I9SoWDJRV30iF3LbI1zI1L5BUVgICoACrO6MUo=');
			width: 200px;
			color: #fff;
			padding: 40px 20px;
			min-height: 580px; 
			background-size: cover;
			position: fixed; 
			top: 0; 
			left: 0;
			z-index: 10; 
			margin-top: 85px;
			transition: transform 0.3s ease; 
		}
		aside img {
			width: 100px; 
			height: 100px; 
			border-radius: 50%; 
			margin-bottom: 20px; 
			border: 2px solid #fff; 
			margin-left: 40px;
			border: 2px solid rgba(17, 246, 33, 0.8); 
			box-shadow: 0px 8px 20px rgba(0, 255, 38, 1); 
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
			color: #fff; 
			text-decoration: none;
			font-size: 16px; 
			display: flex; 
			align-items: center;
			padding: 4px 10px; 
			transition: background-color 0.3s ease;
			margin-left: -20px;
		}

		li a i {
			margin-right: 30px; 
			font-size: 15px; 
		}

		li a:hover {
			background-color: rgba(131, 237, 242, 0.22); 
			border-radius: 5px; 
		}

		li a:hover i {
			transform: scale(1.2);
		}

		li a:hover {
			font-weight: bold; 
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
 
 /* Filter Styling */
		.filter-form {
			background: rgba(255, 255, 255, 0);
			padding: 10px;  
			border-radius: 5px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
			margin-top: 90px; 
			display: inline-block;
			margin-top: 83px;
			margin-left: 100px;
			font-family: 'Times New Roman', serif;
			box-shadow: 0px 8px 10px rgba(2, 158, 255, 1);
			border: 2px solid rgba(0, 0, 0, 1);
		}
          
        .filter-form input, .filter-form button {
            padding: 8px;
            margin: 5px;
            font-size: 12px;
			font-family: 'Times New Roman', serif;
        }
        .filter-form button {
            background-color: #0013ff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
		.filter-form button:hover{
			 background-color: rgba(35, 231, 77, 0.8);
		}
		
 /* Detail View Table Styling */
		.table-container {
			width: 1100px;
			margin: 20px auto; 
			background: rgba(255, 255, 255, 0);
			padding: 15px;
			border-radius: 10px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
			overflow-x: auto; 
			max-height: 500px; 
			overflow-y: auto;
			margin-top: 115px;
			box-shadow: 0px 8px 10px rgba(2, 158, 255, 1);
			border: 2px solid rgba(0, 0, 0, 1);
			margin-left: 300px;
		}
        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
            background: rgba(200, 220, 231, 0.42);
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
        th {
            background: rgba(75, 167, 214, 0.42);
            color: white;
        }
	/* No matching Details Message Styling */
		.no-records {
			text-align: center; 
			font-size: 18px; 
			color: #ff0000; /* Red color for emphasis */
			font-weight: bold; 
			background: rgba(255, 255, 255, 0); 
			padding: 10px; 
			border-radius: 5px; 
			margin-top: 20px; 
			box-shadow: 0px 4px 8px rgba(255, 6, 6, 0.73); 
			width: 50%;
			margin-top: 250px;
			margin-left: 150px;
			text-align: center; /* Center text */
		}
		

	
			
    </style>	
    <header>
        <button class="toggle-btn" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
        ----Welcome to Token Details Page ----
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
				<a href="loginout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</li>
          
			
        </ul>
    </aside>
	
    
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
<?php
$servername = "localhost";
$username = "root";
$password = "ishan@2001";
$dbname = "gasbygas"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// **Dynamic Filter Setup**
$whereClauses = [];
$outlet_name = !empty($_GET['outlet_name']) ? $conn->real_escape_string($_GET['outlet_name']) : null;
$outlet_id = !empty($_GET['outlet_id']) ? $conn->real_escape_string($_GET['outlet_id']) : null;
$record_date = !empty($_GET['record_date']) ? $conn->real_escape_string($_GET['record_date']) : null;

// **Apply Filtering Logic**
if ($outlet_id) {
    $whereClauses[] = "outlet_id = '$outlet_id'";
}
if ($outlet_name && $outlet_id) {
    $whereClauses[] = "outlet_name LIKE '%$outlet_name%'";
}
if ($record_date && $outlet_name && $outlet_id) {
    $whereClauses[] = "record_date = '$record_date'";
}

// **Conditions to Block Certain Filters**
if ((!$outlet_id && $outlet_name) || (!$outlet_id && $record_date)) {
    echo "<div class='no-records'>
            <marquee behavior='alternate' direction='right' scrolldelay='20' scrollamount='10'>
                Please enter at least Outlet ID to retrieve Token Details.
            </marquee>
          </div>";
} 
else if (!empty($whereClauses)) {
    $sql = "SELECT * FROM gas_token_details WHERE " . implode(" AND ", $whereClauses);
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='table-container'>
                <table>
                    <tr>
                        <th>Token ID</th>
                        <th>Outlet ID</th>
                        <th>Outlet Name</th>
                        <th>Requester's Name</th>
                        <th>Requester's Phone Number</th>
                        <th>Requester's Email</th>
                        <th>Token</th>
                        <th>Type of Gas</th>
                        <th>Quantity</th>
                        <th>Payment</th>
                        <th>Token Status</th>
                        <th>Requested Date</th>
                        <th>Request Expiry Date</th>
                        <th>Create Date</th>
                        <th>Update Date</th>
                    </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['outlet_id']}</td>
                    <td>{$row['outlet_name']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['phone_number']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['token']}</td>
                    <td>{$row['gas_type']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['payment']}</td>
                    <td>{$row['token_status']}</td>
                    <td>{$row['record_date']}</td>
                    <td>{$row['expiry_date']}</td>
                    <td>{$row['created_at']}</td>
                    <td>{$row['updated_at']}</td>
                </tr>";
        }
        echo "</table></div>";
    } else {
        echo "<div class='no-records'>
                <marquee behavior='alternate' direction='right' scrolldelay='20' scrollamount='10'>
                    No matching records found.
                </marquee>
              </div>";
    }
} else {
    echo "<div class='no-records'>
            <marquee behavior='alternate' direction='right' scrolldelay='20' scrollamount='10'>
                Please enter valid filters.
            </marquee>
          </div>";
}

// Close connection
$conn->close();
?>


</body>
</html>
