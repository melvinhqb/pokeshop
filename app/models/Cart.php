<?php

// app/models/Cart.php

namespace App\Models;

use App\Exceptions\NotFoundException;

class Cart extends Model
{
    public int $userId;
    public string $cardId;
    public int $quantity;

    // Ajouter un article au panier
    public function addToCart($userId, $cardId, $quantity)
    {
        $card = new Card();
        $availableStock = $card->getStockById($cardId);

        if ($availableStock < $quantity) {
            throw new \Exception("Le stock de la carte est insuffisant.");
        }

        $currentQuantity = $this->getQuantityInCart($userId, $cardId);

        if ($currentQuantity === 0) {
            $sql = "INSERT INTO user_card (user_id, card_id, quantity) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isi", $userId, $cardId, $quantity);
        } else {
            $newQuantity = $currentQuantity + $quantity;
            $sql = "UPDATE user_card SET quantity=$newQuantity WHERE user_id=$userId AND card_id='$cardId'";
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->execute();
    }

    // Supprimer un article du panier
    public function deleteFrom($userId, $cardId) {
        $sql = "DELETE FROM user_card WHERE user_id=? AND card_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $userId, $cardId);
        $stmt->execute();
    }

    // Récupérer les articles du panier
    public function getCartItems($userId): array
    {
        $sql = "SELECT card_id, quantity FROM user_card WHERE user_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $cartItems = [];
        while ($row = $result->fetch_assoc()) {
            $card = (new Card())->getById($row['card_id']);
            $cartItems[] = ['card' => $card, 'quantity' => $row['quantity']];
        }
        return $cartItems;
    }

    // Obtenir la quantité d'un article dans le panier
    public function getQuantityInCart($userId, $cardId) {
        $sql = "SELECT quantity FROM user_card WHERE user_id=? AND card_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $userId, $cardId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row ? $row['quantity'] : 0;
    }
}
