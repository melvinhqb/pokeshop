<?php

// app/controllers/SetController.php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\DatabaseConnection;
use App\Models\Serie;
use App\Models\Set;
use App\Models\Card;


class SetController extends Controller
{
    // Méthode pour afficher les cartes d'une extension
    public function show(string $id) {
        try {
            $serieRepository = new Serie();
            $serieRepository->conn = new DatabaseConnection();
            $series = $serieRepository->getAll();
    
            $setRepository = new Set();
            $setRepository->conn = new DatabaseConnection();
            $set = $setRepository->getById($id);
    
            $cardRepository = new Card();
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
