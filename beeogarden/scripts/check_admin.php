<?php
  
  function checkAdmin(){

  session_start();
  if(isset($_SESSION['username'])){
    //Perfect
    if(isset($_SESSION['role'])){
      if($_SESSION['role']==2){
        //we stay where we are
      }else{
        Header('Location: login.php');
      }
    }else{Header('Location: login.php');}
  }else{
    Header('Location: login.php');
  }

  } 
?>