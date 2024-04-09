<!-- views/home.php -->
<?php ob_start(); ?>
<main>
    <div class="content-wrapper">
        <div class="content">
            <br><br><br><br><br><br><br><br><br>
            <p class="text_notfound" style>Page n'existe pas</p>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>