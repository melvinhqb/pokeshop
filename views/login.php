<!-- views/login.php -->
<?php ob_start(); ?>
<main>
    <div class="content-wrapper">
        <div class="content">
            <h1>Connexion</h1>
            <?php if (!empty($error)): ?>
                <div class="error-message">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form action="index.php?route=login" method="post">
                <div class="form-group">
                    <label for="email">E-mail :</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Se connecter</button>
            </form>
            <p>Vous n'avez pas de compte ? <a href="index.php?route=register">Inscrivez-vous ici</a>.</p>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
