<?php

// app/controllers/CardController.php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\DatabaseConnection;

use App\Models\SerieRepository;
use App\Models\CardRepository;

class CardController extends Controller
{
    // Méthode pour afficher les détails d'une carte
    public function show(string $id) {
        $serieRepository = new SerieRepository();
        $serieRepository->conn = new DatabaseConnection();
        $series = $serieRepository->getAll();

        $cardRepository = new CardRepository();
        $cardRepository->conn = new DatabaseConnection();
        $card = $cardRepository->getById($id);
    
        $this->view('card', ['card' => $card, 'series' => $series]);
    }
}
