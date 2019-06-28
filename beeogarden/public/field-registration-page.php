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
    <link href="hamburger.css" rel="stylesheet">
    <link href="animation.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <title>beeogarden | Registo Beeogarden</title>
    <link rel="shortcut icon" href="img/favicon.png" /> 

</head>
<body>

    <div id="modal-register-tutorial" class="modal-tutorial">
        <div class="modal-tutorial-content">
            <div id="register-tutorial-img">
                <img src="img/produto-2.jpg" id="reg-tut-img-1">
                <img src="img/produto-1.jpg" id="reg-tut-img-2">
                <img src="img/produto-4.jpg" id="reg-tut-img-3">
            </div>
            <div id="register-tutorial-text">
                <p id="reg-tut-text-1">Tens um espaço disponível para plantar e queres ajudar quem não tem?</p>
                <p id="reg-tut-text-2">Regista o teu espaço e divide em lotes de 1m. Indica quantos lotes tens disponíveis.</p>
                <p id="reg-tut-text-3">Quando já não tiveres indica que o teu beeogarden está cheio no seu perfil.</p>
            </div>
            <div id="register-tutorial-dots">
                <i class="far fa-circle" id="circle-1"></i>
                <i class="far fa-circle" id="circle-2"></i>
                <i class="far fa-circle" id="circle-3"></i>
            
            </div>
        </div>  
    </div>

    <div id="modal-register-done" class="modal-tutorial">
        <div id="modal-done-content">
            <div id="register-done-icon">
                <i class="fas fa-check"></i>
            </div>
            <div id="register-done-text">
                <p id="reg-done-text">Obrigado pelo registo! Em breve entraremos em contacto com a confirmação do espaço.</p>
            </div>
        </div>
    </div>

    <div id="field-regist-container">
    
        <div id="fr-title">
            <div>
                <h1>REGISTA O TEU BEEOGARDEN</h1>
            </div>
        </div>

        <div id="register-content">
            <div id="fr-form">
                <form action="register-field.php">
                    <input type="text" name="morada" placeholder="Morada">
                    <div id="zip-localidade">
                        <input type="text" name="codpostal" placeholder="Cód.Postal">
                        <input type="text" name="localidade" placeholder="Localidade">
                    </div>
                    <input type="number" name="lotes" placeholder="Número de Lotes"> 
                
                    <select placeholder="Acessibilidade" name="acesso">
                        <option value="volvo">Público</option>
                        <option value="saab">Privado</option>
                    </select>
                </form>
            </div>
        </div>

        <div id="warning-register">
            <p id="public-warning"><span id="ast">*</span>Ao selecionar “Público”, a localização do seu beeogarden irá ser apresentada no Mapa e acessível a todos os utilizadores da aplicação.</p>
        </div>


        <?php include_once "components/save-btn.php" ?>
    </div>


    
    <script src="main.js"></script>

    <script>
        
        window.onload = function(){
            var modal_reg = document.getElementById('modal-register-tutorial');
            var img1 = document.getElementById('reg-tut-img-1');
            var img2 = document.getElementById('reg-tut-img-2');
            var img3 = document.getElementById('reg-tut-img-3');
            var text1 = document.getElementById('reg-tut-text-1');
            var text2 = document.getElementById('reg-tut-text-2');
            var text3 = document.getElementById('reg-tut-text-3');
            var dot1 = document.getElementById('circle-1');
            var dot2 = document.getElementById('circle-2');
            var dot3 = document.getElementById('circle-3');
            var modal_count = 1;   

            modal_reg.style.display= 'block';
            img1.style.display = 'block';
            text1.style.display='block';
            dot1.classList.remove("far");
            dot1.classList.add("fas");
            $('body').toggleClass('body-overflow-modal');
       

        modal_reg.onclick = function (){
            if(modal_count == 1){
                img1.style.display='none';
                text1.style.display='none';
                dot1.classList.remove("fas");
                dot1.classList.add("far");

                img2.style.display='block';
                text2.style.display= 'block';
                dot2.classList.remove("far");
                dot2.classList.add("fas");

                modal_count =2;
            }else if(modal_count == 2){
                img2.style.display='none';
                text2.style.display='none';
                dot2.classList.remove("fas");
                dot2.classList.add("far");

                img3.style.display='block';
                text3.style.display='block';
                dot3.classList.remove("far");
                dot3.classList.add("fas");

                modal_count = 3;
            }else if(modal_count == 3){
                modal_reg.style.display = "none";
                $('body').toggleClass('body-overflow-modal');
            }

        }

        dot1.onclick = function(){
            img1.style.display = 'block';
            text1.style.display='block';
            dot1.classList.remove("far");
            dot1.classList.add("fas");
            
            img2.style.display = 'none';
            img3.style.display = 'none';
            text2.style.display = 'none';
            text3.style.display = 'none';
            dot2.classList.remove("fas");
            dot2.classList.add("far");
            dot3.classList.remove("fas");
            dot3.classList.add("far");
        }

        dot2.onclick = function(){
            img2.style.display = 'block';
            text2.style.display='block';
            dot2.classList.remove("far");
            dot2.classList.add("fas");
            
            img1.style.display = 'none';
            img3.style.display = 'none';
            text1.style.display = 'none';
            text3.style.display = 'none';
            dot1.classList.remove("fas");
            dot1.classList.add("far");
            dot3.classList.remove("fas");
            dot3.classList.add("far");
        }

        dot3.onclick = function(){
            img3.style.display = 'block';
            text3.style.display='block';
            dot3.classList.remove("far");
            dot3.classList.add("fas");
            
            img2.style.display = 'none';
            img1.style.display = 'none';
            text2.style.display = 'none';
            text1.style.display = 'none';
            dot2.classList.remove("fas");
            dot2.classList.add("far");
            dot1.classList.remove("fas");
            dot1.classList.add("far");
        }

        var submit_trigger= document.getElementById('register-beeogarden-btn');
        var modal_done = document.getElementById('modal-register-done');

        submit_trigger.onclick=function(){
            modal_done.style.display="block";
        }

        window.onclick = function(event) {
            if (event.target == modal_reg) {
                modal_reg.style.display = "none";
                $('body').toggleClass('body-overflow-modal');
            };
            if(event.target == modal_done){
                modal_done.style.display = "none";
                $('body').toggleClass('body-overflow-modal');
                window.location='profile-page.php';
            };
            
        };

    };

    </script>

</body>
</html>