<?php
  require_once "../../connections/connection.php";

  $hop_to = "../../";
  $table_to_edit="";
  $table_id_name ="";
  $query = "UPDATE ";

  if(isset($_GET['page'])){
      if($_GET['page']=="produtos_loja"){
        $hop_to.=$_GET['page'].'.php';
        $table_to_edit="produto ";
        $table_id_name = "id_produto";
        $query .= $table_to_edit . 'SET ';
      }else if($_GET['page']=="utilizadores"){
        $hop_to.=$_GET['page'].'.php';
        $table_to_edit="utilizador ";
        $table_id_name = "id_utilizador";
        $query .= $table_to_edit . 'SET ';
      }
      else if($_GET['page']=="informacoes"){
        $hop_to.=$_GET['page'].'.php';
        $table_to_edit="info ";
        $table_id_name = "id_info";
        $query .= $table_to_edit . 'SET ';
      }
  }else{header('Location: ../../index.php');}

  end($_POST);
  $last_el = key($_POST);
  reset($_POST);

  foreach($_POST as $key => $value)
  {
    //if($value == NULL ) {$value = 0;}

    if($key == $last_el){
      $query .= $key . ' = '. "'".htmlspecialchars($value) . "' ";
    }else{
      $query .= $key . ' = '. "'".htmlspecialchars($value) . "', ";
    }
  }
  $query .= 'WHERE ' . $table_id_name . " = '" . $_GET['id'] . "'"; 
  //echo $query;

  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);
  if(mysqli_stmt_prepare($stmt, $query)){
    if(mysqli_stmt_execute($stmt)){
      //noice
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
  }
  echo $query;
  header('Location: '.$hop_to);
?>