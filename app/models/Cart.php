<?php

// app/models/Cart.php

namespace App\Models;

use App\Lib\DatabaseConnection;
use App\Exceptions\NotFoundException;

class Cart
{
    public DatabaseConnection $conn;

    // Utiliser le fichier views/process/process_form.php
    // Pour rédiger les méthodes ci-dessous (requetes SQL)

    public function addPokemonCard($userId, $pokemonCardId, $quantity) {
        // Ajouter une carte Pokémon au panier pour l'utilisateur
    }

    public function removePokemonCard($userId, $pokemonCardId) {
        // Supprimer une carte Pokémon du panier pour l'utilisateur
    }

    public function updatePokemonCardQuantity($userId, $pokemonCardId, $quantity) {
        // Modifier la quantité d'une carte Pokémon dans le panier
    }

    public function getPokemonCards($userId) {
        // Récupérer la liste des cartes Pokémon dans le panier de l'utilisateur
    }
}