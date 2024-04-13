<?php

// app/models/Set.php

namespace App\Models;

use App\Exceptions\NotFoundException;

class Set extends Model  // Assuming Model handles the database connection
{
    public string $id;
    public ?string $name;
    public ?string $releaseDate;
    public ?string $legal;
    public ?string $logo;
    public ?string $symbol;
    public ?string $cardCount;

    // Méthode pour récupérer toutes les extensions
    public function getAll(): array
    {
        $sql = "SELECT * FROM sets ORDER BY releaseDate DESC";
        $result = $this->conn->query($sql);

        $sets = [];
        while ($row = $result->fetch_assoc()) {
            $sets[] = $this->createSetFromRow($row);
        }

        return $sets;
    }

    // Méthode pour récupérer une extension par son ID
    public function getById(string $id): Set
    {
        $sql = "SELECT * FROM sets WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            throw new NotFoundException("Aucune extension trouvée avec l'ID $id.");
        }

        return $this->createSetFromRow($row);
    }

    // Méthode pour récupérer toutes les extensions d'une serie
    public function getAllBySerieId(string $id): array
    {
        $sql = "SELECT * FROM sets WHERE serie_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $sets = [];
        while ($row = $result->fetch_assoc()) {
            $sets[] = $this->createSetFromRow($row);
        }

        return $sets;
    }

    // Méthode utilitaire pour créer un objet Set à partir d'une ligne de résultat SQL
    private function createSetFromRow(array $row): Set
    {
        $set = new self();
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
