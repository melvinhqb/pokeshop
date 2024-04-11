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
            <form class="contact-form" action="signup.php" method="POST">
        <div class="container">
            <h1 style="text-align:center;">Formulaire d'inscription</h1>
            <div class="form-group">
                <label>Username :</label>
                <input type="text" placeholder="Enter Username" name="username" required>
            </div>
            <div class="form-group">
                <label>Password :</label>
                <input type="password" placeholder="Enter Password" name="password" required>
            </div>
            <div class="form-group">
                <label>Email :</label>
                <input type="email" placeholder="Enter Email" name="email" required>
            </div>
            <button type="submit">Log In</button>
        </div>
    </form>
</main>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
