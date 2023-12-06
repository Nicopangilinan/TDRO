<?php
header('Content-Type: text/html; charset=utf-8');

$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";

try {
    // Create a connection
    $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if 'license' is set in the URL
    if (isset($_GET['license'])) {
        $license = $_GET['license'];

        // Prepare the SQL statement to select data with the same license number
        $query = "SELECT DATE_FORMAT(Date, '%M %d, %Y %h:%i%p') AS FormattedDate, Officer, TicketNo, Name, Violation, OtherViolation, PlaceofViolation, PlateNumber, LicenseNumber, ORNo, ORDate, Penalty, Status FROM data_info WHERE LicenseNumber = ?";

        // Bind the parameter
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $license);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        $firstRow = true; // To track the first row for adding dividers

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Display a divider before the data except for the first row
                if (!$firstRow) {
                    echo "<br><hr><br>" ;
                } else {
                    $firstRow = false;
                }

                // Display the data in modal 3
                foreach ($row as $key => $value) {
                    echo "<p><strong>$key:</strong> $value</p>";
                }
            }
        } else {
            echo "<p style='color: white;'>No history violations found</p>" . $license;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "License parameter is not set in the URL.";
    }

    // Close the database connection
    $conn->close();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
