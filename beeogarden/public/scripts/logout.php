<?php
  require_once "php_scripts.php";
  session_start();
  if(verifyLogin()){
    session_destroy();
    header('Location: ../index.php');
  }else{
    header('Location: ../profile-page.php');
  }
?>