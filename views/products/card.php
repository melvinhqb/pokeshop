<!-- views/card.php -->
<?php ob_start() ?>
<main>
    <div class="content-wrapper">
    <?php include(ROOT_PATH . '/partials/sidebar.php'); ?>
        <div class="content">
            <h1>Détails de la carte</h1>
            <div id="custom-alert" class="custom-alert-hidden">
                <div class="custom-alert-content">
                <p id="custom-alert-text"></p>
            <button type="button" class="custom-alert-closebtn" >Ok</button></div></div>
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
                                <td> <?php echo $card->set->name ?></td>
                            </tr>
                            <tr>
                                <td><p>Extension: </strong></td> 
                                <td> <?php echo $card->set->serie->name ?></td>
                            </tr>
                            <tr><td><p>Rareté: </p></td> <td> <?php echo $card->rarity ?></td></tr>
                            <tr><td><p>Type: </td> <td> <?php echo str_replace('"', '', trim($card->types, '[]')) ?></td></tr>
                            <tr><td><p>HP: </p></td> <td> <?php echo $card->hp ?></td></tr>
                            <tr><td><p>Stage: </p></td> <td> <?php echo str_replace('De','',mb_convert_case($card->stage, MB_CASE_TITLE, "UTF-8")) ?></td></tr>
                            <tr>
                                <td colspan="2">
                                <form onsubmit="addToCart(event)" id="form-addtocart">
                                    <?php 
                                        try {
                                            if (isset($_SESSION["user_id"])) { ;?>
                                                <?php if ($card->stock > 0): ?>
                                                <div class="quantity-container">
                                                    <div class="quantity-input">
                                                        
                                                        <button type="button" onclick="decreaseQuantity(this)" class="quantity-change-btn minus disabled" id="minus">-</button>
                                                        <input type="hidden" name="card_id" value="<?php echo $card->id ?>">
                                                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $card->stock ?>" step="1" >
                                                        <button type="button" onclick="increaseQuantity(this)" class="quantity-change-btn plus" id="plus">+</button>
                                                        
                                                        
                                                    </div>
                                                    <button type="submit">Add to Cart</button>
                                                    <div class="stock-error-field" id="default-alert-container">
                                                        <p class="stock-message error-message-hidden"></p>
                                                    </div>
                                                    <div id="custom-alert" class="custom-alert-hidden">
                                                        <div class="custom-alert-content">
                                                            <p id="custom-alert-text"></p>
                                                            <button type="button" class="custom-alert-closebtn" >Ok</button>
                                                        </div>
                                                    </div> 
                                                     
                                                </div>
                                                <?php else: ?>
                                                    <p>En rupture de stock</p>
                                                <?php endif; ?>
                                            <?php } else {
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
<script src="ressources/js/addToCart.js"></script>
<script src="ressources/js/quantityButtons.js"></script>