<!-- views/partials/header.php -->
<header class="header">
    <nav class="navbar content-wrapper">
        <a href="index.php"><img class="navbar_logo" src="ressources/img/logo.png"></a>
        <div class="navbar_content">
            <ul class="navbar_menu">
                <li class="navbar_item"><a class="nav_link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' && (!isset($_GET['route']) || $_GET['route'] == 'home')) ? 'active' : ''; ?>" href="index.php">Accueil</a></li>
                <li class="navbar_item"><a class="nav_link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' && isset($_GET['route']) && $_GET['route'] == 'products') ? 'active' : ''; ?>" href="index.php?route=products">Produits</a></li>
                <li class="navbar_item"><a class="nav_link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' && isset($_GET['route']) && $_GET['route'] == 'contact') ? 'active' : ''; ?>" href="index.php?route=contact">Contact</a></li>
            </ul>
            <div class="navbar_end">
                <a class="nav_link" href="index.php?route=login">Login</a>
            </div>
        </div>
    </nav>
</header>
