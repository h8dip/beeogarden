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
    <title>beeogarden | Feed</title>
    <link rel="shortcut icon" href="img/favicon.png" /> 

</head>
<body>

    <div id="modal-post" class="modal-post">
        <div id="modal-post-container">
            <div id="modal-post-header">
                <i id="back-post-btn" class="fas fa-arrow-left"></i>
                <a href="#">
                    <div id="btn-post">
                        <p>Publicar</p>
                    </div>
                </a>
            </div>
            <div id="modal-post-content">
                <div id="modal-post-input">
                    <textarea placeholder="O que está a acontecer?"></textarea>
                </div>
                <div id="modal-post-upload">
                    <i class="fas fa-images"></i>
                </div>
            </div>
        </div>
    </div>

    <div id="feed-page-container">
        <?php
            $current_page='info';
            include_once "components/navbar.php";
            require_once "connections/connection.php";
            session_start();
            require_once "scripts/php_scripts.php";


            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);
            $stmt2 = mysqli_stmt_init($link);
         ?>

        <div id="feed-title">
            
           
                <?php
                if(verifyLogin()){
                    if(isset($_GET['id'])){
                        $id_espaco = htmlspecialchars($_GET['id']);
                        $query = "SELECT nome_espaco, foto_perfil FROM espaco INNER JOIN utilizador ON ref_Utilizador = id_utilizador WHERE id_espaco = ?";
                        if(mysqli_stmt_prepare($stmt,$query)){
                            mysqli_stmt_bind_param($stmt,'i',$id_espaco);
                            if(mysqli_stmt_execute($stmt)){
                                mysqli_stmt_bind_result($stmt,$nome_espaco, $foto_f_owner);
                                if(mysqli_stmt_fetch($stmt)){
                                    echo '<h1>'.$nome_espaco.'</h1><div>';
                                    echo '<img src="'.$foto_f_owner.'" alt="">';

                                }
                            }
                        }
                    }
                }   
                else{
                    header('Location: login-page.php');
                }
                ?> 
               
            </div>
        </div>

        <div id="posts">
            <div id="feed-profile-stats">
                <div>
                    <h3>Flores</h3>
                    <h3>Beeokeepers</h3>
                    <h3>Abelhas</h3>
                </div>

                <div>
                    <h3>09</h3>
                    <h3>09</h3>
                    <h3>09</h3>
                </div>
            </div>
            <?php 
             if(verifyLogin()){
                if(isset($_GET["f"]))
                {
                    if($_GET['f'] == 1){
                        //field feed
                        if(isset($_GET['id'])){
                            $id = htmlspecialchars($_GET['id']);
                            $query = "SELECT id_post, descricao, data, imagem, ref_Utilizador, foto_perfil, utilizador FROM posts INNER JOIN utilizador ON ref_Utilizador = id_utilizador WHERE ref_espaco = ?";
                            if(mysqli_stmt_prepare($stmt,$query)){
                                mysqli_stmt_bind_param($stmt,'i',$id);
                                if(mysqli_stmt_execute($stmt))
                                {
                                    mysqli_stmt_bind_result($stmt,$id_post,$descricao,$data,$imagem,$ref_Utilizador,$foto_perfil,$username);
                                    $query2 = "SELECT foto_perfil FROM utilizador WHERE ";
                                    while(mysqli_stmt_fetch($stmt)){
                                        
                                        echo '<div class="post">';
                                        echo '<div class="post-details">';
                                        echo '<div><img src="'.$foto_perfil.'" alt=""></div>';
                                        echo '<div>';
                                        echo '<h3>'.$username.'</h3>';
                                        echo '<h6>'.$data.'</h6>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '<div class="post-text">';
                                        echo '<h3>'.$descricao.'</h3>';
                                        echo '</div>';
                                        echo '<div class="post-image">';
                                        echo '<img src="'.$imagem.'" alt="">';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }
                            }
                        }
                    }
                }
            }else{
                header('Location: login-page.php');
            }
            ?>
        </div>    
    </div>
    
    <div id="add-post-icon"><i class="fas fa-plus-circle fa-5x"></i></div>

    <script src="main.js"></script>

    <script>

        window.onload = function(){
            var modal_post = document.getElementById('modal-post');
            var post_trigger = document.getElementById('add-post-icon');
            var back_btn = document.getElementById('back-post-btn');

            post_trigger.onclick=function(){
                modal_post.style.display='block';
                $('body').toggleClass('body-overflow-modal');
            };

            back_btn.onclick=function(){
                modal_post.style.display = "none";
                    $('body').toggleClass('body-overflow-modal');
            };

            window.onclick = function(event){
                if(event.target == modal_post){
                    modal_post.style.display = "none";
                    $('body').toggleClass('body-overflow-modal');
                };
            };
        }

    </script>

</body>