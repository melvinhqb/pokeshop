<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Séries de Cartes Pokémon</title>
    <style>
        *{
            margin: 0;
            font-family: 'Manrope', sans-serif;
        }
        .series {
            border: 0.1em #ddd solid;
            border-radius: 0.75em;
            margin: 10px;
            height: 40em;
            text-align:center;
        }
        .series img {
            width: 200px;
            height: 100px;
        }
        .set {
            padding: 1em;
            width: 300px;
            height: 27em;
        }
        .button{
            background-color:red;
            color:white;
            cursor:pointer;
            display:block;
            margin:auto;
            margin-top:3em;
            margin-bottom:3em;
        }
        .content-wrapper{
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            flex-direction: row;
            justify-content: space-around;
            width: 100%;
        }
        .logo{
            height:100px;
            width:300px;
            padding: 1em;
        }
        .titre{
            padding-left:1em;
            padding-right:1em;
            padding-bottom:1em;
        }
    
    </style>
</head>
<body>
<!-- Bouton pour purger la base de données -->
<button class ="button" id="purge-database-btn">Purger la Base de Données</button>
<?php
// Faire une requête à l'API TCGdex pour récupérer les séries de cartes
$json = file_get_contents('https://api.tcgdex.net/v2/fr/series');
$series = json_decode($json, true);

// Afficher les séries
echo '<div class="content-wrapper">';

foreach ($series as $serie) {
    echo '<div class="series">';
    echo '<div class="logo">';
    if (isset($serie['logo'])) {
        $logo_url = $serie['logo'] . '.webp';
        // Vérifier si l'URL du logo existe
        if (@getimagesize($logo_url)) {
            echo '<img src="' . $logo_url . '" alt="' . $serie['name'] . '">';
        }
    }
    echo '</div>';
    echo '<div class="titre">';
    echo '<p>' . $serie['name'] . '</p>';
    echo '</div>';

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
echo '</div>'
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
