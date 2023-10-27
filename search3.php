<?php
 $databaseHost = 'localhost';
 $databaseUsername = 'root';
 $databasePassword = '';
 $dbname = "tdroDB";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['term'])) {
    $searchTerm = $_GET['term'];
    $sqlInfo = "SELECT * FROM data_info WHERE TicketNo LIKE '%$searchTerm%' OR Name LIKE '%$searchTerm%'";
} else {
    $sqlInfo = "SELECT * FROM data_info";
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
            <th>Type of Violation</th>
            <th>Apprehending Officer</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultInfo->fetch_assoc()) : ?>
                <tr class="table-row">
                    <td><?= $row['TicketNo'] ?></td>
                    <td><?= $row['Name'] ?></td>
                    <td><?= $row['PlateNumber'] ?></td>
                    <td><?= $row['Violation'] ?></td>
                    <td><?= $row['Officer'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>No Violator Found</p>
<?php endif; ?>
