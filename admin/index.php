<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Séries de Cartes Pokémon</title>
    <style>
        .series {
            display: inline-block;
            width: 300px;
            margin: 10px;
            text-align: center;
        }
        .series img {
            width: 200px;
            height: 100px;
            margin-bottom: 10px;
        }
        .set {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<!-- Bouton pour purger la base de données -->
<button id="purge-database-btn" style="background-color:red;color:white;cursor:pointer">Purger la Base de Données</button>
<?php
// Faire une requête à l'API TCGdex pour récupérer les séries de cartes
$json = file_get_contents('https://api.tcgdex.net/v2/fr/series');
$series = json_decode($json, true);

// Afficher les séries
foreach ($series as $serie) {
    echo '<div class="series">';
    if (isset($serie['logo'])) {
        $logo_url = $serie['logo'] . '.webp';
        // Vérifier si l'URL du logo existe
        if (@getimagesize($logo_url)) {
            echo '<img src="' . $logo_url . '" alt="' . $serie['name'] . '">';
        }
    }
    echo '<p>' . $serie['name'] . '</p>';
    
    // Faire une requête à l'API TCGdex pour obtenir des informations détaillées sur la série
    $serie_id = $serie['id'];
    $serie_details_json = file_get_contents('https://api.tcgdex.net/v2/fr/series/' . $serie_id);
    $serie_details = json_decode($serie_details_json, true);

    // Afficher les ensembles de cartes associés à la série
    if (isset($serie_details['sets'])) {
        echo '<div class="set">';
        echo '<h3>Sets associés:</h3>';
        foreach ($serie_details['sets'] as $set) {
            echo '<div><a href="set.php?id=' . $set['id'] . '">' . $set['name'] . '</a></div>';
        }
        echo '</div>';
    }

    echo '</div>';
}
?>
<script>
        // Fonction pour purger la base de données
        document.getElementById("purge-database-btn").addEventListener("click", function() {
        // Confirmer avec l'utilisateur avant de purger la base de données
        if (confirm("Êtes-vous sûr de vouloir purger la base de données ? Cette action est irréversible.")) {
            // Envoyer une requête AJAX pour exécuter le script SQL de purge
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "purge_database.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Afficher un message à l'utilisateur pour indiquer que la base de données a été purgée
                    alert("La base de données a été purgée avec succès.");
                } else {
                    // Afficher un message d'erreur si la requête AJAX échoue
                    alert("Une erreur s'est produite lors de la purge de la base de données.");
                }
            };
            xhr.send();
        }
    });
</script>
</body>
</html>
