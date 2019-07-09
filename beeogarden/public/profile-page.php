<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>beeogarden | Perfil</title>
    <link rel="shortcut icon" href="img/favicon.png" /> 
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link href="hamburger.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos2.css">
    <link rel="stylesheet" href="estilos3.css">
    <link rel="stylesheet" href="animation.css">
   

</head>
<body style="overflow: hidden;">

<div id="modal-user-tutorial" class="modal-tutorial">
        <div class="modal-user-content">
            <div id="register-user-img">
                <img src="img/tutorial-user-1.PNG" id="reg-user-img-1">
                <img src="img/tutorial-user-2.PNG" id="reg-user-img-2">
                <img src="img/tutorial-user-3.PNG" id="reg-user-img-3">
            </div>
            <div id="register-user-text">
                <p id="reg-user-text-1">Explora os produtos da nossa loja.</p>
                <p id="reg-user-text-2">Compra para ti ou envia para um beeogarden.</p>
                <p id="reg-user-text-3">Vê quantas abelhinhas ajudaste!</p>
            </div>
            <div id="register-user-dots">
                <i class="far fa-circle" id="circle-user-1"></i>
                <i class="far fa-circle" id="circle-user-2"></i>
                <i class="far fa-circle" id="circle-user-3"></i>
            </div>
        </div>  
    </div>

    <div id="profile-container" class="container-main">
    
        <?php
            session_start();

            include_once "components/navbar-mobile.php";
            include_once "components/loader.php";
            require_once "scripts/php_scripts.php";

            if(verifyLogin()){

            
            

            $current_page='profile'; 
            include_once "components/navbar.php";
            // include_once "components/loader.php";

            require_once "connections/connection.php";
            
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);
            //check if first timer.

            $query = "SELECT beeopoints, foto_perfil, id_utilizador,first_time FROM utilizador WHERE utilizador LIKE ?";

            if(mysqli_stmt_prepare($stmt,$query)){
                mysqli_stmt_bind_param($stmt,'s',$_SESSION['username']);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt, $beeopoints,$foto_perfil, $user_id,$first_time);
                    if(mysqli_stmt_fetch($stmt)){
                        
                    }
                }
            }

            if($first_time == 0){



                $query = "UPDATE utilizador SET first_time = 1 WHERE id_utilizador LIKE ?";
                if(mysqli_stmt_prepare($stmt,$query)){
                    mysqli_stmt_bind_param($stmt,'i',$user_id);
                    if(mysqli_stmt_execute($stmt)){
                        //
                    }
                }
            }
            
            $camp_count = "SELECT COUNT(*) FROM espaco WHERE ref_Utilizador LIKE ?";
            $cntb_ctr = 0;
            if(mysqli_stmt_prepare($stmt,$camp_count)){
                mysqli_stmt_bind_param($stmt,'i',$user_id);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt,$count);
                    if(mysqli_stmt_fetch($stmt)){
                        
                        
                    }
                }
            }

            $query = "SELECT ref_contribuidores FROM espaco WHERE ref_contribuidores IS NOT NULL";
            if(mysqli_stmt_prepare($stmt,$query)){
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt,$camp_contribuidores);
                    while(mysqli_stmt_fetch($stmt)){
                        $s = explode(',',$camp_contribuidores);
                        foreach($s as $contribuidor){
                            if($contribuidor == $user_id){
                                $cntb_ctr++;
                                break;
                            }
                        }
                    }
                }

            }

            $count += $cntb_ctr;
        }else{
            header('Location: login-page.php');
        }
            
        ?>

        <script>
            $('#hamburger').click(function(){
                $('#hamburger').toggleClass("is-active");
                $('#mobile-navbar').toggleClass("grid-class");
                $('#ham-phone').toggleClass("z-index-6");
                $('body').toggleClass("overflow-hid");
                $('.container-main').toggleClass("overflow-hid");
            });
        </script>

        <div id="profile">
            <div id="profile-img">
                <div id="img-perfil">
                <a href="profile-edit-page.php<?= '?id='.$user_id?>"><i class="fas fa-pencil-alt"></i></a>
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

    <!-- Dar fetch caso não haja campos -->
        <div id="campos-container">
            <h1>OS MEUS CAMPOS</h1>
            
            <?php 
            

            $query = "SELECT id_espaco, nome_espaco, localidade, ref_contribuidores,ref_Utilizador, beeopoints FROM espaco WHERE ref_Utilizador LIKE ? OR ref_contribuidores IS NOT NULL";

            if(mysqli_stmt_prepare($stmt,$query)){
                mysqli_stmt_bind_param($stmt,'i',$user_id);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt,$id_espaco, $nome_espaco, $localidade,$ref_contribuidores,$ref_Utilizador,$beeopoints_field);
                    $contador_de_campos_contribuidos = 0;
                    $contador_de_meus_campos = 0;
                    while(mysqli_stmt_fetch($stmt)){

                        if($ref_Utilizador != $user_id){
                            $array_contribuidores = explode(',',$ref_contribuidores);
                            
                            for($i = 0; $i<count($array_contribuidores); $i++){
                                if($array_contribuidores[$i]==$user_id){
                                    $contador_de_campos_contribuidos++;
                                    //
                                    echo '<div class="campo" >';
                                    echo '<div id="upper-campo">';
                                    echo '<a href="feed-page.php?f=1&id='.$id_espaco.'"><h3>'.$nome_espaco.'</h3></a>';
                                    echo '<a href="chat-list.php?f_id='.$id_espaco.'"><i class="far fa-comment fa-2x"></i></a>';
                                    echo '</div>';
                                    echo '<div id="lower-campo">';
                                    echo '<div>';
                                    echo '<i class="fas fa-map-marker-alt"></i>';
                                    echo '<h4>'.$localidade.'</h4>';
                                    echo '</div>';
                                    echo '<div>';
                                    echo '<p>'.$beeopoints_field.'</p>';
                                    echo '<img src="img/beeopoints.png" alt="">';
                                    echo '</div></div></div>';
                                    break;
                                }
                            }
                        }else{
                            $contador_de_meus_campos++;
                            echo '<div class="campo" >';
                            echo '<div id="upper-campo">';
                            echo '<a href="feed-page.php?f=1&id='.$id_espaco.'"><h3>'.$nome_espaco.'</h3></a>   ';
                            echo '<a href="chat-list.php?f_id='.$id_espaco.'"><i class="far fa-comment fa-2x"></i></a>';
                            echo '</div>';
                            echo '<div id="lower-campo">';
                            echo '<div>';
                            echo '<i class="fas fa-map-marker-alt"></i>';
                            echo '<h4>'.$localidade.'</h4>';
                            echo '</div>';
                            echo '<div>';
                            echo '<p>'.$beeopoints_field.'</p>';
                            echo '<img src="img/beeopoints.png" alt="">';
                            echo '</div></div></div>';                           
                    }
                    
                }
            }
                $count = $contador_de_meus_campos+$contador_de_campos_contribuidos;
                if($count == 0){
                    echo'<div id="no-fields-msg">
                        <img src="img/no-fields.png" alt="">
                        </div>
                        <div id="no-fields-msg-text">
                        <h2>Ainda não tem campos plantados!</h2>
                        </div>';
                }
            }
            ?>
        </div>
    </div>

    <script src="main.js"></script>
    <script src="scripts/checkQueryString.js"></script>
    <script>
        
        window.onload = function(){
            
            document.getElementById("loading-div-container").style.display ="none";


            var first_timer = <?= $first_time ?>;

            if(getParameterByName('error')=='empty-field'){
                alert("O teu campo não foi registado porque não preencheste corretamente o formulário.");
            }
            if(first_timer == 0){

            var modal_user = document.getElementById('modal-user-tutorial');
            var imguser1 = document.getElementById('reg-user-img-1');
            var imguser2 = document.getElementById('reg-user-img-2');
            var imguser3 = document.getElementById('reg-user-img-3');
            var textuser1 = document.getElementById('reg-user-text-1');
            var textuser2 = document.getElementById('reg-user-text-2');
            var textuser3 = document.getElementById('reg-user-text-3');
            var dotuser1 = document.getElementById('circle-user-1');
            var dotuser2 = document.getElementById('circle-user-2');
            var dotuser3 = document.getElementById('circle-user-3');
            var modal_user_count = 1;   

            modal_user.style.display= 'block';
            imguser1.style.display = 'block';
            textuser1.style.display='block';
            dotuser1.classList.remove("far");
            dotuser1.classList.add("fas");
            $('body').toggleClass('body-overflow-modal');
            
            
            
            modal_user.onclick = function (){
                if(modal_user_count==0){
                    imguser1.style.display = 'block';
                    textuser1.style.display='block';
                    dotuser1.classList.remove("far");
                    dotuser1.classList.add("fas");
                }else if(modal_user_count == 1){
                    imguser1.style.display='none';
                    textuser1.style.display='none';
                    dotuser1.classList.remove("fas");
                    dotuser1.classList.add("far");

                    imguser2.style.display='block';
                    textuser2.style.display= 'block';
                    dotuser2.classList.remove("far");
                    dotuser2.classList.add("fas");

                    modal_user_count =2;
                }else if(modal_user_count == 2){
                    imguser2.style.display='none';
                    textuser2.style.display='none';
                    dotuser2.classList.remove("fas");
                    dotuser2.classList.add("far");

                    imguser3.style.display='block';
                    textuser3.style.display='block';
                    dotuser3.classList.remove("far");
                    dotuser3.classList.add("fas");

                    modal_user_count=3;
                }else if(modal_user_count==3){
                    modal_user.style.display = "none";
                    $('body').toggleClass('body-overflow-modal');
                }

            }

        dotuser1.onclick = function(){
            imguser1.style.display = 'block';
            textuser1.style.display='block';
            dotuser1.classList.remove("far");
            dotuser1.classList.add("fas");
            
            imguser2.style.display = 'none';
            imguser3.style.display = 'none';
            textuser2.style.display = 'none';
            textuser3.style.display = 'none';
            dotuser2.classList.remove("fas");
            dotuser2.classList.add("far");
            dotuser3.classList.remove("fas");
            dotuser3.classList.add("far");

            modal_user_count=0;
        }

        dotuser2.onclick = function(){
            imguser2.style.display = 'block';
            textuser2.style.display='block';
            dotuser2.classList.remove("far");
            dotuser2.classList.add("fas");
            
            imguser1.style.display = 'none';
            imguser3.style.display = 'none';
            textuser1.style.display = 'none';
            textuser3.style.display = 'none';
            dotuser1.classList.remove("fas");
            dotuser1.classList.add("far");
            dotuser3.classList.remove("fas");
            dotuser3.classList.add("far");
            
            modal_user_count=1;
        }

        dotuser3.onclick = function(){
            imguser3.style.display = 'block';
            textuser3.style.display='block';
            dotuser3.classList.remove("far");
            dotuser3.classList.add("fas");
            
            imguser2.style.display = 'none';
            imguser1.style.display = 'none';
            textuser2.style.display = 'none';
            textuser1.style.display = 'none';
            dotuser2.classList.remove("fas");
            dotuser2.classList.add("far");
            dotuser1.classList.remove("fas");
            dotuser1.classList.add("far");
            
            modal_user_count=2;
        }


            window.onclick = function(event) {
                if (event.target == modal_user) {
                    modal_user.style.display = "none";
                    $('body').toggleClass('body-overflow-modal');
                };
            };

            }

        }

        </script>
</body>
</html>