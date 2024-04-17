
<!-- views/contact.php -->
<?php $total = 0;
foreach ($cartItems as $item) {
    $total += $item['card']->price * $item['quantity'];
} 
$_SESSION['cart_total'] = $total;
ob_start(); ?>

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
                    <td><img class='card_image' src='<?php echo $item['card']->image; ?>/low.png' alt='<?php echo $item['card']->name; ?>'></td>
                    <td><a class='card-link' href='index.php?route=products&card=<?php echo $item['card']->id; ?>'><?php echo $item['card']->name; ?></a></td>
                    <td><?php echo number_format($item['card']->price, 2, ',', '.'); ?> €</td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>
                        <form onsubmit="deleteToCart(event)">
                            <input type="hidden" name="action" value="deleteFromCart">
                            <input type="hidden" name="card_id" value="<?php echo $item['card']->id ?>">
                            <button type="submit">Tout retirer</button>
                        </form>
                        <form onsubmit="modifyToCart(event)">
                            <input type="hidden" name="action" value="deleteFromCart">
                            <input type="number" name="card_id" value="<?php echo $item['card']->id ?>">
                            <button type="sub">modifier</button>
                        </form>
                    </td>
                </tr>
                
   


            <?php endforeach; ?>
            </table>
            <div class="cart-container">
    <div class="cart-total">
        <h2>Montant Total</h2>
        <p class="total-price"><?php echo number_format($total, 2, ',', '.'); ?> €</p>
        <a href="index.php?route=payment" class="proceed-to-payment">Procéder au paiement</a>
    </div>
</div>
            
            
            <?php echo "<pre>"; print_r($cartItems); echo"</pre>";?>
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
                }
            } else {
                // Gérer l'erreur
                alert('Error: ' + xhr.statusText);
            }
        };
        xhr.onerror = function () {
            // Gérer l'erreur de connexion
            alert('Network Error');
        };
        xhr.send(formData);
    }

</script>