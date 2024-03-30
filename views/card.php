<!-- views/card.php -->
<?php ob_start() ?>
<?php require('partials/sidebar.php') ?>
<div class="content">
    <h1>Détails de la carte Pokémon</h1>
    <img src='<?php echo $card->image ?>/high.png' alt='<?php echo $card->name?>'>
    <p><strong>Nom:</strong> <?php echo $card->name ?></p>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
