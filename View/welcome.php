<?php

session_start();
$username = $_SESSION['username']; 
echo'welcome: ' . $username . '<br>';
echo'<a href="signout.php">Signout</a>';
?>
