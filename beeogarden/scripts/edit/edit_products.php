<?php
  require_once "../../connections/connection.php";

  $action_to = "edit_script.php?page=produtos_loja";

  if(isset($_GET['id'])){
    $action_to .= "&id=".$_GET['id'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT nome_produto, descricao_produto, dimensoes, beecount, preco FROM produto WHERE id_produto LIKE ?";
    if(mysqli_stmt_prepare($stmt, $query)){
      mysqli_stmt_bind_param($stmt,'i',$_GET['id']);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt,$nome_produto,$descricao_produto,$dimensoes,$beecount,$preco);
        if(mysqli_stmt_fetch($stmt)){
            //perfectooo
        }
      }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
  }else{
    Header('Location: ../../produtos_loja.php');
  }
}else{Header('Location: ../../produtos_loja.php');}
?>
<form class="user" method="POST" action=<?=$action_to?>>
  <div class="form-group">
    <label>Nome do Produto</label><br>
    <input type="text" name="nome_produto" id="nome_produto" class="form-control form-control-user" value="<?=htmlspecialchars($nome_produto)?>">
  </div>
  <div class="form-group">
    <label>Descricao do Produto</label><br>
    <textarea name="descricao_produto" id="descricao_produto" class="form-control form-control-user" ><?=htmlspecialchars($descricao_produto)?></textarea>
  </div>
  <div class="form-group">
    <label>Dimensoes</label><br>
    <input type="text" name="dimensoes" id="dimensoes" class="form-control form-control-user" value="<?=htmlspecialchars($dimensoes)?>">
  </div>
  <div class="form-group">
    <label>Beecount</label><br>
    <input type="number" name="beecount" id="beecount" class="form-control form-control-user" value="<?=htmlspecialchars($beecount)?>">
  </div>
  <div class="form-group">
    <label>Preco</label><br>
    <input type="number" step=".01" name="preco" id="preco" class="form-control form-control-user" value="<?=htmlspecialchars($preco)?>">
  </div>
  <button type="Submit" class="btn btn-primary btn-user btn-block">Editar</button>
</form>