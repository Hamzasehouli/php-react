<?php
//////
session_start(); // Initialize the session
 

$_SESSION = array();// Unset all of the session variables the were stored during login and signup 
 

session_destroy(); // Destroy the session.
 

header('location: /'.basename(__DIR__).'/login.php'); // Redirect to login page
exit;
?>