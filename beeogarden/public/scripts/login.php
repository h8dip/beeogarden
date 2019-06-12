<?php 
  require_once "../connections/connection.php";
  session_start();

  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);
  $query = "SELECT ref_roles, password_hash, utilizador FROM utilizador WHERE email LIKE ?";

  if(mysqli_stmt_prepare($stmt, $query)){
    mysqli_stmt_bind_param($stmt, 's',$email);
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt,$perfil,$password_hash,$username);
        if(mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $password_hash)) {
                $_SESSION['role'] = $perfil;
                $_SESSION['username'] = $username;

              mysqli_stmt_close($stmt);
              mysqli_close($link);
              header('Location: ../profile-page.php');
        } 
        else{
          //wrong password
          mysqli_stmt_close($stmt);
          mysqli_close($link);
          header('Location: ../login-page.php');
        }
    }
    else{
      //wrong username / fetch
      mysqli_stmt_close($stmt);
      mysqli_close($link);
      header('Location: ../login-page.php');
    }
}else{
    //connection error / execute error
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    header('Location: ../login-page.php');
}
}
?>