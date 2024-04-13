<?php

// app/controllers/CardController.php

namespace App\Controllers;

use App\Models\Serie;
use App\Models\Card;

class CardController extends Controller
{
    // Méthode pour afficher les détails d'une carte
    public function show(string $id) {
        try {
            $serieRepository = new Serie();
            $series = $serieRepository->getAll();

            $cardRepository = new Card();
            $card = $cardRepository->getById($id);
        
            $this->view('card', [
                'card' => $card,
                'series' => $series
            ]);
        } catch (\Exception $e) {
            $this->pageNotFound($e->getMessage());
        }
    }
}
