<?php
include '../db_config.php';

// Fetch payments
$payments = $conn->query("SELECT * FROM payments")->fetch_all(MYSQLI_ASSOC);
?>