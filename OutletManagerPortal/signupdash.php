<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Welcome</title>
    <style>
        body {
            
            background-image: url('https://mb.cision.com/Public/15003/3961998/a525fd2454fe8b16_800x800ar.jpg'); 
            background-size: cover; /* Ensures the image covers the entire background */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }
        header {
            background-color: #4665e2;
            color: white;
            width: 100%;
            padding: 10px 0;
			background-image: url('https://media.istockphoto.com/id/1368776209/vector/petroleum-oil-refinery-complex-panorama-business-concept-finance-economy-polygonal.jpg?s=612x612&w=0&k=20&c=Ug005I9SoWDJRV30iF3LbI1zI1L5BUVgICoACrO6MUo=');
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			font-family: Times New Roman;
        }
        .container {
			font-family: Times New Roman;
            text-align: center;
            background: rgba(59, 193, 96, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-top: 180px;
        }
		.container:hover {
            background: rgba(27, 177, 185, 0.8); /* Background color on hover */
			transform: scale(1.2); /* Zoom effect */
			border: 2px solid rgba(236, 31, 175, 0.8); /* Border color on hover */
        }
        .container h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .container button {
			font-family: Times New Roman;
            padding: 10px 20px;
            background: #4665e2;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .container button:hover {
            background: rgba(73, 26, 171, 0.74);
        }
    </style>
</head>
<body>
    <header>
        <h2>--- Gas By Gas Outlet Management ---</h2>
    </header>
    <div class="container">
        <h1>Welcome</h1>
        <p>Click below to sign up for an account.</p>
        <form action="signup.php" method="get">
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
