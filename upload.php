<?php
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";

// Create a new database connection
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check for database connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all the required fields are set
    if (
        isset($_POST['date'], $_POST['ticket_number'], $_POST['name'], $_POST['violation_type'], $_POST['violation'], 
        $_POST['place_of_violation'], $_POST['plate_number'], $_POST['cnc'], $_POST['license_number'], 
        $_POST['officer'], $_POST['status'], $_POST['penalty']
    )) {
        $date = $_POST['date'];
        $ticketNumber = $_POST['ticket_number'];
        $name = $_POST['name'];
        $violationType = $_POST['violation_type'];
        $violation = $_POST['violation'];
        $otherViolation = $_POST['other_violation'];
        $placeOfViolation = $_POST['place_of_violation'];
        $plateNumber = $_POST['plate_number'];
        $cnc = $_POST['cnc'];
        $orNumber = isset($_POST['or_number']) ? $_POST['or_number'] : null; // Handle optional field
        $orDate = isset($_POST['or_date']) ? $_POST['or_date'] : null; // Handle optional field
        $LicenseNumber = $_POST['license_number'];
        $officer = $_POST['officer'];
        $status = $_POST['status'];
        $penalty = $_POST['penalty'];

        // Prepare SQL statement
        $sql = "INSERT INTO data_info (`Date`, `TicketNo`, `Name`, `ViolationType`, `Violation`, `OtherViolation`, `PlaceofViolation`, `PlateNumber`, `LicenseNumber`, `C/NC`, `ORNo`, `ORDate`, `Officer`, `Penalty`, `Status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        
        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("sssssssssssssss", $date, $ticketNumber, $name, $violationType, $violation, $otherViolation, $placeOfViolation, $plateNumber,$LicenseNumber, $cnc, $orNumber, $orDate, $officer, $penalty, $status);

            if ($stmt->execute()) {
                // Display a success message using JavaScript
                echo '<script>alert("Report uploaded successfully");</script>';
                
                // Redirect to the officer dashboard after a delay (e.g., 3 seconds)
                echo '<script>window.setTimeout(function() { window.location.href = "officer.php"; }, 1000);</script>';
            } else {
                echo "Error inserting data: " . $stmt->error;
            }
            
            // Close the prepared statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Missing required fields.";
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
