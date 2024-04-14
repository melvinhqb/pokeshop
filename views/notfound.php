<!-- views/home.php -->
<?php ob_start(); ?>
<main>
    <div class="content-wrapper">
        <div class="content">
            <br><br><br><br><br><br><br><br><br>
            <p class="text_notfound"><?php echo $errorMessage; ?></p>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require_once(ROOT_PATH . '/layout.php'); ?>