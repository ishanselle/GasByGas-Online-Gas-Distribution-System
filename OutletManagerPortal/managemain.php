<?php
// Start session
session_start();

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
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
    <title>Main Management</title>
</head>
<body>
	<style>
		 html, body {
			height: 100%;
			margin: 0;
			verflow: hidden;
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
			z-index: 20; /* Make sure it's above other content */
		}

		.container {
			display: flex;
			flex-direction: row;
			margin: 20px;
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

/* Main Content Styling */
		main {
			width: 400px;
			background: rgba(51, 101, 197, 0.38);
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			margin-top: 160px;
			padding: 60px;
			margin-left: 160px;
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
		
		
		
    </style>	
    <header>
        <button class="toggle-btn" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
          ------Hi,Welcome <?= htmlspecialchars($_SESSION['username']) ?>------
    </header>
     <aside id="aside">
		  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVovyqEqNX_c5Bm4fEalIlBF-Yj034GuqtTKNem_fnRzJVdpPLVa_kEUjXbvOq8xPacnM&usqp=CAU" alt="Profile Picture">
        <ul>
			
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
	
    <main>
        <!-- Main content will be inserted here -->
        <?php
        // Content injection point
        if (isset($content)) {
            echo $content;
        } else {
         echo '<marquee><h1>Welcome to the Outlate & Request Management!</h1></marquee>';
           
        }
        ?>
    </main>
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
    
</body>
</html>
