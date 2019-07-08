<?php

  session_start();

  require_once "../connections/connection.php";
  require_once "php_scripts.php";
  
  if(verifyLogin()){



    if(isset($_GET['id'])){

      $link = new_db_connection();
      $stmt = mysqli_stmt_init($link);

      $our_id = $_GET['id'];
      $to_block = $_GET['b_id'];
      $motivo = $_POST['motivo'];
      $mtv_str="";
      $comentario = $_POST['comentario'];

      switch($motivo){
        case 'spam':
        $mtv_str="Spam";
        break;
        case 'nudez':
        $mtv_str="Nudez ou pornogarfia";
        break;
        case 'improprio':
        $mtv_str="Discurso impróprio";
        break;
        case 'violencia':
        $mtv_str="Ameças de violência";
        break;
        case 'drogas':
        $mtv_str="Venda ou promoção de drogas";
        break;
        case 'assedio':
        $mtv_str="Assédio ou bullying";
        break;
        case 'identidade':
        $mtv_str="Usurpação de identidade";
        break;
        default:
          $mtv_str="";
        break;
      }

      $texto = $mtv_str . ' - ' . $comentario;

      $query = "INSERT INTO reports (data_report,ref_Utilizador,ref_post) VALUES(?,?,?)";
      if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'sii',$texto,$our_id,$to_block);
        if(mysqli_stmt_execute($stmt)){
          header('Location: ../profile-page.php');
        }
      }

    }
  }else{
    header('Location: ../login-page.php');
  }
?>