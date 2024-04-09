<?php

// app/models/Set.php

namespace App\Models;

require_once('app/lib/database.php');
require_once('app/exceptions/NotFoundException.php');

use App\Lib\DatabaseConnection;
use App\Exceptions\NotFoundException;

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

    // Méthode pour récupérer toutes les extensions
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

    // Méthode pour récupérer une extension par son ID
    public function getById(string $id): Set
    {
        $sql = "SELECT * FROM sets WHERE id = '$id'";
        $result = $this->conn->connect()->query($sql);

        $row = $result->fetch_assoc();

        if (!$row) {
            throw new NotFoundException("Aucune extension trouvée avec l'ID $id.");
        }

        return $this->createSetFromRow($row);
    }

    // Méthode pour récupérer toutes les extensions d'une serie
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

    // Méthode utilitaire pour créer un objet Set à partir d'une ligne de résultat SQL
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
