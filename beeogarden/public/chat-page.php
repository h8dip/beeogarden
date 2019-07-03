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
                <a href="profile-page.php"><i id="back-chat-btn" class="fas fa-arrow-left"></i></a>
                <img src="img/greta.PNG" alt="">
                <p>Universidade de Aveiro</p>
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
            <div class="recieve-msg">
                <div class="recieve-msg-content">
                    <img src="img/greta.PNG" alt="">
                    <div class="recieve-msg-txt">
                        <p>Obrigada por plantares no nosso jardim!</p>
                    </div>
                </div>
            </div>
            <div class="sent-msg">
                <div class="sent-msg-content">
                    <div class="sent-msg-txt">
                        <p>De nada !!</p>
                    </div>
                </div>
            </div>
            
            <div class="recieve-msg">
                <div class="recieve-msg-content">
                    <img src="img/greta.PNG" alt="">
                    <div class="recieve-msg-txt">
                        <p>Obrigada por plantares no nosso jardim!</p>
                    </div>
                </div>
            </div>
            <div class="sent-msg">
                <div class="sent-msg-content">
                    <div class="sent-msg-txt">
                        <p>De nada !!</p>
                    </div>
                </div>
            </div>
            
            <div class="recieve-msg">
                <div class="recieve-msg-content">
                    <img src="img/greta.PNG" alt="">
                    <div class="recieve-msg-txt">
                        <p>Obrigada por plantares no nosso jardim!</p>
                    </div>
                </div>
            </div>
            <div class="sent-msg">
                <div class="sent-msg-content">
                    <div class="sent-msg-txt">
                        <p>De nada !!</p>
                    </div>
                </div>
            </div>
            
            <div class="recieve-msg">
                <div class="recieve-msg-content">
                    <img src="img/greta.PNG" alt="">
                    <div class="recieve-msg-txt">
                        <p>Obrigada por plantares no nosso jardim!</p>
                    </div>
                </div>
            </div>
            <div class="sent-msg">
                <div class="sent-msg-content">
                    <div class="sent-msg-txt">
                        <p>De nada !!</p>
                    </div>
                </div>
            </div>
            
            <div class="recieve-msg">
                <div class="recieve-msg-content">
                    <img src="img/greta.PNG" alt="">
                    <div class="recieve-msg-txt">
                        <p>Obrigada por plantares no nosso jardim!</p>
                    </div>
                </div>
            </div>
            <div class="sent-msg">
                <div class="sent-msg-content">
                    <div class="sent-msg-txt">
                        <p>De nada !!</p>
                    </div>
                </div>
            </div>
            
            <div class="recieve-msg">
                <div class="recieve-msg-content">
                    <img src="img/greta.PNG" alt="">
                    <div class="recieve-msg-txt">
                        <p>Obrigada por plantares no nosso jardim!</p>
                    </div>
                </div>
            </div>
            <div class="sent-msg">
                <div class="sent-msg-content">
                    <div class="sent-msg-txt">
                        <p>De nada !!</p>
                    </div>
                </div>
            </div>
            
            <div class="recieve-msg">
                <div class="recieve-msg-content">
                    <img src="img/greta.PNG" alt="">
                    <div class="recieve-msg-txt">
                        <p>Obrigada por plantares no nosso jardim!</p>
                    </div>
                </div>
            </div>
            <div class="sent-msg">
                <div class="sent-msg-content">
                    <div class="sent-msg-txt">
                        <p>De nada !!</p>
                    </div>
                </div>
            </div>
            

        </div>
        <div id="chat-bottom">
            <textarea  placeholder="escreva a sua mensagem"></textarea>
            <i class="fas fa-location-arrow"></i>    
        </div>
    </div>
    

<script src="main.js"></script>

<script>

    window.onload=function(){
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