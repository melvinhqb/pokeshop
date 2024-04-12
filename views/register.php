<!-- views/register.php -->
<?php ob_start(); ?>
<main>
    <div class="content-wrapper">
        <div class="content">
            <form action="index.php?route=register" method="POST">
                <div class="container">
                    <h1 class="center_text">Formulaire d'inscription</h1>
                    <div class="form-group">
                        <label>Username :</label>
                        <input type="text" placeholder="Enter Username" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Email :</label>
                        <input type="email" placeholder="Enter Email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password :</label>
                        <input type="password" placeholder="Enter Password" name="password" required>
                    </div>
                    <button type="submit">S'inscrire</button>
                    <?php if (!empty($error)): ?>
                        <div class="error-message">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="container">
                    <p>Vous avez un compte ? <a href="index.php?route=login">Connectez-vous</a>.</p>
                </div>
            </form>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
