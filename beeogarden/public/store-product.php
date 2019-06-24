<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="animation.css">
    <link href="hamburger.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <title>beeogarden | Loja</title>
</head>
<body>


    <div id="product-details-container" style="padding-bottom: 10vh">

        <?php
            session_start(); 
            // include_once "components/loader.php";
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
                                            $imagens_arr[$i]="img/default-product.PNG";
                                        }
                                    }
                                }
                            }
                        }
                    }
            }

            if(isset($_GET['action'])){
                if(is_string($_GET['action'])){
                    //add to cart!
                    $user = $_SESSION['username'];
                    $query = "SELECT id_utilizador FROM utilizador WHERE utilizador LIKE ?";
                    if(mysqli_stmt_prepare($stmt,$query)){
                        mysqli_stmt_bind_param($stmt,'s',$user);
                        if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_bind_result($stmt,$id_utilizador);
                            if(mysqli_stmt_fetch($stmt)){

                            }
                        }
                    }
                    $query = "SELECT COUNT(*) FROM compras WHERE ref_Utilizador = ?";
                    if(mysqli_stmt_prepare($stmt,$query)){
                        mysqli_stmt_bind_param($stmt,'i',$id_utilizador);
                        if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_bind_result($stmt,$presenca);
                            if(mysqli_stmt_fetch($stmt)){
                                
                            }
                        }
                    }

                    if($presenca > 0){
                        //tem compras, no entanto uma delas pode estar em aberto aka carrinho.
                        $query = "SELECT COUNT(*) FROM compras WHERE ref_Utilizador = ? AND data_compra IS NULL OR data_compra = ' '";
                        if(mysqli_stmt_prepare($stmt,$query)){
                            mysqli_stmt_bind_param($stmt,'i',$id_utilizador);
                            if(mysqli_stmt_execute($stmt)){
                                mysqli_stmt_bind_result($stmt,$carrinho);
                                if(mysqli_stmt_fetch($stmt)){
                                    
                                }
                            }
                        }
                        if($carrinho>=1){
                            //possui um carrinho, logo vamos editar o mesmo em vez de abrir um novo
                            $has_carrinho = true;
                        }else{
                            //nao possui , vamos abrir um carrinho novo
                            $has_carrinho = false;
                        }
                    }
                    else{
                        //nao tem sequer compras por isso podemos abrir uma em aberto
                        $has_carrinho = false;
                    }

                    if(isset($_GET['id'])){
                        if(is_numeric($_GET['id'])){
                            $id_de_produto = $_GET['id'];
                        }
                    }

                    if($has_carrinho==false){
                        //criar carrinho e inserir compra
                        $query = "INSERT INTO compras (preco_total, ref_Utilizador) VALUES(?,?)";
                        if(mysqli_stmt_prepare($stmt,$query)){
                            mysqli_stmt_bind_param($stmt,'di',$preco,$id_utilizador);
                            if(mysqli_stmt_execute($stmt)){
                                //grab last id.
                                $last_id = mysqli_insert_id($link);
                            }
                        }
                        $qtd = 1;
                        $query = "INSERT INTO compras_has_produto (ref_compra,ref_produto,quantidade,custo_produto) VALUES(?,?,?,?)";
                        if(mysqli_stmt_prepare($stmt,$query)){
                            mysqli_stmt_bind_param($stmt,'iiid',$last_id,$id_de_produto,$qtd,$preco);
                            if(mysqli_stmt_execute($stmt)){
                                //success
                                $rd_to = 'Location: store-product.php?id='.$id_de_produto;
                                header($rd_to);
                            }
                        }
                    }else{
                        //modificar compra existente.
                        /*
                        -Modificar o preço total na tabela compras.
                        -Acrescentar novo elemento ao compra has produtos
                        */
                        $query = "SELECT preco_total, id_compra FROM compras WHERE ref_Utilizador = ? AND data_compra IS NULL OR data_compra = ' '";
                        if(mysqli_stmt_prepare($stmt,$query)){
                            mysqli_stmt_bind_param($stmt,'i',$id_utilizador);
                            if(mysqli_stmt_execute($stmt)){
                                mysqli_stmt_bind_result($stmt,$preco_total_atual,$id_da_compra);
                                if(mysqli_stmt_fetch($stmt)){

                                }
                            }
                        }

                        //$preco_total_atual = $preco_total_atual;
                        $preco_total_atual += $preco;
                        
                        $query = "UPDATE compras SET preco_total = ? WHERE id_compra = ?";
                        if(mysqli_stmt_prepare($stmt,$query)){
                            mysqli_stmt_bind_param($stmt,'di',$preco_total_atual,$id_da_compra);
                            if(mysqli_stmt_execute($stmt)){
                                //yay..
                                
                            }
                        }

                        //verificar se este produto ja se encontra na bd
                        $query = "SELECT COUNT(*) FROM compras_has_produto WHERE ref_compra = ? AND ref_produto = ?";
                        if(mysqli_stmt_prepare($stmt,$query)){
                            mysqli_stmt_bind_param($stmt,'ii',$id_da_compra,$id_de_produto);
                            if(mysqli_stmt_execute($stmt)){
                                mysqli_stmt_bind_result($stmt,$ctcP);
                                mysqli_stmt_fetch($stmt);
                            }
                        }

                        if($ctcP >= 1){
                            //update qty
                            $query = "SELECT quantidade FROM compras_has_produto WHERE ref_compra = ? AND ref_produto = ?";
                            if(mysqli_stmt_prepare($stmt,$query)){
                                mysqli_stmt_bind_param($stmt,'ii',$id_da_compra,$id_de_produto);
                                if(mysqli_stmt_execute($stmt)){
                                    mysqli_stmt_bind_result($stmt,$qty);
                                    mysqli_stmt_fetch($stmt);
                                }
                            }

                            $qty++;

                            $query = "UPDATE compras_has_produto SET quantidade = ? WHERE ref_compra = ? AND ref_produto = ?";
                            if(mysqli_stmt_prepare($stmt,$query)){
                                mysqli_stmt_bind_param($stmt,'iii',$qty,$id_da_compra,$id_de_produto);
                                if(mysqli_stmt_execute($stmt)){
                                    $rd_to = 'Location: store-product.php?id='.$id_de_produto;
                                    header($rd_to);
                                }
                            }
                        }
                        else{
                            //acrescentar ao compra_has_produto
                            $qtd = 1;
                            $query = "INSERT INTO compras_has_produto (ref_compra,ref_produto,quantidade,custo_produto) VALUES(?,?,?,?)";
                            if(mysqli_stmt_prepare($stmt,$query)){
                                mysqli_stmt_bind_param($stmt,'iiid',$id_da_compra,$id_de_produto,$qtd,$preco);
                                if(mysqli_stmt_execute($stmt)){
                                    $rd_to = 'Location: store-product.php?id='.$id_de_produto;
                                    header($rd_to);
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
                    }else{echo "img/default-product.PNG";}
                    echo '"';
                ?> alt="">
            </div>
            <div id="details">
                <div id="detail-store-1">
                    <img src=<?php 
                    echo '"';
                    if(array_key_exists(0,$imagens_arr)){
                        echo htmlspecialchars($imagens_arr[0]);
                    }else{echo "img/default-product.PNG";}
                    echo '"';
                ?> alt="">
                </div>
                <div id="detail-store-1">
                    <img src=<?php 
                    echo '"';
                    if(array_key_exists(1,$imagens_arr)){
                        echo htmlspecialchars($imagens_arr[1]);
                    }else{echo "img/default-product.PNG";}
                    echo '"';
                ?> alt="">
                </div>
                <div id="detail-store-1">
                    <img src=<?php 
                    echo '"';
                    if(array_key_exists(2,$imagens_arr)){
                        echo htmlspecialchars($imagens_arr[2]);
                    }else{echo "img/default-product.PNG";}
                    echo '"';
                ?> alt="">
                </div>
                <div id="detail-store-1">
                    <img src=<?php 
                    echo '"';
                    if(array_key_exists(3,$imagens_arr)){
                        echo htmlspecialchars($imagens_arr[3]);
                    }else{echo "img/default-product.PNG";}
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

        <!-- Se o produto for uma semente fetch este xd -->
        <div id="add-cart-button-seed">
            <div>
                <h4>Comprar para mim</h4>
            </div>

            <div>
                <h4>Plantar num beeogarden</h4>
            </div>
        </div>

        <!-- Se não for fetch neste né ... -->
        <div id="add-cart-button">
            <a href=<?='"store-product.php?action=add&id='.$_GET['id'].'"'?>>Adicionar ao carrinho</a>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>