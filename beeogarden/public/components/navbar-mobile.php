<div id="mobile-navbar">
        <div id="mobile-nav-content">
            <div></div>
            <div id="mobile-nav-img-profile">
                <div id="mobile-nav-img-container">
                <?php
                    require_once "connections/connection.php"; 
                    require_once "scripts/php_scripts.php";


                    loadMobileNavBar(getUserId());

                ?>
                    
            </div>
            <div class="mobile-nav-item"><a href="profile-page.php"><h3>PERFIL</h3></a></div>
            <div class="mobile-nav-item"><a href="store-page.php"><h3>LOJA</h3></a></div>
            <div class="mobile-nav-item"><a href="info-page.php"><h3>INFO</h3></a></div>
            <div class="mobile-nav-item"><a href="ranking.php"><h3>RANKING</h3></a></div>
            <div class="mobile-nav-item"><a href="map-page.php"><h3>MAPA</h3></a></div>
            <div class="mobile-nav-last-item"><a href="scripts/logout.php"><h3>SAIR</h3></a></div>
            <div></div>
            <div id="registo-beeogarden-btn"><a href="field-registration-page.php" id="nav-register-btn"><h3>Registar beeogarden</h3></a></div>
        </div>
        <div id="nav-mob-cls"></div>
    </div>