<?php

// app/controllers/CartController.php

namespace App\Controllers;

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

        $cart = new Cart();
        $cartItems = $cart->getCartItems($_SESSION['user_id']);

        $this->view('cart', ['cartItems' => $cartItems]); // Pass the list of items to the view
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
            
            if (!empty($cardId) && !empty($quantity)) {
                $cart = new Cart();
                $cart->addToCart($userId, $cardId, $quantity);
            } else {
                // Handle errors if data is not defined
                echo "Erreur : Données manquantes.";
                exit;
            }
        } else {
            // Handle errors if the method is not POST
            echo "Erreur : Méthode non autorisée.";
            exit;
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
            $cart->deleteFrom($userId, $cardId);
        } else {
            // Handle errors if the method is not POST
            echo "Erreur : Méthode non autorisée.";
            exit;
        }
    }
}
