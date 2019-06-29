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
    <title>Beeogarden | Info</title>
    <link rel="shortcut icon" href="img/favicon.png" /> 


</head>
<body>
    <div id="container-info-details">
        <?php 
            $current_page = 'info';
            session_start();
            include_once "components/navbar.php";
            require_once "connections/connection.php";
            require_once "scripts/php_scripts.php";

            if(verifyLogin()){
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                if(isset($_GET['id'])){
                    $id = htmlspecialchars($_GET['id']);
                    $query = "SELECT nome_info, info_descricao, info_imagem FROM info WHERE id_info = ?";
                    if(mysqli_stmt_prepare($stmt,$query)){
                        mysqli_stmt_bind_param($stmt,'i',$id);
                        if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_bind_result($stmt,$nome_info,$descricao_info,$imagem_info);
                            if(mysqli_stmt_fetch($stmt)){

                            }
                        }
                    }
                }else{
                    header('Location: info-page.php');
                }
            }else{
                header('Location: login-page.php');
            }
        ?>

        <div id="title-info">
            <h2><?= $nome_info?></h2>
        </div>

        <div id="info-detail-content">
            <div id="info-detail-img">
                <img src="<?= $imagem_info?>" alt="">
            </div>
            <div id="info-detail-text">
                <p><?= $descricao_info?></p>
            </div> 
        </div>
    </div>


<script src="main.js"></script>

</body>
</html>