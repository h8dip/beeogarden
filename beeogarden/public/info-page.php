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
    <link rel="shortcut icon" href="img/favicon.png" /> 


</head>
<body>

    <?php //include_once "components/loader.php"; ?>

    <div id="container-info">
        <?php
            session_start();
            $current_page='info';
            include_once "components/navbar.php";
            require_once "connections/connection.php";
            
            if(isset($_GET['f'])){
                switch($_GET['f']){
                    case 'a':
                        $categoria="2";
                    break;
                    case 'f':
                        $categoria="1";
                    break;
                    default:
                        $categoria="2";
                    break;
                }
            }else{
                $categoria="2";
            }
        ?>
        <div id="filter-info">
            <h2>INFORMAÇÕES</h2>
            <?php
                if($categoria==1){
                    $texto = ['','class="active-info-div"'];
                }else{
                    $texto = ['class="active-info-div"',''];
                }

                echo '<a ' . $texto[0] . ' id="info-abelhas" href="?f=a">Abelhas</a>';
                echo '<a ' . $texto[1] . ' id="info-flores" href="?f=f">Flores</a>';
            ?>
        </div>
        <?php 
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);

            if(isset($_SESSION['username'])){
                
                $query = "SELECT id_info, nome_info, info_descricao, info_imagem FROM info WHERE ref_categoria_info = ?";
                if(mysqli_stmt_prepare($stmt,$query)){
                    mysqli_stmt_bind_param($stmt,'i',$categoria);
                    if(mysqli_stmt_execute($stmt)){
                        mysqli_stmt_bind_result($stmt,$id_info,$nome_info,$info_descricao,$info_imagem);
                        while(mysqli_stmt_fetch($stmt)){
                            echo '<a class="info-more" href="info-details.php?id='.$id_info.'"><div class="info-slot">';
                            echo '<div class="info-title">';
                            echo '<p>'.$nome_info.'</p>';
                            echo '</div>';
                            echo '<div id="divider-line" class="line">';
                            echo '<div class="dotted-line"></div>';
                            echo '</div>';
                            echo ' <div class="info-content">
                            <div class="info-img">';
                            echo '<img src="' . $info_imagem . '" alt=""></div>';
                            echo '<div class="info-text">';
                            echo '<p>'.$info_descricao.'</p></div>';
                            echo '</div></div>
                            </a>';
                        }
                    }
                }

            }else{
                header('Location: login-page.php');
            }
        ?>
        
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