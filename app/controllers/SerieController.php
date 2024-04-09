<?php

// app/controllers/SerieController.php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\DatabaseConnection;
use App\Exceptions\NotFoundException;

use App\Models\SerieRepository;
use App\Models\SetRepository;

class SerieController extends Controller
{
    // Méthode pour afficher la liste des séries
    public function index()
    {
        $serieRepository = new SerieRepository();
        $serieRepository->conn = new DatabaseConnection();
        $series = $serieRepository->getAll();

        $setRepository = new SetRepository();
        $setRepository->conn = new DatabaseConnection();
        foreach ($series as $serie) {
            $serie->sets = $setRepository->getAllBySerieId($serie->id);
        }

        $this->view('serie', [
            'series' => $series
        ]);
    }
}
