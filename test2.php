<?php
    header('Content-Type: text/html; charset=utf-8');

    $databaseHost = 'localhost';
    $databaseUsername = 'root';
    $databasePassword = '';
    $dbname = "tdroDB";

    try {
        // Create a connection
        $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

        // Check the connection
        if (isset($_GET['id'])) {
            $rowID = $_GET['id'];
        
            // Fetch the license number of the clicked row
            $licenseNumber = getLicenseNumber($conn, $rowID);
        
            if ($licenseNumber !== false) {
                // Prepare the SQL statement to select data with the same license number
                $query = "SELECT DATE_FORMAT(Date, '%M %d, %Y %h:%i%p') AS FormattedDate, Officer, TicketNo, Name, Violation, OtherViolation, PlaceofViolation, PlateNumber, LicenseNumber, ORNo, ORDate, Penalty, Status FROM data_info WHERE LicenseNumber = ?";
        
                // Bind the parameter
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $licenseNumber);
        
                // Execute the query
                $stmt->execute();
        
                // Get the result
                $result = $stmt->get_result();
        
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Display the data in modal 3
                        foreach ($row as $key => $value) {
                            echo "<p><strong>$key:</strong> $value</p>";
                        }
                    }
                } else {
                    echo "No related violator details found.";
                }
        
                // Close the statement
                $stmt->close();
            }
        }}
        
        function getLicenseNumber($conn, $rowID) {
            // Prepare SQL statement to fetch the license number
            $query = "SELECT LicenseNumber FROM data_info WHERE id = ?";
            $stmt = $conn->prepare($query);
        
            // Bind the parameter
            $stmt->bind_param("i", $rowID);
        
            // Execute the query
            $stmt->execute();
        
            // Get the result
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['LicenseNumber'];
            } else {
                return false;
            }
        }
        
    ?>
