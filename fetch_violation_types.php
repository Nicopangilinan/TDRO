<?php
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "tdroDB";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the column names from the database table where the column name is not 'id'
$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'traffic_violation' AND COLUMN_NAME != 'id'";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $dbname);

$violationTypes = array();

if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $violationTypes[] = $row['COLUMN_NAME'];
    }
}

// Return violation types as JSON
echo json_encode($violationTypes);

$stmt->close();
$conn->close();
?>
