<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link href="hamburger.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <title>beeogarden | Loja</title>
</head>
<body>
    <div id="product-details-container" style="padding-bottom: 10vh">

        <?php 
            $current_page='store';
            include_once "components/navbar.php"; 
        
            require_once "connections/connection.php";
            require_once "scripts/php_scripts.php";
            
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);
            
            if(isset($_GET['id'])){
                if(is_numeric($_GET['id'])){
                    $query = "SELECT img_path, nome_produto, descricao_produto, dimensoes, beecount, preco FROM produto WHERE id_produto = ?";

                    if(mysqli_stmt_prepare($stmt,$query)){
                        mysqli_stmt_bind_param($stmt, 'i', $_GET['id']);
                        if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_bind_result($stmt,$img_path, $nome_produto,$descricao_produto, $dimensoes, $beecount, $preco);
                            if(mysqli_stmt_fetch($stmt)){
                                $dimensoes_arr = explode(";",$dimensoes);
                                $imagens_arr = explode(";",$img_path);

                                    for($i=0;$i < count($dimensoes_arr);  $i++){
                                        
                                        if($dimensoes_arr[$i]==""){
                                            $dimensoes_arr[$i]="Nao aplicável.";
                                        }
                                    }

                                    for($i=0;$i <count($imagens_arr); $i++){
                                        if($imagens_arr[$i]==""){
                                            $imagens_arr[$i]="img/bee-house.PNG";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
        ?>

        <div id="store-product-image">
            <div id="showcase-product-detail">
                <i class="fas fa-arrow-circle-left"></i>
                <i class="fas fa-arrow-circle-right"></i>
                <img src=<?php 
                    echo '"';
                    if(array_key_exists(0,$imagens_arr)){
                        echo htmlspecialchars($imagens_arr[0]);
                    }else{echo "img/bee-house.PNG";}
                    echo '"';
                ?> alt="">
            </div>
            <div id="details">
                <div id="detail-store-1">
                    <img src=<?php 
                    echo '"';
                    if(array_key_exists(0,$imagens_arr)){
                        echo htmlspecialchars($imagens_arr[0]);
                    }else{echo "img/bee-house.PNG";}
                    echo '"';
                ?> alt="">
                </div>
                <div id="detail-store-1">
                    <img src=<?php 
                    echo '"';
                    if(array_key_exists(1,$imagens_arr)){
                        echo htmlspecialchars($imagens_arr[1]);
                    }else{echo "img/bee-house.PNG";}
                    echo '"';
                ?> alt="">
                </div>
                <div id="detail-store-1">
                    <img src=<?php 
                    echo '"';
                    if(array_key_exists(2,$imagens_arr)){
                        echo htmlspecialchars($imagens_arr[2]);
                    }else{echo "img/bee-house.PNG";}
                    echo '"';
                ?> alt="">
                </div>
                <div id="detail-store-1">
                    <img src=<?php 
                    echo '"';
                    if(array_key_exists(3,$imagens_arr)){
                        echo htmlspecialchars($imagens_arr[3]);
                    }else{echo "img/bee-house.PNG";}
                    echo '"';
                ?> alt="">
                </div>
            </div>
        </div>

        <div id="store-product-info">
            <div id="flex-description">
                <h2><?= mb_strtoupper($nome_produto); ?></h2>
                <h2><?=$preco?>€</h2>
            </div>
            <p><?= $descricao_produto?></p>
            <div>
                <ul>
                    <li>Tamanho:<span><?php
                        if(array_key_exists(0,$dimensoes_arr)){
                            echo  htmlspecialchars($dimensoes_arr[0]);}
                            else{ echo "Nao aplicavel.";}
                    ?><span></li>
                    <li>Peso:<span><?php
                        if(array_key_exists(1,$dimensoes_arr)){
                            echo  htmlspecialchars($dimensoes_arr[1]);}
                            else{ echo "Nao aplicavel.";}
                    ?><span></li>
                    <li>Material:<span><?php
                        if(array_key_exists(2,$dimensoes_arr)){
                            echo  htmlspecialchars($dimensoes_arr[2]);}
                            else{ echo "Nao aplicavel.";}
                    ?><span></li>
                </ul>
            </div>
            <h2 id="similar-title">PRODUTOS SEMELHANTES</h2>
            <div id="similar-products">
                <div class="similar">
                    <img src="img/bee-house.PNG" alt="">
                </div>
                <div class="similar">
                    <img src="img/bee-house.PNG" alt="">
                </div>
                <div class="similar">
                    <img src="img/bee-house.PNG" alt="">
                </div>
                <div class="similar">
                    <img src="img/bee-house.PNG" alt="">
                </div>
            </div>
        </div>
        <div id="add-cart-button">
            <a>Adicionar ao carrinho</a>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>