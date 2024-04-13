<?php

// app/models/Card.php

namespace App\Models;

use App\Exceptions\NotFoundException;

class Card extends Model
{
    public ?string $id;
    public ?string $category;
    public ?string $illustrator;
    public ?string $image;
    public ?string $localId;
    public ?string $name;
    public ?string $rarity;
    public ?string $types;
    public ?string $evolveFrom;
    public ?string $description;
    public ?string $stage;
    public ?string $attacks;
    public ?string $weaknesses;
    public ?string $retreat;
    public ?string $regulationMark;
    public ?string $legal;
    public ?string $variants;
    public ?string $hp;
    public int $stock = 0;
    public float $price = 0.0;

    // Retrieve a card by ID
    public function getById(string $id): ?Card
    {
        $sql = "SELECT * FROM cards WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            throw new NotFoundException("No card found with ID $id.");
        }

        return $this->createCardFromRow($row);
    }

    // Retrieve all cards for a specific set
    public function getAllBySetId(string $setId): array
    {
        $sql = "SELECT * FROM cards WHERE set_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $setId);
        $stmt->execute();
        $result = $stmt->get_result();

        $cards = [];
        while ($row = $result->fetch_assoc()) {
            $cards[] = $this->createCardFromRow($row);
        }
        return $cards;
    }

    // Get distinct card rarities
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

    // Get distinct card types
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

    public function getStockById(string $cardId): int
    {
        $sql = "SELECT stock FROM cards WHERE id='$cardId'";
        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        if ($row) {
            return intval($row['stock']);
        } else {
            throw new NotFoundException("Aucune carte trouvée avec l'ID $cardId.");
        }
    }

    // Utility method to create a Card object from a database row
    private function createCardFromRow(array $row): Card
    {
        $card = new self();
        $card->id = $row['id'];
        $card->category = $row['category'];
        $card->illustrator = $row['illustrator'];
        $card->image = $row['image'];
        $card->localId = $row['localId'];
        $card->name = $row['name'];
        $card->rarity = $row['rarity'];
        $card->types = $row['types'];
        $card->evolveFrom = $row['evolveFrom'];
        $card->description = $row['description'];
        $card->stage = $row['stage'];
        $card->attacks = $row['attacks'];
        $card->weaknesses = $row['weaknesses'];
        $card->retreat = $row['retreat'];
        $card->regulationMark = $row['regulationMark'];
        $card->legal = $row['legal'];
        $card->variants = $row['variants'];
        $card->hp = $row['hp'];
        $card->price = $row['price'];
        $card->stock = $row['stock'];

        return $card;
    }
}
