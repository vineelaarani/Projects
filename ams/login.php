<?php
$conn = new mysqli("localhost", "root", "", "airline_db");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$uname = $_POST['uname'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM users WHERE uname='$uname' AND pwd='$pwd'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: dashboard.html");
    exit();
} else {
    echo "❌ Invalid credentials!";
}

$conn->close();
?>
