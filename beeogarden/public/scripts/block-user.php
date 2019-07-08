<?php 
 session_start();
 require_once "../connections/connection.php";
 require_once "php_scripts.php";

 if(verifyLogin()){
   if(isset($_GET['id']) and isset($_GET['b_id']))
   {
    $our_id = $_GET['id'];
    $to_block = $_GET['b_id'];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT blocked_by FROM utilizador WHERE id_utilizador = ?";
    if(mysqli_stmt_prepare($stmt,$query)){
      mysqli_stmt_bind_param($stmt,'i',$to_block);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt,$block_list);
        if(mysqli_stmt_fetch($stmt)){
          if(is_null($block_list) or $block_list==''){
            $block_list = $our_id;
            //submit
          }else{
            $ctr = 0;
            $tmp = explode(',',$block_list);
            foreach($tmp as $id){
              if($id == $our_id){
                $ctr++;
              }
            }
            
            if($ctr==0){
              $block_list .= ','.$our_id;
            }

          }

          $query = "UPDATE utilizador SET blocked_by = ? WHERE id_utilizador = ?";
          $link2 = new_db_connection();
          $stmt2 = mysqli_stmt_init($link2);
          if(mysqli_stmt_prepare($stmt2,$query)){
            mysqli_stmt_bind_param($stmt2,'si',$block_list,$to_block);
            if(mysqli_stmt_execute($stmt2)){
              //success.
              header('../profile-page.php');
            }
          }
        }
      }
    }
   }
 }else{
   header('Location: ../login-page.php');
 }
?>