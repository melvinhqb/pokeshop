<?php

// app/controllers/SerieController.php

namespace App\Controllers;

use App\Models\Serie;
use App\Models\Set;

class SerieController extends Controller
{
    // Méthode pour afficher la liste des séries
    public function index()
    {
        $serieRepository = new Serie();
        $series = $serieRepository->getAll();

        $setRepository = new Set();
        foreach ($series as $serie) {
            // Supposons que Set::getAllBySerieId(int $serieId) renvoie tous les sets pour une série donnée
            $serie->sets = $setRepository->getAllBySerieId($serie->id);
        }

        $this->view('serie', ['series' => $series]);
    }
}

