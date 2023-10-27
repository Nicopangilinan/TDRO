<?php
 $databaseHost = 'localhost';
 $databaseUsername = 'root';
 $databasePassword = '';
 $dbname = "tdroDB";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlSuccessList = "SELECT * FROM data_info WHERE Status = 'Settled'";
$resultSuccessList = $conn->query($sqlSuccessList);
?>

<?php if ($resultSuccessList->num_rows > 0) : ?>
    <table class="content-table">
        <thead>
            <tr>
                <th>Ticket No.</th>
                <th>Name</th>
                <th>OR Number</th>
                <th>OR Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultSuccessList->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['TicketNo'] ?></td>
                    <td><?= $row['Name'] ?></td>
                    <td><?= $row['ORNo'] ?></td>
                    <td><?= $row['ORDate'] ?></td>
                    <td><?= $row['Status'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>No Success Records Found</p>
<?php endif; ?>
