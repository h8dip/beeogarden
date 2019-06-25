<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos2.css">
    <link rel="stylesheet" href="estilos3.css">
    <link href="hamburger.css" rel="stylesheet">
    <link href="animation.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <title>beeogarden | Carrinho de Compras</title>
</head>
<body>
    
    <div id="profile-edit-container">
        <div id="pe-title">
            <div>
                <h1>ALTERAR PERFIL</h1>
            </div>
        </div>

        <div id="pe-edit">
            <div id="pe-edit-img">
                <a href="#"><i class="fas fa-pencil-alt" id="edit-photo"></i></a>
                <div>
                    <img src="img/horacio.PNG" alt="">
                </div>
            </div>

            <div id="pe-edit-form">
                <form action="scripts/profile-edit.php">
                    <input type="text" name="nome" placeholder="Nome">
                    <input type="email" name="email" placeholder="Email">
                    <textarea type="bio" rows="40" name="bio" placeholder="Bio" style="display:block;"></textarea>  
                    <select placeholder="Género" name="genero">
                        <option value="volvo">Masculino</option>
                        <option value="saab">Feminino</option>
                        <option value="saab">Outro</option>
                    </select>
                </form>
            </div>
        </div>

        <?php include_once "components/save-btn.php"; ?>
    </div>

</body>