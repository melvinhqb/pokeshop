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
                            <div class="filter-option" id="rarity" onclick="toggleFilter('rarity')">
                                <span class="filter-name">Rareté</span>
                                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7.406 9.375L12 13.967l4.594-4.592 1.416 1.416L12 16.798l-6.016-6.017z"/></svg>
    
                            </div>
                        
                        
                            <div class="filter-option" id="type" onclick="toggleFilter('type')">
                                <span class="filter-name">Type</span>
                                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7.406 9.375L12 13.967l4.594-4.592 1.416 1.416L12 16.798l-6.016-6.017z"/></svg>
                                
                                
                            </div>
                        
                        
                            <div class="filter-option" id="prix" onclick="toggleFilter('price')">
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
                        <div class="filter-content hidden" id="rarity-options">
                        
                            <div class="select-items select-hide">
                                <?php foreach ($rarities as $rarity): ?>
                                    <div data-rarity="<?= htmlspecialchars($rarity) ?>" onclick="filterCards('data-rarity','<?= htmlspecialchars($rarity); ?>')">
                                        <?= htmlspecialchars($rarity) ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="filter-content hidden" id="type-options">
                                
                        
                            <div class="select-items select-hide">
                            <div data-type='Feu' onclick="resetCards(); filterCards('data-type', 'Feu')">Feu</div>
                            <div data-type='Eau' onclick="resetCards(); filterCards('data-type', 'Eau')">Eau</div>
                            <div data-type='Plante' onclick="resetCards(); filterCards('data-type', 'Plante')">Plante</div>
                            <div data-type='Psy' onclick="resetCards(); filterCards('data-type', 'Psy')">Psy</div>
                            <!-- Encoded special characters -->
                            <div data-type='Électrique' onclick="resetCards(); filterCards('data-type', 'Électrique')">Électrique</div>
                            <div data-type='Obscurité' onclick="resetCards(); filterCards('data-type', 'Obscurité')">Métal</div>
                            <div data-type='Fée' onclick="resetCards(); filterCards('data-type', 'Fée')">Fée</div>
                            <div data-type='Dragon' onclick="resetCards(); filterCards('data-type', 'Dragon')">Dragon</div>
                            <div data-type='Combat' onclick="resetCards(); filterCards('data-type', 'Combat')">Combat</div>
                            <div data-type='Incolore' onclick="resetCards(); filterCards('data-type', 'Incolore')">Normal</div>
                            
                        </div>

                        </div>
                        <div class="filter-content hidden" id="price-options">
                            
                            <div class="select-items select-hide">
                                <div class=price-content>
                                    <label for=price>Price Max: </label>
                                    <input type="range" id="price" name="price" min="0" max="500" oninput="priceOutput.value = price.value; filterCards('data-price', this.value);" >
                                    <output id="priceOutput">250</output>$</div>
                                
                            
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
                                <tr class="card-row" data-rarity="<?= htmlspecialchars($card->rarity); ?>" data-type="<?= htmlspecialchars($card->types); ?>" data-price="<?php echo number_format($card->price, 2, ',', '.'); ?>">
                                    <!-- Card details -->
                                    <td><img class='card_image' src='<?php echo $card->image; ?>/low.png' alt='<?php echo $card->name; ?>'></td>
                                    <td><a class='card-link' href='index.php?route=products&card=<?php echo $card->id; ?>'><?php echo $card->name; ?></a></td>
                                    <td><?php echo $card->rarity; ?></td>
                                    <td><?php echo number_format($card->price, 2, ',', '.'); ?> €</td>
                                    <!-- Buy card form -->
                                    <td>
                                        <form id="addToCartForm">
                                            <input type="hidden" name="card_id" value="<?php echo $card->id; ?>">
                                            <input type="number" name="quantity" value="1" min="0" step="1">
                                            <button type="button" onclick="addToCart()">Add to Cart</button>
                                        </form>
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
<script src="ressources/js/filter.js"></script>
<script>
    function addToCart(cardId) {
        // Récupération des données du formulaire
        var formData = new FormData(document.getElementById('addToCartForm'));

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
