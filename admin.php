<?php
// Start the session
session_start();

// Check if the user is not logged in (session variable not set)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page (index.php)
    header("Location: index.php");
    exit();
}
$databaseHost = 'localhost';
        $databaseUsername = 'root';
        $databasePassword = '';
        $dbname = "tdroDB";

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
 $databaseUsername = 'root';
 $databasePassword = '';
 $dbname = "tdroDB";
    
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlInt = "SELECT * FROM data_info ";
    $resultInt = $conn->query($sqlInt)
?>
<?php
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "tdroDB";
    
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
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "tdroDB";
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
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "tdroDB";

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
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "tdroDB";

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
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "tdroDB";

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
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "tdroDB";

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
                <h5 style="font-weight:lighter;">Updated<?php echo getLastUpdatedTime2($conn); ?> </h5>
              </div>
            </div>
            <div class="box-container">
              <div class="box-a">
                <div class="chart">
                  <canvas id="linechart" width="400" height="440"></canvas>
                </div>
              </div>
              <div class="box-a">
              <button data-modal-target="#map-modal" class="viewbutton">View Map</button>
             <div class="modal" id="map-modal">
              <div class="modal-header">
                <div class="title">'Overall Map View List of Violations'</div>
                  <center><h1>Google Map</h1></center>
                  <div id="map"></div>
              </div>
              <button data-close-button class="close-button">&times;</button>
              <div class="modal-body">
                <div class="box-c">
                </div>
    </div>
    </div>
                <div class="chart">
                  <canvas id="barchart" width="400" height="410"></canvas>
                </div>
              </div>
              <div class="box-a">
                <div class="chart">
                  <canvas id="doughnut" width="100" height="200"></canvas>
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
                  <input type="text" id="searchInput1" placeholder="Search by Name or #">
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
             
             <h2 style="margin-top: -30px;">Total Contact Apprehensions</h2>
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
                  <input type="text" id="searchInput2" placeholder="Search by Name or Plate#">
                </div>
                <div id="searchResults2">
                <?php if ($resultInfoS->num_rows > 0) : ?>
        <table class="content-table">
            <thead>
                <tr>
                    <th>Ticket No.</th>
                    <th>Plate Number</th>
                    <th>Apprehending Officer</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultInfoS->fetch_assoc()) : ?>
                  <tr class="table-row">
                        <td ><?= $row['TicketNo'] ?></td>
                        <td><?= $row['PlateNumber'] ?></td>
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
             <h2 style="margin-top: -30px;">Total No Contact Apprehensions</h2>
             <p><?= $totalApprehensionsN ?></p>
           </div>
         </div>
       
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
           <div class="box-b" style=" height: 600px;">
     <div class="search-bar">
       <input type="text" class="search-input" id="searchInput4" placeholder="Search by Name or #">
     </div>
     <div class="filter-buttons">
       <button id="showAll"><i aria-hidden="true"></i> Show All</button>
       <button id="successList"><i aria-hidden="true"></i> Settled List</button>
       <button id="failedList"><i aria-hidden="true"></i> Unsettled List</button>
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
                <p>No Violators Found</p>
            <?php endif; ?>
        </div>
        </div>
     </div>
       <!-- Hidden modal for violator details -->
          <div id="myModal2" class="modal2">
                <div class="modal-content2">
                  <span class="close2" id="closeModal">&times;</span>
                  <h1 style="font-weight:bolder; color: #fff; font-size: 30px; margin-top: -50px" >Violator's Details</h1><br>
                  <div id="modalContent">
                  
                </div>
              </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
      // Get the modal element and close button
      var modal = $("#myModal2");
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
    <?php session_destroy(); ?>
    const confirmation = confirm("Are you sure you want to log out?");
    if (confirmation) {
      window.location.href = "index.php";
    }
  }
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
</body>
</html>
