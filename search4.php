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
    $sqlInfo = "SELECT * FROM data_info WHERE (TicketNo LIKE '%$searchTerm%' OR Name LIKE '%$searchTerm%')";
} else {
    $sqlInfo = "SELECT * FROM data_info";
}

$resultInfo = $conn->query($sqlInfo);
?>

<?php if ($resultInfo->num_rows > 0) : ?>
    <div class="content-table">
            <table >
                <thead>
                    <tr>
                        <th>Ticket No.</th>
                        <th>Name</th>
                        <th>Plate Number</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="violatorTableBody">
                    <?php while ($row = $resultInfo->fetch_assoc()) : ?>
                        <tr data-row-id="<?= $row['id'] ?>">
                            <td><?= $row['TicketNo'] ?></td>
                            <td><?= $row['Name'] ?></td>
                            <td><?= $row['PlateNumber'] ?></td>
                            <td><?= $row['Status'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else : ?>
                <p>No Violators Found</p>
            <?php endif; ?>
        </div>

      <!-- Hidden modal for violator details -->
      <div id="myModal" class="modal2">
            <div class="modal-content2">
              <span class="close2" id="closeModal">&times;</span>
              <h2 style="font-weight:bolder; color: #134228;">Donation Details</h2><br>
              <div id="modalContent">
               <!-- Content from 'payments' table will be displayed here -->
             </div>
          </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
      // Get the modal element and close button
      var modal = $("#myModal");
      var closeModal = $("#closeModal");

      // Add a click event listener to the table rows
      $('#violatorTableBody tr').click(function () {
        var rowId = $(this).data('row-id');
        console.log('Clicked row ID: ' + rowId);

        // Make an AJAX request to fetch the entire row data from the 'payments' table
        $.ajax({
          type: "GET",
          url: "test.php?id=" + rowId, // Update the URL to your PHP script
          success: function (data) {
            // Display the fetched data in the modal
            $("#modalContent").html(data);

            // Show the modal
            modal.css("display", "block");
          }
        });
      });

      // Close the modal when the close button is clicked
      closeModal.click(function () {
        modal.css("display", "none");
      });

      // Close the modal when the user clicks outside of it
      $(window).click(function (e) {
        if (e.target === modal[0]) {
          modal.css("display", "none");
        }
      });
    });

</script>