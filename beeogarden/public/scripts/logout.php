<?php
  require_once "php_scripts.php";
  session_start();
  if(verifyLogin()){
    session_destroy();
    header('Location: ../welcome-page.php');
  }else{
    header('Location: ../profile-page.php');
  }
?>