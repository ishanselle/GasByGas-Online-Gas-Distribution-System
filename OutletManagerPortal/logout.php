<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Store username before destroying session
    session_destroy();
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            background-image: url('https://media.licdn.com/dms/image/v2/D4D12AQGr5C2_TZ9VMg/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1703949537962?e=2147483647&v=beta&t=lZomZvlsNskT49G7Arppr7_-JJfAtogrDuxP_o96haU');
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100vh;
        }
        .container {
            background-color: rgba(0, 255, 252, 0.21);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: auto;
        }
        h2 {
            color: rgba(255, 0, 0, 1);
        }
        .message {
			
            font-size: 18px;
            color: rgba(0, 0, 0, 1);
            margin-bottom: 20px;
        }
    </style>
    <script>
        setTimeout(function () {
            window.location.href = "index.php"; // Redirect after 3 seconds
        }, 3000);
    </script>
</head>
<body>

<div class="container">
    <h2>Logout Successful</h2>
    <p class="message">Goodbye, <b><?= htmlspecialchars($username) ?></b>! You have successfully logged out.</p>
</div>

</body>
</html>
