<?php 
  function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
      $imgsize = getimagesize($source_file);
      $width = $imgsize[0];
      $height = $imgsize[1];
      $mime = $imgsize['mime'];
  
      switch($mime){
          case 'image/gif':
              $image_create = "imagecreatefromgif";
              $image = "imagegif";
              break;
  
          case 'image/png':
              $image_create = "imagecreatefrompng";
              $image = "imagepng";
              $quality = 7;
              break;
  
          case 'image/jpeg':
              $image_create = "imagecreatefromjpeg";
              $image = "imagejpeg";
              $quality = 80;
              break;
  
          default:
              return false;
              break;
      }
      
      $dst_img = imagecreatetruecolor($max_width, $max_height);
      $src_img = $image_create($source_file);
      
      $width_new = $height * $max_width / $max_height;
      $height_new = $width * $max_height / $max_width;
      //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
      if($width_new > $width){
          //cut point by height
          $h_point = (($height - $height_new) / 2);
          //copy image
          imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
      }else{
          //cut point by width
          $w_point = (($width - $width_new) / 2);
          imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
      }
      
      $image($dst_img, $dst_dir, $quality);
  
      if($dst_img)imagedestroy($dst_img);
      if($src_img)imagedestroy($src_img);
  }

  function verifyLogin(){
      if(isset($_SESSION['username'])){
          if(!empty($_SESSION['username'])){
            return true;
          }else{
              return false;
          }
      }else{
          return false;
      }
  }

  function checkCartCounter(){

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    if(isset($_SESSION['username'])){
        $nome_utilizador = $_SESSION['username'];

    }
    $query = "SELECT id_utilizador FROM utilizador WHERE utilizador LIKE ?";
    if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'s',$nome_utilizador);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt,$id_utilizador);
            if(mysqli_stmt_fetch($stmt)){
                
            }
        }
    }

    $query = "SELECT COUNT(*) FROM compras WHERE ref_Utilizador = ? AND data_compra IS NULL OR data_compra = ' '";
    if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'i',$id_utilizador);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt,$carrinho);
            if(mysqli_stmt_fetch($stmt)){
               
            }
        }
    }

    if($carrinho >= 1){
        $query = "SELECT id_compra FROM compras WHERE ref_Utilizador = ? AND data_compra IS NULL or data_compra = ' '";
            if(mysqli_stmt_prepare($stmt,$query)){
                mysqli_stmt_bind_param($stmt,'i',$id_utilizador);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt,$id_compra);
                    if(mysqli_stmt_fetch($stmt)){
                        //temos agr id da compra e preço total.   
                    }
                }
        }

        $middle = 0;
        $query = "SELECT COUNT(*),quantidade FROM compras_has_produto WHERE ref_compra = ?";
        if(mysqli_stmt_prepare($stmt,$query)){
            mysqli_stmt_bind_param($stmt,'i',$id_compra);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$counter,$quantidade);
                $extra = 0;
                while (mysqli_stmt_fetch($stmt)){
                    $extra += ($quantidade-1);
                }
                $middle = $counter+$extra;
            }
        }
        $outros_total=0;
        $query = "SELECT outro_campo_qtd FROM compras_has_produto WHERE ref_compra = ?";
        if(mysqli_stmt_prepare($stmt,$query)){
            mysqli_stmt_bind_param($stmt,'i',$id_compra);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt,$quantidade_outros);
                while (mysqli_stmt_fetch($stmt)){
                    if(is_numeric($quantidade_outros)){
                        $outros_total += $quantidade_outros;
                    }
                }
                return $middle + $outros_total;
            }
        }
    }else{
        return 0;
    }
  }

  function getUserId(){
      $nome = $_SESSION['username'];
      $link = new_db_connection();
      $stmt = mysqli_stmt_init($link);
      $query = "SELECT id_utilizador FROM utilizador WHERE utilizador LIKE ?";
      if(mysqli_stmt_prepare($stmt,$query)){
          mysqli_stmt_bind_param($stmt,'s',$nome);
          if(mysqli_stmt_execute($stmt)){
              mysqli_stmt_bind_result($stmt,$id_user_ex);
              if(mysqli_stmt_fetch($stmt)){
                  return $id_user_ex;
              }
          }
      }

      
  }

  function fetchLastMessage($our_id,$other_id){
      $link = new_db_connection();
      $stmt = mysqli_stmt_init($link);
      $query = "SELECT COUNT(*), id_chat FROM chat WHERE ref_utilizador_a = ? and ref_utilizador_b = ?";
      if(mysqli_stmt_prepare($stmt,$query)){
          mysqli_stmt_bind_param($stmt,'ii',$our_id,$other_id);
          if(mysqli_stmt_execute($stmt)){
              mysqli_stmt_bind_result($stmt,$count,$id);
              if(mysqli_stmt_fetch($stmt)){
                  if($count == 0){
                    $query = "SELECT COUNT(*), id_chat FROM chat WHERE ref_utilizador_a = ? and ref_utilizador_b = ?";
                    if(mysqli_stmt_prepare($stmt,$query)){
                        mysqli_stmt_bind_param($stmt,'ii',$other_id,$our_id);
                        if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_bind_result($stmt,$count,$id);
                            if(mysqli_stmt_fetch($stmt)){
                                //grab id

                            }
                  }
                    }
                }
      }
     }
    }

    //our id.
    $query = "SELECT mensagem, date_creation_message FROM mensagens WHERE ref_chat = ? ORDER BY id_mensagem DESC";
    if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'i',$id);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt,$mensagem,$date);
            if(mysqli_stmt_fetch($stmt)){
                return array($mensagem,$date);
            }
        }
    }
   }

  function obtainOwnerInfo($id){
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT id_utilizador, utilizador, foto_perfil FROM utilizador INNER JOIN espaco ON id_utilizador = ref_Utilizador WHERE id_espaco = ?";
    if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'i',$id);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt,$id_user,$username,$foto_perfil);
            if(mysqli_stmt_fetch($stmt)){
                return array($id_user,$username,$foto_perfil);
            }
        }
    }
  }
  
  function fill_owner_chat($info,$f_id,$our_id){
    if($info[2] == "" or is_null($info[2])){
        $info[2] = "img/default-user.png";
    }
    $arr = fetchLastMessage($our_id,$info[0]);
    echo '<div class="chat-person">';
    echo '<div class="chat-person-image">';
    echo '<a href="chat-page.php?id='.$info[0].'&f_id='.$f_id.'">';
    echo '<div class="chat-person-img-container">';
    echo '<img src="'.$info[2].'" alt="">';
    echo '</div>';
    echo '</a>';
    echo '</div>';
    echo '<div class="chat-person-text-container">';
    echo '<a href="chat-page.php?id='.$info[0].'&f_id='.$f_id.'">';
    echo '<h2>'.$info[1].'</h2>';
    echo '<h4>'.$arr[0].'</h4>';
    echo '</a>';
    echo '</div>';
    echo '<div class="chat-person-info-container">';
    echo '<i class="fas fa-check"></i>';
    echo '<h4>'.$arr[1].'</h4>';
    echo '</div>';
    echo '</div>';
  }

  function layout_chat($id,$name,$foto,$f_id,$our_id){
    if($foto == "" or is_null($foto)){
        $foto = "img/default-user.png";
    }
    $arr = fetchLastMessage($our_id,$id);
    echo '<div class="chat-person">';
    echo '<div class="chat-person-image">';
    echo '<a href="chat-page.php?id='.$id.'&f_id='.$f_id.'">';
    echo '<div class="chat-person-img-container">';
    echo '<img src="'.$foto.'" alt="">';
    echo '</div>';
    echo '</a>';
    echo '</div>';
    echo '<div class="chat-person-text-container">';
    echo '<a href="chat-page.php?id='.$id.'&f_id='.$f_id.'">';
    echo '<h2>'.$name.'</h2>';
    echo '<h4>'.$arr[0].'</h4>';
    echo '</a>';
    echo '</div>';
    echo '<div class="chat-person-info-container">';
    echo '<i class="fas fa-check"></i>';
    echo '<h4>'.$arr[1].'</h4>';
    echo '</div>';
    echo '</div>';
  }

  function getBlockList($our_id,$rec_id){
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    
    $query = "SELECT blocked_by FROM utilizador WHERE id_utilizador = ?";
    if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'i',$rec_id);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt,$list);
            if(mysqli_stmt_fetch($stmt)){
                $tmp = explode(',',$list);
                foreach($tmp as $id){
                    if($id == $our_id){
                        return 1;
                    }
                }
            }
        }
    }
    return 0;
    
  }

  function loadMobileNavBar($id){
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT foto_perfil ,utilizador FROM utilizador WHERE id_utilizador = ?";
    if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'i',$id);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt,$foto,$user);
            if(mysqli_stmt_fetch($stmt)){
                echo '<img src="' . $foto . '" alt="">';
                echo '</div>';
                echo '<h3>' . $user . '</h3>';
            }
        }
    }
  }

  function verifyId($logged_in,$id){
    if(getUserId($logged_in) == $id){
        return true;
    }else{
        return false;
    }
  }

  function getChat($ida,$idb){
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $success = array(0,0);
    $query = "SELECT COUNT(*), id_chat FROM chat WHERE ref_utilizador_a = ? and ref_utilizador_b = ?";
    if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'ii',$ida,$idb);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt,$count_f_1,$chat_id_1);
            if(mysqli_stmt_fetch($stmt)){
                $success[0] = 1;
            }
        }
    }

    $query = "SELECT COUNT(*), id_chat FROM chat WHERE ref_utilizador_a = ? and ref_utilizador_b = ?";
    if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'ii',$idb,$ida);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt,$count_f_2,$chat_id_2);
            if(mysqli_stmt_fetch($stmt)){
                $success[1] = 1;
            }
        }
    }

    if($success[0] == 1 and $success[1] == 1){
        if($count_f_1 == 0 and $count_f_2 == 0)
        {
            //create chat.
            //return id.
            $query = "INSERT INTO chat (ref_utilizador_a,ref_utilizador_b) VALUES(?,?)";
            if(mysqli_stmt_prepare($stmt,$query)){
                mysqli_stmt_bind_param($stmt,'ii',$ida,$idb);
                if(mysqli_stmt_execute($stmt)){
                    //pog.
                    $last_id = mysqli_insert_id($link);
                    return $last_id;
                }
            }
        }
        else{
            //return existing chat id.
            if($chat_id_1 == '' or !is_numeric($chat_id_1)){}else{return $chat_id_1;}
            if($chat_id_2 == '' or !is_numeric($chat_id_2)){}else{return $chat_id_2;}
        }
    }
  }
?>