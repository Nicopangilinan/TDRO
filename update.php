<?php
header('Content-Type: application/json');

$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "tdroDB";

try {
    if (isset($_POST['id'])) {
        $rowID = $_POST['id'];

        // Check if the user has confirmed the update
        if (isset($_POST['LicenseNumber'], $_POST['ORNo'], $_POST['ORDate'], $_POST['Status'])) {
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
            $query = "UPDATE data_info SET LicenseNumber = ?, ORNo = ?, ORDate = ?, Status = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssi", $editedLicenseNumber, $editedORNo, $editedORDate, $selectedStatus, $rowID);

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
