<?php ob_start(); ?>
<main>
    <div class="content-wrapper">
        <div class="content">
            <h1>Panier</h1>
            <!-- Afficher un tableau de carte,
            s'inspirer du fichier set.php -->
            <table id="tableContainer" border='1'>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Supprimer</th>
                </tr>
            <!-- Your table and card listing -->
            <?php foreach ($cartItems as $item): ?>
                <!-- Each card row in the table -->
                <tr id="<?php echo "row_" . $item['card']->id ;?>">
                    <!-- Card details -->
                    <td><img class='card_image' src='<?php echo $item['card']->image; ?>/high.png' alt='<?php echo $item['card']->name; ?>'></td>
                    <td><a class='card-link' href='index.php?route=products&card=<?php echo $item['card']->id; ?>'><?php echo $item['card']->name; ?></a></td>
                    <td><span id="price_<?php echo $item['card']->id; ?>"><?php echo number_format($item['card']->price, 2, ',', '.'); ?> €</span></td>
                    <td><output id="quantity_<?php echo $item['card']->id; ?>" name="quantity" ><?php echo $item['quantity']; ?></output></td>
                    <td>
                        <form onsubmit="deleteToCart(event)">
                                <input type="hidden" name="action" value="deleteFromCart">
                                <input type="hidden" name="card_id" value="<?php echo $item['card']->id ?>">
                            <div class= "quantity-container" >    
                                <button type="submit" class="delete-btn">Tout retirer</button>
                            </div>
                        </form>
                        <form onsubmit="modifyCart(event)">
                        <?php 
                            try {
                                if ($_SESSION) { ;?>
                                    
                                    <div class="quantity-container">
                                        <div class="quantity-input">
                                            
                                            <button type="button" onclick="decreaseQuantity(this)" class="quantity-change-btn minus disabled" id="minus">-</button>
                                            <input type="hidden" name="action" value="modifyCart">
                                            <input type="hidden" name="card_id" value="<?php echo $item['card']->id ?>">
                                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $item['card']->stock ?>" step="1" oninput="quantity_<?php echo $item['card']->id; ?>.value = quantity.value" >
                                            <button type="button" onclick="increaseQuantity(this)" class="quantity-change-btn plus" id="plus">+</button>
                                        </div>
                                        <button type="submit">Modifier</button>
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
            <?php endforeach; ?>
            </table>
            <div class="cart-container">
    <div class="cart-total">
        <h2>Montant Total</h2>
        <span class="total-price" id="totalPrice">
        <?php echo number_format($total, 2); ?> €</span>
        <a href="index.php?route=payment" class="proceed-to-payment">Procéder au paiement</a>
    </div>

</div>    
        </div>
    </div>
            
</main>
<?php $content = ob_get_clean(); ?>

<?php require_once(ROOT_PATH . '/layout.php'); ?>

<script src="ressources/js/addToCart.js"></script>
<script src="ressources/js/imageZoomModal.js"></script>
<script src="ressources/js/quantityButtons.js"></script>
<script src="ressources/js/updateCart.js"></script>
