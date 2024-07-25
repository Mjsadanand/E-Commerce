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

// Initialize variables to store user input
$usern= $_GET["username"];
$password= $_GET["password"];
 
// SQL query to fetch user details based on username and password
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $usern, $password);

// Execute the query
$stmt->execute();

// Store the result
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows > 0) {

    // Get user details
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $usern);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    // Pass user details to the HTML file using URL parameters
    header("Location: profile.html?username=" . urlencode($user['username']) . "&email=" . urlencode($user['email']) . "&created_at=" . urlencode($user['created_at']));
    exit;
} 
else {
    // User not found or incorrect credentials
    echo "<script>alert('Invalid Credential..!!');
     window.location.assign('user.html'); </script>";
}

$stmt->close();
$conn->close();
?>

