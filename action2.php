<?php 
		session_start(); // creates session
		$databaseHost = 'localhost';
	$databaseUsername = 'u488180748_TDROB4t5s';
	$databasePassword = 'TDROB4t5s';
	$dbname = "u488180748_TDROB4t5s";
		
        // Connect to the webapp_db database
        $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);
    

		// assigns value from the edit admin credentials
		if (isset($_POST['UpdateCredentials'])) {
			$oldUser = $_POST['oldUser'];
			$user = $_POST['username'];
			$oldPass = $_POST['old_password'];
			$newPass = $_POST['newpassword'];
			$rePass = $_POST['repass'];
            echo $oldUser;
            echo $user;
			// performs a query
			$result = mysqli_query($conn, "SELECT * FROM admin WHERE username='$oldUser'    ");
			$res = mysqli_fetch_array($result);

			// checks if the username is matches the old username
			if ($oldUser == $res['username']) {
				// checks if the old password matches the input
				if ($oldPass == $res['password']) {
					if ($newPass == "" && $rePass == "") {
						$result = mysqli_query($conn, "UPDATE admin SET username = '$user' WHERE username='$oldUser'");

						if ($result) {
							echo '<script>alert("New Credentials Updated. Logging Out")</script>';
							echo "<script>window.location.href='index.php'</script>";
						} else {
							echo '<script>alert("Error. Please Try Again.")</script>';
						}
					}

					// checks if the new pass and and re enter password is the same and performs the query
					else if ($newPass == $rePass) {

						$result = mysqli_query($conn, "UPDATE admin SET username = '$user', password = '$rePass' WHERE username='$oldUser'");

						if ($result) {
							echo '<script>alert("New Credentials Updated. Logging Out")</script>';
							echo "<script>window.location.href='index.php'</script>";
						} else {
							echo '<script>alert("Error. Please Try Again.")</script>';
						}
					} else {
						echo '<script>alert("New Password and Re-Password doesn\'t match. Please try again.")</script>';
					}
				} else {
					echo '<script>alert("Old password is incorrect.")</script>';
				}
			} 
		}
	?>