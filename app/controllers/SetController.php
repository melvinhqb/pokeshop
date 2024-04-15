<?php

// app/controllers/SetController.php

namespace App\Controllers;

use App\Repositories\SerieRepository;
use App\Repositories\SetRepository;
use App\Repositories\CardRepository;

class SetController extends Controller
{
    // Méthode pour afficher les cartes d'une extension
    public function show(string $id) {
        try {
            $serieRepository = new SerieRepository();
            $series = $serieRepository->getAll();
    
            $setRepository = new SetRepository();
            $set = $setRepository->getById($id);
    
            $cardRepository = new CardRepository();
            $cards = $cardRepository->getAllBySetId($set->id);
            $rarities = $cardRepository->getRarities();
            $types = $cardRepository->getTypes();
            
            $this->view('products/set', [
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

