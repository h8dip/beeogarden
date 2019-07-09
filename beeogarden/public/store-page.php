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
    <script src="scripts/checkQueryString.js"></script>
    <title>beeogarden | Loja</title>
    <link rel="shortcut icon" href="img/favicon.png" /> 

</head>

<body style="overflow:hidden;">

    <?php include_once "components/navbar-mobile.php"?>
        
        
    <div id="container-loja" class="container-main" >
        <?php
            require_once "scripts/php_scripts.php";
            include_once "components/loader.php";
            if(verifyLogin()){

            }else{
                header('Location: login-page.php');
            }
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
            <?php 
                if(isset($_GET['f'])){
                    switch($_GET['f']){
                        case 't':
                        echo '<a href="?f=t" class="filter-active">TUDO</a>
                    <a href="?f=r">ROUPA</a>
                    <a href="?f=c">CONSTRUÇÕES</a>
                    <a href="?f=s">SEMENTES</a>';
                        break;
                        case 'r':
                        echo '<a href="?f=t" >TUDO</a>
                    <a href="?f=r" class="filter-active">ROUPA</a>
                    <a href="?f=c">CONSTRUÇÕES</a>
                    <a href="?f=s">SEMENTES</a>';
                        break;
                        case 'c':
                        echo '<a href="?f=t">TUDO</a>
                    <a href="?f=r">ROUPA</a>
                    <a href="?f=c"  class="filter-active">CONSTRUÇÕES</a>
                    <a href="?f=s">SEMENTES</a>';
                        break;
                        case 's':
                        echo '<a href="?f=t" >TUDO</a>
                    <a href="?f=r">ROUPA</a>
                    <a href="?f=c">CONSTRUÇÕES</a>
                    <a href="?f=s" class="filter-active">SEMENTES</a>';
                        break;
                        default:
                        echo '<a href="?f=t" class="filter-active">TUDO</a>
                    <a href="?f=r">ROUPA</a>
                    <a href="?f=c">CONSTRUÇÕES</a>
                    <a href="?f=s">SEMENTES</a>';
                        break;
                    }
                }else{
                    echo '<a href="?f=t" class="filter-active">TUDO</a>
                    <a href="?f=r">ROUPA</a>
                    <a href="?f=c">CONSTRUÇÕES</a>
                    <a href="?f=s">SEMENTES</a>';
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

        $('#nav-mob-cls').click(function(){
                $('#hamburger').toggleClass("is-active");
                $('#mobile-navbar').toggleClass("grid-class");
                $('#ham-phone').toggleClass("z-index-6");
                $('body').toggleClass("overflow-hid");
                $('.container-main').toggleClass("overflow-hid");
            });
        </script>           
        </div>
        <?php 
            require_once "connections/connection.php";
            
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);
            if(isset($_GET['f'])){
                switch($_GET['f']){
                    case 't':
                        $str = "";
                    break;
                    case 'r':
                        $str = ' WHERE categoria LIKE ?';
                        $categ = "Roupa";
                    break;
                    case 'c':
                        $str = ' WHERE categoria LIKE ?';
                        $categ = "Construcao";
                    break;
                    case 's';
                        $str = ' WHERE categoria LIKE ?';
                        $categ = "Sementes";
                    break;
                    default:
                        $str = "";
                    break;
                }
            }else{
                $str = "";
            }
            
            $query = "SELECT id_produto, img_path, nome_produto FROM produto";
            if($str != ""){$query .= $str; }
            if(mysqli_stmt_prepare($stmt,$query)){
                if($str != ""){

                    mysqli_stmt_bind_param($stmt,'s',$categ);
                }
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt,$id_produto,$img_path, $nome_produto);
                    
                    while(mysqli_stmt_fetch($stmt)){
                        $img_a = explode(';',$img_path);
                        if(array_key_exists(0,$img_a)){
                            $img_s = htmlspecialchars($img_a[0]);
                        }
                        $rndN = rand(1,100);
                        if($rndN > 92){
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
    <script>
        window.onload=function(){

            // LOADER
            document.getElementById("loading-div-container").style.display ="none";
            $('html, body').css({
                'overflow': 'auto',
            });
            

            // CARROSSEL
            var slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            function showSlides() {
                var prev = document.getElementById("prev");
                var next = document.getElementById("next");
                var p = 1;
                var h = p;
                var slides_lenght = document.querySelectorAll('#showcase-image .mySlides').length;
                var img ="img";

                document.getElementById(img+p).style.display="block"; 

                prev.onclick = function(){
                    h = p;
                    if(p>1){
                        p--;
                        document.getElementById(img+p).style.display="block";
                        document.getElementById(img+h).style.display="none";
                    }else{
                        p=1;
                        document.getElementById(img+p).style.display="block";
                    }
                }

                next.onclick = function(){
                    h = p;
                    if(p<slides_lenght){

                        p++;
                        document.getElementById(img+p).style.display="block";
                        document.getElementById(img+h).style.display="none";   
                    }else{
                        document.getElementById(img+p).style.display="block";
                    }
                }
            };
        }
    </script>
</body>
</html>