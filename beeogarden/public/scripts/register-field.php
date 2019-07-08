<?php
  session_start();

  require_once "php_scripts.php";
  require_once "../connections/connection.php";

  if(verifyLogin()){

    //verifyEmpty.
    $ctr_empty_fields = 0;
    foreach($_POST as $i => $stuff) {
      if(empty($stuff) or $stuff==''){
        $ctr_empty_fields++;
      }
    }

    if($ctr_empty_fields >= 1){
      header('Location: ../profile-page.php?error=empty-field');
    }else{

      if(isset($_POST['morada'])){
        //prepare 
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        
        $username = $_SESSION['username'];
        $query = "SELECT id_utilizador FROM utilizador WHERE utilizador LIKE ?";
        if(mysqli_stmt_prepare($stmt,$query)){
          mysqli_stmt_bind_param($stmt,'s',$username);
          if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt,$id_user);
            mysqli_stmt_fetch($stmt);
          }
        }

        $query = "INSERT INTO espaco (nome_espaco,morada,codigo_postal,localidade,slots,ref_Utilizador,coordenadas,privacidade) VALUES (?,?,?,?,?,?,?,?)";
        if(mysqli_stmt_prepare($stmt,$query)){
          $nome_espaco = htmlspecialchars($_POST['nome_do_espaco']);
          $morada = htmlspecialchars($_POST['morada']);
          $cod_postal = htmlspecialchars($_POST['codpostal']);
          $localidade = htmlspecialchars($_POST['localidade']);
          $slots = htmlspecialchars($_POST['lotes']);
          //id_user
          $string = $morada . ' ' . $localidade . ' ' . $cod_postal;
          $coordenadas = retrieveCoordinates($string);
          if($coordenadas=="erro"){
            $coordenadas='';
          }
          $privacidade = htmlspecialchars($_POST['acesso']);
          mysqli_stmt_bind_param($stmt,'ssssiiss',$nome_espaco,$morada,$cod_postal,$localidade,$slots,$id_user,$coordenadas,$privacidade);
          if(mysqli_stmt_execute($stmt)){
            header('Location: ../profile-page.php');
          }
        }
      }
    }
  }else{
    header('Location: ../login-page.php');
  }  

  function retrieveCoordinates($address_post){
    $Address = urlencode($address_post);
    $request_url = "https://maps.googleapis.com/maps/api/geocode/xml?address=".$Address."&sensor=true&key=AIzaSyDHidfksxt61FmywDBiYGiGDNkHwnRG29k";
    $xml = simplexml_load_file($request_url) or die("url not loading");
    $status = $xml->status;
    if ($status=="OK") {
        $Lat = $xml->result->geometry->location->lat;
        $Lon = $xml->result->geometry->location->lng;
        $LatLng = "$Lat,$Lon";
        return $LatLng;
    }else{
      return "erro";
    }
  }
  
?>