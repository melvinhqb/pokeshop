<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ensembles de Cartes Pokémon</title>
    <style>
        .pokemon-card img {
            width: 100px;
            height: auto;
        }
        .cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        p {
            margin: 0 2px;
        }
    </style>
</head>
<body>

<?php
if (isset($_GET['id'])) {
    $set_id = $_GET['id'];

    // Faire une requête à l'API TCGdex pour obtenir des informations détaillées sur l'ensemble de cartes
    $set_details_json = file_get_contents('https://api.tcgdex.net/v2/fr/sets/' . $set_id);
    $set_details = json_decode($set_details_json, true);

    // Afficher le nom et la description de l'ensemble de cartes
    if (isset($set_details['name'])) {
        echo '<h1>Ensemble de Cartes Pokémon : ' . $set_details['name'] . '</h1>';
    }
    if (isset($set_details['description'])) {
        echo '<p>Description : ' . $set_details['description'] . '</p>';
    }

    $set_id = $set_details['id'];
    $serie_id = $set_details['serie']['id'];

    // Afficher les cartes de l'ensemble dans un tableau
    if (isset($set_details['cards'])) {
        echo '<h2>Cartes dans cet ensemble :</h2>';
        echo '<form id="cardForm" method="post" action="add_cards.php">';
        echo '<input type="hidden" name="set_id" value="' . $set_id . '">';
        echo '<input type="checkbox" id="selectAll"> <label for="selectAll">Tout sélectionner</label>';
        echo '<input type="submit" value="Ajouter les cartes">';
        echo '<table>';
        echo '<tr><th>Sélection</th><th>Carte</th><th>ID</th></tr>';
        foreach ($set_details['cards'] as $card) {
            echo '<tr>';
            echo '<td><input type="checkbox" name="cards[]" value="' . $card['id'] . '"></td>';
            echo '<td>';
            echo '<p>' . $card['name'] . '</p>';
            echo '</td>';
            echo '<td>';
            echo '<p>' . $card['id'] . '</p>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<input type="checkbox" id="selectAll"> <label for="selectAll">Tout sélectionner</label>';
        echo '<input type="hidden" name="set_id" value="'. $set_id . '">';
        echo '<input type="hidden" name="serie_id" value="'. $serie_id . '">';
        echo '</form>';
        
    }
} else {
    echo '<p>Aucun ensemble sélectionné.</p>';
}
?>

<script>
    document.getElementById('selectAll').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    });
</script>

</body>
</html>
