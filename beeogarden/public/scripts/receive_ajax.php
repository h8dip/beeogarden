<script>
  function purchase_other(campo_id,pid){
      var link = 'store-product.php?action=add&f='+campo_id+'&id='+pid;
      window.location.href = link;
  }
</script>
<?php
  session_start();
  require_once "php_scripts.php";
  require_once "../connections/connection.php";


  function loadAllChatMessages($chat,$us,$them,$stmt,$foto,&$all_ids){
    $query = "SELECT id_mensagem, mensagem, estado_mensagem, sender_id FROM mensagens WHERE ref_chat = ?";
    if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'i',$chat);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt,$msg_id,$mensagem,$estado_mensagem,$sender_id);
            while(mysqli_stmt_fetch($stmt))
            {
              $clearance = true;
              foreach($all_ids as $id){
                if($id == $msg_id){
                  $clearance = false;
                }
              } 
              if($clearance){ 
              if($sender_id != $us){
                  echo '<div class="recieve-msg">';
                  echo '<div class="recieve-msg-content">';
                  echo '<img src="'.$foto.'" alt="">';
                  echo '<div class="recieve-msg-txt">';
                  echo '<p>'.$mensagem.'</p>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
              }else{
                  echo '<div class="sent-msg">';
                  echo '<div class="sent-msg-content">';
                  echo '<div class="sent-msg-txt">';
                  echo '<p>'.$mensagem.'</p>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
              }
              echo '<script>all_messages_array.push("'.$msg_id.'")</script>';
            }
          }
        }
    }
  }


  if(verifyLogin()){

  if(isset($_GET['page']))
  {
     if($_GET['page']=="product"){
       //code for maps
       //var names : nomes, ids, beepts, locals
       //develop arrays
       $array_nomes = json_decode($_POST['nomes']);
       $array_ids = json_decode($_POST['ids']);
       $array_beeopts = json_decode($_POST['beepts']);
       $array_localidades = json_decode($_POST['locals']);
       $produto_id = json_decode( $_POST['pid']);

       for($i = 0; $i < count($array_nomes); $i++){
          echo '<div class="campo" style="width:100%; height:93%; padding: 0 !important; border-radius: 3vh;" onclick="purchase_other('.$array_ids[$i].','.$produto_id.');">';
          echo '<div style="background-color: #FBC02D;  border-radius: 3vh 3vh 0 0;" id="upper-campo">';
          echo '<h2 style="color:#fff; padding: 0 2vh !important;">'.$array_nomes[$i].'</h2>';
          echo '</div>';
          echo '<div id="lower-campo" style="border: solid 0.5vh #FBC02D; border-radius: 0 0 3vh 3vh;">';
          echo '<div style="padding: 0 0 0 2vh !important;">';
          echo '<i class="fas fa-map-marker-alt" aria-hidden="true"></i>';
          echo '<h4>'.$array_localidades[$i].'</h4>';
          echo '</div>';
          echo '<div style="padding: 0 2vh 0 0 !important;">';
          echo '<p>'.$array_beeopts[$i].'</p>';
          echo '<img src="img/beeopoints.png" alt="">';
          echo '</div>';
          echo '</div>';
          echo '</div>';
       }
    }
    else if($_GET['page']=='chat'){

      $link = new_db_connection();
      $stmt = mysqli_stmt_init($link);

      $mensagem = $_POST['mensagem'];
      $chat_id = json_decode($_POST['id']);
      $sender_id = json_decode($_POST['sender_id']);
      

      //query.
      $query = "INSERT INTO mensagens (mensagem,ref_chat,sender_id) VALUES (?,?,?)";
      if(mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt,'sii',$mensagem,$chat_id,$sender_id);
        if(mysqli_stmt_execute($stmt)){
          //echo time.
          echo '<div class="sent-msg">';
          echo '<div class="sent-msg-content">';
          echo '<div class="sent-msg-txt">';
          echo '<p>'.$mensagem.'</p>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          $last_id = mysqli_insert_id($link);
          echo '<script>
          all_messages_array.push("'.$last_id.'");
          </script>';
        }
      }
    }
    else if($_GET['page']=="chat_reload"){

      $link = new_db_connection();
      $stmt = mysqli_stmt_init($link);


      $id_chat = $_POST['id_chat'];
      $sender_id = $_POST['sender_id'];
      $foto = $_POST['foto'];
      $their_id = $_POST['their_id'];
      $all_ids = json_decode($_POST['all_ids']);
     

      loadAllChatMessages($id_chat,$sender_id,$their_id,$stmt,$foto,$all_ids);
    }
  }
}else{
  header('Location: ../login-page.php');
}
?>