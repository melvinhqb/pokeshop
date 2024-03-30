<?php

// app/models/Set.php

namespace App\Models\Set;

require_once('app/lib/database.php');

use App\Lib\Database\DatabaseConnection;

class Set
{
    public string $id;
    public ?string $name;
    public ?string $releaseDate;
    public ?string $legal;
    public ?string $logo;
    public ?string $symbol;
    public ?string $cardCount;
}

class SetRepository
{
    public DatabaseConnection $conn;

    public function getAll(): array
    {
        $sql = "SELECT * FROM sets ORDER BY releaseDate DESC";
        $result = $this->conn->connect()->query($sql);

        $sets = [];
        while (($row = $result->fetch_assoc())) {
            $sets[] = $this->createSetFromRow($row);
        }

        return $sets;
    }

    public function getById(string $id): Set
    {
        $sql = "SELECT * FROM sets WHERE id = '$id'";
        $result = $this->conn->connect()->query($sql);

        $row = $result->fetch_assoc();

        return $this->createSetFromRow($row);
    }

    public function getAllBySerieId(string $id): array
    {
        $sql = "SELECT * FROM sets WHERE serie_id = '$id' ORDER BY releaseDate DESC";
        $result = $this->conn->connect()->query($sql);

        $sets = [];
        while (($row = $result->fetch_assoc())) {
            $sets[] = $this->createSetFromRow($row);
        }

        return $sets;
    }

    private function createSetFromRow(array $row): Set
    {
        $set = new Set();
        $set->id = $row['id'];
        $set->name = $row['name'];
        $set->releaseDate = $row['releaseDate'];
        $set->legal = $row['legal'];
        $set->logo = $row['logo'];
        $set->symbol = $row['symbol'];
        $set->cardCount = $row['cardCount'];

        return $set;
    }
}
