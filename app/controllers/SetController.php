<?php

// app/controllers/SetController.php

namespace App\Controllers\SetController;

require_once('app/lib/database.php');
require_once('app/models/Set.php');
require_once('app/models/Card.php');
require_once('app/models/Serie.php');

use App\Lib\Database\DatabaseConnection;
use App\Models\Set\SetRepository;
use App\Models\Card\CardRepository;
use App\Models\Serie\SerieRepository;

class SetController
{
    public function index(string $id) {
        $serieRepository = new SerieRepository();
        $serieRepository->conn = new DatabaseConnection();
        $series = $serieRepository->getAll();

        $setRepository = new SetRepository();
        $setRepository->conn = new DatabaseConnection();
        $set = $setRepository->getById($id);

        $cardRepository = new CardRepository();
        $cardRepository->conn = new DatabaseConnection();
        $cards = $cardRepository->getAllBySetId($set->id);
        
        require('views/set.php');
    }
}

?>
