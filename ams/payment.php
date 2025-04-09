<?php
$conn = new mysqli("localhost", "root", "", "airline_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$card_name = $_POST['card_name'];
$card_number = $_POST['card_number'];
$expiry_date = $_POST['expiry_date'];
$cvv = $_POST['cvv'];
$amount = $_POST['amount'];

$sql = "INSERT INTO payments (card_name, card_number, expiry_date, cvv, amount)
        VALUES ('$card_name', '$card_number', '$expiry_date', '$cvv', '$amount')";

if ($conn->query($sql) === TRUE) {
    echo "<h3>✅ Payment Successful!</h3><p>Thank you for your payment.</p>";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>
