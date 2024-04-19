<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Repositories\CardRepository;
use App\Exceptions\NotFoundException;

class CartRepository extends Repository
{
    /**
     * Adds an item to the shopping cart. If the item already exists, it increases the quantity.
     *
     * @param int $userId The ID of the user.
     * @param string $cardId The ID of the card.
     * @param int $quantity The quantity of the card to add.
     * @throws \Exception If there is not enough stock of the card.
     */
    public function addToCart($userId, $cardId, $quantity)
    {
        $cardRepository = new CardRepository();
        $availableStock = $cardRepository->getById($cardId)->stock;

        if ($availableStock < $quantity) {
            throw new \Exception("Insufficient card stock available.");
        }

        $currentQuantity = $this->getQuantityInCart($userId, $cardId);

        if ($currentQuantity === 0) {
            $sql = "INSERT INTO user_card (user_id, card_id, quantity) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isi", $userId, $cardId, $quantity);
        } else {
            $newQuantity = min($currentQuantity + $quantity, $availableStock);
            $sql = "UPDATE user_card SET quantity=? WHERE user_id=? AND card_id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iis", $newQuantity, $userId, $cardId);
        }
        $stmt->execute();
    }

    /**
     * Removes an item from the shopping cart.
     *
     * @param int $userId The ID of the user.
     * @param string $cardId The ID of the card to remove.
     */
    public function deleteFromCart($userId, $cardId)
    {
        $sql = "DELETE FROM user_card WHERE user_id=? AND card_id=?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $userId, $cardId);
        $stmt->execute();
    }

    public function deleteAllFromCart($userId)
    {
    
        $updateSql = "UPDATE cards c JOIN (
            SELECT card_id, quantity
            FROM user_card
            WHERE user_id = ?
            GROUP BY card_id
        ) t ON c.id = t.card_id
        SET c.stock = c.stock - t.quantity";
        
        $deleteSql = "DELETE FROM user_card WHERE user_id = ?";

        // Update stock
        $stmt = $this->conn->prepare($updateSql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->close();

        // Delete cart items
        $stmt = $this->conn->prepare($deleteSql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->close();
        }


    public function modifyCart($userId, $cardId, $quantity)
    {
        $cardRepository = new CardRepository();
        $availableStock = $cardRepository->getById($cardId)->stock;

        if ($availableStock < $quantity) {
            throw new \Exception("Insufficient card stock available.");
        }

        $currentQuantity = $this->getQuantityInCart($userId, $cardId);
        $newQuantity = min($quantity, $availableStock);
        
        $sql = "UPDATE user_card SET quantity=? WHERE user_id=? AND card_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iis", $newQuantity, $userId, $cardId);
    
        $stmt->execute();
    }

    /**
     * Gets all items in the shopping cart for a given user.
     *
     * @param int $userId The ID of the user whose cart items to retrieve.
     * @return array An array of items in the cart, each item includes a card object and its quantity.
     */
    public function getCartItems(int $userId): array
    {
        $sql = "SELECT cards.id, user_card.quantity, cards.price, cards.stock FROM user_card
                JOIN cards ON user_card.card_id = cards.id
                WHERE user_card.user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $cartItems = [];
        

        while ($row = $result->fetch_assoc()) {
            $cartItems[] = [
                'card' => (new CardRepository())->getById($row["id"]),
                'quantity' => $row['quantity'],
                'price' => $row['price'],
                'stock' => $row['stock'],
            ];
        }

        return $cartItems;
    }

    /**
     * Gets the quantity of a specific card in the cart of a specified user.
     *
     * @param int $userId The ID of the user.
     * @param string $cardId The ID of the card.
     * @return int The quantity of the specified card in the cart.
     */
    public function getQuantityInCart($userId, $cardId)
    {
        $sql = "SELECT quantity FROM user_card WHERE user_id=? AND card_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $userId, $cardId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row ? $row['quantity'] : 0;
    }



    public function calculateTotal($userId){ 
        $total = 0;
        $cartItems = $this->getCartItems($userId);  // Retrieve all cart items for the user

        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];  // Calculate total using price and quantity from the cart items
        }
        if ($cartItems == []){
            $total=0;
        }

    return $total;  // Return the calculated total
}
}
