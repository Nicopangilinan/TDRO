<?php
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create an array to hold the counts for all months, initialized with zeros
$monthCounts = array_fill(1, 12, 0);

$sql = "SELECT DATE_FORMAT(date, '%c') AS month, COUNT(*) AS count FROM data_info GROUP BY DATE_FORMAT(date, '%c')";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Convert the count value to an integer
        $count = (int)$row['count'];
        
        // Convert the month to an integer
        $month = (int)$row['month'];
        
        $monthCounts[$month] = $count;
    }
}

$conn->close();

$chartData = json_encode(array_values($monthCounts));

?>