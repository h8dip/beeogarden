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
    <link href="hamburger.css" rel="stylesheet">
    <link href="animation.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <title>beeogarden | Carrinho de Compras</title>
</head>
<body>
    <div id="field-regist-container">
    
        <div id="fr-title">
            <div>
                <h1>REGISTA O TEU BEEOGARDEN</h1>
            </div>
        </div>

        <div id="register-content">
            <div id="fr-form">
                <form action="register-field.php">
                    <input type="text" name="morada" placeholder="Morada">
                    <div id="zip-localidade">
                        <input type="text" name="codpostal" placeholder="Cód.Postal">
                        <input type="text" name="localidade" placeholder="Localidade">
                    </div>
                    <input type="number" name="lotes" placeholder="Número de Lotes"> 
                
                    <select placeholder="Acessibilidade" name="acesso">
                        <option value="volvo">Público</option>
                        <option value="saab">Privado</option>
                    </select>
                </form>
            </div>
        </div>

        <div id="warning-register">
            <p id="public-warning"><span id="ast">*</span>Ao selecionar “Público”, a localização do seu beeogarden irá ser apresentada no Mapa e acessível a todos os utilizadores da aplicação.</p>
        </div>


        <?php include_once "components/save-btn.php" ?>
    </div>


    

    <script src="main.js"></script>

</body>
</html>