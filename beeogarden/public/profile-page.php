<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>beeogarden | perfil</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link href="hamburger.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos2.css">
    <link rel="stylesheet" href="animation.css">
   

</head>
<body>

    <div id="profile-container">
    
        <?php
            session_start();
            $current_page='profile'; 
            include_once "components/navbar.php";
            include_once "components/loader.php";

            require_once "connections/connection.php";
            
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);
            $query = "SELECT beeopoints, foto_perfil, id_utilizador FROM utilizador WHERE utilizador LIKE ?";

            if(mysqli_stmt_prepare($stmt,$query)){
                mysqli_stmt_bind_param($stmt,'s',$_SESSION['username']);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt, $beeopoints,$foto_perfil, $user_id);
                    if(mysqli_stmt_fetch($stmt)){
                        
                    }
                }
            }
            
            $camp_count = "SELECT COUNT(*) FROM espaco WHERE ref_Utilizador LIKE ?";

            if(mysqli_stmt_prepare($stmt,$camp_count)){
                mysqli_stmt_bind_param($stmt,'i',$user_id);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt,$count);
                    mysqli_stmt_fetch($stmt);
                }
            }

            
        ?>
        <div id="profile">
            <div id="profile-img">
                <div id="img-perfil">
                <a href="profile-edit-page.php"><i class="fas fa-pencil-alt"></i></a>
                <?php 
                    if($foto_perfil == NULL or $foto_perfil==""){
                        echo '<img src="'."img/default-user.png".'" alt="">';
                    }else{
                        echo '<img src="'.$foto_perfil.'" alt="">';
                    }
                ?>
                </div>
                <h2><?= $_SESSION['username'];?></h2>
            </div>
            <div id="stats-field">
                <div id="beeopoints">
                    <img src="img/beeopoints.png" alt="">
                    <h3><?php if($beeopoints==NULL or $beeopoints==""){
                        echo '0';
                    }else{
                        echo $beeopoints;
                    }
                    ?></h3>
                </div>
                <div id="campos">
                    <img src="img/campos.png" alt="">
                    <h3><?=$count?></h3>
                </div>
            </div>
            <div id="profile-name">
                    
            </div>
        </div>

        <div id="campos-container">
            <h1>OS MEUS CAMPOS</h1>
            <?php 
            $query = "SELECT nome_espaco, localidade FROM espaco WHERE ref_Utilizador LIKE ? ";

            if(mysqli_stmt_prepare($stmt,$query)){
                mysqli_stmt_bind_param($stmt,'i',$user_id);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt, $nome_espaco, $localidade);
                    while(mysqli_stmt_fetch($stmt)){
                        echo '<div class="campo">';
                        echo '<div id="upper-campo">';
                        echo '<h3>'.$nome_espaco.'</h3>';
                        echo '<i class="far fa-comment fa-2x"></i>';
                        echo '</div>';
                        echo '<div id="lower-campo">';
                        echo '<div>';
                        echo '<i class="fas fa-map-marker-alt"></i>';
                        echo '<h4>'.$localidade.'</h4>';
                        echo '</div>';
                        echo '<div>';
                        echo '<p>'.$beeopoints.'</p>';
                        echo '<img src="img/beeopoints.png" alt="">';
                        echo '</div></div></div>';
                    }
                }
            }
            ?>
        </div>
    </div>

    <script src="main.js"></script>
</body>
</html>