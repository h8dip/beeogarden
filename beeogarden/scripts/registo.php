<?php

require_once "../connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "INSERT INTO utilizador (utilizador, email, password_hash) VALUES (?,?,?)";

if (mysqli_stmt_prepare($stmt, $query)) {
    
    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $password_hash);
     
    var_dump($_POST['username']);

    $username = $_POST['username']; 
    $email = $_POST['email'];
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);

    header("Location: login.php");
} else {
    mysqli_close($link);
}