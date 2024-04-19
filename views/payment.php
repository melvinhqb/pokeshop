<?php 

ob_start(); ?>
<main>
    <div class="content-wrapper">
        <div class="content">
            <form class="contact-form" id="paymentForm" action="index.php?route=payment" method="post">
                <div class="container">
                <div class="category">
                <div class="montant-container" >
                    <div class="montant-title">
                    <h3 class="space-title">Montant à payer</h3>
                    <?php 
                            try {
                                if ($_SESSION) { ;?>
                                <span class="total-price" id="totalPrice">
                                <?php echo number_format($total, 2, ',', '.');?>€</span>
                    <?php } else {
                                    echo 'Veuillez vous connecter pour acheter';
                                }
                            } catch (Exception $e) {
                                echo "Caught exception: " . $e->getMessage();
                            }
                            ?>
                    </div>
                </div>

                    <h3 class="space-title">Facturation</h3>

                    <div class="form-group">
                        <label for="lastName">Nom</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Entrez votre nom" required>
                    </div>

                    <div class="form-group">
                        <label for="firstName">Prenom</label>
                        <input type="text" id="firstName" name="firstName" placeholder="Entrez votre prenom" required>
                    </div>

                    <div class="form-group">
                        <label for="billingAddress">Adresse de Facturation</label>
                        <input type="text" id="billingAddress" name="billingAddress" placeholder="Entrez l'adresse de facturation" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Entrez votre mail" required>
                    </div>
                </div>

                <div class="category">
                    <h3 class="space-title">Paiement</h3>
                    <div class="form-group">
                        <label for="cardNumber">Numéro de carte </label>
                        <input type="text" id="cardNumber" name="cardNumber" placeholder="Veuillez entrer votre numéro de carte" required>
                    </div>
                    <div class="form-group">
                        <label for="expiryDate">Date d'Expiration</label>
                        <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/AA" required>
                    </div>

                    <div class="form-group">
                        <label for="nameCarte">Nom apparaissant sur la carte</label>
                        <input type="text" id="nameCarte" name="nameCarte" placeholder="Veuillez entrer le nom figurant sur la carte" required>
                    </div>

                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="CVV" required>
                    </div> 
                </div>   
                    <button type="submit" >Paiement</button>
                    <!-- ici c'est le pop up customisé -->
                    <div id="custom-alert" class="custom-alert-hidden">
                        <div class="custom-alert-content">
                            <p id="custom-alert-text"></p>
                            <button type="button" class="custom-alert-closebtn" >Ok</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php $content = ob_get_clean(); ?>

<?php require_once(ROOT_PATH . '/layout.php'); ?>

<script src="ressources/js/verificationPaiement.js"></script>