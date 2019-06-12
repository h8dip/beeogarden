<?php
  require_once "../../connections/connection.php";

  $action_to = "edit_script.php?page=utilizadores";

  if(isset($_GET['id'])){
    $action_to .= "&id=".$_GET['id'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT utilizador, email, biografia, beeopoints, ref_roles, ref_genero FROM utilizador WHERE id_utilizador LIKE ?";
    if(mysqli_stmt_prepare($stmt, $query)){
      mysqli_stmt_bind_param($stmt,'i',$_GET['id']);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt,$utilizador,$email,$biografia,$beeopoints,$ref_roles,$ref_genero);
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
    <label>Utilizador</label><br>
    <input type="text" name="utilizador" id="utilizador" class="form-control form-control-user" value="<?=htmlspecialchars($utilizador)?>">
  </div>
  <div class="form-group">
    <label>Email</label><br>
    <input type="text" name="email" id="email" class="form-control form-control-user" value="<?=htmlspecialchars($email)?>">
  </div>
  <div class="form-group">
    <label>Biografia</label><br>
    <textarea name="biografia" id="biografia" class="form-control form-control-user" ><?=htmlspecialchars($biografia)?></textarea>
  </div>
  <div class="form-group">
    <label>Beeopoints</label><br>
    <input type="number" name="beeopoints" id="beeopoints" class="form-control form-control-user" value="<?=htmlspecialchars($beeopoints)?>">
  </div>
  <div class="form-group">
    <label>User Role</label><br> 
    <select name="ref_roles" class="form-control form-control-user">
      <option value="1" <?php if(htmlspecialchars($ref_roles)==1){echo "selected";} ?>>Utilizador</option>
      <option value="2" <?php if(htmlspecialchars($ref_roles)==2){echo "selected";} ?>>Administrador</option>
    </select>
  </div>
  <div class="form-group">
    <label>Genero</label><br> 
    <select name="ref_genero" class="form-control form-control-user">
      <option value="1" <?php if(htmlspecialchars($ref_genero)==1){echo "selected";} ?>>Masculino</option>
      <option value="2" <?php if(htmlspecialchars($ref_genero)==2){echo "selected";} ?>>Femenino</option>
      <option value="3" <?php if(htmlspecialchars($ref_genero)==3){echo "selected";} ?>>Outro</option>
    </select>
  </div>  
  <button type="Submit" class="btn btn-primary btn-user btn-block">Editar</button>
</form>