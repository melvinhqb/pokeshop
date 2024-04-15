<?php

namespace App\Repositories;

use App\Models\Card;
use App\Exceptions\NotFoundException;

class CardRepository extends Repository
{
    /**
     * Gets all cards from the database.
     *
     * @return array An array of Card objects with basic info (id, name, image).
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM cards";
        $result = $this->conn->query($sql);

        $cards = [];
        while ($row = $result->fetch_assoc()) {
            $cards[] = new Card($row);
        }

        return $cards;
    }

    /**
     * Gets all cards that belong to a specific set.
     *
     * @param string $setId The ID of the set to which the cards belong.
     * @return array An array of Card objects.
     */
    public function getAllBySetId(string $setId): array
    {
        $sql = "SELECT * FROM cards WHERE set_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $setId);
        $stmt->execute();
        $result = $stmt->get_result();

        $cards = [];
        while ($row = $result->fetch_assoc()) {
            $cards[] = new Card($row);
        }

        return $cards;
    }

    /**
     * Gets a single card by its ID.
     *
     * @param string $id The unique identifier of the card.
     * @return Card Returns the Card object.
     * @throws NotFoundException If no card is found with the given ID.
     */
    public function getById(string $id): Card
    {
        $sql = "SELECT * FROM cards WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            throw new NotFoundException("No card found with ID $id.");
        }

        $setRepository = new SetRepository($this->conn);
        $set = $setRepository->getById($row['set_id']);
        unset($row['set_id']);

        $card = new Card($row);
        $card->set = $set;

        return $card;
    }

    /**
     * Gets distinct card rarities.
     *
     * @return array An array of rarities
     */
    public function getRarities(): array
    {
        $sql = "SELECT DISTINCT rarity FROM cards";
        $result = $this->conn->query($sql);
        $rarities = [];
        while ($row = $result->fetch_assoc()) {
            $rarities[] = $row['rarity'];
        }
        return $rarities;
    }

    /**
     * Gets distincs card types.
     *
     * @return array An array of types
     */
    public function getTypes(): array
    {
        $sql = "SELECT DISTINCT types FROM cards";
        $result = $this->conn->query($sql);
        $types = [];
        while ($row = $result->fetch_assoc()) {
            $types[] = $row['types'];
        }
        return $types;
    }
}
