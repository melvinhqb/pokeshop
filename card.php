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
    <header>
            <a class ="Logo" href="index.html"><img src="logo.png"></a>
            <nav>            
                <div class="lien_nav_gauche">
                    <a class="non_souligne" href="index.html">Accueil</a>
                    <a class="souligne" href="produits.html">Produits</a>
                    <a class="non_souligne" href="contact.html">Contact</a>
                </div>
                <div class="lien_nav_droite">
                    <a class="non_souligne" href="login.html">Login</a>
                </div>
            </nav>
    </header>
    <main>
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
</body>
</html>
