<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['Username'])) {
    header("Location: login.php"); // Redirect to the login page
    exit(); // Prevent further script execution
}

// Database credentials
$servername = "localhost";
$username_db = "root";
$password_db = "ishan@2001";
$dbname = "gasbygas";

// Optional: Add your database connection logic here if needed.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="GasByGas_Customer.css">
    <title>Customer</title>
</head>
<style>
    table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
}

th, td {
  padding: 12px;
  text-align: left;
}

th {
  background-color: #4CAF50;
  color: black;
  font-size: medium;
  font-weight: bold;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #ddd;
}

</style>
<body>
    <nav class="nav-bar">
        <div class="logo">
            <img src="GasByGas Logo.png" alt="GasByGas Logo">
        </div>
        <div class="nav-links">
            <ul>
                <li><a href="#Gas Requests and Token">Gas Requests</a></li>
                <li><a href="#Outlet location">Outlet location</a></li>
                <li><a href="#History">History</a></li>
                <li><a href="Sign_out.php">Sign out</a></li>
            </ul>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button type="submit" class="search">Search</button>
        </div>
    </nav>
    <header>
        <h1 class="title">GasByGas</h1>
        <h2 class="sub_title">"Seamless LP Gas Distribution at Your Fingertips"</h2>
        <p class="p">GasByGas makes gas requests and deliveries effortless. Track your orders, manage tokens, and stay notified with our user-friendly platform.</p>
        <a href="#Gas Requests and Token">
            <button class="Gas_Requests" type="button">Gas Requests</button>
        </a>
</header>

<section class="Gas_Requests_and_Token" id="Gas Requests and Token">
    <h1 class="title">Gas Requests and Token</h1>
    <div class="Gas_Requests_container">
        <h1>Gas Request Form</h1>
        <form id="gasRequestForm" method="POST" action="Gas_Requests.php">
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" id="username" name="username" value='<?php echo $_SESSION['Username']; ?>' readonly>
                </div><br>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="contactNo">Contact No:</label>
                    <input type="text" id="contactNo" name="contactNo" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="gasType">Gas Type:</label>
                    <select id="gasType" name="gasType" required placeholder="Choose Gas Type">
                        <option value="">-- Choose Gas Type --</option>
                        <option value="2.3KG">2.3KG</option>
                        <option value="5.0KG">5.0KG</option>
                        <option value="12.5KG">12.5KG</option>
                        <option value="37.5KG">37.5KG</option>
                    </select>
                </div>
                <div class="form-group">
    <label for="outlet">Outlet:</label>
    <select id="outlet" name="outlet" required onchange="updateOutletID()">
        <option value="">-- Select Outlet Location --</option>
        <?php
        // Database connection
        $servername = "localhost";
        $username_db = "root";
        $password_db = "ishan@2001";
        $dbname = "gasbygas";

        // Create connection
        $conn = new mysqli($servername, $username_db, $password_db, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch outlet data
        $sql = "SELECT outlet_id, outlet_name, district FROM gas_outlet_details";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['outlet_id'] . "' data-location='" . $row['district'] . "'>" . $row['district'] . "</option>";
            }
        } else {
            echo "<option value=''>No outlets available</option>";
        }

        $conn->close();
        ?>
    </select>
</div>

<div class="form-group">
    <label for="Outlet_ID">Outlet ID:</label>
    <input type="text" id="Outlet_ID" name="Outlet_ID" readonly required>
</div>

<script>
    // JavaScript function to update the Outlet ID based on the selected outlet
    function updateOutletID() {
        const outletDropdown = document.getElementById("outlet");
        const outletIDField = document.getElementById("Outlet_ID");

        // Get the selected option's value (ID)
        outletIDField.value = outletDropdown.value || '';
    }
</script>
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" min="1" max="10" required>
                </div>
                <div class="form-group">
                    <label for="pack">Day:</label>
                    <input type="date" id="day" name="day" required>
                </div>
            </div>
            <button type="submit" class="btn_request">Request</button>
            <button type="reset" class="btn_request">Clear</button>
        
        <div id="messageBox" class="hidden">
            <p id="messageText"></p>
        </div>
    </div>
</form>
</section>

<section class="Outlet_location" id="Outlet_location">
    <h1 class="title">Outlet location</h1>
    <p>Searching for your location and finding the outlet...</p>
    <input type="text" class="location" id="location" autocomplete="off" placeholder="Search location...">
    <div id="display"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#location").keyup(function() {
                var input = $(this).val();

                if (input !== "") {
                    $.ajax({
                        url: "live_location.php",
                        method: "POST",
                        data: { input: input },
                        success: function(data) {
                            $("#display").html(data); // Update the display div with the result
                            $("#display").css("display", "block"); // Show the result
                        }
                    });
                } else {
                    $("#display").css("display", "none"); // Hide the result if input is empty
                }
            });
        });
    </script>
</section>


<section class="History" id="History">
    <h1 class="title">History</h1>
    <p>This is your gas request history...</p>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <?php
        // Database credentials
        $servername = "localhost";
        $username_db = "root";
        $password_db = "ishan@2001";
        $dbname = "gasbygas";

        // Ensure session is started only once
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Create connection
        $conn = new mysqli($servername, $username_db, $password_db, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch history for the logged-in user
        if (isset($_SESSION['Username'])) {
            $username = $_SESSION['Username'];

            $sql = "SELECT Name, P_number, Email, Gas_Type, Outlet_Name, Outlet_ID, Quantity, Gas_Req_day FROM gas_request WHERE Username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Gas Type</th>
                        <th>Outlet Name</th>
                        <th>Outlet ID</th>
                        <th>Quantity</th>
                        <th>Day</th>
                      </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . (isset($row['Name']) ? htmlspecialchars($row['Name']) : "N/A") . "</td>";
                    echo "<td>" . (isset($row['P_number']) ? htmlspecialchars($row['P_number']) : "N/A") . "</td>";
                    echo "<td>" . (isset($row['Email']) ? htmlspecialchars($row['Email']) : "N/A") . "</td>";
                    echo "<td>" . (isset($row['Gas_Type']) ? htmlspecialchars($row['Gas_Type']) : "N/A") . "</td>";
                    echo "<td>" . (isset($row['Outlet_Name']) ? htmlspecialchars($row['Outlet_Name']) : "N/A") . "</td>";
                    echo "<td>" . (isset($row['Outlet_ID']) ? htmlspecialchars($row['Outlet_ID']) : "N/A") . "</td>";
                    echo "<td>" . (isset($row['Quantity']) ? htmlspecialchars($row['Quantity']) : "N/A") . "</td>";
                    echo "<td>" . (isset($row['Gas_Req_day']) ? htmlspecialchars($row['Gas_Req_day']) : "N/A") . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No history found.</p>";
            }

            $stmt->close();
        } else {
            echo "<p>You must log in to view your gas request history.</p>";
        }

        $conn->close();
    ?>
</section>
<script src="ReqGas.js"></script>
</body>
</html>