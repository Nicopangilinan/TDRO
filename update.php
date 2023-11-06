<?php
header('Content-Type: application/json');

$databaseHost = 'localhost';
 $databaseUsername = 'u488180748_TDROB4t5s';
 $databasePassword = 'TDROB4t5s';
 $dbname = "u488180748_TDROB4t5s";

try {
    if (isset($_POST['id'])) {
        $rowID = $_POST['id'];

        // Check if the user has confirmed the update
        if (isset($_POST['Name'], $_POST['LicenseNumber'], $_POST['ORNo'], $_POST['ORDate'], $_POST['Status'])) {
            $editedName = $_POST['Name'];
            $editedLicenseNumber = $_POST['LicenseNumber'];
            $editedORNo = $_POST['ORNo'];
            $editedORDate = $_POST['ORDate'];
            $selectedStatus = $_POST['Status'];

            // Create a connection
            $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute an SQL update query
            $query = "UPDATE data_info SET Name = ?, LicenseNumber = ?, ORNo = ?, ORDate = ?, Status = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssssi", $editedName, $editedLicenseNumber, $editedORNo, $editedORDate, $selectedStatus, $rowID);

            if ($stmt->execute()) {
                // Update was successful
                echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
            } else {
                // Update failed
                echo json_encode(['status' => 'error', 'message' => 'Failed to update the data.']);
            }

            // Close the statement and the database connection
            $stmt->close();
            $conn->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Incomplete data received.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
}
?>
