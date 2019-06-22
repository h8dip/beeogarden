<?php 
  session_start();

  require_once "../connections/connection.php";

  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);

  if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];
    if(isset($_GET['c_id'])){
      $query = "SELECT COUNT(*) FROM compras INNER JOIN utilizador ON utilizador = ?  WHERE id_compra = ? AND data_compra IS NULL OR data_compra = ' '";
      if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'si',$user,$_GET['c_id']);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt,$count);
            if(mysqli_stmt_fetch($stmt)){
                
            }
        }
      }

      if($count >= 1){
        if(isset($_GET['p_id'])){
          $compra_id = $_GET['c_id'];
          $produto_id = $_GET['p_id'];

          $query = "DELETE FROM compras_has_produto WHERE ref_compra = ? AND ref_produto = ?";
          if(mysqli_stmt_prepare($stmt,$query)){
            mysqli_stmt_bind_param($stmt,'ii',$compra_id,$produto_id);
            if(mysqli_stmt_execute($stmt)){
              //
            }
          }

          $query = "SELECT COUNT(*) FROM compras_has_produto WHERE ref_compra = ?";
          if(mysqli_stmt_prepare($stmt,$query)){
            mysqli_stmt_bind_param($stmt,'i',$compra_id);
            if(mysqli_stmt_execute($stmt)){
              mysqli_stmt_bind_result($stmt,$remaining_count);
              if(mysqli_stmt_execute($stmt)){
                //
              }
            }
          }
          
          if($remaining_count==0){
            $query = "DELETE FROM compras WHERE id_compra = ?";
            if(mysqli_stmt_prepare($stmt,$query)){
              mysqli_stmt_bind_param($stmt,'i',$compra_id);
              if(mysqli_stmt_execute($stmt)){
                
              }
            }
          }

          header("Location: ../cart.php");
        }
      }else{
        header("Location: ../profile-page.php");
      }
    }else{
      header("Location: ../profile-page.php");
    }
  }else{
    header("Location: ../login-page.php");
  }
?>