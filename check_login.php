<?php
// Start a new or resume an existing session
session_start();

// Regenerate session ID to help prevent session fixation attacks
session_regenerate_id(true);

// Check if the user is not logged in or the 'loggedin' session variable is not set to true
if ((!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] != true)){
  // Redirect to the studentLogin.php page if not logged in
  header("location: studentLogin.php");
}
else {
    // Retrieve user information from session variables if logged in
    $user_name = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];
    $user_email = $_SESSION['user_email'];
}
?>
