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

<body style="overflow-y: auto">

    <?php include_once "components/loader.php"; ?>

    <div id="container-loja">
        <?php
            $current_page='store';
            include_once "components/navbar.php";
        ?>
        <div id="showcase-store">
        
            <div id="showcase-image">
                <div class="mySlides fade" id="img1">
                    <img src="img/bee-house.PNG" alt="showcase-img">
                </div>
                <div class="mySlides fade" id="img2">
                    <img src="img/semente_girassol.jpg" alt="showcase-img">
                </div>
                <div class="mySlides fade" id="img3">
                    <img src="img/produto-2.jpg" alt="showcase-img">
                </div>
                <div class="mySlides fade" id="img4">
                    <img src="img/produto-4.jpg" alt="showcase-img">
                </div>
                <a class="prev" id="prev"><i class="fas fa-chevron-circle-left"></i></a>
                <a class="next" id="next"><i class="fas fa-chevron-circle-right"></i></a>
            </div>
        
        </div>
        <div id="filter-store">
            <i class="fas fa-chevron-right"></i>
            <a href="#" class="filter-active">TUDO</a>
            <a href="#">ROUPA</a>
            <a href="#">CONSTRUÇÕES</a>
            <a href="#">SEMENTES</a>
        </div>
        <?php 
            require_once "connections/connection.php";
            
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);
            $query = "SELECT id_produto, img_path, nome_produto FROM produto";

            if(mysqli_stmt_prepare($stmt,$query)){
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt,$id_produto,$img_path, $nome_produto);
                    
                    while(mysqli_stmt_fetch($stmt)){
                        $img_a = explode(';',$img_path);
                        if(array_key_exists(0,$img_a)){
                            $img_s = htmlspecialchars($img_a[0]);
                        }
                        $rndN = rand(1,10);
                        if($rndN > 8){
                            $class = "produto-span-2";        
                        }else{$class=""; };
                        echo '<div id="produto-'.$id_produto.'" class="produto '.$class.'">';
                        echo '<a href="store-product.php?id='.$id_produto.'">'
                        .
                        '<img src="'.$img_s.'" alt="">'.'<div class="overlay"><div class="text">'.$nome_produto.'</div>
                        </div></a></div>';
                    }
                }
            }
        ?>
    <script src="main.js"></script>
</body>
</html>