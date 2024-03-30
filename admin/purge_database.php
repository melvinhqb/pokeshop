<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pokeshop_v2";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Requête SQL pour désactiver la vérification des clés étrangères
$sql_disable_foreign_key_checks = "SET FOREIGN_KEY_CHECKS = 0";
$conn->query($sql_disable_foreign_key_checks);

// Requête SQL pour purger la table "cards"
$sql_delete_cards = "DELETE FROM cards";
$conn->query($sql_delete_cards);

// Requête SQL pour purger la table "sets"
$sql_delete_sets = "DELETE FROM sets";
$conn->query($sql_delete_sets);

// Requête SQL pour purger la table "series"
$sql_delete_series = "DELETE FROM series";
$conn->query($sql_delete_series);

// Requête SQL pour réactiver la vérification des clés étrangères
$sql_enable_foreign_key_checks = "SET FOREIGN_KEY_CHECKS = 1";
$conn->query($sql_enable_foreign_key_checks);

// Fermeture de la connexion
$conn->close();

// Répondre avec un message de succès
echo "Base de données purgée avec succès.";
?>
