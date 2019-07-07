<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estilos3.css">
    <link rel="stylesheet" href="estilos2.css">
    <link rel="stylesheet" href="animation.css">
    <link href="hamburger.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <script src="scripts/checkQueryString.js"></script>
    <title>beeogarden | Lista de Contribuidores</title>
    <link rel="shortcut icon" href="img/favicon.png" /> 
</head>
<body>

    <?php 
        session_start();
        require_once "scripts/php_scripts.php";
        require_once "connections/connection.php";

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $our_id = getUserId();

        if(verifyLogin()){

        }else{
            header('login-page.php'); 
        }
    ?>
    <div id="chat-list-container">
        <div id="chat-list-top">
            <a href="profile-page.php"><i class="fas fa-arrow-left fa-2x"></i></a>
            <div id="chat-list-img-container">
                <?php 
                    if(isset($_GET['f_id']) and is_numeric($_GET['f_id'])){
                        
                        $id_espaco = htmlspecialchars($_GET['f_id']);
                        $query = "SELECT foto_perfil FROM espaco INNER JOIN utilizador ON ref_Utilizador = id_utilizador WHERE id_espaco = ?";
                        if(mysqli_stmt_prepare($stmt,$query)){
                            mysqli_stmt_bind_param($stmt,'i',$id_espaco);
                            if(mysqli_stmt_execute($stmt)){
                                mysqli_stmt_bind_result($stmt, $foto_f_owner);
                                if(mysqli_stmt_fetch($stmt)){
                                    echo '<img src="'.$foto_f_owner.'" alt="">';

                                }
                            }
                        }
                        
                    }else{
                        //bye bye
                        header('profile-page.php');
                    }

                ?>
            </div>
            <h2>Chat</h2>
        </div>

        <div id="chat-list-search">
            <form action="#">
                <input type="search" name="chat-search" id="chat-search" placeholder="Search...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <?php 
            

            if(isset($_GET['f_id']) and is_numeric($_GET['f_id'])){
                
                $id_espaco = $_GET['f_id'];
                $owner_info = obtainOwnerInfo($id_espaco);
                fill_owner_chat($owner_info,$id_espaco);

                $query = "SELECT ref_contribuidores FROM espaco WHERE id_espaco = ?";
                if(mysqli_stmt_prepare($stmt,$query)){
                    mysqli_stmt_bind_param($stmt,'i',$id_espaco);
                    if(mysqli_stmt_execute($stmt)){
                        mysqli_stmt_bind_result($stmt,$ref_contribuidores);
                        if(mysqli_stmt_fetch($stmt)){
                            $individual = explode(',',$ref_contribuidores);
                            foreach($individual as $colaborador){
                                if($colaborador != $our_id){
                                    $query = "SELECT foto_perfil, utilizador FROM utilizador WHERE id_utilizador = ?";
                                    if(mysqli_stmt_prepare($stmt,$query)){
                                        mysqli_stmt_bind_param($stmt,'i',$colaborador);
                                        if(mysqli_stmt_execute($stmt)){
                                            mysqli_stmt_bind_result($stmt,$foto_perfil,$username);
                                            if(mysqli_stmt_fetch($stmt)){
                                                layout_chat($colaborador,$username,$foto_perfil,$id_espaco);
                                                //TO-DO : Grab last message if any , time of , if any.. display.
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

            }else{
                //bye bye
                header('profile-page.php');
            }


            
        ?>
    </div>
</body>
</html>