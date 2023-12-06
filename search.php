<?php
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['term'])) {
    $searchTerm = $_GET['term'];
    $sqlInfo = "SELECT * FROM data_info WHERE Name != 'unattended' AND (Name LIKE '%$searchTerm%' OR TicketNo LIKE '%$searchTerm%')";
} else {
    $sqlInfo = "SELECT * FROM data_info WHERE Name != 'unattended'";
}

$resultInfo = $conn->query($sqlInfo);
?>

<?php if ($resultInfo->num_rows > 0) : ?>
    <table class="content-table">
        <thead>
            <tr>
                <th>Ticket No.</th>
                <th>Name</th>
                <th>Plate Number</th>
                <th>Apprehending Officer</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultInfo->fetch_assoc()) : ?>
                <tr class="table-row">
                    <td><?= $row['TicketNo'] ?></td>
                    <td><?= $row['Name'] ?></td>
                    <td><?= $row['PlateNumber'] ?></td>
                    <td><?= $row['Officer'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>No Violator Found</p>
<?php endif; ?>
