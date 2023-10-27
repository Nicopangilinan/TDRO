
<?php
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "tdroDB";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlSuccessList = "SELECT * FROM data_info WHERE Status = 'Unsettled'";
$resultSuccessList = $conn->query($sqlSuccessList);
?>

<?php if ($resultSuccessList->num_rows > 0) : ?>
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
        <tbody id="violatorTableBody">
            <?php while ($row = $resultSuccessList->fetch_assoc()) : ?>
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
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery library -->

<script>
    $(document).ready(function() {
        var modal = $("#myModal");
        var closeModal = $("#closeModal");

        // Use event delegation to handle click events for dynamic rows
        $('#violatorTableBody').on('click', 'tr', function() {
            var rowId = $(this).data('row-id');
            console.log('Clicked row ID: ' + rowId);

            // Make an AJAX request to fetch the entire row data
            $.ajax({
                type: "GET",
                url: "test.php?id=" + rowId,
                success: function(data) {
                    $("#modalContent").html(data);
                    modal.css("display", "block");
                }
            });
        });

        closeModal.click(function() {
            modal.css("display", "none");
        });

        // Close the modal when the user clicks outside of it
        $(window).click(function(e) {
            if (e.target === modal[0]) {
                modal.css("display", "none");
            }
        });
    });
</script>

<?php else : ?>
    <p>No Unsettled Records Found</p>
<?php endif; ?>
