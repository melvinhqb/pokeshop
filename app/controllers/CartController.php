<?php

// app/controllers/CartController.php

namespace App\Controllers;

use App\Repositories\CartRepository;


class CartController extends Controller
{

    public function __construct()
    {
        // Vérifie qu'un utilisateur est connecté pour ouvrir un panier
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?route=profile&action=login");
            exit;
        }
    }
    // Méthode pour afficher le panier de l'utilisateur
    public function show()
    {
        $cart = new CartRepository();
        $cartItems = $cart->getCartItems($_SESSION['user_id']);

        $this->view('cart', ['cartItems' => $cartItems]); // Pass the list of items to the view
    }

    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $cardId = $_POST['card_id'];
            $quantity = $_POST['quantity'];
            if (!empty($cardId) && !empty($quantity)) {
                $cart = new CartRepository();
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
    public function modifyCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $cardId = $_POST['card_id'];
            $quantity = $_POST['quantity'];
            if (!empty($cardId) && !empty($quantity)) {
                $cart = new CartRepository();
                $cart->modifyCart($userId, $cardId, $quantity);
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

    public function deleteAll()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $cardId = $_POST['card_id'];

            $cart = new CartRepository();
            $cart->deleteFromCart($userId, $cardId);
        } else {
            // Handle errors if the method is not POST
            echo "Erreur : Méthode non autorisée.";
            exit;
        }
    }

    public function paymentForm()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?route=profile&action=login");
            exit;
        }
        $this->view('payment');
    }

    public function processPayment()
    {
        header("Location: index.php");
    }
}
