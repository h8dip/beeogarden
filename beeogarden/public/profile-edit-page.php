<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos2.css">
    <link rel="stylesheet" href="estilos3.css">
    <link href="hamburger.css" rel="stylesheet">
    <link href="animation.css" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <title>beeogarden | Editar Perfil </title>
    <link rel="shortcut icon" href="img/favicon.png" /> 

</head>
<body style="overflow:hidden;">
<?php
    session_start();
    include_once "components/loader.php";
    require_once "connections/connection.php";
    require_once "scripts/php_scripts.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    if(isset($_SESSION['username'])){
        if(isset($_GET['id'])){
            $query = "SELECT foto_perfil, utilizador, biografia, email, ref_genero FROM utilizador WHERE id_utilizador = ?";
            if(mysqli_stmt_prepare($stmt,$query)){
                mysqli_stmt_bind_param($stmt,'i',$_GET['id']);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt,$foto_perfil,$utilizador,$biografia,$email,$ref_genero);
                    if(mysqli_stmt_fetch($stmt)){

                    }
                }
            }

            if(isset($_POST['nome'])){
                $query = "UPDATE utilizador SET utilizador = ?, biografia = ?, email = ?, ref_genero = ? WHERE id_utilizador = ?";
                if(mysqli_stmt_prepare($stmt,$query)){
                    switch($_POST['genero']){
                        case 'masculino':
                            $genero = 1;
                        break;
                        case 'feminino':
                            $genero = 2;
                        break;
                        case 'outro':
                            $genero = 3;
                        break;
                        default:
                            $genero = 1;
                        break;
                    }
                    $genero = htmlspecialchars($genero);
                    $nome_novo = htmlspecialchars($_POST['nome']);
                    $bio_novo = htmlspecialchars($_POST['bio']);
                    $email_novo = htmlspecialchars($_POST['email']);
                    mysqli_stmt_bind_param($stmt,'sssii',$_POST['nome'],$_POST['bio'],$_POST['email'],$genero,$_GET['id']);
                    if(mysqli_stmt_execute($stmt)){
                        //success
                        $_SESSION['username'] = $nome_novo;
                        header("Location: profile-page.php");
                    }
                }
            }
            if(isset($_FILES['foto-perfil']['name'])){
                $target_dir = "img/";
                $username_d = $_SESSION['username'];
                $username_d = str_replace('#','',$username_d);
                $username_d = str_replace('*','',$username_d);
                $rand = rand(1,1000000000);
                $fName = $username_d.$rand;
                $target_file = $target_dir . basename($_FILES["foto-perfil"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $target_file = $target_dir . basename($fName).'.' .$imageFileType;
                $check = getimagesize($_FILES["foto-perfil"]["tmp_name"]);
                if($check !== false){
                    $uploadOk = 1;
                }else{
                    $uploadOk = 0;
                    echo 'O teu ficheiro não é uma foto.';
                }
                do{
                    $rand = rand(1,1000000000);
                    $target_file = $target_dir . basename($fName).'.' .$imageFileType;
                }while(file_exists($target_file));
                
                if($_FILES["foto-perfil"]["size"] > 300000000){
                    $uploadOk = 0;
                    echo 'A tua foto é demasiado grande.';
                }
                
                if($uploadOk == 0){
                    echo 'Upload não realizado.';
                }else{
                    if(move_uploaded_file($_FILES["foto-perfil"]["tmp_name"],$target_file)){
                        //success
                        //delete old one
                        unlink($foto_perfil);
                        $query = "UPDATE utilizador SET foto_perfil = ? WHERE id_utilizador = ?";
                        if(mysqli_stmt_prepare($stmt,$query)){
                            mysqli_stmt_bind_param($stmt,'si',$target_file,$_GET['id']);
                            if(mysqli_stmt_execute($stmt)){
                                resize_crop_image(500,500,$target_file,$target_file);
                                header('Location: profile-page.php');
                            }
                        }
                    }
                }
            }


        }else{
            header("Location: profile-page.php");
        }
    }else{
        header("Location: login-page.php");
    }
?>
    
    <div id="profile-edit-container">
        <div id="pe-title">
            <div>
                <h1>ALTERAR PERFIL</h1>
            </div>
        </div>

        <div id="pe-edit">
            <div id="pe-edit-img">
                <form method="post" action="profile-edit-page.php?id=<?= $_GET['id']?>" enctype="multipart/form-data">
                    <input id="file-label" name="foto-perfil" type="file" onchange="this.form.submit();">
                </form>
                <label for="file-label"><i class="fas fa-pencil-alt" id="edit-photo"></i></label>
                <div>
                    <img src="<?php 
                    if($foto_perfil==""){$foto_perfil="img/default-user.png";}
                    echo $foto_perfil ?>" alt="">
                </div>
            </div>

            <div id="pe-edit-form">
                <form id="form1" action="profile-edit-page.php?id=<?= $_GET['id']?>" method="post">
                    <input type="text" name="nome" placeholder="Nome" value="<?=$utilizador?>">
                    <input type="email" name="email" placeholder="Email" value="<?=$email?>">
                    <textarea type="bio" rows="40" name="bio" placeholder="Bio" style="display:block;"><?=$biografia?></textarea>  
                    <select placeholder="Género" name="genero">
                        <option value="masculino" <?php if($ref_genero==1){echo 'selected';}?> >Masculino</option>
                        <option value="feminino"  <?php if($ref_genero==2){echo 'selected';}?> >Feminino</option>
                        <option value="outro"  <?php if($ref_genero==3){echo 'selected';}?> >Outro</option>
                    </select>
                </form>
            </div>
        </div>

        <?php include_once "components/save-btn.php"; ?>
    </div>


    <script>
        window.onload=function(){
            document.getElementById("loading-div-container").style.display ="none";
            $('html, body').css({
                'overflow': 'auto',
            }) 
        }
    </script>
    
</body>
</html>