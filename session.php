<?php
if (session_status() === PHP_SESSION_NONE) { //check if the session already exists or not;
    session_start();
}
    
    if (empty($_SESSION['username'])) {
        echo '';//if the user does not exist, an empty strings will be returned;
    } else {
        $_SESSION['loggedin'] = true; //set all the variables in order to be used in other pages were the session file is included;
        $_SESSION['id'] = $_SESSION['id'];
        $_SESSION['username'] =$_SESSION['username'];
    }
?>