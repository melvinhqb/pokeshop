
<!-- views/contact.php -->

<?php ob_start(); ?>
<main>
    <div class="content-wrapper">
        <div class="content">
            <h1>Panier</h1>
            
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
                                            <input type="hidden" name="total" value="<?php echo $total?>">
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
        <p class="total-price"><span id="totalPrice">
        <?php 
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['card']->price * $item['quantity'];
        } 
        $_SESSION['cart_total'] = $total;
        echo number_format($total, 2, ',', '.'); ?> €</span></p>
        <a href="index.php?route=payment" class="proceed-to-payment">Procéder au paiement</a>
    </div>

</div>    
        </div>
    </div>
            
</main>
<?php $content = ob_get_clean(); ?>

<?php require_once(ROOT_PATH . '/layout.php'); ?>

<script>
    function deleteToCart(event) {
        // Empêcher le formulaire de se soumettre normalement
        event.preventDefault();

        // Récupérer le formulaire soumis
        var form = event.target;

        // Récupérer les données du formulaire
        var formData = new FormData(form);

        // Envoyer les données du formulaire via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?route=cart', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Gérer la réponse réussie
                // Identifier la ligne du tableau correspondant à la carte supprimée
                var cardId = formData.get('card_id');
                var tableRow = document.getElementById('row_' + cardId);

                // Supprimer la ligne du tableau
                if (tableRow) {
                    tableRow.parentNode.removeChild(tableRow);
                    showCustomAlert("la carte a bien été supprimée");
                }

                setTimeout(function(){ //
                    location.reload(); //a changer si jamais compris reload que la partie pagner
                }, 1000); //
                
            } else {
                // Gérer l'erreur
                showCustomAlert('Error: ' + xhr.statusText);
            }
        };
        xhr.onerror = function () {
            // Gérer l'erreur de connexion
            showCustomAlert('Network Error');
        };
        xhr.send(formData);
    }

    function modifyCart(event) {
        // Empêcher le formulaire de se soumettre normalement
        event.preventDefault();

        // Récupérer le formulaire soumis
        var form = event.target;

        // Récupérer les données du formulaire
        var formData = new FormData(form);

        // Envoyer les données du formulaire via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?route=cart', true);  // Notez le changement de l'URL pour la mise à jour
        // Inside the modifyCart function
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Gérer la réponse réussie
                // Mettre à jour l'interface utilisateur pour refléter les modifications
                var cardId = formData.get('card_id');
                var newQuantity = formData.get('quantity');
                var tableRow = document.getElementById('row_' + cardId);
                var quantityElement = document.getElementById('quantity_' + cardId);
                if (quantityElement) {
                    quantityElement.value = newQuantity; // Mise à jour de l'élément de quantité
                }
                location.reload(); //a changer si jamais compris reload que la partie pagner
            } else {
                // Gérer l'erreur
                showCustomAlert('Error: ' + xhr.statusText);
            }
        };

        xhr.onerror = function () {
            // Gérer l'erreur de connexion
            showCustomAlert('Network Error');
        };
        xhr.send(formData);
}
</script>



<script src="ressources/js/addToCart.js"></script>
<script src="ressources/js/imageZoomModal.js"></script>
<script src="ressources/js/quantityButtons.js"></script>
<style>
    .delete-btn{
    grid-column: span 2;
    grid-template-columns: 400px;
}
</style>