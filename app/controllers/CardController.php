<?php

// app/controllers/CardController.php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\DatabaseConnection;
use App\Models\Serie;
use App\Models\Card;

class CardController extends Controller
{
    // Méthode pour afficher les détails d'une carte
    public function show(string $id) {
        try {
            $serieRepository = new Serie();
            $serieRepository->conn = new DatabaseConnection();
            $series = $serieRepository->getAll();

            $cardRepository = new Card();
            $cardRepository->conn = new DatabaseConnection();
            $card = $cardRepository->getById($id);
        
            $this->view('card', ['card' => $card, 'series' => $series]);
        } catch (\Exception $e) {
            $this->pageNotFound($e->getMessage());
        }
    }
}
