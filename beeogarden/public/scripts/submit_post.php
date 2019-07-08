<?php
session_start();

require_once "../connections/connection.php";
require_once "php_scripts.php";

if(verifyLogin()){
  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);
  if(isset($_GET['id'])){
    $campo_id = $_GET['id'];
    $texto_post = $_POST['texto-post'];
    $username = $_SESSION['username'];
    //get user id
    $query = "SELECT id_utilizador FROM utilizador WHERE utilizador LIKE ? ";
    if(mysqli_stmt_prepare($stmt,$query)){
      mysqli_stmt_bind_param($stmt,'s',$username);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt,$user_id);
        if(mysqli_stmt_fetch($stmt)){
          //
        }
      }
    }
    if($_FILES['foto-post']['error'] != 4){
      $target_dir = "../img/";
      $username_d = $_SESSION['username'];
      $username_d = str_replace('#','',$username_d);
      $username_d = str_replace('*','',$username_d);
      $rand = rand(1,1000000000);
      $fName = $username_d.'_post_'.$rand;
      $target_file = $target_dir . basename($_FILES["foto-post"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $target_file = $target_dir . basename($fName).'.' .$imageFileType;
      $check = getimagesize($_FILES["foto-post"]["tmp_name"]);
      if($check !== false){
          $uploadOk = 1;
      }else{
          $uploadOk = 0;
          echo 'O teu ficheiro não é uma foto.';
      }
      do{
          $rand = rand(1,1000000000);
          $target_file = $target_dir . basename($fName).'.' .$imageFileType;
      }while(file_exists($target_file));
      
      if($_FILES["foto-post"]["size"] > 300000000){
          $uploadOk = 0;
          echo 'A tua foto é demasiado grande.';
      }
      
      if($uploadOk == 0){
          echo 'Upload não realizado.';
      }else{
          if(move_uploaded_file($_FILES["foto-post"]["tmp_name"],$target_file)){
              //ficheiro uploaded.
              $target_file = str_replace('../','',$target_file);
              $query = "INSERT INTO posts (descricao,imagem,ref_Utilizador,ref_espaco) VALUES (?,?,?,?)";
              if(mysqli_stmt_prepare($stmt,$query)){
                mysqli_stmt_bind_param($stmt,'ssii',$texto_post,$target_file,$user_id,$campo_id);
                if(mysqli_stmt_execute($stmt)){
                  resize_crop_image(1280,720,$target_file,$target_file);
                  $link = "Location: ../feed-page.php?f=1&id=".$campo_id;
                  header($link);
                }
              }
          }
      }
  }else{
    $query = "INSERT INTO posts (descricao,imagem,ref_Utilizador,ref_espaco) VALUES (?,NULL,?,?)";
      if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'sii',$texto_post,$user_id,$campo_id);
        if(mysqli_stmt_execute($stmt)){
          // :D
          $link = "Location: ../feed-page.php?f=1&id=".$campo_id;
          header($link);
        }
      }
  } 
}else{
  header('../profile-page.php');
}
}
else{
    header('../login-page.php');
}
?>