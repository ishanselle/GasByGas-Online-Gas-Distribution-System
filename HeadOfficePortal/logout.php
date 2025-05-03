<?php
// Start the session
session_start();

// Unset session variables
session_unset();

// Destroy the session to log the user out
session_destroy();

// Redirect to the login page
header("Location: loginHO.php");
exit();
?>
