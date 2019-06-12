<?php

  require_once "../../connections/connection.php";

  if(isset($_GET['action'])){
    if($_GET['action']=='add'){
      if(count($_POST)!=0){
        //:)
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "INSERT INTO info (nome_info, info_descricao, ref_categoria_info) VALUES (?,?,?)";
        
        if(mysqli_stmt_prepare($stmt,$query)){
          mysqli_stmt_bind_param($stmt,'ssi',$nome_info,$info_descricao,$ref_categoria_info);
          
          $nome_info = htmlspecialchars($_POST['nome_info']);
          $info_descricao = htmlspecialchars($_POST['info_descricao']);
          $ref_categoria_info = htmlspecialchars($_POST['ref_categoria_info']);

          if(mysqli_stmt_execute($stmt)){

          }
          mysqli_stmt_close($stmt);
          mysqli_close($link);

          header('Location: ../../informacoes.php');
        }
      }{header('Location: ../../informacoes.php');}
    }{header('Location: ../../informacoes.php');}
  }
?>


<form class="user" method="POST" action="add_info.php?action=add">
  <div class="form-group">
    <label>Nome da Informacao</label><br>
    <input type="text" name="nome_info" id="nome_info" class="form-control form-control-user">
  </div>
  <div class="form-group">
    <label>Descricao da Informacao</label><br>
    <textarea name="info_descricao" id="info_descricao" class="form-control form-control-user" ></textarea>
  </div>
  <div class="form-group">
    <label>Categoria da Informacao</label><br> 
    <select name="ref_categoria_info" class="form-control form-control-user">
      <option value="1">Flores</option>
      <option value="2">Abelhas</option>
    </select>
  </div>
  <button type="Submit" class="btn btn-primary btn-user btn-block">Adicionar</button>
</form>