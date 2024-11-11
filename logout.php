<?php
session_start(); // Start the session to manage user data

// Destroy the session to log the user out
session_destroy();

// Redirect to login page
header("Location: index.php");
exit(); // Ensure no further code is executed after the redirect
?>
