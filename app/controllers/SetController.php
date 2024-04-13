<?php

// app/controllers/SetController.php

namespace App\Controllers;

use App\Models\Serie;
use App\Models\Set;
use App\Models\Card;

class SetController extends Controller
{
    // Méthode pour afficher les cartes d'une extension
    public function show(string $id) {
        try {
            $serieRepository = new Serie();
            $series = $serieRepository->getAll();
    
            $setRepository = new Set();
            $set = $setRepository->getById($id);
    
            $cardRepository = new Card();
            $cards = $cardRepository->getAllBySetId($set->id);
            $rarities = $cardRepository->getRarities();
            $types = $cardRepository->getTypes();
            
            $this->view('set', [
                'set' => $set,
                'cards' => $cards,
                'series' => $series,
                'rarities' => $rarities, 
                'types' => $types
            ]);
        } catch (\Exception $e) {
            $this->pageNotFound($e->getMessage());
        }
    }
}

