<?php
session_start();
$_SESSION = array();   // Clear all session data from memory
session_destroy();     // Clean up the session ID
header("Location: .");

?>