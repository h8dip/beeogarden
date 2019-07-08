<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estilos2.css">
    <link rel="stylesheet" href="animation.css">
    <link href="hamburger.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <script src="//maps.googleapis.com/maps/api/js?libraries=geometry&key=AIzaSyDHidfksxt61FmywDBiYGiGDNkHwnRG29k&sensor=false"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>beeogarden | Loja</title>
    <link rel="shortcut icon" href="img/favicon.png" /> 
    <script src="scripts/checkQueryString.js"></script>

</head>
<body>
<script>
  function purchase_other(campo_id,pid){
      var link = 'store-product.php?action=add&f='+campo_id+'&id='+pid;
      window.location.href = link;
  }
</script>
<?php 
        session_start();

        require_once "scripts/php_scripts.php";
        require_once "connections/connection.php";

        
                
        $link = new_db_connection();
        $stmt2 = mysqli_stmt_init($link);
        $array_coordenadas = array();
        $array_nomes = array();
        $array_beeopts = array();
        $array_localidades = array();
        $array_ids = array();
        $reached_end = false;

        if(!isset($_SESSION['username'])){
          header('Location: login-page.php');
        }else{
          $query = 'SELECT id_espaco, coordenadas, nome_espaco, localidade, ref_Utilizador, beeopoints FROM espaco INNER JOIN utilizador ON id_Utilizador = ref_Utilizador WHERE privacidade LIKE ?';
          if(mysqli_stmt_prepare($stmt2,$query)){
            $condition = "Publico";
            mysqli_stmt_bind_param($stmt2,'s',$condition);
            if(mysqli_stmt_execute($stmt2)){
              mysqli_stmt_bind_result($stmt2,$id_espaco,$coord,$nome,$localidade,$ref_Utilizador,$beeopoints);
              while(mysqli_stmt_fetch($stmt2)){
                array_push($array_coordenadas,$coord);
                array_push($array_nomes,$nome);
                array_push($array_localidades,$localidade);
                array_push($array_beeopts,$beeopoints);
                array_push($array_ids,$id_espaco);
                $reached_end = true;
              }
            }
          }
          if($reached_end){
            //
          }

        }
   ?>
    

    <div id="processor_holder" style="display : none;">
        
    </div>

    <div id="modal-campos" class="modal">
        <div class="modal-content" id="modal-campos-2">
        <div id="titulo-modal"><h2 style="font-weight: bold;">ESCOLHA UM BEEOGARDEN</h2></div>
            <script>
                var coordenadas_array = <?php echo '["' . implode('", "',$array_coordenadas) . '"]'; ?>;
                var nomes_array = <?php echo '["' . implode('", "',$array_nomes) . '"]';?>;
                var beeopoints_array = <?php echo '["' . implode('", "',$array_beeopts) . '"]'; ?>;
                var localidades_array = <?php echo '["' . implode('", "',$array_localidades) . '"]'; ?>;
                var ids_array = <?php echo '["' . implode('", "',$array_ids) . '"]'; ?>;

                

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var pos = new google.maps.LatLng(
                        position.coords.latitude,
                        position.coords.longitude      
                        );
                        success(pos);
                    });
                }


                var chosenFields_nomes = [];
                var chosenFields_ids = [];
                var chosenFields_beeopoints = [];
                var chosenFields_localidades = [];

                var nome_array_text;
                var ids_array_text;
                var beeopoints_array_text;
                var localidades_array_text;

                function success(pos){
                    

                    for(var i = 0; i < coordenadas_array.length ; i++){
                        $i = i;
                        $temp = coordenadas_array[i].split(',');
                        var myLatLng = new google.maps.LatLng(parseFloat($temp[0]), parseFloat($temp[1]));
                        var xDist = google.maps.geometry.spherical.computeDistanceBetween(pos,myLatLng);
                        if(xDist <= 30000.0){
                            chosenFields_nomes.push(nomes_array[i]);
                            chosenFields_ids.push(ids_array[i]);
                            chosenFields_beeopoints.push(beeopoints_array[i]);
                            chosenFields_localidades.push(localidades_array[i]);
                        }
                    }

                    nome_array_text = JSON.stringify(chosenFields_nomes);
                    ids_array_text = JSON.stringify(chosenFields_ids);
                    beeopoints_array_text = JSON.stringify(chosenFields_beeopoints);
                    localidades_array_text = JSON.stringify(chosenFields_localidades);
                    var id_de_produto = <?= $_GET['id']; ?>

                    
                    //var c_page = getParameterByName("id");

                    //var post_url = "store-product.php?id=" + c_page + "&fetched=true";

                    var $holder= $('#modal-campos-2');

                    var object = {
                        nomes : nome_array_text,
                        ids : ids_array_text,
                        beepts : beeopoints_array_text,
                        locals : localidades_array_text,
                        pid : id_de_produto,
                    };

                    $.post("scripts/receive_ajax.php?page=product",object, function(data){
                        //alert(data);
                        $holder.append(data);
                    });
                }
                //alert(ids_array_text);               
            </script>
        </div>

    </div>
    
    <?php
        
    ?>

    <div id="product-details-container" class="container-main" style="padding-bottom: 10vh">

        <?php 
            $current_page='store';
            include_once "components/navbar.php"; 
            include_once "components/navbar-mobile.php";
        

            
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);

            if(isset($_GET['id'])){
                if(is_numeric($_GET['id'])){
                    $query = "SELECT img_path, nome_produto, descricao_produto, dimensoes, beecount, preco, categoria FROM produto WHERE id_produto = ?";

                    if(mysqli_stmt_prepare($stmt,$query)){
                        mysqli_stmt_bind_param($stmt, 'i', $_GET['id']);
                        if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_bind_result($stmt,$img_path, $nome_produto,$descricao_produto, $dimensoes, $beecount, $preco, $categoria);
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
                if(is_string($_GET['action']) and $_GET['action']=="add"){
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
                        if(isset($_GET['f'])){
                            $campo_id = $_GET['f'];
                            $query = "INSERT INTO compras_has_produto (ref_compra,ref_produto,custo_produto,outro_campo,outro_campo_qtd) VALUES(?,?,?,?,?)";
                            if(mysqli_stmt_prepare($stmt,$query)){
                                mysqli_stmt_bind_param($stmt,'iidii',$last_id,$id_de_produto,$preco,$campo_id,$qtd);
                                if(mysqli_stmt_execute($stmt)){
                                    //success
                                    $rd_to = 'Location: store-product.php?id='.$id_de_produto;
                                    header($rd_to);
                                }
                            }
                        }else{
                        $query = "INSERT INTO compras_has_produto (ref_compra,ref_produto,quantidade,custo_produto) VALUES(?,?,?,?)";
                        if(mysqli_stmt_prepare($stmt,$query)){
                            mysqli_stmt_bind_param($stmt,'iiid',$last_id,$id_de_produto,$qtd,$preco);
                            if(mysqli_stmt_execute($stmt)){
                                //success
                                $rd_to = 'Location: store-product.php?id='.$id_de_produto;
                                // header($rd_to);
                            }
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
                            if(isset($_GET['f'])){
                                $campo_id = $_GET['f'];
                                $query = "SELECT outro_campo_qtd FROM compras_has_produto WHERE ref_compra = ? AND ref_produto = ?";
                                if(mysqli_stmt_prepare($stmt,$query)){
                                    mysqli_stmt_bind_param($stmt,'ii',$id_da_compra,$id_de_produto);
                                    if(mysqli_stmt_execute($stmt)){
                                        mysqli_stmt_bind_result($stmt,$qty);
                                        mysqli_stmt_fetch($stmt);
                                    }
                                }
                                if($qty == null or $qty == '' or is_null($qty) or empty($qty)){
                                    $qty = 1;
                                    var_dump($qty);
                                }else{
                                    $qty++;
                                }
                                $query = "SELECT outro_campo FROM compras_has_produto WHERE ref_compra = ? AND ref_produto = ?";
                                if(mysqli_stmt_prepare($stmt,$query)){
                                    mysqli_stmt_bind_param($stmt,'ii',$id_da_compra,$id_de_produto);
                                    if(mysqli_stmt_execute($stmt)){
                                        //coolio
                                        mysqli_stmt_bind_result($stmt,$outro_campo);
                                        mysqli_stmt_fetch($stmt);

                                    }
                                }

                                if($outro_campo == '' or is_null($outro_campo) or empty($outro_campo)){
                                    $query = "UPDATE compras_has_produto SET outro_campo_qtd = ?, outro_campo = ? WHERE ref_compra = ? AND ref_produto = ?";
                                    if(mysqli_stmt_prepare($stmt,$query)){
                                        mysqli_stmt_bind_param($stmt,'iiii',$qty,$campo_id,$id_da_compra,$id_de_produto);
                                        if(mysqli_stmt_execute($stmt)){
                                            header("Location: store-page.php");
                                        }
                                    }
                                }else{
                                    //add new field to current list.
                                    $outro_campo .= ','.$campo_id;
                                    $query = "UPDATE compras_has_produto SET outro_campo = ?, outro_campo_qtd = ? WHERE ref_compra = ? AND ref_produto = ?";
                                        if(mysqli_stmt_prepare($stmt,$query)){
                                            mysqli_stmt_bind_param($stmt,'siii',$outro_campo,$qty,$id_da_compra,$id_de_produto);
                                            if(mysqli_stmt_execute($stmt)){
                                                header("Location: store-page.php");
                                            }
                                        }
                                }
                                
                            }else{
                                $query = "SELECT quantidade FROM compras_has_produto WHERE ref_compra = ? AND ref_produto = ?";
                                if(mysqli_stmt_prepare($stmt,$query)){
                                    mysqli_stmt_bind_param($stmt,'ii',$id_da_compra,$id_de_produto);
                                    if(mysqli_stmt_execute($stmt)){
                                        mysqli_stmt_bind_result($stmt,$qty);
                                        mysqli_stmt_fetch($stmt);
                                    }
                                }
                                if($qty == null or $qty == '' or is_null($qty) or empty($qty)){
                                    $qty = 1;
                                }else{
                                    $qty++;
                                }

                                $query = "UPDATE compras_has_produto SET quantidade = ? WHERE ref_compra = ? AND ref_produto = ?";
                                if(mysqli_stmt_prepare($stmt,$query)){
                                    mysqli_stmt_bind_param($stmt,'iii',$qty,$id_da_compra,$id_de_produto);
                                    if(mysqli_stmt_execute($stmt)){
                                        
                                        // header("Location: store-page.php");
                                    }
                                }
                            } 
                        }
                        else{
                            //acrescentar ao compra_has_produto
                            if(isset($_GET['f'])){
                                $id_campo = $_GET['f'];
                                $qtd = 1;
                                $query = "INSERT INTO compras_has_produto (ref_compra,ref_produto,outro_campo,outro_campo_qtd,custo_produto) VALUES(?,?,?,?,?)";
                                if(mysqli_stmt_prepare($stmt,$query)){
                                    mysqli_stmt_bind_param($stmt,'iiiid',$id_da_compra,$id_de_produto,$id_campo,$qtd,$preco);
                                    if(mysqli_stmt_execute($stmt)){
                                        
                                        header("Location: store-page.php");
                                    }
                                }
                            }else{
                                $qtd = 1;
                                $query = "INSERT INTO compras_has_produto (ref_compra,ref_produto,quantidade,custo_produto) VALUES(?,?,?,?)";
                                if(mysqli_stmt_prepare($stmt,$query)){
                                    mysqli_stmt_bind_param($stmt,'iiid',$id_da_compra,$id_de_produto,$qtd,$preco);
                                    if(mysqli_stmt_execute($stmt)){
                                        
                                        // header("Location: store-page.php");
                                    }
                                }
                            }
                        }
                    }
                }
            }
        ?>

    <script>
        $('#hamburger').click(function(){
            $('#hamburger').toggleClass("is-active");
            $('#mobile-navbar').toggleClass("grid-class");
            $('#ham-phone').toggleClass("z-index-6");
            $('body').toggleClass("overflow-hid");
            $('.container-main').toggleClass("overflow-hid");
        });
    </script>

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
        

        <?php 
            if($categoria == "Sementes"){
                echo '<div id="add-cart-button-seed">
                <div>
                    <a href="store-product.php?action=add&id='.$_GET['id'].'">
                    <h4>Comprar para mim</h4>
                    </a>
                </div>
    
                <div id="plantar-num-beeogarden">
                    <h4>Plantar num beeogarden</h4>
                    </a>
                </div>
            </div>';
            }else{
                echo '<div id="add-cart-button">';
                echo '<a href="store-product.php?action=add&id='.$_GET['id'].'"> Adicionar ao carrinho </a>';
                echo '</div>';
            }
        ?>
        
    </div>
    <script src="main.js"></script>
    <script>
    
    var modal = document.getElementById('modal-campos');
    
    document.getElementById('plantar-num-beeogarden').onclick = function(){
        modal.style.display= 'block';
        $('body').toggleClass('body-overflow-modal');
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            $('body').toggleClass('body-overflow-modal');
        };
    };
    </script>


</body>
</html>