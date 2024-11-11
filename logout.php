<?php 

// Start the session to enable access to session variables
session_start();

// Unset all session variables to clear the session
session_unset();

// Destroy the session completely
session_destroy();

// Redirect the user to the home page after session ends
exit(header('Location: index.php'));

?>
