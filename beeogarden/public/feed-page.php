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
                <i class="fas fa-arrow-left"></i>
                <a href="#">
                    <div id="btn-post">
                        <p>Publicar</p>
                    </div>
                </a>
            </div>
            <div id="modal-post-content">
                <div id="modal-post-input">
                    <textarea rows="12" cols="27">  O que está a acontecer?
                    </textarea>
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
            include_once "components/navbar.php"
         ?>

        <div id="feed-title">
            <h1>Universidade de Aveiro</h1>
            <div>
                <img src="img/greta.png" alt="">
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

            <div class="post">
                <div class="post-details">
                    <div><img src="img/greta.png" alt=""></div>
                    <div>
                        <h3>Greta Thunberg</h3>
                        <h6>Ontem às 16:00h</h6>
                    </div>
                </div>
                <div class="post-text">
                    <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum quidem iure aliquam, excepturi necessitatibus rem.</h3>
                </div>
                <div class="post-image">
                    <img src="img/bee-house.PNG" alt="">
                </div>
            </div>

            <div class="post">
                <div class="post-details">
                    <div><img src="img/greta.png" alt=""></div>
                    <div>
                        <h3>Greta Thunberg</h3>
                        <h6>Ontem às 16:00h</h6>
                    </div>
                </div>
                <div class="post-text">
                    <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum quidem iure aliquam, excepturi necessitatibus rem.</h3>
                </div>
            </div>

            <div class="post">
                <div class="post-details">
                    <div><img src="img/greta.png" alt=""></div>
                    <div>
                        <h3>Greta Thunberg</h3>
                        <h6>Ontem às 16:00h</h6>
                    </div>
                </div>
                <div class="post-text">
                    <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum quidem iure aliquam, excepturi necessitatibus rem.</h3>
                </div>
                <div class="post-image">
                    <img src="img/bee-house.PNG" alt="">
                </div>
            </div>
        </div>
    </div>
    
    <div id="add-post-icon"><i class="fas fa-plus-circle fa-5x"></i></div>

    <script src="main.js"></script>

    <script>

        window.onload = function(){
            var modal_post = document.getElementById('modal-post');
            var post_trigger = document.getElementById('add-post-icon');

            post_trigger.onclick=function(){
                modal_post.style.display='block';
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