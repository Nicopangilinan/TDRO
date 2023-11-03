<?php
header('Content-Type: application/json');

$databaseHost = 'localhost';
 $databaseUsername = 'u488180748_TDROB4t5s';
 $databasePassword = 'TDROB4t5s';
 $dbname = "u488180748_TDROB4t5s";
try {
    if (isset($_POST['id'])) {
        $rowID = $_POST['id'];

        // Create a connection
        $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement for deleting the row
        $query = "DELETE FROM data_info WHERE id = ?";
        $stmt = $conn->prepare($query);

        // Bind the parameter
        $stmt->bind_param("i", $rowID);

        // Execute the delete query
        if ($stmt->execute()) {
            // Delete was successful
            echo json_encode(['status' => 'success', 'message' => 'Row deleted successfully.']);
        } else {
            // Delete failed
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete the row.']);
        }

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
}
?>
