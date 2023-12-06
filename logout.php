<?php
// Start the session
session_start();

// Clear user-specific session variables
unset($_SESSION['user_id']); // You can unset other user-related variables as well

// Redirect the user to the login page (index.php) or any other appropriate page
header("Location: index.php");
exit();
?>
