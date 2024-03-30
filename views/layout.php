<!-- views/layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokeshop | Accueil</title>
    <link rel="stylesheet" href="ressources/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php require('partials/header.php'); ?>
    <main>
        <div class="content-wrapper">
            <?= $content ?>
        </div>
    </main>
    <?php require('partials/footer.php'); ?>
</body>
</html>