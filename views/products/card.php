<!-- views/card.php -->
<?php ob_start() ?>
<main>
    <div class="content-wrapper">
    <?php include(ROOT_PATH . '/partials/sidebar.php'); ?>
        <div class="content">
            <h1>Détails de la carte Pokémon</h1>
            <img src='<?php echo $card->image ?>/high.png' alt='<?php echo $card->name?>'>
            <p><strong>Nom:</strong> <?php echo $card->name ?></p>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require_once(ROOT_PATH . '/layout.php'); ?>
