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
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET['id'])) {
            $rowID = $_GET['id'];

            // Prepare the SQL statement
            $query = "SELECT DATE_FORMAT(Date, '%M %d, %Y %h:%i%p') AS  FormattedDate, Officer, TicketNo, Name, Violation, OtherViolation, PlaceofViolation, PlateNumber, LicenseNumber, ORNo, ORDate, Penalty, Status FROM data_info WHERE id = ?";
            $stmt = $conn->prepare($query);

            // Bind the parameter
            $stmt->bind_param("i", $rowID);

            // Execute the query
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Display the entire row data in the modal
                foreach ($row as $key => $value) {
                    echo "<p><strong>$key:</strong> " . $value . "</p>";
                }
            } else {
                echo "No violator details found.";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Invalid request.";
        }

        // Close the database connection
        $conn->close();
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
    ?>
