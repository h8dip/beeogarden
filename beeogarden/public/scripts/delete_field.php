<?php
  session_start();
  require_once "php_scripts.php";
  require_once "../connections/connection.php";

  if(!verifyLogin()){
    header('Location: ../login-page.php');
  }

  if(isset($_GET['id'])){
    $id_espaco = $_GET['id'];
    $our_id = getUserId();
    //grab owner id.
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT ref_Utilizador FROM espaco WHERE id_espaco = ?";
    if(mysqli_stmt_prepare($stmt,$query)){
      mysqli_stmt_bind_param($stmt,'i',$id_espaco);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt,$id_dono);
        if(mysqli_stmt_fetch($stmt)){

        }
      }
    }

    if(verifyId($our_id,$id_dono)){
      //pog
      $query = "DELETE FROM espaco WHERE id_espaco = ?";
      if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'i',$id_espaco);
        if(mysqli_stmt_execute($stmt)){
          header('Location: ../profile-page.php');
        }
      }
    }else{
      header('Location: ../profile-page.php?error=not_field_owner');
    }
  }
?>