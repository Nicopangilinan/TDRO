<?php
              session_start();
              $databaseHost = 'localhost';
        $databaseUsername = 'root';
        $databasePassword = '';
        $dbname = "tdroDB";

              // Create a connection
              $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

              // Check the connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              // Check if the user is logged in (user ID is set in the session)
              if (!isset($_SESSION['user_id'])) {
                  // Redirect to the login page or perform other actions for non-logged-in users
                  header("Location:index.php");
                  exit();
              }

              // Retrieve the user ID from the session
              $userID = $_SESSION['user_id'];
              echo  $userID;
              $credResults = mysqli_query($conn, "SELECT username FROM admin WHERE user_id = $userID");

              if (!$credResults) {
                  die("Error: " . mysqli_error($conn)); // Display the error message
              }

              $credRes = mysqli_fetch_array($credResults);
              echo $credRes['username'];
            ?>