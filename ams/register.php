<?php
$conn = new mysqli("localhost", "root", "", "airline_db");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$uname = $_POST['uname'];
$pwd = $_POST['pwd'];

// Start HTML output
echo '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Airline System</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container login-container">';

$check = "SELECT * FROM users WHERE uname='$uname'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo "<h2 class='title'>⚠️ Username already exists</h2>";
    echo "<p class='register-text'><a href='register.html'>Try another username</a></p>";
} else {
    $sql = "INSERT INTO users (uname, pwd) VALUES ('$uname', '$pwd')";
    if ($conn->query($sql) === TRUE) {
        echo "<h2 class='title'>✅ Registration Successful</h2>";
        echo "<p class='register-text'><a href='index.html'>Login Now</a></p>";
    } else {
        echo "<h2 class='title'>❌ Error:</h2>";
        echo "<p class='register-text'>" . $conn->error . "</p>";
    }
}

echo '</div></body></html>';

$conn->close();
?>
