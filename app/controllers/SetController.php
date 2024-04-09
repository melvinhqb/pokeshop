<?php

// app/controllers/SetController.php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\DatabaseConnection;
use App\Exceptions\NotFoundException;

use App\Models\SerieRepository;
use App\Models\SetRepository;
use App\Models\CardRepository;


class SetController extends Controller
{
    // Méthode pour afficher les cartes d'une extension
    public function show(string $id) {
        try {
            $serieRepository = new SerieRepository();
            $serieRepository->conn = new DatabaseConnection();
            $series = $serieRepository->getAll();
    
            $setRepository = new SetRepository();
            $setRepository->conn = new DatabaseConnection();
            $set = $setRepository->getById($id);
    
            $cardRepository = new CardRepository();
            $cardRepository->conn = new DatabaseConnection();
            $cards = $cardRepository->getAllBySetId($set->id);
            
            $this->view('set', [
                'set' => $set,
                'cards' => $cards,
                'series' => $series
            ]);
        } catch (NotFoundException $e) {
            $this->pageNotFound($e->getMessage());
        }
    }
}
