<?php
  session_start();

  require_once "../connections/connection.php";

  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);

  if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];
    if(isset($_GET['id'])){
      $query = "SELECT COUNT(*) FROM compras INNER JOIN utilizador ON utilizador = ?  WHERE id_compra = ? AND data_compra IS NULL OR data_compra = ' '";
      if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'si',$user,$_GET['id']);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt,$count);
            if(mysqli_stmt_fetch($stmt)){
                
            }
        }
      }

      $query = "SELECT preco_total FROM compras WHERE id_compra = ?";
      if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'i',$_GET['id']);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt,$preco_total);
            if(mysqli_stmt_fetch($stmt)){
                
            }
        }
      }

      if($count >= 1){
        //verificar se contem outros campos
        //first task of the day :D
        $novo_preco = $preco_total + (0.13*$preco_total);
        $query = "UPDATE compras SET data_compra = CURRENT_TIMESTAMP, preco_total = ? WHERE id_compra = ?";
        if(mysqli_stmt_prepare($stmt,$query)){
          mysqli_stmt_bind_param($stmt,'di',$novo_preco,$_GET['id']);
          if(mysqli_stmt_execute($stmt)){
              header('Location: ../cart.php?f=true');
          }
        }
      }else{
        header('Location: ../cart.php');
      }
    }else{
      header('Location: ../cart.php');
    }
  }else{
    header('Location: ../login-page.php');
  }
?>