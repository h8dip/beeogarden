<?php
require_once "../connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$first_query = "SELECT COUNT(*) FROM utilizador WHERE utilizador LIKE ?";
mysqli_stmt_prepare($stmt,$first_query);
mysqli_stmt_bind_param($stmt,'s',$_POST['username']);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,$conta_users);
mysqli_stmt_fetch($stmt);
$second_query = "SELECT COUNT(*) FROM utilizador WHERE email LIKE ?";
mysqli_stmt_prepare($stmt,$second_query);
mysqli_stmt_bind_param($stmt,'s',$_POST['email']);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,$conta_email);
mysqli_stmt_fetch($stmt);

if(($conta_users != 0) or ($conta_email != 0)){
    header('Location: ../register-page.php?err=3');
}else{

$query = "INSERT INTO utilizador (utilizador, email, password_hash,entidade) VALUES (?,?,?,?)";

if((isset($_POST['username'])) and (isset($_POST['email'])) and (isset($_POST['password'])) and (isset($_POST['entidade']))){

if (mysqli_stmt_prepare($stmt, $query)) {
    
    mysqli_stmt_bind_param($stmt, 'ssss', $username, $email, $password_hash,$entidade);
     
    //var_dump($_POST['username']);

    

    if( ($_POST['username']=="") or ($_POST['email']=="") or ($_POST['password']=="") or ($_POST['entidade']=="")){
        //variaveis vazias
        header("Location: ../register-page.php?err=2");
    }else{



        $username = htmlspecialchars($_POST['username']); 
        $email = htmlspecialchars($_POST['email']);
        $password_hash = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
        $entidade = htmlspecialchars($_POST['entidade']);

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        header("Location: ../login-page.php");
    }

    

    
} else {
    mysqli_close($link);
}
}
else{
    //variaveis nao defenidas!
    header("Location: ../register-page.php?err=1");
}
}