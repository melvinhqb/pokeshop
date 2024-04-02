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
        <div class="content">
            <img src="ressources/img/celebi.jpg">
            <img src="ressources/img/pikachu.jpg">
            <img src="ressources/img/lumineon.jpg">
            <img src="ressources/img/Feunard.jpg">
            <img src="ressources/img/dracaufeu.jpg">
            <img src="ressources/img/zekrom.png">
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>