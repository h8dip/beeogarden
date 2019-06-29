<nav>
    <div id="ham-phone">
    <button id="hamburger" class="hamburger hamburger--elastic" type="button">
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
    </button> 
    </div>
    <div id="logo-store">
        <img src="img/logo_beeogarden-8.png" alt="">
    </div>
    <div id="nav-lg">
        <a href="profile-page.php" id="nav-perfil"<?php if($current_page == 'profile'){echo 'class="nav-active"';}?>>Perfil</a>
        <a href="store-page.php" id="nav-loja" <?php if($current_page == 'store'){echo 'class="nav-active"';}?>>Loja</a>
        <a href="ranking.php" id="nav-ranking" <?php if($current_page == 'ranking'){echo 'class="nav-active"';}?>>Ranking</a>
        <a href="map-page.php" id="nav-mapa" <?php if($current_page == 'map'){echo 'class="nav-active"';}?>>Mapa</a>
        <a href="info-page.php" id="nav-info"<?php if($current_page == 'info'){echo 'class="nav-active"';}?>>Info</a>
        <a href="field-registration-page.php" id="nav-register">Registar</a>
        <a href="scripts/logout.php" id="nav-sair">Sair</a>
    </div>
    <div id="shopping-cart">
        <div id="cart-counter">0</div>
        <a href="cart.php"><i class="fas fa-shopping-cart fa-2x"></i></a>
    </div>
</nav>
