<?php
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['violation_type'])) {
    $selectedViolationType = $_GET['violation_type'];

    // Build the SQL query dynamically
    $query = "SELECT `$selectedViolationType` FROM traffic_violation";
    $result = $conn->query($query);

    $violations = array();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Add the violation value to the array
            $violations[] = $row[$selectedViolationType];
        }
        // Return violations as JSON
        echo json_encode($violations);
    } else {
        // Handle the case where no violations were found
        echo json_encode([]);
    }
} else {
    // Handle the case where 'violation_type' is not set
    echo json_encode([]);
}

$conn->close();
?>
