<!-- views/set.php -->
<?php ob_start(); ?>

<main>
    <div class="content-wrapper">
        <?php require('partials/sidebar.php'); ?>
        <div class="content">
            <h1>Extension <?php echo $set->name; ?></h1>
            <?php if (!empty($cards)): ?>
                <div>
                    <div class="filter-bar">
                        <span class="filter-caption">FILTER BY:</span>
                        <div class=filter-options>
                            <div class="filter-option" id="rarete" onclick="toggleFilter('rarete')">
                                <span class="filter-name">Rareté</span>
                                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7.406 9.375L12 13.967l4.594-4.592 1.416 1.416L12 16.798l-6.016-6.017z"/></svg>

                            </div>


                            <div class="filter-option" id="type" onclick="toggleFilter('type')">
                                <span class="filter-name">Type</span>
                                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7.406 9.375L12 13.967l4.594-4.592 1.416 1.416L12 16.798l-6.016-6.017z"/></svg>


                            </div>


                            <div class="filter-option" id="prix" onclick="toggleFilter('prix')">
                                <span class="filter-name">Price</span>
                                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7.406 9.375L12 13.967l4.594-4.592 1.416 1.416L12 16.798l-6.016-6.017z"/></svg>


                            </div>
                        </div>

                        <div class="view-toggle">
                            <button type="button" id="grid-view">Grid View</button>
                            <button type="button" id="table-view">Table View</button>
                        </div>

                    </div>
                    <div class=filter-contents>
                        <div class="filter-content hidden" id="rarete-options">

                            <div class="select-items select-hide">
                                <div>Tous</div>
                                <div>Commun</div>
                                <div>Uncommun</div>
                                <div>Spécial</div>
                            </div>
                        </div>
                        <div class="filter-content hidden" id="type-options">

                            <div class="select-items select-hide">
                                <div>Tous</div>
                                <div>Commun</div>
                                <div>Uncommun</div>
                                <div>Spécial</div>
                            </div>
                        </div>
                        <div class="filter-content hidden" id="prix-options">

                            <div class="select-items select-hide">
                                <input type="range" id="price" name="price" min="0" max="500" oninput="priceOutput.value = this.value">
                                <span id="priceOutput">250</span>
                            </div>
                        </div>
                    </div>


                    <!-- Ajouter bouton filtre qui exécute un JS qui filtre en fonnction de la colonne rareté, prix et type -->
                    <table border='1'>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Rareté</th>
                            <th>Prix</th>
                            <th>Achat</th>
                        </tr>

                            <!-- Your table and card listing -->
                            <?php foreach ($cards as $card): ?>
                                <!-- Each card row in the table -->
                                <tr>
                                    <!-- Card details -->
                                    <td><img class='card_image' src='<?php echo $card->image; ?>/low.png' alt='<?php echo $card->name; ?>'></td>
                                    <td><a class='card-link' href='index.php?route=products&card=<?php echo $card->id; ?>'><?php echo $card->name; ?></a></td>
                                    <td><?php echo $card->rarity; ?></td>
                                    <td><?php echo number_format($card->price, 2, ',', '.'); ?> €</td>
                                    <!-- Buy card form -->
                                    <td>
<<<<<<< HEAD
                                        <form id="addToCartForm">
                                            <input type="hidden" name="card_id" value="<?php echo $card->id; ?>">
                                            <input type="number" name="quantity" value="1" min="0" step="1">
                                            <button type="button" onclick="addToCart()">Add to Cart</button>
=======
                                        <form id="addToCartForm_<?php echo str_replace('.', '_', $card->id); ?>">
                                            <input type="hidden" name="buy_card" value="<?php echo str_replace('.', '_', $card->id); ?>">
                                            <input type="number" name="slot_<?php  echo str_replace('.', '_', $card->id); ?>" value="1" min="0" step="1">
                                            <button type="button" onclick="addToCart('<?php echo str_replace('.', '_', $card->id); ?>')">Add to Cart</button>
>>>>>>> 434f5e94751e888e34fdfb4c5d4aa34a5503ce4a
                                        </form>

                                        <script>
                                            function addToCart(cardId) {
                                                // Get the slot value
                                                var slotInput = document.getElementsByName("slot_" + cardId)[0];
                                                var slotValue = slotInput.value;

                                                // Construct form data with card ID and slot value
                                                var formData = new FormData();
                                                formData.append("buy_card", cardId.replace('.', '_'));
                                                formData.append("slot_" + cardId.replace('.', '_'), slotValue);

                                                // Send form data via AJAX
                                                var xhr = new XMLHttpRequest();
                                                xhr.open('POST', 'index.php?route=cart', true);
                                                xhr.onload = function () {
                                                    if (xhr.status === 200) {
                                                        // Handle successful response
                                                        alert(xhr.responseText);
                                                    } else {
                                                        // Handle error
                                                        alert('Error: ' + xhr.statusText);
                                                    }
                                                };
                                                xhr.onerror = function () {
                                                    // Handle connection error
                                                    alert('Network Error');
                                                };
                                                xhr.send(formData);
                                            }

                                        </script>

                                    </td>
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
<script src="ressources/js/accordionSets.js"></script>
