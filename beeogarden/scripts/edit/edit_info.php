<?php
  require_once "../../connections/connection.php";

  $action_to = "edit_script.php?page=informacoes";

  if(isset($_GET['id'])){
    $action_to .= "&id=".$_GET['id'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT nome_info, info_descricao, info_imagem, ref_categoria_info FROM info WHERE id_info LIKE ?";
    if(mysqli_stmt_prepare($stmt, $query)){
      mysqli_stmt_bind_param($stmt,'i',$_GET['id']);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt,$nome_info,$info_descricao,$info_imagem,$ref_categoria_info);
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
    <label>Nome da Informacao</label><br>
    <input type="text" name="nome_info" id="nome_info" class="form-control form-control-user" value="<?=htmlspecialchars($nome_info)?>">
  </div>
  <div class="form-group">
    <label>Descricao da Informacao</label><br>
    <textarea name="info_descricao" id="info_descricao" class="form-control form-control-user" ><?=htmlspecialchars($info_descricao)?></textarea>
  </div>
  <div class="form-group">
    <label>Categoria da Informacao</label><br> 
    <select name="ref_categoria_info" class="form-control form-control-user">
      <option value="1" <?php if(htmlspecialchars($ref_categoria_info)==1){echo "selected";} ?>>Flores</option>
      <option value="2" <?php if(htmlspecialchars($ref_categoria_info)==2){echo "selected";} ?>>Abelhas</option>
    </select>
  </div>
  <button type="Submit" class="btn btn-primary btn-user btn-block">Editar</button>
</form>