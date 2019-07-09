<?php

  require_once "../../connections/connection.php";

  if(isset($_GET['action'])){
    if($_GET['action']=='add'){
      if(count($_POST)!=0){
        //:)
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "INSERT INTO produto (nome_produto, descricao_produto, dimensoes, beecount, preco,categoria) VALUES (?,?,?,?,?,?)";
        
        if(mysqli_stmt_prepare($stmt,$query)){
          mysqli_stmt_bind_param($stmt,'sssid',$nome_produto,$descricao_produto,$dimensoes,$beecount,$preco,$categoria);
          
          $nome_produto = htmlspecialchars($_POST['nome_produto']);
          $descricao_produto = htmlspecialchars($_POST['descricao_produto']);
          $dimensoes = htmlspecialchars($_POST['dimensoes']);
          $beecount = htmlspecialchars($_POST['beecount']);
          $preco = htmlspecialchars($_POST['preco']);
          switch(htmlspecialchars($_POST['categoria'])){
            case 1:
              $categoria = "Construcao";
            break;
            case 2:
              $categoria = "Sementes";
            break;
            case 3:
              $categoria = "Roupa";
            break;
          }

          if(mysqli_stmt_execute($stmt)){

          }
          mysqli_stmt_close($stmt);
          mysqli_close($link);

          header('Location: ../../produtos_loja.php');
        }
      }{header('Location: ../../produtos_loja.php');}
    }{header('Location: ../../produtos_loja.php');}
  }
?>


<form class="user" method="POST" action="add_products.php?action=add">
  <div class="form-group">
    <label>Nome do Produto</label><br>
    <input type="text" name="nome_produto" id="nome_produto" class="form-control form-control-user" >
  </div>
  <div class="form-group">
    <label>Descricao do Produto</label><br>
    <textarea name="descricao_produto" id="descricao_produto" class="form-control form-control-user" ></textarea>
  </div>
  <div class="form-group">
    <label>Dimensoes</label><br>
    <input type="text" name="dimensoes" id="dimensoes" class="form-control form-control-user">
  </div>
  <div class="form-group">
    <label>Beecount</label><br>
    <input type="number" name="beecount" id="beecount" class="form-control form-control-user">
  </div>
  <div class="form-group">
    <label>Preco</label><br>
    <input type="number" step=".01" name="preco" id="preco" class="form-control form-control-user">
  </div>
  <div class="form-group">
    <label>Categoria do Produto</label><br> 
    <select name="categoria" class="form-control form-control-user">
      <option value="1" selected>Construcao</option>
      <option value="2">Sementes</option>
      <option value="3">Roupa</option>
    </select>
  </div>
  <button type="Submit" class="btn btn-primary btn-user btn-block">Adicionar</button>
</form>