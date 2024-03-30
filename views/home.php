<!-- views/home.php -->
<?php ob_start(); ?>
<?php require('partials/sidebar.php'); ?>
<div class="content">
    <img src="ressources/img/celebi.jpg">
    <img src="ressources/img/pikachu.jpg">
    <img src="ressources/img/lumineon.jpg">
    <img src="ressources/img/Feunard.jpg">
    <img src="ressources/img/dracaufeu.jpg">
    <img src="ressources/img/zekrom.png">
</div>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>