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
        $cart->conn = new DatabaseConnection();
        $cartItems = $cart->getCartItems($_SESSION['user_id']);

        $this->view('cart', ['cartItems' => $cartItems]); // Ajouter la liste des cartes en paramètre
    }

    public function addToCart()
    {
        // Vérifie qu'un utilisateur est connecté pour ouvrir un panier
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?route=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $cardId = $_POST['card_id'];
            $quantity = $_POST['quantity'];
            
            if ($cardId !== '' && $quantity !== '') {
                // Crée un nouvel objet Cart
                $cart = new Cart();
                $cart->conn = new DatabaseConnection();
                // Ajoutez l'élément au panier dans la base de données ou tout autre système de stockage
                // Utiliser les méthodes dans Cart.php
                //echo "cardId: $cardId\nquantity: $quantity\nuser_id: " . $_SESSION['user_id'] . "\n" . "user_name: " . $_SESSION['user_name'];
                
                $cart->addToCart($userId, $cardId, $quantity);

            } else {
                // Gère les erreurs si les données ne sont pas définies
                echo "Erreur : Données manquantes.";
            }
        } else {
            // Gère les erreurs si la méthode n'est pas POST
            echo "Erreur : Méthode non autorisée.";
        }
    }

    public function deleteAll() {
        // Vérifie qu'un utilisateur est connecté pour ouvrir un panier
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?route=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $cardId = $_POST['card_id'];

            $cart = new Cart();
            $cart->conn = new DatabaseConnection();
            $cart->deleteFrom($userId, $cardId);
        } else {
            // Gère les erreurs si la méthode n'est pas POST
            echo "Erreur : Méthode non autorisée.";
        }
    }
}
