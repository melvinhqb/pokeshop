<?php ob_start(); ?>
<main>
    <div class="content-wrapper">
    <form class="contact-form" id="paymentForm" action="processPayment.php" method="post">
    <div class="category">
        <h3>Facturation</h3>    
       
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
     <h3>Paiement</h3>
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
    <button type="submit" onclick="confirmPayment()">Paiement</button>

    </form>



    </main>
<?php $content = ob_get_clean(); ?>

<?php require_once(ROOT_PATH . '/layout.php'); ?>