<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Profile | GasByGas Online</title>
    <link rel="stylesheet" href="adminEdit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="content">
        <h1>Edit Admin Profile</h1>
    </div>
    <div class="wrapper">
        <!-- Message Display Area -->
        <div id="message" class="message"></div>

        <form id="editAdminForm" method="POST" action="updateAdminProfile.php">
            <!-- Admin Username Dropdown -->
            <div class="input-box">
                <i class="fas fa-user-circle"></i>
                <select id="adminUsername" name="adminUsername" onchange="loadAdminData()" required>
                    <option value="">Select Admin Username</option>
                    <?php
                    include 'db_connection.php'; // Include the database connection
            
                    $query = "SELECT username FROM add_admin";
                    $result = $conn->query($query);
            
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No admins found</option>";
                    }
            
                    $conn->close(); // Close the database connection
                    ?>
                </select>
            </div>

            <!-- Display Admin Data -->
            <div class="input-box">
                <i class="fas fa-user-circle"></i>
                <input type="text" id="name" name="name" placeholder="Admin Name" readonly>
            </div>
            <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Email" readonly>
            </div>

            <!-- Password Update -->
            <div class="input-box">
                <input type="password" id="currentPassword" name="currentPassword" placeholder="Current Password" required>
                <i class="fas fa-eye toggle-password" onclick="togglePassword('currentPassword')"></i>
            </div>
            <div class="input-box">
                <input type="password" id="newPassword" name="newPassword" placeholder="New Password" required>
                <i class="fas fa-eye toggle-password" onclick="togglePassword('newPassword')"></i>
            </div>
            <div class="input-box">
                <input type="password" id="reenterNewPassword" name="reenterNewPassword" placeholder="Re-enter New Password" required>
                <i class="fas fa-eye toggle-password" onclick="togglePassword('reenterNewPassword')"></i>
            </div>

            <div class="button-group">
                <button type="submit" class="btn save-btn">Update Password</button>
                <button type="button" class="btn clear-btn" onclick="clearForm()">Clear</button>
                <button type="button" class="btn" onclick="closeForm()">Close</button>
            </div>
        </form>
    </div>

    <script>
        // Function to load admin data via AJAX
        function loadAdminData() {
            const username = document.getElementById('adminUsername').value;
            if (username) {
                fetch(`fetchAdminData.php?username=${username}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('name').value = data.name || '';
                        document.getElementById('email').value = data.email || '';
                    })
                    .catch(error => console.error('Error fetching admin data:', error));
            }
        }

        // Function to toggle password visibility
        function togglePassword(inputId) {
            const passwordField = document.getElementById(inputId);
            const toggleIcon = passwordField.nextElementSibling;

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }

        // Clear form function
        function clearForm() {
            document.getElementById("editAdminForm").reset();
            document.getElementById('adminUsername').value = ''; // Reset dropdown
            document.getElementById('message').innerText = ''; // Clear message
        }

        // Redirect to dashboard page
        function closeForm() {
            window.location.href = "dashboardHO.php";
        }

        // Handle form submission
        document.getElementById('editAdminForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);

            fetch('updateAdminProfile.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const messageDiv = document.getElementById('message');
                messageDiv.innerText = data.message;

                if (data.status === 'success') {
                    messageDiv.style.color = 'green';
                } else {
                    messageDiv.style.color = 'red';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('message').innerText = 'An error occurred. Please try again.';
                document.getElementById('message').style.color = 'red';
            });
        });
    </script>
</body>
</html>