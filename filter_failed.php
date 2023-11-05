<?php
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlFailedList = "SELECT * FROM data_info WHERE Status = 'Unsettled'";
$resultFailedList = $conn->query($sqlFailedList);
?>

<?php if ($resultFailedList->num_rows > 0) : ?>
    <table class="content-table">
        <thead>
        <tr>
                <th>Ticket No.</th>
                <th>Name</th>
                <th>PlateNumber</th>
                <th>OR Number</th>
                <th>OR Date</th>
                <th>Status</th>
                </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultFailedList->fetch_assoc()) : ?>
                <tr data-row-id="<?= $row['id'] ?>">
                    <td><?= $row['TicketNo'] ?></td>
                    <td><?= $row['Name'] ?></td>
                    <td><?= $row['PlateNumber'] ?></td>
                    <td><?= $row['ORNo'] ?></td>
                    <td><?= $row['ORDate'] ?></td>
                    <td><?= $row['Status'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>No Failed Records Found</p>
<?php endif; ?>
