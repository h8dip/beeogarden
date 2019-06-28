<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>beeogarden | Registe-se</title>
    <link rel="shortcut icon" href="img/favicon.png" /> 
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="animation.css">

</head>
<body>

    <?php include_once "components/loader.php"; ?>


    <div id="register-container">
        <div id="upper-text">
            <div>
                <img src="img/logo_beeogarden-8.png" alt="Logo">
                <h1>REGISTE-SE</h1>
            </div>
        </div>
        <div id="register-form">
            <form action="scripts/register.php" method="POST">
                <input type="text" name="username" placeholder="Nome">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <select name="entidade" id="entidade">
                    <option value="Privado">Privado</option>
                    <option value="Institucional">Institucional</option>
                </select>
                <div id="checkbox-container">
                    <input name="terms" type="checkbox"><span id="inline-terms">Aceito os <a href="#" class="highlight-text">termos e condições</a> gerais da aplicação</span>
                </div>
                <button class="btn-primary" type="submit">Registar</button>
            </form>
        </div>
        <div id="login-option-container">
            <p>Já tens uma conta? <a class="highlight-text" href="login-page.php">Faz login</a></p>
        </div>
    </div>
    
    <script src="main.js"></script>

</body>
</html>