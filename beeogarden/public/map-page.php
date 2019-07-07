<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estilos2.css">
    <link rel="stylesheet" href="animation.css">
    <link href="hamburger.css" rel="stylesheet">
    <script src="main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <title>beeogarden | Mapa</title>
    <style>
      #map {
        height: 90%;
      }

      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>


</head>

<body style="overflow-x: hidden; overflow:hidden;">
    <div id="navbar-container-map" class="container-main">

        <?php
        $current_page='map';
        include_once "components/loader.php";
        include_once "components/navbar.php";

        session_start();

        require_once "connections/connection.php";
                
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $array_coordenadas = array();
        $array_nomes = array();
        $reached_end = false;

        if(!isset($_SESSION['username'])){
          header('Location: login-page.php');
        }else{
          $query = 'SELECT coordenadas, nome_espaco FROM espaco WHERE privacidade LIKE ?';
          if(mysqli_stmt_prepare($stmt,$query)){
            $condition = "Publico";
            mysqli_stmt_bind_param($stmt,'s',$condition);
            if(mysqli_stmt_execute($stmt)){
              mysqli_stmt_bind_result($stmt,$coord,$nome);
              while(mysqli_stmt_fetch($stmt)){
                array_push($array_coordenadas,$coord);
                array_push($array_nomes,$nome);
                $reached_end = true;
              }
            }
          }
          if($reached_end){
            //json encode;
            //$myjson = json_encode($array_coordenadas);
          }

        }

        include_once "components/navbar-mobile.php";
        ?> 

      <script>
          $('#hamburger').click(function(){
              $('#hamburger').toggleClass("is-active");
              $('#mobile-navbar').toggleClass("grid-class");
              $('#ham-phone').toggleClass("z-index-6");
              $('body').toggleClass("overflow-hid");
              $('.container-main').toggleClass("overflow-hid");
          });
      </script>

    </div>
    <div id="map"></div>    


    <script>
        window.onload=function(){
            document.getElementById("loading-div-container").style.display ="none";
            $('html, body').css({
                'overflow': 'auto',
            }) 
        }
    </script>

    <script>
      var map;
      function initMap() {

         // Create a new StyledMapType object, passing it an array of styles,
        // and the name to be displayed on the map type control.
        var styledMapType = new google.maps.StyledMapType(
            [
            {elementType: 'geometry', stylers: [{color: '#212121'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#212121'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#757575'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#bdbdbd'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#757575'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#181818'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#616161'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#fbc02d'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#212a37'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#8a8a8a'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#3c3c3c'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#f3d19c'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#515c6d'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'road.arterial',
              elementType: 'geometry',
              stylers:[{color: '#373737'}]
            },
            {
              featureType: 'road.local',
              elementType: 'geometry.fill',
              stylers:[{color: '#fbc02d'},{weight: '1.0'}]
            }
          ],
          {name: 'Styled Map'});

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                map.setCenter(initialLocation);
            });
         }

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          disableDefaultUI: true
          });

        var coordenadas_array = <?php echo '["' . implode('", "',$array_coordenadas) . '"]' ?>;
        var coordenadas_nome = <?php echo '["' . implode('", "',$array_nomes) . '"]' ?>;

        for(var i = 0; i < coordenadas_array.length ; i++){
          $temp = coordenadas_array[i].split(',');
          
          var myLatLng = { lat: parseFloat($temp[0]), lng: parseFloat($temp[1]) };
          var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: coordenadas_nome[i],
            icon: 'img/map-icon.png'
          });
        }
        
        
        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');
      }
    </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHidfksxt61FmywDBiYGiGDNkHwnRG29k&callback=initMap"
    async defer></script>

    <div id="marker-info">
        <div></div>

        <div id="marker-info-details">
            <div id="marker-details-title">
                <div id="marker-details-img-container">
                  <img src="img/greta.PNG" alt="">
                </div>
                <h2>UNIVERSIDADE DE AVEIRO</h2>
            </div>

            <div id="marker-details-address">
              <div>
                <p>Universidade de Aveiro</p>
                <p>Campus Universitário de Santiago</p>
                <p>3810-193 Aveiro</p>
                <p>Portugal</p>
              </div>
              <div>
                <img src="img/beeopoints.png" alt="">
                <h2>1298</h2>
              </div>
            </div>

            <div id="marker-plant-btn">
              <a href="#"><h2>Quero plantar aqui!</h2></a>
            </div>
        </div>
    </div>
</body>