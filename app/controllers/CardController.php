<?php

// app/controllers/CardController.php

namespace App\Controllers;

use App\Repositories\SerieRepository;
use App\Repositories\CardRepository;

class CardController extends Controller
{
    // Méthode pour afficher les détails d'une carte
    public function show(string $id) {
        try {
            $serieRepository = new SerieRepository();
            $series = $serieRepository->getAll();

            $cardRepository = new CardRepository();
            $card = $cardRepository->getById($id);
        
            $this->view('products/card', [
                'card' => $card,
                'series' => $series
            ]);
        } catch (\Exception $e) {
            $this->pageNotFound($e->getMessage());
        }
    }
}
