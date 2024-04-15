<?php

// app/controllers/SerieController.php

namespace App\Controllers;

use App\Repositories\SerieRepository;
use App\Repositories\SetRepository;

class SerieController extends Controller
{
    // Méthode pour afficher la liste des séries
    public function index()
    {
        $serieRepository = new SerieRepository();
        $series = $serieRepository->getAll();

        $setRepository = new SetRepository();
        foreach ($series as $serie) {
            // Supposons que SetRepository::getAllBySerieId(int $serieId) renvoie tous les sets pour une série donnée
            $serie->sets = $setRepository->getAllBySerieId($serie->id);
        }

        $this->view('products/serie', [
            'series' => $series
        ]);
    }
}

