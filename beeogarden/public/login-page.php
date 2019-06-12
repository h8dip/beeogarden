<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <title>beeogarden | Faça login</title>
</head>
<body>
<?php 
    
?>
    <div id="login-container">
        <div id="upper-login-text">
            <div>
                <img src="img/logo_beeogarden-8.png" alt="Logo">
                <h1>ENTUK</h1>
            </div>
        </div>
        <div id="login-form">
            <form action="scripts/login.php" method="POST">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <button class="btn-primary" type="submit">Login</button>
            </form>
        </div>
        <div id="register-option-container">
            <p>Ainda não tens uma conta? <a class="highlight-text" href="register-page.html">Regista-te!</a></p>
        </div>
    </div>
    
</body>
</html>