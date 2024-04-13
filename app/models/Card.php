<?php

// app/models/Card.php

namespace App\Models;

use App\Lib\DatabaseConnection;
use App\Exceptions\NotFoundException;

class Card
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

    public DatabaseConnection $conn;

    // Méthode pour récupérer une carte par son ID
    public function getById(string $id): ?Card
    {
        $sql = "SELECT * FROM cards WHERE id='$id'";
        $result = $this->conn->connect()->query($sql);

        $row = $result->fetch_assoc();

        if (!$row) {
            throw new NotFoundException("Aucune carte trouvée avec l'ID $id.");
        }

        return $this->createCardFromRow($row);
    }


    // Méthode pour récupérer toutes les cartes d'un ensemble spécifique
    public function getAllBySetId(string $setId): array
    {
        $sql = "SELECT * FROM cards WHERE set_id='$setId'";
        $result = $this->conn->connect()->query($sql);

        $cards = [];
        while ($row = $result->fetch_assoc()) {
            $cards[] = $this->createCardFromRow($row);
        }

        return $cards;
    }

    public function getStockById(string $cardId): int
    {
        $sql = "SELECT stock FROM cards WHERE id='$cardId'";
        $result = $this->conn->connect()->query($sql);

        $row = $result->fetch_assoc();

        if ($row) {
            return intval($row['stock']);
        } else {
            throw new NotFoundException("Aucune carte trouvée avec l'ID $cardId.");
        }
    }

    // Méthode utilitaire pour créer un objet Card à partir d'une ligne de résultat SQL
    private function createCardFromRow(array $row): Card
    {
        $card = new Card();
        $card->id = $row["id"];
        $card->category = $row["category"];
        $card->illustrator = $row["illustrator"];
        $card->image = $row["image"];
        $card->localId = $row["localId"];
        $card->name = $row["name"];
        $card->rarity = $row["rarity"];
        $card->types = $row["types"];
        $card->evolveFrom = $row["evolveFrom"];
        $card->description = $row["description"];
        $card->stage = $row["stage"];
        $card->attacks = $row["attacks"];
        $card->weaknesses = $row["weaknesses"];
        $card->retreat = $row["retreat"];
        $card->regulationMark = $row["regulationMark"];
        $card->legal = $row["legal"];
        $card->variants = $row["variants"];
        $card->hp = $row["hp"];
        $card->price = $row["price"];
        $card->stock = $row["stock"];

        return $card;
    }
}
