<?php
  session_start();

  require_once "php_scripts.php";
  require_once "../connections/connection.php";
  if(verifyLogin()){
  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);
  $stmt2 = mysqli_stmt_init($link);

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

        verificaCampos($_GET['id']);

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
  }

  function verificaCampos($id_compra){

    $link = new_db_connection();
    
    
    $stmt = mysqli_stmt_init($link);
    

    $our_id = getUserId();

    $query = "SELECT outro_campo FROM compras_has_produto WHERE ref_compra = ?";
    if(mysqli_stmt_prepare($stmt,$query)){
      mysqli_stmt_bind_param($stmt,'i',$id_compra);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt,$outro_campo);
        while(mysqli_stmt_fetch($stmt)){
          $tmp = explode(',',$outro_campo);
          //var_dump($tmp);
          foreach($tmp as $field){
            $field = intval($field);
            $new_query = "SELECT ref_contribuidores FROM espaco WHERE id_espaco = ?";
            $link2 = new_db_connection();
            $stmt2 = mysqli_stmt_init($link2);
            if(mysqli_stmt_prepare($stmt2,$new_query)){
              mysqli_stmt_bind_param($stmt2,'i',$field);
              if(mysqli_stmt_execute($stmt2)){
                mysqli_stmt_bind_result($stmt2,$ref_contribuidores);
                if(mysqli_stmt_fetch($stmt2)){
                  if($ref_contribuidores == '' or is_null($ref_contribuidores) or empty($ref_contribuidores)){
                    $new_query = "UPDATE espaco SET ref_contribuidores = ? WHERE id_espaco = ?";
                    $ref_contribuidores = $our_id;
                    $link3 = new_db_connection();
                    $stmt3 = mysqli_stmt_init($link3);
                    if(mysqli_stmt_prepare($stmt3,$new_query)){
                      mysqli_stmt_bind_param($stmt3,'ii',$ref_contribuidores,$field);
                      if(mysqli_stmt_execute($stmt3))
                      {
                        //awesome.
                      }
                    }
                  }else{
                    $camps_tmp = explode(',',$ref_contribuidores);
                    $counter = 0;
                    foreach($camps_tmp as $usuario){
                      if($usuario == $our_id){
                        $counter++;
                      }
                    }
                    if($counter==0){
                      $ref_contribuidores .= ','.$our_id;
                      $new_query = "UPDATE espaco SET ref_contribuidores = ? WHERE id_espaco = ?";
                      $link3 = new_db_connection();
                      $stmt3 = mysqli_stmt_init($link3);
                      if(mysqli_stmt_prepare($stmt3,$new_query)){
                        mysqli_stmt_bind_param($stmt3,'si',$ref_contribuidores,$field);
                        if(mysqli_stmt_execute($stmt3))
                        {
                          //awesome.
                        }
                      }
                    }
                  }                  
                }
              }
            }else{
              //printf(mysqli_stmt_error($stmt2));
            }
          }
        }
      }
    }
  }
?>