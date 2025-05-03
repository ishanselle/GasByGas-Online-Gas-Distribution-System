<?php
require_once 'database.php';
$outletId = $_GET['outletId'];
$stmt = $pdo->prepare("SELECT outlet_name FROM gas_token_details WHERE outlet_id = ?");
$stmt->execute([$outletId]);
echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
?>
