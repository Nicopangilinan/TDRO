<?php
// Start the session
session_start();

// Destroy the session data
session_destroy();

// Redirect the user to the login page (index.php)
header("Location: index.php");
exit();
?>
