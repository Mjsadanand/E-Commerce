<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "customer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $password);

// Set parameters and execute
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if ($stmt->execute()) {
    echo "<script>alert('Sign Up Successfully..!!');
    window.location.assign('user.html');</script>";
} 
else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>


