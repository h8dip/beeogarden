<?php
  session_start();

  if(isset($_SESSION['username'])){
    unset($_SESSION['username']);
  }
  if(isset($_SESSION['role'])){
    unset($_SESSION['role']);
  }


  session_destroy();
  Header('Location: ../login.php');
?>