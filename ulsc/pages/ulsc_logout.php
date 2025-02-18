<?php
session_start();
<<<<<<< HEAD

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: ulsc_login.php");
exit;
=======
session_unset();
session_destroy();
header("Location: ../index.php");
exit();
>>>>>>> 8244d27 (Download PDF)
?>
