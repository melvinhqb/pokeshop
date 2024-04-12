<!-- views/contact.php -->
<?php ob_start(); ?>
<main>
  <div class="content-wrapper">
    <div class="content">
      <form id="monFormulaire" action="index.php?route=contact" method="post">
        <div class="container">
          <h2>Demande de contact</h2>
          <div class="form-group">
            <label for="dateContact">Date du contact</label>
            <input type="date" id="dateContact" name="dateContact" value="<?php echo date('Y-m-d'); ?>" readonly>
          </div>
          <div class="form-group">
            <label for="lastName">Nom</label>
            <input type="text" id="lastName" name="lastName" placeholder="Entrez votre nom" value="<?php echo isset($contact->lastName) ? htmlspecialchars($contact->lastName) : ''; ?>" <?php echo isset($errors['lastName']) ? 'data-error="true"' : ''; ?>>
            <?php echo isset($errors['lastName']) ? '<div class=error-field>' . $errors['lastName'] . '</div>' : ''; ?>
          </div>
          <div class="form-group">
            <label for="firstName">Prénom</label>
            <input type="text" id="firstName" name="firstName" placeholder="Entrez votre prénom" value="<?php echo isset($contact->firstName) ? htmlspecialchars($contact->firstName) : ''; ?>" <?php echo isset($errors['firstName']) ? 'data-error="true"' : ''; ?>>
            <?php echo isset($errors['firstName']) ? '<div class=error-field>' . $errors['firstName'] . '</div>' : ''; ?>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre mail" value="<?php echo isset($contact->email) ? htmlspecialchars($contact->email) : ''; ?>" <?php echo isset($errors['email']) ? 'data-error="true"' : ''; ?>>
            <?php echo isset($errors['email']) ? '<div class=error-field>' . $errors['email'] . '</div>' : ''; ?>
          </div>
          <div class="form-group">
            <label>Genre</label>
            <label class="radio-inline">
              <input type="radio" id="female" name="gender" value="female" <?php echo isset($contact->gender) && $contact->gender == 'female' ? 'checked' : ''; ?> <?php echo isset($errors['gender']) ? 'data-error="true"' : ''; ?>> Femme
            </label>
            <label class="radio-inline">
              <input type="radio" id="male" name="gender" value="male" <?php echo isset($contact->gender) && $contact->gender == 'male' ? 'checked' : ''; ?> <?php echo isset($errors['gender']) ? 'data-error="true"' : ''; ?>> Homme
            </label>
            <?php echo isset($errors['gender']) ? '<div class=error-field>' . $errors['gender'] . '</div>' : ''; ?>
          </div>
          <div class="form-group">
            <label for="birthdate">Date de Naissance</label>
            <input type="date" id="birthdate" name="birthdate" value="<?php echo isset($contact->birthdate) ? htmlspecialchars($contact->birthdate) : ''; ?>" <?php echo isset($errors['birthdate']) ? 'data-error="true"' : ''; ?>>
            <?php echo isset($errors['birthdate']) ? '<div class=error-field>' . $errors['birthdate'] . '</div>' : ''; ?>
          </div>
          <div class="form-group">
            <label for="function">Fonction</label>
            <select id="function" name="function" <?php echo isset($errors['function']) ? 'data-error="true"' : ''; ?>>
              <option value="">--Choisissez une option--</option>
              <option value="student" <?php echo isset($contact->function) && $contact->function == 'student' ? 'selected' : ''; ?>>Étudiant</option>
              <option value="teacher" <?php echo isset($contact->function) && $contact->function == 'teacher' ? 'selected' : ''; ?>>Enseignant</option>
              <option value="engineer" <?php echo isset($contact->function) && $contact->function == 'engineer' ? 'selected' : ''; ?>>Ingénieur</option>
            </select>
            <?php echo isset($errors['function']) ? '<div class=error-field>' . $errors['function'] . '</div>' : ''; ?>
          </div>
          <div class="form-group">
            <label for="subject">Sujet :</label>
            <input type="text" id="subject" name="subject" placeholder="Entrez le sujet de votre mail" value="<?php echo isset($contact->subject) ? htmlspecialchars($contact->subject) : ''; ?>" <?php echo isset($errors['subject']) ? 'data-error="true"' : ''; ?>>
            <?php echo isset($errors['subject']) ? '<div class=error-field>' . $errors['subject'] . '</div>' : ''; ?>
          </div>
          <div class="form-group">
            <label for="content">Contenu :</label>
            <textarea id="content" name="content" rows="4" placeholder="Tapez ici votre message" <?php echo isset($errors['content']) ? 'data-error="true"' : ''; ?>><?php echo isset($contact->content) ? htmlspecialchars($contact->content) : ''; ?></textarea>
            <?php echo isset($errors['content']) ? '<div class=error-field>' . $errors['content'] . '</div>' : ''; ?>
          </div>
          <button type="submit">Envoyer</button>
        </form>
        </div>
      </div>
    </div>
  </form>
</main>
<?php $content = ob_get_clean(); ?>
<?php require('layout.php'); ?>
<script src="ressources/js/verificationJS.js" defer></script>
