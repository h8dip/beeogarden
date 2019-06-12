<?php

  require_once "../connections/connection.php";

  if(isset($_GET['class'])){
    if(isset($_GET['id'])){
      $table_to_delete = "";
      $redirect_to = "";
      $id_utilizador="";
      switch($_GET['class']){
          case 'u':
            $table_to_delete="utilizador";
            $value_to_match = "id_utilizador";
            $redirect_to = "utilizadores.php";
          break;
          case 'c':
            $table_to_delete="espaco";
            $value_to_match = "id_espaco";
            $redirect_to = "campos.php";
          break;  
          case 'p':
            $table_to_delete="produto";
            $value_to_match = "id_produto";
            $redirect_to = "produtos_loja.php";
          break;
          case 'i':
            $table_to_delete="info";
            $value_to_match = "id_info";
            $redirect_to = "informacoes.php";
          break;
          case 'pub':
            $table_to_delete= "posts";
            $value_to_match= "id_post";
            $redirect_to= "publicacoes.php";
          break;
      }
      $link = new_db_connection();
      $stmt = mysqli_stmt_init($link);
      $query =  "DELETE FROM " .$table_to_delete. " WHERE " . $value_to_match . " LIKE ?";
      if(mysqli_stmt_prepare($stmt,$query)){
        
        mysqli_stmt_bind_param($stmt,'i',$_GET['id']);
        if(mysqli_stmt_execute($stmt)){
          
          header('Location: ../'.$redirect_to);
        }
          header('Location: ../'.$redirect_to);
      }
    }
  }
  else{
    header('Location: ../index.php');
  }
?>