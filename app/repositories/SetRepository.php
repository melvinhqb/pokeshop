<?php

namespace App\Repositories;

use App\Models\Set;
use App\Exceptions\NotFoundException;

class SetRepository extends Repository
{
    /**
     * Gets all sets from the database.
     *
     * @return array An array of Set objects with basic info (id, name, logo, cardCount).
     */
    public function getAll(): array
    {
        $sql = "SELECT id, name, logo FROM sets ORDER BY releaseDate";
        $result = $this->conn->query($sql);

        $sets = [];
        while ($row = $result->fetch_assoc()) {
            $sets[] = new Set($row);
        }

        return $sets;
    }

    /**
     * Gets all sets associated with a specific series ID.
     *
     * @param string $serieId The ID of the series to which the sets belong.
     * @return array An array of Set objects.
     */
    public function getAllBySerieId(string $serieId): array
    {
        $sql = "SELECT id, name, logo FROM sets WHERE serie_id = ? ORDER BY releaseDate DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $serieId);
        $stmt->execute();
        $result = $stmt->get_result();

        $sets = [];
        while ($row = $result->fetch_assoc()) {
            $sets[] = new Set($row);
        }

        return $sets;
    }

    /**
     * Gets a single set by its ID.
     *
     * @param string $id The unique identifier of the set.
     * @return Set Returns the Set object.
     * @throws NotFoundException If no set is found with the given ID.
     */
    public function getById(string $id): Set
    {
        $sql = "SELECT * FROM sets WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            throw new NotFoundException("No set found with ID $id.");
        }

        $serieRepository = new SerieRepository($this->conn);
        $serie = $serieRepository->getById($row['serie_id']);
        unset($row['serie_id']);

        $set = new Set($row);
        $set->serie = $serie;

        return $set;
    }
}
