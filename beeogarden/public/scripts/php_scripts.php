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
?>