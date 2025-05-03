<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="GasByGas_Customer.css">
    <title>Outlet Locations</title>
</head>
<body>
    <?php
    include("outlet_location.php");

    if (isset($_POST['input'])) {
        $input = mysqli_real_escape_string($con, $_POST['input']); // Sanitize input to prevent SQL injection
        
        // Query to search for matching records based on input
        $query = "SELECT * FROM gas_outlet_details 
                  WHERE district LIKE '{$input}%' 
                  OR outlet_name LIKE '{$input}%'";
        
        $result = mysqli_query($con, $query);
        
        if ($result && mysqli_num_rows($result) > 0) { ?>
            <div class="outlet-cards">
                <?php
                // Loop through results and display them as cards
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="card">
                        <h3 class="card__title">
                            <?php echo htmlspecialchars($row['outlet_name']); ?>
                        </h3>
                        <p class="card__content">
                            Location: <?php echo htmlspecialchars($row['district']); ?>
                        </p>
                        <div class="card__date">
                            Gas Stock 2.3KG: <?php echo htmlspecialchars($row['gas_stock_2_3kg']); ?>
                        </div>
                        <div class="card__date">
                            Gas Stock 5.0KG: <?php echo htmlspecialchars($row['gas_stock_5_0kg']); ?>
                        </div>
                        <div class="card__date">
                            Gas Stock 12.5kg: <?php echo htmlspecialchars($row['gas_stock_12_5kg']); ?>
                        </div>
                        <div class="card__date">
                            Gas Stock 37.5kg: <?php echo htmlspecialchars($row['gas_stock_37_5kg']); ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        <?php
        } else {
            // Display a message when no matching records are found
            echo "<h6 class='text-danger text-center mt-3'>No Location Found</h6>";
        }
    } else {
        // Display a message if input is not set
        echo "<h6 class='text-danger text-center mt-3'>Invalid Input</h6>";
    }
    ?>
</body>
</html>
