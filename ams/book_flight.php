<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "airline_db"; // Make sure your DB name is correct

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Booking Info (same for all passengers)
$username = $_POST['username'];
$flight = $_POST['flight'];
$source = $_POST['source'];
$destination = $_POST['destination'];
$travel_date = $_POST['travel_date'];

// Passenger Info (arrays)
$names = $_POST['passenger_name'];
$ages = $_POST['age'];
$genders = $_POST['gender'];
$emails = $_POST['email'];
$phones = $_POST['phone'];

$success = 0;

for ($i = 0; $i < count($names); $i++) {
    // Get one passenger's details per loop
    $pname = $conn->real_escape_string($names[$i]);
    $page = $conn->real_escape_string($ages[$i]);
    $pgender = $conn->real_escape_string($genders[$i]);
    $pemail = $conn->real_escape_string($emails[$i]);
    $pphone = $conn->real_escape_string($phones[$i]);

    $sql = "INSERT INTO reservations 
    (username, flight_number, source, destination, travel_date, passenger_name, age, gender, email, phone)
    VALUES 
    ('$username', '$flight', '$source', '$destination', '$travel_date', 
    '$pname', '$page', '$pgender', '$pemail', '$pphone')";

    if ($conn->query($sql) === TRUE) {
        $success++;
    }
}

// If booking is successful, redirect to payment page
if ($success > 0) {
    header("Location: payment.html"); // Redirect to the payment page
    exit();
} else {
    echo "❌ Booking failed.";
}

$conn->close();
?>
