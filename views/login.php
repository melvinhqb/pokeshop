<!-- views/login.php -->
<?php ob_start(); ?>
<main>
    <div class="content-wrapper">
    <div class="content">
            <form action="index.php?route=login" method="POST">
                <div class="container">
                    <h1 class="center_text">Formulaire de connexion</h1>
                    <div class="form-group">
                        <label>Email :</label>
                        <input type="email" placeholder="Enter Email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password :</label>
                        <input type="password" placeholder="Enter Password" name="password" required>
                    </div>
                    <button type="submit">Se connecter</button>
                    <?php if (!empty($error)): ?>
                        <div class="error-message">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="container">
                    <p>Vous n'avez pas de compte ? <a href="index.php?route=register">Inscrivez-vous</a></p>
                </div>
            </form>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
