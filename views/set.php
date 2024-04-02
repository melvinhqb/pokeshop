<!-- views/set.php -->
<?php ob_start(); ?>
<main>
    <div class="content-wrapper">
        <?php require('partials/sidebar.php'); ?>
        <div class="content">
            <h1>Extension <?php echo $set->name; ?></h1>
            <?php if (!empty($cards)): ?>
                <div>
                    <!-- Ajouter bouton filtre qui exécute un JS qui filtre en fonnction de la colonne rareté, prix et type -->
                    <table border='1'>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Rareté</th>
                            <th>Prix</th>
                        </tr>
                        <?php foreach ($cards as $card): ?>
                            <tr>
                                <td><img class='card_image' src='<?php echo $card->image; ?>/low.png' alt='<?php echo $card->name; ?>'></td>
                                <td><a class='card-link' href='index.php?route=products&card=<?php echo $card->id; ?>'><?php echo $card->name; ?></a></td>
                                <td><?php echo $card->rarity; ?></td>
                                <td><?php echo number_format($card->price, 2, ',', '.'); ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php else: ?>
                Aucune carte associée à cet ensemble.
            <?php endif; ?>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>

<script src="ressources/js/imageZoomModal.js"></script>
