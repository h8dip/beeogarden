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
        distribuirBeeopts($_GET['id']);

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
  
  function distribuirBeeopts($id_compra){
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $our_id = getUserId();


    //obter todo o valor de beeopts de cada produto para consumo individual.
    $query = "SELECT ref_produto, quantidade, custo_produto, outro_campo, outro_campo_qtd FROM compras_has_produto WHERE ref_compra = ?";
    if(mysqli_stmt_prepare($stmt,$query)){
      mysqli_stmt_bind_param($stmt,'i',$id_compra);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt,$ref_produto,$quantidade,$custo_produto,$outro_campo,$outro_campo_qtd);
        while(mysqli_stmt_fetch($stmt)){
          $beevalue = obtainBeeValue($ref_produto);
   
          //add to self.
          $beepts = $beevalue * $quantidade;
  
          creditSelf($our_id,$beepts);

          //calculate field pts , if any.
          if(!empty($outro_campo) or !is_null($outro_campo) or $outro_campo != ''){
            $list = explode(',',$outro_campo);
            $beepts = $beevalue * $outro_campo_qtd;
            foreach($list as $campo){
              creditCampo($campo,$beepts);
            }
          }
        }
      }
    }
  }

  function creditCampo($id,$beepts){
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT beeopoints FROM espaco WHERE id_espaco = ?";
    if(mysqli_stmt_prepare($stmt,$query)){
      mysqli_stmt_bind_param($stmt,'i',$id);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt,$beect);
        if(mysqli_stmt_fetch($stmt)){
          $newpts = $beect + $beepts;
          $query = "UPDATE espaco SET beeopoints = ? WHERE id_espaco = ?";
          if(mysqli_stmt_prepare($stmt,$query)){
            mysqli_stmt_bind_param($stmt,'ii',$newpts,$id);
              if(mysqli_stmt_execute($stmt)){
                //done.
              }
          }
        }
      }
    }
  }

  function creditSelf($id,$beepts){
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT beeopoints FROM utilizador WHERE id_utilizador = ?";
    if(mysqli_stmt_prepare($stmt,$query)){
      mysqli_stmt_bind_param($stmt,'i',$id);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt,$beect);
        if(mysqli_stmt_fetch($stmt)){
          $newpts = $beect + $beepts;
        
          $query = "UPDATE utilizador SET beeopoints = ? WHERE id_utilizador = ?";
          if(mysqli_stmt_prepare($stmt,$query)){
            mysqli_stmt_bind_param($stmt,'ii',$newpts,$id);
              if(mysqli_stmt_execute($stmt)){
                //done.
              }
            
          }
        }
      }
    }
  }

  function obtainBeeValue($id_produto){
    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);
    $query_pd = "SELECT beecount FROM produto WHERE id_produto = ?";
    if(mysqli_stmt_prepare($stmt2,$query_pd)){
      mysqli_stmt_bind_param($stmt2,'i',$id_produto);
      if(mysqli_stmt_execute($stmt2)){
        mysqli_stmt_bind_result($stmt2,$beecount);
        if(mysqli_stmt_fetch($stmt2)){
          return $beecount;
        }
      }
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