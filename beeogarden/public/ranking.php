<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estilos2.css">
    <link href="hamburger.css" rel="stylesheet">
    <link href="animation.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <title>beeogarden | Carrinho de Compras</title>
</head>
<body>

    <?php 
    session_start();

    require_once "connections/connection.php";
            
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    if(!isset($_SESSION['username'])){
        header('Location: login-page.php');
    }else{
        $p_granted = true;
    }
    ?>


<div id="ranking-container">
    <?php
        $current_page='ranking';
        include_once "components/navbar.php";
    ?>

    <div id="top-three">
    <?php 
        //selecionar os top 3 img path
        if($p_granted){
            $query = "SELECT foto_perfil FROM utilizador ORDER BY beeopoints DESC LIMIT 0,3";
            if(mysqli_stmt_prepare($stmt,$query)){
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt,$img);
                    $counter=0;
                    while(mysqli_stmt_fetch($stmt)){
                        $counter++;
                        if($counter==1){
                            $number1_pic = $img;
                        }else if ($counter==2){
                            if($number1_pic == ""){$number1_pic = "img/default-user.PNG";}
                            if($img==""){$img="default-user.PNG";}
                            echo '<div>';
                            echo '<img src="'.$img.'" alt="">';
                            echo '</div>';
                            echo '<div>';
                            echo '<img src="'.$number1_pic.'" alt="">';
                            echo '</div>';
                        }else{
                            if($img==""){$img="img/default-user.PNG";}
                            echo '<div>';
                            echo '<img src="'.$img.'" alt="">';
                            echo '</div>';
                        }
                    }
                }
            }
        }
    ?>
    </div>

    <div id="top-beeofriends">
        <div id="top-beeofriends-title">
            <h1 id="h1-title">TOP BEEOFRIENDS</h1>
        </div>
        <?php 
            if($p_granted){
                $query = "SELECT foto_perfil, utilizador, beeopoints FROM utilizador ORDER BY beeopoints DESC";
                if(mysqli_stmt_prepare($stmt,$query)){
                    if(mysqli_stmt_execute($stmt)){
                        mysqli_stmt_bind_result($stmt,$foto,$utilizador,$beeopoints);
                        $ctr = 0;
                        while(mysqli_stmt_fetch($stmt)){
                            $ctr++;
                            if($foto == "")
                            {
                                $foto="img/default-user.PNG";
                            }
                            echo '<div class="ranking-spot">';
                            echo '<div class="ranking-num"><h1>'.$ctr.'</h1></div>';
                            echo '<div class="ranking-name">';
                            echo '<div><h2>'.$utilizador.'</h2></div>';
                            echo '<div>';
                            echo '<h3>'.$beeopoints.'</h3>';
                            echo '<img src="img/beeopoints.png" alt="">';
                            echo '</div></div>';
                            echo '<div class="ranking-foto">';
                            echo '<img src="'.$foto.'" alt="">';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                }
            }
        ?> 
    </div>
</div>



    <script src="main.js"></script>
</body>