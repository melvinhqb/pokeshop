<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des cartes Pokémon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pokemon_store";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    // Initialiser la clause WHERE
    $where_clause = "";

    // Initialiser le titre
    $title = "Toutes les cartes";

    // Vérifier s'il y a une recherche par série
    if(isset($_GET['serie']) && !empty($_GET['serie'])) {
        $serie = $_GET['serie'];
        // Récupérer le nom de la série à partir de la base de données
        $serie_name_query = "SELECT nom FROM serie WHERE slug = '$serie'";
        $serie_name_result = $conn->query($serie_name_query);
        if ($serie_name_result->num_rows > 0) {
            $serie_name_row = $serie_name_result->fetch_assoc();
            $title = "Série " . $serie_name_row['nom'];
        }

        // Ajouter le filtre de recherche par série dans la clause WHERE
        if (!empty($where_clause)) {
            $where_clause .= " AND";
        } else {
            $where_clause .= " WHERE";
        }
        $where_clause .= " e.serie_id IN (SELECT id FROM serie WHERE slug = '" . $serie . "')";
    }

    // Vérifier s'il y a une recherche par extension
    if(isset($_GET['extension']) && !empty($_GET['extension'])) {
        $extension = $_GET['extension'];
        // Récupérer le nom de l'extension à partir de la base de données
        $extension_name_query = "SELECT nom FROM extension WHERE slug = '$extension'";
        $extension_name_result = $conn->query($extension_name_query);
        if ($extension_name_result->num_rows > 0) {
            $extension_name_row = $extension_name_result->fetch_assoc();
            $title = "Extension " . $extension_name_row['nom'];
        }

        // Ajouter le filtre de recherche par extension dans la clause WHERE
        if (!empty($where_clause)) {
            $where_clause .= " AND";
        } else {
            $where_clause .= " WHERE";
        }
        $where_clause .= " extension_id = (SELECT id FROM extension WHERE slug = '" . $extension . "')";
    }

    // Requête pour sélectionner les cartes Pokémon en fonction de la recherche
    $sql = "SELECT c.id, c.numero_carte, c.nom, c.image, c.prix, c.stock, e.nb_cartes, e.nb_cartes_secretes 
    FROM carte c
    LEFT JOIN extension e ON c.extension_id = e.id " . $where_clause;
    $result = $conn->query($sql);

    // Affichage du titre personnalisé
    echo "<h1>Liste des cartes Pokémon - $title</h1>";

    if ($result->num_rows > 0) {
        // Afficher les cartes Pokémon dans un tableau
        echo "<div class='center'>";
        echo "<table border='1'>";
        echo "<tr><th>Image</th><th>Nom</th><th>Numéro</th><th>Prix</th><th>Stock</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='Photos/" . $row["image"] . "' alt='" . $row["nom"] . "' style='width: 50px; height: auto;'></td>";
            echo "<td>" . $row["nom"] . "</td>";
            echo "<td>" . sprintf("%03d", $row["numero_carte"]) . "/" . (sprintf("%03d", $row["nb_cartes"] - $row["nb_cartes_secretes"])) . "</td>";
            echo "<td>" . $row["prix"] . " €</td>";
            echo "<td>" . $row["stock"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo '</div>';
    } else {
        echo "Aucun résultat trouvé";
    }    

    // Fermer la connexion à la base de données
    $conn->close();
    ?>
</body>
</html>
