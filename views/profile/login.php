<!-- views/login.php -->
<?php ob_start(); ?>
<main>
    <div class="content-wrapper">
    <div class="content">
            <form action="index.php?route=profile&action=login" method="POST">
                <div class="container">
                    <h1 class="center_text">Formulaire de connexion</h1>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" placeholder="Enter Email" name="email" id="email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password :</label>
                        <input type="password" placeholder="Enter Password" name="password" id="password" autocomplete="current-password" required>
                    </div>
                    <button type="submit">Se connecter</button>
                    <?php if (!empty($error)): ?>
                        <div class="error-message">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="container">
                    <p>Vous n'avez pas de compte ? <a href="index.php?route=profile&action=register">Inscrivez-vous</a></p>
                </div>
            </form>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require_once(ROOT_PATH . '/layout.php'); ?>
