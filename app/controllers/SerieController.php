<?php

// app/controllers/SerieController.php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\DatabaseConnection;
use App\Models\Serie;
use App\Models\Set;

class SerieController extends Controller
{
    // Méthode pour afficher la liste des séries
    public function index()
    {
        $serieRepository = new Serie();
        $serieRepository->conn = new DatabaseConnection();
        $series = $serieRepository->getAll();

        $setRepository = new Set();
        $setRepository->conn = new DatabaseConnection();
        foreach ($series as $serie) {
            $serie->sets = $setRepository->getAllBySerieId($serie->id);
        }

        $this->view('serie', [
            'series' => $series
        ]);
    }
}
