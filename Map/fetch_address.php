<?php
// Replace these with your actual database credentials
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "tdrodb";

// Create connection
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch addresses from the database
$sql = "SELECT PlaceofViolation FROM data_info";
$result = $conn->query($sql);

$addresses = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $addresses[] = $row['PlaceofViolation'] . ', Batangas, Philippines';;
    }
}

// Close connection
$conn->close();

// Output addresses as JSON
header('Content-Type: application/json');
echo json_encode($addresses);
?>
