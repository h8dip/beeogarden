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
    <script src="scripts/checkQueryString.js"></script>
    <title>beeogarden | Chat</title>
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
        $rec_id = null;
        $chat = null;

        if(verifyLogin()){
            if(isset($_GET['id']) and is_numeric($_GET['id'])){
                $rec_id = $_GET['id'];
            }
            $chat = getChat($our_id,$rec_id); //creates if doesnt exist, returns id. :)
        }else{
            header('Location: login-page.php');
        }

        $all_ids = array();

        
    ?>
    <div id="modal-block">
        <div class="modal-block-content">
            <div id="modal-block-top">
                <h1>Tem a certeza que pretende bloquear este utilizador? Esta ação não pode ser revertida mais tarde.</h1>
            </div>
            <div id="modal-block-btns">
                <button id="cancel-btn-modal" class="cancel-btn-modal">Cancelar</button>
                <button class="continue-btn-modal">Continuar</button>
            </div>
        </div>
    </div>
    
    <div id="modal-report">
        <div class="modal-report-content">
            <div id="modal-report-top">
                <h3>Reportar utilizador</h3>
            </div>
            <div id="modal-report-form">
                    <form action="" id="report-form">
                        <select placeholder="Motivo da denúncia" name="motivo">
                            <option value="spam">Spam</option>
                            <option value="nudez">Nudez ou pornogarfia</option>
                            <option value="improprio">Discurso impróprio</option>
                            <option value="violencia">Ameças de violência</option>
                            <option value="drogas">Venda ou promoção de drogas</option>
                            <option value="assedio">Assédio ou bullying</option>
                            <option value="identidade">Usurpação de identidade</option>
                        </select>
                    </form>
                    <textarea name="comentario" id="report-obs" form="report-form"></textarea>
            </div>
            <div id="modal-report-btns">
                <button id="cancel-report-modal" class="cancel-btn-modal">Cancelar</button>
                <button class="continue-btn-modal">Reportar</button>
            </div>
        </div>
    </div>

    <div id="chat-container">
        <div id="top-chat">
            <div id="top-chat-content">
                <?php 
                    if(isset($_GET['f_id']) and is_numeric($_GET['f_id'])){
                        echo '<a href="chat-list.php?f_id='.$_GET['f_id'].'">';
                    }else{
                        echo '<a href="profile-page.php">';
                    }
                ?>
                <i id="back-chat-btn" class="fas fa-arrow-left"></i></a>
                <?php 
                    if(isset($_GET['id']) and is_numeric($_GET['id'])){
                        $query = "SELECT foto_perfil, utilizador FROM utilizador WHERE id_utilizador = ?";
                        if(mysqli_stmt_prepare($stmt,$query)){
                            mysqli_stmt_bind_param($stmt,'i',$rec_id);
                            if(mysqli_stmt_execute($stmt)){
                                mysqli_stmt_bind_result($stmt, $foto,$user);
                                if(mysqli_stmt_fetch($stmt)){
                                    echo '<img src="'.$foto.'" alt="">';
                                    echo '<p>'.$user.'</p>';

                                }
                            }
                        }
                        
                    }else{
                        //bye bye
                        header('profile-page.php');
                    }
                ?>
                <div class="dropdown">
                    <i id="def-btn" class="fas fa-cog dropbtn"></i>
                    <div class="dropdown-content">
                        <a href="#">Notificações</a>
                        <a id="block-user" href="#">Bloquear utilizador</a>
                        <a id="report-user" href="#">Denunciar utilizador</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="chat-content">
            <?php 
                loadAllChatMessages($chat,$our_id,$rec_id,$stmt,$foto,$all_ids);

                function loadAllChatMessages($chat,$us,$them,$stmt,$foto,&$array){
                    $query = "SELECT id_mensagem, mensagem, estado_mensagem, sender_id FROM mensagens WHERE ref_chat = ?";
                    if(mysqli_stmt_prepare($stmt,$query)){
                        mysqli_stmt_bind_param($stmt,'i',$chat);
                        if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_bind_result($stmt,$id_msg,$mensagem,$estado_mensagem,$sender_id);
                            while(mysqli_stmt_fetch($stmt))
                            {
                                array_push($array,$id_msg);
                                if($sender_id != $us){
                                    echo '<div class="recieve-msg">';
                                    echo '<div class="recieve-msg-content">';
                                    echo '<img src="'.$foto.'" alt="">';
                                    echo '<div class="recieve-msg-txt">';
                                    echo '<p>'.$mensagem.'</p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }else{
                                    echo '<div class="sent-msg">';
                                    echo '<div class="sent-msg-content">';
                                    echo '<div class="sent-msg-txt">';
                                    echo '<p>'.$mensagem.'</p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }
                        }
                    }
                }
            ?>             
        </div>
        <div id="chat-bottom">
            <textarea id="mensagem-texto" placeholder="escreva a sua mensagem"></textarea>
            <i class="fas fa-location-arrow" onclick='sendMessage();'></i>    
        </div>
    </div>
    

<script src="main.js"></script>

<script>

    var all_messages_array = null; //filled on load.

    function sendMessage(){
        //get variables.
        var texto_msg = $('#mensagem-texto').val();
        if(texto_msg != ''){

        
        $('#mensagem-texto').val('');
        var id_chat = <?= $chat; ?>;
        var our_id = <?= $our_id; ?>;
        
        
        var object = {
            mensagem : texto_msg,
            id : id_chat,
            sender_id : our_id,
            
        };

        var holder = $('#chat-content');

        $.post("scripts/receive_ajax.php?page=chat",object,function(data){
            holder.append(data);
            //update_chat_history_data()
        });
        }
    }

    function update_chat_history_data(){
        var id_chat = <?= $chat; ?>;
        var our_id = <?= $our_id; ?>;
        var foto = <?= '"' . $foto . '"' ;?>;
        var their_id = <?= $rec_id ?>;
        var all_ids = JSON.stringify(all_messages_array);

        var object = {
            id_chat : id_chat,
            sender_id : our_id,
            their_id : their_id,
            foto : foto,
            all_ids : all_ids,
        };

        var holder = $('#chat-content');


        $.post("scripts/receive_ajax.php?page=chat_reload",object,function(data){
            holder.append(data);
        });

        //have to fix this animation.
        
    }

    window.onload=function(){

        all_messages_array = <?php echo '["' . implode('", "',$all_ids) . '"]'; ?>;

        

        setInterval(function(){
            update_chat_history_data();
        }, 1500);

        var block_btn = document.getElementById('block-user');
        var report_btn = document.getElementById('report-user');

        var modal_block = document.getElementById('modal-block');
        var modal_block_cancel = document.getElementById('cancel-btn-modal');

        var modal_report = document.getElementById('modal-report');
        var modal_report_cancel = document.getElementById('cancel-report-modal');

        block_btn.onclick=function(){
            modal_block.style.display="block";
            $('body').toggleClass('body-overflow-modal');
        };

        modal_block_cancel.onclick=function(){
            modal_block.style.display = "none";
            $('body').toggleClass('body-overflow-modal');
        };

        report_btn.onclick=function(){
            modal_report.style.display = "block";
            $('body').toggleClass('body-overflow-modal');
        };

        modal_report_cancel.onclick=function(){
            modal_report.style.display = "none";
            $('body').toggleClass('body-overflow-modal');
        };

        window.onclick = function(event) {
            if (event.target == modal_block) {
                modal_block.style.display = "none";
                $('body').toggleClass('body-overflow-modal');
            }else if(event.target == modal_report){
                modal_report.style.display = "none";
                $('body').toggleClass('body-overflow-modal');
            }
        };

        
    }

</script>


</body>
</html>