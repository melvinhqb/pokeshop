<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si des cartes ont été sélectionnées
    if (isset($_POST['cards']) && is_array($_POST['cards']) && !empty($_POST['cards'])) {
        // Récupérer les cartes sélectionnées
        $selected_cards = $_POST['cards'];
        $serie_id = $_POST['serie_id'];
        $set_id = $_POST['set_id'];

        // Connectez-vous à votre base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pokeshop_v2";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Échec de la connexion à la base de données: " . $conn->connect_error);
        }

        // Ajouter chaque carte à la base de données
        foreach ($selected_cards as $card_id) {
            // Vérifier si la carte existe déjà dans la base de données
            $check_card_sql = "SELECT * FROM cards WHERE id = '$card_id'";
            $card_result = $conn->query($check_card_sql);

            if ($card_result->num_rows == 0) {

                // Vérifier si l'ensemble existe dans la table "sets"
                $check_set_sql = "SELECT * FROM sets WHERE id = '$set_id'";
                $set_result = $conn->query($check_set_sql);
                if ($set_result->num_rows == 0) {

                    // Vérifier si la série existe dans la table "series"
                    $check_serie_sql = "SELECT * FROM series WHERE id = '$serie_id'";
                    $serie_result = $conn->query($check_serie_sql);
                    if ($serie_result->num_rows == 0) {
                        // Effectuer la requête API pour obtenir les informations de la série
                        $api_url = "https://api.tcgdex.net/v2/fr/series/$serie_id";
                        $serie_details_json = file_get_contents($api_url);
                        $serie_details = json_decode($serie_details_json, true);
                    
                        // Vérifier si les données ont été récupérées avec succès
                        if ($serie_details && isset($serie_details['name'])) {
                            // Récupérer les informations de la série depuis la réponse JSON
                            $name = $serie_details['name'] ?? null;
                            $logo = $serie_details['logo'] ?? null;
                    
                            // Insérer les informations de la série dans la base de données
                            $insert_serie_sql = "INSERT INTO series (id, name, logo) 
                                                VALUES ('$serie_id', '$name', '$logo')";
                            if ($conn->query($insert_serie_sql) === TRUE) {
                                echo "Série ajoutée avec succès dans la table series.<br>";
                            } else {
                                echo "Erreur lors de l'ajout de la série: " . $conn->error . "<br>";
                            }
                        } else {
                            echo "Erreur lors de la récupération des détails de la série à partir de l'API.<br>";
                        }
                    }
                    
                    // Récupérer les informations de l'ensemble depuis l'API TCGdex
                    $api_url = "https://api.tcgdex.net/v2/fr/sets/$set_id";
                    $set_details_json = file_get_contents($api_url);
                    $set_details = json_decode($set_details_json, true);

                    // Vérifier si les données ont été récupérées avec succès
                    if ($set_details && isset($set_details['name'])) {
                        // Récupérer les informations de l'ensemble depuis la réponse JSON
                        $name = $set_details['name'] ?? null;
                        $releaseDate = $set_details['releaseDate'] ?? null;
                        $legal = isset($set_details['legal']) ? json_encode($set_details['legal']) : null;
                        $logo = $set_details['logo'] ?? null;
                        $symbol = $set_details['symbol'] ?? null;
                        $cardCount = isset($set_details['cardCount']) ? json_encode($set_details['cardCount']) : null;

                        // Insérer les informations de l'ensemble dans la base de données
                        $insert_set_sql = "INSERT INTO sets (id, name, releaseDate, legal, logo, symbol, serie_id, cardCount) 
                                            VALUES ('$set_id', '$name', '$releaseDate', '$legal', '$logo', '$symbol', '$serie_id', '$cardCount')";
                        if ($conn->query($insert_set_sql) === TRUE) {
                            echo "Ensemble ajouté avec succès dans la table sets.<br>";
                        } else {
                            echo "Erreur lors de l'ajout de l'ensemble dans la table sets: " . $conn->error . "<br>";
                        }

                    } else {
                        echo "Erreur lors de la récupération des détails de l'ensemble à partir de l'API.<br>";
                    }
                }
                // Récupérer les informations de la carte depuis l'API TCGdex
                $api_url = "https://api.tcgdex.net/v2/fr/cards/$card_id";
                $card_details_json = file_get_contents($api_url);
                $card_details = json_decode($card_details_json, true);

                // Vérifier si les données ont été récupérées avec succès
                if ($card_details && isset($card_details['name'])) {
                    // Récupérer les informations de la carte depuis la réponse JSON
                    $category = $card_details['category'] ?? null;
                    $illustrator = $card_details['illustrator'] ?? null;
                    $image = $card_details['image'] ?? null;
                    $localId = $card_details['localId'] ?? null;
                    $name = $card_details['name'] ?? null;
                    $rarity = $card_details['rarity'] ?? null;
                    $types = isset($card_details['types']) ? json_encode($card_details['types']) : null;
                    $evolveFrom = $card_details['evolveFrom'] ?? null;
                    $description = $card_details['description'] ?? null;
                    $stage = $card_details['stage'] ?? null;
                    $attacks = isset($card_details['attacks']) ? json_encode($card_details['attacks']) : null;
                    $weaknesses = isset($card_details['weaknesses']) ? json_encode($card_details['weaknesses']) : null;
                    $retreat = $card_details['retreat'] ?? null;
                    $regulationMark = $card_details['regulationMark'] ?? null;
                    $legal = isset($card_details['legal']) ? json_encode($card_details['legal']) : null;
                    $variants = isset($card_details['variants']) ? json_encode($card_details['variants']) : null;
                    $hp = $card_details['hp'] ?? null;                 
                    
                    if ($rarity === "Commune") {
                        $stock = rand(10, 50);
                        $price = number_format(rand(100, 500) / 100, 2);
                    } elseif ($rarity === "Peu Commune") {
                        $stock = rand(5, 30);
                        $price = number_format(rand(500, 1500) / 100, 2);
                    } elseif ($rarity === "Rare") {
                        $stock = rand(3, 15);
                        $price = number_format(rand(1500, 5000) / 100, 2);
                    } else {
                        $stock = rand(50, 100);
                        $price = number_format(rand(5000, 10000) / 100, 2);
                    }                 

                    // Préparer la requête SQL avec des marqueurs de position
                    $insert_card_sql = "INSERT INTO cards (id, category, illustrator, image, localId, name, rarity, types, evolveFrom, description, stage, attacks, weaknesses, retreat, regulationMark, legal, set_id, variants, hp, stock, price) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                    // Préparer la déclaration
                    $stmt = $conn->prepare($insert_card_sql);

                    // Liaison des valeurs avec les marqueurs de position
                    $stmt->bind_param("sssssssssssssssssssss", $card_id, $category, $illustrator, $image, $localId, $name, $rarity, $types, $evolveFrom, $description, $stage, $attacks, $weaknesses, $retreat, $regulationMark, $legal, $set_id, $variants, $hp, $stock, $price);

                    // Exécuter la déclaration
                    if ($stmt->execute()) {
                        echo "La carte avec l'ID " . $card_id . " a été ajoutée avec succès.<br>";
                    } else {
                        echo "Erreur lors de l'ajout de la carte: " . $stmt->error . "<br>";
                    }

                    // Fermer la déclaration
                    $stmt->close();
                } else {
                    echo "Erreur lors de la récupération des détails de la carte à partir de l'API.<br>";
                }

            } else {
                echo "La carte avec l'ID " . $card_id . " est déjà présente dans la base de données.<br>";
            }
        }


        // Fermer la connexion à la base de données
        $conn->close();
    } else {
        echo "Aucune carte sélectionnée.";
    }
} else {
    echo "Méthode de requête incorrecte.";
}
?>
