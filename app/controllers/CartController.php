<?php

// app/controllers/CardController.php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\DatabaseConnection;
use App\Exceptions\NotFoundException;

use App\Models\Cart;

class CartController extends Controller
{
    // Méthode pour afficher le panier de l'utilisateur
    public function show()
    {
        // Vérifie qu'un utilisateur est connecté pour ouvrir un panier
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?route=login");
            exit;
        }

        // Récupérer la liste des carte de l'utilisateur qui a l'id = $_SESSION['user_id']
        // Utilise les méthodes de Cart.php
        $cart = new Cart();

        $this->view('cart'); // Ajouter la liste des cartes en paramètre
    }

    public function addToCart()
    {
        // Vérifie qu'un utilisateur est connecté pour ouvrir un panier
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?route=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cardId = $_POST['card_id'];
            $quantity = $_POST['quantity'];
            
            if ($cardId !== '' && $quantity !== '') {
                // Crée un nouvel objet Cart
                $cart = new Cart();
                
                // Ajoutez l'élément au panier dans la base de données ou tout autre système de stockage
                // Utiliser les méthodes dans Cart.php
                echo "cardId: $cardId\nquantity: $quantity\nuser_id: " . $_SESSION['user_id'] . "\n" . "user_name: " . $_SESSION['user_name'];
            } else {
                // Gère les erreurs si les données ne sont pas définies
                echo "Erreur : Données manquantes.";
            }
        } else {
            // Gère les erreurs si la méthode n'est pas POST
            echo "Erreur : Méthode non autorisée.";
        }
    }


}
