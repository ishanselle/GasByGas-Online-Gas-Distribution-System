<?php
session_start();

// Function to send OTP (replace with your SMS API)
function sendOtp($phone, $otp) {
    // Example: Twilio API or similar
    echo "OTP sent to $phone: $otp"; // Replace this with API logic
    return true; // Simulate success
}

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $phone = $data['phone'];
    $otp = rand(100000, 999999); // Generate OTP

    $_SESSION['otp'] = $otp; // Save OTP in session for validation

    if (sendOtp($phone, $otp)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
