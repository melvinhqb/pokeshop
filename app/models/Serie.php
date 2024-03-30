<?php

// app/models/Serie.php

namespace App\Models\Serie;

require_once('app/lib/database.php');

use App\Lib\Database\DatabaseConnection;

class Serie
{
    public string $id;
    public string $name;
    public string $logo;
}

class SerieRepository
{
    public DatabaseConnection $conn;

    public function getAll(): array
    {

        $sql = "SELECT s.id, s.name, s.logo
                FROM series s
                LEFT JOIN (
                    SELECT serie_id, MAX(releaseDate) AS max_releaseDate 
                    FROM sets 
                    GROUP BY serie_id
                ) t ON s.id = t.serie_id 
                ORDER BY t.max_releaseDate DESC";
        $result = $this->conn->connect()->query($sql);

        $series = [];
        while (($row = $result->fetch_assoc())) {
            $series[] = $this->createSerieFromRow($row);
        }

        return $series;
    }

    public function getById(string $id): Serie
    {
        $sql = "SELECT id, name, logo FROM series WHERE id = $id";
        $result = $this->conn->connect()->query($sql);

        $row = $result->fetch_assoc();

        return $this->createSerieFromRow($row);
    }

    // Méthode utilitaire pour créer un objet Card à partir d'une ligne de résultat SQL
    private function createSerieFromRow(array $row): Serie
    {
        $serie = new Serie();
        $serie->id = $row['id'];
        $serie->name = $row['name'];
        $serie->logo = $row['logo'];

        return $serie;
    }
}

?>
