
<!--COUNTER MATERLIST-->
<?php
// Start the session
session_start();

$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";

// Connect to the newly created database
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchButton'])) {
    $ticketNumber = $_POST['username'];

    // Perform a query based on the inputted ticket number
    $sql = "SELECT * FROM data_info WHERE TicketNo = ? OR LicenseNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ticketNumber, $ticketNumber);
    $stmt->execute();
    $resultInt = $stmt->get_result();
} else {
    // If the form is not submitted, set $resultInt to an empty result set
    $resultInt = $conn->query("SELECT * FROM data_info WHERE 1=0");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TDRO Officer</title>
    <link href="style.css" rel="stylesheet">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style>
      .donotShow_row {
          display: none;
      }
    </style>
  </head>
  <body>
    <div class="form-outline mb-4">
      <form method="POST">
        <label class="form-label" for="username" style="color:white;">Input License Number or Ticket Number:</label>
        <input type="text" id="username" name="username" class="form-control form-control-lg border form-icon-trailing" required="">
        <input type="submit" id="searchButton" name="searchButton" class="form-control form-control-lg border form-icon-trailing" value="Search">
      </form>

      <div class="additional-container" style="background-color: white; padding: 50px; margin-top:20px; height:200px; overflow:auto;">
        <table class="content-table">
          <thead>
            <tr>
              <th>License Number</th>
              <th>Ticket No.</th>       
              <th>Violation</th>       
              <th>Violation Type</th>
              <th>Name</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $resultInt->fetch_assoc()) : ?>
              <tr>
                <td><?= $row['LicenseNumber'] ?></td>
                <td><?= $row['TicketNo'] ?></td>
                <td><?= $row['Violation'] ?></td>
                <td><?= $row['ViolationType'] ?></td>
                <td><?= $row['Name'] ?></td>
                <td><?= $row['Status'] ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
