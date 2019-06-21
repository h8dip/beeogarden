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
        <a href="#" id="nav-mapa">Mapa</a>
        <a href="info-page.php" id="nav-info"<?php if($current_page == 'info'){echo 'class="nav-active"';}?>>Info</a>
        <a href="#" id="nav-definicoes">Definições</a>
        <a href="welcome-page.php" id="nav-sair">Sair</a>
    </div>
    <div id="shopping-cart">
        <a href="cart.php"><i class="fas fa-shopping-cart fa-2x"></i></a>
    </div>
</nav>
