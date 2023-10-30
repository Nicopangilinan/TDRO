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

    $sql = "SELECT * FROM traffic_violation ";

    $result2 = $conn->query($sql)
    ?>
<?php
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
$sqlInt = "SELECT * FROM data_info";
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
    <title>TDRO Officer</title>
    <link rel="stylesheet" href="index.css" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
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
          <p>Officer</p>
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
        <button type="button" class="button" data-modal-target="#third-modal">
      <span class="button__text" >Create Report</span>
      <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg></span>
    </button>
             <div class="modal" id="third-modal">
              <div class="modal-header">
                <div class="title" style="font: size 30px;;">Traffic Citation Form</div>
              </div>
              <button data-close-button class="close-button">&times;</button>
              <div class="modal-body">
    <div class="box-d">
<form action="upload.php" method="POST">
     <div class="form-row">
        <div class="form-group">
            <label for="date">Select Date & Time<span class="required">*</span></label>
            <input type="datetime-local" name="date" required>
        </div>
        <div class="form-group">
            <label for="officer">Officer:<span class="required">*</span></label>
            <input type="text" name="officer" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="name">Name:<span class="required">*</span></label>
            <input type="text" id="nameInput" name="name" required>
            <button type="button" id="unattendedButton" onclick="handleUnattended()">Unattended</button>
        </div>

        <div class="form-group">
            <label for="ticket_number">Ticket Number:<span class="required">*</span></label>
            <input type="text" name="ticket_number" required>
        </div>
    </div>

    <div class="form-row">
    <div class="form-group">
        <label for="violation_type">Violation Type:<span class="required">*</span></label>
        <select id="violation_type" name="violation_type" required>
            <!-- Options will be added dynamically via JavaScript -->
        </select>
    </div>

    <div class="form-group">
        <label for="violation">Violation:<span class="required">*</span></label>
        <select id="violation" name="violation" required>
            <option value="" disabled selected>Select Violation Type first</option>
            <!-- Options will be added dynamically via JavaScript -->
        </select>
    </div>
    </div>

    <div class="form-row">
    <div class="form-group">
        <label for="other_violation">Other Violation (Optional):</label>
        <input type="text" name="other_violation">
    </div>
    <div class="form-group">
        <label for="place_of_violation">Place of Violation:<span class="required">*</span></label>
        <input type="text" name="place_of_violation" required>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="plate_number">Plate Number:</label>
        <input type="text" name="plate_number">
    </div>
    <div class="form-group">
        <label for="cnc">C/NC:<span class="required">*</span></label>
        <select name="cnc" required>
            <option value="C">C</option>
            <option value="NC">NC</option>
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="or_number">OR Number:</label>
        <input type="text" name="or_number" id="or_number" class="disabled-field">
    </div>
    <div class="form-group">
        <label for="license_number">License Number:<span class="required">*</span></label>
        <input type="text" name="license_number" id="license_number" required>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="or_date">OR Date:</label>
        <input type="date" name="or_date" id="or_date" class="disabled-field">
    </div>
    <div class="form-group">
        <label for="status">Status:<span class="required">*</span></label>
        <select name="status" id="status" required>
            <option value="Settled">Settled</option>
            <option value="Unsettled">Unsettled</option>
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="penalty">Penalty:<span class="required">*</span></label>
        <input type="text" name="penalty" required>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <input type="submit" value="Submit">
    </div>
</div>
    </form>

      </nav>
      <main class="main">
        <div class="tab-content">
          <div class="tab-pane" id="dashboard">
            <h1>Officer Dashboard</h1>
            <div class="box-container">
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
                <p><?= $totalMaster ?></p>
              </div>
            </div>
            <div class="box-container">
            <div class="box-b" style="margin: auto;">
            <h2 style="margin-bottom: 10px;">Violation List</h2>
           <?php if ($result2->num_rows > 0) : ?>
        <table class="content-table">
            <thead>
                <tr>
                    <th>A. Licenses/Registration/Permits</th>
                    <th>B. Illegal Operation</th>
                    <th>C. Other Violations</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result2->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['A. Licenses/Registration/Permits'] ?></td>
                        <td><?= $row['B. Illegal Operation'] ?></td>
                        <td><?= $row['C. Other Violations'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No Violations Found</p>
    <?php endif; ?>
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
       
           <!--ALL-->
           <div class="box-b">
             <h2>List of Total Apprehension with Contact and No Contact</h2>
             <div class="search-bar">
             <input type="text" class="search-input" id="searchInput3" placeholder="Search by Name or #">
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
              <form action="action2.php" method="post">
                <h2 style="color:#fff;">Change Credentials</h2>
                <label for="username">Username: </label>
                <input type="text" name="username" id="User" value="officer" readonly><br>
                <label for="old_password">Old Password: </label>
                <input type="password" name="old_password" id="Password"><br>
                <label for="newpassword">New Password: </label>
                <input type="password" name="newpassword" id="newPassword"><br>
                <label for="repass">Re-enter New Password: </label>
                <input type="password" name="repass" id="rePassword"><br>
                <input type="hidden" name="oldUser" value="officer">
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
           <h1>TDRO Master List</h1>
   <div class="box-b" style=" height: 600px;">
     <div class="search-bar">
       <input type="text" class="search-input" id="searchInput4" placeholder="Search by Name or #">
     </div>
     <div class="filter-buttons">
       <button id="showAll"><i aria-hidden="true"></i> Show All</button>
       <button id="successList"><i aria-hidden="true"></i> Settled List</button>
       <button id="failedList"><i aria-hidden="true"></i> Unsettled List</button>
       <button id="failedList"><i aria-hidden="true"></i> Case Files</button>
     </div>
       <div id="searchResults4">
       <?php if ($resultInt->num_rows > 0) : ?>
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
          <div id="myModal" class="modal2">
                <div class="modal-content2">
                  <span class="close2" id="closeModal">&times;</span>
                  <h1 style="font-weight:bolder; color: #fff; font-size: 30px; margin-top: -50px" >Violator's Details</h1><br>
                  <div id="modalContent2">
                  
                </div>
              </div>
          </div>
</div>
     </div>
     </div>
     </div>
     </main>
     </div>
       <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
       <script src="script.js"></script>
       <script>
  
</script>
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
