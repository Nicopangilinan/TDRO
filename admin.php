<?php
// Start the session
session_start();

 //Check if the user is not logged in (session variable not set)
if (!isset($_SESSION['user_id'])) {
   //  Redirect to the login page (index.php)
    header("Location: index.php");
    exit();
}
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
function getLastUpdatedTime2($conn) {
  $lastUpdatedQuery = "SELECT MAX(Date) AS last_updated FROM data_info";
  $lastUpdatedResult = $conn->query($lastUpdatedQuery);
  if (!$lastUpdatedResult) {
    // Handle query error here, e.g., by printing the error message
    echo "Error: " . $conn->error;
} else {
  $lastUpdatedRow = $lastUpdatedResult->fetch_assoc();

  if ($lastUpdatedRow['last_updated']) {
      $lastUpdatedTime = strtotime($lastUpdatedRow['last_updated']);
      $currentTime = time();
      $timeDifference = $currentTime - $lastUpdatedTime;

      if ($timeDifference < 60) {
          // Less than a minute ago
          return  " seconds ago";
      } elseif ($timeDifference < 3600) {
          // Less than an hour ago
          $minutesAgo = floor($timeDifference / 60);
          return $minutesAgo . " minute" . ($minutesAgo > 1 ? "s" : "") . " ago";
      } elseif ($timeDifference < 86400) {
          // Less than a day ago
          $hoursAgo = floor($timeDifference / 3600);
          return $hoursAgo . " hour" . ($hoursAgo > 1 ? "s" : "") . " ago";
      } else {
          // More than a day ago
          $daysAgo = floor($timeDifference / 86400);
          return $daysAgo . " day" . ($daysAgo > 1 ? "s" : "") . " ago";
      }
  } else {
      return 'N/A';
  }
} 
}


    $sql = "SELECT * FROM data_info";

    $result = $conn->query($sql)
?>
<?php
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";
// Create a database connection
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';
$filter = isset($_POST['filter']) ? $_POST['filter'] : 'all';

if (!empty($searchTerm)) {
    $sqlInt = "SELECT * FROM data_info WHERE (TicketNo LIKE '%$searchTerm%' OR Name LIKE '%$searchTerm%')";
} else {
    switch ($filter) {
        case 'settled':
            $sqlInt = "SELECT * FROM data_info WHERE Status = 'Settled'";
            break;
        case 'unsettled':
            $sqlInt = "SELECT * FROM data_info WHERE Status = 'Unsettled'";
            break;
        case 'casefiles':
            $sqlInt = "SELECT * FROM data_info WHERE Status = 'Unsettled' AND DATE_ADD(Date, INTERVAL 2 WEEK) <= NOW()";
            break;
        default:
            $sqlInt = "SELECT * FROM data_info";
            break;
    }
}

$resultInt = $conn->query($sqlInt);
?>
<?php
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";
    
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlInfo = "SELECT * FROM data_info WHERE Name != 'unattended'";
    $resultInfo = $conn->query($sqlInfo)
?>
<!--UNATTENDED-->
<?php
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlInfoS = "SELECT * FROM data_info WHERE Name = 'unattended'";
    $resultInfoS = $conn->query( $sqlInfoS)
?>
<!--OR NUMBER-->
<?php
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlInfoO = "SELECT * FROM data_info WHERE ORNo = NULL";
    $resultInfoO  = $conn->query( $sqlInfoO)
?>
<!--COUNTER WITH CONTACT-->
<?php
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlCount = "SELECT COUNT(*) AS total FROM data_info WHERE Name != 'unattended'";
$resultCount = $conn->query($sqlCount);

if ($resultCount) {
    $row = $resultCount->fetch_assoc();
    $totalApprehensions = $row['total'];
} else {
    $totalApprehensions = 0;
}
?>
<!--COUNTER WITH NO CONTACT-->
<?php
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlCount = "SELECT COUNT(*) AS total FROM data_info WHERE Name = 'unattended'";
$resultCount = $conn->query($sqlCount);

if ($resultCount) {
    $row = $resultCount->fetch_assoc();
    $totalApprehensionsN = $row['total'];
} else {
    $totalApprehensionsN = 0;
}
?>
<!--COUNTER MATERLIST-->
<?php
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlCount = "SELECT COUNT(*) AS total FROM data_info";
$resultCount = $conn->query($sqlCount);

