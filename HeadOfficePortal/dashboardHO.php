<?php
session_start(); // Start the session to access session variables

// Check if the user is logged in
if (!isset($_SESSION['admin_name'])) {
    // Redirect to login page if not logged in
    header("Location: loginHO.php");
    exit();
}

// Get the admin's name from the session
$admin_name = $_SESSION['admin_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Head Office Portal</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <style>
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    display: flex;
    height: 100vh;
    background: url('gasbygas.jpg') no-repeat center center fixed;
    background-size: cover;
    position: relative;
  }

  /* Dark Overlay for Better Readability */
  body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(8px);
    background: rgba(0, 0, 0, 0.4); /* Dark overlay effect */
    z-index: 0;
  }

  body > * {
    position: relative;
    z-index: 1;
  }

  /* Side Navigation Bar */
  .sidebar {
    width: 250px;
    background-color: rgba(51, 51, 51, 0.9);
    color: white;
    display: flex;
    flex-direction: column;
    padding: 20px 0;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    transform: translateX(-250px);
    transition: transform 0.3s ease-in-out;
    box-shadow: 5px 0 10px rgba(0, 0, 0, 0.3);
  }

  .sidebar.show {
    transform: translateX(0);
  }

  .sidebar a {
    color: white;
    text-decoration: none;
    font-size: 1.2rem;
    padding: 15px 20px;
    display: block;
    transition: background-color 0.3s ease;
  }

  .sidebar a:hover {
    background-color: #ffa500;
  }

  .sidebar .logo {
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 20px;
  }

  .sidebar a:last-child {
    margin-top: auto;
    background-color: #ff4d4d;
  }

  .sidebar a:last-child:hover {
    background-color: #cc0000;
  }

  /* Main Content Area */
  .main-content {
    flex: 1;
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 20px;
    width: 100%;
    margin-left: 0;
    transition: margin-left 0.3s ease-in-out;
  }

  .sidebar.show + .main-content {
    margin-left: 250px;
  }

  /* Card Design */
  .card {
    background-color: rgba(255, 255, 255, 0.9);
    width: 300px;
    height: 200px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
  }

  .card i {
    font-size: 50px;
    color: #ffa500;
    margin-bottom: 15px;
  }

  .card h3 {
    margin: 0;
    font-size: 1.5rem;
    color: #333;
  }

  .card a {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #ffa500;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1rem;
    transition: background-color 0.3s ease;
  }

  .card a:hover {
    background-color: #e69500;
  }

  /* Toggle Button */
  .toggle-button {
    position: fixed;
    top: 20px;
    left: 20px;
    background-color: #ffa500;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    z-index: 1000;
    transition: background-color 0.3s ease;
  }

  .toggle-button:hover {
    background-color: #e69500;
  }

  /* Responsive Styles */
  @media screen and (max-width: 768px) {
    .sidebar {
      width: 220px;
      transform: translateX(-220px);
    }

    .sidebar.show {
      transform: translateX(0);
    }

    .sidebar.show + .main-content {
      margin-left: 0;
    }

    .card {
      width: 90%;
      max-width: 280px;
      height: 180px;
    }

    .card h3 {
      font-size: 1.3rem;
    }

    .card a {
      font-size: 0.9rem;
      padding: 8px 15px;
    }

    .toggle-button {
      top: 15px;
      left: 15px;
      padding: 8px 12px;
    }
  }
</style>

</head>
<body>
  <button class="toggle-button" onclick="toggleSidebar()">☰ Menu</button>
  <!-- Sidebar Navigation -->
  <div class="sidebar" id="sidebar">
    <div class="logo">Head Office Portal</div>
    <a href="adminM.html"><i class="fas fa-user-shield"></i> Admin Management</a>
    <a href="outletDetails.php"><i class="fas fa-store"></i> Outlet Management</a>
    <a href="tokenDetails.php"><i class="fas fa-ticket-alt"></i> Token Management</a>
    <a href="userDetails.php"><i class="fas fa-users"></i> User Management</a>
    <a href="scheduleM.html"><i class="fas fa-calendar-alt"></i> Schedule Management</a>
    <a href="logout.php" onclick="return confirmLogout();"><i class="fas fa-sign-out-alt"></i> Log Out</a>
    </div>

  <!-- Main Content with Cards -->
  <div class="main-content">
    <div class="card">
      <i class="fas fa-user-shield"></i>
      <h3>Admin Management</h3>
      <a href="adminM.html">Go to Admin</a>
    </div>
    <div class="card">
      <i class="fas fa-store"></i>
      <h3>Outlet Management</h3>
      <a href="outletDetails.php">Go to Outlet</a>
    </div>
    <div class="card">
      <i class="fas fa-ticket-alt"></i>
      <h3>Token Management</h3>
      <a href="tokenDetails.php">Go to Token</a>
    </div>
    <div class="card">
      <i class="fas fa-users"></i>
      <h3>User Management</h3>
      <a href="userDetails.php">Go to User</a>
    </div>
    <div class="card">
      <i class="fas fa-calendar-alt"></i>
      <h3>Schedule Management</h3>
      <a href="scheduleM.html">Go to Schedule</a>
    </div>
  </div>

  <script>
  function confirmLogout() {
  var confirmLogout = confirm("Are you sure you want to logout?");
  if (confirmLogout) {
    // Redirect directly to logout.php if confirmed
    window.location.href = "logout.php";
  } else {
    // Prevent the link from following
    return false;
  }
}

</script>


  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('show');
    }
  </script>
</body>
</html>
