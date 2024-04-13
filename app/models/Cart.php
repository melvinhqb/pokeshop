<?php

// app/models/Cart.php

namespace App\Models;

use App\Lib\DatabaseConnection;
use App\Exceptions\NotFoundException;
use App\Models\Card;


class Cart
{
    public int $userId;
    public string $cardId;
    public int $quantity;

    public DatabaseConnection $conn;

    public function addToCart($userId, $cardId, $quantity)
    {
        // Vérifier d'abord le stock de la carte
        $card = new Card();
        $card->conn = $this->conn; // Passer la connexion à l'objet Card
        $availableStock = $card->getStockById($cardId);
    
        // Vérifier si le stock est suffisant
        if ($availableStock < $quantity) {
            throw new \Exception("Le stock de la carte est insuffisant.");
        }
    
        // Vérifier si la carte est déjà dans le panier
        if ($this->getQuantityInCart($userId, $cardId) === 0) {
            // Si la carte n'est pas déjà dans le panier, insérer-la
            $sql = "INSERT INTO user_card (user_id, card_id, quantity) VALUES ($userId, '$cardId', $quantity)";
            $stmt = $this->conn->connect()->prepare($sql);
            $stmt->execute();
        } else {
            // Si la carte est déjà dans le panier, mettre à jour la quantité
            $currentQuantity = $this->getQuantityInCart($userId, $cardId);
            $newQuantity = $currentQuantity + $quantity;
            
            $sql = "UPDATE user_card SET quantity = $newQuantity WHERE user_id = $userId AND card_id = '$cardId'";
            $stmt = $this->conn->connect()->prepare($sql);
            $stmt->execute();
        }
    }

    public function deleteFrom($userId, $cardId) {
        $sql = "DELETE FROM user_card WHERE user_id = $userId AND card_id = '$cardId'";
        $stmt = $this->conn->connect()->prepare($sql);
        $stmt->execute();
    }

    public function getCartItems($userId): array
    {
        $sql = "SELECT * FROM user_card WHERE user_id=$userId";
        $result = $this->conn->connect()->query($sql);
    
        $cartItems = []; // Initialiser une liste pour stocker les cartes et les quantités
    
        // Parcourir toutes les lignes du résultat
        while ($row = $result->fetch_assoc()) {
            // Instancier l'objet Card
            $cardRepository = new Card();
            $cardRepository->conn = new DatabaseConnection();
            $card = $cardRepository->getById($row['card_id']);
    
            // Ajouter l'objet Card et la quantité demandée à la liste
            $cartItems[] = [
                'card' => $card,
                'quantity' => $row['quantity']
            ];
        }
    
        return $cartItems; // Retourner la liste d'objets contenant les cartes et les quantités
    }
    
    public function getQuantityInCart($userId, $cardId) {
        $sql = "SELECT quantity FROM user_card WHERE user_id=$userId AND card_id='$cardId'";
        $result = $this->conn->connect()->query($sql);

        $row = $result->fetch_assoc();

        if(!$row) {
            return 0;
        }
        return $row['quantity'];
    }
    
}