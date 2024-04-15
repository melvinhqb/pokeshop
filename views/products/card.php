<!-- views/card.php -->
<?php ob_start() ?>
<main>
    <div class="content-wrapper">
    <?php include(ROOT_PATH . '/partials/sidebar.php'); ?>
        <div class="content">
            <h1>Détails de la carte</h1>
            <div class="card-wrapper">
                <div class="card-media-wrapper">
                    <img class="card_image" src='<?php echo $card->image ?>/high.png' alt='<?php echo $card->name?>'>
                </div>
                <div class="card-details-wrapper">
                    <div class="card-details-title">
                        <h1><?php echo $card->name ?></h1>
                        <p><?php echo number_format($card->price, 2, ',', '.'); ?>€</p>
                    </div>
                    <div class="card-details-info">
                        <h3>Description: </h3>
                        <table border='1'>
                            
                            <tr><td><p>Numéro de la carte: </p></td> <td><?php echo $card->localId ?></td></tr>
                            <tr>
                                <td><p>Série: </p></td> 
                                <td> <?php echo ($card->getSet())->name ?></td>
                            </tr>
                            <tr>
                                <td><p>Extension: </strong></td> 
                                <td> <?php echo (($card->getSet())->getSerie())->name ?></td>
                            </tr>
                            <tr><td><p>Type: </td> <td> <?php echo str_replace('"', '', trim($card->types, '[]')) ?></td></tr>
                            <tr><td><p>Rareté: </p></td> <td> <?php echo $card->rarity ?></td></tr>
                            <tr><td><p>HP: </p></td> <td> <?php echo $card->hp ?></td></tr>
                            <tr><td><p>Stage: </p></td> <td> <?php echo str_replace('De','',mb_convert_case($card->stage, MB_CASE_TITLE, "UTF-8")) ?></td></tr>
                            <tr rowspan=2><td><p>Prix: </p></td><td><?php echo number_format($card->price, 2, ',', '.'); ?>€</td>
                            <tr>
                                <td colspan="2">
                                <form onsubmit="addToCart(event)">
                                    <?php 
                                        try {
                                            if ($_SESSION) {
                                                // Utiliser la concaténation pour inclure $card->id
                                                echo '<input type="hidden" name="card_id" value="' . $card->id . '">
                                                    <input type="number" name="quantity" value="1" min="0" step="1">
                                                    <button type="submit">Add to Cart</button>';
                                            } else {
                                                echo 'Veuillez vous connecter pour acheter';
                                            }
                                        } catch (Exception $e) {
                                            echo "Caught exception: " . $e->getMessage();
                                        }
                                        ?>
                                </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require_once(ROOT_PATH . '/layout.php'); ?>
<script src="ressources/js/imageZoomModal.js"></script>