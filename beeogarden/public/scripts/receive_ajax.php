<script>
  function purchase_other(campo_id,pid){
      var link = 'store-product.php?action=add&f='+campo_id+'&id='+pid;
      window.location.href = link;
  }
</script>
<?php
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
          echo '<div class="campo" style="width:100%; padding: 0 !important; border-radius: 3vh;" onclick="purchase_other('.$array_ids[$i].','.$produto_id.');">';
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
  }
?>