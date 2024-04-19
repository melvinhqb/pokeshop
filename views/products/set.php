<!-- views/set.php -->
<?php ob_start(); ?>

<main>
    <div class="content-wrapper">
        <?php include(ROOT_PATH . '/partials/sidebar.php'); ?>
        <div class="content">
            <h1>Extension <?php echo $set->name; ?></h1>
            <?php if (!empty($cards)): ?>
                <div>
                <div class="filter-bar">
                        <span class="filter-caption">FILTER BY:</span>
                        <div class=filter-options>
                            <div class="filter-option rarity" id="rarity" onclick="toggleFilter('rarity')">
                                <span class="filter-name">Rareté</span>
                                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7.406 9.375L12 13.967l4.594-4.592 1.416 1.416L12 16.798l-6.016-6.017z"/></svg>
    
                            </div>
                        
                        
                            <div class="filter-option type" id="type" onclick="toggleFilter('type')">
                                <span class="filter-name">Type</span>
                                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7.406 9.375L12 13.967l4.594-4.592 1.416 1.416L12 16.798l-6.016-6.017z"/></svg>
                                
                                
                            </div>
                        
                        
                            <div class="filter-option price" id="prix" onclick="toggleFilter('price')">
                                <span class="filter-name">Prix</span>
                                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7.406 9.375L12 13.967l4.594-4.592 1.416 1.416L12 16.798l-6.016-6.017z"/></svg>
                                

                            </div>
                        </div>
                        
                        <!--grid and table view icon -->
                        <div class="view-toggle">
                            <button type="submit" id="grid-icon" class="icon active" >
                                    <div class="square"></div>
                                    <div class="square"></div>
                                    <div class="square"></div>
                                    <div class="square"></div>
                            </button>
                            <button type="submit" id="table-icon" class="icon">
                                    <div class="rectangle"></div>
                                    <div class="rectangle"></div>
                                    <div class="rectangle"></div>
                                </button>
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
                                    <label >Price Max: </label>
                                    <input type="range" id="price"  name="price" min="0" max="100" oninput="priceOutput.value = price.value; filterCards('data-price', this.value);" >
                                    <output id="priceOutput">50</output>€</div>
                            </div>
                        </div>
                    </div>  
                    <div  class="view-container">
                        <div class="view-container" id="grid-view">
                            <?php foreach ($cards as $card): ?>
                            <div class="card-row" data-rarity="<?= htmlspecialchars($card->rarity); ?>" data-type="<?= htmlspecialchars($card->types); ?>" data-price="<?php echo number_format($card->price, 2, ',', '.'); ?>">
                                <img class='card_image' src='<?php echo $card->image; ?>/high.png' alt='<?php echo $card->name; ?>'>  
                                <div class="card-grid-info">
                                    <a class='card-link' href='index.php?route=products&card=<?php echo $card->id; ?>'><?php echo $card->name; ?></a>
                                    <br><strong><?php echo number_format($card->price, 2, ',', '.'); ?> €</strong>
                                    <form onsubmit="addToCart(event)">
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
                                                    <div class="stock-error-field">
                                                        <p class="stock-message error-message-hidden"></p>
                                                    </div>
                                                    <button type="submit">Add to Cart</button>
                                                    
                                                    <div id="custom-alert" class="custom-alert-hidden">
                                                            <div class="custom-alert-content">
                                                            <p id="custom-alert-text"></p>
                                                            <button type="button" class="custom-alert-closebtn" >Ok</button></div></div> 
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
                                </div>  
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div id="table-view" class="view-container" style="display:none;">                   
                        <table border='1'>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Rareté</th>
                                <th>Prix</th>
                                <th colspan=2>Achat</th>
                            </tr>

                                <!-- Your table and card listing -->
                                <?php foreach ($cards as $card): ?>
                                    <!-- Each card row in the table -->
                                    <tr class="card-row" data-rarity="<?= htmlspecialchars($card->rarity); ?>" data-type="<?= htmlspecialchars($card->types); ?>" data-price="<?php echo number_format($card->price, 2, ',', '.'); ?>">
                                        <!-- Card details -->
                                        <td><img class='card_image' src='<?php echo $card->image; ?>/high.png' alt='<?php echo $card->name; ?>'></td>
                                        <td><a class='card-link' href='index.php?route=products&card=<?php echo $card->id; ?>'><?php echo $card->name; ?></a></td>
                                        <td><?php echo $card->rarity; ?></td>
                                        <td><?php echo number_format($card->price, 2, ',', '.'); ?> €</td>
                                        <!-- Buy card form -->
                                        <td>
                                        <form onsubmit="addToCart(event)">
                                        <?php 
                                        try {
                                            if (isset($_SESSION["user_id"])) { ?>
                                                <?php if ($card->stock > 0): ?>
                                                <div class="quantity-container">
                                                    <div class="quantity-input">                                                        
                                                        <button type="button" onclick="decreaseQuantity(this)" class="quantity-change-btn minus disabled" id="minus">-</button>
                                                        <input type="hidden" name="card_id" value="<?php echo $card->id ?>">
                                                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $card->stock ?>" step="1" >
                                                        <button type="button" onclick="increaseQuantity(this)" class="quantity-change-btn plus" id="plus">+</button>
                                                    </div>

                                                    <button type="submit">Add to Cart</button>
                                                    <div class="stock-error-field">
                                                        <p class="stock-message error-message-hidden"></p>
                                                    </div>
                                                    <div id="custom-alert" class="custom-alert-hidden">
                                                            <div class="custom-alert-content">
                                                                <p id="custom-alert-text"></p>
                                                                <button type="button" class="custom-alert-closebtn" >Ok</button>
                                                            </div>
                                                    </div> 
                                                </div>
                                                <?php else:?>
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
                                <?php endforeach; ?>
                        </table>
                    </div> 
                </div>
            <?php else: ?>
                Aucune carte associée à cet ensemble.
            <?php endif; ?>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require_once(ROOT_PATH . '/layout.php'); ?>

<script src="ressources/js/imageZoomModal.js"></script>
<script src="ressources/js/accordionSets.js"></script>
<script src="ressources/js/filter.js"></script>
<script src="ressources/js/addToCart.js"></script>
<script src="ressources/js/updateTable.js"></script>
<script src="ressources/js/switchViewsProducts.js"></script>
<script src="ressources/js/quantityButtons.js"></script>