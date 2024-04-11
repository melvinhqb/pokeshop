<!-- views/contact.php -->
<?php ob_start(); ?>
<main>
    <div class="content-wrapper">
        <div class="content">
        <form class="contact-form" id="monFormulaire" action="verificationPHP.php"method="post">
            <h2>Demande de contact</h2>
          <div id="errorDiv"></div>
          <div class="form-group">
            <label for="dateContact">Date du contact</label>
            <input type="text" id="dateContact" name="dateContact" placeholder="JJ/MM/AAAA" >
          </div>
          
          <div class="form-group">
            <label for="lastName">Nom</label>
            <input type="text" id="lastName" name="lastName" placeholder="Entrez votre nom">
          </div>
          <div class="form-group">
            <label for="firstName">Prénom</label>
            <input type="text" id="firstName" name="firstName" placeholder="Entrez votre prénom" >
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre mail" >
          </div>
          <div class="form-group">

        
            <label>Genre</label>
            <label class="radio-inline">
              <input type="radio" id="female" name="gender" value="female"> Femme
            </label>
            <label class="radio-inline">
              <input type="radio" id="male" name="gender" value="male"> Homme
            </label>
          
          
        </div>
          
          
          <div class="form-group">
            <label for="birthdate">Date de Naissance</label>
            <input type="text" id="birthdate" name="birthdate" placeholder="JJ/MM/AAAA" >
          </div>
          
          <div class="form-group">
            <label for="function">Fonction</label>
            <select id="function" name="function">
              <option value="">--Choisissez une option--</option>
              <option value="student">Étudiant</option>
              <option value="teacher">Enseignant</option>
              <option value="engineer">Ingénieur</option>
              
            </select>
          </div>
          <div class="form-group">
            <label for="subject">Sujet :</label>
            <input type="text" id="subject" name="subject" placeholder="Entrez le sujet de votre mail" >
          </div>
          <div class="form-group">
            <label for="content">Contenu :</label>
            <textarea id="content" name="content" rows="4" placeholder="Tapez ici votre message" ></textarea>
          </div>
          <button type="submit">Envoyer</button>
        </form>
        </div>
    </div>
</form>

</main>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
<script src="ressources/js/verificationJS.js" defer></script>