<?php
session_start();
  if (empty($_SESSION['username'])) {
      header('location:login.php');
  }else{
        $username = $_SESSION['username']; 
        echo'welcome: ' . $username . '<br>';
        echo'<a href="signout.php">Signout</a>';
  }
?>
