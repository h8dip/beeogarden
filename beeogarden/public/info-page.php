<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos-temporary.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="animation.css">
    <link href="hamburger.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <title>Beeogarden | info</title>

</head>
<body>

    <?php include_once "components/loader.php"; ?>

    <div id="container-info">
        <?php
            $current_page='info';
            include_once "components/navbar.php";
        ?>
        <div id="title">
            <h1>INFORMAÇÕES</h1>
        </div>
        <div id="filter">
            <a href="#"> <p class="selected-info">Abelhas</p></a>
            <a href="#"> <p class="not-selected-info">Flores</p> </a>
        </div>
    </div>
    <div id="footer-info">

    </div>

    <script src="main.js"></script>

</body>
</html>