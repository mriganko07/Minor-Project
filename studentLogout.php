<?php
// Start or resume an existing session
session_start();

// Destroy all data associated with the existing session
session_destroy();

// Redirect to the 'index.php' page after destroying the session
header("location: index.php");
?>