if ($resultCount) {
    $row = $resultCount->fetch_assoc();
    $totalMaster = $row['total'];
} else {
    $totalMaster = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TDRO Admin</title>
    <link rel="stylesheet" href="index.css" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style>
      .donotShow_row {
          display: none;
      }
    </style>
    <link rel="shortcut icon" href="/img/logo.png" />
  </head>
  <body>
    <div class="banner">
      <nav class="sidebar">
        <div class="division-box">
          <div class="profile-icon">
            <i class="fas fa-user-circle"></i>
          </div>
          <p>Admin</p>
        </div>

        <div class="menu-content">
          <ul class="menu-items">
            <li class="tab active" data-tab="dashboard">
              <a>Dashboard</a>
            </li>

            <li class="tab" data-tab="violation-record">
              <a>Violator's Record</a>
            </li>

            <li class="tab" data-tab="master-list">
              <a>Master List</a>
            </li>

            <li class="tab" data-tab="settings">
              <a>Settings</a>
            </li>
          </ul>
          <button class="logout-button" onclick="confirmLogout()">
            <i class="fas fa-sign-out-alt"></i> Log Out
          </button>
        </div>
      </nav>

      <nav class="navbar">
        <i class="fa-solid fa-bars" id="sidebar-close"></i>
        <img src="img/TDROlogo.png" alt="TDRO">
      </nav>

      <main class="main">
        <div class="tab-content">
          <div class="tab-pane" id="dashboard">
            <h1>Admin Dashboard</h1>
            <div class="box-container">
            <div id="overlay"></div>
              <!-- Box 1 -->
              
              <div class="box">
                <h2>Total Contact Apprehensions</h2>
                <p><?= $totalApprehensions ?></p>
              </div>
              <!-- Box 2 -->
              <div class="box">
                <h2>Total No Contact Apprehensions</h2>
                <p><?= $totalApprehensionsN ?></p>
              </div>
              <!-- Box 3 -->
              <div class="box">
                <h2>Case File</h2>
                <p><?= $totalMaster ?>
              </div>
            </div>
            <div class="box-container">
  <div class="box-a">
    <div class="chart">
      <canvas id="linechart" width="400" height="300"></canvas>
    </div>
  </div>
  <div class="box-a">
    <div class="chart">
      <canvas id="doughnut" width="250px" height="250px"></canvas>
    </div>
  </div>
</div>
</div>
          <div class="tab-pane" id="violation-record">
            <!-- violation-record CONTENT -->
            <h1>Violator's Records</h1>
         <div class="box-container">
<!-- FIRST MODAL -->
<div class="box">
            <button data-modal-target="#modal" class="arrow-button">🡆</button>
            <div id="overlay"></div>
             <div class="modal" id="modal">
              <div class="modal-header">
                <div class="title">List of Total Apprehension with Contact</div>
              </div>
              <button data-close-button class="close-button">&times;</button>
              <div class="modal-body">
                <div class="box-c">
                  <div class="search-bar">
                  <input class="search-input" type="text" id="searchInput1" placeholder="Search by Name or #">
                </div>
                <div id="searchResults">
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
                        <td ><?= $row['TicketNo'] ?></td>
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
              </div>
              </div>
             </div>
             </div>
             
             <h2 style="margin-top: -30px">Total Contact Apprehensions</h2>
             <p><?= $totalApprehensions ?></p>
             
           </div>
           <!-- SECOND MODAL -->
           <div class="box">
           <button data-modal-target="#second-modal" class="arrow-button">🡆</button>
            <div id="overlay"></div>
            <div class="modal" id="second-modal">
              <div class="modal-header">
                <div class="title">List of Total Apprehension with No Contact</div>
              </div>
              <button data-close-button class="close-button">&times;</button>
              <div class="modal-body">
                <div class="box-c">
                  <div class="search-bar">
                  <input type="text" class="search-input" id="searchInput2" placeholder="Search by Name or Plate#">
                </div>
                <div id="searchResults2">
                <?php if ($resultInfoS->num_rows > 0) : ?>
        <table class="content-table">
            <thead>
                <tr>
                    <th>Ticket No.</th>
                    <th>Plate Number</th>
                    <th>License Number</th>
                    <th>Apprehending Officer</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultInfoS->fetch_assoc()) : ?>
                  <tr class="table-row">
                        <td ><?= $row['TicketNo'] ?></td>
                        <td><?= $row['PlateNumber'] ?></td>
                        <td><?= $row['LicenseNumber'] ?></td>
                        <td><?= $row['Officer'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No Violator Found</p>
    <?php endif; ?>
    </div>           </div>
             </div>
             </div>
             <h2 style="margin-top: -30px">Total No Contact Apprehensions</h2>
             <p><?= $totalApprehensionsN ?></p>
           </div>
         </div>
         <script>
    //modal

      const openModalButtons = document.querySelectorAll('[data-modal-target]');
      const closeModalButtons = document.querySelectorAll('[data-close-button]');
      const overlay = document.getElementById('overlay');

      console.log(openModalButtons);

      openModalButtons.forEach(button => {
          button.addEventListener('click', () => {
              const modal = document.querySelector(button.dataset.modalTarget);
              openModal(modal);
          });
      });

      closeModalButtons.forEach(button => {
          button.addEventListener('click', () => {
              const modal = button.closest('.modal');
              closeModal(modal);
          });
      });

      overlay.addEventListener('click', () => {
          const modals = document.querySelectorAll('.modal.active');
          modals.forEach(modal => {
              closeModal(modal);
          });
      });

      function openModal(modal) {
          if (modal == null) return;
          modal.classList.add('active');
          overlay.classList.add('active');
      }

      function closeModal(modal) {
          if (modal == null) return;
          modal.classList.remove('active');
          overlay.classList.remove('active');
      }


              overlay.addEventListener('click', () => {
                const modals = document.querySelectorAll('.modal.active')
                modals.forEach(modal => {
                    closeModal(modal)
        })
      })

      closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
          const modal = button.closest('.modal')
          closeModal(modal)
        })
      })

      function openModal(modal) {
        if (modal == null) return
        modal.classList.add('active')
        overlay.classList.add('active')
      }

      function closeModal(modal) {
        if (modal == null) return
        modal.classList.remove('active')
        overlay.classList.remove('active')
      }
  </script>
           <!--ALL-->
           <div class="box-b">
             <h2>List of Total Apprehension with Contact and No Contact</h2>
             <div class="search-bar">
             <input type="text" id="searchInput3" placeholder="Search by Name or #">
           </div>
           <div id="searchResults3">
           <?php if ($result->num_rows > 0) : ?>
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
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
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
    </div>
           </div>
         </div>
         
        </div>
        
        <div class="tab-pane" id="settings">
          <!-- Settings Tab Content -->
          <div id="credModal" class="modal3">
            <div class="modalContent3">
              <form action="action.php" method="post">
                <h2 style="color:#fff;">Change Credentials</h2>
                <label for="username">Username: </label>
                <input type="text" name="username" id="User" value="admin" readonly><br>
                <label for="old_password">Old Password: </label>
                <input type="password" name="old_password" id="Password"><br>
                <label for="newpassword">New Password: </label>
                <input type="password" name="newpassword" id="newPassword"><br>
                <label for="repass">Re-enter New Password: </label>
                <input type="password" name="repass" id="rePassword"><br>
                <input type="hidden" name="oldUser" value="admin">
                <div class="btn-block margin-side">
                  <input type="submit" name="UpdateCredentials" class="submit-btn" value="Update Credentials">
                </div>
              </form>
            </div>
          </div>
          <!-- End   of Settings Tab Content -->  
 
          </div>
         <div class="tab-pane" id="master-list">
           <!-- master-list CONTENT -->
           <div class="box-b" style="height: 600px;">
  <div class="search-bar">
    <form method="post" action="">
      <input type="text" class="search-input" name="search" placeholder="Search by Name or #">
      <button class="edit-button" type="submit">Search</button>
    </form>
  </div>
  <div class="filter-buttons">
    <form method="post" action="">
      <button type="submit" name="filter" value="all"><i aria-hidden="true"></i> Show All</button>
      <button type="submit" name="filter" value="settled"><i aria-hidden="true"></i> Settled List</button>
      <button type="submit" name="filter" value="unsettled"><i aria-hidden="true"></i> Unsettled List</button>
      <button type="submit" name="filter" value="casefiles"><i aria-hidden="true"></i> Case Files</button>
    </form>
  </div>
  <div id="searchResults4">
                <?php if ($resultInt->num_rows > 0) : ?>
                  <div class="content-table">
              <table >
                  <thead>
                          <th>Ticket No.</th>
                          <th>Name</th>
                          <th>PlateNumber</th>
                          <th>OR Number</th>
                          <th>OR Date</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody id="violatorTableBody">
                      <?php while ($row = $resultInt->fetch_assoc()) : ?>
                        <tr data-row-id="<?= $row['id'] ?>" data-license-number="<?= $row['LicenseNumber'] ?>">
                              <td><?= $row['TicketNo'] ?></td>
                              <td><?= $row['Name'] ?></td>
                              <td><?= $row['PlateNumber'] ?></td>
                              <td><?= $row['ORNo'] ?></td>
                              <td><?= $row['ORDate'] ?></td>
                              <td><?= $row['Status'] ?></td>
                              <td>
                                <button class="delete-button" data-row-id="<?= $row['id'] ?>">Delete</button>
                            </td>
                          </tr>
                      <?php endwhile; ?>
                  </tbody>
              </table>
              <?php else : ?>
                  <p>No Violators Found</p>
              <?php endif; ?>
          </div>
          </div>
      </div>
        <!-- Hidden modal for violator details -->
        <div id="myModal2" class="modal2">
    <div class="modal-content2">
        <span class="close2" id="closeModal">&times;</span>
        <h1 style="font-weight: bolder; color: #fff; font-size: 30px; margin-top: -50px">Violator's Details</h1><br>
        <!-- Tab navigation for the modal only -->
        <div class="modal-tab">
            <button class="modal-tablinks" onclick="openModalTab(event, 'currentTab')">Current</button>
            <button id="historyTabButton" class="modal-tablinks" onclick="openModalTab(event, 'historyTab')">History</button>
        </div>
        <!-- Tab content for the modal only -->
        <div id="currentTab" class="modal-tabcontent">
            <div id="modalContent2"></div>
            <div id="modalContent"></div>
        </div>
        <div id="historyTab" class="modal-tabcontent">
           <div id="modalContent3"></div>
        <script>
          //============MODAL TAB============
    function openModalTab(evt, tabName) {
        var i, modalTabcontent, modalTablinks;
        modalTabcontent = document.getElementsByClassName("modal-tabcontent");
        for (i = 0; i < modalTabcontent.length; i++) {
            modalTabcontent[i].style.display = "none";
        }
        modalTablinks = document.getElementsByClassName("modal-tablinks");
        for (i = 0; i < modalTablinks.length; i++) {
            modalTablinks[i].className = modalTablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    document.addEventListener('DOMContentLoaded', function() {
      const filterButtons = document.querySelectorAll('.filter-buttons button[data-filter]');
      const filterInput = document.querySelector('input[name="filter"]');
    
      // Check if there's a saved filter state in local storage
      const savedFilter = localStorage.getItem('activeFilter');
    
      // Set the active state based on the saved filter, if any
      if (savedFilter) {
        filterButtons.forEach(button => {
          if (button.getAttribute('data-filter') === savedFilter) {
            button.classList.add('active');
          }
        });
    
        // Apply the saved filter value to the filter input field
        filterInput.value = savedFilter;
      }
    
      // Add click event listeners to the filter buttons
      filterButtons.forEach(button => {
        button.addEventListener('click', function() {
          const filterValue = this.getAttribute('data-filter');
    
          // Remove active state from all buttons
          filterButtons.forEach(btn => btn.classList.remove('active'));
    
          // Add active state to the clicked button
          this.classList.add('active');
    
          // Set the active filter in local storage
          localStorage.setItem('activeFilter', filterValue);
    
          // Apply the filter value to the filter input field
          filterInput.value = filterValue;
    
          // Submit the form
          this.closest('form').submit();
        });
      });
    });
    
        </script>    
        </div>
    </div>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Violator Modal 
    console.log("Script is running");
$(document).ready(function() {
  var modal = $("#myModal");
  var closeModal = $("#closeModal");

  // Use event delegation to handle click events for dynamic rows
  $('#violatorTableBody').on('click', 'tr', function () {
    var rowId = $(this).data('row-id');
    var license = $(this).data('license-number');
    
    console.log('LICENSE: ' + license);
    console.log('Clicked row ID: ' + rowId );

    // Make an AJAX request to fetch the entire row data
    $.ajax({
      type: "GET",
      url: "test.php?id=" + rowId,
      success: function (data) {
        $("#modalContent2").html(data);
        modal.css("display", "block");
      }
    });
    $.ajax({
      type: "GET",
      url: "test2.php?license=" + license,
      success: function (data) {
        $("#modalContent3").html(data);
        modal.css("display", "block");
      }
    });
  });

  
});

  </script>
  <script>
 $(document).ready(function () {
    var modal = $("#myModal2");
    var closeModal = $("#closeModal");

    

    // Handle the "Delete" button click
    $('.delete-button').click(function () {
        var rowId = $(this).data('row-id');

        // Prompt the user for confirmation before deleting
        if (confirm('Are you sure you want to delete this row?')) {
            // User confirmed, proceed with the delete operation

            // Perform the delete operation via AJAX
            $.ajax({
                type: "POST",
                url: "delete.php",
                data: { id: rowId, confirmed: 'true' }, // Add 'confirmed' parameter
                success: function (response) {
                    // Refresh the page after successful deletion
                    location.reload();
                }
            });
        }
    });

    $('#violatorTableBody tr').click(function () {
    var rowId = $(this).data('row-id');
    var modalContent = $("#modalContent");
    modalContent.empty(); // Clear existing content

    $.ajax({
        type: "GET",
        url: "test.php?id=" + rowId, // Update the URL to your PHP script
        success: function (data) {
            modal.css("display", "block");

            var editButton = $("<button>Edit</button>").addClass("edit-button");
            var statusDropdown = $("<select><option value='Settled'>Settled</option><option value='Unsettled'>Unsettled</option></select>");

            editButton.click(function () {
                // Create input fields
                var nameInput = $("<input type='text' id='NameInput' value='" + $("#Name").text() + "'>");
                var licenseNumberInput = $("<input type='text' id='LicenseNumberInput' value='" + $("#LicenseNumber").text() + "'>");
                var orNoInput = $("<input type='text' id='ORNoInput' value='" + $("#ORNo").text() + "'>");
                var orDateInput = $("<input type='date' id='ORDateInput' value='" + $("#ORDate").text() + "'>");

                // Show the input fields
                modalContent.append("<p><strong>Name:</strong></p>").append(nameInput);
                modalContent.append("<p><strong>LicenseNumber:</strong></p>").append(licenseNumberInput);
                modalContent.append("<p><strong>ORNo:</strong></p>").append(orNoInput);
                modalContent.append("<p><strong>ORDate:</strong></p>").append(orDateInput);
                modalContent.append("<p><strong>Status:</strong></p>").append(statusDropdown);

                var saveButton = $("<button>Save</button>").addClass("edit-button");

                saveButton.click(function () {
                    var editedName = $("#NameInput").val();
                    var editedLicenseNumber = $("#LicenseNumberInput").val();
                    var editedORNo = $("#ORNoInput").val();
                    var editedORDate = $("#ORDateInput").val();
                    var selectedStatus = statusDropdown.val();

                    $.ajax({
                        type: "POST",
                        url: "update.php",
                        data: {
                            id: rowId,
                            Name: editedName,
                            LicenseNumber: editedLicenseNumber,
                            ORNo: editedORNo,
                            ORDate: editedORDate,
                            Status: selectedStatus
                        },
                        success: function (response) {
                            alert("Data updated successfully!");
                            location.reload();
                        }
                    });
                });

                // Append the Save button
                modalContent.append(saveButton);
            });

            // Append the Edit button
            modalContent.append(editButton);
        }
    });
});


      closeModal.click(function () {
          modal.css("display", "none");
      });

      $(window).click(function (e) {
          if (e.target === modal[0]) {
              modal.css("display", "none");
          }
      });
  });
  </script>
 
    </div>
    </div>
   </div>
</div>
     
    </main>
     </div>
     
    <!-- Include charts.php to access the $chartData variable -->
        <?php include 'charts.php'; ?>
       <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
       <script src="script.js"></script>
       <script>
          // Use the $chartData variable directly in your JavaScript code
          var chartData = <?php echo $chartData; ?>

          // Create the chart
          const ctx = document.getElementById('linechart').getContext('2d');
          const linechart = new Chart(ctx, {
              type: 'line',
              data: {
                  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December','unknown'],
                  datasets: [{
                      label: 'Violators',
                      data: chartData,
                      backgroundColor: [
                          'black',
                          'black',
                          'black',
                          'black',
                          'black',
                          'black',
                      ],
                      borderColor: [
                          'white',
                          'red',
                          'red',
                          'red',
                          'red',
                          'red',
                          'red',
                          'red',
                          'red',
                          'red',
                          'red',
                          'red',
                          'red',
                          'red',
                          'red',
                          'red',
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              },
          });
      </script>
   <script>
  function confirmLogout() {
    const confirmation = confirm("Are you sure you want to log out?");
    if (confirmation) {
      window.location.href = "logout.php"; // Redirect to logout script on the server
    }
  }
  </script>
  <script>
    <?php include 'charts3.php'; ?>
    // Use the $chartData variable directly in your JavaScript code
    var chartData = <?php echo $chartData; ?>;
    const ctx3 = document.getElementById('doughnut').getContext('2d');
    const doughnut = new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: [
                'A. Licenses/Registration/Permits',
                'B. Illegal Operation                     ',
                'C. Other Violations                      '
            ],
            datasets: [{
                label: 'Violations',
                data: chartData,
                backgroundColor: [
                    'white',
                    'red',
                    'green' // You can add more colors if needed
                ],
                borderColor: 'transparent', // Border color for all segments
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

       <script src="chart2.js"></script>
       <script src="chart3.js"></script>
       
       <script>

document.addEventListener('DOMContentLoaded', function () {
 

    // Get all tab elements
    const tabs = document.querySelectorAll('.tab');
    
    // Iterate over tabs to set the default active state
    tabs.forEach(tab => {
        tab.classList.remove('active'); // Remove 'active' class from all tabs
    });

    // Get the Dashboard tab and its corresponding content
    const dashboardTab = document.querySelector('.tab[data-tab="dashboard"]');
    const dashboardTabPane = document.getElementById('dashboard');

    // Add the 'active' class to the Dashboard tab
    dashboardTab.classList.add('active');

    // Hide all tab content initially
    const tabPanes = document.querySelectorAll('.tab-pane');
    tabPanes.forEach(pane => {
        pane.style.display = 'none';
    });

    // Display the content of the Dashboard tab
    dashboardTabPane.style.display = 'block';
});
    const tabs = document.querySelectorAll('.tab');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(tab => tab.classList.remove('active'));
        tabPanes.forEach(pane => pane.style.display = 'none');
        tab.classList.add('active');
        const tabId = tab.getAttribute('data-tab');
        document.getElementById(tabId).style.display = 'block';
      });
    });
    
    
  </script>
  <script>
    //Search Functionality With contact
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput1');
  const searchResults = document.getElementById('searchResults');

  searchInput.addEventListener('input', function () {
      const searchTerm = searchInput.value.trim();

      if (searchTerm !== '') {
          // Send an AJAX request to search.php
          searchResults.innerHTML = '<p>Loading...</p>';
          fetch(`search.php?term=${searchTerm}`)
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data;
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      } else {
          // When the input is empty, show the whole table
          searchResults.innerHTML = ''; // Clear results
          fetch('search.php') // Send an AJAX request without a search term
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data; // Display the whole table
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      }
  });
});
// Search With No Contact
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput2');
  const searchResults = document.getElementById('searchResults2');

  searchInput.addEventListener('input', function () {
      const searchTerm = searchInput.value.trim();

      if (searchTerm !== '') {
          // Send an AJAX request to search.php
          searchResults.innerHTML = '<p>Loading...</p>';
          fetch(`search2.php?term=${searchTerm}`)
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data;
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      } else {
          // When the input is empty, show the whole table
          searchResults.innerHTML = ''; // Clear results
          fetch('search2.php') // Send an AJAX request without a search term
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data; // Display the whole table
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      }
  });
});
// Search With & No Contact
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput3');
  const searchResults = document.getElementById('searchResults3');

  searchInput.addEventListener('input', function () {
      const searchTerm = searchInput.value.trim();

      if (searchTerm !== '') {
          // Send an AJAX request to search.php
          searchResults.innerHTML = '<p>Loading...</p>';
          fetch(`search3.php?term=${searchTerm}`)
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data;
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      } else {
          // When the input is empty, show the whole table
          searchResults.innerHTML = ''; // Clear results
          fetch('search3.php') // Send an AJAX request without a search term
              .then(response => response.text())
              .then(data => {
                  searchResults.innerHTML = data; // Display the whole table
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      }
  });
});
  </script>
  <script>
    const sidebar = document.querySelector(".sidebar");
const sidebarClose = document.querySelector("#sidebar-close");
const menu = document.querySelector(".menu-content");
const menuItems = document.querySelectorAll(".submenu-item");
const subMenuTitles = document.querySelectorAll(".submenu .menu-title");

sidebarClose.addEventListener("click", () => sidebar.classList.toggle("close"));

menuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    menu.classList.add("submenu-active");
    item.classList.add("show-submenu");
    menuItems.forEach((item2, index2) => {
      if (index !== index2) {
        item2.classList.remove("show-submenu");
      }
    });
  });
});
  </script>
</body>
</html>
