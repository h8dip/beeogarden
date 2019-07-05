<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos2.css">
    <link href="hamburger.css" rel="stylesheet">
    <link href="animation.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <title>beeogarden | Carrinho de Compras</title>
    <link rel="shortcut icon" href="img/favicon.png" /> 

</head>
<body style="overflow-x:hidden;">

   <?php 
        if(isset($_GET['f'])){
            if($_GET['f']=="true"){
                echo '<div id="modal-compra">
                <div id="modal-compra-content">
                    <div id="modal-compra-top">
                        <h2>A sua compra foi finalizada com sucesso!</h2>
                    </div>
                    <div id="modal-compra-btn">
                        <a class="continue-btn-compra" href="profile-page.php">Continuar</a>
                    </div>
                </div>
            </div>';
            }
        }
   ?> 


    <?php 
        session_start();

        require_once "connections/connection.php";

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
            //pogchamp
            $query = "SELECT id_compra, preco_total FROM compras WHERE ref_Utilizador = ? AND data_compra IS NULL or data_compra = ' '";
            if(mysqli_stmt_prepare($stmt,$query)){
                mysqli_stmt_bind_param($stmt,'i',$id_utilizador);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt,$id_compra,$preco_total);
                    if(mysqli_stmt_fetch($stmt)){
                        //temos agr id da compra e preço total.   
                    }
                }
            }
        }
        else{
            
        }
    ?> 
    <div id="cart-container">
        <h1>O MEU CARRINHO</h1>
        <div id="cart-products">
        <?php 
            if($carrinho >=1){
            $array_produtos = array();
            $query = "SELECT quantidade, custo_produto, nome_produto, img_path,id_produto FROM compras_has_produto INNER JOIN produto ON ref_produto = id_produto WHERE ref_compra = ?";
            if(mysqli_stmt_prepare($stmt,$query)){
                mysqli_stmt_bind_param($stmt,'i',$id_compra);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt,$quantidade,$custo_produto,$nome_produto,$img_path,$p_id);
                    while(mysqli_stmt_fetch($stmt)){

                        $img_p = explode(';',$img_path);
                        $img_p = $img_p[0];
                        if($img_p==""){$img_p="img/default-product.PNG";}

                        echo '<div class="product-cart">';
                        echo '<a class="delete-btn" href="scripts/remove_item.php?c_id='.$id_compra.'&p_id='.$p_id.'"><i class="fas fa-trash-alt"></i></a>';
                        echo '<div class="cart-products-img-container">';
                        echo '<img src="'.$img_p.'"" alt="alt">';
                        echo '</div>';
                        echo '<div class="product-cart-info">';
                        echo '<h3>'.$nome_produto.'</h3>';
                        echo '<div>QTD:'.$quantidade.'</div>';
                        echo '<h2>'.($quantidade*$custo_produto).'€</h2>';
                        echo '</div></div>';

                        for($i=1;$i <= $quantidade;$i++){
                            array_push($array_produtos, array($nome_produto => $custo_produto));
                        }
                    }
                }
            }
        }else{
            echo '<div class="product-cart">';
            echo '<div class="product-cart-info">';
            echo '<h3>Ainda não tens produtos no carrinho.</h3>';
            echo '</div></div>';
        }
        ?>
            <div class="line">
                <div class="dotted-line"></div>
            </div>
        </div>
    </div>

    <div id="price-pay">
        <h2>Preço a pagar</h2>
        <div id="price-pay-info">
        <?php
            if($carrinho>=1){ 
            foreach($array_produtos as $arr){
                foreach($arr as $key => $value){
                echo '<div class="product-buy">';
                echo '<h3>'.$key.'</h3>';
                echo '<h2>'.$value.'€</h2>';
                echo '</div>';
            }
        
        }

            echo '<div class="iva">';
            echo '<h3>IVA</h3>';
            $iva_val = $preco_total * 0.13;
            $preco_total += $iva_val;
            echo '<h2>'.$iva_val.'€</h2>';
            echo '</div>';
        }
        ?>
            <div class="line">
                <div class="dotted-line"></div>
            </div>
        </div>
    </div>

    <div id="total">
        <h2>Total</h2>
        <div id="total-info">
            <div class="total-buy">
                <h3>Total</h3>
                <h2>
                <?php if($carrinho>=1){
                    echo $preco_total.'€';}
                ?>
                </h2>
            </div>
            <div class="line">
                <div class="dotted-line"></div>
            </div>
        </div>
    </div>

    <div id="buy-btn">
   
        <div><a href="profile-page.php"><h2>CANCELAR</h2></a></div>
        <?php 
        if($carrinho>=1){
            $link = "scripts/end_purchase.php?id=".$id_compra;
            
        }else{
            $link = "#";
        }
    ?>
        <div><a href=<?=$link?> id="finalizar-btn"><h2>FINALIZAR COMPRA</h2></a></div>
    </div>



<script src="main.js"></script>

<script>

        window.onload=function(){
            var modal_compra = document.getElementById('modal-compra');
            var btn_compra = document.getElementById('finalizar-btn');

            btn_compra.onclick = function(){
                
                modal_compra.style.display='block';
                $('body').toggleClass('body-overflow-modal');
            };

            window.onclick=function(event){
                if(event.target == modal_compra){
                    modal_compra.style.display = 'none';
                    $('body').toggleClass('body-overflow-modal');
                };
            };
        };

</script>

</body>