<?php

namespace App\Repositories;

use App\Models\Serie;
use App\Exceptions\NotFoundException;

class SerieRepository extends Repository
{
    /**
     * Retrieves all series from the database.
     *
     * @return array An array of Serie objects with basic info (id, name, logo).
     */
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
        $result = $this->conn->query($sql);

        $series = [];
        while ($row = $result->fetch_assoc()) {
            $series[] = new Serie($row);
        }

        return $series;
    }

    /**
     * Retrieves a single series by its ID, including its sets.
     *
     * @param string $id The unique identifier of the series.
     * @return Serie Returns the Serie object with all associated sets.
     * @throws NotFoundException If no series is found with the given ID.
     */
    public function getById(string $id): Serie
    {
        $sql = "SELECT * FROM series WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            throw new NotFoundException("No series found with ID $id.");
        }

        $serie = new Serie($row);

        return $serie;
    }
}
