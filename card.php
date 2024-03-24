<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la carte Pokémon</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
            <nav class="navbar content-wrapper">
                <a href="index.html"><img class="navbar_logo" src="logo.png"></a>
                <div class="navbar_content">
                    <ul class="navbar_menu">
                        <li class="navbar_item"><a class="nav_link" href="index.html">Accueil</a></li>
                        <li class="navbar_item"><a class="nav_link active" href="produits.html">Produits</a></li>
                        <li class="navbar_item"><a class="nav_link" href="contact.html">Contact</a></li>
                    </ul>
                    <div class="navbar_end">
                        <a class="nav_button" href="login.html">Login</a>
                    </div>
                </div>
            </nav>
    </header>
    <main class="content-wrapper">
    <?php
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pokeshop";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    // Récupérer l'ID de la carte depuis l'URL
    $card_id = $_GET['slug'];

    // Requête pour sélectionner les détails de la carte Pokémon en fonction de l'ID
    $sql = "SELECT * FROM cards WHERE slug = '$card_id'";
    $result = $conn->query($sql);

    // Vérifier si la carte existe
    if ($result->num_rows > 0) {
        // Afficher les détails de la carte
        $row = $result->fetch_assoc();
        echo "<h1>Détails de la carte Pokémon</h1>";
        echo "<img src='Photos/" . $row["image"] . "' alt='" . $row["name"] . "'>";
        echo "<p><strong>Nom:</strong> " . $row["name"] . "</p>";
        echo "<p><strong>Numéro de collection:</strong> " . sprintf("%03d", $row["num_collection"]) . "</p>";
        echo "<p><strong>Prix:</strong> " . $row["price"] . " €</p>";
        echo "<p><strong>Stock:</strong> " . $row["stock"] . "</p>";
    } else {
        echo "Aucune carte trouvée avec cet identifiant.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
    ?>
    </main>
    <footer class="footer">
        <p>© 2024 Pokéshop - Tous droits réservés</p>
    </footer>
</body>
</html>
