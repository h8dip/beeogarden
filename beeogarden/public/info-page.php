<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estilos2.css">
    <link rel="stylesheet" href="estilos3.css">
    <link rel="stylesheet" href="animation.css">
    <link href="hamburger.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <title>Beeogarden | info</title>

</head>
<body>

    <?php //include_once "components/loader.php"; ?>

    <div id="container-info">
        <?php
            $current_page='info';
            include_once "components/navbar.php";
        ?>
        <div id="filter-info">
            <h2>INFORMAÇÕES</h2>
            <a class="active-info-div" id="info-abelhas" href="#">
                Abelhas
            </a>
            <a id="info-flores" href="#">
                Flores
            </a>
        </div>
        <a class="info-more" href="info-details.php"><div class="info-slot">
            <div class="info-title">
                <p>Abelhas</p>
            </div>
            <div id="divider-line" class="line">
                <div class="dotted-line"></div>
            </div>
            <div class="info-content">
                <div class="info-img">
                    <img src="img/salvia_off.jpg" alt="">
                </div>
                <div class="info-text">
                    <p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxtexto que fala sobre como as abelhinhas são muito lindas e importantes</p>
                </div>
            </div>
        </div></a>
        <a class="info-more" href="info-details.php"><div class="info-slot">
            <div class="info-title">
                <p>Abelhas</p>
            </div>
            <div id="divider-line" class="line">
                <div class="dotted-line"></div>
            </div>
            <div class="info-content">
                <div class="info-img">
                    <img src="img/salvia_off.jpg" alt="">
                </div>
                <div class="info-text">
                    <p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxtexto que fala sobre como as abelhinhas são muito lindas e importantes</p>
                </div>
            </div>
        </div></a>
        <a class="info-more" href="info-details.php"><div class="info-slot">
            <div class="info-title">
                <p>Abelhas</p>
            </div>
            <div id="divider-line" class="line">
                <div class="dotted-line"></div>
            </div>
            <div class="info-content">
                <div class="info-img">
                    <img src="img/salvia_off.jpg" alt="">
                </div>
                <div class="info-text">
                    <p>xxxxxxxxxxxxxxxxxxxxxxxxxxtexto que fala sobre como as abelhinhas são muito lindas e importantes</p>
                </div>
            </div>
        </div></a>
    </div>
    
    <div id="topo-btn">
        <a href="#">Voltar ao topo</a>
    </div>


    <script src="main.js"></script>

    <script>
        //não está a fazer coneção ao ficheiro js
        $('#filter-info a').click(function(){
            $('#filter-info a.active-info-div').removeClass('active-info-div');
            $(this).addClass('active-info-div');
        });
    </script>

</body>
</html>