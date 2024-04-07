<!-- views/home.php -->
<?php ob_start(); ?>
<div class="banner">
    <img class="banderole" src="ressources/img/Banderole_pokeshop.jpg">
    <img class="logo_tef" src="ressources/img/LogoTEF.png">
    <p class="annonce_tef">La prochaine extension arrive bientôt !</p>
</div>
<main>
    <div class="content-wrapper">
        <?php require('partials/sidebar.php'); ?>
        <div class="content text_center">
            <p class="text_bestseller">Nos Best-Sellers</p>
            <div class="line1">
                <img class="carte_accueil" src="ressources/img/lumineon.jpg">
                <img class="carte_accueil" src="ressources/img/pikachu.jpg">
                <img class="carte_accueil" src="ressources/img/celebi.jpg">
            </div>
            <div class="line2">
                <img class="carte_accueil" src="ressources/img/dracaufeu.jpg">
                <img class="carte_accueil" src="ressources/img/zekrom.jpg">
                <img class="carte_accueil" src="ressources/img/Feunard.jpg">
            </div>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>