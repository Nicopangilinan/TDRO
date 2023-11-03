<?php
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to store counts
$countA = 0;
$countB = 0;
$countC = 0;

// Count violations for Classification A
$sqlA = "SELECT COUNT(*) AS count FROM data_info WHERE ViolationType = 'A. Licenses/Registration/Permits'";
$resultA = $conn->query($sqlA);

if ($resultA->num_rows > 0) {
    $row = $resultA->fetch_assoc();
    $countA = $row['count'];
}

// Count violations for Classification B
$sqlB = "SELECT COUNT(*) AS count FROM data_info WHERE ViolationType = 'B. Illegal Operation'";
$resultB = $conn->query($sqlB);

if ($resultB->num_rows > 0) {
    $row = $resultB->fetch_assoc();
    $countB = $row['count'];
}

// Count violations for Classification C
$sqlC = "SELECT COUNT(*) AS count FROM data_info WHERE ViolationType = 'C. Other Violations'";
$resultC = $conn->query($sqlC);

if ($resultC->num_rows > 0) {
    $row = $resultC->fetch_assoc();
    $countC = $row['count'];
}

// Create an associative array with the counts
$counts = array(
    $countA,
    $countB,
    $countC
);

// Encode the array to JSON
$chartData = json_encode($counts);

// Now $chartData contains the JSON-encoded counts
echo $chartData;

// Close the database connection
$conn->close();
?>
