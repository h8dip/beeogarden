<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estilos-temporary.css">
    <link href="hamburger.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <title>beeogarden | Loja</title>
</head>

<body style="overflow-y: auto">
    <div id="container-loja">
        <?php
            include_once "components/navbar.php";
        ?>
        <div id="showcase-store">
            <div id="showcase-image">
                <img src="img/bee-house.PNG" alt="showcase-img">
            </div>
        </div>
        <div id="filter-store">
            <i class="fas fa-chevron-right"></i>
            <a href="#" class="filter-active">TUDO</a>
            <a href="#">ROUPA</a>
            <a href="#">CONSTRUÇÕES</a>
            <a href="#">SEMENTES</a>
        </div>
        <div id="produto-1" class="produto">
            <img src="img/produto-1.jpg" alt="">
        </div>
        <div id="produto-2" class="produto produto-span-2">
            <img src="img/produto-2.jpg" alt="">
        </div>
        <div id="produto-3" class="produto">
            <img src="img/produto-5.jpg" alt="">
        </div>
        <div id="produto-4" class="produto">
            <img src="img/produto-4.jpg" alt="">
        </div>
        <div id="produto-5" class="produto">
            <img src="img/produto-6.jpg" alt="">
        </div>
        <div id="produto-6" class="produto produto-span-2">
            <img src="img/produto-7.png" alt="">
        </div>
        <div id="produto-7" class="produto">
            <img src="img/produto-3.png" alt="">
        </div>
        <div id="produto-8" class="produto">
            <img src="img/produto-1.jpg" alt="">
        </div>
        <div id="produto-9" class="produto">
            <img src="img/produto-5.jpg" alt="">
        </div>
        <div id="produto-10" class="produto">
            <img src="img/produto-6.jpg" alt="">
        </div>
        <div class="produto">
            <img src="img/produto-7.png" alt="">
        </div>
        <div class="produto">
            <img src="img/produto-1.jpg" alt="">
        </div>
        <div class="produto">
            <img src="img/produto-3.png" alt="">
        </div>
        <div class="produto">
            <img src="img/produto-2.jpg" alt="">
        </div>
        <div class="produto">
            <img src="img/produto-4.jpg" alt="">
        </div>
        <div class="produto">
            <img src="img/produto-5.jpg" alt="">
        </div>
    </div>

    <script src="main.js"></script>
</body>
</html>