<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>beeogarden | Bem-vindo</title>
    <link rel="shortcut icon" href="img/favicon.png" /> 
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="animation.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <link rel="manifest" href="manifest.json">
</head>
<body>
    <?php 
     session_start();
    //  include_once "components/loader.php";
    
    require_once "scripts/php_scripts.php";
   
    if(verifyLogin()){
        header('Location: profile-page.php');
    }
    ?>
    <div id="welcome-container">
        <div id="welcome-text">
            <div id="welcome-logo">
                <img src="img/logo_beeogarden-8.png">
            </div>
            <div id="welcome-title">
                <h1>BEM-VINDO</h1>
                <h3>ao seu jardim virtual</h4>
            </div>
        </div>

        <div id="welcome-buttons">
            <a href="login-page.php"><button class="btn-primary">Entrar</button></a>
            <a href="register-page.php"><button class="btn-secondary">Registar</button></a>
        </div>
    </div>
    <script src="main.js"></script>
    <script>
        window.onload=function(){
            document.getElementById("loading-div-container").style.display ="none";
        }
    </script>
</body>
</html>