<?php

// app/controllers/CardController.php

namespace App\Controllers\CardController;

require_once('app/lib/database.php');
require_once('app/models/Card.php');
require_once('app/models/Serie.php');

use App\Lib\Database\DatabaseConnection;
use App\Models\Card\CardRepository;
use App\Models\Serie\SerieRepository;

class CardController
{
    public function index(string $id) {
        $serieRepository = new SerieRepository();
        $serieRepository->conn = new DatabaseConnection();
        $series = $serieRepository->getAll();

        $cardRepository = new CardRepository();
        $cardRepository->conn = new DatabaseConnection();
        $card = $cardRepository->getById($id);
    
        require('views/card.php');
    }
}
