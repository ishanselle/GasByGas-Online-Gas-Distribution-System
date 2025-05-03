<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Delivery | GasByGas</title>
    <link rel="stylesheet" href="scheduleDelivery.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

    <!-- Back Button -->
    <div class="top-right">
        <a href="scheduleM.html" class="btn go-back-btn"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <!-- Content Header -->
    <div class="content">
        <h1>Schedule Gas Delivery</h1>
    </div>

    <!-- Delivery Scheduling Form -->
    <div class="wrapper">
        <form id="scheduleForm" method="POST" action="processSchedule.php">
            <label for="outletId">Select Outlet:</label>
            <select name="outletId" id="outletId" required onchange="updateOutletName()">
                <option value="">-- Select Outlet ID --</option>
                <?php
                require_once 'db_connection.php';

                // Fetch outlet IDs and names from the database
                $sql = "SELECT outlet_id, outlet_name FROM gas_token_details";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['outlet_id']) . "' data-name='" . htmlspecialchars($row['outlet_name']) . "'>" 
                            . htmlspecialchars($row['outlet_id']) . " - " . htmlspecialchars($row['outlet_name']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No outlets available</option>";
                }

                $conn->close(); // Close the database connection
                ?>
            </select>

            <label for="outletName">Outlet Name:</label>
            <input type="text" name="outletName" id="outletName" readonly required>

            <label for="handoverDate">Handing Over Date:</label>
            <input type="date" name="handoverDate" id="handoverDate" required>

            <label for="deliveryDate">Delivery Date:</label>
            <input type="date" name="deliveryDate" id="deliveryDate" required>

            <label for="gasType">Select Gas Type:</label>
            <select name="gasType" id="gasType" required onchange="updateQuantity()">
                <option value="2.3kg">2.3kg</option>
                <option value="5kg">5kg</option>
                <option value="12.5kg">12.5kg</option>
                <option value="37.5kg">37.5kg</option>
            </select>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" required min="1" readonly>

            <button type="submit" name="scheduleDelivery" class="btn schedule-btn">Schedule Delivery</button>
            <button type="reset" class="btn clear-btn">Clear</button>
        </form>
    </div>

    <!-- JavaScript -->
    <script>
        // Update outletName based on selected outletId
        function updateOutletName() {
            const outletDropdown = document.getElementById('outletId');
            const selectedOption = outletDropdown.options[outletDropdown.selectedIndex];
            const outletName = selectedOption.getAttribute('data-name');
            document.getElementById('outletName').value = outletName || '';
        }

        // Update quantity based on selected gas type and outlet ID
function updateQuantity() {
    const outletId = document.getElementById('outletId').value.trim();
    const gasType = document.getElementById('gasType').value.trim();
    const quantityInput = document.getElementById('quantity');

    // Ensure both outletId and gasType are selected before making a request
    if (outletId && gasType) {
        fetch(`getQuantity.php?outlet_id=${encodeURIComponent(outletId)}&gasType=${encodeURIComponent(gasType)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    quantityInput.value = data.quantity;
                } else {
                    quantityInput.value = '';
                    alert(`Error: ${data.message}`);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('An unexpected error occurred. Please try again.');
            });
    } else {
        quantityInput.value = ''; // Clear input if no selection
    }
}


        // Ensure delivery date is within two weeks of handover date
        const handoverDateInput = document.getElementById("handoverDate");
        const deliveryDateInput = document.getElementById("deliveryDate");

        handoverDateInput.addEventListener("change", () => {
            const handoverDate = new Date(handoverDateInput.value);
            const maxDeliveryDate = new Date(handoverDate);
            maxDeliveryDate.setDate(maxDeliveryDate.getDate() + 14); // Add 14 days

            deliveryDateInput.min = handoverDateInput.value;
            deliveryDateInput.max = maxDeliveryDate.toISOString().split("T")[0];
        });
    </script>

</body>
</html>
