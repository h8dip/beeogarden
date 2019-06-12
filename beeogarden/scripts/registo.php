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
    header('Location: ../login.php?err=3');
}else{

$query = "INSERT INTO utilizador (utilizador, email, password_hash) VALUES (?,?,?)";

if((isset($_POST['username'])) and (isset($_POST['email'])) and (isset($_POST['password']))){

if (mysqli_stmt_prepare($stmt, $query)) {
    
    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $password_hash);
     
    //var_dump($_POST['username']);

    

    if( ($_POST['username']=="") or ($_POST['email']=="") or ($_POST['password']=="") ){
        //variaveis vazias
        header("Location: ../login.php?err=2");
    }else{



        $username = htmlspecialchars($_POST['username']); 
        $email = htmlspecialchars($_POST['email']);
        $password_hash = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        header("Location: ../login.php");
    }

    

    
} else {
    mysqli_close($link);
}
}
else{
    //variaveis nao defenidas!
    header("Location: ../login.php?err=1");
}
}